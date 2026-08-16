@extends('layouts.web.web')


@section('custom_header')

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


                @if(
                strtolower($order->payment_status ?? '') === 'pending'
                || $status === 'payment_pending'
                )
                <div class="payment-pending-notice">
                    <strong>Payment Pending</strong>
                    Your payment is still being confirmed.
                    Please wait 10–15 minutes and do not place another order for this payment.
                    We will update this order automatically when PayU confirms the final payment status.
                </div>
                @endif


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
                                    Bank Reference ID
                                </span>

                                <span class="detail-value">
                                    {{ $order->razorpay_order_id ?: '-' }}
                                </span>

                            </div>


                            <div class="detail-item">

                                <span class="detail-label">
                                    PayU Transaction ID
                                </span>

                                <span class="detail-value">
                                    {{ $order->razorpay_payment_id ?: '-' }}
                                </span>

                            </div>


                            <!-- <div class="detail-item full-width">

                                <span class="detail-label">
                                    Razorpay Signature
                                </span>

                                <span class="detail-value normal">
                                    {{ $order->razorpay_signature ?: '-' }}
                                </span>

                            </div> -->


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
@if(
strtolower($order->payment_status ?? '') === 'pending' ||
$status === 'payment_pending'
)

<script>
    (function() {

        let attempts = 0;

        const maxAttempts = 30;

        const checkUrl =
            "{{ route('payu.check.status', $order->id) }}";


        function checkPaymentStatus() {

            attempts++;


            fetch(checkUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            ?.getAttribute('content'),

                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {

                    if (
                        data.payment_status === 'paid'
                    ) {

                        window.location.reload();

                        return;
                    }


                    if (
                        data.payment_status === 'failed'
                    ) {

                        window.location.reload();

                        return;
                    }


                    /*
                    Keep checking while payment is pending.
                    */

                    if (attempts < maxAttempts) {

                        setTimeout(
                            checkPaymentStatus,
                            30000
                        );
                    }

                })
                .catch(() => {

                    /*
                    Temporary network error.
                    Try again later while inside
                    the 15 minute window.
                    */

                    if (attempts < maxAttempts) {

                        setTimeout(
                            checkPaymentStatus,
                            30000
                        );
                    }

                });
        }


        /*
        Start after 30 seconds.
        30 attempts × 30 seconds = 15 minutes.
        */

        setTimeout(
            checkPaymentStatus,
            30000
        );

    })();
</script>

@endif
@endsection