
<div class="modal-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="title mb-2">{{__('Login')}}</h2>

                <form method="post" action="#" class="mb-1" id="login-form">
                    <label for="login-email">{{__('Email address')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-login-email"></span>
                    <input type="email" name="login_email" class="form-input form-wide mb-2 is-invalid" id="login-email" value="{{ Cookie::get('email') ?? '' }}"/>


                    <label for="login-password">{{__('Password')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-login-password"></span>
                    <input type="password" name="login_password" class="form-input form-wide mb-2" id="login-password"  value="{{ Cookie::get('password') ?? '' }}"/>


                    <div class="form-footer">
                        <button type="submit" id="submit" class="btn btn-primary btn-md">{{strtoupper(__('Login'))}}</button>

                        <div class="custom-control custom-checkbox form-footer-right">
                            <input type="checkbox" name="remember_me" value="1" class="custom-control-input" id="lost-password">
                            <label class="custom-control-label form-footer-right" for="lost-password">{{__('Remember Me')}}</label>
                        </div>
                    </div><!-- End .form-footer -->
                    <a href="" class="forget-password" id="show-recovery-email-form">{{ __('Forgot your password?') }}</a>
                </form>
            </div><!-- End .col-md-6 -->

            <div class="col-md-6">

                <h2 class="title mb-2">{{__('Register')}}</h2>

                <div class="alert-success" style="position: absolute"></div>

                <form method="post" action="#" id="register-form">

                    <label for="register-email">{{__('Email address')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-register-email"></span>
                    <input type="email" name="register_email" class="form-input form-wide mb-2" id="register-email">


                    <label for="register-password">{{__('Password')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-register-password"></span>
                    <input type="password" name="register_password" class="form-input form-wide mb-2" id="register-password">


                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-md">{{__('Register')}}</button>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="notify" class="custom-control-input" value="1" id="newsletter-signup">
                            <label class="custom-control-label" for="newsletter-signup">{{__('Sing up our Newsletter')}}</label>
                        </div><!-- End .custom-checkbox -->
                    </div><!-- End .form-footer -->
                </form>

            </div><!-- End .col-md-6 -->

            <div class="col-md-6 d-none">

                <h2 class="title mb-2">{{__('Password recovery')}}</h2>

                <div class="alert-success" style="position: absolute"></div>

                <form method="post" action="#" class="mb-1" id="recovery-email-form">

                    <label for="register-email">{{__('Email address')}} <span class="required">*</span></label>
                    <span class="invalid-feedback error-recovery-email"></span>
                    <input type="email" name="recovery_email" class="form-input form-wide mb-2" id="recovery-email">


                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-md">{{strtoupper(__('Recover'))}}</button>
                    </div><!-- End .form-footer -->

                    <a href="" class="register" id="show-register-form">{{ __('Register') }}</a>
                </form>
            </div>

        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="social-login-wrapper">
        <p>{{__('Access your account through  your social networks.')}}</p>

        <div class="btn-group">
            <a class="btn btn-social-login btn-md btn-gplus mb-1"><i class="icon-gplus"></i><span>Google</span></a>
            <a class="btn btn-social-login btn-md btn-facebook mb-1"><i class="icon-facebook"></i><span>Facebook</span></a>
            <a class="btn btn-social-login btn-md btn-twitter mb-1"><i class="icon-twitter"></i><span>Twitter</span></a>
        </div>
    </div>
</div>








