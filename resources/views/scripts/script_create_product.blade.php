<script type="module">

    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        let error_name = false, error_category = false, error_price = false,
            error_devise = false, error_image = false, error_type = false, error_desc = false,

            response = new Object(),
            requestProduct = new Object(),
            canSubmit = true;

        const $doc = $(document);



        $doc.on('blur', '#product-form #name', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-name',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.name')]) }}"
                }, Validator.isString
            );

            error_name = response.error;

            requestProduct.title = response.value;
        });

        $doc.on('change', '#product-form #category', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-category',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.category')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.category')]) }}"
                }, Validator.isInteger
            );

            error_category = response.error;

            requestProduct.category = response.value;
        });


        $doc.on('change', '#product-form #devise', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-devise',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('devise')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('devise')]) }}"
                }, Validator.isString
            );

            error_devise = response.error;

            requestProduct.devise = response.value;
        });


        $doc.on('blur', '#product-form #price', function (event)
        {
            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-price',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('validation.attributes.price')]) }}"
                }, Validator.isFloat
            );

            error_price = response.error;

            requestProduct.price = response.value;
        });

        $doc.on('change', '#product-form #file', function (event) {

            event.preventDefault();

            $('#product-form').find('img').attr('src',location.origin + "/images/loading.svg");

            setTimeout( () => {

                response = Validator.uploadFile(this, '#file-product', 2400000, ['jpg', 'png', 'jpeg', 'gif'], '.error-file',{

                    filterTypeText: "{{ __('validation.image', ['attribute' => 'image']) }}",

                    filterSizeText: "{{ __('validation.size.file', ['attribute' => 'image', 'size' => 1000]) }}",
                });

                if (response.error){

                    $('#product-form').find('img').attr('src',"https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg");

                    return ;
                }

                Validator.requestAjaxElementary('POST', "{{ route_name('treatment.product.image') }}", function (data) {

                    if (!data.success){

                        Validator.error('#file', '.error-file', data.error);

                        error_image = data.success;

                        return ;
                    }

                    requestProduct.image = data.image_name;

                    error_image = data.success;

                    Validator.clearError('#file', '.error-file');
                });

            }, 3000);

        });


        $doc.on('change', '#product-form #type', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-type',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('type')]) }}",
                    filterText: "{{ __('validation.regex', ['attribute' => __('type')]) }}"
                }, Validator.isString
            );

            error_type = response.error;

            requestProduct.type = response.value;
        });


        $doc.on('change', '#product-form #colors, #product-form #brands, #product-form #sizes', function (event) {

            event.preventDefault();

            switch (this.id){

                case "colors":
                    requestProduct.colors = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                case "brands":
                    requestProduct.brands = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                case "sizes":
                    requestProduct.sizes = $(`#${this.id} :selected`).map((_,e) => e.value).get();
                    break;
                default:
                    break;
            }

        });


        $doc.on('change', '#product-form #description', function (event) {

            event.preventDefault();

            response = Validator.validationInput('#product-form', this, '.error-description',
                {
                    requiredText: "{{ __('validation.required', ['attribute' => __('description')]) }}",
                    filterText: "{{ __('validation.min.string', ['attribute' => __('description'), 'min' => 6]) }}"
                }, Validator.isText
            );

            error_desc = response.error;

            requestProduct.description = response.value;
        });


        $doc.on('submit', '#product-form', function (event) {

            event.preventDefault();

            if (error_name === false || error_category === false || error_price === false || error_devise === false || error_image === false || error_type === false || error_desc === false){

                Validator.requiredInput(this, '#name', '.error-name', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.name')]) }}"
                });

                Validator.requiredInput(this, '#price', '.error-price', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.price')]) }}"
                });

                Validator.requiredInput(this, '#category', '.error-category', {
                        requiredText: "{{ __('validation.required', ['attribute' => __('validation.attributes.category')]) }}"
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

            Validator.requestAjax('POST', "{{ route_name('request.product') }}", callback, requestProduct);

            setTimeout(function () {
                canSubmit = true;
            }, 8000);
        });

        function callback(response) {

            if (response.success){

                location.href = `/${Validator.lang}/galleries/product/${response.slug}`;
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
