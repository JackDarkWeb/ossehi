

<div class="row products-widgets">
    <div class="col-6 col-md-4 pb-md-0">
        <div class="product-column">
            <h3 class="title">{{__('Recruitments')}}</h3>

            @foreach(get_various_type('recruitment', 3) as $various)

                <div class="product-default left-details product-widget mb-3">
                    <figure>
                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                            <img src="{{ asset( $various->image ) }}">
                        </a>

                        <div class="label-group-galleries">
                            <div class="product-label label-sale-galleries">
                                <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                            </div>
                        </div>

                    </figure>
                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{$various->short_title_various}}</a>
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

        </div><!-- End .product-column -->
    </div><!-- End .col-md-4 -->

    <div class="col-6 col-md-4 pb-4 pb-md-0">
        <div class="product-column">
            <h3 class="title">{{__('Announces')}}</h3>

            @foreach(get_various_type('announce', 3) as $various)

                <div class="product-default left-details product-widget mb-3">
                    <figure>
                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                            <img src="{{ asset($various->image) }}">
                        </a>

                        <div class="label-group-galleries">
                            <div class="product-label label-sale-galleries">
                                <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                            </div>
                        </div>

                    </figure>
                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{$various->short_title_various}}</a>
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


        </div><!-- End .product-column -->
    </div><!-- End .col-md-4 -->

    <div class="col-6 col-md-4 pb-md-0">
        <div class="product-column">
            <h3 class="title">{{__('Pubs')}}</h3>

            @foreach(get_various_type('publicity', 3) as $various)

                <div class="product-default left-details product-widget mb-3">
                    <figure>
                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                            <img src="{{ asset( $various->image ) }}">
                        </a>

                        <div class="label-group-galleries">
                            <div class="product-label label-sale-galleries">
                                <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                            </div>
                        </div>

                    </figure>
                    <div class="product-details">
                        <h2 class="product-title">
                            <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{$various->short_title_various}}</a>
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


        </div><!-- End .product-column -->
    </div><!-- End .col-md-4 -->
</div><!-- End .row -->
