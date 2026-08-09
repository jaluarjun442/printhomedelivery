@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* ==========================================
   PRINT CALCULATOR
========================================== */

    .print-calculator-section {
        background: #fbf9f4;
    }


    /* ==========================================
   TITLE
========================================== */

    .calculator-title {
        font-size: 34px;
        line-height: 1.2;
        color: #111;
    }

    .calculator-title i {
        font-size: 21px;
        vertical-align: middle;
    }


    /* ==========================================
   CARD
========================================== */

    .calculator-card {
        background: #fff;
        border: 1px solid #d8d8d8;
        border-radius: 0;
        box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.08);
    }


    /* ==========================================
   BADGES
========================================== */

    .calculator-badge,
    .ready-badge {
        display: inline-block;
        padding: 4px 9px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 1.5px;
    }


    /* Live Pricing */

    .calculator-badge {
        color: #d66b00;
        background: #fff7e3;
        border: 1px solid #f2c56c;
    }


    /* Ready */

    .ready-badge {
        color: #198754;
        background: #eaf6ef;
        border: 1px solid #c7e5d3;
    }


    /* ==========================================
   INPUTS
========================================== */

    .calculator-input {
        height: 36px;
        border-radius: 0;
        border-color: #d5d5d5;
        font-size: 14px;
        color: #222;
    }

    .calculator-input:focus {
        border-color: #2856db;
        box-shadow: none;
    }

    .pincode-input {
        background: #edf3ff;
    }


    /* ==========================================
   COPIES
========================================== */

    .copies-box {
        height: 77px;
        border: 1px solid #d5d5d5;

        display: flex;
        align-items: center;
        justify-content: center;

        gap: 6px;
        padding: 8px;
    }

    .quantity-btn {
        width: 30px;
        height: 30px;

        padding: 0;

        border: 1px solid #ccc;
        border-radius: 0;

        background: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 16px;
        line-height: 1;
    }

    .quantity-btn:hover {
        background: #f5f5f5;
    }

    .quantity-value {
        min-width: 32px;
        height: 30px;

        border: 1px solid #ccc;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 600;
        background: #fff;
    }


    /* ==========================================
   TWO SIDED
========================================== */

    .two-sided-box {
        min-height: 72px;

        border: 1px solid #ddd;

        padding: 14px;

        display: flex;
        align-items: center;
        justify-content: space-between;

        box-shadow: 1px 2px 3px rgba(0, 0, 0, 0.06);
    }

    .calculator-switch {
        width: 40px !important;
        height: 22px;

        cursor: pointer;
    }

    .calculator-switch:checked {
        background-color: #2856db;
        border-color: #2856db;
    }


    /* ==========================================
   BUTTONS
========================================== */

    .calculate-btn,
    .order-btn {
        height: 42px;

        border-radius: 0;

        background: #2856db;
        border-color: #2856db;

        font-weight: 600;

        box-shadow: 2px 3px 0 rgba(40, 86, 219, 0.25);
    }

    .calculate-btn:hover,
    .order-btn:hover {
        background: #214ac2;
        border-color: #214ac2;
    }


    /* ==========================================
   QUOTATION ROW
========================================== */

    .quotation-row {
        min-height: 42px;

        padding: 10px 0;

        border-bottom: 1px solid #e6e6e6;

        display: flex;
        align-items: center;
        justify-content: space-between;

        font-size: 13px;
        color: #555;
    }

    .quotation-row strong {
        color: #222;
        font-size: 14px;
    }

    .quotation-row small {
        color: #777;
    }


    /* ==========================================
   WEIGHT
========================================== */

    .weight-badge {
        display: inline-block;

        margin-left: 5px;

        padding: 3px 6px;

        border: 1px solid #ccc;

        color: #222;

        background: #fff;

        font-size: 11px;
    }


    /* ==========================================
   TOTAL
========================================== */

    .estimated-total {
        min-height: 58px;

        border: 1px solid #cbd8f7;

        border-left: 2px solid #2856db;

        background: #f3f6ff;

        padding: 10px 14px;

        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .estimated-total span {
        font-size: 10px;

        font-weight: 700;

        letter-spacing: 1.5px;

        color: #222;
    }

    .estimated-total strong {
        color: #2856db;

        font-size: 30px;

        line-height: 1;
    }


    /* ==========================================
   DELIVERY INFO
========================================== */

    .delivery-info {
        border: 1px solid #ddd;

        border-left: 2px solid #f5b400;

        padding: 11px 13px;

        min-height: 62px;
    }

    .delivery-info i {
        font-size: 13px;
    }


    /* ==========================================
   MOBILE
========================================== */

    @media (max-width: 767px) {

        .print-calculator-section {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }


        /* Title */

        .calculator-title {
            font-size: 28px;
        }


        .calculator-title i {
            font-size: 19px;
        }


        /* Card */

        .calculator-card .card-body {
            padding: 15px !important;
        }


        /* Inputs */

        .calculator-input {
            height: 44px;
            font-size: 14px;
        }


        /* Copies */

        .copies-box {
            height: 68px;
            padding: 8px;
        }


        .quantity-value {
            flex: 1;
        }


        /* Two sided */

        .two-sided-box {
            min-height: 68px;
            padding: 12px;
        }


        /* Total */

        .estimated-total strong {
            font-size: 26px;
        }


        /* Quotation */

        .quotation-card {
            margin-top: 0;
        }

    }

    .calculate-btn.loading {
        background: #829be5;
        border-color: #829be5;
        box-shadow: 2px 3px 0 rgba(40, 86, 219, 0.15);
        cursor: wait;
        opacity: 1;
    }

    .calculate-btn.loading:hover {
        background: #829be5;
        border-color: #829be5;
    }

    .calculate-spinner {
        display: inline-block;
        width: 13px;
        height: 13px;
        border: 2px solid rgba(255, 255, 255, .45);
        border-top-color: #fff;
        border-radius: 50%;
        animation: calculateSpin .7s linear infinite;
        vertical-align: -2px;
        margin-right: 7px;
    }

    @keyframes calculateSpin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endsection

@section('content')
<main>
    <section class="print-calculator-section py-4">

        <div class="container">

            <!-- ==============================
             TITLE
        =============================== -->

            <div class="text-center mb-4">

                <h1 class="calculator-title fw-bold mb-0">
                    <i class="bi bi-calculator text-primary"></i>
                    Print Cost Calculator
                </h1>

            </div>


            <!-- ==============================
             MAIN ROW
        =============================== -->

            <div class="row g-4 justify-content-center">


                <!-- =====================================
                 LEFT : ORDER SETUP
            ====================================== -->

                <div class="col-lg-6">

                    <div class="card calculator-card h-100">

                        <div class="card-body p-4">

                            <!-- Heading -->

                            <div class="text-center mb-4">

                                <h4 class="fw-bold mb-1">
                                    Order Setup
                                </h4>

                                <span class="calculator-badge">
                                    LIVE PRICING
                                </span>

                            </div>


                            <!-- =================================
                             FORM
                        ================================== -->

                            <form id="printCalculatorForm">

                                <div class="row g-3">


                                    <!-- ==========================
                                     TOTAL PAGES
                                =========================== -->

                                    <div class="col-6">

                                        <label
                                            for="totalPages"
                                            class="form-label small fw-semibold mb-1">

                                            Total Pages

                                        </label>

                                        <input
                                            type="number"
                                            class="form-control calculator-input"
                                            id="totalPages"
                                            name="total_pages"
                                            value="200"
                                            min="1"
                                            placeholder="Enter pages">

                                    </div>


                                    <!-- ==========================
                                     PINCODE
                                =========================== -->

                                    <div class="col-6">

                                        <label
                                            for="deliveryPincode"
                                            class="form-label small fw-semibold mb-1">

                                            Delivery Pincode

                                        </label>

                                        <input
                                            type="text"
                                            class="form-control calculator-input pincode-input"
                                            id="deliveryPincode"
                                            name="delivery_pincode"
                                            value="360025"
                                            maxlength="6"
                                            inputmode="numeric"
                                            placeholder="Pincode">

                                    </div>


                                    <!-- ==========================
                                     PRINT TYPE
                                =========================== -->

                                    <div class="col-6">

                                        <label
                                            for="printType"
                                            class="form-label small fw-semibold mb-1">

                                            Print Type

                                        </label>

                                        <select
                                            class="form-select calculator-input"
                                            id="printType"
                                            name="print_type">

                                            <option value="bw" selected>
                                                Black &amp; White
                                            </option>

                                            <option value="color">
                                                Color
                                            </option>

                                        </select>

                                    </div>


                                    <!-- ==========================
                                     PAPER GSM
                                =========================== -->

                                    <div class="col-6">

                                        <label
                                            for="paperGsm"
                                            class="form-label small fw-semibold mb-1">

                                            Paper GSM

                                        </label>

                                        <select
                                            class="form-select calculator-input"
                                            id="paperGsm"
                                            name="paper_gsm">

                                            <option value="75" selected>
                                                75 GSM
                                            </option>

                                            <option value="80">
                                                80 GSM
                                            </option>

                                            <option value="100">
                                                100 GSM
                                            </option>

                                        </select>

                                    </div>


                                    <!-- ==========================
                                     BINDING
                                =========================== -->

                                    <div class="col-6">

                                        <label
                                            for="bindingType"
                                            class="form-label small fw-semibold mb-1">

                                            Binding Type

                                        </label>

                                        <select
                                            class="form-select calculator-input"
                                            id="bindingType"
                                            name="binding_type">

                                            <option value="none" selected>
                                                No Staple (+₹0)
                                            </option>

                                            <option value="spiral">
                                                Spiral Binding
                                            </option>

                                            <option value="soft">
                                                Soft Binding
                                            </option>

                                            <option value="hard">
                                                Hard Binding
                                            </option>

                                        </select>

                                    </div>


                                    <!-- ==========================
                                     COPIES
                                =========================== -->

                                    <div class="col-6">

                                        <label class="form-label small fw-semibold mb-1">
                                            Copies
                                        </label>

                                        <div class="copies-box">

                                            <button
                                                type="button"
                                                class="btn quantity-btn"
                                                id="decreaseCopies">
                                                -
                                            </button>

                                            <span
                                                class="quantity-value"
                                                id="copiesValue">
                                                1
                                            </span>

                                            <button
                                                type="button"
                                                class="btn quantity-btn"
                                                id="increaseCopies">
                                                +
                                            </button>

                                            <input
                                                type="hidden"
                                                name="copies"
                                                id="copiesInput"
                                                value="1">

                                        </div>

                                    </div>

                                </div>


                                <!-- =================================
                                 TWO SIDED PRINTING
                            ================================== -->

                                <div class="two-sided-box mt-3">

                                    <div>

                                        <div class="fw-semibold">
                                            Two-Sided Printing
                                        </div>

                                        <small class="text-muted">
                                            Turn off for single-sided pages.
                                        </small>

                                    </div>


                                    <div class="form-check form-switch mb-0">

                                        <input
                                            class="form-check-input calculator-switch"
                                            type="checkbox"
                                            role="switch"
                                            id="twoSided"
                                            name="two_sided"
                                            value="1"
                                            checked>

                                    </div>

                                </div>


                                <!-- =================================
                                 CALCULATE BUTTON
                            ================================== -->
                                <button
                                    type="button"
                                    class="btn btn-primary w-100 calculate-btn mt-3"
                                    id="calculatePrice">

                                    <i class="bi bi-calculator me-2"></i>
                                    <span>Calculate Price</span>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>


                <!-- =====================================
                 RIGHT : QUOTATION
            ====================================== -->

                <div class="col-lg-5">

                    <div class="card calculator-card quotation-card h-100">

                        <div class="card-body p-4">

                            <!-- Heading -->

                            <div class="text-center mb-4">

                                <h4 class="fw-bold mb-1">
                                    Quotation Breakdown
                                </h4>

                                <p class="text-muted small mb-2">
                                    A clean estimate before you move into checkout.
                                </p>

                                <span class="ready-badge">
                                    READY
                                </span>

                            </div>


                            <!-- =================================
                             PRINTING
                        ================================== -->

                            <div class="quotation-row">

                                <span>
                                    Printing Subtotal
                                    <small>(incl. binding)</small>
                                </span>

                                <strong id="printingSubtotal">
                                    ₹96
                                </strong>

                            </div>


                            <!-- =================================
                             SHIPPING
                        ================================== -->

                            <div class="quotation-row">

                                <span>

                                    Shipping Delivery

                                    <span
                                        class="weight-badge"
                                        id="packageWeight">

                                        0.618 KG

                                    </span>

                                </span>

                                <strong id="shippingAmount">
                                    ₹71
                                </strong>

                            </div>


                            <!-- =================================
                             HANDLING
                        ================================== -->

                            <div class="quotation-row">

                                <span>
                                    Handling Fee
                                </span>

                                <strong id="handlingAmount">
                                    ₹5
                                </strong>

                            </div>


                            <!-- =================================
                             TOTAL
                        ================================== -->

                            <div class="estimated-total">

                                <span>
                                    ESTIMATED TOTAL
                                </span>

                                <strong id="estimatedTotal">
                                    ₹172
                                </strong>

                            </div>


                            <!-- =================================
                             DELIVERY
                        ================================== -->

                            <div class="delivery-info">

                                <div class="fw-bold small mb-1">

                                    <i class="bi bi-box-seam me-2"></i>

                                    CHEAPEST ROUTE

                                </div>

                                <div
                                    class="text-muted small"
                                    id="deliveryMessage">

                                    via Amazon

                                </div>

                            </div>


                            <!-- =================================
                             ORDER
                        ================================== -->

                            <button
                                type="button"
                                class="btn btn-primary w-100 order-btn"
                                id="orderNow">

                                Order Now

                                <i class="bi bi-arrow-right ms-2"></i>

                            </button>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </section>
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

</main>
<!-- /main -->
@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let copies = 1;

        $('#increaseCopies').on('click', function() {

            copies++;

            $('#copiesValue').text(copies);
            $('#copiesInput').val(copies);

        });


        $('#decreaseCopies').on('click', function() {

            if (copies > 1) {

                copies--;

                $('#copiesValue').text(copies);
                $('#copiesInput').val(copies);

            }

        });


        // ==============================
        // CALCULATE PRICE
        // ==============================
        $('#calculatePrice').on('click', function() {

            let $button = $(this);

            // Prevent multiple clicks
            if ($button.hasClass('loading')) {
                return;
            }

            // ==============================
            // GET CALCULATOR VALUES
            // ==============================

            let data = {

                total_pages: $('#totalPages').val(),

                delivery_pincode: $('#deliveryPincode').val(),

                print_type: $('#printType').val(),

                paper_gsm: $('#paperGsm').val(),

                binding_type: $('#bindingType').val(),

                copies: $('#copiesInput').val(),

                two_sided: $('#twoSided').is(':checked') ? 1 : 0

            };


            // ==============================
            // LOADING STATE
            // ==============================

            $button
                .addClass('loading')
                .prop('disabled', true)
                .html(
                    '<span class="calculate-spinner"></span>' +
                    '<span>Calculating...</span>'
                );


            // ==============================
            // TEMPORARY TEST
            // Remove this later when API is connected
            // ==============================

            setTimeout(function() {

                console.log(data);

                // Restore button
                $button
                    .removeClass('loading')
                    .prop('disabled', false)
                    .html(
                        '<i class="bi bi-calculator me-2"></i>' +
                        '<span>Calculate Price</span>'
                    );

            }, 2000);


            /*
            ==========================================
            ACTUAL API VERSION
            ==========================================

            $.ajax({

                url: '/api/calculate-price',

                type: 'POST',

                data: data,

                success: function (response) {

                    $('#printingSubtotal')
                        .text('₹' + response.printing_subtotal);

                    $('#shippingAmount')
                        .text('₹' + response.shipping);

                    $('#handlingAmount')
                        .text('₹' + response.handling_fee);

                    $('#estimatedTotal')
                        .text('₹' + response.total);

                    $('#packageWeight')
                        .text(response.weight + ' KG');

                    $('#deliveryMessage')
                        .text(
                            'Delivery in ' +
                            response.delivery_days +
                            ' days via ' +
                            response.courier
                        );

                },

                error: function (xhr) {

                    console.log(xhr.responseText);

                },

                complete: function () {

                    // Runs after success OR error

                    $button
                        .removeClass('loading')
                        .prop('disabled', false)
                        .html(
                            '<i class="bi bi-calculator me-2"></i>' +
                            '<span>Calculate Price</span>'
                        );

                }

            });
            */

        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            var slug = "{{ route('category', ['slug' => 'a']) }}";
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