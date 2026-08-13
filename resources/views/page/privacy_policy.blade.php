@extends('layouts.web.web')


@section('custom_header')

<style>
    .privacy-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 45px 15px 60px;
    }

    .privacy-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .privacy-page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .privacy-page-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #222;
    }

    .privacy-page-header p {
        margin: 8px auto 0;
        max-width: 700px;
        font-size: 13px;
        line-height: 1.7;
        color: #777;
    }

    .privacy-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 25px;
        margin-bottom: 15px;
    }

    .privacy-card h2 {
        margin: 0 0 12px;
        font-size: 20px;
        font-weight: 800;
        color: #222;
    }

    .privacy-card h2 i {
        color: #2856db;
        margin-right: 6px;
    }

    .privacy-card h3 {
        margin: 18px 0 8px;
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }

    .privacy-card p {
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.8;
        color: #666;
    }

    .privacy-card p:last-child {
        margin-bottom: 0;
    }

    .privacy-card ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .privacy-card li {
        margin-bottom: 7px;
        font-size: 13px;
        line-height: 1.7;
        color: #666;
    }

    .privacy-notice {
        background: #f4f7ff;
        border: 1px solid #c9d7ff;
        border-left: 3px solid #2856db;
        padding: 18px 20px;
        margin-bottom: 15px;
    }

    .privacy-notice p {
        margin: 0;
        font-size: 12px;
        line-height: 1.8;
        color: #555;
    }

    .privacy-contact {
        background: #f4f7ff;
        border: 1px solid #c9d7ff;
        padding: 22px 25px;
    }

    .privacy-contact h2 {
        margin: 0 0 10px;
        color: #2856db;
        font-size: 20px;
        font-weight: 800;
    }

    .privacy-contact p {
        margin: 0 0 5px;
        font-size: 13px;
        color: #666;
    }

    .privacy-contact a {
        color: #2856db;
        text-decoration: none;
        font-weight: 600;
    }

    @media (max-width: 767px) {

        .privacy-section {
            padding: 28px 12px 40px;
        }

        .privacy-page-header {
            margin-bottom: 20px;
        }

        .privacy-page-header h1 {
            font-size: 25px;
        }

        .privacy-page-header p {
            font-size: 12px;
        }

        .privacy-card {
            padding: 18px 15px;
        }

        .privacy-card h2 {
            font-size: 18px;
        }

    }
</style>

@endsection



@section('content')

<main>

    <section class="privacy-section">

        <div class="container">

            <div class="privacy-wrapper">


                <div class="privacy-page-header">

                    <h1>
                        Privacy Policy
                    </h1>

                    <p>
                        This Privacy Policy explains how
                        {{ $store_data['name'] }} collects, uses and protects
                        information when you use our website and services.
                    </p>

                </div>


                <div class="privacy-notice">

                    <p>

                        <strong>
                            Your privacy matters to us.
                        </strong>

                        We collect and use information only as reasonably
                        required to provide our printing, payment,
                        customer support and delivery services and to
                        operate and improve our website.

                    </p>

                </div>



                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-person"></i>

                        Information We Collect

                    </h2>

                    <p>
                        Depending on how you use {{ $store_data['name'] }}, we
                        may collect the following information:
                    </p>

                    <ul>

                        <li>
                            Name and contact information such as mobile
                            number and email address.
                        </li>

                        <li>
                            Delivery information such as address,
                            city, state and pincode.
                        </li>

                        <li>
                            Order details including selected printing
                            options, copies, delivery information and
                            order history.
                        </li>

                        <li>
                            Documents and files uploaded by you for
                            printing.
                        </li>

                        <li>
                            Payment-related information required to
                            process and identify your transaction.
                        </li>

                        <li>
                            Technical information such as browser,
                            device and basic website usage information
                            where applicable.
                        </li>

                    </ul>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-file-earmark-lock"></i>

                        Uploaded Documents

                    </h2>

                    <p>
                        Documents uploaded to {{ $store_data['name'] }} are
                        processed for the purpose of fulfilling your
                        printing order.
                    </p>

                    <p>
                        Access to uploaded documents may be required by
                        our printing and order-processing operations.
                        Where necessary, documents may also be handled
                        by service providers involved in fulfilling the
                        order.
                    </p>

                    <p>
                        You should not upload documents unless you are
                        authorized to provide them for printing.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-gear"></i>

                        How We Use Your Information

                    </h2>

                    <p>
                        Information collected through the website may
                        be used for purposes including:
                    </p>

                    <ul>

                        <li>
                            Creating and managing your account.
                        </li>

                        <li>
                            Processing and fulfilling printing orders.
                        </li>

                        <li>
                            Calculating printing, packaging and delivery
                            charges.
                        </li>

                        <li>
                            Arranging courier delivery of printed
                            documents.
                        </li>

                        <li>
                            Processing and verifying payments.
                        </li>

                        <li>
                            Providing customer support and resolving
                            order-related issues.
                        </li>

                        <li>
                            Detecting misuse, fraud or unauthorized
                            activity.
                        </li>

                        <li>
                            Improving website functionality and our
                            services.
                        </li>

                    </ul>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-credit-card"></i>

                        Payment Information

                    </h2>

                    <p>
                        Online payments may be processed through a
                        third-party payment gateway such as Razorpay.
                    </p>

                    <p>
                        Payment information entered during checkout may
                        be processed directly by the applicable payment
                        service provider according to its own privacy
                        policy and security practices.
                    </p>

                    <p>
                        {{ $store_data['name'] }} does not intend to store
                        sensitive card numbers, CVV information, banking
                        passwords or similar payment credentials on its
                        own servers.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-truck"></i>

                        Courier & Delivery Partners

                    </h2>

                    <p>
                        To deliver your printed documents, we may need
                        to share relevant delivery information such as
                        recipient name, address, mobile number and
                        pincode with the selected courier or delivery
                        partner.
                    </p>

                    <p>
                        We share only information reasonably required
                        for fulfilling the delivery service.
                    </p>

                </div>

                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-diagram-3"></i>

                        Third-Party Services

                    </h2>

                    <p>
                        {{ $store_data['name'] }} may use trusted third-party
                        service providers for functions such as payment
                        processing, courier delivery, hosting, storage,
                        security, analytics and website infrastructure.
                    </p>

                    <p>
                        These providers may process information only as
                        required for the services they provide to us or
                        as otherwise permitted by applicable law.
                    </p>

                </div>

                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-shield-lock"></i>

                        Data Security

                    </h2>

                    <p>
                        We take reasonable technical and organizational
                        measures to protect information against
                        unauthorized access, misuse, alteration,
                        disclosure or loss.
                    </p>

                    <p>
                        However, no internet transmission or electronic
                        storage system can be guaranteed to be completely
                        secure. You understand that use of online
                        services involves certain inherent security
                        risks.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-clock-history"></i>

                        Data Retention

                    </h2>

                    <p>
                        We retain information for as long as reasonably
                        necessary to provide our services, maintain
                        order records, provide customer support, comply
                        with legal or accounting requirements and
                        resolve disputes.
                    </p>

                    <p>
                        Uploaded documents may be retained only for as
                        long as required for order processing, support,
                        security or other legitimate operational
                        purposes, subject to our applicable practices.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-cookie"></i>

                        Cookies & Similar Technologies

                    </h2>

                    <p>
                        {{ $store_data['name'] }} may use cookies or similar
                        technologies to maintain sessions, remember
                        preferences, support website functionality and
                        understand basic website usage.
                    </p>

                    <p>
                        Disabling certain cookies may affect some
                        features or functionality of the website.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-person-check"></i>

                        Your Information

                    </h2>

                    <p>
                        Subject to applicable law, you may contact us
                        regarding information associated with your
                        account or orders and request correction of
                        inaccurate information.
                    </p>

                    <p>
                        Requests relating to deletion or access to
                        information may be subject to legal,
                        operational, security or record-keeping
                        requirements.
                    </p>

                </div>


                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-shield"></i>

                        Children's Privacy

                    </h2>

                    <p>
                        Our services are not specifically directed
                        towards children. We do not knowingly seek to
                        collect personal information from children in
                        violation of applicable law.
                    </p>

                </div>

                <div class="privacy-card">

                    <h2>

                        <i class="bi bi-arrow-repeat"></i>

                        Changes to This Privacy Policy

                    </h2>

                    <p>
                        We may update this Privacy Policy from time to
                        time to reflect changes in our services,
                        technology, legal requirements or business
                        practices.
                    </p>

                    <p>
                        The updated version will be published on this
                        page. You should review this page periodically
                        for any changes.
                    </p>

                </div>

                <div class="privacy-contact">

                    <h2>

                        <i class="bi bi-headset"></i>

                        Privacy Questions?

                    </h2>

                    <p>
                        If you have questions, concerns or requests
                        regarding this Privacy Policy or your personal
                        information, please contact us.
                    </p>

                    <p>

                        <strong>
                            Phone:
                        </strong>

                        <a href="tel:+919104470244">
                            +91-9104470244
                        </a>

                    </p>

                    <p>

                        <strong>
                            Email:
                        </strong>

                        <a href="mailto:info@{{ $store_data['name'] }}.com">
                            info@{{ $store_data['name'] }}.com
                        </a>

                    </p>

                    <p>

                        <strong>
                            Location:
                        </strong>

                        Gujarat, India

                    </p>

                </div>


            </div>

        </div>

    </section>

</main>

@endsection