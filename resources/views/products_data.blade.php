<div class="row small-gutters">
    @foreach($data as $product)
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
       
        </div>
        <!-- /grid_item -->
    </div>
    <!-- /col -->
    @endforeach
</div>
<div class="pagination__wrapper">
    {{ $data->links() }}
</div>