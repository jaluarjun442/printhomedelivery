@extends('layouts.web.web')


@section('custom_header')

<style>
    .orders-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 25px 10px 40px;
    }

    .orders-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .orders-header {
        text-align: center;
        margin-bottom: 18px;
    }

    .orders-header h1 {
        margin: 0;
        font-size: 26px;
        font-weight: 800;
        color: #222;
    }

    .orders-header p {
        margin: 4px 0 0;
        font-size: 12px;
        color: #777;
    }


    /* ALERT */

    .order-alert {
        padding: 8px 12px;
        margin-bottom: 10px;
        font-size: 12px;
    }


    /* PAYMENT PENDING NOTICE */

    .payment-pending-notice {
        margin: 8px 14px 0;
        padding: 8px 10px;
        border: 1px solid #ead69a;
        background: #fff8e6;
        color: #6f5200;
        font-size: 10px;
        line-height: 1.4;
    }

    .payment-pending-notice strong {
        display: block;
        margin-bottom: 2px;
        font-size: 10px;
        font-weight: 800;
    }

    .payment-pending-notice span {
        display: block;
    }

    @media (max-width: 767px) {
        .payment-pending-notice {
            margin-left: 10px;
            margin-right: 10px;
        }
    }


    /* ORDER CARD */

    .order-card {
        background: #fff;
        border: 1px solid #d9d9d9;
        margin-bottom: 8px;
    }


    /* TOP */

    .order-card-header {
        min-height: 42px;
        padding: 9px 14px;
        border-bottom: 1px solid #eee;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .order-number {
        font-size: 13px;
        font-weight: 700;
        color: #222;
    }

    .order-number span {
        color: #2856db;
    }


    /* STATUS */

    .order-status {
        display: inline-block;

        padding: 4px 8px;

        font-size: 9px;
        line-height: 1.2;
        font-weight: 700;

        text-transform: uppercase;

        border: 1px solid #ddd;
        background: #f4f7ff;
        color: #2856db;
    }

    .status-placed,
    .status-confirmed,
    .status-processing {
        background: #f4f7ff;
        color: #2856db;
        border-color: #c9d7ff;
    }

    .status-printing {
        background: #fff8e6;
        color: #9a6700;
        border-color: #ead69a;
    }

    .status-shipped {
        background: #eefaf2;
        color: #18794e;
        border-color: #b7dfc7;
    }

    .status-delivered {
        background: #eaf8ef;
        color: #167344;
        border-color: #b7dfc7;
    }

    .status-cancelled {
        background: #fff4f4;
        color: #b42318;
        border-color: #f0caca;
    }

    .status-payment-pending,
    .status-pending {
        background: #fff8e6;
        color: #9a6700;
        border-color: #ead69a;
    }

    .status-payment-failed,
    .status-failed {
        background: #fff4f4;
        color: #b42318;
        border-color: #f0caca;
    }


    /* BODY */

    .order-card-body {
        padding: 9px 14px;
    }

    .order-info {
        display: grid;

        grid-template-columns:
            1.2fr 1fr 1fr .8fr auto;

        align-items: center;

        gap: 15px;
    }

    .order-info-item {
        min-width: 0;
    }

    .order-info-label {
        display: block;

        font-size: 9px;
        line-height: 1.2;

        color: #999;

        text-transform: uppercase;

        margin-bottom: 3px;
    }

    .order-info-value {
        display: block;

        font-size: 12px;
        line-height: 1.3;

        font-weight: 600;

        color: #333;

        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    /* VIEW BUTTON */

    .order-card-footer {
        padding: 0;
        border-top: 0;

        display: flex;
        justify-content: flex-end;

        position: absolute;
        right: 14px;
        bottom: 9px;
    }

    .order-card {
        position: relative;
    }

    .view-order-btn {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 4px;

        height: 32px;

        padding: 0 11px;

        background: #2856db;
        border: 1px solid #2856db;

        color: #fff;

        font-size: 10px;
        font-weight: 700;

        text-decoration: none;
    }

    .view-order-btn:hover {
        background: #1f46bd;
        border-color: #1f46bd;
        color: #fff;
    }


    /* EMPTY */

    .empty-orders {
        background: #fff;
        border: 1px solid #ddd;
        padding: 30px 15px;
        text-align: center;
    }

    .empty-orders i {
        font-size: 28px;
        color: #2856db;
    }

    .empty-orders h3 {
        margin: 5px 0 3px;
        font-size: 16px;
    }

    .empty-orders p {
        margin: 0;
        font-size: 12px;
        color: #777;
    }


    /* MOBILE */

    @media (max-width: 767px) {

        .orders-section {
            padding: 20px 8px 30px;
        }

        .orders-header {
            margin-bottom: 14px;
        }

        .orders-header h1 {
            font-size: 23px;
        }

        .orders-header p {
            font-size: 11px;
        }

        .order-card-header {
            padding: 8px 10px;
        }

        .order-number {
            font-size: 12px;
        }

        .order-card-body {
            padding: 8px 10px;
            padding-bottom: 48px;
        }

        .order-info {
            grid-template-columns: repeat(2, 1fr);
            gap: 9px 12px;
        }

        .order-info-value {
            font-size: 11px;
        }

        .order-card-footer {
            right: 10px;
            bottom: 9px;
        }

        .view-order-btn {
            height: 29px;
            padding: 0 10px;
            font-size: 10px;
        }

    }
</style>

@endsection



@section('content')

<main>

    <section class="orders-section">

        <div class="container">

            <div class="orders-wrapper">


                <div class="orders-header">

                    <h1>
                        My Orders
                    </h1>

                    <p>
                        View and manage your PrintHomeDelivery orders.
                    </p>

                </div>


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


                @if($orders->count())


                @foreach($orders as $order)

                @php
                $status = strtolower($order->status ?? 'placed');

                $statusClass = 'status-' . str_replace(
                ' ',
                '-',
                $status
                );
                @endphp


                <div class="order-card">


                    <div class="order-card-header">

                        <div class="order-number">

                            Order

                            <span>
                                {{ $order->order_number ?? $order->order_id ?? $order->id }}
                            </span>

                        </div>


                        <span class="order-status {{ $statusClass }}">

                            {{ ucfirst(str_replace('_', ' ', $status)) }}

                        </span>

                    </div>



                    <div class="order-card-body">

                        <div class="order-info">


                            <div class="order-info-item">

                                <span class="order-info-label">
                                    Order Date
                                </span>

                                <span class="order-info-value">

                                    {{ optional($order->created_at)->format('d M Y, h:i A') }}

                                </span>

                            </div>


                            <div class="order-info-item">

                                <span class="order-info-label">
                                    Mobile
                                </span>

                                <span class="order-info-value">

                                    {{ $order->mobile }}

                                </span>

                            </div>


                            <div class="order-info-item">

                                <span class="order-info-label">
                                    Payment
                                </span>

                                <span class="order-info-value">

                                    {{ strtoupper($order->payment_method ?? '-') }}

                                </span>

                            </div>


                            <div class="order-info-item">

                                <span class="order-info-label">
                                    Total
                                </span>

                                <span class="order-info-value">

                                    ₹{{ number_format($order->grand_total ?? $order->total ?? 0, 2) }}

                                </span>

                            </div>


                        </div>

                    </div>



                    <div class="order-card-footer">

                        <a
                            href="{{ route('my-orders.view', $order->id) }}"
                            class="view-order-btn">

                            <i class="bi bi-eye"></i>

                            View Order

                        </a>

                    </div>


                </div>


                @endforeach


                @else


                <div class="empty-orders">

                    <i class="bi bi-receipt"></i>

                    <h3>
                        No Orders Yet
                    </h3>

                    <p>
                        You haven't placed any orders yet.
                    </p>

                </div>


                @endif


            </div>

        </div>

    </section>

</main>

@endsection