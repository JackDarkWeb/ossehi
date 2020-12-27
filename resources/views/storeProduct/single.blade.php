@extends('layouts.default', ['title' => $product->title])

@section('content')



    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>

                        <li class="breadcrumb-item"><a href="{{ route_name('store.products', ['slug' => $store->slug]) }}">{{ __('Store') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $store->name }}</li>

                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">

                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-single-container product-single-default">
                            <div class="row">
                                <div class="col-lg-7 col-md-6 product-single-gallery">
                                    <div class="product-slider-container product-item">
                                        <div class="product-single-carousel owl-carousel owl-theme">

                                            @foreach($product->galleries as $image)
                                                <div class="product-item">
                                                    <img class="product-single-image" src="{{ asset($image->name) }}" data-zoom-image="{{ asset($image->name) }}"/>
                                                </div>
                                            @endforeach

                                        </div>
                                        <!-- End .product-single-carousel -->
                                        <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                                    </div>
                                    <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>
                                        @foreach($product->galleries as $image)
                                            <div class="col-3 owl-dot">
                                                <img src="{{ asset($image->name) }}"/>
                                            </div>
                                        @endforeach
                                    </div>
                                </div><!-- End .col-lg-7 -->

                                <div class="col-lg-5 col-md-6">
                                    <div class="product-single-details">
                                        <h1 class="product-title">{{ $product->title }}</h1>

                                        <div class="ratings-container">
                                            <a  class="rating-link">( {{ plurals($product->comments->count(), 'Avis') }} )</a>
                                        </div><!-- End .product-container -->
                                        <div class="price-box">
                                            @if($product->discount_price)
                                                <span class="old-price">{!! ($product->price_store_product_with_devise) !!}</span>
                                                <span class="product-price">{!! $product->price_discount_with_devise !!}</span>
                                            @else
                                                <span class="product-price">{!! ($product->price_store_product_with_devise) !!}</span>
                                            @endif
                                        </div><!-- End .price-box -->

                                        <div class="product-desc">
                                            <p>{{ $product->short_description_store_product }}</p>
                                        </div><!-- End .product-desc -->

                                        <div class="product-filters-container">

                                            @if($product->sizes_store_product)
                                                <div class="product-single-filter">

                                                    <label>{{ __('Sizes') }}:</label>

                                                    <ul class="config-size-list">

                                                        @foreach($product->sizes_store_product as $key => $value)
                                                           <li><a href="#">{{ $value }}</a></li>
                                                        @endforeach

                                                    </ul>
                                                </div><!-- End .product-single-filter -->
                                            @endif

                                            @if($product->colors_store_product)
                                                <div class="product-single-filter">

                                                    <label>{{__('Colors')}}:</label>

                                                    <ul class="config-swatch-list">

                                                        @foreach($product->colors_store_product as $key => $value)
                                                            <li>
                                                                <a href="#" style="background-color: {{ $value }}"></a>
                                                            </li>
                                                        @endforeach
                                                    </ul>

                                                </div><!-- End .product-single-filter -->
                                            @endif

                                        </div><!-- End .product-filters-container -->

                                        <form method="#" action="#" id="cart-operation-store-form" data-action="{{ route_name('destroy.favorite.product', ['id' => $product->id]) }}">

                                            <input type="hidden" id="product-color">
                                            <input type="hidden" id="product-size">
                                            <input type="hidden" id="product-dt" value='{"id": "{{ $product->id }}", "title": "{{ $product->short_title_store_product }}", "price" : "{{ $product->original_price }}", "devise":"{{ $product->out_devise_price }}", "url" : "{{ route_name('store.products.single', ['slug' => $product->slug]) }}", "image" : "{{ asset($product->image) }}" }'/>
                                            <input type="hidden" id="product-id" value="{{ $product->id }}"/>

                                            <div class="product-action product-all-icons">

                                                <div class="product-single-qty">
                                                    <input class="horizontal-quantity form-control" id="product-quantity" type="text">
                                                </div><!-- End .product-single-qty -->

                                                <button id="btn-added-cart" class="paction add-cart" title="{{__('Add to Cart')}}">
                                                    <span>{{__('Add to Cart')}}</span>
                                                </button>

                                                <a href="#" class="paction add-wishlist {{ favorite_product($product->id) }}" id="add-to-favorite" title="{{__('Add to Wishlist')}}">
                                                    <span>{{__('Add to Wishlist')}}</span>
                                                </a>

                                            </div><!-- End .product-action -->
                                        </form>

                                        <div class="product-single-share">
                                            <label>{{__('Share')}}:</label>
                                            <!-- www.addthis.com share plugin-->
                                            <div class="addthis_inline_share_toolbox"></div>
                                        </div><!-- End .product single-share -->
                                    </div><!-- End .product-single-details -->
                                </div><!-- End .col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .product-single-container -->

                        @include('layouts.container_comment')

                    </div><!-- End .col-lg-9 -->

                    <div class="sidebar-overlay"></div>
                    <div class="sidebar-toggle"><i class="icon-sliders"></i></div>

                    @include('layouts.sidebar_single')

                </div><!-- End .row -->

            </div><!-- End .container -->

            @include('layouts.sidebar_top_single')


        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')

    <!-- www.addthis.com share plugin -->
    <script src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b927288a03dbde6"></script>

@endsection

@section('scripts')


    @include('scripts.script_comment_store_product')

@endsection
