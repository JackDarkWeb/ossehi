<footer class="footer">
    <div class="footer-middle">
        <div class="container">
            <div class="footer-ribbon">
                {{__('Get in touch')}}
            </div><!-- End .footer-ribbon -->
            <div class="row">
                <div class="col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title">{{__('Contact Us')}}</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">{{ __('Address') }}:</span>2 Street Lazaryana, Dnepr, Ukraine
                            </li>
                            <li>
                                <span class="contact-info-label">{{ __('Phone') }}:</span>{{ __('Toll Free') }} <a href="tel:">(+380) 664 112 141</a>
                            </li>
                            <li>
                                <span class="contact-info-label">{{ __('Email') }}:</span> <a href="mailto:mail@example.com">ossehi@service.com</a>
                            </li>
                            <li>
                                <span class="contact-info-label">{{__('Working Days/Hours')}}:</span>
                                Mon - Sun / 9:00AM - 8:00PM
                            </li>
                        </ul>
                        <div class="social-icons">
                            <a href="#" class="social-icon" target="_blank"><i class="icon-facebook"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" target="_blank"><i class="icon-linkedin"></i></a>
                        </div><!-- End .social-icons -->
                    </div><!-- End .widget -->
                </div><!-- End .col-lg-3 -->

                <div class="col-lg-9">
                    <div class="widget widget-newsletter">
                        <h4 class="widget-title">{{__('Subscribe newsletter')}}</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>{{__('Get all the latest information on Events,Sales and Offers. Sign up for newsletter today')}}</p>
                            </div><!-- End .col-md-6 -->

                            <div class="col-md-6">

                                <form action="" method="post" id="form-subscribe-footer">

                                    @csrf
                                    <span class="error-email" style="position:absolute; color: red; font-size: small; font-style: italic"></span>
                                    <input type="email" name="email" id="email-subscribe" class="form-control" placeholder="{{ __('Email address') }}">

                                    <input type="submit" class="btn" value="{{__('Subscribe')}}">
                                </form>

                            </div><!-- End .col-md-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .widget -->

                    <div class="row">
                        <div class="col-md-5">
                            <div class="widget">
                                <h4 class="widget-title">{{__('My account')}}</h4>

                                <div class="row">
                                    <div class="col-sm-6 col-md-5">
                                        <ul class="links">

                                            <li><a href="{{ route_name('about') }}">{{__('About Us')}}</a></li>
                                            <li><a href="{{ route_name('contact') }}">{{__('Contact Us')}}</a></li>

                                            <li>
                                                @if(Auth::is())
                                                    <a href="{{ route_name('account') }}">{{strtoupper(__('My account'))}}</a>
                                                @else
                                                    <a href="#" class="login-link">{{strtoupper(__('My account'))}}</a>
                                                @endif
                                            </li>

                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6 col-md-5">
                                        <ul class="links">
                                            <li><a href="#">{{__('Orders History')}}</a></li>
                                            <li><a href="#">{{__('Advanced Search')}}</a></li>
                                            <li><a href="#" class="login-link">{{__('Login')}}</a></li>
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-5 -->

                        <div class="col-md-7">
                            <div class="widget">
                                <h4 class="widget-title">{{__('Main features')}}</h4>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <ul class="links">
                                            <li><a href="#">Super Fast Service</a></li>
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                    <div class="col-sm-6">
                                        <ul class="links">
                                            <li><a href="#">Ossèhi eCommerce</a></li>
                                        </ul>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .widget -->
                        </div><!-- End .col-md-7 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-9 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <p class="footer-copyright">Ossèhi eCommerce. &copy;  {{date('Y')}}.  {{__('All Rights Reserved')}}</p>

            <img src="{{ asset('images/payments.png') }}" alt="payment methods" class="footer-payments">
        </div><!-- End .footer-bottom -->
    </div><!-- End .container -->
</footer><!-- End .footer -->



