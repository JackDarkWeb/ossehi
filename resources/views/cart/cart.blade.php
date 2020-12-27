@extends('layouts.default', ['title' => __('Shopping cart')])

@section('content')


    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Shopping cart')}}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart-table-container">
                            <table class="table table-cart">
                                <thead>
                                <tr>
                                    <th class="product-col">{{__('Product')}}</th>
                                    <th class="price-col">{{__('Price')}}</th>
                                    <th class="qty-col">{{__('Qty')}}</th>
                                    <th>{{__('Subtotal')}}</th>
                                </tr>
                                </thead>

                                <tbody id="body-detail-cart">

                                   @foreach(carts() as $item)

                                       <tr class="product-row">
                                           <td class="product-col">
                                               <figure class="product-image-container">
                                                   <a href="" class="product-image">
                                                       <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                                   </a>
                                               </figure>
                                               <h2 class="product-title">
                                                   <a href="">{{ $item->title }}</a>
                                               </h2>
                                           </td>
                                           <td>{!! $item->price_with_devise !!}</td>
                                           <td>
                                               <input class="vertical-quantity form-control" type="text" value='{{ $item->qty }}'>
                                           </td>
                                           <td>{!! $item->total !!}</td>
                                       </tr>
                                       <tr class="product-action-row">
                                           <td colspan="4" class="clearfix">
                                               <div class="float-left">
                                                   <a href="#" class="btn-move" title="{{ __('Add to wishlist') }}">{{ __('Wishlist') }}</a>
                                               </div><!-- End .float-left -->

                                               <div class="float-right">
                                                   <a href="" title="{{ __('Edit product') }}" class="btn-edit"><span class="sr-only">{{ __('Edit') }}</span><i class="icon-pencil"></i></a>
                                                   <a href="#" title="{{ __('Remove product') }}" data-content=""  class="btn-remove"><span class="sr-only">{{ __('Remove') }}</span></a>
                                               </div><!-- End .float-right -->
                                           </td>
                                       </tr>

                                   @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <td colspan="4" class="clearfix">

                                        <div class="float-left">
                                            <a href="{{ route_name('home') }}" class="btn btn-outline-secondary">{{__('Continue Shopping')}}</a>
                                        </div><!-- End .float-left -->

                                        @if(counter_of_cart())

                                            <div class="float-right">
                                                <form method="post" action="{{ route_name('cart.clean') }}" onclick="return confirm(`{{ __('Do you want to empty the cart') }}`)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-outline-secondary btn-clear-cart">{{__('Clear Shopping Cart')}}</button>
                                                </form>
                                            </div>
                                            <div class="float-right">
                                                <a href="#" class="btn btn-outline-secondary btn-update-cart">{{__('Update Shopping Cart')}}</a>
                                            </div><!-- End .float-right -->

                                        @endif
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div><!-- End .cart-table-container -->

                        <div class="cart-discount">
                            <h4>{{__('Apply Discount Code')}}</h4>
                            <form action="#">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm" placeholder="{{__('Enter discount code')}}"  required>
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary" type="submit">{{__('Apply Discount')}}</button>
                                    </div>
                                </div><!-- End .input-group -->
                            </form>
                        </div><!-- End .cart-discount -->
                    </div><!-- End .col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="cart-summary">
                            <h3>{{__('Summary')}}</h3>

                            <h4>
                                <a data-toggle="collapse" href="#total-estimate-section" class="collapsed" role="button" aria-expanded="false" aria-controls="total-estimate-section">{{__('Estimate Shipping and Tax')}}</a>
                            </h4>

                            <div class="collapse" id="total-estimate-section">

                                <form action="" method="post" id="form-estimate-shipping">

                                    <div class="form-group form-group-sm">
                                        <label>{{__('Country')}}</label>
                                        <div class="select-custom">
                                            <select name="country_estimate_shipping" id="country-shipping" class="form-control form-control-sm">
                                                @foreach(countries() as $country)
                                                    <option value="{{$country}}" >{{$country}}</option>
                                                @endforeach
                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group form-group-sm">
                                        <label>{{__('State/Province')}}</label>
                                        <div class="select-custom">
                                            <select name="state_estimate_shipping" id="state-shipping" class="form-control form-control-sm">

                                            </select>
                                        </div><!-- End .select-custom -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group form-group-sm">
                                        <label>{{__('Zip/Postal Code')}}</label>
                                        <input type="text" name="postal_estimate_shipping" id="postal-estimate-shipping" class="form-control form-control-sm" value="{{ Helper::userLocation()->postal_code }}">
                                    </div><!-- End .form-group -->

                                    <div class="form-group form-group-custom-control">
                                        <label>{{__('Flat Way')}}</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="flat-rate">
                                            <label class="custom-control-label" for="flat-rate">{{__('Fixed :fixed', ['fixed' => '$5.00'])}}</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-group -->

                                    <div class="form-group form-group-custom-control">
                                        <label>{{__('Best Rate')}}</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="best-rate">
                                            <label class="custom-control-label" for="best-rate">{{__('Table Rate :table', ['table' => '$15.00'])}} $15.00</label>
                                        </div><!-- End .custom-checkbox -->
                                    </div><!-- End .form-group -->
                                </form>

                            </div><!-- End #total-estimate-section -->

                            <table class="table table-totals">
                                <tbody>
                                <tr>
                                    <td>{{__('Subtotal')}}</td>
                                    <td>{!! totals_of_cart() !!}</td>
                                </tr>

                                <tr>
                                    <td>{{__('Tax')}}</td>
                                    <td>{!! 0.00 !!}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>{{__('Order Total')}}</td>
                                    <td>{!! totals_of_cart_with_tax(0.00) !!}</td>
                                </tr>
                                </tfoot>
                            </table>

                            <div class="checkout-methods">
                                <a href="" class="btn btn-block btn-sm btn-primary">{{__('Go to Checkout')}}</a>
                                <a href="#" class="btn btn-link btn-block d-none">{{__('Check Out with Multiple Addresses')}}</a>
                            </div><!-- End .checkout-methods -->
                        </div><!-- End .cart-summary -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-6"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')



@stop
