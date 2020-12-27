@extends('layouts.default', ['title' => 'e-Ossehi'])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <div class="info-boxes-container">
                <div class="container">
                    <div class="info-box">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>{{strtoupper(__('Free Shipping & Return'))}}</h4>
                            <p>{{__('Free shipping on all orders over :amount', ['amount' => '$99'])}} .</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-us-dollar"></i>

                        <div class="info-box-content">
                            <h4>{{__('MONEY BACK GUARANTEE')}}</h4>
                            <p>{{__(':percent money back guarantee', ['percent' => '100%'])}}</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>{{strtoupper(__('Online Support :hours', ['hours' => '24/7']))}}</h4>
                            <p>{{ __('For all of your concerns') }}</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="home-slider owl-carousel owl-carousel-lazy owl-theme owl-theme-light">

                            @foreach($stores as $store)
                                <div class="home-slide">
                                    <a href="{{ route_name('store.products', ['slug' => $store->slug]) }}">
                                        <div class="owl-lazy slide-bg" data-src="{{ asset( $store->image_store) }}"></div>
                                    </a>
                                    <div class="home-slide-content text-white">
                                        <h3>Get up to <span>60%</span> off</h3>
                                        <h1>{{ $store->name }}</h1>
                                        <p>{{ $store->slogan_store }}</p>
                                        <a href="{{ route_name('store.products', ['slug' => $store->slug]) }}" class="btn btn-dark">{{ __('Store') }}</a>
                                    </div><!-- End .home-slide-content -->
                                </div><!-- End .home-slide -->
                            @endforeach

                        </div><!-- End .home-slider -->

                        <div class="row">
                            <div class="col-md-4">
                                <div class="banner banner-image">
                                    <a href="#">
                                        <img src="{{ asset('images/banners/banner-1.jpg') }}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-md-4">
                                <div class="banner banner-image">
                                    <a href="#">
                                        <img src="{{ asset('images/banners/banner-2.jpg') }}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-4 -->

                            <div class="col-md-4">
                                <div class="banner banner-image">
                                    <a href="#">
                                        <img src="{{ asset('images/banners/banner-2.jpg') }}" alt="banner">
                                    </a>
                                </div><!-- End .banner -->
                            </div><!-- End .col-md-4 -->


                        </div><!-- End .row -->

                        <div class="mb-3"></div><!-- margin -->


                        <h2 class="carousel-title">{{__('VIP Products')}}</h2>

                        <div class="home-featured-products owl-carousel owl-theme owl-dots-top">

                            @foreach(get_products_vip(0, 8) as $product_vip)

                                <div class="product-default">
                                    <figure>

                                        <a href="{{ route_name('product', ['slug' => $product_vip->slug]) }}">
                                            <img src="{{ asset($product_vip->image) }}">
                                        </a>

                                        <div class="label-group">
                                            <div class="product-label label-hot d-none">HOT</div>

                                            @if($product_vip->discount_price)
                                                <div class="product-label label-sale">-{{ $product_vip->discount_percent }}%</div>
                                            @endif
                                        </div>

                                        <div class="label-group-galleries">
                                            <div class="product-label label-sale-galleries">
                                                <span style="font-size: 1.2rem">{{ $product_vip->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                                            </div>
                                        </div>

                                    </figure>

                                    <div class="product-details">

                                        <div class="ratings-container">
                                            <a class="rating-link">( {{ plurals($product_vip->comments->count(), 'Avis') }} )</a>
                                        </div><!-- End .product-container -->

                                        <h2 class="product-title">
                                            <a href="{{ route_name('product', ['slug' => $product_vip->slug]) }}">{{ $product_vip->short_title_product }}</a>
                                        </h2>

                                        <div class="price-box">
                                            @if($product_vip->discount_price)
                                                <span class="old-price">{!! $product_vip->price_product_with_devise !!}</span>
                                                <span class="product-price">{!! $product_vip->price_discount_with_devise !!}</span>
                                            @else
                                                <span class="product-price">{!! $product_vip->price_product_with_devise !!}</span>
                                            @endif
                                        </div><!-- End .price-box -->

                                        <form method="#" action="#">

                                            <input type="hidden" id="product-quantity" value="1">

                                            <input type="hidden" id="product-color" value="">
                                            <input type="hidden" id="product-size" value="">

                                            <input type="hidden" id="product-id" value="{{ $product_vip->id }}"/>

                                            <div class="product-action">
                                                <span class="btn-icon btn-add-cart" id="btn-shipping-order" data-values='{"id": "{{ $product_vip->id }}", "title": "{{ $product_vip->short_title_product }}", "price" : "{{ $product_vip->original_price }}", "devise":"{{ $product_vip->out_devise_price }}", "url" : "{{ route_name('product', ['slug' => $product_vip->slug]) }}", "image" : "{{ asset($product_vip->image) }}" }' data-toggle="modal" data-target="#orderProductModal"><i class="fas fa-car"></i>{{strtoupper(__('Order'))}}</span>
                                                <a href="{{ route_name('product.quick.view', ['slug' => $product_vip->slug]) }}" class="btn-quickview" title="{{__('Quick View')}}"><i class="fas fa-external-link-alt"></i></a>
                                            </div>
                                        </form>
                                    </div><!-- End .product-details -->

                                </div>
                            @endforeach


                        </div><!-- End .featured-proucts -->


                        <div class="mb-6"></div><!-- margin -->


                        @include('various.various_block_home')


                        <div class="mb-3"></div><!-- margin -->

                        @include('layouts.services')

                    </div><!-- End .col-lg-9 -->

                   @include('layouts.sidebar_home')

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-4"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.pop-subscribe')

    @include('layouts.more')


@endsection

@section('scripts')
    <script type="module">
        import Validator from '../js/Validator.js';

        $(function () {

        })
    </script>
@endsection
