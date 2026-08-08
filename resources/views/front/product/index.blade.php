<?php if ($data->au_red == 1) {
    http_response_code(302);
    $red_go_to = route('go_to_product', ['product_id' => encrypt($data['id'])]);
    header("Refresh: 1; url={$red_go_to}");
    exit();
} ?>
@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/product_page.css') }}" rel="stylesheet">
@endsection

@section('content')
<main>
    <div class="container margin_30">
        <div class="row">
            <div class="col-md-6">
                <div class="all">
                    <div class="slider">
                        <div class="owl-carousel owl-theme main">
                            @foreach($data->products_images as $image_key => $image_item)
                            <div style="background-image: url(<?php echo asset('uploads/product') . '/' . $image_item->image; ?>);" class="item-box"></div>
                            @endforeach
                        </div>
                        <div class="left nonl"><i class="ti-angle-left"></i></div>
                        <div class="right"><i class="ti-angle-right"></i></div>
                    </div>
                    <div class="slider-two">
                        <div class="owl-carousel owl-theme thumbs">
                            @foreach($data->products_images as $image_key => $image_item)
                            <div style="background-image: url(<?php echo asset('uploads/product') . '/' . $image_item->image; ?>);" class="item {{ $loop->first ? 'active' : '' }}"></div>
                            @endforeach
                        </div>
                        <div class="left-t nonl-t"></div>
                        <div class="right-t"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                <!-- /page_header -->
                <div class="prod_info">
                    <h1>{{$data->name}}</h1>
                    <br />
                    {!! $data->body !!}
                    <div class="prod_options">

                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="price_main">
                                <span class="new_price">${{ number_format($data->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-6 col-md-6">
                            <div class="" style="width: 100%;">
                                <a target="" href="{{ route('go_to_product', ['product_id' => encrypt($data['id'])]) }}" class="btn_1 action_btn buy_now_btn">
                                    <!-- <i class="ti-shopping-cart"></i> -->
                                    {{ $data->buy_now_text }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>You may also like</h2>
            <span>Products</span>
        </div>
        <div class="row small-gutters">
            @foreach($related_data as $product)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <!-- <span class="ribbon off">-30%</span> -->
                        <a href="{{ route('product', ['id'=>$product['id'],'slug' => $product['slug']]) }}">
                            <img style="height: 250px !important;" class="img-fluid lazy" src="<?php echo asset('uploads/product') . '/' . $product->products_images->first()->image; ?>" data-src="<?php echo asset('uploads/product') . '/' . $product->products_images->first()->image; ?>" alt="">
                        </a>
                        <!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
                    </figure>
                    <a href="{{ route('product', ['id'=>$product['id'],'slug' => $product['slug']]) }}">
                        <h3>{{ $product->name }}</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price">${{ number_format($product->price, 2) }}</span>
                        <!-- <span class="old_price">$60.00</span> -->
                    </div>
                    <ul>
                    </ul>
                </div>
                <!-- /grid_item -->
            </div>
            <!-- /col -->
            @endforeach
        </div>
        <!-- /products_carousel -->
    </div>
    <!-- /container -->
</main>
<!-- /main -->

@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/carousel_with_thumbs.js') }}"></script>
@endsection