@extends('layouts.web.web')

@section('custom_header')

<style>
    .checkout-wrapper {
        max-width: 900px;
        margin: 0 auto;
    }

    .checkout-card {
        background: #fff;
        border: 1px solid #ddd;
        padding: 18px;
        margin-bottom: 14px;
    }

    .checkout-title {
        text-align: center;
        margin-bottom: 20px;
    }

    .checkout-title h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 4px;
    }

    .checkout-section-title {
        display: flex;
        align-items: center;
        gap: 8px;

        font-size: 15px;
        font-weight: 700;

        margin-bottom: 15px;
    }

    .checkout-section-title i {
        color: #2856db;
    }

    .checkout-label {
        display: block;

        font-size: 12px;
        font-weight: 600;

        margin-bottom: 6px;
    }

    .checkout-input {
        width: 100%;
        height: 44px;

        border: 1px solid #d5d5d5;

        padding: 0 12px;

        font-size: 13px;

        outline: none;
    }

    .checkout-input:focus {
        border-color: #2856db;
    }

    .required {
        color: #dc3545;
    }


    /*
=====================================================
MOBILE
=====================================================
*/

    .mobile-input-wrapper {
        display: flex;
        height: 44px;
    }

    .mobile-country-code {
        width: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f5f5f5;

        border: 1px solid #d5d5d5;
        border-right: 0;

        font-size: 13px;

        flex-shrink: 0;
    }

    .checkout-mobile-input {
        flex: 1;

        min-width: 0;

        border: 1px solid #d5d5d5;

        padding: 0 12px;

        background: #f5f5f5;

        color: #555;
    }


    /*
=====================================================
SHIPPING
=====================================================
*/

    .shipping-placeholder {
        border: 1px dashed #ccc;

        padding: 15px;

        font-size: 12px;

        color: #777;

        text-align: center;
    }


    /*
=====================================================
PAYMENT OPTIONS
=====================================================
*/

    .payment-option {
        display: flex;

        align-items: center;

        gap: 12px;

        border: 1px solid #ddd;

        padding: 14px;

        margin-bottom: 8px;

        cursor: pointer;
    }

    .payment-option.selected {
        border-color: #2856db;

        background: #f3f6ff;
    }

    .payment-option input {
        width: 18px;
        height: 18px;
    }

    .payment-option-name {
        font-size: 14px;
        font-weight: 700;
    }

    .payment-option-info {
        font-size: 11px;
        color: #777;
    }


    /*
=====================================================
SUMMARY
=====================================================
*/

    .summary-row {
        display: flex;

        justify-content: space-between;

        padding: 10px 0;

        border-bottom: 1px solid #eee;

        font-size: 13px;
    }

    .summary-row:last-child {
        border-bottom: 0;
    }

    .summary-total {
        display: flex;

        justify-content: space-between;

        align-items: center;

        border-top: 1px solid #ccc;

        margin-top: 8px;

        padding-top: 15px;
    }

    .summary-total strong {
        font-size: 30px;
    }


    /*
=====================================================
PAY BUTTON
=====================================================
*/

    .proceed-payment-btn {
        width: 100%;

        height: 48px;

        border: 0;

        background: #2856db;

        color: #fff;

        font-size: 14px;

        font-weight: 700;

        cursor: pointer;
    }


    /*
=====================================================
MOBILE RESPONSIVE
=====================================================
*/

    @media (max-width: 576px) {

        .checkout-card {
            padding: 13px;
        }

        .checkout-title h1 {
            font-size: 27px;
        }

        .summary-total strong {
            font-size: 25px;
        }

    }

    .checkout-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;

        padding: 7px 12px;

        background: #2856db;
        border: 1px solid #2856db;

        color: #fff !important;
        text-decoration: none;

        font-size: 13px;
        font-weight: 600;

        cursor: pointer;
    }

    .checkout-back-btn:hover {
        background: #1f46bd;
        border-color: #1f46bd;
        color: #fff !important;
        text-decoration: none;
    }

    .shipping-options-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }


    .shipping-option {
        position: relative;

        display: flex;
        align-items: center;

        min-height: 105px;

        padding: 16px 18px;

        border: 1px solid #ddd;

        background: #fff;

        cursor: pointer;

        transition: all 0.15s ease;

        text-align: left;
    }


    .shipping-option:hover {
        border-color: #2856db;
    }


    .shipping-option.selected {
        border-color: #2856db;

        background: #f4f7ff;

        box-shadow: 0 0 0 1px #2856db;
    }


    .shipping-option-radio {
        width: 19px;
        height: 19px;

        margin-right: 12px;

        flex-shrink: 0;

        accent-color: #2856db;

        cursor: pointer;
    }


    .shipping-option-main {
        flex: 1;

        min-width: 0;

        text-align: left;
    }


    .shipping-option-header {
        display: flex;

        align-items: center;

        justify-content: flex-start;

        gap: 8px;

        flex-wrap: wrap;

        text-align: left;
    }


    .shipping-option-name {
        font-size: 14px;

        font-weight: 700;

        color: #222;

        line-height: 1.3;
    }


    .shipping-badge {
        display: inline-flex;

        align-items: center;

        padding: 4px 8px;

        font-size: 9px;

        line-height: 1;

        font-weight: 700;

        letter-spacing: 1px;

        color: #2856db;

        background: #eaf0ff;

        border: 1px solid #c9d7ff;
    }


    .shipping-option-delivery {
        margin-top: 8px;

        font-size: 13px;

        font-weight: 500;

        color: #555;

        text-align: left;
    }


    .shipping-option-delivery-sub {
        margin-top: 3px;

        font-size: 11px;

        color: #777;

        text-align: left;
    }


    .shipping-option-price {
        width: 110px;

        flex-shrink: 0;

        margin-left: 15px;

        text-align: right;

        font-size: 17px;

        font-weight: 800;

        color: #2856db;
    }


    .shipping-option-price small {
        display: block;

        margin-top: 4px;

        font-size: 10px;

        font-weight: 400;

        color: #777;
    }


    .shipping-note {
        display: flex;

        align-items: center;

        justify-content: center;

        gap: 3px;

        margin-top: 4px;

        padding-top: 2px;

        font-size: 12px;

        font-weight: 600;

        color: #2856db;
    }


    @media (max-width: 576px) {

        .shipping-option {
            min-height: 95px;

            padding: 13px 12px;
        }


        .shipping-option-radio {
            margin-right: 9px;
        }


        .shipping-option-name {
            font-size: 13px;
        }


        .shipping-option-price {
            width: 85px;

            font-size: 15px;
        }


        .shipping-option-price small {
            font-size: 9px;
        }

    }

    .checkout-options-section {
        background: #fbf9f4;
        min-height: 100vh;
    }

    @media (max-width: 767px) {

        .checkout-options-section {
            padding-top: 15px !important;
            padding-bottom: 20px !important;
        }
    }
</style>

@endsection


@section('content')

<main>

    <section class="checkout-options-section py-4">

        <div class="container">
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="checkout-wrapper">


                        {{-- =================================================
         HEADER
    ================================================== --}}

                        <div class="checkout-title">

                            <h1>
                                <i class="bi bi-cart-check text-primary"></i>
                                Checkout
                            </h1>

                            <p class="text-muted small">
                                Enter your delivery details and review your order.
                            </p>

                        </div>

                        <div class="mb-3">
                            <a
                                href="{{ route('print.options', []) }}"
                                class="checkout-back-btn">
                                <i class="bi bi-arrow-left me-1"></i>
                                Back
                            </a>
                        </div>
                        {{-- =================================================
         CONTACT DETAILS
    ================================================== --}}

                        <div class="checkout-card">

                            <div class="checkout-section-title">

                                <i class="bi bi-person"></i>

                                Contact Details

                            </div>


                            <div class="row g-3">


                                {{-- NAME --}}

                                <div class="col-md-6">

                                    <label class="checkout-label">

                                        Full Name
                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        id="fullName"
                                        class="checkout-input"
                                        placeholder="Full Name">

                                </div>


                                {{-- MOBILE --}}

                                <div class="col-md-6">

                                    <label class="checkout-label">
                                        Mobile
                                    </label>

                                    <div class="mobile-input-wrapper">

                                        <div class="mobile-country-code">
                                            +91
                                        </div>

                                        <input
                                            type="text"
                                            id="mobile"
                                            class="checkout-mobile-input"
                                            value="{{ $mobile }}"
                                            readonly>

                                    </div>

                                </div>


                                {{-- EMAIL --}}

                                <div class="col-12">

                                    <label class="checkout-label">

                                        Email Address
                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="email"
                                        id="email"
                                        class="checkout-input"
                                        placeholder="Email Address">

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
         DELIVERY ADDRESS
    ================================================== --}}

                        <div class="checkout-card">

                            <div class="checkout-section-title">

                                <i class="bi bi-geo-alt"></i>

                                Delivery Address

                            </div>


                            {{-- PINCODE --}}

                            <div class="mb-3">

                                <label class="checkout-label">

                                    Pincode
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    id="pincode"
                                    class="checkout-input"
                                    maxlength="6"
                                    inputmode="numeric"
                                    placeholder="Pincode (e.g. 110001)">

                            </div>


                            {{-- CITY / STATE --}}

                            <div class="row g-3 mb-3">

                                <div class="col-md-6">

                                    <label class="checkout-label">

                                        City
                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        id="city"
                                        class="checkout-input"
                                        placeholder="City">

                                </div>


                                <div class="col-md-6">

                                    <label class="checkout-label">

                                        State
                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        id="state"
                                        class="checkout-input"
                                        placeholder="State">

                                </div>

                            </div>


                            {{-- HOUSE --}}

                            <div class="mb-3">

                                <label class="checkout-label">

                                    House No. / Building / Apartment
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    id="house"
                                    class="checkout-input"
                                    placeholder="House No. / Building / Apartment">

                            </div>


                            {{-- ROAD --}}

                            <div class="mb-3">

                                <label class="checkout-label">

                                    Road / Area / Colony
                                    <span class="required">*</span>

                                </label>

                                <input
                                    type="text"
                                    id="road"
                                    class="checkout-input"
                                    placeholder="e.g. MG Road, Indiranagar">

                            </div>


                            {{-- LANDMARK --}}

                            <div>

                                <label class="checkout-label">

                                    Landmark
                                    <span class="text-muted">
                                        (Optional)
                                    </span>

                                </label>

                                <input
                                    type="text"
                                    id="landmark"
                                    class="checkout-input"
                                    placeholder="e.g. Near HDFC Bank">

                            </div>

                        </div>


                        {{-- =================================================
         SHIPPING
    ================================================== --}}

                        <div class="checkout-card">

                            <div class="checkout-section-title">

                                <i class="bi bi-truck"></i>

                                Shipping

                            </div>


                            <div
                                id="shippingOptions"
                                class="shipping-placeholder">

                                Enter your pincode to calculate
                                delivery charges.

                            </div>

                        </div>


                        {{-- =================================================
         PAYMENT METHOD
    ================================================== --}}

                        <div class="checkout-card">

                            <div class="checkout-section-title">

                                <i class="bi bi-credit-card"></i>

                                Payment Method

                            </div>


                            {{-- COD --}}

                            <label
                                class="payment-option selected"
                                id="codOption">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod"
                                    checked>

                                <div>

                                    <div class="payment-option-name">

                                        Cash on Delivery

                                    </div>

                                    <div class="payment-option-info">

                                        Pay when your order is delivered.

                                    </div>

                                </div>

                            </label>


                            {{-- RAZORPAY --}}

                            <label
                                class="payment-option"
                                id="razorpayOption">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="razorpay">

                                <div>

                                    <div class="payment-option-name">

                                        Razorpay

                                    </div>

                                    <div class="payment-option-info">

                                        Pay securely using UPI, Card,
                                        Net Banking or Wallet.

                                    </div>

                                </div>

                            </label>

                        </div>


                        {{-- =================================================
         PRICE SUMMARY
    ================================================== --}}

                        <div class="checkout-card">

                            <h4 class="fw-bold mb-3">
                                Price Summary
                            </h4>


                            <div class="summary-row">

                                <span>
                                    Print subtotal
                                </span>

                                <strong id="printSubtotal">
                                    ₹{{ number_format($printSubtotal, 2) }}
                                </strong>

                            </div>


                            <div class="summary-row">

                                <span>
                                    Delivery Charge
                                </span>

                                <strong id="deliveryCharge">
                                    ₹{{ number_format($deliveryCharge, 2) }}
                                </strong>

                            </div>


                            <div class="summary-row">

                                <span>
                                    Handling &amp; Packaging
                                </span>

                                <strong id="handlingCharge">
                                    ₹{{ number_format($handlingCharge, 2) }}
                                </strong>

                            </div>


                            <div class="summary-total">

                                <span>
                                    TOTAL
                                </span>

                                <strong id="checkoutTotal">
                                    ₹{{ number_format($grandTotal, 2) }}
                                </strong>

                            </div>

                        </div>


                        {{-- =================================================
         PROCEED
    ================================================== --}}

                        <button
                            type="button"
                            id="proceedToPay"
                            class="proceed-payment-btn">

                            Proceed to Pay

                            <i class="bi bi-arrow-right ms-1"></i>

                        </button>


                    </div>

                </div>
            </div>
        </div>

    </section>

</main>

@endsection
@section('custom_footer')

<script>
    $(document).ready(function() {


        /*
        =====================================================
        SELECTED SHIPPING COURIER
        =====================================================
        */

        let selectedShippingCourier = null;


        /*
        =====================================================
        SHIPPING TIMER
        =====================================================
        */

        let shippingTimer = null;


        /*
        =====================================================
        PAYMENT METHOD UI
        =====================================================
        */

        $('input[name="payment_method"]').on(
            'change',
            function() {

                $('.payment-option')
                    .removeClass('selected');


                $(this)
                    .closest('.payment-option')
                    .addClass('selected');

            }
        );


        /*
        =====================================================
        PINCODE INPUT
        =====================================================
        */

        $('#pincode').on(
            'input',
            function() {

                let pincode =
                    $(this)
                    .val()
                    .replace(/\D/g, '')
                    .substring(0, 6);


                $(this).val(pincode);


                /*
                -------------------------------------------------
                RESET SHIPPING
                -------------------------------------------------
                */

                if (
                    pincode.length !== 6
                ) {

                    selectedShippingCourier =
                        null;


                    $('#shippingOptions')
                        .html(
                            'Enter your pincode to calculate ' +
                            'delivery charges.'
                        );


                    $('#deliveryCharge')
                        .text('₹0.00');


                    updateCheckoutTotal();


                    return;
                }


                /*
                -------------------------------------------------
                DEBOUNCE
                -------------------------------------------------
                */

                clearTimeout(
                    shippingTimer
                );


                shippingTimer =
                    setTimeout(
                        function() {

                            calculateShipping(
                                pincode
                            );

                        },
                        500
                    );

            }
        );


        /*
        =====================================================
        CALCULATE SHIPPING
        =====================================================
        */

        function calculateShipping(
            pincode
        ) {

            selectedShippingCourier =
                null;


            $('#shippingOptions')
                .html(`

                <div class="shipping-loading">

                    <div>

                        <div
                            class="spinner-border spinner-border-sm text-primary"
                            role="status">
                        </div>

                    </div>

                    <div class="mt-2">
                        Calculating delivery charges...
                    </div>

                </div>

            `);


            $.ajax({

                url: "{{ route('checkout.calculate.shipping') }}",

                type: 'POST',

                dataType: 'json',

                data: {

                    delivery_pincode: pincode,

                    _token: "{{ csrf_token() }}"

                },


                success: function(response) {

                    console.log(
                        'Shipmozo Rate Response:',
                        response
                    );


                    /*
                    =========================================
                    API FAILURE
                    =========================================
                    */

                    if (
                        !response ||
                        !response.success ||
                        !Array.isArray(
                            response.couriers
                        ) ||
                        !response.couriers.length
                    ) {

                        $('#shippingOptions')
                            .html(`

                                <div class="text-danger small">

                                    ${
                                        response &&
                                        response.message
                                        ?
                                        response.message
                                        :
                                        'No courier available for this pincode.'
                                    }

                                </div>

                            `);


                        $('#deliveryCharge')
                            .text('₹0.00');


                        updateCheckoutTotal();


                        return;
                    }


                    /*
                    =========================================
                    RENDER COURIERS
                    =========================================
                    */

                    renderShippingOptions(
                        response.couriers
                    );

                },


                error: function(xhr) {

                    console.error(
                        'Shipmozo Rate Error:',
                        xhr.responseText
                    );


                    let message =
                        'Unable to calculate delivery charges.';


                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;
                    }


                    $('#shippingOptions')
                        .html(`

                            <div class="text-danger small">

                                ${escapeHtml(message)}

                            </div>

                        `);


                    $('#deliveryCharge')
                        .text('₹0.00');


                    updateCheckoutTotal();

                }

            });

        }


        /*
        =====================================================
        RENDER SHIPPING OPTIONS
        =====================================================
        */

        function renderShippingOptions(
            couriers
        ) {
            /*
             =====================================================
             REMOVE DUPLICATE DISPLAY COURIER NAMES
             =====================================================

             Backendમાં courier/service અલગ હોઈ શકે,
             પરંતુ frontendમાં same company name દેખાય છે.

             Same displayed courier name માંથી CHEAPEST રાખીશું.
             =====================================================
             */

            const uniqueCouriers = new Map();


            couriers.forEach(function(courier) {

                let displayName =
                    String(
                        courier.courier_name ||
                        courier.name ||
                        'Courier'
                    )
                    .replace(
                        /\s+\d+(?:\.\d+)?\s*kg\s*$/i,
                        ''
                    )
                    .trim();


                /*
                -----------------------------------------------
                Normalize name

                XpressBees
                xpressbees
                XPRESSBEES

                બધું એક જ ગણાશે.
                -----------------------------------------------
                */

                let key =
                    displayName
                    .toLowerCase()
                    .replace(
                        /\s+/g,
                        ' '
                    );


                let currentPrice =
                    parseFloat(
                        courier.total_charges || 0
                    );


                /*
                -----------------------------------------------
                First courier
                -----------------------------------------------
                */

                if (
                    !uniqueCouriers.has(key)
                ) {

                    courier._displayName =
                        displayName;

                    uniqueCouriers.set(
                        key,
                        courier
                    );

                    return;
                }


                /*
                -----------------------------------------------
                Same company already exists.

                Keep CHEAPEST one.
                -----------------------------------------------
                */

                let existing =
                    uniqueCouriers.get(key);


                let existingPrice =
                    parseFloat(
                        existing.total_charges || 0
                    );


                if (
                    currentPrice <
                    existingPrice
                ) {

                    courier._displayName =
                        displayName;

                    uniqueCouriers.set(
                        key,
                        courier
                    );
                }

            });


            /*
            =====================================================
            FINAL UNIQUE COURIER LIST
            =====================================================
            */

            couriers =
                Array.from(
                    uniqueCouriers.values()
                );


            /*
            =====================================================
            NOW YOUR EXISTING RENDER CODE CONTINUES
            =====================================================
            */

            let html =
                '<div class="shipping-options-list">';


            $.each(
                couriers,
                function(
                    index,
                    courier
                ) {

                    /*
                    ---------------------------------------------
                    FIRST OPTION SELECTED BY DEFAULT
                    ---------------------------------------------
                    */

                    let selected =
                        index === 0;


                    if (selected) {

                        selectedShippingCourier =
                            courier;

                    }


                    /*
                    ---------------------------------------------
                    BADGES
                    ---------------------------------------------
                    */

                    let badges = '';


                    if (
                        courier.is_cheapest
                    ) {

                        badges += `

                        <span class="shipping-badge">
                            CHEAPEST
                        </span>

                    `;
                    }


                    if (
                        courier.is_fastest
                    ) {

                        badges += `

                        <span class="shipping-badge">
                            FASTEST
                        </span>

                    `;
                    }


                    /*
                    ---------------------------------------------
                    DELIVERY TEXT
                    ---------------------------------------------
                    */

                    let deliveryText =
                        courier.estimated_delivery ||
                        'Delivery estimate unavailable';


                    /*
                    ---------------------------------------------
                    SELECTED CLASS
                    ---------------------------------------------
                    */

                    let selectedClass =
                        selected ?
                        'selected' :
                        '';


                    /*
                    ---------------------------------------------
                    CARD
                    ---------------------------------------------
                    */

                    html += `

                    <label
                        class="shipping-option ${selectedClass}"
                        data-courier-id="${escapeHtml(courier.courier_id)}">

                        <input
                            type="radio"
                            name="shipping_courier"
                            class="shipping-option-radio"
                            value="${escapeHtml(courier.courier_id)}"
                            ${selected ? 'checked' : ''}>


                        <div class="shipping-option-main">

                            <div class="shipping-option-header">

                                <span class="shipping-option-name">
                                ${escapeHtml(
                                    String(
                                        courier.courier_name || 'Courier'
                                    ).replace(
                                        /\s+\d+(?:\.\d+)?\s*kg\s*$/i,
                                        ''
                                    ).trim()
                                )}
                                </span>

                                ${badges}

                            </div>


                            <div class="shipping-option-delivery">

                                ${escapeHtml(
                                    courier.estimated_delivery || 'Delivery estimate unavailable'
                                )}

                            </div>


                            <div class="shipping-option-delivery-sub">
                                Excludes Sundays
                            </div>

                        </div>


                        <div class="shipping-option-price">

                            ₹${formatMoney(courier.total_charges)}

                            <small>
                                including GST
                            </small>

                        </div>

                    </label>

                `;

                }
            );


            html += `

            <div class="shipping-note">

                <i class="bi bi-shield-check me-1"></i>

                We pass courier charges as-is with no markup.

            </div>

        `;


            html +=
                '</div>';


            $('#shippingOptions')
                .html(html);


            /*
            -----------------------------------------------------
            APPLY DEFAULT FIRST COURIER
            -----------------------------------------------------
            */

            if (
                selectedShippingCourier
            ) {

                setSelectedShippingCourier(
                    selectedShippingCourier
                );

            }


            /*
            -----------------------------------------------------
            COURIER CLICK
            -----------------------------------------------------
            */

            $('.shipping-option').on(
                'click',
                function() {

                    let courierId =
                        String(
                            $(this)
                            .data('courier-id')
                        );


                    let courier =
                        couriers.find(
                            function(item) {

                                return String(
                                        item.courier_id
                                    ) ===
                                    courierId;

                            }
                        );


                    if (!courier) {

                        return;
                    }


                    setSelectedShippingCourier(
                        courier
                    );

                }
            );

        }


        /*
        =====================================================
        SET SELECTED COURIER
        =====================================================
        */

        function setSelectedShippingCourier(
            courier
        ) {

            selectedShippingCourier =
                courier;


            /*
            -------------------------------------------------
            RADIO
            -------------------------------------------------
            */

            $('input[name="shipping_courier"]')
                .prop(
                    'checked',
                    false
                );


            $('input[name="shipping_courier"][value="' +
                    escapeSelectorValue(
                        courier.courier_id
                    ) +
                    '"]')
                .prop(
                    'checked',
                    true
                );


            /*
            -------------------------------------------------
            CARD
            -------------------------------------------------
            */

            $('.shipping-option')
                .removeClass('selected');


            $('.shipping-option[data-courier-id="' +
                    escapeHtml(
                        courier.courier_id
                    ) +
                    '"]')
                .addClass('selected');


            /*
            -------------------------------------------------
            UPDATE DELIVERY CHARGE
            -------------------------------------------------
            */

            $('#deliveryCharge')
                .text(
                    '₹' +
                    formatMoney(
                        courier.total_charges
                    )
                );


            /*
            -------------------------------------------------
            UPDATE GRAND TOTAL
            -------------------------------------------------
            */

            updateCheckoutTotal();


            /*
            -------------------------------------------------
            DEBUG

            Later payment/backend stepમાં આ જ object
            use કરીશું.
            -------------------------------------------------
            */

            console.log(
                'Selected Courier:',
                selectedShippingCourier
            );

        }


        /*
        =====================================================
        UPDATE TOTAL
        =====================================================
        */

        function updateCheckoutTotal() {

            let printSubtotal =
                parseFloat(
                    "{{ $printSubtotal }}"
                ) || 0;


            let handlingCharge =
                parseFloat(
                    "{{ $handlingCharge }}"
                ) || 0;


            let deliveryCharge = 0;


            if (
                selectedShippingCourier &&
                selectedShippingCourier.total_charges
            ) {

                deliveryCharge =
                    parseFloat(
                        selectedShippingCourier.total_charges
                    ) || 0;

            }


            let total =
                printSubtotal +
                handlingCharge +
                deliveryCharge;


            $('#checkoutTotal')
                .text(
                    '₹' +
                    formatMoney(total)
                );

        }


        /*
        =====================================================
        MONEY FORMAT
        =====================================================
        */

        function formatMoney(
            value
        ) {

            let number =
                parseFloat(value) || 0;


            return number.toFixed(2);

        }


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


        /*
        =====================================================
        SELECTOR ESCAPE
        =====================================================
        */

        function escapeSelectorValue(
            value
        ) {

            return String(value)
                .replace(
                    /([!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~])/g,
                    '\\$1'
                );

        }


    });
</script>

@endsection