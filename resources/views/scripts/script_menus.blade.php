<script type="module">

    $(function () {

        const $doc = $(document);

        $doc.on('change', '#menus-form #menus', function (event) {

            event.preventDefault();

            const $menusForm = $('#menus-form'),
                $menu = $(this).val();

            switch ($menu){

                case "store":

                    $menusForm.find('#create-store').click();
                    $menusForm.find('.close').click();
                    break;

                case "product":

                    $menusForm.find('#create-product').click();
                    $menusForm.find('.close').click();
                    break;

                case "announce":

                    $menusForm.find('#create-announce').click();
                    $menusForm.find('.close').click();
                    break;
            }
        });
    });

</script>
