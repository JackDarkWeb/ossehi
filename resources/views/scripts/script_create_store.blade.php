<script type="module">

    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        let error_store_name = false, error_image = false,
            response = new Object(),
            requestStore = new Object(),
            canSubmit    = true;

        const $doc = $(document);



        $doc.on('blur', '#store-form #name-store', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#store-form', this, '.error-name-store',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_store_name = response.error;

        });

        $doc.on('blur', '#store-form #slogan-store', function (event)
        {
            event.preventDefault();

            Validator.validationInput('#store-form', this, '.error-slogan-store',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => 'slogan']) }}",
                    filterText: "{{ __('validation.regex', ['attribute' =>'slogan']) }}"
                }, Validator.isString
            );

        });


        $doc.on('change', '#store-form #file', function (event) {

            event.preventDefault();

            $('#store-form').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#image-store', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-store-image',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#store-form').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.image') }}", function (response) {

                    if (!response.success){

                        error_image = response.success;

                        Validator.error('#file', '.error-store-image', response.error);
                        return ;
                    }

                    requestStore.image = response.image_name;

                    error_image = response.success;

                    Validator.clearError('#file', '.error-store-image');
                });

            }, 3000);

        });


        $doc.on('submit', '#store-form', function (event)
        {
            event.preventDefault();

            if (error_store_name === false || error_image === false)
            {

                Validator.requiredInput(this, '#name-store', '.error-name-store', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}"
                    }
                );

                Validator.requiredInput(this, '#file', '.error-store-image', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('image')]) }}"
                    }
                );

                return;
            }

            if(!canSubmit) return;

            canSubmit = false;

            requestStore.name    = Validator.getValidValue(this, '#name-store', Validator.isString);
            requestStore.slogan  = Validator.getValidValue(this, '#slogan-store', Validator.isString);

            Validator.requestAjax('POST', "{{ route_name('request.store') }}", callback, requestStore);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);

        });

        function callback(response) {

            if (response.success){

                $('.mfp-close').click();

                location.href = "{{ route_name('stores.by_user') }}";
                //$storeForm.find('#create-store-product').click();

                Validator.clearError('#name-store', '.error-name-store');

                return ;
            }

            Validator.error('#name-store', '.error-name-store', response.message.name[0]);
        }
    });

</script>
