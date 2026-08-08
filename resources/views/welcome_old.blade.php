@extends('layouts.web.web')

@section('custom_header')

@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/carousel-home.js') }}"></script>
@endsection
@section('content')
<main>

    <ul id="banners_grid" class="clearfix">
        <?php foreach ($category_data as $category_key => $category_item) { ?>
            <li>
                <a href="{{ route('category', ['slug' => $category_item['slug']]) }}" class="img_container">
                    <img src="<?php echo asset('uploads/category') . '/' . $category_item['image']; ?>" data-src="<?php echo asset('uploads/category') . '/' . $category_item['image']; ?>" alt="" class="lazy">
                    <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                        <h3>{{ $category_item['name'] }}</h3>
                        <div><span class="btn_1">Shop Now</span></div>
                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
    <!--/banners_grid -->

  
    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Featured</h2>
            <span>Products</span>
        </div>
        <div class="row small-gutters">
            @foreach($latest_data as $product)
            <div class="col-6 col-md-4 col-xl-3">
                <div class="grid_item">
                    <figure>
                        <a href="{{ route('product', ['id'=>$product['id'],'slug' => $product['slug']]) }}">
                            <img class="img-fluid lazy" src="<?php echo asset('uploads/product') . '/' . $product->products_images->first()->image; ?>" data-src="<?php echo asset('uploads/product') . '/' . $product->products_images->first()->image; ?>" alt="">
                        </a>
                    </figure>
                    <a href="{{ route('product', ['id'=>$product['id'],'slug' => $product['slug']]) }}">
                        <h3>{{ $product->name }}</h3>
                    </a>
                    <div class="price_box">
                        <span class="new_price"${{ number_format($product->price, 2) }}</span>
                    </div>
                    <!-- <ul>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
                        <li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a></li>
                    </ul> -->
                </div>
            </div>
            @endforeach
            <div style="text-align: center;"><a href="{{ route('home') }}"><span class="btn_1">View All Products</span></a></div>
        </div>
    </div>


</main>
<!-- /main -->
@endsection