@extends('layouts.default', ['title' => 'Dashboard'])

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
                    <h2>{{ __('My Dashboard') }}</h2>

                    <div class="alert alert-success alert-intro" role="alert">
                        Thank you for registering .
                    </div><!-- End .alert -->

                    <div class="alert alert-success" role="alert">
                        Hello, <strong>Customer!</strong> From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
                    </div><!-- End .alert -->

                    <div class="mb-4"></div><!-- margin -->

                    <h3>Account Information</h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Contact Information
                                    <a href="{{ route_name('account') }}" class="card-edit">Edit</a>
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        {{ Auth::user()->first_name.' '.Auth::user()->last_name }}<br>
                                        {{ Auth::user()->email }}<br>
                                        <a href="{{ route_name('account') }}">Change Password</a>
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    newsletters
                                    <a href="#" class="card-edit">Edit</a>
                                </div><!-- End .card-header -->

                                <div class="card-body">
                                    <p>
                                        You are currently not subscribed to any newsletter.
                                    </p>
                                </div><!-- End .card-body -->
                            </div><!-- End .card -->
                        </div><!-- End .col-md-6 -->
                    </div><!-- End .row -->

                    <div class="card">
                        <div class="card-header">
                            Address Book
                            <a href="#" class="card-edit">Edit</a>
                        </div><!-- End .card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="">Default Billing Address</h4>
                                    <address>
                                        You have not set a default billing address.<br>
                                        <a href="#">Edit Address</a>
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="">Default Shipping Address</h4>
                                    <address>
                                        You have not set a default shipping address.<br>
                                        <a href="#">Edit Address</a>
                                    </address>
                                </div>
                            </div>
                        </div><!-- End .card-body -->
                    </div><!-- End .card -->
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
