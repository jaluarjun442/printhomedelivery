@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
<link href="{{ asset('web_assets/css/bootstrap-icons.min.css') }}" rel="stylesheet">
<title>Print Ki Dukan | Online Printing & Home Delivery in India</title>
<meta name="keywords" content="online printing, print documents online, home delivery printing, online document printing, print and delivery India">
<meta name="description" content="Print your documents online with Print Ki Dukan and get high-quality prints delivered to your home or office. Upload your files, choose printing options, place your order and track delivery online.">
<link rel="canonical" href="{{ url('/') }}">

@endsection

@section('content')
<main class="home-section-bg">
    <section class="py-5 home-section-bg">

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
                            Trusted Printing Service
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

                    <img src="https://printkidukan.com/img/pkd_banner_t.webp"
                        class="img-fluid home-hero-image"
                        width="522"
                        height="576"
                        alt="Online document printing and home delivery"
                        fetchpriority="high"
                        loading="eager"
                        decoding="async">
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
        <div class="row home-pricing-row">
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

                                    <a href="{{ route('upload') }}" class="btn btn-primary rounded-0 py-3 fw-semibold">
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

                                    <span class="display-2 fw-bold">
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

                                    <a href="{{ route('upload') }}" class="btn btn-outline-dark rounded-0 py-3 fw-semibold">
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

                                    <a href="{{ route('upload') }}" class="btn btn-outline-dark rounded-0 py-3 fw-semibold">
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

                                        <div class="avatar home-avatar-orange">
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

                                        <div class="avatar home-avatar-pink;">
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

    <section class="text-center py-5" style="background:#f4eee0;">

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