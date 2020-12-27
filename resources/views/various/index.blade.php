@extends('layouts.default', ['title' => 'e-Ossehi'])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <div class="info-boxes-container">
                <div class="container">
                    <div class="info-box">
                        <i class="icon-shipping"></i>

                        <div class="info-box-content">
                            <h4>{{strtoupper(__('Free Shipping & Return'))}}</h4>
                            <p>{{__('Free shipping on all orders over :amount', ['amount' => '$99'])}} .</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-us-dollar"></i>

                        <div class="info-box-content">
                            <h4>{{__('MONEY BACK GUARANTEE')}}</h4>
                            <p>{{__(':percent money back guarantee', ['percent' => '100%'])}}</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->

                    <div class="info-box">
                        <i class="icon-support"></i>

                        <div class="info-box-content">
                            <h4>{{strtoupper(__('Online Support :hours', ['hours' => '24/7']))}}</h4>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div><!-- End .info-box-content -->
                    </div><!-- End .info-box -->
                </div><!-- End .container -->
            </div><!-- End .info-boxes-container -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <nav class="toolbox">
                            <div class="toolbox-left">
                                <div class="toolbox-item toolbox-sort">
                                    <div class="select-custom">
                                        <select name="orderby" class="form-control">
                                            <option value="menu_order" selected="selected">{{ __('Default sorting') }}</option>
                                            <option value="announce">{{ __('Announce') }}</option>
                                            <option value="publicity">{{ __('Publicity') }}</option>
                                            <option value="recruitment">{{ __('Recruitment') }}</option>

                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
                                </div><!-- End .toolbox-item -->
                            </div><!-- End .toolbox-left -->

                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('Showing') }} 1–{{ $variouses->count() }} of {{ $variouses->total().' '.Str::plural(__('result'), $variouses->total()) }}</label>
                            </div><!-- End .toolbox-item -->


                        </nav>

                        <div class="product-intro row row-sm">
                            @foreach($variouses as $various)
                                <div class="col-6 col-sm-12 product-default left-details product-list mb-4">
                                    <figure>
                                        <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{ $various->short_title }}
                                            <img src="{{ asset($various->image) }}">
                                        </a>

                                        <div class="label-group-galleries">
                                            <div class="product-label label-sale-galleries">
                                                <span style="font-size: 1.2rem">{{ $various->galleries->count() }}</span> <i class="fas fa-camera" style="font-size: 1.5rem"></i>
                                            </div>
                                        </div>

                                    </figure>
                                    <div class="product-details">
                                        <div class="category-list">
                                            <a href="{{ route_name('diversities.type', ['name' => $various->type]) }}" class="product-category">{{ __($various->type) }}</a>
                                        </div>
                                        <h2 class="product-title">
                                            <a href="{{ route_name('diversities.single', ['slug' => $various->slug]) }}">{{$various->title}}</a>
                                        </h2>

                                        <div class="ratings-container">
                                            <a  class="rating-link">( {{ plurals($various->comments->count(), 'Avis') }} )</a>

                                        </div><!-- End .product-container -->

                                        <div class="ratings-container">
                                            <span><i class="icon-calendar"></i>{{ $various->short_date_various }}</span>
                                        </div><!-- End .product-container -->

                                        <p class="product-description">{{ $various->short_description_various }}</p>
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

                        </div>

                        <nav class="toolbox toolbox-pagination">
                            <div class="toolbox-item toolbox-show">
                                <label>{{ __('Showing') }} 1–{{$variouses->count()}} of {{$variouses->total().' '.Str::plural(__('result'), $variouses->total())}}</label>
                            </div><!-- End .toolbox-item -->

                            <ul class="pagination">
                                {{ $variouses->links() }}
                            </ul>
                        </nav>
                    </div><!-- End .col-lg-9 -->

                    @include('layouts.sidebar_home')

                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-4"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.pop-subscribe')

    @include('layouts.more')


@endsection

@section('scripts')
    <script type="module">
        import Validator from "{{ asset('js/Validator.js') }}";

        $(function () {

        })
    </script>
@endsection
