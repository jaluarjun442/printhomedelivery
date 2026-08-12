@extends('layouts.web.web')


@section('custom_header')

<style>
 

    .about-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 45px 15px 60px;
    }


    .about-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }


    .about-page-header {
        text-align: center;
        margin-bottom: 30px;
    }


    .about-page-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #222;
    }


    .about-page-header p {
        margin: 8px auto 0;
        max-width: 700px;
        font-size: 13px;
        line-height: 1.7;
        color: #777;
    }


    .about-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 25px;
        margin-bottom: 15px;
    }


    .about-card h2 {
        margin: 0 0 12px;
        font-size: 20px;
        font-weight: 800;
        color: #222;
    }


    .about-card h2 i {
        color: #2856db;
        margin-right: 6px;
    }


    .about-card p {
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.8;
        color: #666;
    }


    .about-card p:last-child {
        margin-bottom: 0;
    }



    .about-intro {
        border-left: 3px solid #2856db;
        background: #f4f7ff;
    }


    .about-intro h2 {
        color: #2856db;
    }



    .about-steps {
        margin-top: 15px;
    }


    .about-step {
        height: 100%;
        background: #fff;
        border: 1px solid #ddd;
        padding: 20px;
    }


    .about-step-number {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
        background: #eaf0ff;
        border: 1px solid #c9d7ff;
        color: #2856db;
        font-size: 14px;
        font-weight: 800;
    }


    .about-step h3 {
        margin: 0 0 7px;
        font-size: 15px;
        font-weight: 800;
        color: #222;
    }


    .about-step p {
        margin: 0;
        font-size: 12px;
        line-height: 1.7;
        color: #777;
    }



    .about-feature {
        height: 100%;
        background: #fff;
        border: 1px solid #ddd;
        padding: 20px;
    }


    .about-feature-icon {
        color: #2856db;
        font-size: 25px;
        margin-bottom: 10px;
    }


    .about-feature h3 {
        margin: 0 0 7px;
        font-size: 15px;
        font-weight: 800;
        color: #222;
    }


    .about-feature p {
        margin: 0;
        font-size: 12px;
        line-height: 1.7;
        color: #777;
    }



    .about-note {
        background: #fff;
        border: 1px dashed #ccc;
        padding: 18px 20px;
    }


    .about-note p {
        margin: 0;
        font-size: 12px;
        line-height: 1.8;
        color: #666;
    }



    .about-contact {
        background: #f4f7ff;
        border: 1px solid #c9d7ff;
        padding: 22px 25px;
    }


    .about-contact h2 {
        color: #2856db;
    }


    .about-contact p {
        margin-bottom: 5px;
    }


    .about-contact a {
        color: #2856db;
        text-decoration: none;
        font-weight: 600;
    }


    @media (max-width: 767px) {

        .about-section {
            padding: 28px 12px 40px;
        }


        .about-page-header {
            margin-bottom: 20px;
        }


        .about-page-header h1 {
            font-size: 25px;
        }


        .about-page-header p {
            font-size: 12px;
        }


        .about-card {
            padding: 18px 15px;
        }


        .about-card h2 {
            font-size: 18px;
        }


        .about-step,
        .about-feature {
            margin-bottom: 12px;
        }

    }
</style>

@endsection



@section('content')

<main>

    <section class="about-section">

        <div class="container">

            <div class="about-wrapper">

                <div class="about-page-header">

                    <h1>
                        About PrintHomeDelivery
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
                        PrintHomeDelivery is a Gujarat-based online
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

                        Why PrintHomeDelivery?

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
                        PrintHomeDelivery is based in Gujarat and is
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

                        <a href="tel:+919104470244">
                            +91-9104470244
                        </a>
                    </p>

                    <p>
                        <strong>Email:</strong>

                        <a href="mailto:info@printhomedelivery.com">
                            info@printhomedelivery.com
                        </a>
                    </p>

                </div>


            </div>

        </div>

    </section>

</main>

@endsection