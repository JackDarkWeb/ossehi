@extends('layouts.default', ['title' => __('All products by user')])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">

                        <h2>{{ __('My products') }}</h2>


                        <div class="row row-sm">

                            @foreach($products as $product)

                                <div class="col-6 col-md-4">
                                    <div class="product-default">

                                        <figure>
                                            <a href="{{ route_name('product', ['slug' => $product->slug]) }}">
                                                <img src="{{ asset($product->image) }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">

                                            <div class="ratings-container">
                                                <a class="rating-link">( {{ plurals($product->comments->count(), 'Avis') }} )</a>
                                            </div><!-- End .product-container -->
                                            <h2 class="product-title">
                                                <a href="{{ route_name('product', ['slug' => $product->slug]) }}">{{ $product->short_title_product }}</a>
                                            </h2>
                                            <div class="price-box" id="price-box{{ $product->id }}">

                                                @if($product->discount_price)
                                                    <span class="old-price">{!! $product->price_product_with_devise !!}</span>
                                                    <span class="product-price">{!! $product->price_discount_with_devise !!}</span>
                                                @else
                                                    <span class="product-price">{!! $product->price_product_with_devise !!}</span>
                                                @endif

                                            </div><!-- End .price-box -->

                                            <form method="#" action="#">

                                                <div class="product-action">

                                                    <a href="{{ route('destroy.product', ['lang' => app()->getLocale(), 'product_id' => $product->id, 'slug' => $product->slug]) }}" onclick="return confirm(`{{ __('Do you want to delete the product') }} ?`)" class="mx-4 destroy-product" title="{{ __('Delete store') }}"><i class="far fa-trash-alt text-danger" style="font-size: 1.9rem"></i></a>

                                                    <span id="btn-cancel-discount{{ $product->id }}">

                                                         @if($product->discount_price)
                                                            <span class="btn-icon btn-add-cart cancel-discount"  title="{{ __('Cancel discount') }}" data-action="{{ route('cancel.discount', ['lang' => app()->getLocale(), 'product_id' => $product->id, 'slug' => $product->slug]) }}"><i class="fas fa-percent"></i>{{strtoupper(__('Cancel discount'))}}</span>
                                                         @else
                                                            <a href="{{ route('discount.product', ['lang' => app()->getLocale(), 'product_id' => $product->id, 'slug' => $product->slug, 'price' => $product->price, 'devise' => $product->devise]) }}" id="discount{{ $product->id }}" class="btn-quickview d-none"  title="{{ __('Add discount') }}"><i class="fas fa-car"></i></a>
                                                            <span class="btn-icon btn-add-cart" title="{{ __('Add discount') }}" onclick="event.preventDefault(); document.getElementById(`discount{{ $product->id }}`).click();"><i class="fas fa-percent"></i>{{strtoupper(__('Add discount'))}}</span>
                                                         @endif

                                                    </span>


                                                    <a href="#" class="mx-4" title="{{ __('Edit product') }}" onclick="event.preventDefault(); document.getElementById(`edit{{ $product->id }}`).click();"><i class="far fa-edit text-info" style="font-size: 1.9rem"></i></a>
                                                    <a href="{{ route('edit.product', ['lang' => app()->getLocale(), 'product_id' => $product->id, 'slug' => $product->slug]) }}" class="btn-quickview d-none" id="edit{{ $product->id }}" title="{{ __('Edit product') }}"><i class="fas fa-percent"></i>{{strtoupper(__('Edit product'))}}</a>

                                                </div>

                                                <div class="product-action">
                                                    <a href="{{ route_name('gallery.product', ['slug' => $product->slug]) }}" class="d-none" id="gallery{{$product->id}}"></a>
                                                    <span class="btn-icon btn-add-cart mt-3" onclick="event.preventDefault(); document.getElementById(`gallery{{ $product->id }}`).click();" title="{{ __('Add more photos') }}"><i class="fas fa-camera"></i>{{strtoupper(__('More photos'))}}</span>
                                                </div>
                                            </form>

                                        </div><!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <nav class="toolbox toolbox-pagination">
                            <ul class="pagination">
                                {{($products->links())}}
                            </ul>
                        </nav>
                    </div><!-- End .col-lg-9 -->

                    @include('layouts.nav_my_account')

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')
    </div>

    @include('layouts.more')


@endsection

@section('scripts')

    @include('scripts.script_discount_form')

@endsection
