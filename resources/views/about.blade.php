@extends('layouts.default', ['title' => __('about us')])

@section('content')


<div class="page-wrapper">

    @include('layouts.nav')

    <main class="main">
        <div class="page-header page-header-bg" style="background-image: url('{{asset('app/images/page-header-bg.jpg')}}');">
            <div class="container">
                <h1><span>{{strtoupper(__('About Us'))}}</span>
                    {{strtoupper(__('Our Company'))}}</h1>
                <a href="{{route_name('contact')}}" class="btn btn-dark">{{ __('Contact') }}</a>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route_name('home')}}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('About Us') }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h2 class="subtitle">{{__('OUR STORY')}}</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                <p class="lead">“ Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model search for evolved over sometimes by accident, sometimes on purpose ”</p>
            </div><!-- End .container -->
        </div><!-- End .about-section -->

        <div class="features-section">
            <div class="container">
                <h2 class="subtitle">{{__('WHY CHOOSE US')}}</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-shipped"></i>

                            <div class="feature-box-content">
                                <h4>{{__('Free Shipping & Return')}}</h4>
                                <p>Livraison gratuite sur toutes les commandes $99.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-us-dollar"></i>

                            <div class="feature-box-content">
                                <h4>{{__(':percent money back guarantee', ['percent' => '100%'])}}</h4>
                                <p>There are many variations of passages of Lorem Ipsum available.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box">
                            <i class="icon-online-support"></i>

                            <div class="feature-box-content">
                                <h4>{{__('Online Support :hours', ['hours' => '24/7'])}}</h4>
                                <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .features-section -->

        <div class="testimonials-section">
            <div class="container">
                <h2 class="subtitle text-center">{{__('HAPPY CLIENTS')}}</h2>

                <div class="testimonials-carousel owl-carousel owl-theme">
                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="{{ asset('images/admins/admin-1.jpg') }}" alt="admin">
                            </figure>

                            <div>
                                <h4 class="testimonial-title">john Smith</h4>
                                <span>Proto Co Ceo</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum dolor sit amet, consectetur elitad adipiscing.</p>
                        </blockquote>
                    </div><!-- End .testimonial -->

                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="{{ asset('images/admins/admin-2.jpg') }}" alt="admin">
                            </figure>

                            <div>
                                <h4 class="testimonial-title">Bob Smith</h4>
                                <span>Proto Co Ceo</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum dolor sit amet, consectetur elitad adipiscing.</p>
                        </blockquote>
                    </div><!-- End .testimonial -->

                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="{{ asset('images/admins/admin-1.jpg') }}" alt="admin">
                            </figure>

                            <div>
                                <h4 class="testimonial-title">john Smith</h4>
                                <span>Proto Co Ceo</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mipsum dolor sit amet, consectetur elitad adipiscing.</p>
                        </blockquote>
                    </div><!-- End .testimonial -->
                </div><!-- End .testimonials-slider -->
            </div><!-- End .container -->
        </div><!-- End .testimonials-section -->

        <div class="counters-section">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-md-4 count-container">
                        <div class="count-wrapper">
                            <span class="count" data-from="0" data-to="200" data-speed="2000" data-refresh-interval="50">200</span>+
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{__('MILLION CUSTOMERS')}}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4 count-container">
                        <div class="count-wrapper">
                            <span class="count" data-from="0" data-to="1800" data-speed="2000" data-refresh-interval="50">1800</span>+
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{__('TEAM MEMBERS')}}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4 count-container">
                        <div class="count-wrapper">
                            <span class="count" data-from="0" data-to="24" data-speed="2000" data-refresh-interval="50">24</span><span>HR</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{__('SUPPORT AVAILABLE')}}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4 count-container">
                        <div class="count-wrapper">
                            <span class="count" data-from="0" data-to="265" data-speed="2000" data-refresh-interval="50">265</span>+
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{__('SUPPORT AVAILABLE')}}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col-6 col-md-4 count-container">
                        <div class="count-wrapper">
                            <span class="count" data-from="0" data-to="99" data-speed="2000" data-refresh-interval="50">99</span><span>%</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{__('SUPPORT AVAILABLE')}}</h4>
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .counters-section -->
    </main><!-- End .main -->

    @include('layouts.footer')

</div><!-- End .page-wrapper -->

@include('layouts.more')


@stop
