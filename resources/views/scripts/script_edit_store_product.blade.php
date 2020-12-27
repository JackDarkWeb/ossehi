<script type="module">

    import Product from "{{ asset('js/Product.js') }}";
    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        let error_name = false, error_price = false,
            error_devise = false, error_image = false,  error_desc = false,

            response = new Object(),
            requestUpdateStoreProduct = new Object(),
            canSubmit = true,
            routeName;

        const $doc = $(document);



        $doc.on('blur', '#edit-store-product-form #name', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#edit-store-product-form', this, '.error-name',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_name = response.error;

            requestUpdateStoreProduct.title = response.value;
        });




        $doc.on('change', '#edit-store-product-form #devise', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#edit-store-product-form', this, '.error-devise',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('devise')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('devise')]) }}"
                }, Validator.isString
            );

            error_devise = response.error;

            requestUpdateStoreProduct.devise = response.value;
        });


        $doc.on('blur', '#edit-store-product-form #price', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#edit-store-product-form', this, '.error-price',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.price')]) }}"
                }, Validator.isFloat
            );

            error_price = response.error;

            requestUpdateStoreProduct.price = response.value;
        });

        $doc.on('change', '#edit-store-product-form #file', function (event) {

            event.preventDefault();

            $('#edit-store-product-form').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#file-product', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-file',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#edit-store-product-form').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.product.image') }}", function (data) {

                    if (!data.success){

                        Validator.error('#file', '.error-file', data.error);

                        error_image = data.success;

                        return ;
                    }

                    requestUpdateStoreProduct.image = data.image_name;

                    $('#edit-store-product-form').find('#file').attr('value', data.image_name);

                    error_image = data.success;

                    Validator.clearError('#file', '.error-file');
                });

            }, 3000);

        });



        $doc.on('change', '#edit-store-product-form #colors, #edit-store-product-form #brands, #edit-store-product-form #sizes', function (event) {

            event.preventDefault();

            switch (this.id){

                case "colors":
                    requestUpdateStoreProduct.colors = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                case "brands":
                    requestUpdateStoreProduct.brands = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                case "sizes":
                    requestUpdateStoreProduct.sizes = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                default:
                    break;
            }

        });


        $doc.on('change', '#edit-store-product-form #description', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#edit-store-product-form', this, '.error-description',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('description')]) }}",
                    filterText: "{{ __('validation.min.string', ['attribute' => __('description'), 'min' => 6]) }}"
                }, Validator.isText
            );

            error_desc = response.error;

            requestUpdateStoreProduct.description = response.value;
        });


        $doc.on('submit', '#edit-store-product-form', function (event) {

            event.preventDefault();

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


            if ($(this).find('#file').attr('value')){

                error_image = true;
            }

            if (Validator.getValidValue(this, '#name', Validator.isString)){

                error_name = true;
            }

            if (Validator.getValidValue(this, '#description', Validator.isText)){

                error_desc = true;
            }

            //console.log(Validator.getValidValue(this, '#devise', Validator.isString))
            //alert(`${error_name} ${error_price} ${error_devise} ${error_image} ${error_desc}`)

            if (error_name === false || error_price === false || error_devise === false || error_image === false || error_desc === false){

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

                Validator.requiredInput(this, '#description', '.error-description', {
                    requiredText: "{{ __('validation.required', ['attribute' => 'description']) }}"
                });

                return ;
            }

            if (!canSubmit) return ;

            canSubmit = false;

            routeName = $(this).attr('action');


            requestUpdateStoreProduct.colors = Validator.getSelectedValues('#colors');
            requestUpdateStoreProduct.sizes  = Validator.getSelectedValues('#sizes');
            requestUpdateStoreProduct.brands = Validator.getSelectedValues('#brands');
            requestUpdateStoreProduct.title  = Validator.getValidValue(this, '#name', Validator.isString);

            if($(this).find('#price').is($('#price'))){

                requestUpdateStoreProduct.price  = Validator.getValidValue(this, '#price', Validator.isFloat);

                requestUpdateStoreProduct.devise  = Validator.getValidValue(this, '#devise', Validator.isString);
            }
            requestUpdateStoreProduct.image        = $(this).find('#file').attr('value');
            requestUpdateStoreProduct.description  = Validator.getValidValue(this, '#description', Validator.isText);


            Validator.requestAjax('PUT', routeName, callback, requestUpdateStoreProduct);

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

            if(response.messages.category){
                Validator.error('#category', '.error-category', response.messages.category[0]);
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

            if(response.messages.colors){
                Validator.error('#colors', '.error-colors', response.messages.colors[0]);
            }

            if(response.messages.sizes){
                Validator.error('#sizes', '.error-sizes', response.messages.sizes[0]);
            }

            if(response.messages.brands){
                Validator.error('#brands', '.error-brands', response.messages.brands[0]);
            }

            if(response.messages.image){
                Validator.error('#file', '.error-file', response.messages.image[0]);
            }
        }
    });
</script>
