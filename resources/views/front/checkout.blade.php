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
</style>

@endsection


@section('content')

<main>

    <section class="py-4">

        <div class="container">

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

    </section>

</main>

@endsection
@section('custom_footer')

<script>
    $(document).ready(function() {


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


    });
</script>

@endsection