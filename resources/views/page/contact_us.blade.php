@extends('layouts.web.web')


@section('custom_header')


@endsection



@section('content')

<main>

    <section class="contact-section">

        <div class="container">

            <div class="contact-wrapper">


                <div class="contact-page-header">

                    <h1>
                        Contact Us
                    </h1>

                    <p>
                        Have a question about your printing order,
                        delivery or our services? Get in touch with us.
                    </p>

                </div>



                <div class="contact-card">

                    <h2>

                        <i class="bi bi-headset"></i>

                        Get in Touch

                    </h2>


                    <div class="row">


                        <div class="col-md-4 mb-3">

                            <div class="contact-info-box">

                                <div class="contact-info-icon">

                                    <i class="bi bi-telephone"></i>

                                </div>

                                <h3>
                                    Phone
                                </h3>

                                <p>

                                    <a href="tel:+{{ store_data()['phone'] }}">
                                        {{ store_data()['phone'] }}
                                    </a>

                                </p>

                            </div>

                        </div>



                        <div class="col-md-4 mb-3">

                            <div class="contact-info-box">

                                <div class="contact-info-icon">

                                    <i class="bi bi-envelope"></i>

                                </div>

                                <h3>
                                    Email
                                </h3>

                                <p>

                                    <a href="mailto:{{ $store_data['email'] }}">
                                        {{ $store_data['email'] }}
                                    </a>

                                </p>

                            </div>

                        </div>



                        <div class="col-md-4 mb-3">

                            <div class="contact-info-box">

                                <div class="contact-info-icon">

                                    <i class="bi bi-geo-alt"></i>

                                </div>

                                <h3>
                                    Location
                                </h3>

                                <p>
                                    Gujarat, India
                                </p>

                            </div>

                        </div>


                    </div>

                </div>

                <div class="contact-card">

                    <h2>

                        <i class="bi bi-chat-left-text"></i>

                        Send Us a Message

                    </h2>

                    <form
                        action="javascript:void(0);"
                        method="POST"
                        onsubmit="return false;">

                        <div class="row">


                            <div class="col-md-6">

                                <div class="contact-form-group">

                                    <label for="contact_name">
                                        Full Name
                                    </label>

                                    <input
                                        type="text"
                                        id="contact_name"
                                        name="name"
                                        class="contact-form-control"
                                        placeholder="Enter your name">

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="contact-form-group">

                                    <label for="contact_email">
                                        Email Address
                                    </label>

                                    <input
                                        type="email"
                                        id="contact_email"
                                        name="email"
                                        class="contact-form-control"
                                        placeholder="Enter your email">

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="contact-form-group">

                                    <label for="contact_mobile">
                                        Mobile Number
                                    </label>

                                    <input
                                        type="tel"
                                        id="contact_mobile"
                                        name="mobile"
                                        class="contact-form-control"
                                        placeholder="Enter your mobile number">

                                </div>

                            </div>



                            <div class="col-md-6">

                                <div class="contact-form-group">

                                    <label for="contact_subject">
                                        Subject
                                    </label>

                                    <input
                                        type="text"
                                        id="contact_subject"
                                        name="subject"
                                        class="contact-form-control"
                                        placeholder="Enter subject">

                                </div>

                            </div>



                            <div class="col-md-12">

                                <div class="contact-form-group">

                                    <label for="contact_message">
                                        Message
                                    </label>

                                    <textarea
                                        id="contact_message"
                                        name="message"
                                        class="contact-form-control"
                                        placeholder="Write your message"></textarea>

                                </div>

                            </div>


                        </div>


                        <button
                            type="submit"
                            class="contact-submit-btn"

                            style="">

                            <i class="bi bi-send"></i>

                            Send Message

                        </button>

                    </form>



                </div>


                <div class="contact-card">

                    <h2>

                        <i class="bi bi-box-seam"></i>

                        Existing Order?

                    </h2>

                    <p>
                        If you are contacting us about an existing
                        printing order, please keep your order number
                        ready. This helps us identify your order and
                        assist you more quickly.
                    </p>

                    <p style="margin-bottom:0;">

                        For example:
                        <strong style="color:#2856db;">
                            OF260811CZ1TF4
                        </strong>

                    </p>

                </div>


            </div>

        </div>

    </section>

</main>

@endsection