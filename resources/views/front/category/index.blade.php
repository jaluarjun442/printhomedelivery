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
                    <h1>{{ $category_data['name'] }}</h1>
                </div>
            </div>
        </div>
        @if((isset($category_data['category_page_banner']) && $category_data['category_page_banner'] == true ) || true != true)
        <img src="<?php echo asset('uploads/category') . '/' . $category_data['image']; ?>" class="img-fluid" alt="">
        @endif
    </div>
    <!-- /top_banner -->
    @if (count($category_data['childCategory']) > 0)
    <ul id="banners_grid" class="clearfix">
        <?php foreach ($category_data['childCategory'] as $category_key => $category_item) { ?>
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
    @endif
    <div id="stick_here"></div>

    <div id="product_main_container" class="container margin_30">
        @include('front.category.products_data', ['data' => $data])
    </div>
    <!-- /container -->
</main>
<!-- /main -->
@endsection
@section('custom_footer')
<script src="{{ asset('web_assets/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('web_assets/js/specific_listing.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            var slug = "{{ route('category', ['slug' => $slug]) }}";
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