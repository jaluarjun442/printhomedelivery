@extends('layouts.web.web')
@section('title')
<title><?php echo $data['name']; ?> - {{ store_data()['name'] }} </title>
@endsection
@section('content')


<!-- 1rd Block Wrapper Start -->
<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="single-post">
                    <div class="utf_post_title-area"> <a class="utf_post_cat" href="#"><?php echo $data['category']['name']; ?></a>
                        <h2 class="utf_post_title"><?php echo $data['name']; ?></h2>
                        <!-- <div class="utf_post_meta"> <span class="utf_post_author"> By <a href="#">John Wick</a> </span> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 15 Jan, 2022</span> <span class="post-hits"><i class="fa fa-eye"></i> 21</span> <span class="post-comment"><i class="fa fa-comments-o"></i> <a href="#" class="comments-link"><span>01</span></a></span> </div> -->
                    </div>

                    <div class="utf_post_content-area">
                        <div class="post-media post-featured-image">
                            <a href="#" class="gallery-popup">
                                <img src="<?php echo  asset('uploads/product') . '/' . $data['image']; ?>" class="img-fluid" alt="">
                            </a>
                        </div>
                        <div style="text-align: center;" class="entry-content">
                            <?php
                            if ($data['product_widget']->where('store_id', store_id())->first()) {
                                $widget_data = $data['product_widget']->where('store_id', store_id())->first()['widget_data'];
                            } else {
                                $widget_data = "";
                            }
                            echo $widget_data;
                            ?>
                        </div>
                        <div class="entry-content">
                            {!! $data['body']; !!}
                        </div>
                        <div style="text-align: center;" class="entry-content">
                            <?php
                            echo $widget_data;
                            ?>
                        </div>
                        <!-- <div class="tags-area clearfix">
                            <div class="post-tags">
                                <span>Tags:</span>
                                <a href="#"># Business</a>
                                <a href="#"># Corporate</a>
                                <a href="#"># Services</a>
                                <a href="#"># Customer</a>
                            </div>
                        </div> -->

                        <div class="share-items clearfix">
                            <ul class="post-social-icons unstyled">
                                <li class="facebook"> <a href="#"> <i class="fa fa-facebook"></i> <span class="ts-social-title">Facebook</span></a> </li>
                                <li class="twitter"> <a href="#"> <i class="fa fa-twitter"></i> <span class="ts-social-title">Twitter</span></a> </li>
                                <li class="gplus"> <a href="#"> <i class="fa fa-google-plus"></i> <span class="ts-social-title">Google +</span></a> </li>
                                <li class="pinterest"> <a href="#"> <i class="fa fa-pinterest"></i> <span class="ts-social-title">Pinterest</span></a> </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <nav class="post-navigation clearfix">
                    <div class="post-previous">

                        <a href="<?php echo route('product', [$prev_next_data[0]['id'], $prev_next_data[0]['slug']]); ?>"> <span><i class="fa fa-angle-left"></i>Previous Post</span>
                            <h3>{{ substr($prev_next_data[0]['name'], 0, 80); }}</h3>
                        </a>
                    </div>
                    <div class="post-next">
                        <a href="<?php echo route('product', [$prev_next_data[1]['id'], $prev_next_data[1]['slug']]); ?>"> <span>Next Post <i class="fa fa-angle-right"></i></span>
                            <h3>{{ substr($prev_next_data[1]['name'], 0, 80); }}</h3>
                        </a>
                    </div>
                </nav>


                <div class="related-posts block">
                    <h3 class="utf_block_title"><span>Related Posts</span></h3>
                    <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">
                        <?php foreach ($related_data as $key => $item) { ?>
                            <div class="item">
                                <div class="utf_post_block_style clearfix">
                                    <div class="utf_post_thumb">
                                        <a href="<?php echo route('product', [$item['id'], $item['slug']]); ?>">
                                            <img class="img-fluid" src="<?php echo  asset('uploads/product') . '/' . $item['image']; ?>" alt="" />
                                        </a>
                                    </div>
                                    <a class="utf_post_cat" href="#">Health</a>
                                    <div class="utf_post_content">
                                        <h2 class="utf_post_title title-medium">
                                            <a href="<?php echo route('product', [$item['id'], $item['slug']]); ?>">{{ substr($item['name'], 0, 35); }}</a>
                                        </h2>
                                        <!-- <div class="utf_post_meta"> <span class="utf_post_date"><i class="fa fa-clock-o"></i> 25 Jan, 2022</span> </div> -->
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>
            @include('sidebar')

        </div>
    </div>
</section>
<!-- 1rd Block Wrapper End -->


@endsection