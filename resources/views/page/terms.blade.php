@extends('layouts.web.web')


@section('custom_header')

<style>
    .terms-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 45px 15px 60px;
    }

    .terms-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }

    .terms-page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .terms-page-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #222;
    }

    .terms-page-header p {
        margin: 8px auto 0;
        max-width: 700px;
        font-size: 13px;
        line-height: 1.7;
        color: #777;
    }

    .terms-notice {
        background: #f4f7ff;
        border: 1px solid #c9d7ff;
        border-left: 3px solid #2856db;
        padding: 18px 20px;
        margin-bottom: 15px;
    }

    .terms-notice p {
        margin: 0;
        font-size: 12px;
        line-height: 1.8;
        color: #555;
    }

    .terms-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 25px;
        margin-bottom: 15px;
    }

    .terms-card h2 {
        margin: 0 0 12px;
        font-size: 20px;
        font-weight: 800;
        color: #222;
    }

    .terms-card h2 i {
        color: #2856db;
        margin-right: 6px;
    }

    .terms-card h3 {
        margin: 18px 0 8px;
        font-size: 15px;
        font-weight: 700;
        color: #333;
    }

    .terms-card p {
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.8;
        color: #666;
    }

    .terms-card p:last-child {
        margin-bottom: 0;
    }

    .terms-card ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .terms-card li {
        margin-bottom: 7px;
        font-size: 13px;
        line-height: 1.7;
        color: #666;
    }

    .terms-contact {
        background: #f4f7ff;
        border: 1px solid #c9d7ff;
        padding: 22px 25px;
    }

    .terms-contact h2 {
        margin: 0 0 10px;
        color: #2856db;
        font-size: 20px;
        font-weight: 800;
    }

    .terms-contact p {
        margin: 0 0 5px;
        font-size: 13px;
        color: #666;
    }

    .terms-contact a {
        color: #2856db;
        text-decoration: none;
        font-weight: 600;
    }

    @media (max-width: 767px) {

        .terms-section {
            padding: 28px 12px 40px;
        }

        .terms-page-header {
            margin-bottom: 20px;
        }

        .terms-page-header h1 {
            font-size: 25px;
        }

        .terms-page-header p {
            font-size: 12px;
        }

        .terms-card {
            padding: 18px 15px;
        }

        .terms-card h2 {
            font-size: 18px;
        }

    }
</style>

@endsection



@section('content')

<main>

    <section class="terms-section">

        <div class="container">

            <div class="terms-wrapper">

                <div class="terms-page-header">

                    <h1>
                        Terms & Conditions
                    </h1>

                    <p>
                        Please read these terms carefully before using
                        PrintHomeDelivery or placing a printing order.
                    </p>

                </div>

                <div class="terms-notice">

                    <p>

                        <strong>
                            By using PrintHomeDelivery, creating an
                            account or placing an order, you agree to
                            these Terms & Conditions.
                        </strong>

                        If you do not agree with these terms, please do
                        not use our website or services.

                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-printer"></i>

                        1. Our Services

                    </h2>

                    <p>
                        PrintHomeDelivery provides online document
                        printing and delivery services. Customers can
                        upload documents, select available printing
                        requirements, place an order and receive the
                        printed documents through courier delivery.
                    </p>

                    <p>
                        Available printing options, paper types,
                        binding options, delivery locations and other
                        services may vary from time to time.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-person"></i>

                        2. User Account

                    </h2>

                    <p>
                        Certain features of PrintHomeDelivery may
                        require you to provide your mobile number or
                        other information to access your account and
                        services.
                    </p>

                    <p>
                        You are responsible for providing accurate
                        information and for maintaining the security of
                        access to your account.
                    </p>

                    <p>
                        You should notify us if you believe that your
                        account has been accessed or used without your
                        authorization.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-cloud-arrow-up"></i>

                        3. Document Upload

                    </h2>

                    <p>
                        Customers are responsible for all documents and
                        files uploaded to PrintHomeDelivery.
                    </p>

                    <ul>

                        <li>
                            You must have the necessary rights or
                            permission to reproduce the uploaded
                            documents.
                        </li>

                        <li>
                            Uploaded files should contain the correct
                            content and should be suitable for the
                            selected printing requirements.
                        </li>

                        <li>
                            You must not upload files containing
                            unlawful or prohibited content.
                        </li>

                        <li>
                            You should review your documents before
                            placing an order.
                        </li>

                    </ul>

                </div>



                <div class="terms-card">

                    <h2>

                        <i class="bi bi-shield-exclamation"></i>

                        4. Prohibited Use

                    </h2>

                    <p>
                        You must not use PrintHomeDelivery to print,
                        reproduce, distribute or facilitate unlawful
                        material or material that violates the rights
                        of another person or organization.
                    </p>

                    <p>
                        This includes, where applicable, material that
                        infringes copyright, trademarks, intellectual
                        property rights, privacy rights or other legal
                        rights.
                    </p>

                    <p>
                        We reserve the right to refuse or cancel an
                        order where we reasonably believe that the
                        requested service may violate applicable law or
                        these terms.
                    </p>

                </div>

                <div class="terms-card">

                    <h2>

                        <i class="bi bi-sliders"></i>

                        5. Printing Requirements

                    </h2>

                    <p>
                        Customers are responsible for selecting the
                        correct printing requirements before placing an
                        order.
                    </p>

                    <ul>

                        <li>
                            Print type or colour mode.
                        </li>

                        <li>
                            Paper type and available GSM options.
                        </li>

                        <li>
                            Single-sided or double-sided printing.
                        </li>

                        <li>
                            Number of copies.
                        </li>

                        <li>
                            Binding option, where available.
                        </li>

                        <li>
                            Delivery address and pincode.
                        </li>

                    </ul>

                    <p>
                        Orders are processed according to the
                        specifications submitted by the customer.
                    </p>

                </div>

                <div class="terms-card">

                    <h2>

                        <i class="bi bi-calculator"></i>

                        6. Pricing

                    </h2>

                    <p>
                        The total price of an order may include printing
                        charges, binding charges, delivery charges and
                        other applicable charges displayed during
                        checkout.
                    </p>

                    <p>
                        Prices may vary depending on the selected
                        options, number of pages, copies, destination
                        and other applicable factors.
                    </p>

                    <p>
                        The price displayed at checkout before order
                        confirmation will be the applicable order
                        amount, subject to correction of any obvious
                        technical or pricing error.
                    </p>

                </div>



                <div class="terms-card">

                    <h2>

                        <i class="bi bi-credit-card"></i>

                        7. Payments

                    </h2>

                    <p>
                        PrintHomeDelivery may offer payment methods
                        including Cash on Delivery and online payment
                        options such as Razorpay, depending on
                        availability.
                    </p>

                    <p>
                        Online payments are processed through the
                        applicable payment gateway provider and are
                        subject to the provider's terms and policies.
                    </p>

                    <p>
                        An online payment is considered successfully
                        received only after confirmation from the
                        payment system.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-check2-circle"></i>

                        8. Order Confirmation

                    </h2>

                    <p>
                        After placing an order, an order number or
                        confirmation may be provided to the customer.
                    </p>

                    <p>
                        An order may be reviewed before processing. We
                        reserve the right to cancel or refuse an order
                        where there is a legitimate reason, including
                        technical errors, suspected misuse, unavailable
                        services or prohibited content.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-x-circle"></i>

                        9. Order Cancellation

                    </h2>

                    <p>
                        Cancellation availability may depend on the
                        current processing status of an order.
                    </p>

                    <p>
                        Once an order has entered printing, packing or
                        dispatch processing, cancellation may no longer
                        be possible.
                    </p>

                    <p>
                        Any eligible cancellation and refund will be
                        handled according to our applicable Refund &
                        Cancellation Policy.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-arrow-counterclockwise"></i>

                        10. Refunds & Printing Issues

                    </h2>

                    <p>
                        If you receive an incorrect print, wrong product
                        or a significant quality issue caused by our
                        processing, you should contact us with your
                        order details as soon as reasonably possible.
                    </p>

                    <p>
                        We will review the issue and, where eligible,
                        provide an appropriate resolution such as
                        reprinting, replacement or refund according to
                        our Refund & Cancellation Policy.
                    </p>

                    <p>
                        Issues caused by incorrect files, incorrect
                        customer-selected options or content supplied
                        incorrectly by the customer may not qualify for
                        a refund or replacement.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-truck"></i>

                        11. Delivery

                    </h2>

                    <p>
                        Printed orders may be delivered through
                        third-party courier partners.
                    </p>

                    <p>
                        Customers are responsible for providing an
                        accurate and complete delivery address, mobile
                        number and pincode.
                    </p>

                    <p>
                        Delivery estimates are approximate and may be
                        affected by courier operations, weather,
                        holidays, destination restrictions, address
                        issues or circumstances outside our reasonable
                        control.
                    </p>

                </div>

                <div class="terms-card">

                    <h2>

                        <i class="bi bi-geo-alt"></i>

                        12. Delivery Issues

                    </h2>

                    <p>
                        If delivery cannot be completed because of an
                        incorrect address, unavailable recipient,
                        incorrect contact details or other customer-side
                        issues, additional delivery or re-shipping
                        charges may apply where applicable.
                    </p>

                    <p>
                        Customers should ensure that someone is
                        available to receive the package when required.
                    </p>

                </div>



                <div class="terms-card">

                    <h2>

                        <i class="bi bi-person-check"></i>

                        13. Customer Responsibility

                    </h2>

                    <p>
                        You are responsible for:
                    </p>

                    <ul>

                        <li>
                            Providing accurate personal and delivery
                            information.
                        </li>

                        <li>
                            Uploading the correct documents.
                        </li>

                        <li>
                            Selecting the correct printing options.
                        </li>

                        <li>
                            Ensuring that uploaded material can legally
                            be reproduced.
                        </li>

                        <li>
                            Reviewing order details before confirming
                            the order.
                        </li>

                    </ul>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-file-earmark-lock"></i>

                        14. Intellectual Property

                    </h2>

                    <p>
                        The PrintHomeDelivery website, branding,
                        software, design, text, graphics and other
                        website content may be protected by applicable
                        intellectual property laws.
                    </p>

                    <p>
                        You may not copy, reproduce, modify, distribute
                        or commercially exploit our website content
                        without appropriate permission.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-diagram-3"></i>

                        15. Third-Party Services

                    </h2>

                    <p>
                        Our services may depend on third-party
                        providers including payment gateways, courier
                        companies, hosting providers, storage services
                        and other technology providers.
                    </p>

                    <p>
                        Availability and performance of these services
                        may be outside our direct control.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-globe2"></i>

                        16. Website Availability

                    </h2>

                    <p>
                        We aim to maintain reliable access to
                        PrintHomeDelivery, but temporary interruptions
                        may occur because of maintenance, technical
                        issues, network problems or other circumstances.
                    </p>

                    <p>
                        We do not guarantee uninterrupted or
                        error-free availability of the website.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-exclamation-triangle"></i>

                        17. Limitation of Liability

                    </h2>

                    <p>
                        To the extent permitted by applicable law,
                        PrintHomeDelivery will not be responsible for
                        losses or delays caused by circumstances beyond
                        our reasonable control, including third-party
                        courier delays, payment gateway failures,
                        internet outages or technical interruptions.
                    </p>

                    <p>
                        Nothing in these terms is intended to exclude
                        or limit any liability or consumer rights that
                        cannot legally be excluded or limited under
                        applicable law.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-shield-lock"></i>

                        18. Privacy

                    </h2>

                    <p>
                        Your use of PrintHomeDelivery is also subject
                        to our Privacy Policy, which explains how we
                        collect, use, store and protect information.
                    </p>

                    <p>
                        By using our services, you acknowledge that you
                        have read and understood our Privacy Policy.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-arrow-repeat"></i>

                        19. Changes to These Terms

                    </h2>

                    <p>
                        We may update these Terms & Conditions from time
                        to time to reflect changes in our services,
                        technology, business practices or applicable
                        requirements.
                    </p>

                    <p>
                        Updated terms will be published on this page.
                        Continued use of the website after changes are
                        published may constitute acceptance of the
                        updated terms, to the extent permitted by law.
                    </p>

                </div>


                <div class="terms-card">

                    <h2>

                        <i class="bi bi-bank"></i>

                        20. Governing Law

                    </h2>

                    <p>
                        These Terms & Conditions shall be governed by
                        the applicable laws of India.
                    </p>

                    <p>
                        Any disputes will be subject to the jurisdiction
                        of the appropriate courts having jurisdiction
                        over the applicable location, subject to
                        applicable law.
                    </p>

                </div>



                <div class="terms-contact">

                    <h2>

                        <i class="bi bi-headset"></i>

                        Contact Us

                    </h2>

                    <p>
                        If you have any questions regarding these Terms
                        & Conditions, please contact us.
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

                        <a href="mailto:info@printhomedelivery.com">
                            info@printhomedelivery.com
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