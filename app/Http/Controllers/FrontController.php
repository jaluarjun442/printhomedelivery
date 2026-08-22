<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use App\Models\Products;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\Price;
use Illuminate\Support\Facades\Http;

class FrontController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logout(Request $request)
    {
        /*
    |--------------------------------------------------------------------------
    | Clear Laravel session
    |--------------------------------------------------------------------------
    */

        $request->session()->forget([
            'upload_selected_document_ids',
            'print_options',
            'checkout',
            'shipping',
            'selected_courier',
        ]);


        /*
    |--------------------------------------------------------------------------
    | Completely invalidate session
    |--------------------------------------------------------------------------
    */

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        /*
    |--------------------------------------------------------------------------
    | Redirect to home
    |--------------------------------------------------------------------------
    */

        return redirect()
            ->route('home')
            ->with(
                'success',
                'You have been logged out successfully.'
            )
            ->withCookie(
                cookie()->forget('loggedin_number')
            );
    }
    public function index(Request $request)
    {
        $data = [];

        $blogs = Blogs::where('status', 1)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('welcome', compact('data', 'blogs'));
    }
    public function page($page)
    {
        $store_data = [];
        $view = 'page.' . $page;
        if (view()->exists($view)) {
            $store_id = store_id();
            $store_data = Store::where('id', $store_id)->first();
        } else {
            $view = '404';
        }
        return view($view, compact('store_data'));
    }
    public function calculator(Request $request)
    {
        $data = [];
        return view('front.calculator', compact('data'));
    }
    public function calculateCalculatorPrice(Request $request)
    {
        /*
    =====================================================
    VALIDATION
    =====================================================
    */

        $request->validate([

            'total_pages' => [
                'required',
                'integer',
                'min:1'
            ],

            'delivery_pincode' => [
                'required',
                'digits:6'
            ],

            'print_type' => [
                'required',
                'in:bw,color'
            ],

            'paper_gsm' => [
                'required',
                'in:75,80,100'
            ],

            'binding_type' => [
                'required',
                'string',
            ],

            'copies' => [
                'required',
                'integer',
                'min:1'
            ],

            'two_sided' => [
                'nullable',
                'boolean'
            ],

        ]);


        /*
    =====================================================
    INPUTS
    =====================================================
    */

        $pages =
            (int) $request->total_pages;


        $pincode =
            $request->delivery_pincode;


        $printType =
            $request->print_type;


        $gsm =
            (int) $request->paper_gsm;


        $bindingType =
            $request->binding_type;


        $copies =
            max(
                1,
                (int) $request->copies
            );


        $twoSided =
            (int) $request->two_sided === 1;


        /*
    =====================================================
    PRINT PRICE
    =====================================================
    */

        $printPrices =
            Price::whereIn(
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
    SELECT PRINT RATE
    =====================================================
    */

        if ($printType === 'color') {

            $rate = $twoSided

                ? (float) (
                    $printPrices['color_double'] ?? 0
                )

                : (float) (
                    $printPrices['color_single'] ?? 0
                );
        } else {

            $rate = $twoSided

                ? (float) (
                    $printPrices['black_white_double'] ?? 0
                )

                : (float) (
                    $printPrices['black_white_single'] ?? 0
                );
        }


        /*
    =====================================================
    BINDING PRICE
    =====================================================
    */

        $bindingPrice = 0;


        if (
            $bindingType !== 'none'
        ) {

            $binding =
                Price::where(
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
                            ->orderBy('id');
                    }
                ])
                ->first();


            if ($binding) {

                foreach (
                    $binding->childPrice
                    as $option
                ) {

                    if (
                        $option->slug ===
                        $bindingType
                    ) {

                        $bindingPrice =
                            (float)
                            $option->amount;

                        break;
                    }
                }
            }
        }


        /*
    =====================================================
    PRINTING SUBTOTAL
    =====================================================
    */

        $printingCost =
            $pages *
            $rate *
            $copies;


        $bindingCost =
            $bindingPrice *
            $copies;


        $printingSubtotal =
            $printingCost +
            $bindingCost;


        /*
    =====================================================
    PAPER WEIGHT
    =====================================================

    A4 sheet approximate weight:

    75 GSM  = 4.68g
    80 GSM  = 4.99g
    100 GSM = 6.24g

    Double-sided means:
    200 pages = 100 physical sheets.

    =====================================================
    */

        $sheetWeights = [

            75  => 4.68,

            80  => 4.99,

            100 => 6.24,

        ];


        $sheetWeight =
            $sheetWeights[$gsm];


        $sheets =
            $twoSided

            ? (int) ceil(
                $pages / 2
            )

            : $pages;


        /*
    =====================================================
    PAPER WEIGHT
    =====================================================
    */

        $paperWeightGrams =
            $sheets *
            $sheetWeight *
            $copies;


        /*
    =====================================================
    PACKAGING WEIGHT
    =====================================================
    */

        $packagingWeight =
            20;


        /*
    =====================================================
    TOTAL WEIGHT
    =====================================================
    */

        $totalWeightGrams =
            $paperWeightGrams +
            $packagingWeight;


        $weightKg =
            round(
                $totalWeightGrams / 1000,
                3
            );


        /*
    =====================================================
    MINIMUM SHIPPING WEIGHT
    =====================================================
    */

        $weightGrams =
            max(
                500,
                (int) ceil(
                    $totalWeightGrams
                )
            );


        /*
    =====================================================
    SHIPMOZO
    =====================================================
    */

        try {

            $shipmozoResponse =
                Http::withHeaders([

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

                        'order_id' => '',

                        'pickup_pincode' =>
                        config(
                            'services.shipmozo.pickup_pincode'
                        ),

                        'delivery_pincode' =>
                        $pincode,

                        'payment_type' =>
                        'PREPAID',

                        'shipment_type' =>
                        'FORWARD',

                        'order_amount' =>
                        max(
                            1,
                            round(
                                $printingSubtotal,
                                2
                            )
                        ),

                        'type_of_package' =>
                        'SPS',

                        'rov_type' =>
                        'ROV_OWNER',

                        'cod_amount' =>
                        '',

                        'weight' =>
                        $weightGrams,

                        'dimensions' => [

                            [
                                'no_of_box' =>
                                '1',

                                'length' =>
                                '30',

                                'width' =>
                                '22',

                                'height' =>
                                '3',
                            ]

                        ],

                    ]
                );


            $shipmozoData =
                $shipmozoResponse->json();


            /*
        =================================================
        GET COURIERS
        =================================================
        */

            $couriers =
                $shipmozoData['data']
                ?? [];


            /*
        =================================================
        CHEAPEST COURIER
        =================================================
        */

            $cheapestCourier =
                null;


            if (
                is_array($couriers) &&
                !empty($couriers)
            ) {

                usort(
                    $couriers,
                    function ($a, $b) {

                        return
                            (float) (
                                $a['total_charges']
                                ?? 0
                            )
                            <=>
                            (float) (
                                $b['total_charges']
                                ?? 0
                            );
                    }
                );


                $cheapestCourier =
                    $couriers[0]
                    ?? null;
            }


            /*
        =================================================
        SHIPPING
        =================================================
        */

            $shipping =
                $cheapestCourier

                ? (float) (
                    $cheapestCourier['total_charges'] ?? 0
                )

                : 0;


            $courierName =
                $cheapestCourier['name']
                ?? '';


            $deliveryDays =
                $cheapestCourier['estimated_delivery']
                ?? '';
        } catch (
            \Throwable $e
        ) {

            $shipping =
                0;

            $courierName =
                '';

            $deliveryDays =
                '';
        }


        /*
    =====================================================
    HANDLING
    =====================================================
    */

        $handlingFee = 0;


        /*
    =====================================================
    GRAND TOTAL
    =====================================================
    */

        $grandTotal =
            $printingSubtotal +
            $shipping +
            $handlingFee;


        /*
    =====================================================
    RESPONSE
    =====================================================
    */

        return response()->json([

            'success' =>
            true,

            'printing_subtotal' =>
            round(
                $printingSubtotal,
                2
            ),

            'shipping' =>
            round(
                $shipping,
                2
            ),

            'handling_fee' =>
            $handlingFee,

            'total' =>
            round(
                $grandTotal,
                2
            ),

            'weight' =>
            number_format(
                $weightKg,
                3,
                '.',
                ''
            ),

            'courier' =>
            $courierName,

            'delivery_days' =>
            $deliveryDays,

        ]);
    }
    public function category(Request $request, $slug)
    {
        $data = Products::with('categories.category')
            ->whereHas('categories.category', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->orderBy('id', 'desc')
            ->latest()
            ->paginate(8);
        $category_data = Category::with('childCategory')->where('slug', $slug)->first();
        if ($request->ajax()) {
            return view('front.category.products_data', compact('data'))->render();
        }
        return view('front.category.index', compact('data', 'slug', 'category_data'));
    }
    public function categories(Request $request)
    {

        $category_data = Category::get();
        return view('front.category.categories', compact('category_data'));
    }
    public function go_to_product($product_id)
    {
        $product_id = decrypt($product_id);
        $data = Products::with('products_images')->where('id', $product_id)
            ->first();
        if ($data) {
            return view('front.product.go_to_product', compact('data'));
        } else {
            $data = null;
            return view('front.product.go_to_product', compact('data'));
        }
    }
    public function product($id, $slug)
    {
        $data = Products::with(['categories', 'products_attributes', 'products_images'])
            ->where('id', $id)
            ->first();
        if ($data) {
            $productId = $id;
            $related_data = Products::with('categories.category', 'products_images')
                ->whereHas('categories.category', function ($query) use ($productId) {
                    $query->whereIn('id', function ($query) use ($productId) {
                        $query->select('category_id')
                            ->from('products_categories')
                            ->where('product_id', $productId);
                    });
                })
                ->where('id', '!=', $productId)
                ->inRandomOrder()
                ->take(8)
                ->get();
            $prev_next_data = Products::limit(2)->inRandomOrder()->get();
            return view('front.product.index', compact('data', 'related_data', 'prev_next_data'));
        }
    }
    public function blogs()
    {
        $blogs = Blogs::where('status', 1)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(9);

        return view(
            'front/blogs',
            compact('blogs')
        );
    }


    public function blog($id, $slug)
    {
        $blog = Blogs::where('id', $id)
            ->where('status', 1)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->firstOrFail();


        /*
    |--------------------------------------------------------------------------
    | Canonical slug
    |--------------------------------------------------------------------------
    | If somebody opens an old/wrong slug, redirect to the correct SEO URL.
    */

        if ($slug !== $blog->slug) {

            return redirect()->route(
                'blog',
                [
                    'id' => $blog->id,
                    'slug' => $blog->slug,
                ],
                301
            );
        }


        /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

        $blog->increment('views');


        return view(
            'front/blog',
            compact('blog')
        );
    }
}
