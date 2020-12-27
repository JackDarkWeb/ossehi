@extends('layouts.default', ['title' => request()->sub_category_name])

@section('content')

    <div class="page-wrapper">


        @include('layouts.nav')

        <main class="main">
            <div class="banner banner-cat" style="background-image: url({{asset('app/images/banners/banner-top.jpg')}});">
                <div class="banner-content container">
                    <h2 class="banner-subtitle">{{ __('check out over') }} <span>200+</span></h2>
                    <h1 class="banner-title">
                        INCREDIBLE deals
                    </h1>
                    <a href="#" class="btn btn-dark">Shop Now</a>
                </div><!-- End .banner-content -->
            </div><!-- End .banner -->

            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#">{{ request()->category_name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ request()->sub_category_name }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">

                        <nav class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-item toolbox-sort">
                                    <div class="select-custom">
                                        <select name="orderby" class="form-control">
                                            <option value="menu_order" selected="selected">Default sorting</option>
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                                </div><!-- End .toolbox-item -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-item toolbox-show">
                                <label>Showing 1–{{ $products->count().' '. __('of') }}  {{ plurals($products->total(), 'result') }}</label>
                            </div><!-- End .toolbox-item -->
                        </nav>

                        <div class="row row-sm">
                            @foreach($products as $product)
                                <div class="col-6 col-md-4">
                                    <div class="product-default">
                                        <figure>
                                            <a href="{{ route_name('product', ['slug' => $product->slug]) }}">
                                                <img src="{{ asset($product->image) }}">
                                            </a>

                                            <div class="label-group">
                                                <div class="product-label label-hot d-none">HOT</div>
                                                @if($product->discount_price)
                                                    <div class="product-label label-sale">-{{ $product->discount_percent }}%</div>
                                                @endif
                                            </div>

                                            <div class="label-group-galleries">
                                                <div class="product-label label-sale-galleries">
                                                    <span style="font-size: 1.2rem">{{ $product->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                                                </div>
                                            </div>

                                        </figure>
                                        <div class="product-details">
                                            <div class="ratings-container">
                                                <a class="rating-link">( {{ plurals($product->comments->count(), 'Avis') }} )</a>
                                            </div><!-- End .product-container -->
                                            <h2 class="product-title">
                                                <a href="{{ route_name('product', ['slug' => $product->slug]) }}">{{ $product->short_title_product }}</a>
                                            </h2>
                                            <div class="price-box">

                                                @if($product->discount_price)
                                                    <span class="old-price">{!! $product->price_product_with_devise !!}</span>
                                                    <span class="product-price">{!! $product->price_discount_with_devise !!}</span>
                                                @else
                                                    <span class="product-price">{!! $product->price_product_with_devise !!}</span>
                                                @endif


                                            </div><!-- End .price-box -->

                                            <form method="#" action="#">

                                                <input type="hidden" id="product-color" value="">

                                                <input type="hidden" id="product-size" value="">

                                                <input type="hidden" id="product-quantity" value="1">

                                                <input type="hidden" id="product-id" value="{{ $product->id }}"/>

                                                <div class="product-action">
                                                    <span class="btn-icon btn-add-cart" id="btn-shipping-order" data-values='{"id": "{{ $product->id }}", "title": "{{ $product->short_title_product }}", "price" : "{{ $product->original_price }}", "devise":"{{ $product->out_devise_price }}", "url" : "{{ route_name('product', ['slug' => $product->slug]) }}", "image" : "{{ asset($product->image) }}" }' data-toggle="modal" data-target="#orderProductModal"><i class="fas fa-car"></i>{{strtoupper(__('Order'))}}</span>
                                                    <a href="{{ route_name('product.quick.view', ['slug' => $product->slug]) }}" class="btn-quickview" title="Quick View"><i class="fas fa-external-link-alt"></i></a>
                                                </div>
                                            </form>

                                        </div><!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <nav class="toolbox toolbox-pagination">
                            <div class="toolbox-item toolbox-show">
                                <label>Showing 1–{{ $products->count().' '. __('of') }}  {{ plurals($products->total(), 'result') }}</label>
                            </div><!-- End .toolbox-item -->

                            <ul class="pagination">
                               {{($products->links())}}
                            </ul>
                        </nav>
                    </div><!-- End .col-lg-9 -->

                    @include('layouts.products_filters')

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')

    <script src="{{asset('app/js/nouislider.min.js')}}"></script>
@stop
