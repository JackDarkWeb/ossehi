<div class="featured-section">
    <div class="container">
        <h2 class="carousel-title">{{ __('Featured Products') }}</h2>

        <div class="home-featured-products owl-carousel owl-theme owl-dots-top">

            @foreach(get_products_by_parts(0, 8) as $product)

                <div class="product-default">
                    <figure>
                        <a href="{{ route_name('product', ['slug' => $product->slug]) }}">
                            <img src="{{ asset( $product->image ) }}">
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
                            <a  class="rating-link">( {{ plurals($product->comments->count(), 'Avis') }} )</a>
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

                            <input type="hidden" id="product-quantity" value="1">

                            <input type="hidden" id="product-color" value="">

                            <input type="hidden" id="product-id" value="{{ $product->id }}"/>

                            <div class="product-action">
                                <span class="btn-icon btn-add-cart" id="btn-shipping-order" data-values='{"id": "{{ $product->id }}", "title": "{{ $product->short_title_product }}", "price" : "{{ $product->original_price }}", "devise":"{{ $product->out_devise_price }}", "qty":"1", "url" : "{{ route_name('product', ['slug' => $product->slug]) }}", "image" : "{{ asset($product->image) }}" }' data-toggle="modal" data-target="#orderProductModal"><i class="fas fa-car"></i>{{strtoupper(__('Order'))}}</span>
                                <a href="{{ route_name('product.quick.view', ['slug' => $product->slug]) }}" class="btn-quickview" title="{{__('Quick View')}}"><i class="fas fa-external-link-alt"></i></a>
                            </div>

                        </form>


                    </div><!-- End .product-details -->

                </div>
            @endforeach

        </div><!-- End .featured-proucts -->
    </div><!-- End .container -->
</div><!-- End .featured-section -->
