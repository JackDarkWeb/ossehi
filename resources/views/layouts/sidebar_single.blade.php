<aside class="sidebar-product col-lg-3 padding-left-lg mobile-sidebar">
    <div class="sidebar-wrapper">
        <div class="widget widget-brand">
            <a href="#">
                <img src="{{ asset('images/product-brand.png') }}" alt="brand name">
            </a>
        </div><!-- End .widget -->

        <div class="widget widget-info">
            <ul>
                <li>
                    <i class="icon-shipping"></i>
                    <h4>{{strtoupper(__('Free'))}}<br>{{strtoupper(__('Shipping'))}}</h4>
                </li>
                <li>
                    <i class="icon-us-dollar"></i>
                    <h4>{{__(':percent Money', ['percent' => '100%'])}}<br>{{__('Back Guarantee')}}</h4>
                </li>
                <li>
                    <i class="icon-online-support"></i>
                    <h4>{{__('Online')}}<br>{{__('Support :hours', ['hours' => '24/7'])}}</h4>
                </li>
            </ul>
        </div><!-- End .widget -->

        <div class="widget widget-banner">
            <div class="banner banner-image">
                <a href="#">
                    <img src="{{ asset('images/banners/banner-sidebar.jpg') }}" alt="Banner Desc">
                </a>
            </div><!-- End .banner -->
        </div><!-- End .widget -->

        <div class="widget widget-featured">
            <h3 class="widget-title">{{__('Diversities')}}</h3>

            <div class="widget-body">
                <div class="owl-carousel widget-featured-products">

                    <div class="featured-col">

                        @foreach(get_various_by_random(0, 3) as $various)
                            <div class="product-default left-details product-widget">
                                <figure>
                                    <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                                        <img src="{{ asset( $various->image )  }}">
                                    </a>

                                    <div class="label-group-galleries">
                                        <div class="product-label label-sale-galleries">
                                            <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                                        </div>
                                    </div>

                                </figure>
                                <div class="product-details">

                                    <div class="category-list">
                                        <a href="{{ route_name('diversities.type', ['name' => $various->type]) }}" class="product-category">{{ __($various->type) }}</a>
                                    </div>

                                    <h2 class="product-title">
                                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{ $various->short_title_various }}</a>
                                    </h2>

                                    <div class="ratings-container">
                                        <a  class="rating-link">( {{ plurals($various->comments->count(), 'Avis') }} )</a>
                                    </div><!-- End .product-container -->

                                    <div class="ratings-container">
                                        <span><i class="icon-calendar"></i>{{ $various->short_date_various }}</span>
                                    </div><!-- End .product-container -->

                                    <div class="price-box">
                                        @if($various->discount_price)
                                            <span class="old-price">{!! $various->price_various_with_devise !!}</span>
                                            <span class="product-price">{!! $various->price_discount_with_devise !!}</span>
                                        @else
                                            <span class="product-price">{!! $various->price_various_with_devise !!}</span>
                                        @endif
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        @endforeach

                    </div><!-- End .featured-col -->

                    <div class="featured-col">

                        @foreach(get_various_by_random(1, 3) as $various)
                            <div class="product-default left-details product-widget">
                                <figure>
                                    <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                                        <img src="{{ asset( $various->image )  }}">
                                    </a>

                                    <div class="label-group-galleries">
                                        <div class="product-label label-sale-galleries">
                                            <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                                        </div>
                                    </div>

                                </figure>
                                <div class="product-details">

                                    <div class="category-list">
                                        <a href="{{ route_name('diversities.type', ['name' => $various->type]) }}" class="product-category">{{ __($various->type) }}</a>
                                    </div>

                                    <h2 class="product-title">
                                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{ $various->short_title_various }}</a>
                                    </h2>

                                    <div class="ratings-container">
                                        <a  class="rating-link">( {{ plurals($various->comments->count(), 'Avis') }} )</a>
                                    </div><!-- End .product-container -->


                                    <div class="ratings-container">
                                        <span><i class="icon-calendar"></i>{{ $various->short_date_various }}</span>
                                    </div><!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">{!! $various->price_various_with_devise !!}</span>
                                    </div><!-- End .price-box -->
                                </div><!-- End .product-details -->
                            </div>
                        @endforeach

                    </div><!-- End .featured-col -->

                </div><!-- End .widget-featured-slider -->
            </div><!-- End .widget-body -->
        </div><!-- End .widget -->
    </div>
</aside><!-- End .col-md-3 -->
