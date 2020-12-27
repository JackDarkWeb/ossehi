<script type="module">
    import Validator from "{{ asset('js/Validator.js') }}";

    $(function () {

        const $doc = $(document);

        let routeName;


        $doc.on('click', '.destroy-product, .destroy-store, .destroy-store-product, .destroy-various', function (event) {

            event.preventDefault();

            routeName = $(this).attr('href');

            Validator.requestAjax('DELETE', routeName, function (response) {

                if (response.success){

                    location.href = '';
                }
            });

        });
    });
</script>
