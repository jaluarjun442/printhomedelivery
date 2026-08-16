@extends('layouts.web.web')

@section('custom_header')
<title>Track Your Order | Print Ki Dukan</title>
<meta name="keywords" content="track printing order, track Print Ki Dukan order, printing order tracking, document delivery tracking, online print order status">
<meta name="description" content="Track your Print Ki Dukan printing order using your mobile number. Check your order status and stay updated on the processing and delivery of your printed documents.">


<meta
    name="robots"
    content="noindex,nofollow">

<script
    src="https://challenges.cloudflare.com/turnstile/v0/api.js"
    async
    defer>
</script>

@endsection

@section('content')

<main>

    <section class="track-order-section">

        <div class="container">

            <div class="track-order-wrapper">

                {{-- =====================================================
                    HEADER
                ====================================================== --}}

                <div class="track-order-header">

                    <h1>
                        Track Your Order
                    </h1>

                    <p>
                        Enter the mobile number used while placing your order.
                    </p>

                </div>


                {{-- =====================================================
                    TRACK ORDER CARD
                ====================================================== --}}

                <div class="track-order-card">

                    {{-- ERROR --}}

                    @if(session('error'))

                    <div class="track-order-alert">
                        {{ session('error') }}
                    </div>

                    @endif


                    {{-- VALIDATION ERRORS --}}

                    @if($errors->any())

                    <div class="track-order-alert">

                        <ul class="mb-0">

                            @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                            @endforeach

                        </ul>

                    </div>

                    @endif


                    <form
                        method="POST"
                        action="{{ route('track-order.mobile') }}">

                        @csrf


                        <div class="track-order-form-group">

                            <label for="mobile">
                                Mobile Number
                            </label>

                            <input
                                type="tel"
                                id="mobile"
                                name="mobile"
                                class="track-order-form-control"
                                value="{{ old('mobile') }}"
                                placeholder="Enter your mobile number"
                                maxlength="15"
                                required>

                        </div>


                        {{-- Cloudflare Turnstile --}}

                        <div class="mb-4">

                            <div
                                class="cf-turnstile"
                                data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}">
                            </div>

                        </div>


                        <button
                            type="submit"
                            class="track-order-submit-btn">

                            Track Order

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>

</main>

@endsection