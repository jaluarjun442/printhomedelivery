@extends('layouts.web.web')


@section('custom_header')


@endsection



@section('content')

<main>

    <section class="about-section">

        <div class="container">

            <div class="about-wrapper">

                <div class="about-page-header">

                    <h1>
                        About {{ $store_data['name'] }}
                    </h1>

                    <p>
                        Online document printing made simple —
                        upload your files, choose your printing
                        requirements, and get your printed documents
                        delivered to your doorstep.
                    </p>

                </div>



                <div class="about-card about-intro">

                    <h2>

                        <i class="bi bi-printer"></i>

                        Your Online Printing Partner

                    </h2>

                    <p>
                        {{ $store_data['name'] }} is a Gujarat-based online
                        document printing service created to make
                        everyday printing more convenient.
                    </p>

                    <p>
                        Instead of visiting a printing shop, you can
                        upload your documents online, select the
                        required printing options, review the price
                        and place your order from wherever you are.
                    </p>

                    <p>
                        Once your order is confirmed, we print the
                        documents according to your selected
                        requirements and arrange delivery through
                        our courier partners.
                    </p>

                </div>


                <div class="about-card">

                    <h2>

                        <i class="bi bi-list-check"></i>

                        How It Works

                    </h2>


                    <div class="about-steps">

                        <div class="row">


                            <div class="col-md-3 mb-3">

                                <div class="about-step">

                                    <div class="about-step-number">
                                        1
                                    </div>

                                    <h3>
                                        Upload Documents
                                    </h3>

                                    <p>
                                        Upload your PDF and supported
                                        document files directly through
                                        our website.
                                    </p>

                                </div>

                            </div>


                            <div class="col-md-3 mb-3">

                                <div class="about-step">

                                    <div class="about-step-number">
                                        2
                                    </div>

                                    <h3>
                                        Select Options
                                    </h3>

                                    <p>
                                        Choose printing preferences,
                                        copies, paper and other available
                                        printing options.
                                    </p>

                                </div>

                            </div>


                            <div class="col-md-3 mb-3">

                                <div class="about-step">

                                    <div class="about-step-number">
                                        3
                                    </div>

                                    <h3>
                                        Place Your Order
                                    </h3>

                                    <p>
                                        Review your order, delivery
                                        details and total price before
                                        placing the order.
                                    </p>

                                </div>

                            </div>


                            <div class="col-md-3 mb-3">

                                <div class="about-step">

                                    <div class="about-step-number">
                                        4
                                    </div>

                                    <h3>
                                        We Deliver
                                    </h3>

                                    <p>
                                        We print your documents and
                                        dispatch them to your delivery
                                        address through our courier
                                        service.
                                    </p>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>
                <div class="about-card">

                    <h2>

                        <i class="bi bi-check2-circle"></i>

                        Why {{ $store_data['name'] }}?

                    </h2>


                    <div class="row">


                        <div class="col-md-4 mb-3">

                            <div class="about-feature">

                                <div class="about-feature-icon">

                                    <i class="bi bi-cloud-arrow-up"></i>

                                </div>

                                <h3>
                                    Print From Anywhere
                                </h3>

                                <p>
                                    Upload your documents online without
                                    needing to visit a physical printing
                                    shop.
                                </p>

                            </div>

                        </div>


                        <div class="col-md-4 mb-3">

                            <div class="about-feature">

                                <div class="about-feature-icon">

                                    <i class="bi bi-calculator"></i>

                                </div>

                                <h3>
                                    Clear Pricing
                                </h3>

                                <p>
                                    Review your printing and delivery
                                    charges before completing your order.
                                </p>

                            </div>

                        </div>


                        <div class="col-md-4 mb-3">

                            <div class="about-feature">

                                <div class="about-feature-icon">

                                    <i class="bi bi-box-seam"></i>

                                </div>

                                <h3>
                                    Doorstep Delivery
                                </h3>

                                <p>
                                    Your printed documents are packed and
                                    sent to the delivery address provided
                                    with your order.
                                </p>

                            </div>

                        </div>


                    </div>

                </div>


                <div class="about-card">

                    <h2>

                        <i class="bi bi-shield-check"></i>

                        Our Quality Commitment

                    </h2>

                    <p>
                        We aim to process every order according to the
                        printing specifications selected by the customer.
                        Documents are printed based on the options
                        submitted while placing the order.
                    </p>

                    <p>
                        If you receive a significantly incorrect print,
                        wrong product, or an issue caused by our
                        processing, please contact us with your order
                        details. We will review the issue and provide
                        an appropriate resolution according to our
                        refund and cancellation policy.
                    </p>

                </div>



                <div class="about-card">

                    <h2>

                        <i class="bi bi-credit-card"></i>

                        Payments

                    </h2>

                    <p>
                        We provide convenient payment options for
                        completing your printing orders. Online payments
                        are processed through our payment gateway
                        provider.
                    </p>

                    <p>
                        Payment-related information is handled through
                        the payment service provider and we do not
                        directly store sensitive card or banking
                        credentials on our website.
                    </p>

                </div>


                <div class="about-card">

                    <h2>

                        <i class="bi bi-truck"></i>

                        Printing & Delivery

                    </h2>

                    <p>
                        After an order is confirmed, the submitted
                        documents are prepared for printing according
                        to the selected specifications.
                    </p>

                    <p>
                        Once printing and packing are completed, the
                        order is handed over to a courier partner for
                        delivery. Delivery time and charges may vary
                        depending on the destination and courier service.
                    </p>

                </div>

                <div class="about-card">

                    <h2>

                        <i class="bi bi-geo-alt"></i>

                        Our Service

                    </h2>

                    <p>
                        {{ $store_data['name'] }} is based in Gujarat and is
                        focused on providing convenient online printing
                        and delivery services to customers in Gujarat
                        and eligible delivery locations.
                    </p>

                    <p>
                        Availability of delivery services may depend
                        on the customer's pincode and the courier
                        network available at the destination.
                    </p>

                </div>


                <div class="about-contact">

                    <h2>

                        <i class="bi bi-headset"></i>

                        Need Help?

                    </h2>

                    <p>
                        If you have questions about printing, an existing
                        order, delivery or a quality issue, feel free to
                        contact us.
                    </p>

                    <p>
                        <strong>Phone:</strong>

                        <a href="tel:+{{ store_data()['phone'] }}">
                            {{ store_data()['phone'] }}
                        </a>
                    </p>

                    <p>
                        <strong>Email:</strong>

                        <a href="mailto:{{ $store_data['email'] }}">
                            {{ $store_data['email'] }}
                        </a>
                    </p>

                </div>


            </div>

        </div>

    </section>

</main>

@endsection