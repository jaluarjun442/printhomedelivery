@extends('layouts.web.web')


@section('custom_header')

<style>
   

    .contact-section {
        background: #fbf9f4;
        min-height: 100vh;
        padding: 45px 15px 60px;
    }

    .contact-wrapper {
        max-width: 1000px;
        margin: 0 auto;
    }


  
    .contact-page-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .contact-page-header h1 {
        margin: 0;
        font-size: 30px;
        font-weight: 800;
        color: #222;
    }

    .contact-page-header p {
        margin: 8px auto 0;
        max-width: 700px;
        font-size: 13px;
        line-height: 1.7;
        color: #777;
    }



    .contact-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 25px;
        margin-bottom: 15px;
    }

    .contact-card h2 {
        margin: 0 0 18px;
        font-size: 20px;
        font-weight: 800;
        color: #222;
    }

    .contact-card h2 i {
        color: #2856db;
        margin-right: 6px;
    }



    .contact-info-box {
        height: 100%;
        background: #fff;
        border: 1px solid #ddd;
        padding: 20px;
    }

    .contact-info-icon {
        color: #2856db;
        font-size: 25px;
        margin-bottom: 10px;
    }

    .contact-info-box h3 {
        margin: 0 0 7px;
        font-size: 15px;
        font-weight: 800;
        color: #222;
    }

    .contact-info-box p {
        margin: 0;
        font-size: 12px;
        line-height: 1.7;
        color: #777;
    }

    .contact-info-box a {
        color: #2856db;
        text-decoration: none;
        font-weight: 600;
    }



    .contact-form-group {
        margin-bottom: 15px;
    }

    .contact-form-group label {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
        font-weight: 700;
        color: #444;
    }

    .contact-form-control {
        width: 100%;
        height: 42px;
        padding: 8px 12px;
        border: 1px solid #ccc;
        background: #fff;
        color: #222;
        font-size: 13px;
        outline: none;
    }

    textarea.contact-form-control {
        height: 120px;
        resize: vertical;
    }

    .contact-form-control:focus {
        border-color: #2856db;
        box-shadow: 0 0 0 2px #f4f7ff;
    }


    .contact-submit-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        min-width: 140px;
        height: 44px;
        padding: 0 18px;
        background: #2856db;
        border: 1px solid #2856db;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
    }

    .contact-submit-btn:hover {
        background: #1f46bd;
        border-color: #1f46bd;
        color: #fff;
    }



    .contact-notice {
        margin-top: 15px;
        padding: 13px 15px;
        background: #f4f7ff;
        border: 1px dashed #c9d7ff;
        color: #666;
        font-size: 12px;
        line-height: 1.7;
    }


    @media (max-width: 767px) {

        .contact-section {
            padding: 28px 12px 40px;
        }

        .contact-page-header {
            margin-bottom: 20px;
        }

        .contact-page-header h1 {
            font-size: 25px;
        }

        .contact-page-header p {
            font-size: 12px;
        }

        .contact-card {
            padding: 18px 15px;
        }

        .contact-card h2 {
            font-size: 18px;
        }

        .contact-info-box {
            margin-bottom: 12px;
        }

    }
</style>

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

                                    <a href="tel:+919104470244">
                                        +91-9104470244
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

                                    <a href="mailto:info@offerlity.shop">
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