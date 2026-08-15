<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintDocument;
use App\Models\Price;
use Illuminate\Support\Facades\Http;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {


        if (!$request->cookie('loggedin_number')) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please login before accessing checkout.'
                );
        }

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );



        if (empty($selectedIds)) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please select at least one document.'
                );
        }



        $printOptions = session(
            'print_options',
            []
        );



        $documents = PrintDocument::whereIn(
            'id',
            $selectedIds
        )
            ->get([
                'id',
                'original_name',
                'file_size',
                'pages',
                'mime_type',
                'status'
            ]);




        $mobile = $request->cookie(
            'loggedin_number'
        );



        $printPrices = Price::whereIn(
            'slug',
            [
                'black_white_single',
                'black_white_double',
                'color_single',
                'color_double',
            ]
        )
            ->where(
                'status',
                1
            )
            ->pluck(
                'amount',
                'slug'
            );



        $binding = Price::where(
            'slug',
            'bindings'
        )
            ->where(
                'status',
                1
            )
            ->with([
                'childPrice' => function ($query) {

                    $query
                        ->where('status', 1)
                        ->orderBy('id');
                }
            ])
            ->first();



        $bindingPrices = [];


        if ($binding) {

            foreach (
                $binding->childPrice
                as $bindingOption
            ) {

                $bindingPrices[$bindingOption->slug] = (float) $bindingOption->amount;
            }
        }


        $printSubtotal = 0;

        $fileBreakdown = [];


        foreach ($documents as $document) {

            $documentId =
                (int) $document->id;


            $options =
                $printOptions[$documentId]
                ?? [];



            $colorMode =
                $options['color_mode']
                ?? 'black_white';


            $printSide =
                $options['print_side']
                ?? 'double';


            $bindingSlug =
                $options['binding']
                ?? '';


            $pageSize =
                $options['page_size']
                ?? 'a4_75';


            $orientation =
                $options['orientation']
                ?? 'portrait';


            $copies =
                max(
                    1,
                    (int) (
                        $options['copies']
                        ?? 1
                    )
                );


            $pages = max(
                1,
                (int) (
                    $document->pages
                    ?? 1
                )
            );



            if (
                $colorMode === 'color'
            ) {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['color_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['color_single'] ?? 0
                        );
                }
            } else {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['black_white_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['black_white_single'] ?? 0
                        );
                }
            }



            $billableSheets = $pages;




            $printCostPerCopy =
                $billableSheets *
                $rate;




            $bindingRate =
                0;


            if (
                !empty($bindingSlug)
            ) {

                $bindingRate =
                    (float) (
                        $bindingPrices[$bindingSlug] ?? 0
                    );
            }




            $oneCopyTotal =
                $printCostPerCopy +
                $bindingRate;



            $fileTotal =
                $oneCopyTotal *
                $copies;



            $printSubtotal +=
                $fileTotal;



            $fileBreakdown[] = [

                'id' =>
                $documentId,

                'name' =>
                $document->original_name,

                'pages' =>
                $pages,

                'color_mode' =>
                $colorMode,

                'print_side' =>
                $printSide,

                'binding' =>
                $bindingSlug,

                'page_size' =>
                $pageSize,

                'orientation' =>
                $orientation,

                'copies' =>
                $copies,

                'rate' =>
                $rate,

                'billable_sheets' =>
                $billableSheets,

                'print_cost_per_copy' =>
                round(
                    $printCostPerCopy,
                    2
                ),

                'binding_rate' =>
                $bindingRate,

                'total' =>
                round(
                    $fileTotal,
                    2
                ),
            ];
        }


        $handlingCharge = 0;




        $deliveryCharge = 0;


        $grandTotal =
            $printSubtotal +
            $handlingCharge +
            $deliveryCharge;


        return view(
            'front.checkout',
            compact(
                'documents',
                'mobile',
                'printSubtotal',
                'handlingCharge',
                'deliveryCharge',
                'grandTotal',
                'fileBreakdown'
            )
        );
    }
    public function placeOrder(Request $request)
    {
        /*
    =====================================================
    LOGIN CHECK
    =====================================================
    */

        $mobile = $request->cookie(
            'loggedin_number'
        );


        if (!$mobile) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please login before placing your order.'
                );
        }


        /*
    =====================================================
    VALIDATION
    =====================================================
    */

        $validated = $request->validate([

            'full_name' => [
                'required',
                'string',
                'max:100'
            ],

            'email' => [
                'required',
                'email',
                'max:150'
            ],

            'pincode' => [
                'required',
                'digits:6'
            ],

            'city' => [
                'required',
                'string',
                'max:100'
            ],

            'state' => [
                'required',
                'string',
                'max:100'
            ],

            'house' => [
                'required',
                'string',
                'max:255'
            ],

            'road' => [
                'required',
                'string',
                'max:255'
            ],

            'landmark' => [
                'nullable',
                'string',
                'max:255'
            ],

            /*
        COD ONLY
        */

            'turnstile_token' => [
                'required',
                'string'
            ],

            'payment_method' => [
                'required',
                'in:cod,razorpay,payu'
            ],

            'courier_id' => [
                'required',
                'integer'
            ],

        ]);

        /*
    =====================================================
    CLOUDFLARE TURNSTILE VERIFICATION
    =====================================================
    */

        $turnstileResponse = Http::asForm()
            ->timeout(10)
            ->post(
                'https://challenges.cloudflare.com/turnstile/v0/siteverify',
                [
                    'secret' => env('TURNSTILE_SECRET_KEY'),
                    'response' => $validated['turnstile_token'],
                    'remoteip' => $request->ip(),
                ]
            );

        if (
            !$turnstileResponse->successful() ||
            !$turnstileResponse->json('success')
        ) {

            return response()->json([
                'success' => false,
                'message' => 'Security verification failed. Please try again.'
            ], 422);
        }



        /*
    =====================================================
    GET CURRENT ORDER SESSION
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );

        $paymentMethod = $validated['payment_method'];
        $printOptions = session(
            'print_options',
            []
        );


        if (
            empty($selectedIds)
        ) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Your order session has expired. Please select your files again.'
                );
        }


        /*
    =====================================================
    GET DOCUMENTS AGAIN
    =====================================================
    */

        $documents = PrintDocument::whereIn(
            'id',
            $selectedIds
        )->get();


        if (
            $documents->isEmpty()
        ) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'No files found for this order.'
                );
        }


        /*
    =====================================================
    GET PRINT PRICES FROM DATABASE
    =====================================================
    */

        $printPrices = Price::whereIn(
            'slug',
            [
                'black_white_single',
                'black_white_double',
                'color_single',
                'color_double',
            ]
        )
            ->where(
                'status',
                1
            )
            ->pluck(
                'amount',
                'slug'
            );


        /*
    =====================================================
    GET BINDING PRICES
    =====================================================
    */

        $binding = Price::where(
            'slug',
            'bindings'
        )
            ->where(
                'status',
                1
            )
            ->with([
                'childPrice' => function ($query) {

                    $query
                        ->where(
                            'status',
                            1
                        )
                        ->orderBy(
                            'id'
                        );
                }
            ])
            ->first();


        $bindingPrices = [];


        if ($binding) {

            foreach (
                $binding->childPrice
                as $bindingOption
            ) {

                $bindingPrices[$bindingOption->slug] = (float)
                $bindingOption->amount;
            }
        }


        /*
    =====================================================
    CALCULATE PRINT SUBTOTAL AGAIN
    =====================================================
    */

        $printSubtotal = 0;

        $fileBreakdown = [];


        foreach (
            $documents as $document
        ) {

            $documentId =
                (int) $document->id;


            $options =
                $printOptions[$documentId] ?? [];


            /*
        PRINT TYPE
        */

            $colorMode =
                $options['color_mode']
                ?? 'black_white';


            /*
        PRINT SIDE
        */

            $printSide =
                $options['print_side']
                ?? 'double';


            /*
        BINDING
        */

            $bindingSlug =
                $options['binding']
                ?? '';


            /*
        COPIES
        */

            $copies = max(
                1,
                (int) (
                    $options['copies']
                    ?? 1
                )
            );


            /*
        PAGE COUNT
        */

            $pages = max(
                1,
                (int) (
                    $document->pages
                    ?? 1
                )
            );


            /*
        =================================================
        RATE
        =================================================
        */

            if (
                $colorMode === 'color'
            ) {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['color_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['color_single'] ?? 0
                        );
                }
            } else {

                if (
                    $printSide === 'double'
                ) {

                    $rate =
                        (float) (
                            $printPrices['black_white_double'] ?? 0
                        );
                } else {

                    $rate =
                        (float) (
                            $printPrices['black_white_single'] ?? 0
                        );
                }
            }


            /*
        =================================================
        BINDING RATE
        =================================================
        */

            $bindingRate = 0;


            if (
                !empty($bindingSlug)
            ) {

                $bindingRate =
                    (float) (
                        $bindingPrices[$bindingSlug] ?? 0
                    );
            }


            /*
        =================================================
        PRINT COST
        =================================================
        */

            $billableSheets =
                $pages;


            $printCostPerCopy =
                $billableSheets *
                $rate;


            $oneCopyTotal =
                $printCostPerCopy +
                $bindingRate;


            $fileTotal =
                $oneCopyTotal *
                $copies;


            $printSubtotal +=
                $fileTotal;


            /*
        =================================================
        FILE BREAKDOWN
        =================================================
        */

            $fileBreakdown[] = [

                'id' =>
                $documentId,

                'name' =>
                (string)
                $document->original_name,

                'pages' =>
                $pages,

                'color_mode' =>
                (string)
                $colorMode,

                'print_side' =>
                (string)
                $printSide,

                'binding' =>
                (string)
                $bindingSlug,

                'page_size' =>
                (string) (
                    $options['page_size']
                    ?? 'a4_75'
                ),

                'orientation' =>
                (string) (
                    $options['orientation']
                    ?? 'portrait'
                ),

                'copies' =>
                $copies,

                'rate' =>
                $rate,

                'billable_sheets' =>
                $billableSheets,

                'print_cost_per_copy' =>
                round(
                    $printCostPerCopy,
                    2
                ),

                'binding_rate' =>
                $bindingRate,

                'total' =>
                round(
                    $fileTotal,
                    2
                ),

            ];
        }


        /*
    =====================================================
    SHIPPING COURIERS FROM SESSION
    =====================================================
    */

        $shippingCouriers = session(
            'checkout_shipping_couriers',
            []
        );


        /*
    =====================================================
    MAKE SURE SESSION DATA IS ARRAY
    =====================================================
    */

        if (
            !is_array($shippingCouriers)
        ) {

            $shippingCouriers = [];
        }


        /*
    =====================================================
    FIND SELECTED COURIER
    =====================================================
    */

        $requestedCourierId =
            (string)
            $request->courier_id;


        $selectedCourier = null;


        foreach (
            $shippingCouriers
            as $courier
        ) {

            if (
                !is_array($courier)
            ) {

                continue;
            }


            $sessionCourierId =
                $courier['courier_id']
                ?? null;


            /*
        If somehow courier_id itself
        is an array, normalize it.
        */

            if (
                is_array($sessionCourierId)
            ) {

                $sessionCourierId =
                    $sessionCourierId['id']
                    ?? $sessionCourierId['courier_id']
                    ?? null;
            }


            if (
                $sessionCourierId !== null
                &&
                (string)
                $sessionCourierId
                ===
                $requestedCourierId
            ) {

                $selectedCourier =
                    $courier;

                break;
            }
        }


        /*
    =====================================================
    COURIER VALIDATION
    =====================================================
    */

        if (
            !is_array($selectedCourier)
        ) {

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please select a valid courier.'
                );
        }


        /*
    =====================================================
    NORMALIZE COURIER ID
    =====================================================
    */

        $courierId =
            $selectedCourier['courier_id'] ?? null;


        if (
            is_array($courierId)
        ) {

            $courierId =
                $courierId['id']
                ?? $courierId['courier_id']
                ?? null;
        }


        /*
    =====================================================
    NORMALIZE COURIER NAME
    =====================================================
    */

        $courierName =
            $selectedCourier['courier_name'] ?? 'Courier';


        if (
            is_array($courierName)
        ) {

            $courierName =
                $courierName['name']
                ?? $courierName['courier_name']
                ?? 'Courier';
        }


        $courierName =
            (string)
            $courierName;


        /*
    =====================================================
    DELIVERY CHARGE
    =====================================================
    */

        $deliveryCharge =
            $selectedCourier['total_charges'] ?? 0;


        if (
            is_array($deliveryCharge)
        ) {

            $deliveryCharge =
                $deliveryCharge['total']
                ?? $deliveryCharge['amount']
                ?? 0;
        }


        $deliveryCharge =
            (float)
            $deliveryCharge;


        /*
    =====================================================
    DELIVERY ESTIMATE
    =====================================================
    */

        $deliveryEstimate =
            $selectedCourier['estimated_delivery'] ?? '';


        if (
            is_array($deliveryEstimate)
        ) {

            $deliveryEstimate =
                $deliveryEstimate['value']
                ?? $deliveryEstimate['date']
                ?? $deliveryEstimate['estimated_delivery']
                ?? '';
        }


        $deliveryEstimate =
            (string)
            $deliveryEstimate;


        /*
    =====================================================
    WEIGHT
    =====================================================
    */

        $weight =
            session(
                'checkout_weight',
                0
            );


        if (
            is_array($weight)
        ) {

            $weight =
                $weight['weight']
                ?? $weight['value']
                ?? 0;
        }


        $weight =
            (float)
            $weight;


        /*
    =====================================================
    HANDLING CHARGE
    =====================================================
    */

        $handlingCharge = 0;


        /*
    =====================================================
    GRAND TOTAL
    =====================================================
    */

        $grandTotal =
            $printSubtotal +
            $deliveryCharge +
            $handlingCharge;


        /*
    =====================================================
    ITEMS JSON
    =====================================================
    */

        $itemsJson =
            json_encode(
                $fileBreakdown,
                JSON_UNESCAPED_UNICODE
            );


        if (
            $itemsJson === false
        ) {

            $itemsJson = '[]';
        }


        /*
    =====================================================
    CREATE ORDER
    =====================================================
    */

        $order = DB::transaction(
            function () use (
                $validated,
                $mobile,
                $fileBreakdown,
                $itemsJson,
                $courierId,
                $courierName,
                $deliveryCharge,
                $deliveryEstimate,
                $weight,
                $printSubtotal,
                $handlingCharge,
                $paymentMethod,
                $grandTotal
            ) {

                /*
            Generate unique order number
            */

                do {

                    $orderNumber =
                        'OF' .
                        now()->format('ymd') .
                        strtoupper(
                            Str::random(6)
                        );
                } while (
                    Order::where(
                        'order_number',
                        $orderNumber
                    )->exists()
                );


                /*
            =================================================
            CREATE
            =================================================
            */

                return Order::create([

                    'order_number' =>
                    $orderNumber,


                    /*
                CUSTOMER
                */

                    'mobile' =>
                    (string)
                    $mobile,

                    'full_name' =>
                    (string)
                    $validated['full_name'],

                    'email' =>
                    (string)
                    $validated['email'],


                    /*
                ADDRESS
                */

                    'pincode' =>
                    (string)
                    $validated['pincode'],

                    'city' =>
                    (string)
                    $validated['city'],

                    'state' =>
                    (string)
                    $validated['state'],

                    'house' =>
                    (string)
                    $validated['house'],

                    'road' =>
                    (string)
                    $validated['road'],

                    'landmark' =>
                    isset(
                        $validated['landmark']
                    )
                        ? (string)
                        $validated['landmark']
                        : null,


                    /*
                SHIPPING
                */

                    'courier_id' =>
                    $courierId !== null
                        ? (string)
                        $courierId
                        : null,

                    'courier_name' =>
                    $courierName,

                    'shipping_charge' =>
                    round(
                        $deliveryCharge,
                        2
                    ),

                    'delivery_estimate' =>
                    $deliveryEstimate,

                    'weight' =>
                    $weight,


                    /*
                PRICING
                */

                    'print_subtotal' =>
                    round(
                        $printSubtotal,
                        2
                    ),

                    'handling_charge' =>
                    0,

                    'grand_total' =>
                    round(
                        $grandTotal,
                        2
                    ),


                    /*
                PAYMENT
                */

                    'payment_method' => $paymentMethod,

                    'payment_status' =>
                    'pending',


                    /*
                RAZORPAY
                FUTURE USE
                */

                    'razorpay_order_id' =>
                    null,

                    'razorpay_payment_id' =>
                    null,

                    'razorpay_signature' =>
                    null,


                    /*
                ORDER ITEMS

                JSON string so it cannot cause
                Array to string conversion.
                */

                    'items' =>
                    $itemsJson,


                    /*
                ORDER STATUS
                */

                    'status' =>
                    $paymentMethod === 'payu'
                        ? 'payment_pending'
                        : 'placed',

                ]);
            }
        );
        /*
        =====================================================
        PAYU CHECKOUT PLUS TRANSACTION
        =====================================================
        */

        if ($validated['payment_method'] === 'payu') {

            $payuKey = env('PAYU_MERCHANT_KEY');
            $payuSalt = env('PAYU_MERCHANT_SALT');

            if (!$payuKey || !$payuSalt) {

                $order->update([
                    'status' => 'payment_failed',
                    'payment_status' => 'failed',
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'PayU configuration is missing.'
                ], 500);
            }

            $payuAmount = number_format(
                (float) $grandTotal,
                2,
                '.',
                ''
            );

            /*
            Our order number is also the PayU txnid, so the PayU
            response can be mapped back to our existing orders
            without adding another database column.
            */
            $payuTxnId = $order->order_number;

            $payuProductInfo =
                'PrintKIDukan Order ' . $order->order_number;

            $payuFirstName =
                trim((string) $validated['full_name']);

            /*
            Regular PayU payment hash:
            key|txnid|amount|productinfo|firstname|email|
            udf1|udf2|udf3|udf4|udf5||||||SALT
            */
            $payuHashString =
                $payuKey .
                '|' . $payuTxnId .
                '|' . $payuAmount .
                '|' . $payuProductInfo .
                '|' . $payuFirstName .
                '|' . $validated['email'] .
                '|||||||||||' .
                $payuSalt;

            $payuHash = strtolower(
                hash('sha512', $payuHashString)
            );

            /*
            Salt is NEVER returned to JavaScript.
            */
            return response()->json([
                'success' => true,
                'payment_gateway' => 'payu',

                'payu' => [
                    'key' => $payuKey,
                    'hash' => $payuHash,
                    'txnid' => $payuTxnId,
                    'amount' => $payuAmount,
                    'firstname' => $payuFirstName,
                    'email' => (string) $validated['email'],
                    'phone' => (string) $mobile,
                    'productinfo' => $payuProductInfo,

                    /*
                    Checkout Plus expects surl/furl in the
                    transaction object. The frontend will use
                    responseHandler() to call verifyPayU().
                    */
                    'surl' => url('/payment/payu/success'),
                    'furl' => url('/payment/payu/failure'),
                ],

                'order_number' => $order->order_number,
            ]);
        }

        /*
    =====================================================
    CLEAR ORDER SESSION
    =====================================================
    */

        session()->forget([

            'upload_selected_document_ids',

            'print_options',

            'checkout_shipping_couriers',

            'checkout_weight',

        ]);


        /*
    =====================================================
    SUCCESS
    =====================================================
    */

        return redirect()
            ->route(
                'order.success',
                $order->order_number
            )
            ->with(
                'success',
                'Your order has been placed successfully.'
            );
    }
    public function verifyRazorpay(Request $request)
    {
        $mobile =
            $request->cookie('loggedin_number');


        if (!$mobile) {

            return response()->json([

                'success' => false,

                'message' =>
                'Please login again.'

            ], 401);
        }


        $validated =
            $request->validate([

                'order_number' =>
                'required|string',

                'razorpay_payment_id' =>
                'required|string',

                'razorpay_order_id' =>
                'required|string',

                'razorpay_signature' =>
                'required|string',

            ]);


        /*
    =====================================================
    GET OUR ORDER
    =====================================================
    */

        $order =
            Order::where(
                'order_number',
                $validated['order_number']
            )
            ->where(
                'mobile',
                $mobile
            )
            ->first();


        if (!$order) {

            return response()->json([

                'success' => false,

                'message' =>
                'Order not found.'

            ], 404);
        }


        /*
    =====================================================
    SECURITY CHECK
    =====================================================
    */

        if (
            $order->payment_method !==
            'razorpay'
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                'Invalid payment method.'

            ], 400);
        }


        /*
    IMPORTANT:
    Use OUR DATABASE Razorpay Order ID.
    Do NOT trust browser order ID.
    */

        if (
            $order->razorpay_order_id !==
            $validated['razorpay_order_id']
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                'Invalid Razorpay order.'

            ], 400);
        }


        /*
    =====================================================
    SIGNATURE VERIFY
    =====================================================
    */

        $generatedSignature =
            hash_hmac(

                'sha256',

                $order->razorpay_order_id .
                    '|' .
                    $validated['razorpay_payment_id'],

                config(
                    'services.razorpay.key_secret'
                )

            );


        if (
            !hash_equals(
                $generatedSignature,
                $validated['razorpay_signature']
            )
        ) {

            $order->update([

                'payment_status' =>
                'failed',

                'status' =>
                'payment_failed',

            ]);


            return response()->json([

                'success' => false,

                'message' =>
                'Payment verification failed.'

            ], 400);
        }


        /*
    =====================================================
    PAYMENT VERIFIED
    =====================================================
    */

        $order->update([

            'razorpay_payment_id' =>
            $validated['razorpay_payment_id'],

            'razorpay_signature' =>
            $validated['razorpay_signature'],

            'payment_status' =>
            'paid',

            'status' =>
            'placed',

        ]);


        /*
    =====================================================
    CLEAR SESSION
    =====================================================
    */

        session()->forget([

            'upload_selected_document_ids',

            'print_options',

            'checkout_shipping_couriers',

            'checkout_weight',

        ]);


        return response()->json([

            'success' =>
            true,

            'redirect' =>
            route(
                'order.success',
                $order->order_number
            ),

        ]);
    }
    /**
     * Verify a PayU Checkout Plus response.
     *
     * The browser response is not trusted by itself:
     * reverse-hash validation + amount/order checks + PayU
     * server-side verify_payment reconciliation are performed
     * before the order is marked paid.
     */
    public function verifyPayU(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return response()->json([
                'success' => false,
                'message' => 'Please login again.'
            ], 401);
        }

        $validated = $request->validate([
            'txnid' => 'required|string|max:100',
            'status' => 'required|string|max:50',
            'hash' => 'required|string|max:128',
            'amount' => 'required|numeric|min:0',
            'key' => 'required|string|max:100',
            'firstname' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:150',
            'productinfo' => 'nullable|string|max:255',
            'mihpayid' => 'nullable|string|max:100',
            'udf1' => 'nullable|string|max:255',
            'udf2' => 'nullable|string|max:255',
            'udf3' => 'nullable|string|max:255',
            'udf4' => 'nullable|string|max:255',
            'udf5' => 'nullable|string|max:255',
        ]);

        $payuKey = env('PAYU_MERCHANT_KEY');
        $payuSalt = env('PAYU_MERCHANT_SALT');

        if (!$payuKey || !$payuSalt) {
            return response()->json([
                'success' => false,
                'message' => 'PayU configuration is missing.'
            ], 500);
        }

        $order = Order::where(
            'order_number',
            $validated['txnid']
        )
            ->where(
                'mobile',
                $mobile
            )
            ->first();

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.'
            ], 404);
        }

        if ($order->payment_method !== 'payu') {
            return response()->json([
                'success' => false,
                'message' => 'Invalid payment method.'
            ], 400);
        }

        if (!hash_equals(
            (string) $payuKey,
            (string) $validated['key']
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid PayU merchant key.'
            ], 400);
        }

        $responseAmount = number_format(
            (float) $validated['amount'],
            2,
            '.',
            ''
        );

        $orderAmount = number_format(
            (float) $order->grand_total,
            2,
            '.',
            ''
        );

        if ($responseAmount !== $orderAmount) {
            return response()->json([
                'success' => false,
                'message' => 'Payment amount mismatch.'
            ], 400);
        }

        /*
        PayU regular reverse hash:
        SALT|status||||||udf5|udf4|udf3|udf2|udf1|
        email|firstname|productinfo|amount|txnid|key
        */
        $reverseHashString =
            $payuSalt .
            '|' . $validated['status'] .
            '||||||' .
            '|||||' .
            ($validated['email'] ?? '') .
            '|' .
            ($validated['firstname'] ?? '') .
            '|' .
            ($validated['productinfo'] ?? '') .
            '|' .
            $responseAmount .
            '|' .
            $validated['txnid'] .
            '|' .
            $payuKey;

        if ($request->filled('additional_charges')) {
            $reverseHashString =
                $request->input('additional_charges') .
                '|' .
                $reverseHashString;
        }

        $generatedReverseHash = strtolower(
            hash('sha512', $reverseHashString)
        );

        if (!hash_equals(
            strtolower((string) $validated['hash']),
            $generatedReverseHash
        )) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed.'
            ], 400);
        }

        $payuStatus = strtolower(
            trim((string) $validated['status'])
        );

        if ($payuStatus !== 'success') {

            $order->update([
                'payment_status' =>
                $payuStatus === 'pending'
                    ? 'pending'
                    : 'failed',

                'status' =>
                $payuStatus === 'pending'
                    ? 'payment_pending'
                    : 'payment_failed',
            ]);

            return response()->json([
                'success' => false,
                'payment_status' => $payuStatus,
                'message' =>
                $payuStatus === 'pending'
                    ? 'Payment is still pending.'
                    : 'Payment was not successful.'
            ]);
        }

        /*
        Server-side reconciliation using PayU Verify Payment API.
        */
        $verifyHash = strtolower(
            hash(
                'sha512',
                $payuKey .
                    '|verify_payment|' .
                    $validated['txnid'] .
                    '|' .
                    $payuSalt
            )
        );

        $verifyResponse = Http::asForm()
            ->timeout(15)
            ->post(
                'https://info.payu.in/merchant/postservice.php?form=2',
                [
                    'key' => $payuKey,
                    'command' => 'verify_payment',
                    'var1' => $validated['txnid'],
                    'hash' => $verifyHash,
                ]
            );

        if (!$verifyResponse->successful()) {
            return response()->json([
                'success' => false,
                'message' =>
                'Unable to verify payment with PayU. Please try again.'
            ], 502);
        }

        $verifyData = $verifyResponse->json();

        $transaction = data_get(
            $verifyData,
            'transaction_details.' . $validated['txnid']
        );

        if (!is_array($transaction)) {
            return response()->json([
                'success' => false,
                'message' =>
                'PayU transaction could not be verified.'
            ], 422);
        }

        $verifiedStatus = strtolower(
            trim((string) (
                $transaction['status']
                ?? $transaction['unmappedstatus']
                ?? ''
            ))
        );

        /*
        PayU Verify Payment returns the paid amount as "amt".
        Keep transaction_amount/net_amount_debit as safe fallbacks.
        */
        $verifiedAmount = number_format(
            (float) (
                $transaction['amt']
                ?? $transaction['transaction_amount']
                ?? $transaction['net_amount_debit']
                ?? 0
            ),
            2,
            '.',
            ''
        );

        if (
            $verifiedStatus !== 'success' ||
            $verifiedAmount !== $orderAmount
        ) {


            $order->update([
                'payment_status' => 'failed',
                'status' => 'payment_failed',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'PayU payment could not be confirmed.'
            ], 422);
        }

        /*
        PayU payment ID (mihpayid) is stored in the existing
        razorpay_payment_id column so no database migration is needed.
        The UI should treat this column as the generic Transaction ID.
        */
        $transactionId =
            $transaction['mihpayid']
            ?? $validated['mihpayid']
            ?? null;

        if (!$transactionId) {
            return response()->json([
                'success' => false,
                'message' => 'PayU transaction ID was not received.'
            ], 422);
        }

        /*
        =====================================================
        SAVE PAYU PAYMENT DETAILS
        =====================================================

        Existing Razorpay columns are intentionally reused so
        no database migration is required.

        DB mapping:
        razorpay_payment_id -> PayU Transaction ID (mihpayid)
        razorpay_order_id   -> Bank Reference ID (bank_ref_num)
        razorpay_signature  -> PayU response hash
        */

        $bankReferenceId =
            $transaction['bank_ref_num']
            ?? null;

        $order->update([
            'razorpay_payment_id' =>
            (string) $transactionId,

            'razorpay_order_id' =>
            $bankReferenceId !== null
                ? (string) $bankReferenceId
                : null,

            'razorpay_signature' =>
            (string) (
                $validated['hash'] ?? ''
            ),

            'payment_status' =>
            'paid',

            'status' =>
            'placed',
        ]);

        session()->forget([
            'upload_selected_document_ids',
            'print_options',
            'checkout_shipping_couriers',
            'checkout_weight',
        ]);

        return response()->json([
            'success' => true,
            'redirect' => route(
                'order.success',
                $order->order_number
            ),
        ]);
    }

    /**
     * Safe fallback for PayU surl/furl.
     *
     * Checkout Plus normally returns the response to responseHandler().
     */
    public function payuCallback(Request $request)
    {
        if (!$request->input('txnid')) {
            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Payment response was incomplete.'
                );
        }

        return redirect()
            ->route('checkout')
            ->with(
                'error',
                'Please complete the payment verification.'
            );
    }

    public function success($orderNumber)
    {
        /*
    =====================================================
    LOGIN CHECK
    =====================================================
    */

        $mobile = request()->cookie(
            'loggedin_number'
        );


        if (!$mobile) {

            return redirect()
                ->route('upload')
                ->with(
                    'error',
                    'Please login to view your order.'
                );
        }


        /*
    =====================================================
    FIND ORDER BY ORDER NUMBER
    =====================================================
    */

        $order = Order::where(
            'order_number',
            $orderNumber
        )->first();


        /*
    =====================================================
    ORDER NOT FOUND
    =====================================================
    */

        if (!$order) {

            abort(404);
        }


        /*
    =====================================================
    OWNERSHIP CHECK
    =====================================================
    */

        if (
            (string) $order->mobile !==
            (string) $mobile
        ) {

            abort(404);
        }


        /*
    =====================================================
    SUCCESS PAGE
    =====================================================
    */

        return view(
            'front.order-success',
            compact('order')
        );
    }
    public function calculateShipping(Request $request)
    {
        $request->validate([
            'delivery_pincode' => [
                'required',
                'digits:6'
            ],
        ]);


        /*
    =====================================================
    SHIPMOZO RATE CALCULATOR
    =====================================================
    */


        /*
    =====================================================
    CALCULATE ACTUAL SHIPMENT WEIGHT
    =====================================================
    */

        $selectedIds = session(
            'upload_selected_document_ids',
            []
        );


        $printOptions = session(
            'print_options',
            []
        );


        $documents = PrintDocument::whereIn(
            'id',
            $selectedIds
        )->get([
            'id',
            'pages'
        ]);


        $totalPaperWeightGrams = 0;


        foreach ($documents as $document) {

            $documentId =
                (int) $document->id;


            $options =
                $printOptions[$documentId]
                ?? [];


            /*
        -------------------------------------------------
        PAGES
        -------------------------------------------------
        */

            $pages =
                max(
                    1,
                    (int) (
                        $document->pages
                        ?? 1
                    )
                );


            /*
        -------------------------------------------------
        COPIES
        -------------------------------------------------
        */

            $copies =
                max(
                    1,
                    (int) (
                        $options['copies']
                        ?? 1
                    )
                );


            /*
        -------------------------------------------------
        SINGLE / DOUBLE
        -------------------------------------------------

        Double:
        2 pages per physical sheet

        Single:
        1 page per physical sheet
        -------------------------------------------------
        */

            $printSide =
                $options['print_side']
                ?? 'double';


            $sheets =
                $printSide === 'double'

                ? (int) ceil(
                    $pages / 2
                )

                : $pages;


            /*
        -------------------------------------------------
        GSM
        -------------------------------------------------

        Existing values:

        a4_75
        a4_80
        a4_100
        -------------------------------------------------
        */

            $pageSize =
                $options['page_size']
                ?? 'a4_75';


            preg_match(
                '/_(75|80|100)$/',
                $pageSize,
                $gsmMatch
            );


            $gsm =
                isset($gsmMatch[1])
                ? (int) $gsmMatch[1]
                : 75;


            /*
        -------------------------------------------------
        A4 PAPER WEIGHT

        75 GSM  = 4.68g
        80 GSM  = 4.99g
        100 GSM = 6.24g
        -------------------------------------------------
        */

            $sheetWeights = [

                75 => 4.68,

                80 => 4.99,

                100 => 6.24,

            ];


            $sheetWeight =
                $sheetWeights[$gsm]
                ?? 4.68;


            /*
        -------------------------------------------------
        DOCUMENT PAPER WEIGHT
        -------------------------------------------------
        */

            $totalPaperWeightGrams +=
                $sheets *
                $sheetWeight *
                $copies;
        }


        /*
    =====================================================
    POLYBAG + SHIPPING LABEL
    =====================================================

    Polybag = approximately 15g
    Label   = approximately 5g

    Total = 20g
    =====================================================
    */

        $packagingWeight =
            20;


        /*
    =====================================================
    FINAL WEIGHT
    =====================================================
    */

        $totalWeightGrams =
            $totalPaperWeightGrams +
            $packagingWeight;


        /*
    =====================================================
    SHIPMOZO MINIMUM WEIGHT
    =====================================================
    */

        $weight =
            max(
                500,
                (int) ceil(
                    $totalWeightGrams
                )
            );


        /*
    =====================================================
    SHIPMOZO API
    =====================================================
    */

        $response = Http::withHeaders([

            'public-key' =>
            config(
                'services.shipmozo.public_key'
            ),

            'private-key' =>
            config(
                'services.shipmozo.private_key'
            ),

            'Accept' =>
            'application/json',

            'Content-Type' =>
            'application/json',

        ])->post(

            rtrim(
                config(
                    'services.shipmozo.base_url'
                ),
                '/'
            ) .
                '/rate-calculator',

            [

                'order_id' =>
                '',

                'pickup_pincode' =>
                config(
                    'services.shipmozo.pickup_pincode'
                ),

                'delivery_pincode' =>
                $request->delivery_pincode,

                'payment_type' =>
                'PREPAID',

                'shipment_type' =>
                'FORWARD',

                'order_amount' =>
                100,

                'type_of_package' =>
                'SPS',

                'rov_type' =>
                'ROV_OWNER',

                'cod_amount' =>
                '',

                'weight' =>
                $weight,

                'dimensions' => [

                    [
                        'no_of_box' =>
                        '1',

                        'length' =>
                        '30',

                        'width' =>
                        '22',

                        'height' =>
                        '5',
                    ]

                ],

            ]
        );


        /*
    =====================================================
    API HTTP ERROR
    =====================================================
    */

        if (
            !$response->successful()
        ) {

            return response()->json([

                'success' =>
                false,

                'message' =>
                'Unable to calculate shipping charges.',

                'data' =>
                $response->json(),

            ], 422);
        }


        $apiResponse =
            $response->json();


        /*
    =====================================================
    SHIPMOZO RESULT CHECK
    =====================================================
    */

        if (
            ($apiResponse['result'] ?? '0') !== '1'
        ) {

            return response()->json([

                'success' =>
                false,

                'message' =>
                $apiResponse['message']
                    ?? 'Shipping calculation failed.',

                'data' =>
                [],

            ], 422);
        }


        /*
    =====================================================
    GET COURIERS
    =====================================================
    */

        $couriers =
            $apiResponse['data']
            ?? [];


        /*
    =====================================================
    NORMALIZE COURIERS
    =====================================================
    */

        $normalizedCouriers = [];


        foreach (
            $couriers as $courier
        ) {

            $courierId =
                $courier['id']
                ?? null;


            $courierName =
                $courier['name']
                ?? 'Courier';


            $totalCharges =
                (float) (
                    $courier['total_charges']
                    ?? 0
                );


            /*
        -------------------------------------------------
        IGNORE INVALID COURIER
        -------------------------------------------------
        */

            if (
                empty($courierId) ||
                $totalCharges <= 0
            ) {

                continue;
            }


            $normalizedCouriers[] = [

                'courier_id' =>
                $courierId,

                'courier_name' =>
                $courierName,

                'courier_type' =>
                $courier['courier_type']
                    ?? '',


                /*
            -------------------------------------------------
            PRICE
            -------------------------------------------------
            */

                'shipping_charges' =>
                (float) (
                    $courier['shipping_charges']
                    ?? 0
                ),

                'gst' =>
                (float) (
                    $courier['gst']
                    ?? 0
                ),

                'total_charges' =>
                $totalCharges,


                /*
            -------------------------------------------------
            DELIVERY
            -------------------------------------------------
            */

                'estimated_delivery' =>
                $courier['estimated_delivery']
                    ?? '',

            ];
        }


        /*
    =====================================================
    NO VALID COURIERS
    =====================================================
    */

        if (
            empty($normalizedCouriers)
        ) {

            return response()->json([

                'success' =>
                false,

                'message' =>
                'No valid courier service available.',

                'data' =>
                [],

            ], 422);
        }


        /*
    =====================================================
    REMOVE DUPLICATE COURIER COMPANIES
    =====================================================

    Same company may come multiple times.

    Example:

    XpressBees ₹210.04
    XpressBees ₹211.22

    Keep only cheapest XpressBees.
    =====================================================
    */

        $uniqueCouriers = [];


        foreach (
            $normalizedCouriers as $courier
        ) {

            $courierName =
                strtolower(
                    trim(
                        $courier['courier_name']
                            ?? ''
                    )
                );


            if (
                $courierName === ''
            ) {

                continue;
            }


            $price =
                (float) (
                    $courier['total_charges']
                    ?? 0
                );


            /*
        -------------------------------------------------
        FIRST COURIER
        -------------------------------------------------
        */

            if (
                !isset(
                    $uniqueCouriers[$courierName]
                )
            ) {

                $uniqueCouriers[$courierName] =
                    $courier;

                continue;
            }


            /*
        -------------------------------------------------
        SAME COMPANY

        Keep cheapest.
        -------------------------------------------------
        */

            $existingPrice =
                (float) (
                    $uniqueCouriers[$courierName]['total_charges']
                    ?? 0
                );


            if (
                $price < $existingPrice
            ) {

                $uniqueCouriers[$courierName] =
                    $courier;
            }
        }


        /*
    =====================================================
    FINAL UNIQUE COURIER LIST
    =====================================================
    */

        $normalizedCouriers =
            array_values(
                $uniqueCouriers
            );


        if (
            empty($normalizedCouriers)
        ) {

            return response()->json([

                'success' =>
                false,

                'message' =>
                'No valid courier service available.',

                'data' =>
                [],

            ], 422);
        }


        /*
    =====================================================
    SORT BY LOWEST PRICE
    =====================================================
    */

        usort(
            $normalizedCouriers,
            function (
                $a,
                $b
            ) {

                return
                    $a['total_charges']
                    <=>
                    $b['total_charges'];
            }
        );


        /*
    =====================================================
    ONLY LOWEST 3 COURIERS
    =====================================================
    */

        $selectedCouriers =
            array_slice(
                $normalizedCouriers,
                0,
                3
            );


        /*
    =====================================================
    CHEAPEST COURIER
    =====================================================
    */

        $cheapestCourierId =
            $selectedCouriers[0]['courier_id']
            ?? null;


        /*
    =====================================================
    ADD CHEAPEST BADGE
    =====================================================
    */

        foreach (
            $selectedCouriers
            as &$courier
        ) {

            $courier['is_cheapest'] =
                (string)
                $courier['courier_id']
                ===
                (string)
                $cheapestCourierId;
        }


        unset($courier);
        /*
=====================================================
TEMPORARY FREE SHIPPING
=====================================================
*/

        foreach ($selectedCouriers as &$courier) {

            $courier['shipping_charges'] = 0;
            $courier['gst'] = 0;
            $courier['total_charges'] = 0;
        }

        unset($courier);

        /*
    =====================================================
    FINAL RESPONSE
    =====================================================
    */
        session()->put(
            'checkout_shipping_couriers',
            array_values(
                $selectedCouriers
            )
        );

        session()->put(
            'checkout_weight',
            $weight
        );

        return response()->json([
            'success' => true,
            'message' => 'Shipping charges calculated successfully.',
            'couriers' => array_values(
                $selectedCouriers
            ),
        ]);
    }
    public function myOrders(Request $request)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return redirect()->route('upload');
        }

        $orders = Order::where('mobile', $mobile)
            ->latest('id')
            ->get();

        return view('front.my-orders', compact('orders'));
    }


    public function myOrderView(Request $request, Order $order)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return redirect()->route('upload');
        }

        /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    | URL ma bijano order ID nakhi ne order joi na shake.
    */

        if ($order->mobile != $mobile) {
            abort(403);
        }

        return view('front.my-order-view', compact('order'));
    }


    public function cancelOrder(Request $request, Order $order)
    {
        $mobile = $request->cookie('loggedin_number');

        if (!$mobile) {
            return redirect()->route('upload');
        }

        /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    */

        if ($order->mobile != $mobile) {
            abort(403);
        }

        /*
    |--------------------------------------------------------------------------
    | Cancellation
    |--------------------------------------------------------------------------
    */

        $cancelableStatuses = [
            'placed',
            'confirmed',
            'processing'
        ];

        if (!in_array(strtolower($order->status), $cancelableStatuses)) {

            return back()->with(
                'error',
                'This order can no longer be cancelled.'
            );
        }

        $order->status = 'cancelled';

        $order->save();

        return redirect()
            ->route('my-orders.view', $order->id)
            ->with('success', 'Order cancelled successfully.');
    }
}
