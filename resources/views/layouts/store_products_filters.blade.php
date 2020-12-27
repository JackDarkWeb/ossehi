

<aside class="sidebar-shop col-lg-3 order-lg-first mobile-sidebar">
    <div class="sidebar-wrapper">


        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-3" role="button" aria-expanded="true" aria-controls="widget-body-3">{{ __('Price') }}</a>
            </h3>

            <div class="collapse show" id="widget-body-3">
                <div class="widget-body">
                    <form action="#">
                        <div class="price-slider-wrapper">
                            <div id="price-slider"></div><!-- End #price-slider -->
                        </div><!-- End .price-slider-wrapper -->

                        <div class="filter-price-action d-flex align-items-center justify-content-between flex-wrap">
                            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>

                            <div class="filter-price-text">
                                {{ __('Price') }}:
                                <span id="filter-price-range"></span>
                            </div><!-- End .filter-price-text -->
                        </div><!-- End .filter-price-action -->
                    </form>
                </div><!-- End .widget-body -->
            </div><!-- End .collapse -->
        </div><!-- End .widget -->

        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-4" role="button" aria-expanded="true" aria-controls="widget-body-4">{{ __('Size') }}</a>
            </h3>

            <div class="collapse show" id="widget-body-4">
                <div class="widget-body">
                    <ul class="cat-list">

                        @foreach(stock_sizes() as $size)
                            <li><a href="#">{{ $size }}  <span>{{ count_feature_store_product($store, $size) }}</span></a></li>
                        @endforeach

                    </ul>
                </div><!-- End .widget-body -->
            </div><!-- End .collapse -->
        </div><!-- End .widget -->

        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-5" role="button" aria-expanded="true" aria-controls="widget-body-5">{{ __('Brand') }}</a>
            </h3>

            <div class="collapse show" id="widget-body-5">
                <div class="widget-body">
                    <ul class="cat-list">

                        @foreach(stock_brands() as $brand )
                            <li><a href="#">{{ $brand }}  <span>{{ count_feature_store_product($store, $brand) }}</span></a></li>
                        @endforeach

                    </ul>
                </div><!-- End .widget-body -->
            </div><!-- End .collapse -->
        </div><!-- End .widget -->

        <div class="widget">
            <h3 class="widget-title">
                <a data-toggle="collapse" href="#widget-body-6" role="button" aria-expanded="true" aria-controls="widget-body-6">Color</a>
            </h3>

            <div class="collapse show" id="widget-body-6">
                <div class="widget-body">
                    <ul class="config-swatch-list">

                        @foreach(stock_colors() as $key => $value)
                            <li class="active">
                                <a href="#" style="background-color: {{ $value }};"></a>
                                <span>{{ __( $key ) }}</span>
                            </li>
                        @endforeach

                    </ul>
                </div><!-- End .widget-body -->
            </div><!-- End .collapse -->
        </div><!-- End .widget -->

    </div><!-- End .sidebar-wrapper -->
</aside><!-- End .col-lg-3 -->



