@extends('layouts.default', ['title' => __('Favorites products')])

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
                        <li class="breadcrumb-item"><a href="#">{{ __('Favorites') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
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
                                <label>Showing 1–{{ $products->count() }} of {{ $products->total().' '.Str::plural('result', $products->total()) }}</label>
                            </div><!-- End .toolbox-item -->
                        </nav>

                        <div class="row row-sm">
                            @foreach($products as $product)
                                <div class="col-6 col-md-4">
                                    <div class="product-default">
                                        <figure>
                                            <a href="{{ $product->favorite_product->url }}">
                                                <img src="{{ asset($product->favorite_product->image) }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">

                                            <h2 class="product-title">
                                                <a href="{{ $product->favorite_product->url }}">{{ $product->favorite_product->title }}</a>
                                            </h2>


                                        </div><!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <nav class="toolbox toolbox-pagination">
                            <div class="toolbox-item toolbox-show">
                                <label>Showing 1–{{ $products->count() }} of {{$products->total().' '.Str::plural('result', $products->total())}}</label>
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
@endsection
