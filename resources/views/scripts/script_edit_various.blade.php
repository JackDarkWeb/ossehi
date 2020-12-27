<script type="module">

    import Validator from "{{ asset('js/Validator.js') }}";
    import Helpers from "{{ asset('js/Helpers.js') }}";

    $(function () {

        let error_name = false, error_price = true,
            error_devise = true, error_image = false,
            error_type = false, error_desc = false,

            response = new Object(),
            requestUpdateVarious = new Object(),
            routeName,
            canSubmit = true;

        const $doc = $(document);



        $doc.on('blur', '#edit-various-form #name', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#edit-various-form', this, '.error-name',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_name = response.error;

            requestUpdateVarious.title = response.value;
        });


        $doc.on('change', '#edit-various-form #add-price', function (event) {

            event.preventDefault();

            if (Validator.checkBoxInput('#edit-various-form', this)){

                error_price = false;

                error_devise = false;

                $('#edit-various-form').find('#content-price-devise').removeClass('d-none');

                Helpers.setValue('#edit-various-form', '#price, #devise', ' ');

            }else {

                error_price = true;

                error_devise = true;

                $('#edit-various-form').find('#content-price-devise').addClass('d-none');
            }

        });





        $doc.on('blur', '#edit-various-form #price', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#edit-various-form', this, '.error-price',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.price')]) }}"
                }, Validator.isFloat
            );

            error_price = response.error;

            requestUpdateVarious.price = response.value;
        });




        $doc.on('change', '#edit-various-form #devise', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#edit-various-form', this, '.error-devise',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('devise')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('devise')]) }}"
                }, Validator.isString
            );

            error_devise = response.error;

            requestUpdateVarious.devise = response.value;
        });



        $doc.on('change', '#edit-various-form #file', function (event) {

            event.preventDefault();

            $('#edit-various-form').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#file-product', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-file',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#edit-various-form').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.various.image') }}", function (data) {

                    if (!data.success){

                        Validator.error('#file', '.error-file', data.error);

                        error_image = data.success;

                        return ;
                    }

                    requestUpdateVarious.image = data.image_name;

                    $('#edit-various-form').find('#file').attr('value', data.image_name);

                    error_image = data.success;

                    Validator.clearError('#file', '.error-file');
                });

            }, 3000);

        });


        $doc.on('change', '#edit-various-form #type', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#edit-various-form', this, '.error-type',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('type')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('type')]) }}"
                }, Validator.isString
            );

            error_type = response.error;

            requestUpdateVarious.type = response.value;
        });


        $doc.on('change', '#edit-various-form #description', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#edit-various-form', this, '.error-description',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('description')]) }}",
                    filterText: "{{ __('validation.min.string', ['attribute' => __('description'), 'min' => 6]) }}"
                }, Validator.isText
            );

            error_desc = response.error;

            requestUpdateVarious.description = response.value;
        });


        $doc.on('submit', '#edit-various-form', function (event) {

            event.preventDefault();

            if (Validator.getValidValue(this, '#name', Validator.isString)){

                error_name = true;
            }


            if($(this).find('#price').is($('#price'))){

                if (Validator.getValidValue(this, '#price', Validator.isFloat)){

                    error_price = true;
                }
                if (Validator.getValidValue(this, '#devise', Validator.isString)){

                    error_devise = true;
                }
            }else{
                error_price = true;
                error_devise = true;
            }

            if (Validator.getValidValue(this, '#type', Validator.isString)){

                error_type = true;
            }

            if (Validator.getValidValue(this, '#description', Validator.isText)){

                error_desc = true;
            }


            //alert(`${error_price} ${error_devise}`)

            //alert(`${$(this).find('#file').attr('value')}`)
            //alert(`${error_name} ${error_price} ${error_devise} ${error_type}  ${error_desc}`);
            //return ;

            if (error_name === false  || error_price === false || error_devise === false  || error_type === false || error_desc === false){

                Validator.requiredInput(this, '#name', '.error-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}"
                });

                Validator.requiredInput(this, '#price', '.error-price', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}"
                });

                Validator.requiredInput(this, '#devise', '.error-devise', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'devise']) }}"
                });

                Validator.requiredInput(this, '#file', '.error-file', {
                        requiredText: "{{ __('validation.required', ['attribute' => 'image']) }}"
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

            routeName = $('#edit-various-form').attr('action');

            requestUpdateVarious.title  = Validator.getValidValue(this, '#name', Validator.isString);

            if($(this).find('#price').is($('#price'))){

                requestUpdateVarious.price  = Validator.getValidValue(this, '#price', Validator.isFloat);

                requestUpdateVarious.devise  = Validator.getValidValue(this, '#devise', Validator.isString);
            }

            requestUpdateVarious.type         = Validator.getValidValue(this, '#type', Validator.isString);
            requestUpdateVarious.image        = $(this).find('#file').attr('value');
            requestUpdateVarious.description  = Validator.getValidValue(this, '#description', Validator.isText);


            Validator.requestAjax('PUT', routeName, callback, requestUpdateVarious);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);
        });

        function callback(response) {

            if (response.success){

                location.href = '';
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
