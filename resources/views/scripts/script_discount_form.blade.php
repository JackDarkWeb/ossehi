<script type="module">

    import Product from "{{ asset('js/Product.js') }}";
    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        let error_discount = false,

            response  = new Object(),
            request   = new Object(),
            canSubmit = true,
            route,
            routeNameCancelDiscount,
            confirmation;

        const $doc = $(document);


        $doc.on('blur', '#discount-price', function (event) {

            event.preventDefault();

            response = Product.discountPrice('#discount-form', this, '#old_price', '.error-discount-price',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.price')]) }}"
                },
                "{{ __('The new price is higher than the old') }}"
            );

            error_discount = response.error;

            request.discount_price = response.value;

            if (response.error){

                route = response.route
            }

        });


        $doc.on('submit', '#discount-form', function (event) {

            event.preventDefault();

            if (error_discount === false){

                Validator.requiredInput(this, '#discount-price', '.error-discount-price', {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}"
                });
                return ;
            }

            if (!canSubmit) return ;

            canSubmit = false;

            Validator.requestAjax('PUT', route, callback, request);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);
        });

        function callback(response) {

            if (response.success){

                $('.mfp-close').click();

                Product.renderBoxPrice(response.old_price, response.discount_price);

                Product.renderBtnCancelDiscount(response.routeCancelDiscountName, "{{ __('Cancel discount') }}");

                return;
            }

            Validator.error('#discount-price', '.error-discount-price', response.error);
        }



        $doc.on('click', '.cancel-discount', function (event) {

            event.preventDefault();

            const routeName = $(this).data('action');

            confirmation = confirm(`{{ __('Do you want to cancel the discount') }} ?`);

            if (!confirmation) return ;

            Validator.requestAjax('PUT', routeName, function (response) {

                if (response.success){

                    location.href = '';
                }
            });
        });


    });
</script>
