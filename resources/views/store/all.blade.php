@extends('layouts.default', ['title' => __('My stores')])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">

                        <h2>{{ __('My stores') }}</h2>


                        <div class="row row-sm">

                            @foreach($stores as $store)
                                <div class="col-6 col-md-4">
                                    <div class="product-default">

                                        <figure>
                                            <a href="{{ route_name('stores.single.by_user', ['slug' => $store->slug]) }}">
                                                <img src="{{ asset($store->image) }}">
                                            </a>
                                        </figure>
                                        <div class="product-details">

                                            <h2 class="product-title">
                                                <a href="{{ route_name('stores.single.by_user', ['slug' => $store->slug]) }}">{{ $store->name }}</a>
                                            </h2>

                                            <form method="#" action="#">

                                                <div class="product-action">
                                                    <a href="{{ route_name('destroy.store', ['slug' => $store->slug]) }}" onclick="return confirm(`{{ __('Do you want to delete the store') }} ?`)" class="mx-4 destroy-store" title="{{ __('Delete store') }}"><i class="far fa-trash-alt text-danger" style="font-size: 1.9rem"></i></a>

                                                    <a href="{{ route_name('create.store.product', ['slug' => $store->slug]) }}" id="create-s-p{{ $store->id }}" class="btn-quickview d-none"  title="{{ __('Add product') }}"><i class="fas fa-car"></i></a>
                                                    <span class="btn-icon btn-add-cart" onclick="event.preventDefault(); document.getElementById(`create-s-p{{ $store->id }}`).click()"><i class="fas fa-plus"></i>{{strtoupper(__('Add product'))}}</span>

                                                    <a href="#" class="mx-4" title="{{ __('Edit store') }}" onclick="event.preventDefault(); document.getElementById(`edit{{ $store->id }}`).click();"><i class="far fa-edit text-info" style="font-size: 1.9rem"></i></a>
                                                    <a href="{{ route_name('edit.store', ['slug' => $store->slug]) }}" class="btn-quickview d-none" id="edit{{ $store->id }}" title="{{ __('Edit store') }}"><i class="fas fa-percent"></i>{{strtoupper(__('Edit store'))}}</a>

                                                </div>
                                            </form>

                                        </div><!-- End .product-details -->
                                    </div>
                                </div>
                            @endforeach

                        </div>
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
