@extends('layouts.default', ['title' => __('Reset password')])

@section('content')

    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">

            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <h2 class="title mb-2">{{__('Update your password')}}</h2>

                        <div class="alert-success" style="position: absolute"></div>

                        <form method="post" action="{{ route_name('password.update', ['slug' => $slug]) }}" class="mb-1" id="password-form">

                            @csrf
                            @method('PUT')

                            <label for="update-password">{{__('Password')}} <span class="required">*</span></label>
                            <span class="error-password" style="font-size: small; font-style: italic; color: red">{{ $errors->first('password') }}</span>
                            <input type="password" name="password" class="form-input form-wide mb-2 @error('password') is-invalid @enderror" id="password"  value="{{old('password')}}" />


                            <label for="update-password">{{__('Confirm password')}} <span class="required">*</span></label>
                            <span class="error-confirmation-password" style="font-size: small; font-style: italic; color: red">{{ $errors->first("password_confirmation") }}</span>
                            <input type="password" name="password_confirmation" class="form-input form-wide mb-2 @error('password_confirmation') is-invalid @enderror" id="confirmation-password" value="{{old('password_confirmation')}}" />

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary btn-md">{{strtoupper(__('Update'))}}</button>
                            </div><!-- End .form-footer -->

                        </form>


                    </div><!-- End .col-md-8 -->


                </div><!-- End .row -->

            </div><!-- End .container -->

            <div class="mb-8"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')



@stop

@section('scripts')
    <script type="module">

        import Validator from "{{ asset('js/Validator.js') }}";

        $(function () {
            let error_password = false,
                error_confirmation_password = false,
                response,
                password_value;

            const $doc = $(document);

            $doc.on('blur', '#password', function (event) {
                event.preventDefault();
                response = Validator.validationInput('#password-form', this, '.error-password', {
                        requiredText: "{{ __('validation.required', ['attribute' => 'password']) }}",
                        filterText: "{{ __('validation.regex_password', ['attribute' => 'password']) }}"
                    }, Validator.isPassword
                );
                error_password = response.error;
                password_value = response.value;
            });

            $doc.on('blur', '#confirmation-password', function (event) {
                event.preventDefault();
                error_confirmation_password = Validator.confirmPassword('#password-form', '#password', this, '.error-confirmation-password', {
                        confirmText: "{{ __('validation.confirmed', ['attribute' => 'password']) }}"
                    }
                );
            });

            $doc.on('submit', '#password-form', function (event) {
                if(error_password === false || error_confirmation_password === false){

                    Validator.requiredInput(this, '#password', '.error-password', {
                            requiredText: "{{ __('validation.required', ['attribute' => 'password']) }}"
                        }
                    );

                    if (!Validator.isEmpty(password_value)){
                        Validator.requiredInput(this, '#confirmation-password', '.error-confirmation-password', {
                                requiredText: "{{ __('validation.confirmed', ['attribute' => 'password']) }}"
                            }
                        );
                    }
                    return false;
                }
                return true;
            });
        })
    </script>
@endsection





