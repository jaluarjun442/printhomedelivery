@extends('layouts.web.web')
@section('custom_header')

<title>Printing Price Calculator | Print Ki Dukan</title>
<meta name="keywords" content="printing price calculator, print cost calculator, online printing calculator, document printing cost, printing charges calculator">
<meta name="description" content="Calculate your document printing cost online with Print Ki Dukan. Select paper size, color, pages, copies and printing options to get an instant printing price estimate.">
@endsection

@section('content')
<?php

/*
=====================================================
PRINT TYPE PRICES
=====================================================
*/

$printTypePrices = \App\Models\Price::whereIn(
    'slug',
    [
        'black_white_single',
        'black_white_double',
        'color_single',
        'color_double',
    ]
)
    ->where('status', 1)
    ->pluck('amount', 'slug');


/*
=====================================================
BINDING OPTIONS
=====================================================
*/

$bindingParent = \App\Models\Price::where(
    'slug',
    'bindings'
)
    ->where('status', 1)
    ->with([
        'childPrice' => function ($query) {
            $query
                ->where('status', 1)
                ->orderBy('id');
        }
    ])
    ->first();


$bindingPrices = [];

if ($bindingParent) {

    foreach (
        $bindingParent->childPrice as $binding
    ) {

        $bindingPrices[] = $binding;
    }
}

?>
<div class="elemento_stick" id="stick_here"></div>
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

                                            @if(
                                            $printTypePrices->has('black_white_single') ||
                                            $printTypePrices->has('black_white_double')
                                            )
                                            <option value="bw" selected>
                                                Black &amp; White
                                            </option>
                                            @endif


                                            @if(
                                            $printTypePrices->has('color_single') ||
                                            $printTypePrices->has('color_double')
                                            )
                                            <option value="color">
                                                Color
                                            </option>
                                            @endif

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


                                            @foreach(
                                            $bindingPrices as $binding
                                            )

                                            <option
                                                value="{{ $binding->slug }}">
                                                {{ $binding->name }}
                                                (+₹{{ number_format((float) $binding->amount, 2) }})
                                            </option>

                                            @endforeach

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

                <!-- =====================================
     RIGHT : QUOTATION
====================================== -->

                <div
                    class="col-lg-5"
                    id="quotationPanel"
                    style="display:none;">

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
                                    —
                                </strong>

                            </div>


                            <!-- =================================
                 SHIPPING
            ================================== -->

                            <div class="quotation-row">

                                <span>

                                    Shipping Delivery

                                    <span
                                        id="packageWeight"
                                        class="weight-badge"
                                        style="display:none;">
                                    </span>

                                </span>

                                <strong id="shippingAmount">
                                    —
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
                                    —
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
                                    —
                                </strong>

                            </div>


                            <!-- =================================
                 DELIVERY
            ================================== -->

                            <div
                                id="deliveryRouteBox"
                                class="delivery-info"
                                style="display:none;">

                                <div id="deliveryMessage"></div>

                            </div>


                            <!-- =================================
                 ORDER NOW
            ================================== -->

                            <a href="{{ route('upload') }}"
                                type="button"
                                class="btn btn-primary w-100 order-btn"
                                id="orderNow">

                                Order Now

                                <i class="bi bi-arrow-right ms-2"></i>

                            </a>


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

<script>
    $(document).ready(function() {

        $('#quotationPanel')
            .hide();
        /*
        =====================================================
        INITIAL STATE
        =====================================================
        */

        $('#printingSubtotal')
            .text('—');

        $('#shippingAmount')
            .text('—');

        $('#handlingAmount')
            .text('—');

        $('#estimatedTotal')
            .text('—');


        /*
        -----------------------------------------------------
        HIDE COMPLETE QUOTATION RESULT
        -----------------------------------------------------
        */

        $('#quotationResult')
            .hide();

        /*
        -----------------------------------------------------
        HIDE WEIGHT BADGE
        -----------------------------------------------------
        */

        $('#packageWeight')
            .hide()
            .text('');


        /*
        -----------------------------------------------------
        HIDE COURIER / ROUTE BOX
        -----------------------------------------------------
        */

        $('#deliveryRouteBox')
            .hide();


        /*
        =====================================================
        CALCULATE PRICE BUTTON
        =====================================================
        */
        /*
        =====================================================
        COPIES +/- CONTROL
        =====================================================
        */

        let copies = 1;


        /*
        -----------------------------------------------------
        DECREASE
        -----------------------------------------------------
        */

        $('#decreaseCopies').on(
            'click',
            function() {

                if (copies > 1) {

                    copies--;

                    $('#copiesValue')
                        .text(copies);

                    $('#copiesInput')
                        .val(copies);
                }

            }
        );


        /*
        -----------------------------------------------------
        INCREASE
        -----------------------------------------------------
        */

        $('#increaseCopies').on(
            'click',
            function() {

                /*
                Maximum copies
                */

                if (copies < 100) {

                    copies++;

                    $('#copiesValue')
                        .text(copies);

                    $('#copiesInput')
                        .val(copies);
                }

            }
        );
        $('#calculatePrice').on(
            'click',
            function() {

                let $button =
                    $(this);


                /*
                -------------------------------------------------
                PREVENT DOUBLE CLICK
                -------------------------------------------------
                */

                if (
                    $button.hasClass('loading')
                ) {

                    return;
                }


                /*
                =================================================
                GET VALUES
                =================================================
                */

                let data = {

                    total_pages: $('#totalPages').val(),

                    delivery_pincode: $('#deliveryPincode').val(),

                    print_type: $('#printType').val(),

                    paper_gsm: $('#paperGsm').val(),

                    binding_type: $('#bindingType').val(),

                    copies: $('#copiesInput').val(),

                    two_sided: $('#twoSided').is(':checked') ?
                        1 : 0,

                    _token: $('meta[name="csrf-token"]')
                        .attr('content')

                };


                /*
                =================================================
                VALIDATE PAGES
                =================================================
                */

                if (
                    !data.total_pages ||
                    parseInt(
                        data.total_pages
                    ) < 1
                ) {

                    alert(
                        'Please enter valid total pages.'
                    );

                    return;
                }


                /*
                =================================================
                VALIDATE PINCODE
                =================================================
                */

                if (
                    !/^\d{6}$/.test(
                        data.delivery_pincode
                    )
                ) {

                    alert(
                        'Please enter a valid 6 digit pincode.'
                    );

                    return;
                }


                /*
                =================================================
                SHOW LOADING
                =================================================
                */

                $button
                    .addClass('loading')
                    .prop(
                        'disabled',
                        true
                    )
                    .html(`

                    <span
                        class="spinner-border spinner-border-sm me-2"
                        role="status">
                    </span>

                    <span>
                        Calculating...
                    </span>

                `);


                /*
                =================================================
                HIDE OLD CALCULATION RESULT
                =================================================
                */
                $('#quotationPanel')
                    .hide();
                $('#quotationResult')
                    .hide();

                $('#deliveryRouteBox')
                    .hide();


                /*
                =================================================
                API REQUEST
                =================================================
                */

                $.ajax({

                    url: "{{ route('calculator.calculate') }}",

                    type: 'POST',

                    dataType: 'json',

                    data: data,


                    /*
                    =============================================
                    SUCCESS
                    =============================================
                    */

                    success: function(response) {

                        console.log(
                            'Calculator Response:',
                            response
                        );


                        /*
                        -------------------------------------
                        API FAILURE
                        -------------------------------------
                        */

                        if (
                            !response ||
                            !response.success
                        ) {

                            alert(
                                response.message ||
                                'Unable to calculate price.'
                            );

                            return;
                        }
                        $('#quotationPanel')
                            .fadeIn(200, function() {

                                /*
                                =============================================
                                MOBILE ONLY
                                Scroll to quotation result after calculation
                                =============================================
                                */

                                if (window.innerWidth <= 767) {

                                    $('html, body').animate({

                                        scrollTop: $('#quotationPanel').offset().top - 250

                                    }, 200);

                                }

                            });
                        // Show the complete quotation only after a successful calculation.
                        $('#quotationResult').show();

                        /*
                        =====================================
                        PRINTING SUBTOTAL
                        =====================================
                        */

                        $('#printingSubtotal')
                            .text(
                                '₹' +
                                Number(
                                    response.printing_subtotal
                                ).toFixed(2)
                            );


                        /*
                        =====================================
                        SHIPPING
                        =====================================
                        */

                        $('#shippingAmount')
                            .text(
                                '₹' +
                                Number(
                                    response.shipping
                                ).toFixed(2)
                            );


                        /*
                        =====================================
                        WEIGHT
                        =====================================
                        */

                        if (
                            response.weight
                        ) {

                            $('#packageWeight')
                                .text(
                                    response.weight +
                                    ' KG'
                                )
                                .show();

                        } else {

                            $('#packageWeight')
                                .hide();

                        }


                        /*
                        =====================================
                        HANDLING
                        
                        ALWAYS ₹0
                        =====================================
                        */

                        $('#handlingAmount')
                            .text(
                                '₹0.00'
                            );


                        /*
                        =====================================
                        TOTAL
                        =====================================
                        */

                        $('#estimatedTotal')
                            .text(
                                '₹' +
                                Number(
                                    response.total
                                ).toFixed(2)
                            );


                        /*
                        =====================================
                        COURIER / DELIVERY
                        =====================================
                        */

                        if (response.courier) {

                            let courierHtml = `

        <div class="fw-bold">

            <i class="bi bi-box-seam me-2"></i>

            CHEAPEST ROUTE

        </div>

        <span>
            via
            ${escapeHtml(response.courier)}
    `;

                            if (response.delivery_days) {

                                courierHtml += `
            ·
            ${escapeHtml(response.delivery_days)}
        `;

                            }

                            courierHtml += `
        </span>
    `;

                            $('#deliveryMessage')
                                .html(courierHtml);

                            $('#deliveryRouteBox')
                                .show();

                        } else {

                            $('#deliveryRouteBox')
                                .hide();

                        }

                    },


                    /*
                    =============================================
                    ERROR
                    =============================================
                    */

                    error: function(xhr) {

                        console.error(
                            'Calculator Error:',
                            xhr.responseText
                        );


                        let message =
                            'Unable to calculate price.';


                        if (
                            xhr.responseJSON &&
                            xhr.responseJSON.message
                        ) {

                            message =
                                xhr.responseJSON.message;

                        }


                        alert(
                            message
                        );

                    },


                    /*
                    =============================================
                    COMPLETE
                    =============================================
                    */

                    complete: function() {

                        $button
                            .removeClass('loading')
                            .prop(
                                'disabled',
                                false
                            )
                            .html(`

                                <i
                                    class="bi bi-calculator me-2">
                                </i>

                                <span>
                                    Calculate Price
                                </span>

                            `);

                    }

                });

            }
        );


        /*
        =====================================================
        HTML ESCAPE
        =====================================================
        */

        function escapeHtml(
            value
        ) {

            return $('<div>')
                .text(
                    value ?? ''
                )
                .html();

        }


    });
</script>

@endsection