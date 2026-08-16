@extends('layouts.web.web')


@section('custom_header')


@endsection



@section('content')

<main>

    <section class="disclaimer-section">

        <div class="container">

            <div class="disclaimer-wrapper">

                <div class="disclaimer-page-header">

                    <h1>
                        Disclaimer
                    </h1>

                    <p>
                        Important information about using
                        {{ $store_data['name'] }} and our printing and
                        delivery services.
                    </p>

                </div>


                <div class="disclaimer-notice">

                    <p>
                        <strong>
                            Important:
                        </strong>

                        By using {{ $store_data['name'] }}, you acknowledge
                        that you have read and understood this
                        disclaimer and agree to use the website and
                        services responsibly.
                    </p>

                </div>


                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-info-circle"></i>

                        Service Information

                    </h2>

                    <p>
                        {{ $store_data['name'] }} provides online document
                        printing and delivery services. Information
                        displayed on the website, including printing
                        options, prices, delivery charges and estimated
                        delivery times, is provided for general
                        informational and service purposes.
                    </p>

                    <p>
                        Prices and available services may change
                        depending on the selected printing requirements,
                        destination, courier availability and other
                        applicable factors.
                    </p>

                </div>

                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-file-earmark-text"></i>

                        Customer-Provided Documents

                    </h2>

                    <p>
                        Customers are responsible for the documents
                        and content they upload to {{ $store_data['name'] }}.
                    </p>

                    <ul>

                        <li>
                            You should upload only documents that you
                            are legally permitted to reproduce.
                        </li>

                        <li>
                            You are responsible for ensuring that the
                            uploaded files contain the correct content
                            and printing requirements.
                        </li>

                        <li>
                            {{ $store_data['name'] }} does not take responsibility
                            for errors contained in customer-provided
                            documents.
                        </li>

                        <li>
                            Customers should verify their documents and
                            selected printing options before placing an
                            order.
                        </li>

                    </ul>

                </div>


                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-shield-check"></i>

                        Copyright & Legal Responsibility

                    </h2>

                    <p>
                        Customers are responsible for ensuring that
                        printing or reproducing any uploaded material
                        does not violate copyright, intellectual
                        property, privacy, confidentiality or any other
                        applicable law.
                    </p>

                    <p>
                        {{ $store_data['name'] }} does not claim ownership of
                        customer-uploaded documents and does not
                        authorize customers to reproduce material that
                        they do not have permission to reproduce.
                    </p>

                </div>

                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-printer"></i>

                        Printing & Quality

                    </h2>

                    <p>
                        We make reasonable efforts to print documents
                        according to the options selected by the
                        customer.
                    </p>

                    <p>
                        However, differences may sometimes occur due to
                        the original document, file formatting, fonts,
                        colours, paper characteristics, printer
                        limitations or other technical factors.
                    </p>

                    <p>
                        If there is a significant printing error caused
                        by our processing, customers can contact us so
                        that the order can be reviewed under our
                        applicable refund and resolution policy.
                    </p>

                </div>



                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-truck"></i>

                        Delivery Disclaimer

                    </h2>

                    <p>
                        Printed orders may be delivered through
                        third-party courier partners. Delivery dates
                        and estimated delivery times are subject to
                        courier availability, destination, weather,
                        operational conditions and other circumstances
                        beyond our direct control.
                    </p>

                    <p>
                        We will make reasonable efforts to dispatch
                        orders within the applicable processing time,
                        but a specific delivery date cannot always be
                        guaranteed.
                    </p>

                </div>



                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-credit-card"></i>

                        Payments

                    </h2>

                    <p>
                        Online payments may be processed through
                        third-party payment gateway providers.
                        Payment processing is subject to the terms and
                        policies of the applicable payment provider.
                    </p>

                    <p>
                        {{ $store_data['name'] }} does not directly store
                        sensitive card, banking or payment credentials
                        submitted through the payment gateway.
                    </p>

                </div>


                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-globe2"></i>

                        Website Availability

                    </h2>

                    <p>
                        We aim to keep {{ $store_data['name'] }} available and
                        functioning properly. However, temporary
                        interruptions may occur because of maintenance,
                        technical problems, hosting issues, network
                        problems or circumstances beyond our control.
                    </p>

                    <p>
                        We do not guarantee that the website will always
                        be available without interruption or errors.
                    </p>

                </div>


                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-link-45deg"></i>

                        Third-Party Services

                    </h2>

                    <p>
                        {{ $store_data['name'] }} may use third-party services
                        such as payment gateways, courier providers,
                        hosting services and other technology providers
                        to operate and deliver our services.
                    </p>

                    <p>
                        The availability and performance of such
                        third-party services may be outside our direct
                        control.
                    </p>

                </div>



                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-exclamation-triangle"></i>

                        Limitation of Responsibility

                    </h2>

                    <p>
                        To the extent permitted by applicable law,
                        {{ $store_data['name'] }} shall not be responsible for
                        delays, interruptions, inaccuracies or losses
                        arising from circumstances outside our
                        reasonable control.
                    </p>

                    <p>
                        Nothing in this disclaimer is intended to
                        exclude or limit any rights or protections that
                        cannot legally be excluded or limited under
                        applicable law.
                    </p>

                </div>




                <div class="disclaimer-card">

                    <h2>

                        <i class="bi bi-arrow-repeat"></i>

                        Changes to This Disclaimer

                    </h2>

                    <p>
                        We may update or modify this disclaimer from
                        time to time to reflect changes to our services,
                        website or applicable requirements.
                    </p>

                    <p>
                        Any updated version will be published on this
                        page with the revised content.
                    </p>

                </div>


                <div class="disclaimer-contact">

                    <h2>

                        <i class="bi bi-headset"></i>

                        Questions?

                    </h2>

                    <p>
                        If you have any questions regarding this
                        disclaimer or our services, please contact us.
                    </p>

                    <p>

                        <strong>
                            Phone:
                        </strong>

                        <a href="tel:+{{ store_data()['phone'] }}">
                            {{ store_data()['phone'] }}
                        </a>

                    </p>

                    <p>

                        <strong>
                            Email:
                        </strong>

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