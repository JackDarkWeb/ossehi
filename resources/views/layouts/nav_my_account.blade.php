<aside class="sidebar col-lg-3">
    <div class="widget widget-dashboard">
        <h3 class="widget-title">{{ucfirst(__('My account'))}}</h3>

        <ul class="list">

            <li class="{{ menu_active('dashboard')->class }}"><a href="{{ route_name('dashboard') }}">{{ __('Account Dashboard') }}</a></li>

            <li class="{{ menu_active('account')->class }}"><a href="{{ route_name('account') }}">{{ __('Account Information') }}</a></li>

            @if(key_exists('store_counter', counts()) && counts()['store_counter'])

                <li class="{{ menu_active('stores')->class }}">

                    <a data-toggle="dropdown" style="cursor: pointer"> {{ plurals(counts()['store_counter'], 'Store') }} </a>

                    <ul class="dropdown-menu">

                        <a href="{{ route_name('stores.by_user') }}" title="{{ __('All stores') }}">{{ ucwords( __('All stores') ) }}</a>

                        <a href="{{ route_name('create.store') }}" class="btn-quickview"  title="{{ __('Create store') }}">{{ ucwords( __('Create store') ) }} </a>

                    </ul>
                </li>

            @else
                <li>
                    <a href="{{ route_name('create.store') }}" class="btn-quickview"  title="{{ __('Create store') }}">{{ ucwords( __('Create store') ) }} </a>
                </li>
            @endif


            @if(key_exists('product_counter', counts()) && counts()['product_counter'])

                <li class="{{ menu_active('products.by_user')->class }}">

                    <a data-toggle="dropdown" style="cursor: pointer"> {{ plurals(counts()['product_counter'], 'Product') }} </a>

                    <ul class="dropdown-menu">
                        <a href="{{ route_name('products.by_user') }}" title="{{ __('All products') }}">{{ ucwords( __('All products') ) }}</a>
                        <a href="{{ route_name('create.product') }}" class="btn-quickview"  title="{{ __('Create product') }}">{{ ucwords( __('Create product') ) }} </a>
                    </ul>
                </li>

            @else
                <li>
                    <a href="{{ route_name('create.product') }}" class="btn-quickview"  title="{{ __('Create product') }}">{{ ucwords( __('Create product') ) }} </a>
                </li>
            @endif


            @if(key_exists('various_counter', counts()) && counts()['various_counter'])

                <li class="{{ menu_active('variouses.by_user')->class }}">

                    <a data-toggle="dropdown" style="cursor: pointer"> {{ plurals(counts()['various_counter'], 'Various') }} </a>

                    <ul class="dropdown-menu">
                        <a href="{{ route_name('variouses.by_user') }}" title="{{ __('All variouses') }}">{{ ucwords( __('All variouses') ) }}</a>
                        <a href="{{ route_name('create.various') }}" class="btn-quickview"  title="{{ __('Create various') }}">{{ ucwords( __('Create various') ) }} </a>
                    </ul>
                </li>

            @else
                <li>
                    <a href="{{ route_name('create.various') }}" class="btn-quickview"  title="{{ __('Create various') }}">{{ ucwords( __('Create various') ) }} </a>
                </li>
            @endif




            <li><a href="#">Billing Agreements</a></li>
            <li><a href="#">Recurring Profiles</a></li>
            <li><a href="#">My Product Reviews</a></li>
            <li><a href="#">My Tags</a></li>
            <li><a href="#">My Wishlist</a></li>
            <li><a href="#">My Applications</a></li>
            <li><a href="#">Newsletter Subscriptions</a></li>
            <li><a href="#">My Downloadable Products</a></li>
        </ul>
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->


