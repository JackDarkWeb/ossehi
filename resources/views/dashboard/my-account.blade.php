@extends('layouts.default', ['title' => __('My account')])

@section('content')

        <div class="alert alert-info alert-dismissible fade show d-none" id="show-alert" role="alert">
            <strong>{{__('Info')}}</strong> <span id="message"></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route_name('home')}}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('Dashboard')}}</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-lg-last dashboard-content">
                        <h2>{{__('Edit Account Information')}}</h2>

                        <form action="{{ route_name('update.user') }}" method="post" id="update-user-form">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="first-name">{{__('First Name')}}</label>
                                                <span class="error-first-name" style="font-size: small; font-style: italic; color: red">{{ $errors->first('first_name') }}</span>
                                                <input type="text" class="form-control" id="first-name" name="first_name" value="{{ Auth::user()->first_name }}">

                                            </div><!-- End .form-group -->
                                        </div><!-- End .col-md-4 -->

                                        <div class="col-md-6">
                                            <div class="form-group required-field">
                                                <label for="last-name">{{__('Last Name')}}</label>
                                                <span class="error-last-name" style="font-size: small; font-style: italic; color: red">{{ $errors->first('last_name') }}</span>
                                                <input type="text" class="form-control" id="last-name" name="last_name" value="{{ Auth::user()->last_name }}">

                                            </div><!-- End .form-group -->
                                        </div><!-- End .col-md-4 -->
                                    </div><!-- End .row -->
                                </div><!-- End .col-sm-11 -->
                            </div><!-- End .row -->

                            <div class="form-group required-field">
                                <label for="email">{{__('Email')}}</label>

                                <span class="error-email" style="font-size: small; font-style: italic; color: red">{{ $errors->first('email') }}</span>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">

                            </div><!-- End .form-group -->

                            <div class="mb-2"></div><!-- margin -->

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="change-pass-checkbox" value="1">
                                <label class="custom-control-label" for="change-pass-checkbox">{{__('Change Password')}}</label>
                            </div><!-- End .custom-checkbox -->

                            <div id="account-chage-pass">

                                <h3 class="mb-2">{{__('Change Password')}}</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label for="password">{{__('Password')}}</label>
                                            <span class="error-password" style="font-size: small; font-style: italic; color: red">{{ $errors->first('password') }}</span>
                                            <input type="password" class="form-control" id="password" name="password">

                                        </div><!-- End .form-group -->
                                    </div><!-- End .col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="form-group required-field">
                                            <label for="confirmation-password">{{__('Confirm Password')}}</label>

                                            <span class="error-confirmation-password" style="font-size: small; font-style: italic; color: red"></span>
                                            <input type="password" class="form-control" id="confirmation-password" name="confirmation_password">

                                        </div><!-- End .form-group -->
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- End #account-chage-pass -->

                            <div class="required text-right">* {{__('Required Field')}}</div>
                            <div class="form-footer">
                                <a href="#"><i class="icon-angle-double-left"></i>{{__('Back')}}</a>

                                <div class="form-footer-right">
                                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                                </div>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .col-lg-9 -->

                    @include('layouts.nav_my_account')

                </div><!-- End .row -->
            </div><!-- End .container -->


            <div class="mb-5"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')


    </div><!-- End .page-wrapper -->

    @include('layouts.more')



@stop


@section('scripts')
    <script type="module">

        import Validator from "{{ asset("js/Validator.js") }}";

        $(function () {

            let error_first_name = false,
                error_last_name = false,
                error_email = false,
                error_password = false,
                error_confirmation_password = false,

                response     = new Object(),
                requestUser  = new Object(),
                canSubmitUserForm = true;

            const $doc = $(document);

            $doc.on('blur', '#first-name', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#update-user-form', this, '.error-first-name',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.first_name')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.first_name')]) }}"
                    }, Validator.isName
                );

                error_first_name = response.error;
                //requestUser.first_name = response.value;
            });


            $doc.on('blur', '#last-name', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#update-user-form', this, '.error-last-name',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.last_name')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.last_name')]) }}"
                    }, Validator.isName
                );

                error_last_name = response.error;
                //requestUser.last_name = response.value;
            });

            $doc.on('blur', '#email', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#update-user-form', this, '.error-email',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.email')]) }}"
                    }, Validator.isMail
                );

                error_email = response.error;
                //requestUser.email = response.value;
            });


            // know if the user wants to change their password
            let checkbox = 0;
            $doc.on('change', 'input[type=checkbox]', function () {
                checkbox = $('input:checked').val();
                if(!checkbox){
                    checkbox = 0;
                    error_password = true;
                    error_confirmation_password = true;
                }else {
                    error_password = false;
                    error_confirmation_password = false;
                }
            });


            $doc.on('blur', '#password', function (event) {
                event.preventDefault();

                response = Validator.validationInput('#update-user-form', this, '.error-password', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.password')]) }}",
                        filterText: "{{ __('validation.regex_password', ['attribute' => __('validation.attributes.password')]) }}"
                    }, Validator.isPassword
                );

                error_password = response.error;
                //requestUser.password = response.value;
            });

            $doc.on('blur', '#confirmation-password', function (event) {
                event.preventDefault();

                error_confirmation_password = Validator.confirmPassword('#update-user-form', '#password', this, '.error-confirmation-password', {
                        confirmText: "{{ __('validation.confirmed', ['attribute' => __('validation.attributes.password')]) }}"
                    }
                );
            });


            $doc.on('submit', '#update-user-form', function (event)
            {
                event.preventDefault();

                if(Validator.getValidValue(this, '#first-name', Validator.isName)){
                    error_first_name = true
                }
                if(Validator.getValidValue(this, '#last-name', Validator.isName)){
                    error_last_name = true;
                }
                if(Validator.getValidValue(this, '#email', Validator.isMail)){
                    error_email = true;
                }
                if(!checkbox){
                    error_password = true;
                    error_confirmation_password = true;
                }

                if (!Validator.confirmPassword('#update-user-form', '#password', '#confirmation-password', '.error-confirmation-password', {
                        confirmText: "{{ __('validation.confirmed', ['attribute' => __('validation.attributes.password')]) }}"
                    }
                ))
                {
                    error_password = false;
                }

                //alert(`${error_first_name}  ${error_last_name}  ${error_email}  ${error_password}  ${error_confirmation_password}`);

                if(error_first_name === false || error_last_name === false || error_email === false || error_password === false || error_confirmation_password === false)
                {

                    Validator.requiredInput(this, '#first-name', '.error-first-name', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.first_name')]) }}"
                        }
                    );

                    Validator.requiredInput(this, '#last-name', '.error-last-name', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.last_name')]) }}"
                        }
                    );

                    Validator.requiredInput(this, '#email', '.error-email', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}"
                        }
                    );

                    if (checkbox){

                        Validator.requiredInput(this, '#password', '.error-password', {
                                requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.password')]) }}"
                            }
                        );
                    }

                    return;
                }

                if (!canSubmitUserForm) return ;

                canSubmitUserForm = false;

                requestUser.first_name = Validator.getValidValue(this, '#first-name', Validator.isName);
                requestUser.last_name  = Validator.getValidValue(this, '#last-name', Validator.isName);
                requestUser.email      = Validator.getValidValue(this, '#email', Validator.isMail);
                requestUser.password   = Validator.getValidValue(this, '#password', Validator.isPassword);
                requestUser.change_password = checkbox;

                Validator.requestAjax('PUT', "{{ route_name('update.user') }}", func_callback, requestUser);

                setTimeout(function () {
                    canSubmitUserForm = true;
                }, 8000);

            });

            function func_callback(response) {

                if (response.success){

                    const alert =  $('#show-alert');

                    alert.removeClass('d-none').find('#message').html(response.message);

                    setTimeout(function () {
                        alert.addClass('d-none');
                    }, 2500);

                    return;
                }

                if(response.email){
                    Validator.error('#email', '.error-email', response.email);
                }

                if(response.messages.email){
                    Validator.error('#email', '.error-email', response.messages.email);
                }



                if(response.messages.first_name){
                    Validator.error('#first-name', '.error-first-name', response.messages.first_name);
                }

                if(response.messages.last_name){
                    Validator.error('#last-name', '.error-last-name', response.messages.last_name);
                }

                if(response.messages.password){
                    Validator.error('#password', '.error-password', response.messages.password);
                }
            }


        })
    </script>
@endsection
