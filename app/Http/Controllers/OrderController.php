<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use DataTables;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /*
    =====================================================
    AUTH
    =====================================================
    */

    public function __construct()
    {
        $this->middleware('auth');
    }


    /*
    =====================================================
    ORDER LIST PAGE
    =====================================================
    */

    public function index()
    {
        return view('admin/order/index');
    }


    /*
    =====================================================
    DATATABLE
    =====================================================
    */

    public function get_orders(Request $request)
    {
        $query = Order::query();


        /*
        ================================================
        ORDER NUMBER
        ================================================
        */

        if (
            $request->filled('order_number')
        ) {

            $query->where(
                'order_number',
                'like',
                '%' .
                    $request->order_number .
                    '%'
            );
        }


        /*
        ================================================
        MOBILE
        ================================================
        */

        if (
            $request->filled('mobile')
        ) {

            $query->where(
                'mobile',
                'like',
                '%' .
                    $request->mobile .
                    '%'
            );
        }


        /*
        ================================================
        STATUS
        ================================================
        */

        if (
            $request->filled('status')
        ) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        ================================================
        DATE FROM
        ================================================
        */

        if (
            $request->filled('date_from')
        ) {

            $query->whereDate(
                'created_at',
                '>=',
                $request->date_from
            );
        }


        /*
        ================================================
        DATE TO
        ================================================
        */

        if (
            $request->filled('date_to')
        ) {

            $query->whereDate(
                'created_at',
                '<=',
                $request->date_to
            );
        }


        /*
        ================================================
        NEWEST FIRST
        ================================================
        */

        $query->latest();


        /*
        ================================================
        DATATABLE
        ================================================
        */

        return DataTables::of($query)

            ->addIndexColumn()


            /*
            --------------------------------------------
            ORDER NUMBER
            --------------------------------------------
            */

            ->addColumn(
                'order_number_display',
                function ($row) {

                    return '
                        <a href="' .
                        route(
                            'admin.view_order',
                            $row->id
                        ) .
                        '"
                        class="font-weight-bold">

                            ' .
                        e(
                            $row->order_number
                        ) .
                        '

                        </a>
                    ';
                }
            )


            /*
            --------------------------------------------
            CUSTOMER
            --------------------------------------------
            */

            ->addColumn(
                'customer',
                function ($row) {

                    return '
                        <div>
                            <strong>' .
                        e(
                            $row->full_name
                        ) .
                        '</strong>
                        </div>

                        <small class="text-muted">
                            ' .
                        e(
                            $row->mobile
                        ) .
                        '
                        </small>
                    ';
                }
            )


            /*
            --------------------------------------------
            COURIER
            --------------------------------------------
            */

            ->addColumn(
                'courier',
                function ($row) {

                    return
                        $row->courier_name
                        ?: '-';
                }
            )


            /*
            --------------------------------------------
            PAYMENT
            --------------------------------------------
            */

            ->addColumn(
                'payment',
                function ($row) {

                    $method =
                        strtoupper(
                            $row->payment_method
                                ?: '-'
                        );

                    $status =
                        ucfirst(
                            $row->payment_status
                                ?: '-'
                        );

                    return '
                        <div>
                            <strong>' .
                        e(
                            $method
                        ) .
                        '</strong>
                        </div>

                        <small class="text-muted">
                            ' .
                        e(
                            $status
                        ) .
                        '
                        </small>
                    ';
                }
            )


            /*
            --------------------------------------------
            TOTAL
            --------------------------------------------
            */

            ->addColumn(
                'total',
                function ($row) {

                    return
                        '₹' .
                        number_format(
                            (float)
                            $row->grand_total,
                            2
                        );
                }
            )


            /*
            --------------------------------------------
            STATUS
            --------------------------------------------
            */

            ->addColumn(
                'status_badge',
                function ($row) {

                    $status =
                        strtolower(
                            $row->status
                                ?: 'placed'
                        );


                    $badgeClass =
                        'secondary';


                    if (
                        $status === 'placed'
                    ) {

                        $badgeClass =
                            'primary';
                    } elseif (
                        $status === 'processing'
                    ) {

                        $badgeClass =
                            'info';
                    } elseif (
                        $status === 'shipped'
                    ) {

                        $badgeClass =
                            'warning';
                    } elseif (
                        $status === 'delivered'
                    ) {

                        $badgeClass =
                            'success';
                    } elseif (
                        $status === 'cancelled'
                    ) {

                        $badgeClass =
                            'danger';
                    }


                    return '
                        <span class="badge badge-' .
                        $badgeClass .
                        '">

                            ' .
                        e(
                            ucfirst(
                                $status
                            )
                        ) .
                        '

                        </span>
                    ';
                }
            )


            /*
            --------------------------------------------
            DATE
            --------------------------------------------
            */

            ->addColumn(
                'order_date',
                function ($row) {

                    return
                        $row->created_at
                        ? $row->created_at
                        ->format(
                            'd M Y, h:i A'
                        )
                        : '-';
                }
            )


            /*
            --------------------------------------------
            ACTION
            --------------------------------------------
            */

            ->addColumn(
                'action',
                function ($row) {

                    return '
                        <a
                            href="' .
                        route(
                            'admin.view_order',
                            $row->id
                        ) .
                        '"
                            class="btn btn-info btn-sm">

                            View

                        </a>
                    ';
                }
            )


            ->rawColumns([
                'order_number_display',
                'customer',
                'payment',
                'status_badge',
                'action'
            ])


            ->make(true);
    }


    /*
    =====================================================
    SINGLE ORDER VIEW
    =====================================================
    */
    public function view_order($order_id)
    {
        $order = Order::findOrFail($order_id);

        /*
    =====================================================
    ORDER ITEMS
    =====================================================
    */

        $items = $order->items;

        if (is_string($items)) {
            $items = json_decode($items, true);
        }

        if (!is_array($items)) {
            $items = [];
        }


        /*
    =====================================================
    ITEMS ID = print_documents.id
    =====================================================
    */

        $documentIds = collect($items)
            ->pluck('id')
            ->filter()
            ->unique()
            ->values()
            ->toArray();


        /*
    =====================================================
    GET PRINT DOCUMENTS
    =====================================================
    */

        $documents = collect();

        if (!empty($documentIds)) {

            $documents = DB::table('print_documents')
                ->whereIn('id', $documentIds)
                ->get()
                ->keyBy('id');
        }


        /*
    =====================================================
    ATTACH FILE INFORMATION
    =====================================================
    */

        $items = collect($items)
            ->map(function ($item) use ($documents) {

                $documentId = $item['id'] ?? null;

                $document = null;

                if ($documentId) {
                    $document = $documents->get($documentId);
                }


                /*
            ---------------------------------------------
            DEFAULT
            ---------------------------------------------
            */

                $item['document_id'] = $documentId;

                $item['stored_path'] = null;

                $item['file_url'] = null;


                /*
            ---------------------------------------------
            DOCUMENT FOUND
            ---------------------------------------------
            */

                if (
                    $document &&
                    !empty($document->stored_path)
                ) {

                    $storedPath = $document->stored_path;

                    $item['stored_path'] = $storedPath;


                    /*
                =========================================
                FUTURE CLOUD / CDN FULL URL
                =========================================
                */

                    if (
                        \Illuminate\Support\Str::startsWith(
                            $storedPath,
                            [
                                'http://',
                                'https://'
                            ]
                        )
                    ) {

                        $item['file_url'] = $storedPath;
                    }


                    /*
                =========================================
                CURRENT LOCAL FILE
                =========================================
                */ else {

                        $item['file_url'] = asset(
                            'uploads/print_documents/' .
                                ltrim(
                                    str_replace(
                                        '\\',
                                        '/',
                                        $storedPath
                                    ),
                                    '/'
                                )
                        );
                    }
                }

                return $item;
            })
            ->values()
            ->toArray();


        /*
    =====================================================
    VIEW
    =====================================================
    */

        return view(
            'admin.order.view',
            compact(
                'order',
                'items'
            )
        );
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => [
                'required',
                'in:placed,confirmed,printing,ready_to_ship,shipped,out_for_delivery,delivered,cancelled'
            ],
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()
            ->back()
            ->with('success', 'Order status updated successfully.');
    }
}
