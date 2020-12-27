<script type="module">

    import StoreProduct from "{{ asset('js/StoreProduct.js') }}"

    $(function () {

        const $doc = $(document);

        $doc.on('click', '#add-to-favorite', function (event)
        {
            event.preventDefault();

            const destroyRouteName = $(this).parents('form').data('action');

            StoreProduct.addOrRemoveProductToFavoriteLists(this, "{{ route_name('add.favorite.product') }}", destroyRouteName);
        });


        $doc.on('click', '.config-swatch-list > li > a', function (event) {

            event.preventDefault();

            const color = $(this).attr('style'),
                color_value = (color.split(':')).pop();

            $('#cart-operation-store-form').find('#product-color').val(color_value);

            $(this).parent().addClass('active').siblings().removeClass('active');
        });


        $doc.on('click', '.config-size-list > li > a', function (event) {

            event.preventDefault();

            const size_value = $(this).html();

            $('#cart-operation-store-form').find('#product-size').val(size_value);

            $(this).parent().addClass('active').siblings().removeClass('active');
        });



        $doc.on('click', '#btn-added-cart, #btn-remove', function (event) {

            event.preventDefault();

            const addRouteName     = "{{ route_name('cart.add') }}",
                  outDevisePrice   = "{{ Cookie::get('devise') ?? 'USD' }}";

            StoreProduct.addOrRemoveProductToCart(this, addRouteName, outDevisePrice);

        });

    });

</script>
