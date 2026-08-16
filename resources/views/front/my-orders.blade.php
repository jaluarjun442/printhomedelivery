@extends('layouts.web.web')


@section('custom_header')

<title>My Orders | Print Ki Dukan</title>
<meta name="keywords" content="my printing orders, Print Ki Dukan orders, printing order history, online print orders, document printing orders">
<meta name="description" content="View and manage your Print Ki Dukan printing orders. Check your previous orders, order details, payment status and delivery information in one place.">
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