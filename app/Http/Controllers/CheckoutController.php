<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintDocument;
use App\Models\Price;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {


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
    FINAL RESPONSE
    =====================================================
    */

        return response()->json([

            'success' =>
            true,

            'message' =>
            'Shipping charges calculated successfully.',

            'couriers' =>
            array_values(
                $selectedCouriers
            ),

        ]);
    }
}
