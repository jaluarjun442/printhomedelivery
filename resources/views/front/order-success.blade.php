@extends('layouts.web.web')


@section('custom_header')

@endsection



@section('content')

<main>

    <section class="order-success-section">

        <div class="container">

            <div class="order-success-wrapper">


                <div class="order-success-card">


                    {{-- =================================================
                         SUCCESS ICON
                    ================================================== --}}

                    <div class="order-success-icon">

                        <i class="bi bi-check-lg"></i>

                    </div>



                    {{-- =================================================
                         TITLE
                    ================================================== --}}

                    <div class="order-success-title">

                        <h1>
                            Order Placed Successfully
                        </h1>

                        <p>
                            Thank you! Your print order has been placed successfully.
                        </p>

                    </div>



                    {{-- =================================================
                         ORDER NUMBER
                    ================================================== --}}

                    <div class="order-number-box">

                        <span class="order-number-label">
                            Order Number
                        </span>

                        <div class="order-number">

                            {{ $order->order_number }}

                        </div>

                    </div>



                    {{-- =================================================
                         ORDER DETAILS
                    ================================================== --}}

                    <div class="order-details-card">

                        <div class="order-details-title">

                            <i class="bi bi-receipt me-1"
                                style="color:#2856db;"></i>

                            Order Details

                        </div>


                        {{-- TOTAL --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Order Total
                            </span>

                            <span class="order-detail-value">

                                ₹{{ number_format(
                                    $order->grand_total,
                                    2
                                ) }}

                            </span>

                        </div>



                        {{-- COURIER --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Courier
                            </span>

                            <span class="order-detail-value">

                                {{ $order->courier_name ?: 'Courier' }}

                            </span>

                        </div>



                        {{-- DELIVERY --}}

                        @if(!empty($order->delivery_estimate))

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Estimated Delivery
                            </span>

                            <span class="order-detail-value">

                                {{ $order->delivery_estimate }}

                            </span>

                        </div>

                        @endif



                        {{-- PAYMENT METHOD --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Payment Method
                            </span>

                            <span class="order-detail-value">

                                @if(
                                strtolower(
                                (string) $order->payment_method
                                ) === 'payu'
                                )

                                <span class="payu-badge">
                                    <i class="bi bi-credit-card"></i>
                                    PayU
                                </span>

                                @else

                                <span class="cod-badge">
                                    <i class="bi bi-cash-coin"></i>
                                    Cash on Delivery
                                </span>

                                @endif

                            </span>

                        </div>


                        {{-- PAYU TRANSACTION ID --}}

                        @if(
                        strtolower(
                        (string) $order->payment_method
                        ) === 'payu'
                        && !empty($order->razorpay_payment_id)
                        )

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                PayU Transaction ID
                            </span>

                            <span
                                class="order-detail-value"
                                style="word-break:break-all;">
                                {{ $order->razorpay_payment_id }}
                            </span>

                        </div>

                        @endif
                        @if(
                        strtolower(
                        (string) $order->payment_method
                        ) === 'payu'
                        && !empty($order->razorpay_order_id)
                        )

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Bank Transaction ID
                            </span>

                            <span
                                class="order-detail-value"
                                style="word-break:break-all;">
                                {{ $order->razorpay_order_id }}
                            </span>

                        </div>

                        @endif


                        {{-- PAYMENT STATUS --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Payment Status
                            </span>

                            <span class="order-detail-value">

                                @php
                                $paymentStatus =
                                strtolower(
                                (string) $order->payment_status
                                );
                                @endphp

                                @if($paymentStatus === 'paid')

                                <span class="payu-badge">
                                    <i class="bi bi-check-circle"></i>
                                    Paid
                                </span>

                                @elseif($paymentStatus === 'failed')

                                <span
                                    class="payu-badge"
                                    style="color:#dc3545;border-color:#f1b0b7;background:#fff5f5;">
                                    <i class="bi bi-x-circle"></i>
                                    Failed
                                </span>

                                @else

                                Pending

                                @endif

                            </span>

                        </div>


                    </div>



                    {{-- =================================================
                         NOTE
                    ================================================== --}}

                    <div class="order-success-note">

                        <i
                            class="bi bi-info-circle me-1"
                            style="color:#2856db;">
                        </i>

                        Please keep your order number
                        <strong>
                            {{ $order->order_number }}
                        </strong>
                        for future reference.

                    </div>



                    {{-- =================================================
                         ACTIONS
                    ================================================== --}}

                    <div class="order-success-actions">

                        <a
                            href="{{ route('home') }}"
                            class="order-success-btn">

                            <i class="bi bi-house"></i>

                            Back to Home

                        </a>


                        <a
                            href="{{ route('upload') }}"
                            class="order-success-btn secondary">

                            <i class="bi bi-printer"></i>

                            Print Another

                        </a>

                    </div>


                </div>


            </div>

        </div>

    </section>

</main>

@endsection