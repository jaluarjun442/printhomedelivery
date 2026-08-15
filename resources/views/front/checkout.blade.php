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

    .checkout-field-error {
        display: none;
        margin-top: 4px;
        font-size: 11px;
        line-height: 1.3;
        color: #dc3545;
        font-weight: 600;
    }

    .checkout-field-error.show {
        display: block;
    }

    .checkout-input.is-invalid {
        border-color: #dc3545 !important;
    }

    .checkout-top-error {
        display: none;
        margin: 0 0 12px;
        padding: 9px 11px;
        border: 1px solid #f1b0b7;
        background: #fff5f5;
        color: #b42318;
        font-size: 12px;
        font-weight: 600;
    }

    .checkout-top-error.show {
        display: block;
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

        /* background: #f5f5f5; */

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

                                    <div class="checkout-field-error" id="fullNameError">Please enter your full name.</div>

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
                                            value="{{ $mobile }}">

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

                                    <div class="checkout-field-error" id="emailError">Please enter a valid email address.</div>

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

                                <div class="checkout-field-error" id="pincodeError">Please enter a valid 6-digit pincode.</div>

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

                                    <div class="checkout-field-error" id="cityError">Please enter your city.</div>

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

                                    <div class="checkout-field-error" id="stateError">Please enter your state.</div>

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

                                <div class="checkout-field-error" id="houseError">Please enter your house/building details.</div>

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

                                <div class="checkout-field-error" id="roadError">Please enter your road/area details.</div>

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

                            <!-- <label
                                class="payment-option"
                                id="codOption">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="cod">

                                <div>

                                    <div class="payment-option-name">

                                        Cash on Delivery

                                    </div>

                                    <div class="payment-option-info">

                                        Pay when your order is delivered.

                                    </div>

                                </div>

                            </label> -->


                            {{-- PAYU --}}

                            <label
                                class="payment-option selected"
                                id="payuOption">

                                <input
                                    type="radio"
                                    name="payment_method"
                                    value="payu"
                                    checked>

                                <div>

                                    <div class="payment-option-name">
                                        PayU
                                    </div>

                                    <div class="payment-option-info">
                                        Pay securely using UPI, Card, Net Banking or Wallet.
                                    </div>

                                </div>

                            </label>


                            {{-- RAZORPAY --}}

                            <!-- <label
                                class="payment-option"
                                id="razorpayOption">

                                <input
                                    disabled
                                    type="radio"
                                    name="payment_method"
                                    value="razorpay">

                                <div>

                                    <div class="payment-option-name">

                                        Razorpay (Coming Soon)

                                    </div>

                                    <div class="payment-option-info">

                                        Pay securely using UPI, Card,
                                        Net Banking or Wallet.

                                    </div>

                                </div>

                            </label> -->

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

                        <div class="checkout-card" style="padding:12px 14px;">
                            <div class="checkout-section-title mb-2">
                                <i class="bi bi-shield-check"></i>
                                Security Verification
                            </div>

                            <div class="d-flex justify-content-center">
                                <div
                                    class="cf-turnstile"
                                    data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"
                                    data-theme="light">
                                </div>
                            </div>
                        </div>

                        <div id="checkoutTopError" class="checkout-top-error"></div>



                        <div id="courierError" class="checkout-field-error mb-2">


                            Please select a courier.


                        </div>



                        <div id="turnstileError" class="checkout-field-error text-center mb-2">


                            Please complete the security verification.


                        </div>



                        <input


                            type="hidden"


                            id="selectedCourierId"
                            name="courier_id"
                            value="">
                        <button
                            type="button"
                            id="placeCodOrder"
                            class="proceed-payment-btn">

                            <span id="paymentButtonText">
                                Pay Now
                            </span>

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

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script src="https://jssdk.payu.in/bolt/bolt.min.js"></script>

<script>
    $(document).ready(function() {

        let selectedShippingCourier = null;
        let shippingTimer = null;

        /*
        =====================================================
        PAYMENT PROCESS LOCK
        =====================================================
        */

        let paymentProcessing = false;


        /*
        =====================================================
        PAYMENT METHOD UI
        =====================================================
        */

        $('input[name="payment_method"]').on(
            'change',
            function() {

                if (paymentProcessing) {
                    return;
                }

                $('.payment-option')
                    .removeClass('selected');

                $(this)
                    .closest('.payment-option')
                    .addClass('selected');

                updatePaymentButtonText();
            }
        );


        function updatePaymentButtonText() {

            if (paymentProcessing) {
                return;
            }

            let paymentMethod =
                $('input[name="payment_method"]:checked').val();

            $('#paymentButtonText').text(
                paymentMethod === 'cod' ?
                'Place Order' :
                'Pay Now'
            );
        }


        /*
        =====================================================
        PINCODE INPUT
        =====================================================
        */

        $('#pincode').on(
            'input',
            function() {

                if (paymentProcessing) {
                    return;
                }

                let pincode =
                    $(this)
                    .val()
                    .replace(/\D/g, '')
                    .substring(0, 6);

                $(this).val(pincode);

                if (pincode.length !== 6) {

                    selectedShippingCourier = null;

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

                clearTimeout(shippingTimer);

                shippingTimer = setTimeout(
                    function() {
                        calculateShipping(pincode);
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

        function calculateShipping(pincode) {

            selectedShippingCourier = null;

            $('#shippingOptions').html(`

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

                    if (
                        !response ||
                        !response.success ||
                        !Array.isArray(response.couriers) ||
                        !response.couriers.length
                    ) {

                        $('#shippingOptions').html(`

                            <div class="text-danger small">
                                ${
                                    response &&
                                    response.message
                                        ? response.message
                                        : 'No courier available for this pincode.'
                                }
                            </div>

                        `);

                        $('#deliveryCharge')
                            .text('₹0.00');

                        updateCheckoutTotal();

                        return;
                    }

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

                    $('#shippingOptions').html(`
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

        function renderShippingOptions(couriers) {

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

                let key =
                    displayName
                    .toLowerCase()
                    .replace(/\s+/g, ' ');

                let currentPrice =
                    parseFloat(
                        courier.total_charges || 0
                    );

                if (!uniqueCouriers.has(key)) {

                    courier._displayName =
                        displayName;

                    uniqueCouriers.set(
                        key,
                        courier
                    );

                    return;
                }

                let existing =
                    uniqueCouriers.get(key);

                let existingPrice =
                    parseFloat(
                        existing.total_charges || 0
                    );

                if (currentPrice < existingPrice) {

                    courier._displayName =
                        displayName;

                    uniqueCouriers.set(
                        key,
                        courier
                    );
                }

            });

            couriers =
                Array.from(
                    uniqueCouriers.values()
                );

            let html =
                '<div class="shipping-options-list>';

            html = '<div class="shipping-options-list">';

            $.each(
                couriers,
                function(index, courier) {

                    let selected =
                        index === 0;

                    if (selected) {
                        selectedShippingCourier =
                            courier;
                    }

                    let badges = '';

                    if (courier.is_cheapest) {

                        badges += `
                            <span class="shipping-badge">
                                CHEAPEST
                            </span>
                        `;
                    }

                    if (courier.is_fastest) {

                        badges += `
                            <span class="shipping-badge">
                                FASTEST
                            </span>
                        `;
                    }

                    let selectedClass =
                        selected ?
                        'selected' :
                        '';

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
                                                courier.courier_name ||
                                                'Courier'
                                            )
                                            .replace(
                                                /\s+\d+(?:\.\d+)?\s*kg\s*$/i,
                                                ''
                                            )
                                            .trim()
                                        )}

                                    </span>

                                    ${badges}

                                </div>

                                <div class="shipping-option-delivery">
                                    ${escapeHtml(
                                        courier.estimated_delivery ||
                                        'Delivery estimate unavailable'
                                    )}
                                </div>

                                <div class="shipping-option-delivery-sub">
                                    Excludes Sundays
                                </div>

                            </div>

                            <div class="shipping-option-price">

                                ₹${formatMoney(
                                    courier.total_charges
                                )}

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

            html += '</div>';

            $('#shippingOptions')
                .html(html);

            if (selectedShippingCourier) {

                setSelectedShippingCourier(
                    selectedShippingCourier
                );
            }

            $('.shipping-option').on(
                'click',
                function() {

                    if (paymentProcessing) {
                        return;
                    }

                    let courierId =
                        String(
                            $(this).data('courier-id')
                        );

                    let courier =
                        couriers.find(
                            function(item) {

                                return String(
                                    item.courier_id
                                ) === courierId;

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

        function setSelectedShippingCourier(courier) {

            selectedShippingCourier =
                courier;

            $('#selectedCourierId')
                .val(
                    courier.courier_id
                );

            $('input[name="shipping_courier"]')
                .prop('checked', false);

            $('input[name="shipping_courier"][value="' +
                    escapeSelectorValue(
                        courier.courier_id
                    ) +
                    '"]')
                .prop('checked', true);

            $('.shipping-option')
                .removeClass('selected');

            $('.shipping-option[data-courier-id="' +
                    escapeHtml(
                        courier.courier_id
                    ) +
                    '"]')
                .addClass('selected');

            /*
            TEMPORARY FREE SHIPPING
            */

            $('#deliveryCharge')
                .text('₹0.00');

            updateCheckoutTotal();

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

            /*
            TEMPORARY FREE SHIPPING
            */

            let deliveryCharge = 0;

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


        function formatMoney(value) {

            let number =
                parseFloat(value) || 0;

            return number.toFixed(2);

        }


        function escapeHtml(value) {

            return $('<div>')
                .text(
                    value ?? ''
                )
                .html();

        }


        function escapeSelectorValue(value) {

            return String(value)
                .replace(
                    /([!"#$%&'()*+,./:;<=>?@[\\\]^`{|}~])/g,
                    '\\$1'
                );

        }


        /*
        =====================================================
        FIELD ERROR CLEAR
        =====================================================
        */

        $('.checkout-input').on(
            'input',
            function() {

                if (paymentProcessing) {
                    return;
                }

                $(this)
                    .removeClass('is-invalid');

                $('#' + this.id + 'Error')
                    .removeClass('show');

                $('#checkoutTopError')
                    .removeClass('show')
                    .text('');

            }
        );


        /*
        =====================================================
        MAIN CHECKOUT BUTTON
        =====================================================
        */

        $('#placeCodOrder').on(
            'click',
            function() {

                let button = $(this);

                /*
                HARD DOUBLE-CLICK PROTECTION
                */

                if (paymentProcessing) {
                    return;
                }

                let paymentMethod =
                    $('input[name="payment_method"]:checked')
                    .val();

                /*
                =====================================================
                BASIC VALIDATION
                =====================================================
                */

                let requiredFields = [
                    '#fullName',
                    '#email',
                    '#pincode',
                    '#city',
                    '#state',
                    '#house',
                    '#road'
                ];

                let valid = true;

                $.each(
                    requiredFields,
                    function(index, selector) {

                        let value =
                            $(selector)
                            .val()
                            .trim();

                        $(selector)
                            .removeClass('is-invalid');

                        if (!value) {

                            $(selector)
                                .addClass('is-invalid');

                            valid = false;

                        }

                    }
                );


                let emailValue =
                    $('#email')
                    .val()
                    .trim();

                if (
                    emailValue &&
                    !/^[^\s@]+@[^\s@]+\.[^\s@]+$/
                    .test(emailValue)
                ) {

                    $('#email')
                        .addClass('is-invalid');

                    $('#emailError')
                        .text(
                            'Please enter a valid email address.'
                        )
                        .addClass('show');

                    valid = false;

                }


                let pincodeValue =
                    $('#pincode')
                    .val()
                    .trim();

                if (
                    pincodeValue &&
                    !/^\d{6}$/.test(pincodeValue)
                ) {

                    $('#pincode')
                        .addClass('is-invalid');

                    $('#pincodeError')
                        .text(
                            'Pincode must be exactly 6 digits.'
                        )
                        .addClass('show');

                    valid = false;

                }


                if (!valid) {

                    $('#checkoutTopError')
                        .text(
                            'Please correct the highlighted fields.'
                        )
                        .addClass('show');

                    return;

                }


                /*
                =====================================================
                COURIER
                =====================================================
                */

                let courierId =
                    $('#selectedCourierId')
                    .val();

                $('#courierError')
                    .removeClass('show');

                if (!courierId) {

                    $('#courierError')
                        .addClass('show');

                    return;

                }


                /*
                =====================================================
                TURNSTILE
                =====================================================
                */

                let turnstileToken =
                    typeof turnstile !== 'undefined' ?
                    turnstile.getResponse() :
                    '';

                $('#turnstileError')
                    .removeClass('show');

                if (!turnstileToken) {

                    $('#turnstileError')
                        .addClass('show');

                    return;

                }


                /*
                =====================================================
                LOCK IMMEDIATELY
                =====================================================
                */

                paymentProcessing = true;

                button
                    .prop('disabled', true)
                    .css({
                        'pointer-events': 'none',
                        'opacity': '0.65'
                    })
                    .html(
                        '<span class="spinner-border spinner-border-sm me-2"></span>' +
                        'Processing Payment...'
                    );


                /*
                =====================================================
                FORM DATA
                =====================================================
                */

                let formData = {

                    _token: "{{ csrf_token() }}",

                    full_name: $('#fullName')
                        .val()
                        .trim(),

                    email: $('#email')
                        .val()
                        .trim(),

                    pincode: $('#pincode')
                        .val()
                        .trim(),

                    city: $('#city')
                        .val()
                        .trim(),

                    state: $('#state')
                        .val()
                        .trim(),

                    house: $('#house')
                        .val()
                        .trim(),

                    road: $('#road')
                        .val()
                        .trim(),

                    landmark: $('#landmark')
                        .val()
                        .trim(),

                    courier_id: courierId,

                    payment_method: paymentMethod,

                    turnstile_token: turnstileToken

                };


                /*
                =====================================================
                COD
                =====================================================
                */

                if (paymentMethod === 'cod') {

                    submitCodOrder(
                        formData
                    );

                    return;

                }


                /*
                =====================================================
                PAYU
                =====================================================
                */

                if (paymentMethod === 'payu') {

                    startPayUPayment(
                        formData,
                        button
                    );

                    return;

                }


                showCheckoutError(
                    'Please select a payment method.',
                    button
                );

            }
        );


        /*
        =====================================================
        COD SUBMIT
        =====================================================
        */

        function submitCodOrder(formData) {

            let form =
                $('<form>', {

                    method: 'POST',

                    action: "{{ route('checkout.place-order') }}"

                });


            $.each(
                formData,
                function(key, value) {

                    form.append(
                        $('<input>', {

                            type: 'hidden',

                            name: key,

                            value: value

                        })
                    );

                }
            );


            $('body')
                .append(form);

            form.submit();

        }


        /*
        =====================================================
        PAYU CHECKOUT PLUS
        =====================================================
        */

        function startPayUPayment(
            formData,
            button
        ) {

            $.ajax({

                url: "{{ route('checkout.place-order') }}",

                type: 'POST',

                dataType: 'json',

                data: formData,

                success: function(response) {

                    if (
                        !response ||
                        !response.success ||
                        response.payment_gateway !== 'payu' ||
                        !response.payu
                    ) {

                        showCheckoutError(
                            response &&
                            response.message ?
                            response.message :
                            'Unable to start PayU payment.',
                            button
                        );

                        return;

                    }


                    let payuData =
                        response.payu;


                    if (
                        typeof bolt === 'undefined' ||
                        typeof bolt.launch !== 'function'
                    ) {

                        showCheckoutError(
                            'PayU checkout could not be loaded. Please refresh and try again.',
                            button
                        );

                        return;

                    }


                    let data = {

                        key: payuData.key,

                        hash: payuData.hash,

                        txnid: payuData.txnid,

                        amount: payuData.amount,

                        firstname: payuData.firstname,

                        email: payuData.email,

                        phone: payuData.phone,

                        productinfo: payuData.productinfo,

                        surl: payuData.surl,

                        furl: payuData.furl

                    };


                    let handlers = {

                        responseHandler: function(BOLT) {

                            let paymentResponse =
                                BOLT &&
                                BOLT.response ?
                                BOLT.response :
                                null;

                            if (!paymentResponse) {

                                showCheckoutError(
                                    'Invalid payment response received.',
                                    button
                                );

                                return;

                            }


                            verifyPayUPayment(
                                paymentResponse,
                                button
                            );

                        },


                        catchException: function(BOLT) {

                            console.error(
                                'PayU Exception:',
                                BOLT
                            );

                            showCheckoutError(
                                'Unable to complete PayU payment. Please try again.',
                                button
                            );

                        }

                    };


                    bolt.launch(
                        data,
                        handlers
                    );

                },


                error: function(xhr) {

                    console.error(
                        'PayU Start Error:',
                        xhr.responseText
                    );

                    let message =
                        'Unable to start payment.';

                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }

                    showCheckoutError(
                        message,
                        button
                    );

                }

            });

        }


        /*
        =====================================================
        VERIFY PAYU PAYMENT
        =====================================================
        */

        function verifyPayUPayment(
            paymentResponse,
            button
        ) {

            $.ajax({

                url: "{{ route('checkout.verify.payu') }}",

                type: 'POST',

                dataType: 'json',

                data: {

                    _token: "{{ csrf_token() }}",

                    txnid: paymentResponse.txnid ||
                        '',

                    status: paymentResponse.status ||
                        '',

                    hash: paymentResponse.hash ||
                        '',

                    amount: paymentResponse.amount ||
                        '',

                    key: paymentResponse.key ||
                        '',

                    firstname: paymentResponse.firstname ||
                        '',

                    email: paymentResponse.email ||
                        '',

                    productinfo: paymentResponse.productinfo ||
                        '',

                    mihpayid: paymentResponse.mihpayid ||
                        '',

                    udf1: paymentResponse.udf1 ||
                        '',

                    udf2: paymentResponse.udf2 ||
                        '',

                    udf3: paymentResponse.udf3 ||
                        '',

                    udf4: paymentResponse.udf4 ||
                        '',

                    udf5: paymentResponse.udf5 ||
                        '',

                    additional_charges: paymentResponse.additionalCharges ||
                        paymentResponse.additional_charges ||
                        ''

                },


                success: function(response) {

                    if (
                        response &&
                        response.success &&
                        response.redirect
                    ) {

                        window.location.href =
                            response.redirect;

                        return;

                    }


                    showCheckoutError(
                        response &&
                        response.message ?
                        response.message :
                        'Payment verification failed.',
                        button
                    );

                },


                error: function(xhr) {

                    console.error(
                        'PayU Verify Error:',
                        xhr.responseText
                    );

                    let message =
                        'Payment verification failed.';

                    if (
                        xhr.responseJSON &&
                        xhr.responseJSON.message
                    ) {

                        message =
                            xhr.responseJSON.message;

                    }

                    showCheckoutError(
                        message,
                        button
                    );

                }

            });

        }


        /*
        =====================================================
        ERROR / UNLOCK
        =====================================================
        */

        function showCheckoutError(
            message,
            button
        ) {

            paymentProcessing = false;

            $('#checkoutTopError')
                .text(message)
                .addClass('show');


            button
                .prop('disabled', false)
                .css({
                    'pointer-events': '',
                    'opacity': ''
                });


            updatePaymentButtonText();

        }

    });
</script>

@endsection