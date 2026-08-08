@extends('layouts.web.web')
@section('custom_header')
<link href="{{ asset('web_assets/css/listing.css') }}" rel="stylesheet">
@endsection

@section('content')
<main>
    @if((isset($category_data['category_page_banner']) && $category_data['category_page_banner'] != true ) || true == true)
    <style>
        .top_banner {
            height: 80px !important;
            overflow: hidden;
            position: relative;
        }
    </style>
    @endif
    <div class="top_banner version_2">
        <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0)">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <h1>Categories</h1>
                </div>
            </div>
        </div>

    </div>
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

    <div class="mb-2" id="stick_here"></div>
    <!-- /container -->
</main>
<!-- /main -->
@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
@endsection