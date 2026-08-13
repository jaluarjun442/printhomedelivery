@extends('layouts.web.web')


@section('custom_header')
<style>
    .single-order-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 18px 8px 30px;
    }

    .single-order-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */

    .single-order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .single-order-header h1 {
        margin: 2px 0 0;
        font-size: 23px;
        line-height: 1.2;
        font-weight: 800;
        color: #111;
    }

    .back-btn {
        color: #2856db;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
    }


    /* STATUS */

    .order-status {
        display: inline-block;
        padding: 5px 9px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        background: #f4f7ff;
        color: #2856db;
        border: 1px solid #c9d7ff;
    }


    /* CARD */

    .order-detail-card {
        background: #fff;
        border: 1px solid #d5d5d5;
        margin-bottom: 7px;
    }

    .order-detail-title {
        padding: 8px 12px;
        border-bottom: 1px solid #e5e5e5;
        font-size: 12px;
        font-weight: 800;
        color: #111;
    }

    .order-detail-body {
        padding: 9px 12px;
    }


    /* DETAILS GRID */

    .detail-grid {
        display: grid;

        /* 4 columns desktop */
        grid-template-columns: repeat(4, 1fr);

        column-gap: 22px;
        row-gap: 8px;
    }

    .detail-item {
        min-width: 0;
    }

    .detail-label {
        display: block;

        margin-bottom: 2px;

        font-size: 8px;
        line-height: 1.2;

        color: #777;

        text-transform: uppercase;
        font-weight: 700;
    }

    .detail-value {
        display: block;

        font-size: 11px;
        line-height: 1.35;

        color: #222;
        font-weight: 700;

        word-break: break-word;
    }

    .detail-value.normal {
        font-weight: 600;
    }


    /*
|--------------------------------------------------------------------------
| ADDRESS
|--------------------------------------------------------------------------
*/

    .address-grid {
        display: grid;

        grid-template-columns:
            1.2fr 1.2fr 1fr .7fr;

        gap: 8px 22px;
    }


    /*
|--------------------------------------------------------------------------
| SHIPPING
|--------------------------------------------------------------------------
*/

    .shipping-grid {
        display: grid;

        grid-template-columns:
            1.4fr 1fr 1fr .8fr;

        gap: 8px 22px;
    }


    /*
|--------------------------------------------------------------------------
| DOCUMENT TABLE
|--------------------------------------------------------------------------
*/

    .documents-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .documents-table {
        width: 100%;
        border-collapse: collapse;

        font-size: 9px;
    }

    .documents-table th {
        background: #f6f7fa;

        color: #555;

        font-size: 8px;
        font-weight: 800;

        text-transform: uppercase;

        padding: 6px 5px;

        border-bottom: 1px solid #ddd;

        white-space: nowrap;
    }

    .documents-table td {
        padding: 6px 5px;

        border-bottom: 1px solid #eee;

        color: #222;
        font-weight: 600;

        white-space: nowrap;
    }

    .documents-table tr:last-child td {
        border-bottom: 0;
    }

    .document-name {
        font-weight: 800;
    }


    /*
|--------------------------------------------------------------------------
| CANCEL
|--------------------------------------------------------------------------
*/

    .cancel-card {
        background: #fff;

        border: 1px solid #e5cccc;

        padding: 10px 12px;
    }

    .cancel-card h3 {
        margin: 0 0 3px;

        font-size: 12px;
        font-weight: 800;
    }

    .cancel-card p {
        margin: 0 0 7px;

        font-size: 10px;
        color: #777;
    }

    .cancel-btn {
        height: 29px;

        padding: 0 12px;

        background: #fff;

        color: #b42318;

        border: 1px solid #d8a5a5;

        font-size: 10px;
        font-weight: 800;

        cursor: pointer;
    }


    /*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

    @media (max-width: 767px) {

        .single-order-section {
            padding: 15px 6px 25px;
        }

        .single-order-header h1 {
            font-size: 20px;
        }

        .detail-grid,
        .address-grid,
        .shipping-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px 12px;
        }

        .detail-value {
            font-size: 10px;
        }

        .documents-table {
            min-width: 750px;
        }

        .order-detail-title {
            padding: 7px 10px;
        }

        .order-detail-body {
            padding: 8px 10px;
        }

    }

    .detail-label {
        font-size: 9px !important;
        font-weight: 800 !important;
        color: #666;
        margin-bottom: 3px;
    }

    .detail-value {
        font-size: 13px !important;
        line-height: 1.4;
        font-weight: 700 !important;
        color: #111;
    }

    .detail-value.normal {
        font-size: 12px !important;
        font-weight: 600 !important;
    }

    .order-detail-title {
        font-size: 14px !important;
        font-weight: 800 !important;
    }

    .documents-table {
        font-size: 11px !important;
    }

    .documents-table th {
        font-size: 9px !important;
        font-weight: 800 !important;
    }

    .documents-table td {
        font-size: 11px !important;
        font-weight: 600 !important;
    }

    .document-name {
        font-weight: 800 !important;
    }

    @media (max-width: 767px) {

        .detail-label {
            font-size: 8px !important;
        }

        .detail-value {
            font-size: 12px !important;
            font-weight: 700 !important;
        }

        .detail-value.normal {
            font-size: 11px !important;
        }

    }
</style>

@endsection


@section('content')

@php

$status = strtolower($order->status ?? 'placed');

/*
|--------------------------------------------------------------------------
| Items JSON
|--------------------------------------------------------------------------
*/

$items = $order->items;

if (is_string($items)) {
$items = json_decode($items, true);
}

if (!is_array($items)) {
$items = [];
}

/*
|--------------------------------------------------------------------------
| Cancel Status
|--------------------------------------------------------------------------
*/

$cancelableStatuses = [
'placed',
'confirmed',
'processing'
];

$canCancel = in_array($status, $cancelableStatuses);

@endphp


<main>

    <section class="single-order-section">

        <div class="container">

            <div class="single-order-wrapper">


                {{-- ALERTS --}}

                @if(session('success'))

                <div class="order-alert success">
                    {{ session('success') }}
                </div>

                @endif


                @if(session('error'))

                <div class="order-alert error">
                    {{ session('error') }}
                </div>

                @endif


                {{-- HEADER --}}

                <div class="single-order-header">

                    <div>

                        <a
                            href="{{ route('my-orders') }}"
                            class="back-btn">
                            ← My Orders
                        </a>

                        <h1>
                            Order Details
                        </h1>

                    </div>


                    <span class="order-status
                        @if($status === 'cancelled') status-cancelled @endif
                        @if($status === 'printing') status-printing @endif
                        @if($status === 'shipped' || $status === 'delivered')
                            status-shipped
                        @endif
                    ">
                        {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>

                </div>


                {{-- =====================================================
                    CUSTOMER + ORDER
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Order Information
                    </div>

                    <div class="order-detail-body">

                        <div class="detail-grid">


                            <div class="detail-item">

                                <span class="detail-label">
                                    Order Number
                                </span>

                                <span class="detail-value">
                                    {{ $order->order_number }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Order Date
                                </span>

                                <span class="detail-value">
                                    {{ optional($order->created_at)->format('d M Y, h:i A') }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Full Name
                                </span>

                                <span class="detail-value">
                                    {{ $order->full_name }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Mobile
                                </span>

                                <span class="detail-value">
                                    {{ $order->mobile }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Email
                                </span>

                                <span class="detail-value">
                                    {{ $order->email }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Status
                                </span>

                                <span class="detail-value">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    DELIVERY ADDRESS
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Delivery Address
                    </div>

                    <div class="order-detail-body">

                        <div class="detail-grid">

                            <div class="detail-item">
                                <span class="detail-label">House</span>
                                <span class="detail-value">{{ $order->house ?: '-' }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Road</span>
                                <span class="detail-value">{{ $order->road ?: '-' }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Landmark</span>
                                <span class="detail-value">{{ $order->landmark ?: '-' }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">Pincode</span>
                                <span class="detail-value">{{ $order->pincode }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">City</span>
                                <span class="detail-value">{{ $order->city }}</span>
                            </div>

                            <div class="detail-item">
                                <span class="detail-label">State</span>
                                <span class="detail-value">{{ $order->state }}</span>
                            </div>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    SHIPPING
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Shipping Details
                    </div>

                    <div class="order-detail-body">

                        <div class="detail-grid">


                            <div class="detail-item">

                                <span class="detail-label">
                                    Courier
                                </span>

                                <span class="detail-value">
                                    {{ $order->courier_name ?: '-' }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Shipping Charge
                                </span>

                                <span class="detail-value">
                                    ₹{{ number_format($order->shipping_charge ?? 0, 2) }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Delivery Estimate
                                </span>

                                <span class="detail-value">
                                    {{ $order->delivery_estimate ?: '-' }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Weight
                                </span>

                                <span class="detail-value">
                                    @if($order->weight !== null)
                                    {{ number_format($order->weight, 3) }}
                                    @else
                                    -
                                    @endif
                                </span>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    PRINT DOCUMENTS
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Print Documents
                    </div>

                    <div class="order-detail-body">

                        @if(count($items))

                        <div class="documents-scroll">

                            <table class="documents-table">

                                <thead>

                                    <tr>

                                        <th>
                                            #
                                        </th>

                                        <th>
                                            Document
                                        </th>

                                        <th>
                                            Pages
                                        </th>

                                        <th>
                                            Color
                                        </th>

                                        <th>
                                            Side
                                        </th>

                                        <th>
                                            Binding
                                        </th>

                                        <th>
                                            Size
                                        </th>

                                        <th>
                                            Orientation
                                        </th>

                                        <th>
                                            Copies
                                        </th>

                                        <th>
                                            Rate
                                        </th>

                                        <th>
                                            Sheets
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

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($items as $key => $item)

                                    <tr>

                                        <td>
                                            {{ $key + 1 }}
                                        </td>

                                        <td>
                                            <span class="document-name">
                                                {{ $item['name'] ?? '-' }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $item['pages'] ?? '-' }}
                                        </td>

                                        <td>
                                            {{ isset($item['color_mode'])
                                                        ? ucwords(str_replace('_', ' ', $item['color_mode']))
                                                        : '-' }}
                                        </td>

                                        <td>
                                            {{ isset($item['print_side'])
                                                        ? ucwords(str_replace('_', ' ', $item['print_side']))
                                                        : '-' }}
                                        </td>

                                        <td>
                                            {{ isset($item['binding'])
                                                        ? ucwords(str_replace('_', ' ', $item['binding']))
                                                        : '-' }}
                                        </td>

                                        <td>
                                            {{ isset($item['page_size'])
                                                        ? strtoupper(str_replace('_', ' ', $item['page_size']))
                                                        : '-' }}
                                        </td>

                                        <td>
                                            {{ isset($item['orientation'])
                                                        ? ucfirst($item['orientation'])
                                                        : '-' }}
                                        </td>

                                        <td>
                                            {{ $item['copies'] ?? 1 }}
                                        </td>

                                        <td>
                                            ₹{{ number_format($item['rate'] ?? 0, 2) }}
                                        </td>

                                        <td>
                                            {{ $item['billable_sheets'] ?? '-' }}
                                        </td>

                                        <td>
                                            ₹{{ number_format($item['print_cost_per_copy'] ?? 0, 2) }}
                                        </td>

                                        <td>
                                            ₹{{ number_format($item['binding_rate'] ?? 0, 2) }}
                                        </td>

                                        <td>
                                            <strong>
                                                ₹{{ number_format($item['total'] ?? 0, 2) }}
                                            </strong>
                                        </td>

                                    </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                        @else

                        <div style="font-size:11px;color:#777;">
                            No document details available.
                        </div>

                        @endif

                    </div>

                </div>


                {{-- =====================================================
                    PRICING
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Order Pricing
                    </div>

                    <div class="order-detail-body">

                        <div class="detail-grid">


                            <div class="detail-item">

                                <span class="detail-label">
                                    Print Subtotal
                                </span>

                                <span class="detail-value">
                                    ₹{{ number_format($order->print_subtotal ?? 0, 2) }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Handling Charge
                                </span>

                                <span class="detail-value">
                                    ₹{{ number_format($order->handling_charge ?? 0, 2) }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Shipping Charge
                                </span>

                                <span class="detail-value">
                                    ₹{{ number_format($order->shipping_charge ?? 0, 2) }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Grand Total
                                </span>

                                <span class="detail-value"
                                    style="font-size:13px;color:#2856db;">

                                    ₹{{ number_format($order->grand_total ?? 0, 2) }}

                                </span>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    PAYMENT
                ====================================================== --}}

                <div class="order-detail-card">

                    <div class="order-detail-title">
                        Payment Details
                    </div>

                    <div class="order-detail-body">

                        <div class="detail-grid">


                            <div class="detail-item">

                                <span class="detail-label">
                                    Payment Method
                                </span>

                                <span class="detail-value">
                                    {{ strtoupper($order->payment_method ?? '-') }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Payment Status
                                </span>

                                <span class="detail-value">
                                    {{ ucfirst($order->payment_status ?? '-') }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Razorpay Order ID
                                </span>

                                <span class="detail-value">
                                    {{ $order->razorpay_order_id ?: '-' }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    Razorpay Payment ID
                                </span>

                                <span class="detail-value">
                                    {{ $order->razorpay_payment_id ?: '-' }}
                                </span>

                            </div>


                            <div class="detail-item full-width">

                                <span class="detail-label">
                                    Razorpay Signature
                                </span>

                                <span class="detail-value normal">
                                    {{ $order->razorpay_signature ?: '-' }}
                                </span>

                            </div>


                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    CANCEL ORDER
                ====================================================== --}}

                @if($canCancel)

                <div class="cancel-card">

                    <h3>
                        Cancel Order
                    </h3>

                    <p>
                        You can cancel this order before it enters the
                        printing process.
                    </p>


                    <form
                        method="POST"
                        action="{{ route('my-orders.cancel', $order->id) }}"
                        onsubmit="return confirm('Are you sure you want to cancel this order?');">

                        @csrf

                        <button
                            type="submit"
                            class="cancel-btn">
                            Cancel Order
                        </button>

                    </form>

                </div>

                @endif


            </div>

        </div>

    </section>

</main>

@endsection