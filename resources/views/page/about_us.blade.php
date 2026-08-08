@extends('layouts.web.web')

@section('content')
<section class="utf_block_wrapper">
    <div class="container">
        <div style="text-align: center;" class="row">
            <div class="col-lg-12 col-md-12">
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">

                            <div class="text-center mb-5">
                                <h1 class="fw-bold">About Us</h1>

                                <p class="lead mt-3">
                                    {{ $store_data['name'] }} is your trusted platform for discovering the latest
                                    <strong>trending products, exclusive deals, discounts, and online shopping offers.</strong>
                                    We help shoppers save time and money by bringing together the best offers from trusted online stores in one place.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold">Who We Are</h3>
                                <p>
                                    At {{ $store_data['name'] }}, we are passionate about helping users find the best value while shopping online.
                                    Our platform features trending products across categories including Electronics, Mobiles,
                                    Fashion, Beauty, Home Essentials, and more. We regularly update our website with the latest
                                    deals, price drops, coupons, and shopping recommendations so you never miss a great offer.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold">What We Offer</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">🔥 Latest Trending Products</li>
                                            <li class="list-group-item">💰 Best Deals & Discounts</li>
                                            <li class="list-group-item">🎁 Coupon Codes & Special Offers</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">⭐ Product Information & Recommendations</li>
                                            <li class="list-group-item">📢 Shopping Tips & Buying Guides</li>
                                            <li class="list-group-item">✅ Regularly Updated Content</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold">Our Mission</h3>
                                <p>
                                    Our mission is to become a trusted destination for online shoppers by providing accurate,
                                    up-to-date information about the best products and deals available. We aim to make online
                                    shopping easier, smarter, and more affordable for everyone.
                                </p>
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold">Why Choose {{ $store_data['name'] }}?</h3>
                                <div class="row text-center">
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3 h-100">
                                            <h5>🛒</h5>
                                            <h6>Trending Products</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3 h-100">
                                            <h5>💸</h5>
                                            <h6>Best Discounts</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3 h-100">
                                            <h5>⚡</h5>
                                            <h6>Daily Updates</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3 h-100">
                                            <h5>🔒</h5>
                                            <h6>Trusted Information</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h3 class="fw-bold">Disclaimer</h3>
                                <p>
                                    {{ $store_data['name'] }} does not directly sell products. We share information about deals,
                                    discounts, coupons, and product recommendations from trusted online retailers.
                                    Product prices, availability, and offers may change without prior notice.
                                    Please verify all information on the respective retailer's website before making a purchase.
                                </p>
                            </div>

                            <div class="text-center mt-5">
                                <h3 class="text-primary">Thank You for Visiting {{ $store_data['name'] }}!</h3>
                                <p class="mb-0">
                                    We appreciate your support and look forward to helping you discover the best online deals,
                                    trending products, and shopping offers every day.
                                </p>
                                <h4 class="mt-3 text-success">Happy Shopping! 🛍️</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- @include('sidebar') -->
        </div>
    </div>
</section>
@endsection