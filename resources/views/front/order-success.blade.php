@extends('layouts.web.web')


@section('custom_header')

<style>
    /*
    =====================================================
    ORDER SUCCESS PAGE
    =====================================================
    */

    .order-success-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 45px 15px 60px;
    }


    .order-success-wrapper {
        max-width: 760px;
        margin: 0 auto;
    }


    /*
    =====================================================
    SUCCESS CARD
    =====================================================
    */

    .order-success-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 35px;
        text-align: center;
    }


    /*
    =====================================================
    SUCCESS ICON
    =====================================================
    */

    .order-success-icon {
        width: 78px;
        height: 78px;

        margin: 0 auto 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #eaf0ff;
        border: 1px solid #c9d7ff;

        border-radius: 50%;

        color: #2856db;

        font-size: 38px;
    }


    /*
    =====================================================
    TITLE
    =====================================================
    */

    .order-success-title {
        margin-bottom: 8px;
    }


    .order-success-title h1 {
        margin: 0;

        font-size: 30px;
        font-weight: 800;

        color: #222;
    }


    .order-success-title p {
        margin: 8px 0 0;

        font-size: 13px;
        color: #777;
    }


    /*
    =====================================================
    ORDER NUMBER
    =====================================================
    */

    .order-number-box {
        margin: 25px auto 0;

        max-width: 420px;

        padding: 13px 18px;

        background: #f4f7ff;

        border: 1px solid #c9d7ff;
    }


    .order-number-label {
        display: block;

        margin-bottom: 3px;

        font-size: 10px;

        font-weight: 700;

        color: #777;

        text-transform: uppercase;

        letter-spacing: .6px;
    }


    .order-number {
        font-size: 19px;

        font-weight: 800;

        color: #2856db;

        letter-spacing: .5px;
    }


    /*
    =====================================================
    ORDER DETAILS
    =====================================================
    */

    .order-details-card {
        margin-top: 25px;

        border-top: 1px solid #ddd;

        padding-top: 20px;

        text-align: left;
    }


    .order-details-title {
        margin-bottom: 12px;

        font-size: 15px;

        font-weight: 700;

        color: #222;
    }


    .order-detail-row {
        display: flex;

        justify-content: space-between;

        align-items: center;

        gap: 15px;

        padding: 11px 0;

        border-bottom: 1px solid #eee;

        font-size: 13px;
    }


    .order-detail-row:last-child {
        border-bottom: 0;
    }


    .order-detail-label {
        color: #777;
    }


    .order-detail-value {
        color: #222;

        font-weight: 700;

        text-align: right;
    }


    /*
    =====================================================
    COD BADGE
    =====================================================
    */

    .cod-badge {
        display: inline-flex;

        align-items: center;

        gap: 5px;

        padding: 5px 9px;

        background: #eaf0ff;

        border: 1px solid #c9d7ff;

        color: #2856db;

        font-size: 10px;

        font-weight: 700;
    }


    /*
    =====================================================
    NEXT STEP MESSAGE
    =====================================================
    */

    .order-success-note {
        margin-top: 22px;

        padding: 13px 15px;

        background: #fbf9f4;

        border: 1px dashed #ccc;

        font-size: 12px;

        color: #666;

        text-align: center;
    }


    /*
    =====================================================
    BUTTONS
    =====================================================
    */

    .order-success-actions {
        display: flex;

        justify-content: center;

        gap: 10px;

        margin-top: 25px;
    }


    .order-success-btn {
        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

        min-width: 150px;

        height: 44px;

        padding: 0 18px;

        background: #2856db;

        border: 1px solid #2856db;

        color: #fff !important;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;

        transition: all .15s ease;
    }


    .order-success-btn:hover {
        background: #1f46bd;

        border-color: #1f46bd;

        color: #fff !important;

        text-decoration: none;
    }


    .order-success-btn.secondary {
        background: #fff;

        color: #2856db !important;
    }


    .order-success-btn.secondary:hover {
        background: #f4f7ff;

        color: #2856db !important;
    }


    /*
    =====================================================
    MOBILE
    =====================================================
    */

    @media (max-width: 576px) {

        .order-success-section {
            padding: 25px 12px 40px;
        }


        .order-success-card {
            padding: 25px 15px;
        }


        .order-success-icon {
            width: 68px;
            height: 68px;

            font-size: 32px;
        }


        .order-success-title h1 {
            font-size: 25px;
        }


        .order-number {
            font-size: 17px;
        }


        .order-detail-row {
            align-items: flex-start;
        }


        .order-success-actions {
            flex-direction: column;
        }


        .order-success-btn {
            width: 100%;
        }

    }
</style>

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



                        {{-- PAYMENT --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Payment Method
                            </span>

                            <span class="order-detail-value">

                                <span class="cod-badge">

                                    <i class="bi bi-cash-coin"></i>

                                    Cash on Delivery

                                </span>

                            </span>

                        </div>



                        {{-- PAYMENT STATUS --}}

                        <div class="order-detail-row">

                            <span class="order-detail-label">
                                Payment Status
                            </span>

                            <span class="order-detail-value">

                                Pending

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