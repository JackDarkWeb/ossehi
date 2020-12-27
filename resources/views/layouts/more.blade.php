<div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-cancel"></i></span>
        <nav class="mobile-nav">
            <ul class="mobile-menu">

                <li class="active"><a href="{{ route_name('home') }}">{{ __('Home') }}</a></li>

                <li>
                    <a href="#">{{ __('Stores :nbr', ['nbr' => 5]) }}</a>

                    <div class="col-lg-6">
                        <ul>
                            @foreach(menu_store() as $store)
                                <li><a href="{{ route_name('store.products', ['slug' => $store->slug]) }}">{{ $store->name }}</a></li>
                            @endforeach
                        </ul>
                    </div><!-- End .col-lg-6 -->

                </li>

                @foreach(menu_category_products() as $category)

                <li>
                    <a href="#">{{ __( $category->category_name ) }}</a>

                        <div class="col-lg-6">
                            <ul>
                                @foreach($category->sub_categories as $sub)
                                    <li><a href="{{ route('products.sub_category', ['lang' => app()->getLocale(), 'category_name' => $category->name, 'sub_category_name' => $sub->name]) }}"> {{ __( $sub->sub_category_name ) }} </a></li>
                                @endforeach
                            </ul>
                        </div><!-- End .col-lg-6 -->

                </li>

                @endforeach

                <li><a href="{{ route_name('diversities') }}"><i class=""></i>{{__('Announce')}} !</a></li>

            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
            <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank"><i class="icon-instagram"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->



<!-- Add Cart Modal -->
<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="addCartModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body add-cart-box text-center">
                <p>{{__("You've just added this product to the")}}<br>{{__('cart')}}:</p>
                <h4 id="productTitle"></h4>
                <img src="" id="productImage" width="100" height="100" alt="adding cart image">
                <div class="btn-actions">

                    @if(Auth::is())
                        <a href=""><button class="btn-primary">{{__('Go to cart page')}}</button></a>
                    @else
                        <a href=""><button class="btn-primary login-link" data-dismiss="modal">{{__('Go to cart page')}}</button></a>
                    @endif

                        <a href=""><button class="btn-primary" data-dismiss="modal">{{__('Continue')}}</button></a>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Order Product Modal -->

@include('shipping.shipping-form')


@include('publish.menus')


<a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>
