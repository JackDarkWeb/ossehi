<script type="module">

    import Validator from "{{ asset('js/Validator.js') }}";
    import Helpers from "{{ asset('js/Helpers.js') }}";

    $(function () {

        let error_name = false, error_price = true,
            error_devise = true, error_image = false,
            error_type = false, error_desc = false,

            response = new Object(),
            requestVarious = new Object(),
            canSubmit = true;

        const $doc = $(document);



        $doc.on('blur', '#various-form #name', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#various-form', this, '.error-name',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_name = response.error;

            requestVarious.title = response.value;
        });


        $doc.on('change', '#various-form #add-price', function (event) {

            event.preventDefault();

            if (Validator.checkBoxInput('#various-form', this)){

                error_price = false;

                error_devise = false;

                $('#various-form').find('#content-price-devise').removeClass('d-none');

                Helpers.setValue('#various-form', '#price, #devise', ' ');

            }else {

                error_price = true;

                error_devise = true;

                $('#various-form').find('#content-price-devise').addClass('d-none');
            }

        });





        $doc.on('blur', '#various-form #price', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#various-form', this, '.error-price',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.price')]) }}"
                }, Validator.isFloat
            );

            error_price = response.error;

            requestVarious.price = response.value;
        });




        $doc.on('change', '#various-form #devise', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#various-form', this, '.error-devise',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('devise')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('devise')]) }}"
                }, Validator.isString
            );

            error_devise = response.error;

            requestVarious.devise = response.value;
        });



        $doc.on('change', '#various-form #file', function (event) {

            event.preventDefault();

            $('#various-form').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#file-product', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-file',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#various-form').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.various.image') }}", function (data) {

                    if (!data.success){

                        Validator.error('#file', '.error-file', data.error);

                        error_image = data.success;

                        return ;
                    }

                    //requestVarious.image = data.image_name;

                    $('#various-form').find('#file').attr('value', data.image_name)

                    error_image = data.success;

                    Validator.clearError('#file', '.error-file');
                });

            }, 3000);

        });


        $doc.on('change', '#various-form #type', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#various-form', this, '.error-type',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('type')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('type')]) }}"
                }, Validator.isString
            );

            error_type = response.error;

            requestVarious.type = response.value;
        });


        $doc.on('change', '#various-form #description', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#various-form', this, '.error-description',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('description')]) }}",
                    filterText: "{{ __('validation.min.string', ['attribute' => __('description'), 'min' => 6]) }}"
                }, Validator.isText
            );

            error_desc = response.error;

            requestVarious.description = response.value;
        });


        $doc.on('submit', '#various-form', function (event) {

            event.preventDefault();

            //alert(`${error_price} ${error_devise}`)

            if (error_name === false  || error_price === false || error_devise === false || error_type === false || error_desc === false){

                Validator.requiredInput(this, '#name', '.error-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}"
                });

                Validator.requiredInput(this, '#price', '.error-price', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}"
                });

                Validator.requiredInput(this, '#devise', '.error-devise', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'devise']) }}"
                });

                Validator.requiredInput(this, '#type', '.error-type', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'type']) }}"
                });

                Validator.requiredInput(this, '#description', '.error-description', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'description']) }}"
                });

                return ;
            }

            if (!canSubmit) return ;

            canSubmit = false;


            if (!Validator.checkBoxInput(this, '#add-price')){

                requestVarious.price = null;

                requestVarious.devise = null;
            }

            requestVarious.image = $(this).find('#file').attr('value');

            Validator.requestAjax('POST', "{{ route_name('request.various') }}", callback, requestVarious);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);
        });

        function callback(response) {

            if (response.success){

                location.href = `/${Validator.lang}/galleries/diversity/${response.slug}`;
                return;
            }

            if(response.messages.title){
                Validator.error('#name', '.error-name', response.messages.title[0]);
            }


            if(response.messages.price){
                Validator.error('#price', '.error-price', response.messages.price[0]);
            }

            if(response.messages.description){
                Validator.error('#description', '.error-description', response.messages.description[0]);
            }

            if(response.messages.devise){
                Validator.error('#devise', '.error-devise', response.messages.devise[0]);
            }

            if(response.messages.type){
                Validator.error('#type', '.error-type', response.messages.type[0]);
            }


            if(response.messages.image){
                Validator.error('#file', '.error-file', response.messages.image[0]);
            }
        }
    });
</script>
