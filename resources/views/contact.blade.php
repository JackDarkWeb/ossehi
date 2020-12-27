@extends('layouts.default', ['title' => __('Contact Us')])

@section('content')



    <div class="page-wrapper">

        @include('layouts.nav')

        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route_name('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                    </ol>
                </div><!-- End .container -->
            </nav>

            <div class="container">

                <div id="map"></div><!-- End #map -->


                <div class="alert alert-info alert-dismissible fade show d-none" id="show-alert" role="alert">
                    <strong>{{__('success')}}</strong> <span id="message"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="row">

                    <div class="col-md-8">

                        <h2 class="light-title">{{ __('Write') }} <strong>{{ __('Us') }}</strong></h2>

                        <form action="{{ route_name('contact.store') }}" method="post" id="contact-form">

                            @csrf

                            <div class="form-group required-field">
                                <label for="name">{{ __('Name') }}</label>
                                <span class="error-name" style="color: red; font-size: smaller; font-style: italic">{{ $errors->first('name') }}</span>
                                <input type="text" class="form-control" id="name" name="name">

                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label for="email">{{__('Email')}}</label>
                                <span class="error-email" style="color: red; font-size: smaller; font-style: italic">{{ $errors->first('email') }}</span>
                                <input type="email" class="form-control" id="email" name="email">

                            </div><!-- End .form-group -->

                            <div class="form-group">
                                <label for="phone">{{__('Phone Number')}}</label>
                                <span class="error-phone" style="color: red; font-size: smaller; font-style: italic">{{ $errors->first('phone') }}</span>
                                <input type="tel" class="form-control" id="phone" name="contact_phone">

                            </div><!-- End .form-group -->

                            <div class="form-group required-field">
                                <label for="message">{{__('What’s on your mind?')}}</label>
                                <span class="error-message" style="color: red; font-size: smaller; font-style: italic">{{ $errors->first('message') }}</span>
                                <textarea cols="30" rows="1" id="message" class="form-control" name="message" ></textarea>

                            </div><!-- End .form-group -->

                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                                <button type="reset" id="reset-btn" class="btn btn-primary d-none">{{__('Submit')}}</button>
                            </div><!-- End .form-footer -->
                        </form>
                    </div><!-- End .col-md-8 -->

                    <div class="col-md-4">
                        <h2 class="light-title">{{__('Contact')}} <strong>{{__('Details')}}</strong></h2>

                        <div class="contact-info">
                            <div>
                                <i class="icon-phone"></i>
                                <p><a href="tel:">+380 66 411 214 1</a></p>
                                <p><a href="tel:">+380 63 347 412 9</a></p>
                            </div>
                            <div>
                                <i class="icon-mobile"></i>
                                <p><a href="tel:">+380 66 411 214 1</a></p>
                                <p><a href="tel:">+380 63 347 412 9</a></p>
                            </div>
                            <div>
                                <i class="icon-mail-alt"></i>
                                <p><a href="mailto:#">ossehi@gmail.com</a></p>
                                <p><a href="mailto:#">ossehi@contact.com</a></p>
                            </div>
                            <div>
                                <i class="icon-skype"></i>
                                <p>ossehi_service</p>
                                <p>ossehi_contact</p>
                            </div>
                        </div><!-- End .contact-info -->
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->

            <div class="mb-8"></div><!-- margin -->
        </main><!-- End .main -->

        @include('layouts.footer')

    </div><!-- End .page-wrapper -->

    @include('layouts.more')


    <!-- Google Map-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDc3LRykbLB-y8MuomRUIY0qH5S6xgBLX4"></script>
    <script src="{{ asset('js/map.js') }}"></script>

@stop

@section('scripts')

    <script type="module">

        import Validator from "{{ asset("js/Validator.js") }}";
        import Helpers from  "{{ asset("js/Helpers.js") }}";

        $(function () {

            let error_name = false, error_email = false, error_phone = false, error_message = false,
                response = new Object(),
                request  = new Object(),
                canSubmit = true;

            const indicative = "{{ get_prefix_phone() }}",
                  $doc = $(document);

            $doc.on('focus', '#phone', function (e) {
                e.preventDefault();

                if (Helpers.isEmpty(Helpers.getValue('#contact-form', this))){
                    Helpers.setValue('#contact-form', this, indicative);
                }
            });

            $doc.on('keyup', '#phone', function (e) {
                e.preventDefault();

                Helpers.requirePrefixPhone('#contact-form', this, indicative);
            });


            $doc.on('blur', '#name', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#contact-form', this, '.error-name',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                    }, Validator.isName
                );

                error_name = response.error;
                //request.name = response.value;
            });

            $doc.on('blur', '#email', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#contact-form', this, '.error-email',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.email')]) }}"
                    }, Validator.isMail
                );

                error_email = response.error;
                //request.email = response.value;
            });

            $doc.on('blur', '#phone', function (event)
            {
                event.preventDefault();

                response = Validator.validationInput('#contact-form', this, '.error-phone',
                    {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.phone')]) }}",
                        filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.phone')]) }}"
                    }, Validator.isPhone
                );

                error_phone = response.error;
                //request.email = response.value;
            });

            $doc.on('blur', '#message', function (event)
            {
                event.preventDefault();

                alert($(this).val())

                if (Validator.isEmpty(Validator.getValue('#contact-form', this))){
                    Validator.error(this, '.error-message', "{{ __('validation.required', ['attribute' => __('message')]) }}");
                    error_message = false;
                    return;
                }
                error_message = true;
                Validator.clearError(this, '.error-message');
            });

            $doc.on('submit', '#contact-form', function (event) {
                event.preventDefault();

                if (error_name === false || error_email === false || error_message === false || error_phone === false){

                    Validator.requiredInput(this, '#name', '.error-name', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}"
                        }
                    );

                    Validator.requiredInput(this, '#email', '.error-email', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}"
                        }
                    );

                    Validator.requiredInput(this, '#phone', '.error-phone', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.phone')]) }}"
                        }
                    );

                    Validator.requiredInput(this, '#message', '.error-message', {
                            requiredText: "{{ __('validation.required', ['attribute' => __('message')]) }}"
                        }
                    );

                    return;
                }

                if (!canSubmit) return ;

                canSubmit = false;

                request.name  = Validator.getValidValue(this, '#name', Validator.isName);
                request.email = Validator.getValidValue(this, '#email', Validator.isMail);
                request.phone = Validator.getValidValue(this, '#phone', Validator.isPhone);
                request.message = Validator.getValue(this, '#message');

                Validator.requestAjax('POST', "{{ route_name('contact.store') }}", func_callback, request);

                setTimeout(function () {
                    canSubmit = true;
                }, 8000);
            });

            function func_callback(response) {

                if (response.success){

                    const alert =  $('#show-alert');

                    $('#reset-btn').click();

                    error_name = error_email = error_phone = error_message = false;

                    alert.removeClass('d-none').find('#message').html(response.message);

                    setTimeout(function () {
                        alert.addClass('d-none');
                    }, 8000);

                    return;
                }

                if(response.messages.email){
                    Validator.error('#email', '.error-email', response.messages.email);
                }

                if(response.messages.name){
                    Validator.error('#name', '.error-name', response.messages.name);
                }

                if(response.messages.phone){
                    Validator.error('#phone', '.error-phone', response.messages.phone);
                }

                if(response.messages.message){
                    Validator.error('#message', '.error-message', response.messages.message);
                }
            }

        });
    </script>
@endsection
