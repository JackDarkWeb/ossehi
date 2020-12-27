<header class="header">


    <div class="header-top">
        <div class="container">
            <div class="header-left header-dropdowns">
                <div class="header-dropdown">
                    <a  id="devise-default">{{ Cookie::get('devise') }}</a>
                    <div class="header-menu">
                        <ul id="devises">
                            <li><a href="EUR" id="devise-eur">EUR</a></li>
                            <li><a href="USD" id="devise-usd">USD</a></li>
                            <li><a href="XOF" id="devise-xof">XOF</a></li>
                            <li><a href="NGN" id="devise-ngn">NGN</a></li>
                            <li><a href="UAH" id="devise-ua">UAH</a></li>
                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->


                    <div class="header-dropdown">

                        <a><img src="{{ (app()->getLocale() === 'fr') ? asset('images/flags/fr.png') : asset('images/flags/en.png') }}" alt="England flag">{{ (app()->getLocale() === 'fr' ? strtoupper(__('French')) : strtoupper(__('English'))) }}</a>
                        <div class="header-menu">
                            <ul>
                                <li><a href="{{ change_language('fr') }}"><img src="{{ asset('images/flags/fr.png') }}" alt="France flag">{{ strtoupper(__('French')) }}</a></li>
                                <li><a href="{{ change_language('en') }}"><img src="{{ asset('images/flags/en.png') }}" alt="England flag">{{ strtoupper(__('English')) }}</a></li>
                            </ul>
                        </div><!-- End .header-menu -->


                    </div><!-- End .header-dropown -->




                <div class="dropdown compare-dropdown">
                    <a href="{{ route_name('stores') }}" class="dropdown-toggle" role="button" data-toggle="dropdow" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-bag"></i> {{ __('Stores :nbr', ['nbr' => count_store()]) }}
                    </a>

                    <div class="dropdown-menu" >

                        <div class="dropdownmenu-wrapper">

                            <ul class="stores">

                                @foreach(menu_store() as $store)
                                    <li>
                                        <h3><a href="{{ route_name('store.products', ['slug' => $store->slug]) }}">{{ $store->name }}</a></h3>
                                    </li>
                                @endforeach

                            </ul>

                        </div><!-- End .dropdownmenu-wrapper -->
                    </div><!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->
            </div><!-- End .header-left -->

            <div class="header-right">
                <p class="welcome-msg">{{__('Welcome :user', ['user' => Auth::user()->first_name ?? __('Sir')])}}</p>

                <div class="header-dropdown dropdown-expanded">
                    <a href="#">{{__('Links')}}</a>
                    <div class="header-menu">
                        <ul>

                                <li>
                                    @if(Auth::is())
                                        <a href="{{ route_name('dashboard') }}">{{strtoupper(__('My account'))}}</a>
                                    @else
                                        <a href="#" class="login-link">{{strtoupper(__('My account'))}}</a>
                                    @endif
                                </li>

                                <li>
                                    @if(Auth::is())
                                        <a href="#" data-toggle="modal" title="{{ __('Create store / publish') }}" data-target="#publishMenus">{{strtoupper(__('Create store / publish'))}}</a>
                                    @else
                                        <a href="#" class="login-link">{{strtoupper(__('Create store / publish'))}}</a>
                                    @endif
                                </li>

                                <li class="d-none"><a href=""><span class="mr-2" id="count-favorite">{{2 ?? ''}}</span>{{__('MY WISHLIST')}} </a></li>
                                <li><a href="{{ route_name('posts') }}">{{__('BLOG')}}</a></li>
                                <li><a href="{{ route_name('contact') }}">{{__('Contact')}}</a></li>

                                <li>
                                    @if(Auth::is())
                                        <a href="{{ route_name('logout') }}" class="">{{ strtoupper(__('Log out')) }}</a>
                                    @else
                                        <a href="#" class="login-link">{{ strtoupper(__('Log in')) }}</a>
                                    @endif
                                </li>

                        </ul>
                    </div><!-- End .header-menu -->
                </div><!-- End .header-dropown -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <a href="{{route_name('home')}}" class="logo">
                    <img src="{{ asset('images/logo-o.png') }}" width="150px" height="50px" alt="Ossèhi Logo">
                </a>
            </div><!-- End .header-left -->

            <div class="header-center">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button"><i class="icon-magnifier"></i></a>

                    <form action="" method="get" id="form-search">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control @error('g') bg-danger @enderror" name="g" id="g" value="{{ request()->g ?? ''}}" placeholder="{{__('Search')}}...">
                            <div class="select-custom">

                                <select id="cat" name="cat">

                                    <option value="all">{{__('All Categories')}}</option>

                                    @foreach(menu_category_products() as $category)

                                        <option value="{{ __( $category->category_name ) }}">{{ __( $category->category_name ) }}</option>

                                        @foreach($category->sub_categories as $sub)
                                            <option value="{{ strtolower( $sub->sub_category_name ) }}">- {{ __(ucfirst($sub->sub_category_name)) }}</option>
                                        @endforeach

                                    @endforeach

                                </select>
                            </div><!-- End .select-custom -->
                            <button class="btn" type="submit"><i class="icon-magnifier"></i></button>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->
            </div><!-- End .headeer-center -->

            <div class="header-right">
                <button class="mobile-menu-toggler" type="button">
                    <i class="icon-menu"></i>
                </button>
                <div class="header-contact">
                    <img src="{{ asset('images/header_phone.png') }}" style="float: left;">
                    <div class="ml-2" style="float: right;">
                    <span>{{__('Call us now')}}</span>
                    <a href="tel:#"><strong>+380 664 112 141</strong></a>
                    </div>
                </div><!-- End .header-contact -->

                @if(Auth::is())
                    <a href="{{ route_name('dashboard') }}" class="header-icon"><i class="fas fa-user mx-2" style="font-size: 1.5em;vertical-align: middle; color: white"></i></a>
                @else
                    <a href="#" class="header-icon login-link"><i class="fas fa-user mx-2" style="font-size: 1.5em;vertical-align: middle; color: white"></i></a>
                @endif


                <a href="{{ route_name('favorite.product') }}" class="header-icon"><sapn id="favorite-count">{{ favorites_products_count() }}</sapn><i class="fas fa-heart mx-2" style="font-size: 1.5em;vertical-align: middle; color: white"></i></a>

                <div class="dropdown cart-dropdown" id="cart-dropdown">

                    <a href="#" class="dropdown-toggle mx-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <span class="cart-count counter-of-cart" id="cart-count">{{ counter_of_cart() }}</span>
                    </a>

                    <div class="dropdown-menu" >

                        <div class="dropdownmenu-wrapper">

                            <div id="dropdown-cart-products" class="dropdown-cart-products">

                                @foreach(carts() as $item)

                                    <div class="product product_{{ $item->rawId }}" id="product_{{ $item->rawId }}">

                                        <div class="product-details">

                                            <h4 class="product-title">
                                                <a href="{{ route_name('store.products.single', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                            <span class="cart-product-qty">{{ $item->qty }}</span>
                                                    x {!! $item->price_with_devise !!}
                                        </span>
                                            <span class="d-none" id="cart-product-price">{{ $item->price }}</span>

                                        </div><!-- End .product-details -->

                                        <figure class="product-image-container">
                                            <a href="{{ route_name('store.products.single', ['slug' => $item->slug]) }}" class="product-image">
                                                <img src="{{ asset($item->image) }}" alt="{{ $item->title }}">
                                            </a>
                                            <a href="#" class="btn-remove" id="btn-remove" data-row="{{ $item->rawId }}"  title="Remove Product"><i class="icon-cancel"></i></a>
                                        </figure>

                                        <form>
                                            <input type="hidden" id="product-cart-id" name="item_{{ $item->rawId }}" value="{{ $item->rawId }}"/>
                                        </form>
                                    </div>
                                @endforeach

                            </div><!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>{{ __('Total') }}</span>

                                <span class="cart-total-price">{!! totals_of_cart() !!}</span>
                            </div><!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">

                                @if(Auth::is())
                                    <a href="{{ route_name('cart') }}" class="btn">{{ __('View Cart') }}</a>
                                @else
                                    <a href="#" class="btn login-link">{{ __('View Cart') }}</a>
                                @endif

                                @if(Auth::is())
                                    <a href="" class="btn">{{ __('Checkout') }}</a>
                                @else
                                    <a href="#" class="btn login-link">{{ __('Checkout') }}</a>
                                @endif


                            </div><!-- End .dropdown-cart-total -->

                        </div><!-- End .dropdownmenu-wrapper -->


                    </div><!-- End .dropdown-menu -->
                </div><!-- End .dropdown -->

            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->


    @if(Auth::is())

        <div class="header-bottom sticky-header">
            <div class="container">
                <nav class="main-nav">
                    <ul class="menu sf-arrows">

                        <li><a href="{{ route_name('home') }}">{{ __('Home') }}</a></li>

                            <li>
                                <a href="" class="sf-with-ul">{{ __('Categories') }}</a>
                                <div class="megamenu megamenu-fixed-width">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="row">

                                                @foreach(menu_category_products() as $category)

                                                    <div class="col-lg-6">
                                                        <div class="menu-title">
                                                            <a href="">{{ __( $category->category_name ) }}</a>
                                                        </div>
                                                        <ul>
                                                            @foreach($category->sub_categories as $sub)
                                                                <a href="{{ route('products.sub_category', ['lang' => app()->getLocale(), 'category_name' => $category->name, 'sub_category_name' => $sub->name]) }}"> {{ __( $sub->sub_category_name ) }}</a>
                                                            @endforeach
                                                        </ul>
                                                    </div><!-- End .col-lg-6 -->

                                                @endforeach
                                            </div><!-- End .row -->
                                        </div><!-- End .col-lg-8 -->
                                        <div class="col-lg-4">
                                            <div class="banner">
                                                <a href="#">
                                                    <img src="{{ asset('images/menu-banner-2.jpg') }}" alt="Menu banner">
                                                </a>
                                            </div><!-- End .banner -->
                                        </div><!-- End .col-lg-4 -->
                                    </div>
                                </div><!-- End .megamenu -->
                            </li>


                        <li><a href="{{ route_name('diversities') }}"><i class=""></i>{{__('Announce')}} !</a></li>
                    </ul>
                </nav>
            </div><!-- End .header-bottom -->
        </div><!-- End .header-bottom -->
    @endif


</header><!-- End .header -->
