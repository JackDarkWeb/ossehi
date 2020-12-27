@extends('layouts.default', ['title' => 'forgot password'])


@section('content')


    <div class="page-wrapper">


        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home.index', ['language' => app()->getLocale()])}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Forgot Password')}}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="alert-success" style="position: absolute"></div>

            <div class="container">
                <div class="heading mb-4">
                    <h2 class="title">{{__('Reset Password')}}</h2>
                    <p>{{__('Please enter your email address below to receive a password reset link')}}.</p>
                </div><!-- End .heading -->



                <form action="{{route('recovery.email.store', ['language' => app()->getLocale()])}}" method="post" id="recovery-email-form">

                    <div class="form-group required-field">
                        <label for="reset-email">Email</label>
                        <span class="invalid-feedback error-recovery-email"></span>
                        <input type="email" name="recovery_email" class="form-control" id="recovery-email" />
                    </div><!-- End .form-group -->

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">{{__('Reset My Password')}}</button>
                    </div><!-- End .form-footer -->
                </form>
            </div><!-- End .container -->

            <div class="mb-10"></div><!-- margin -->
        </main><!-- End .main -->
        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')


@stop
