<script type="module">

    import Validator from "{{ asset("js/Validator.js") }}";
    import Helpers from "{{ asset("js/Helpers.js") }}";

    $(function () {

        let error_register_email = false,
            error_register_password = false,
            error_login_email = false,
            error_login_password = false,
            error_recovery_email = false,

            login_email,
            login_password,


            response = new Object(),
            requestRegister  = new Object(),
            requestLogin     = new Object(),
            requestForgotPassword  = new Object(),
            canSubmitLoginForm = true,
            canSubmitRegisterForm = true,
            canSubmitRecoveryForm = true;

        const $doc = $(document);




        // REGISTER SCRIPTS

        $doc.on('blur', '#register-email', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#register-form', this, '.error-register-email',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => 'email']) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => 'email']) }}"
                }, Validator.isMail
            );

            error_register_email = response.error;
            requestRegister.email = response.value;
        });

        $doc.on('blur', '#register-password', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#register-form', this, '.error-register-password', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'password']) }}",
                    filterText: "{{ __('validation.regex_password', ['attribute' => 'password']) }}"
                }, Validator.isPassword
            );

            error_register_password = response.error;
            requestRegister.password = response.value;
        });

        //Sing up our Newsletter
        let notify  = 0;
        $doc.on('click', '#register-form input[type=checkbox]',function ()
        {
            notify = parseInt($('input:checked').val());
            if(!notify){
                notify = 0;
            }
        });



        $doc.on('submit', '#register-form', function (event)
        {
            event.preventDefault();

            if (error_register_email === false || error_register_password === false){

                Validator.requiredInput(this, '#register-email', '.error-register-email', {
                        requiredText: "{{ __('validation.required', ['attribute' => 'email']) }}"
                    }
                );

                Validator.requiredInput(this, '#register-password', '.error-register-password', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('password')]) }}"
                    }
                );
                return;
            }
            if(!canSubmitRegisterForm) return;

            canSubmitRegisterForm = false;

            requestRegister.notify = notify;

            Validator.requestAjax('POST', "{{ route_name('register.store') }}", register_callback, requestRegister);

            setTimeout(function () {
                canSubmitRegisterForm = true;
            }, 8000);

        });

        function register_callback(response) {

            if (response.success){
                location.href = "{{ route_name('dashboard') }}";
                return;
            }
            if(response.messages.email){
                Validator.error('#register-email', '.error-register-email', response.messages.email);
            }
            if(response.messages.password){
                Validator.error('#register-password', '.error-register-password', response.messages.password);
            }
        }



        // LOGIN SCRIPTS

        Helpers.submitWithEnter('#login-form', '#login-password');

        $doc.on('blur', '#login-email', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#login-form', this, '.error-login-email',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => 'email']) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => 'email']) }}"
                }, Validator.isMail
            );

            error_login_email = response.error;
            login_email = response.value;
        });

        $doc.on('blur', '#login-password', function (event)
        {
            event.preventDefault();

            let value = Validator.getValue('#login-form', this);

            if (Validator.isEmpty(value)){
                Validator.error(this, '.error-login-password', "{{ __('validation.required', ['attribute' => 'password']) }}");
                error_login_password = false;
                return;
            }

            Validator.clearError(this, '.error-login-password');

            error_login_password = true;
            login_password = value;
        });

        // know if the user wants to conserve email and password
        let remember = 0;
        $doc.on('click', '#login-form input[type=checkbox]',function () {
            remember = parseInt($('input:checked').val());
            if(!remember){
                remember = 0;
            }
        });

        $doc.on('submit', '#login-form', function (event)
        {
            event.preventDefault();


            if (Validator.getValidValue(this, '#login-email', Validator.isName)){
                error_login_email = true;
            }

            if (!Validator.isEmpty(Validator.getValue(this, '#login-password'))){
                error_login_password = true;
            }



            if (error_login_email === false || error_login_password === false)
            {
                Validator.requiredInput(this, '#login-email', '.error-login-email', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}"
                    }
                );

                Validator.requiredInput(this, '#login-password', '.error-login-password', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('password')]) }}"
                    }
                );
                return;
            }
            if(!canSubmitLoginForm) return;

            canSubmitLoginForm = false;

            requestLogin.email    = Validator.getValue(this, '#login-email');
            requestLogin.password = Validator.getValue(this, '#login-password');
            requestLogin.remember = remember;

            Validator.requestAjax('POST', "{{ route_name('login.store') }}", login_callback, requestLogin);

            setTimeout(function () {
                canSubmitLoginForm = true;
            }, 8000);

        });

        function login_callback(response)
        {
            if (response.success){
                location.href = "";
                return;
            }

            if(response.email){
                Validator.error('#login-email', '.error-login-email', response.email);
                return;
            }

            if(response.password){
                Validator.error('#login-password', '.error-login-password', response.password);
            }
        }


        // FORGOT PASSWORD SCRIPTS

        $doc.on('blur', '#recovery-email', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#recovery-email-form', this, '.error-recovery-email',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.email')]) }}"
                }, Validator.isMail
            );

            error_recovery_email = response.error;
            requestForgotPassword.email = response.value;
        });

        $doc.on('submit', '#recovery-email-form', function (event)
        {
            event.preventDefault();

            if (error_recovery_email === false)
            {
                Validator.requiredInput(this, '#recovery-email', '.error-recovery-email', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.email')]) }}"
                    }
                );
                return;
            }

            if(!canSubmitRecoveryForm) return;

            canSubmitRecoveryForm = false;

            Validator.requestAjax('POST', "{{ route_name('password.email') }}", recovery_callback, requestForgotPassword);

            setTimeout(function () {
                canSubmitRecoveryForm = true;
            }, 8000);
        });

        function recovery_callback(response)
        {
            if (response.success){
                const alert = $('.alert-success');
                alert.html(response.message).addClass('alert');
                return;
            }

            Validator.error('#recovery-email', '.error-recovery-email', response.email);
        }





        //SHOW FORGOT PASSWORD FORM OR REGISTER FORM

        $doc.on('click', '#show-recovery-email-form, #show-register-form', function (event)
        {
            event.preventDefault();

            const idContainerRegisterForm      = $('#register-form').parent(),
                idContainerRecoverEmailForm  = $('#recovery-email-form').parent();

            if (this.id === 'show-recovery-email-form'){
                Helpers.displayContainer(idContainerRegisterForm, idContainerRecoverEmailForm); return;
            }

            if (this.id === 'show-register-form'){
                Helpers.displayContainer(idContainerRecoverEmailForm, idContainerRegisterForm);
            }

        });

        const alert =  $('#show-alert-notify');
        alert.removeClass('d-none');
        setTimeout(function () {
            alert.addClass('d-none');
        }, 2500);

    });
</script>
