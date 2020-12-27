@extends('layouts.default', ['title' => $various->title])

@section('content')



    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>

                        <li class="breadcrumb-item"><a href="{{ route_name('diversities') }}">{{ __('Diversities') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __($various->type) }}</li>

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


                                            @foreach($various->galleries as $image)

                                                <div class="product-item">
                                                    <img class="product-single-image" src="{{ asset( $image->name ) }}" data-zoom-image="{{ asset( $image->name ) }}"/>
                                                </div>

                                            @endforeach


                                        </div>

                                        <!-- End .product-single-carousel -->
                                        <span class="prod-full-screen">
                                            <i class="icon-plus"></i>
                                        </span>
                                    </div>

                                    <div class="prod-thumbnail row owl-dots" id='carousel-custom-dots'>

                                        @foreach($various->galleries as $image)

                                            <div class="col-3 owl-dot">
                                                <img src="{{ asset( $image->name ) }}"/>
                                            </div>

                                       @endforeach

                                    </div>
                                </div><!-- End .col-lg-7 -->

                                <div class="col-lg-5 col-md-6">
                                    <div class="product-single-details">
                                        <h1 class="product-title">{{ $various->title }}</h1>

                                        <div class="ratings-container">
                                            <a  class="rating-link">( {{ plurals($various->comments->count(), 'Avis') }} )</a>
                                        </div><!-- End .product-container -->


                                        <div class="price-box">

                                            @if($various->discount_price)
                                                <span class="old-price">{!! $various->price_various_with_devise !!}</span>
                                                <span class="product-price">{!! $various->price_discount_with_devise !!}</span>
                                            @else
                                                <span class="product-price">{!! $various->price_various_with_devise !!}</span>
                                            @endif

                                        </div><!-- End .price-box -->

                                        <div class="product-desc">
                                            <p>{{ $various->short_description_various }}</p>
                                        </div><!-- End .product-desc -->


                                            <div class="entry-meta mb-4">
                                                <span><i class="icon-calendar"></i>{{ $various->date_various }}</span>
                                                <span><i class="icon-user"></i>{{ __('By') }} <a href="#">{{ __($various->user->user_name_profile) }}</a></span>
                                                <span><i class="icon-earphones-alt"></i><a href="tel:#">{{ $various->user->phone }}</a></span>
                                            </div><!-- End .entry-meta -->


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

@stop


@section('scripts')

    @include('scripts.script_comment_various')

@endsection
