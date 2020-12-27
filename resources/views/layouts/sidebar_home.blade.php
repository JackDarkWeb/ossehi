<aside class="sidebar-home col-lg-3 order-lg-first">


    <div class="side-menu-container">

        <h2>{{ __('CATEGORIES') }}</h2>

        <nav class="side-nav">
            <ul class="menu menu-vertical sf-arrows">

                @foreach(menu_category_products() as $category)

                <li>

                    <a href="" class="sf-with-ul"><i class="icon-cat-shirt"></i> {{ __( $category->category_name ) }}</a>

                    <div class="megamenu megamenu-fixed-width">

                        <div class="row">

                            <div class="col-lg-8">

                                <div class="row">

                                    <div class="col-lg-6">

                                        @foreach($category->sub_categories as $sub)
                                        <div class="menu-title">
                                            <a href="{{ route('products.sub_category', ['lang' => app()->getLocale(), 'category_name' => $category->name, 'sub_category_name' => $sub->name]) }}"> {{ __( $sub->sub_category_name ) }}</a>
                                        </div>
                                        @endforeach

                                        <ul>

                                        </ul>
                                    </div><!-- End .col-lg-6 -->

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

                @endforeach

                <li><a href="{{ route_name('diversities') }}"><i class="icon-briefcase"></i>{{__('Announce')}} !</a></li>
            </ul>
        </nav>
    </div><!-- End .side-menu-container -->
    <div class="widget widget-banners">

        <div class="widget-banners-slider owl-carousel owl-theme">

            <div class="banner banner-image">
                <div class="home-slide">
                    <div class="owl-lazy slide-bg" data-src="{{ 'image' }}"></div>
                    <div class="home-slide-content text-white">
                        <h3>Get up to <span>60%</span> off</h3>
                        <h1>{{ 'name' }}</h1>
                        <p>{{ 'Promotion des boutiques' }}</p>
                        <a href="" class="btn btn-dark">{{ __('Store') }}</a>
                    </div><!-- End .home-slide-content -->
                </div><!-- End .home-slide -->
            </div><!-- End .banner -->

            <div class="banner banner-image">
                <div class="home-slide">
                    <div class="owl-lazy slide-bg" data-src="{{ 'image' }}"></div>
                    <div class="home-slide-content text-white">
                        <h3>Get up to <span>60%</span> off</h3>
                        <h1>{{ 'name' }}</h1>
                        <p>{{ 'Promotion des boutiques' }}</p>
                        <a href="" class="btn btn-dark">{{ __('Store') }}</a>
                    </div><!-- End .home-slide-content -->
                </div><!-- End .home-slide -->
            </div><!-- End .banner -->

        </div><!-- End .banner-slider -->
    </div><!-- End .widget -->

    <div class="widget widget-newsletters">
        <h3 class="widget-title">{{__('Newsletter')}}</h3>
        <p>{{__('Get all the latest information on Events, Sales and Offers')}}. </p>

        <form action="" method="post" id="form-subscribe-home">
            @csrf
            <div class="form-group">

                <span class="error-email" style="position:absolute; color: red; font-size: small; font-style: italic"></span>
                <input type="email" class="form-control" id="email-subscribe" placeholder="">
                <label for="email-subscribe"><i class="icon-envolope"></i>{{__('Email address')}}</label>

            </div><!-- Endd .form-group -->
            <input type="submit" class="btn btn-block" value="{{__('Subscribe Now')}}">
        </form>

    </div><!-- End .widget -->

    <div class="widget widget-testimonials">
        <div class="widget-testimonials-slider owl-carousel owl-theme">
            <div class="testimonial">
                <div class="testimonial-owner">
                    <figure>
                        <img src="{{ asset('images/admins/admin-1.jpg') }}" alt="client">
                    </figure>

                    <div>
                        <h4 class="testimonial-title">Mathias HOUNYE</h4>
                        <span>CEO &amp; Founder</span>
                    </div>
                </div><!-- End .testimonial-owner -->

                <blockquote>
                    <p><a href="http://jackweb.axewebsolution.com/" target="_blank">I discovered my passion for web development,...</a></p>
                </blockquote>
            </div><!-- End .testimonial -->

            <div class="testimonial">
                <div class="testimonial-owner">
                    <figure>
                        <img src="{{ asset('images/admins/admin-2.jpg') }}" alt="client">
                    </figure>

                    <div>
                        <h4 class="testimonial-title">Uriel Ahouanto</h4>
                        <span>Co-founder</span>
                    </div>
                </div><!-- End .testimonial-owner -->

                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.</p>
                </blockquote>
            </div><!-- End .testimonial -->
        </div><!-- End .testimonials-slider -->
    </div><!-- End .widget -->

    <div class="widget">
        <div class="widget-posts-slider owl-carousel owl-theme">
            <div class="post">
                <span class="post-date">01- Jun -2018</span>
                <h4 class="post-title"><a href="#">Fashion News</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi. </p>
            </div><!-- End .post -->

            <div class="post">
                <span class="post-date">22- May -2018</span>
                <h4 class="post-title"><a href="#">Shopping News</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non plasasyi. </p>
            </div><!-- End .post -->

            <div class="post">
                <span class="post-date">13- May -2018</span>
                <h4 class="post-title"><a href="#">Fashion News</a></h4>
                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat. </p>
            </div><!-- End .post -->
        </div><!-- End .posts-slider -->
    </div><!-- End .widget -->
</aside><!-- End .col-lg-3 -->
