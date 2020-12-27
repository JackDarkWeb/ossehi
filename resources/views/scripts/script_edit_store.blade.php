<script type="module">

    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        let error_store_name = false, error_image = false,
            response = new Object(),
            requestUpdateStore = new Object(),
            canSubmit    = true,
            routeName;

        const $doc = $(document);



        $doc.on('blur', '#editStoreForm #name-store', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#editStoreForm', this, '.error-name-store',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_store_name = response.error;

        });

        $doc.on('blur', '#editStoreForm #slogan-store', function (event)
        {
            event.preventDefault();

            Validator.validationInput('#editStoreForm', this, '.error-slogan-store',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => 'slogan']) }}",
                    filterText: "{{ __('validation.regex', ['attribute' =>'slogan']) }}"
                }, Validator.isString
            );

        });


        $doc.on('change', '#editStoreForm #file', function (event) {

            event.preventDefault();

            $('#editStoreForm').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#image-store', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-store-image',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#editStoreForm').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.image') }}", function (response) {

                    if (!response.success){

                        error_image = response.success;

                        Validator.error('#file', '.error-store-image', response.error);
                        return ;
                    }

                    $('#editStoreForm').find('#file').attr('value', response.image_name);

                    error_image = response.success;

                    Validator.clearError('#file', '.error-store-image');
                });

            }, 3000);

        });


        $doc.on('submit', '#editStoreForm', function (event)
        {
            event.preventDefault();


            if ($(this).find('#file').attr('value')){

                error_image = true;
            }

            if (Validator.getValidValue(this, '#name-store', Validator.isString)){

                error_store_name = true;
            }


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

            routeName = $(this).attr('action');

            requestUpdateStore.name    = Validator.getValidValue(this, '#name-store', Validator.isString);
            requestUpdateStore.slogan  = Validator.getValidValue(this, '#slogan-store', Validator.isString);
            requestUpdateStore.image  = $(this).find('#file').attr('value');

            Validator.requestAjax('PUT', routeName, callback, requestUpdateStore);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);

        });

        function callback(response) {

            if (response.success){

                location.href = "";

                Validator.clearError('#name-store', '.error-name-store');

                return ;
            }

            Validator.error('#name-store', '.error-name-store', response.message.name[0]);
        }
    });

</script>
