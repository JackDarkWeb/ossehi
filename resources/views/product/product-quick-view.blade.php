
<div class="product-single-container product-single-default product-quick-view container">
    <div class="row">
        <div class="col-lg-6 col-md-6 product-single-gallery">
            <div class="product-slider-container product-item">
                <div class="product-single-carousel owl-carousel owl-theme">



                        @foreach($product->galleries as $image)

                            <div class="product-item">
                                <img class="product-single-image" src="{{ asset($image->name) }}" data-zoom-image="{{ asset($product->image) }}"/>
                            </div>

                        @endforeach


                </div>
                <!-- End .product-single-carousel -->
            </div>
            <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>


                    @foreach($product->galleries as $image)

                        <div class="col-3 owl-dot">
                            <img src="{{ asset($image->name) }}"/>
                        </div>

                    @endforeach


            </div>
        </div><!-- End .col-lg-7 -->

        <div class="col-lg-6 col-md-6">
            <div class="product-single-details">
                <h1 class="product-title">{{ $product->title }}</h1>

                <div class="ratings-container">
                    <a class="rating-link">( {{ plurals($product->comments->count(), 'Avis') }} )</a>
                </div><!-- End .product-container -->

                <div class="price-box">

                    @if($product->discount_price)
                        <span class="old-price">{!! $product->price_product_with_devise !!}</span>
                        <span class="product-price">{!! $product->price_discount_with_devise !!}</span>
                    @else
                        <span class="product-price">{!! $product->price_product_with_devise !!}</span>
                    @endif

                </div><!-- End .price-box -->

                <div class="product-desc">
                    <p> {{ $product->short_description_product }}</p>
                </div><!-- End .product-desc -->


                <div class="entry-meta mb-4">
                    <span><i class="icon-calendar"></i>{{ $product->date_product }}</span>
                    <span><i class="icon-user"></i>{{ __('By') }} <a href="#">{{ __($product->user->user_name_profile) }}</a></span>
                    <span><i class="icon-earphones-alt"></i><a href="tel:#">{{ $product->user->phone }}</a></span>
                </div><!-- End .entry-meta -->

                <div class="product-filters-container">

                    @if($product->sizes_product)
                        <div class="product-single-filter">

                            <label>{{ __('Sizes') }}:</label>

                            <ul class="config-size-list">

                                @foreach($product->sizes_product as $key => $value)
                                    <li><a href="#">{{ $value }}</a></li>
                                @endforeach

                            </ul>
                        </div><!-- End .product-single-filter -->
                    @endif

                    @if($product->colors_product)
                        <div class="product-single-filter">
                            <label>{{__('Colors')}}:</label>
                            <ul class="config-swatch-list">
                                @foreach($product->colors_product as $key => $value)

                                    <li>
                                        <a href="#" style="background-color: {{ $value }}"></a>
                                    </li>

                                @endforeach
                            </ul>
                        </div><!-- End .product-single-filter -->
                    @endif

                </div><!-- End .product-filters-container -->

                <form method="#"  id="cart-operation-form">

                    <input type="hidden" id="product-color">

                    <input type="hidden" id="product-size">

                    <input type="hidden" id="product-id" value="{{ $product->id }}"/>

                    <div class="product-action">
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text" id="product-quantity" value="">
                        </div><!-- End .product-single-qty -->

                        <button id="btn-shipping-order" data-values='{"id": "{{ $product->id }}", "title": "{{ $product->short_title_product }}", "price" : "{{ $product->original_price }}", "devise":"{{ $product->out_devise_price }}", "url" : "{{ route_name('product', ['slug' => $product->slug]) }}", "image" : "{{ asset($product->image) }}" }' data-toggle="modal" data-target="#orderProductModal" class="paction fas fa-car" title="{{__('Order')}}">
                            <span>{{__('Order')}}</span>
                        </button>

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

