@extends('layouts.app')


@section('content')

<style>
    .order-page {
        padding: 8px 0 20px;
    }


    .order-page .card {
        margin-bottom: 8px;
        border: 1px solid #ddd;
        border-radius: 3px;
        box-shadow: none;
    }


    .order-page .card-header {
        padding: 7px 10px;
        background: #f7f7f7;
        border-bottom: 1px solid #ddd;
        font-weight: 600;
        font-size: 14px;
        color: #222;
    }


    .order-page .card-body {
        padding: 8px 10px;
    }


    .order-title-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }


    .order-title {
        margin: 0;
        font-size: 21px;
        font-weight: 600;
    }


    .order-number {
        color: #2856db;
        font-size: 13px;
        margin-left: 6px;
    }


    .info-table {
        width: 100%;
        margin: 0;
    }


    .info-table td {
        padding: 5px 7px;
        border-bottom: 1px solid #eee;
        font-size: 12px;
        vertical-align: top;
    }


    .info-table tr:last-child td {
        border-bottom: 0;
    }


    .info-label {
        width: 38%;
        font-weight: 600;
        color: #222;
    }


    .status-badge {
        display: inline-block;
        padding: 3px 7px;
        border-radius: 3px;
        font-size: 10px;
        font-weight: 600;
        background: #2856db;
        color: #fff;
    }


    .payment-badge {
        display: inline-block;
        padding: 3px 7px;
        border-radius: 3px;
        font-size: 10px;
        font-weight: 600;
        background: #ffc107;
        color: #222;
    }


    .back-btn {
        font-size: 12px;
        padding: 5px 10px;
    }


    .address-table td {
        width: 25%;
    }


    .items-table {
        width: 100%;
        margin: 0;
    }


    .items-table th,
    .items-table td {
        padding: 5px 6px;
        font-size: 11px;
        vertical-align: middle;
    }


    .items-table th {
        background: #fafafa;
        white-space: nowrap;
    }


    .items-table td {
        white-space: nowrap;
    }


    .file-name {
        font-weight: 600;
        color: #222;
    }


    .view-file-btn {
        padding: 3px 7px;
        font-size: 10px;
        white-space: nowrap;
    }


    .small-muted {
        color: #777;
        font-size: 10px;
    }


    .price-table {
        width: 100%;
        margin: 0;
    }


    .price-table td {
        padding: 5px 7px;
        font-size: 12px;
        border-bottom: 1px solid #eee;
    }


    .price-table tr:last-child td {
        border-bottom: 0;
    }


    .grand-total td {
        background: #fffaf0;
        font-weight: 700;
        font-size: 14px;
    }


    .grand-total td:last-child {
        color: #198754;
    }


    .user-agent {
        word-break: break-word;
    }


    @media (max-width: 767px) {

        .order-page {
            padding: 5px 0 15px;
        }


        .order-title-row {
            align-items: flex-start;
        }


        .order-title {
            font-size: 18px;
        }


        .order-number {
            display: block;
            margin: 2px 0 0;
        }


        .back-btn {
            font-size: 11px;
            padding: 5px 8px;
        }


        .info-label {
            width: 42%;
        }


        .items-table {
            min-width: 1000px;
        }

    }
</style>


<div class="container order-page">


    {{-- =====================================================
         TITLE
    ====================================================== --}}

    <div class="order-title-row">

        <div>

            <h2 class="order-title">

                Order Details

                <span class="order-number">
                    {{ $order->order_number }}
                </span>

            </h2>

        </div>


        <div>

            <a
                href="{{ route('admin.orders') }}"
                class="btn btn-secondary back-btn">

                ← Back

            </a>

        </div>

    </div>



    {{-- =====================================================
         CUSTOMER + ORDER SUMMARY
    ====================================================== --}}

    <div class="row">


        {{-- CUSTOMER --}}

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    Customer Details
                </div>

                <div class="card-body p-0">

                    <table class="info-table">

                        <tr>

                            <td class="info-label">
                                Name
                            </td>

                            <td>
                                {{ $order->full_name ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Mobile
                            </td>

                            <td>
                                {{ $order->mobile ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Email
                            </td>

                            <td>
                                {{ $order->email ?? '-' }}
                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>



        {{-- ORDER SUMMARY --}}

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    Order Summary
                </div>

                <div class="card-body p-0">

                    <table class="info-table">

                        <tr>

                            <td class="info-label">
                                Order Number
                            </td>

                            <td>
                                {{ $order->order_number }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Order Date
                            </td>

                            <td>

                                @if($order->created_at)

                                {{ $order->created_at->format(
                                        'd M Y, h:i A'
                                    ) }}

                                @else

                                -

                                @endif

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Status
                            </td>

                            <td>

                                <form
                                    method="POST"
                                    action="{{ route('admin.orders.update-status', $order->id) }}"
                                    style="display:flex; align-items:center; gap:6px;">

                                    @csrf

                                    <select
                                        name="status"
                                        class="form-control form-control-sm"
                                        style="width:170px;">

                                        <option
                                            value="placed"
                                            {{ ($order->status ?? 'placed') == 'placed' ? 'selected' : '' }}>
                                            Placed
                                        </option>

                                        <option
                                            value="confirmed"
                                            {{ $order->status == 'confirmed' ? 'selected' : '' }}>
                                            Confirmed
                                        </option>

                                        <option
                                            value="printing"
                                            {{ $order->status == 'printing' ? 'selected' : '' }}>
                                            Printing
                                        </option>

                                        <option
                                            value="ready_to_ship"
                                            {{ $order->status == 'ready_to_ship' ? 'selected' : '' }}>
                                            Ready to Ship
                                        </option>

                                        <option
                                            value="shipped"
                                            {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                            Shipped
                                        </option>

                                        <option
                                            value="out_for_delivery"
                                            {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>
                                            Out for Delivery
                                        </option>

                                        <option
                                            value="delivered"
                                            {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                            Delivered
                                        </option>

                                        <option
                                            value="cancelled"
                                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option>

                                    </select>


                                    <button
                                        type="submit"
                                        class="btn btn-primary btn-sm">

                                        Update

                                    </button>

                                </form>

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Payment
                            </td>

                            <td>

                                {{ strtoupper(
                                    $order->payment_method ?? 'COD'
                                ) }}

                                -

                                {{ ucfirst(
                                    $order->payment_status
                                    ?? 'Pending'
                                ) }}

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         PAYMENT + SHIPPING
    ====================================================== --}}

    <div class="row">


        {{-- PAYMENT --}}

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    Payment Details
                </div>

                <div class="card-body p-0">

                    <table class="info-table">

                        <tr>

                            <td class="info-label">
                                Method
                            </td>

                            <td>

                                {{ strtoupper(
                                    $order->payment_method
                                    ?? 'COD'
                                ) }}

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Status
                            </td>

                            <td>

                                <span class="payment-badge">

                                    {{ ucfirst(
                                        $order->payment_status
                                        ?? 'Pending'
                                    ) }}

                                </span>

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Amount
                            </td>

                            <td>

                                ₹{{ number_format(
                                    (float)(
                                        $order->grand_total
                                        ?? 0
                                    ),
                                    2
                                ) }}

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Transaction ID
                            </td>

                            <td>
                                {{ $order->transaction_id ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Payment ID
                            </td>

                            <td>
                                {{ $order->payment_id ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Paid At
                            </td>

                            <td>

                                @if($order->paid_at)

                                {{ \Carbon\Carbon::parse(
                                        $order->paid_at
                                    )->format(
                                        'd M Y, h:i A'
                                    ) }}

                                @else

                                -

                                @endif

                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>



        {{-- SHIPPING --}}

        <div class="col-md-6">

            <div class="card">

                <div class="card-header">
                    Shipping Details
                </div>

                <div class="card-body p-0">

                    <table class="info-table">

                        <tr>

                            <td class="info-label">
                                Courier
                            </td>

                            <td>
                                {{ $order->courier_name ?? '-' }}
                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Weight
                            </td>

                            <td>

                                @if(!empty($order->weight))

                                {{ $order->weight }} KG

                                @else

                                -

                                @endif

                            </td>

                        </tr>


                        <tr>

                            <td class="info-label">
                                Delivery Estimate
                            </td>

                            <td>
                                {{ $order->delivery_estimate ?? '-' }}
                            </td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>



    {{-- =====================================================
         DELIVERY ADDRESS
    ====================================================== --}}

    <div class="card">

        <div class="card-header">
            Delivery Address
        </div>

        <div class="card-body p-0">

            <table class="info-table address-table">

                <tr>

                    <td class="info-label">
                        House / Building
                    </td>

                    <td>
                        {{ $order->house ?? '-' }}
                    </td>

                    <td class="info-label">
                        State
                    </td>

                    <td>
                        {{ $order->state ?? '-' }}
                    </td>

                </tr>


                <tr>

                    <td class="info-label">
                        Road / Area
                    </td>

                    <td>
                        {{ $order->road ?? '-' }}
                    </td>

                    <td class="info-label">
                        Pincode
                    </td>

                    <td>
                        {{ $order->pincode ?? '-' }}
                    </td>

                </tr>


                <tr>

                    <td class="info-label">
                        Landmark
                    </td>

                    <td>
                        {{ $order->landmark ?? '-' }}
                    </td>

                    <td class="info-label">
                        City
                    </td>

                    <td>
                        {{ $order->city ?? '-' }}
                    </td>

                </tr>

            </table>

        </div>

    </div>



    {{-- =====================================================
         PRINT ITEMS / FILES
    ====================================================== --}}

    <div class="card">

        <div class="card-header">
            Print Items / Files
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered items-table mb-0">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                File Name
                            </th>

                            <th>
                                Pages
                            </th>

                            <th>
                                Print Type
                            </th>

                            <th>
                                Print Side
                            </th>

                            <th>
                                Paper
                            </th>

                            <th>
                                Binding
                            </th>

                            <th>
                                Copies
                            </th>

                            <th>
                                Rate
                            </th>

                            <th>
                                Billable Sheets
                            </th>

                            <th>
                                Print Cost
                            </th>

                            <th>
                                Binding Rate
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                File
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        @forelse($items as $index => $item)


                        <tr>


                            {{-- NUMBER --}}

                            <td>
                                {{ $index + 1 }}
                            </td>


                            {{-- FILE NAME --}}

                            <td>

                                <span class="file-name">

                                    {{ $item['name'] ?? '-' }}

                                </span>

                            </td>


                            {{-- PAGES --}}

                            <td>

                                {{ $item['pages']
                                    ?? '-'
                                }}

                            </td>


                            {{-- PRINT TYPE --}}

                            <td>

                                {{ $item['color_mode']
                                    ?? '-'
                                }}

                            </td>


                            {{-- PRINT SIDE --}}

                            <td>

                                {{ $item['print_side']
                                    ?? '-'
                                }}

                            </td>


                            {{-- PAPER --}}

                            <td>

                                {{ $item['page_size']
                                    ?? 'a4_75'
                                }}

                            </td>


                            {{-- BINDING --}}

                            <td>

                                {{ $item['binding']
                                    ?? 'loose'
                                }}

                            </td>


                            {{-- COPIES --}}

                            <td>

                                {{ $item['copies']
                                    ?? 1
                                }}

                            </td>


                            {{-- RATE --}}

                            <td>

                                ₹{{ number_format(
                                    (float)(
                                        $item['rate']
                                        ?? 0
                                    ),
                                    2
                                ) }}

                            </td>


                            {{-- BILLABLE SHEETS --}}

                            <td>

                                {{ $item['billable_sheets']
                                    ?? 0
                                }}

                            </td>


                            {{-- PRINT COST --}}

                            <td>

                                ₹{{ number_format(
                                    (float)(
                                        $item['print_cost_per_copy']
                                        ?? 0
                                    ),
                                    2
                                ) }}

                            </td>


                            {{-- BINDING RATE --}}

                            <td>

                                ₹{{ number_format(
                                    (float)(
                                        $item['binding_rate']
                                        ?? 0
                                    ),
                                    2
                                ) }}

                            </td>


                            {{-- TOTAL --}}

                            <td>

                                ₹{{ number_format(
                                    (float)(
                                        $item['total']
                                        ?? 0
                                    ),
                                    2
                                ) }}

                            </td>


                            {{-- VIEW FILE --}}

                            <td>

                                @if(
                                !empty(
                                $item['file_url']
                                )
                                )

                                <a
                                    href="{{ $item['file_url'] }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn btn-primary view-file-btn">

                                    View File ↗

                                </a>

                                @else

                                <span class="small-muted">

                                    File unavailable

                                </span>

                                @endif

                            </td>


                        </tr>


                        @empty


                        <tr>

                            <td
                                colspan="14"
                                class="text-center text-muted">

                                No print items found.

                            </td>

                        </tr>


                        @endforelse


                    </tbody>

                </table>

            </div>

        </div>

    </div>



    {{-- =====================================================
         PRICE BREAKDOWN
    ====================================================== --}}

    <div class="card">

        <div class="card-header">
            Price Breakdown
        </div>

        <div class="card-body p-0">

            <table class="price-table">

                <tr>

                    <td>
                        Printing Subtotal
                    </td>

                    <td class="text-right">

                        ₹{{ number_format(
                            (float)(
                                $order->print_subtotal
                                ?? 0
                            ),
                            2
                        ) }}

                    </td>

                </tr>


                <tr>

                    <td>
                        Shipping Charge
                    </td>

                    <td class="text-right">

                        ₹{{ number_format(
                            (float)(
                                $order->shipping_charge
                                ?? 0
                            ),
                            2
                        ) }}

                    </td>

                </tr>


                <tr>

                    <td>
                        Handling Charge
                    </td>

                    <td class="text-right">

                        ₹{{ number_format(
                            (float)(
                                $order->handling_charge
                                ?? 0
                            ),
                            2
                        ) }}

                    </td>

                </tr>


                <tr class="grand-total">

                    <td>
                        Grand Total
                    </td>

                    <td class="text-right">

                        ₹{{ number_format(
                            (float)(
                                $order->grand_total
                                ?? 0
                            ),
                            2
                        ) }}

                    </td>

                </tr>

            </table>

        </div>

    </div>



    {{-- =====================================================
         OTHER INFORMATION
    ====================================================== --}}

    <div class="card">

        <div class="card-header">
            Other Information
        </div>

        <div class="card-body p-0">

            <table class="info-table">

                <tr>

                    <td class="info-label">
                        Order IP
                    </td>

                    <td>

                        {{ $order->ip_address
                            ?? $order->ip
                            ?? '-'
                        }}

                    </td>

                </tr>


                <tr>

                    <td class="info-label">
                        User Agent
                    </td>

                    <td class="user-agent">

                        {{ $order->user_agent ?? '-' }}

                    </td>

                </tr>


                <tr>

                    <td class="info-label">
                        Notes
                    </td>

                    <td>

                        {{ $order->notes ?? '-' }}

                    </td>

                </tr>

            </table>

        </div>

    </div>


</div>

@endsection