@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    .highlight-text {
        background: #ffe7a0;
    }

    @media (max-width:991px) {

        h1.display-2 {
            font-size: 3rem;
        }

    }

    .pricing-wrapper {
        border: 1px solid #e7dfd0;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .06);
    }

    .local-price,
    .online-price {
        vertical-align: middle !important;
    }


    .online-price .unit {
        font-size: 16px;
    }

    .local-price {
        font-size: 20px;
    }

    /* ---------- TABLE ---------- */

    .pricing-table {
        width: 100%;
        margin: 0;
        table-layout: fixed;
    }

    .pricing-table th,
    .pricing-table td {
        border: 1px solid #ece6d9;
        vertical-align: middle;
    }

    /* ---------- HEADER ---------- */

    .pricing-table thead th {
        background: #f8f3ea;
        padding: 10px;
        font-size: 13px;
        letter-spacing: 2px;
        color: #75695a;
        font-weight: 700;
    }

    .service-col {
        width: 50%;
        text-align: left;
    }

    .local-col {
        width: 20%;
    }

    .online-col {
        width: 30%;
        background: #FFF4D7 !important;
        color: #1e5bff !important;
    }

    /* ---------- BODY ---------- */

    .pricing-table tbody td {
        padding: 10px 10px;
        vertical-align: top;
    }

    /* ---------- SERVICE ---------- */

    .service-cell h5 {
        font-size: 15px;
        font-weight: 700;
        margin: 0 0 6px;
        line-height: 1;
    }

    .service-cell p {
        margin: 0 0 12px;
        font-size: 14px;
        color: #666;
        line-height: 1.4;
    }

    .popular-tag {
        display: inline-block;
        border: 1px solid #f1c879;
        background: #fff6df;
        color: #d97400;
        font-size: 9px;
        letter-spacing: 2px;
        font-weight: 700;
        padding: 5px 5px;
    }

    /* ---------- LOCAL ---------- */

    .local-price {
        font-size: 20px;
        color: #666;
    }

    .local-price del {
        color: #777;
    }

    /* ---------- ONLINE ---------- */

    .online-price {
        background: #FFF8E8;
        border-left: 1px solid #ecd59b !important;
    }

    .online-price .price {
        font-size: 22px;
        font-weight: 800;
        color: #111;
    }

    .online-price .unit {
        font-size: 20px;
        color: #666;
    }

    /* ---------- MOBILE ---------- */

    @media (max-width:991px) {

        .pricing-table thead th {
            padding: 14px 10px;
            font-size: 11px;
            letter-spacing: 1px;
        }

        .pricing-table tbody td {
            padding: 18px 12px;
        }

        .service-cell h5 {
            font-size: 22px;
            line-height: 1.3;
        }

        .service-cell p {
            font-size: 14px;
            line-height: 1.4;
        }

        .popular-tag {
            font-size: 10px;
            padding: 6px 8px;
            letter-spacing: 1px;
        }

        .local-price {
            font-size: 18px;
        }

        .online-price .price {
            font-size: 34px;
        }

        .online-price .unit {
            font-size: 15px;
        }
    }

    /* ---------- SMALL MOBILE ---------- */

    @media (max-width:576px) {

        .pricing-table thead th {
            padding: 12px 8px;
            font-size: 10px;
        }

        .pricing-table tbody td {
            padding: 14px 10px;
        }

        .service-cell h5 {
            font-size: 15px;
        }

        .service-cell p {
            font-size: 13px;
            margin-bottom: 10px;
        }

        .popular-tag {
            font-size: 9px;
            padding: 5px 7px;
        }

        .local-price {
            font-size: 15px;
        }

        .online-price .price {
            font-size: 15px;
        }

        .online-price .unit {
            font-size: 13px;
        }
    }

    .icon-box {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .highlight-text {
        background: #ffe7a8;
    }

    .bg-purple {
        background: #7c3aed !important;
    }

    .text-purple {
        color: #7c3aed !important;
    }

    .card {
        border-radius: 0;
    }

    .card:hover {
        transform: translateY(-4px);
        transition: .25s;
    }

    .highlight-text {
        background: #ffe7a0;
    }

    .card {
        border-radius: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);

    }

    .border-primary {
        border-top-width: 4px !important;
    }

    .card-featured {
        border: 1px solid #ddd;
        border-top: 4px solid #2b56df;
    }

    .review-section {
        background: #f4eee0;
    }

    .review-heading {
        max-width: 700px;
        margin: auto;
    }

    .review-highlight {
        background: #ffe7a0;
        color: #2b57df;
        font-style: italic;
        padding: 0 6px;
    }

    .review-card {
        border: 1px solid #e6e6e6;
        border-radius: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .05);
        transition: .3s;
    }

    .review-card:hover {
        transform: translateY(-5px);
    }

    .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        color: #fff;
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .review-name {
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 0;
    }

    .review-role {
        font-size: 13px;
        color: #666;
    }

    .review-text {
        color: #444;
        line-height: 1.8;
        font-size: 17px;
    }

    .review-verified {
        color: #188038;
        font-weight: 600;
        font-size: 14px;
    }

    .review-stars {
        color: #fbbc04;
    }

    .quote-icon {
        color: #d9d9d9;
        font-size: 28px;
        line-height: 1;
    }

    @media(max-width:991px) {

        .review-text {
            font-size: 15px;
        }

        .review-name {
            font-size: 16px;
        }

    }

    .highlight-text {
        background: #ffe7a0;
    }

    .card {
        transition: .25s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .highlight-text {
        background: #ffe7a0;
    }

    .accordion-button {
        padding: 22px 25px;
        box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
        background: #fff;
        color: #000;
    }

    .accordion-item {
        border: 1px solid #e8e8e8 !important;
        border-radius: 0;
    }

    .accordion-button::after {
        width: 34px;
        height: 34px;
        background-color: #f6f2e8;
        border-radius: 50%;
        background-position: center;
        background-size: 14px;
    }

    .accordion-button:not(.collapsed)::after {
        background-color: #2b57df;
    }

    .accordion-body {
        padding: 0 25px 25px;
        line-height: 1.8;
    }

    .highlight-text {
        background: #ffe7a0;
    }

    .feature-card {
        border-radius: 0;
        border: 1px solid #dcdcdc;
        transition: .3s;
    }

    .feature-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 .75rem 1.5rem rgba(0, 0, 0, .08) !important;
    }

    .icon-box {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-box i {
        font-size: 28px;
    }

    .bg-purple-light {
        background: #f3ebff;
    }

    .text-purple {
        color: #7c3aed;
    }
</style>
@endsection

@section('content')
<main style="background: #f4eee0;">
    <section class="py-5" style="background:#f4eee0;">

        <div class="container">

            <div class="row align-items-center">

                <!-- LEFT CONTENT -->

                <div class="col-lg-6">

                    <h1 class="display-4 fw-bold lh-2 mb-4">

                        Online Printing for

                        <br>

                        <span class="text-primary fst-italic highlight-text">
                            Notes, Assignments,
                        </span>

                        <br>

                        <span class="text-primary fst-italic highlight-text">
                            Thesis & Books.
                        </span>

                    </h1>

                    <p class="fs-4 text-secondary mb-4">

                        Upload your PDF, customize print options, and get premium-quality
                        prints delivered right to your doorstep.

                    </p>

                    <!-- Rating -->

                    <div class="d-flex flex-wrap align-items-center gap-3 mb-4">

                        <div>
                            ⭐⭐⭐⭐⭐
                            <strong>4.9</strong>
                            <span class="text-secondary">on Google</span>
                        </div>

                        <span class="text-secondary">•</span>

                        <div>
                            <strong>1 Crore+</strong>
                            <span class="text-secondary">Pages Printed</span>
                        </div>

                        <span class="text-secondary">•</span>

                        <div class="text-primary fw-semibold">
                            <i class="bi bi-patch-check-fill"></i>
                            Verified Business
                        </div>

                    </div>

                    <!-- Buttons -->

                    <div class="d-grid gap-3 d-md-flex">

                        <a href="{{ route('upload') }}"
                            class="btn btn-primary btn-lg px-5 py-3">

                            Start Printing Now

                            <i class="bi bi-arrow-right ms-2"></i>

                        </a>

                        <a href="{{ route('calculator') }}"
                            class="btn btn-outline-dark btn-lg px-5 py-3">

                            View Pricing

                        </a>

                    </div>

                    <!-- Features -->

                    <div class="d-flex flex-wrap gap-4 mt-4">

                        <div class="text-success">

                            <i class="bi bi-check-lg"></i>

                            Cash on Delivery

                        </div>

                        <div class="text-success">

                            <i class="bi bi-check-lg"></i>

                            Secure Payments

                        </div>

                        <div class="text-success">

                            <i class="bi bi-check-lg"></i>

                            Auto Delete Files

                        </div>

                    </div>

                </div>

                <!-- RIGHT IMAGE -->

                <div class="col-lg-6 text-center d-none d-lg-block">

                    <img src="https://solo.in/cdn/shop/files/executive-note-book-100-pages-2-color-printing-358332.webp?v=1742021622&width=1080"
                        class="img-fluid"
                        style="max-height:620px;">

                </div>

            </div>

        </div>

    </section>

    <div class="container margin_60_35 text-center">

        <h2 class="display-6 fw-bold mb-3">
            Premium Prints,
            <span class="px-2 text-primary fst-italic highlight-text">
                Affordable Prices.
            </span>
        </h2>
        <p>Professional printing, quality paper, and doorstep delivery—all without visiting a local print shop.
        </p>
        <div style="justify-content: center;" class="row">
            <div class="col-lg-6">
                <div class="pricing-wrapper">
                    <div class="table-responsive">
                        <table class="table pricing-table mb-0">
                            <thead>
                                <tr>
                                    <th class="service-col">SERVICE</th>
                                    <th class="local-col text-center">LOCAL SHOP</th>
                                    <th class="online-col text-center">ONLINEPRINTOUT</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td class="service-cell">
                                        <h5>Premium Digital Color</h5>
                                        <p>High-saturation laser printing</p>


                                    </td>

                                    <td class="text-center local-price">
                                        <del>₹10–₹20</del>
                                    </td>

                                    <td class="text-center online-price">
                                        <span class="price">₹1</span>
                                        <span class="unit">/page</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="service-cell">
                                        <h5>Hard Binding / Thesis</h5>
                                        <p>Golden embossed + digital print</p>
                                    </td>

                                    <td class="text-center local-price">
                                        <del>₹500–₹800</del>
                                    </td>

                                    <td class="text-center online-price">
                                        <span class="price">₹100 - ₹350</span>
                                        <span class="unit">/copy</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="service-cell">
                                        <h5>Standard B&amp;W</h5>
                                        <p>75 GSM bright white paper</p>
                                        <span class="popular-tag">
                                            MOST POPULAR
                                        </span>
                                    </td>

                                    <td class="text-center local-price">
                                        <del>₹2–₹3</del>
                                    </td>

                                    <td class="text-center online-price">
                                        <span class="price">₹0.50</span>
                                        <span class="unit">/page</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /row -->

    </div>

    <div class="text-center container margin_50_35">
        <section class="py-5" style="background:#f4eee0;">

            <div class="container">

                <div class="mb-5">

                    <h2 class="display-6 fw-bold mb-3">
                        Smarter Printing,
                        <span class="px-2 text-primary fst-italic highlight-text">
                            Better Experience.
                        </span>
                    </h2>

                    <p class="fs-4 text-secondary mb-0">
                        Premium print quality, affordable pricing, and reliable doorstep delivery—
                        everything you need in one place.
                    </p>

                </div>

                <div class="row g-4">

                    <!-- Card 1 -->

                    <div class="col-lg-4 col-md-6">

                        <div class="card feature-card h-100 shadow-sm">

                            <div class="card-body text-center p-4">

                                <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                    <i class="bi bi-file-earmark-text-fill"></i>
                                </div>

                                <h4 class="fw-bold mb-3">
                                    Bulk Savings
                                </h4>

                                <p class="text-secondary mb-0">
                                    Print more and spend less with automatic bulk discounts.
                                    Perfect for notes, assignments, books, and thesis printing.
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- Card 2 -->

                    <div class="col-lg-4 col-md-6">

                        <div class="card feature-card h-100 shadow-sm">

                            <div class="card-body text-center p-4">

                                <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                    <i class="bi bi-truck"></i>
                                </div>

                                <h4 class="fw-bold mb-3">
                                    Direct to Doorstep
                                </h4>

                                <p class="text-secondary mb-0">
                                    Upload your files online and leave the rest to us.
                                    Professionally printed orders delivered straight to your home.
                                </p>

                            </div>

                        </div>

                    </div>

                    <!-- Card 3 -->

                    <div class="col-lg-4 col-md-6">

                        <div class="card feature-card h-100 shadow-sm">

                            <div class="card-body text-center p-4">

                                <div class="icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-4">
                                    <i class="bi bi-patch-check-fill"></i>
                                </div>

                                <h4 class="fw-bold mb-3">
                                    Premium Quality
                                </h4>

                                <p class="text-secondary mb-0">
                                    Every page is printed using premium paper and professional printers.
                                    Sharp text, vibrant colors, and excellent finishing every time.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
    </div>
    <div class="text-center container margin_50_35">
        <section class="py-5">

            <div class="container">

                <!-- Heading -->

                <div class="mb-5">

                    <h2 class="display-6 fw-bold mb-3">
                        Wholesale
                        <span class="fst-italic text-primary px-2 highlight-text">
                            without the bulk order.
                        </span>
                    </h2>

                    <p class="fs-5 text-secondary mb-0">
                        Choose the paper that fits your work. Transparent pricing,
                        premium quality, and no hidden charges.
                    </p>

                </div>

                <!-- Cards -->

                <div class="row g-4">

                    <!-- Card 1 -->

                    <div class="col-lg-4">

                        <div class="card shadow-sm border-primary border-2 h-100 position-relative">

                            <div class="card-body p-4 d-flex flex-column">

                                <small class="text-uppercase text-muted fw-bold mb-4">
                                    Standard B&amp;W
                                </small>

                                <div class="mb-3">

                                    <div class="d-flex align-items-end mb-3">

                                        <span class="display-2 fw-bold text-primary lh-1">
                                            ₹0.50
                                        </span>

                                        <span class="fs-3 text-secondary ms-2 mb-2">
                                            /page
                                        </span>

                                    </div>

                                </div>

                                <div class="mb-3">

                                    <small class="text-decoration-line-through text-secondary">
                                        MRP ₹1.00
                                    </small>

                                    <span class="badge bg-primary rounded-0 position-absolute top-0 end-0 px-3 py-2">
                                        MOST POPULAR
                                    </span>

                                </div>

                                <p class="text-secondary">
                                    Ideal for notes, assignments,
                                    study material and everyday printing.
                                </p>

                                <ul class="list-unstyled mb-4">

                                    <li class="mb-2">
                                        ✔ 75 GSM Bright White Paper
                                    </li>
                                    <li class="mb-2">
                                        ✔ Crisp & Sharp Text
                                    </li>

                                    <li class="mb-2">
                                        ✔ No Ink Bleeding
                                    </li>

                                    <li>
                                        ✔ All Binding Supported
                                    </li>

                                </ul>

                                <div class="mt-auto">

                                    <a href="#" class="btn btn-primary rounded-0 py-3 fw-semibold">
                                        Order Standard Print
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Card 2 -->

                    <div class="col-lg-4">

                        <div class="card h-100">

                            <div class="card-body p-4 d-flex flex-column">

                                <small class="text-uppercase text-muted fw-bold mb-4">
                                    Premium Color
                                </small>

                                <div class="mb-3">

                                    <span class="display-2 fw-bold fw-bold">
                                        ₹1
                                    </span>

                                    <span class="text-secondary fs-5">
                                        /page
                                    </span>

                                </div>

                                <div class="mb-3">

                                    <span class="badge border border-warning text-warning rounded-0">
                                        MARKET ₹10–₹20
                                    </span>

                                </div>

                                <p class="text-secondary">
                                    Bright, vibrant colors for projects,
                                    presentations and thesis printing.
                                </p>


                                <ul class="list-unstyled mb-4">

                                    <li class="mb-2">✔ 75 GSM Paper</li>

                                    <li class="mb-2">✔ Rich Color Output</li>

                                    <li class="mb-2">✔ Binding Available</li>

                                    <li class="mb-2">✔ Fast Printing</li>

                                    <li>✔ Secure Packaging</li>

                                </ul>

                                <div class="mt-auto">

                                    <a href="#" class="btn btn-outline-dark rounded-0 py-3 fw-semibold">
                                        Print in Color
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Card 3 -->

                    <div class="col-lg-4">

                        <div class="card h-100">

                            <div class="card-body p-4 d-flex flex-column">

                                <small class="text-uppercase text-muted fw-bold mb-4">
                                    Archival 100 GSM
                                </small>

                                <div class="mb-3">

                                    <span class="display-2 fw-bold fw-bold">
                                        ₹1.9
                                    </span>

                                    <span class="text-secondary fs-5">
                                        /page
                                    </span>

                                </div>

                                <p class="text-secondary">
                                    Premium paper for thesis,
                                    dissertations and professional documents.
                                </p>

                                <ul class="list-unstyled mb-4">

                                    <li class="mb-2">
                                        ✔ 100 GSM Premium Bond
                                    </li>

                                    <li class="mb-2">
                                        ✔ University Grade
                                    </li>

                                    <li class="mb-2">
                                        ✔ Best for Hard Binding
                                    </li>

                                    <li>
                                        ✔ Gold Emboss Ready
                                    </li>

                                </ul>

                                <div class="mt-auto">

                                    <a href="#" class="btn btn-outline-dark rounded-0 py-3 fw-semibold">
                                        Print on Premium
                                    </a>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>
    </div>
    <section class="review-section py-5">

        <div class="container">

            <div class="review-heading text-center mb-5">

                <h2 class="display-6 fw-bold">
                    <span class="review-highlight">4.9 ★</span>
                    on Google, from real students
                </h2>
                <p class="text-secondary fs-5">
                    Authentic feedback from thousands of students across colleges and universities.
                </p>
            </div>
            <div class="row g-4">
                <!-- LEFT BIG REVIEW -->

                <div class="col-lg-4">

                    <div class="card review-card h-100">

                        <div class="card-body p-4">

                            <div class="d-flex mb-3">

                                <div class="avatar bg-danger">

                                    RM

                                </div>

                                <div class="ms-3">

                                    <h5 class="review-name">

                                        Rahul Mehta

                                    </h5>

                                    <div class="review-role">

                                        <i class="bi bi-patch-check"></i>

                                        Verified Student

                                    </div>

                                </div>

                            </div>

                            <div class="review-stars mb-2">

                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>

                            </div>

                            <div class="quote-icon">

                                “

                            </div>

                            <p class="review-text">
                                I ordered my final-year project and thesis printing through this website, and the experience was excellent. The print quality was sharp, the binding looked professional, and the pages were neatly packed. Delivery was on time, and the prices were much lower than nearby print shops. I'll definitely use this service again.

                            </p>

                            <div class="review-verified mt-3">

                                <i class="bi bi-patch-check-fill"></i>

                                Verified Student

                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT SIDE -->

                <div class="col-lg-8">

                    <div class="row g-4">

                        <!-- CARD -->

                        <div class="col-md-6">

                            <div class="card review-card h-100">

                                <div class="card-body">

                                    <div class="d-flex mb-3">

                                        <div class="avatar bg-success">

                                            PS

                                        </div>

                                        <div class="ms-3">

                                            <h5 class="review-name">

                                                Priya Sharma

                                            </h5>

                                            <div class="review-role">

                                                <i class="bi bi-patch-check"></i>

                                                Verified Student

                                            </div>

                                        </div>

                                    </div>

                                    <div class="review-stars mb-2">

                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>

                                    </div>

                                    <div class="quote-icon">

                                        “

                                    </div>

                                    <p class="review-text">
                                        Uploading files was simple, and my notes were printed exactly as expected. The pages were clean, colors were vibrant, and delivery was surprisingly fast. Highly recommended for students.
                                    </p>

                                    <div class="review-verified">

                                        <i class="bi bi-patch-check-fill"></i>

                                        Verified Student

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- CARD -->

                        <div class="col-md-6">

                            <div class="card review-card h-100">

                                <div class="card-body">

                                    <div class="d-flex mb-3">

                                        <div class="avatar bg-primary">

                                            AP

                                        </div>

                                        <div class="ms-3">

                                            <h5 class="review-name">

                                                Aman Patel

                                            </h5>

                                            <div class="review-role">

                                                <i class="bi bi-geo-alt"></i>

                                                Guest User

                                            </div>

                                        </div>

                                    </div>

                                    <div class="review-stars mb-2">

                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>

                                    </div>

                                    <div class="quote-icon">

                                        “

                                    </div>

                                    <p class="review-text">
                                        Great quality at an affordable price. I printed over 300 pages for my semester exams and saved a lot compared to local print shops. The entire process was smooth and hassle-free.

                                    </p>

                                    <div class="review-verified">

                                        <i class="bi bi-patch-check-fill"></i>

                                        Verified Student

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- CARD -->

                        <div class="col-md-6">

                            <div class="card review-card h-100">

                                <div class="card-body">

                                    <div class="d-flex mb-3">

                                        <div class="avatar" style="background:#b45309;">
                                            SV
                                        </div>

                                        <div class="ms-3">

                                            <h5 class="review-name">
                                                Sneha Verma
                                            </h5>

                                            <div class="review-role">
                                                <i class="bi bi-geo-alt"></i>
                                                Local User
                                            </div>

                                        </div>

                                    </div>

                                    <div class="review-stars mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                    <div class="quote-icon">
                                        &ldquo;
                                    </div>

                                    <p class="review-text">
                                        The hardcover binding for my thesis was impressive. Everything was neatly finished, and the customer support team quickly answered my questions before placing the order.
                                    </p>

                                    <div class="review-verified">

                                        <i class="bi bi-patch-check-fill"></i>

                                        Verified Student

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- CARD -->

                        <div class="col-md-6">

                            <div class="card review-card h-100">

                                <div class="card-body">

                                    <div class="d-flex mb-3">

                                        <div class="avatar" style="background:#be185d;">
                                            KJ
                                        </div>

                                        <div class="ms-3">

                                            <h5 class="review-name">
                                                Karan Joshi
                                            </h5>

                                            <div class="review-role">

                                                <i class="bi bi-patch-check"></i>

                                                Verified Student

                                            </div>

                                        </div>

                                    </div>

                                    <div class="review-stars mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>

                                    <div class="quote-icon">
                                        &ldquo;
                                    </div>

                                    <p class="review-text">

                                        Excellent service from start to finish. My documents were printed perfectly, securely packed, and delivered before the expected date. Great quality, fair pricing, and a very convenient experience.
                                    </p>

                                    <div class="review-verified">

                                        <i class="bi bi-patch-check-fill"></i>

                                        Verified Student

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="tet-center py-5" style="background:#f4eee0;">

        <div class="container">

            <!-- Heading -->

            <div class="mb-5">

                <h2 class="display-6 fw-bold mb-3">
                    Print in Minutes.
                    <span class="px-2 text-primary fst-italic highlight-text">
                        We handle the rest.
                    </span>
                </h2>

                <p class="fs-4 text-secondary mb-0">
                    From upload to delivery, every step is designed to make printing
                    simple, fast, and completely hassle-free.
                </p>

            </div>

            <!-- Steps -->

            <div class="row g-4">

                <!-- STEP 1 -->

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm h-100 border-top border-4 border-primary rounded-0">

                        <div class="card-body p-4">

                            <div class="display-4 fw-bold text-primary fst-italic mb-3">
                                01
                            </div>

                            <h3 class="h4 fw-bold mb-3">
                                Upload Your Files
                            </h3>

                            <p class="text-secondary fs-5 mb-0">
                                Upload PDFs, notes, assignments, or thesis files from
                                your phone or computer. Every file is reviewed before
                                printing to ensure the best results.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- STEP 2 -->

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm h-100 border-top border-4 border-primary rounded-0">

                        <div class="card-body p-4">

                            <div class="display-4 fw-bold text-primary fst-italic mb-3">
                                02
                            </div>

                            <h3 class="h4 fw-bold mb-3">
                                Customize Your Order
                            </h3>

                            <p class="text-secondary fs-5 mb-0">
                                Choose paper type, color or black &amp; white printing,
                                binding style, copies, and finishing options—all in a
                                few simple clicks.
                            </p>

                        </div>

                    </div>

                </div>

                <!-- STEP 3 -->

                <div class="col-lg-4">

                    <div class="card border-0 shadow-sm h-100 border-top border-4 border-primary rounded-0">

                        <div class="card-body p-4">

                            <div class="display-4 fw-bold text-primary fst-italic mb-3">
                                03
                            </div>

                            <h3 class="h4 fw-bold mb-3">
                                Fast Doorstep Delivery
                            </h3>

                            <p class="text-secondary fs-5 mb-0">
                                We professionally print, carefully package, and deliver
                                your order safely to your home, hostel, or office—ready
                                to use.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <section class="py-5" style="background:#f4eee0;">

        <div class="container">

            <!-- Heading -->

            <div class="text-center mb-5">

                <h2 class="display-6 fw-bold">
                    Frequently
                    <span class="px-2 text-primary fst-italic highlight-text">
                        Asked
                    </span>
                </h2>

                <p class="text-secondary fs-5 mt-3">
                    Find answers to the most common questions about our online printing service.
                </p>

            </div>

            <div class="row justify-content-center">

                <div class="col-lg-9">

                    <div class="accordion" id="faqAccordion">

                        <!-- FAQ 1 -->

                        <div class="accordion-item shadow-sm mb-3 border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq1">

                                    How long does delivery take?

                                </button>

                            </h2>

                            <div id="faq1"
                                class="accordion-collapse collapse show"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    Most orders are delivered within <strong>2–7 business days</strong>,
                                    depending on your location. Delivery estimates are shown during checkout.

                                </div>

                            </div>

                        </div>

                        <!-- FAQ 2 -->

                        <div class="accordion-item shadow-sm mb-3 border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button collapsed fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq2">

                                    What paper quality do you use?

                                </button>

                            </h2>

                            <div id="faq2"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    We offer premium-quality paper options including
                                    75 GSM, 100 GSM, color printing, and premium archival
                                    paper suitable for projects and thesis printing.

                                </div>

                            </div>

                        </div>

                        <!-- FAQ 3 -->

                        <div class="accordion-item shadow-sm mb-3 border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button collapsed fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq3">

                                    Can I print in color and black & white?

                                </button>

                            </h2>

                            <div id="faq3"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    Yes. You can choose between high-quality color printing
                                    and economical black & white printing while placing
                                    your order.

                                </div>

                            </div>

                        </div>

                        <!-- FAQ 4 -->

                        <div class="accordion-item shadow-sm mb-3 border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button collapsed fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq4">

                                    Are my files secure?

                                </button>

                            </h2>

                            <div id="faq4"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    Absolutely. Your uploaded files are securely stored,
                                    used only for printing your order, and are never shared
                                    with third parties.

                                </div>

                            </div>

                        </div>

                        <!-- FAQ 5 -->

                        <div class="accordion-item shadow-sm mb-3 border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button collapsed fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq5">

                                    Which binding options are available?

                                </button>

                            </h2>

                            <div id="faq5"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    We provide Spiral Binding, Soft Binding, Hard Binding,
                                    Thesis Binding, and other finishing options depending
                                    on your selected product.

                                </div>

                            </div>

                        </div>

                        <!-- FAQ 6 -->

                        <div class="accordion-item shadow-sm border-0">

                            <h2 class="accordion-header">

                                <button class="accordion-button collapsed fw-semibold fs-5"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq6">

                                    Can I order a single copy?

                                </button>

                            </h2>

                            <div id="faq6"
                                class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body text-secondary fs-5">

                                    Yes. Whether you need a single document or hundreds of
                                    copies, we accept orders of all sizes with transparent
                                    pricing.

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    <div id="stick_here"></div>
</main>
<!-- /main -->
@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            var slug = "{{ route('home', []) }}";
            $.ajax({
                url: slug + "?page=" + page,
                success: function(data) {
                    $('#product_main_container').html(data);
                    var newUrl = slug + "?page=" + page;
                    history.pushState(null, '', newUrl);
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#product_main_container").offset().top
                    }, 150);
                }
            });
        }
    });
</script>
@endsection