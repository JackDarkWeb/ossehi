<script type="module">
    import ShippingForm from "{{ asset('js/ShippingForm.js') }}";
    import Validator from "{{ asset('js/Validator.js') }}";
    import Helpers from "{{ asset('js/Helpers.js') }}";

    $(function () {

        let error_first_name = false, error_last_name = false, error_street = false,
            error_city = false, error_state = false, error_country = false, error_phone = false,
            response = new Object(),
            request  = new Object(),
            country  = $('#country-shipping').val(),
            canSubmit = true,
            save_address = 0,
            default_state = "{{ Cookie::has('shipping_address') ? cast_cookie('shipping_address')->state : '' }}";

        const $doc = $(document),
              indicative = "{{ get_prefix_phone() }}";



        $doc.on('blur', '#first-name', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#shipping-form', this, '.error-first-name',
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

            response = Validator.validationInput('#shipping-form', this, '.error-last-name',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.last_name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.last_name')]) }}"
                }, Validator.isName
            );

            error_last_name = response.error;
            //requestUser.last_name = response.value;
        });



        ShippingForm.getStates(country, "{{ route_name('states') }}", default_state);

        $doc.on('change', '#country-shipping', function (event) {

            event.preventDefault();

            country = $(this).val();

            ShippingForm.getStates(country, "{{ route_name('states') }}", default_state);
        });


        $doc.on('blur', '#street', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#shipping-form', this, '.error-street',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.street')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.street')]) }}"
                }, Validator.isString
            );

            error_street = response.error;
            //requestUser.last_name = response.value;
        });

        $doc.on('blur', '#city', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#shipping-form', this, '.error-city',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.city')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.city')]) }}"
                }, Validator.isString
            );

            error_city = response.error;
            //requestUser.last_name = response.value;
        });

        $doc.on('blur', '#postal-code', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#shipping-form', this, '.error-postal-code',
                {
                    requiredText: "",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.postal_code')]) }}"
                }, Validator.isString
            );

            //error_city = response.error;
            //requestUser.last_name = response.value;
        });


        $doc.on('focus', '#phone', function (event) {

            event.preventDefault();

            if (Helpers.isEmpty(Helpers.getValue('#shipping-form', this))){

                Helpers.setValue('#shipping-form', this, indicative);
            }
        });

        $doc.on('keyup', '#phone', function (event) {

            event.preventDefault();

            Helpers.requirePrefixPhone('#shipping-form', this, indicative);
        });

        $doc.on('blur', '#phone', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#shipping-form', this, '.error-phone',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.phone')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.phone')]) }}"
                }, Validator.isPhone
            );

            error_phone = response.error;
            //request.email = response.value;
        });


        // know if the user wants to conserve address

        $doc.on('click', '#shipping-form input[type=checkbox]',function () {

            save_address = parseInt($('input:checked').val());

            if(!save_address){
                save_address = 0;
            }
        });


        $doc.on('click', '.config-swatch-list > li > a', function (event) {

            event.preventDefault();

            const color = $(this).attr('style'),
                  color_value = (color.split(':')).pop();

            $('#cart-operation-form').find('#product-color').val(color_value);

            $(this).parent().addClass('active').siblings().removeClass('active');
        });

        $doc.on('click', '.config-size-list > li > a', function (event) {

            event.preventDefault();

            const size_value = $(this).html();

            $('#cart-operation-form').find('#product-size').val(size_value);

            $(this).parent().addClass('active').siblings().removeClass('active');
        });


        $doc.on('click', '#btn-shipping-order', function (event) {

            event.preventDefault();

            $('.mfp-close').click();

            const qty = parseInt($(this).parents('form').find('#product-quantity').val()),
                  product_color = $(this).parents('form').find('#product-color').val(),
                  product_size  = $(this).parents('form').find('#product-size').val();

            request.product = $(this).data('values');

            request.qty_product = qty;

            request.product_color = product_color;

            request.product_size = product_size;

        });

        $doc.on('submit', '#shipping-form', function (event)
        {
            event.preventDefault();

            if (Validator.getValidValue(this, '#city', Validator.isString)){
                error_city = true;
            }

            if (Validator.getValidValue(this, '#street', Validator.isString)){
                error_street = true;
            }

            if (Validator.getValidValue(this, '#phone', Validator.isPhone)){
                error_phone = true;
            }

            if (Validator.getValidValue(this, '#first-name', Validator.isName)){
                error_first_name = true;
            }

            if (Validator.getValidValue(this, '#last-name', Validator.isName)){
                error_last_name = true;
            }

            //alert(`${error_first_name} ${error_last_name} ${error_street} ${error_city} ${error_phone}`)

            if (error_first_name === false || error_last_name === false || error_street === false || error_city === false || error_phone === false)
            {
                Validator.requiredInput(this, '#first-name', '.error-first-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.first_name')]) }}"
                    }
                );

                Validator.requiredInput(this, '#last-name', '.error-last-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.last_name')]) }}"
                    }
                );

                Validator.requiredInput(this, '#last-name', '.error-last-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.last_name')]) }}"
                    }
                );

                Validator.requiredInput(this, '#phone', '.error-phone', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.phone')]) }}"
                    }
                );

                Validator.requiredInput(this, '#city', '.error-city', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.city')]) }}"
                    }
                );

                Validator.requiredInput(this, '#street', '.error-street', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.street')]) }}"
                    }
                );

                Validator.requiredInput(this, '#postal_code', '.error-postal-code', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.postal_code')]) }}"
                    }
                );

                return;
            }

            if(!canSubmit) return;

            canSubmit = false;


            request.first_name = Validator.getValidValue(this, '#first-name', Validator.isName);
            request.last_name  = Validator.getValidValue(this, '#last-name', Validator.isName);
            request.street     = Validator.getValidValue(this, '#street', Validator.isString);
            request.country    = Validator.getValidValue(this, '#country-shipping', Validator.isString);
            request.city       = Validator.getValidValue(this, '#city', Validator.isString);
            request.phone      = Validator.getValidValue(this, '#phone', Validator.isPhone);
            request.state      = Validator.getValidValue(this, '#state-shipping', Validator.isString);
            request.postal_code = Validator.getValidValue(this, '#postal-code', Validator.isString);

            request.save_address = save_address;


            Validator.requestAjax('POST', "{{ route_name('shipping.store') }}", callback, request);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);

        });

        function callback(response) {

            if (response.success){

                //const alert =  $('#show-alert');

                $('#reset-btn').click();

                $('#cancel-btn').click();

                error_first_name = false, error_last_name = false, error_street = false, error_city = false, error_phone = false;

                //alert.removeClass('d-none').find('#message').html(response.message);

                setTimeout(function () {
                    alert.addClass('d-none');
                }, 8000);

                return;
            }

            if(response.messages.first_name){
                Validator.error('#first-name', '.error-first-name', response.messages.first_name);
            }

            if(response.messages.last_name){
                Validator.error('#last-name', '.error-last-name', response.messages.last_name);
            }

            if(response.messages.phone){
                Validator.error('#phone', '.error-phone', response.messages.phone);
            }


        }


    });

</script>
