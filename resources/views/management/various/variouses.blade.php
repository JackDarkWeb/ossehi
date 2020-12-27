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

                        <h2>{{ __('My ads or advertisements') }}</h2>


                        <div class="row row-sm">

                            @foreach($variouses as $various)

                                <div class="col-6 col-md-4">
                                    <div class="product-default">

                                        <figure>
                                            <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">
                                                <img src="{{ asset($various->image) }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">

                                            <div class="ratings-container">
                                                <a class="rating-link">( {{ plurals($various->comments->count(), 'Avis') }} )</a>
                                            </div><!-- End .product-container -->
                                            <h2 class="product-title">
                                                <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{ $various->short_title_various }}</a>
                                            </h2>
                                            <div class="price-box" id="price-box{{ $various->id }}">

                                                @if($various->discount_price)
                                                    <span class="old-price">{!! $various->price_various_with_devise !!}</span>
                                                    <span class="product-price">{!! $various->price_discount_with_devise !!}</span>
                                                @else
                                                    <span class="product-price">{!! $various->price_various_with_devise !!}</span>
                                                @endif

                                            </div><!-- End .price-box -->

                                            <form method="#" action="#">

                                                <div class="product-action">

                                                    <a href="{{ route('destroy.various', ['lang' => app()->getLocale(), 'various_id' => $various->id, 'slug' => $various->slug]) }}" onclick="return confirm(`{{ __('Do you want to delete the product') }} ?`)" class="mx-4 destroy-various" title="{{ __('Delete store') }}"><i class="far fa-trash-alt text-danger" style="font-size: 1.9rem"></i></a>

                                                   @if($various->price)

                                                        <span id="btn-cancel-discount{{ $various->id }}">
                                                           @if($various->discount_price)
                                                                <span class="btn-icon btn-add-cart cancel-discount"  title="{{ __('Cancel discount') }}" data-action="{{ route('cancel.discount.various', ['lang' => app()->getLocale(), 'various_id' => $various->id, 'slug' => $various->slug]) }}"><i class="fas fa-percent"></i>{{strtoupper(__('Cancel discount'))}}</span>
                                                           @else
                                                                <a href="{{ route('discount.various', ['lang' => app()->getLocale(), 'various_id' => $various->id, 'slug' => $various->slug, 'price' => $various->price, 'devise' => $various->devise]) }}" id="discount{{ $various->id }}" class="btn-quickview d-none"  title="{{ __('Add discount') }}"><i class="fas fa-car"></i></a>
                                                                <span class="btn-icon btn-add-cart" title="{{ __('Add discount') }}" onclick="event.preventDefault(); document.getElementById(`discount{{ $various->id }}`).click()"><i class="fas fa-percent"></i>{{strtoupper(__('Add discount'))}}</span>
                                                           @endif
                                                        </span>

                                                   @endif

                                                    <a href="#" class="mx-4" title="{{ __('EDIT ANNOUNCE OR PUBLICITY') }}" onclick="event.preventDefault(); document.getElementById(`edit{{ $various->id }}`).click();"><i class="far fa-edit text-info" style="font-size: 1.9rem"></i></a>
                                                    <a href="{{ route('edit.various', ['lang' => app()->getLocale(), 'various_id' => $various->id, 'slug' => $various->slug]) }}" class="btn-quickview d-none" id="edit{{ $various->id }}" title="{{ __('EDIT ANNOUNCE OR PUBLICITY') }}"><i class="fas fa-percent"></i>{{strtoupper(__('EDIT ANNOUNCE OR PUBLICITY'))}}</a>

                                                </div>

                                                <div class="product-action">
                                                    <a href="{{ route_name('gallery.various', ['slug' => $various->slug]) }}" class="d-none" id="gallery{{$various->id}}"></a>
                                                    <span class="btn-icon btn-add-cart mt-3" onclick="event.preventDefault(); document.getElementById(`gallery{{ $various->id }}`).click();" title="{{ __('Add more photos') }}"><i class="fas fa-camera"></i>{{strtoupper(__('More photos'))}}</span>
                                                </div>

                                            </form>

                                        </div><!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <nav class="toolbox toolbox-pagination">
                            <ul class="pagination">
                                {{($variouses->links())}}
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
