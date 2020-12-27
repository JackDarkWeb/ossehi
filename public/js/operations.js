$(function () {

    const token = $('meta[name="csrf-token"]').attr('content'),
          cart_dropdown   = $('#cart-dropdown'),
          tbody           = $('#body-detail-cart'),
          tbody_mini_cart = $('.table-mini-cart').find('tbody'),
          count_favorite  = $('#count-favorite'),
          filter_search   = $('#filter-search'),
          state_shipping_select = $('#state-shipping');

    let qty = 1,
        //color = ($('.config-swatch-list').find('li > a').attr('style')).split(':')[1],
        color = "#fca309",
        size  = "M",
        brand = 'Adidas',
        country = $('#country-shipping').val(),

        min_price_default = $('#min-price').val(),
        max_price_default = $('#max-price').val();




    load_cart();
    load_detail_cart();
    load_mini_cart();
    get_states(country);
    get_count_favorite();

// select the color product
$(document).on('click', '.config-swatch-list > li > a', function (e) {
    e.preventDefault();

    color = $(this).attr('style');
    color = (color.split(':')).pop();
    $(this).parent().addClass('active').siblings().removeClass('active');

    const data = {
        "color":color,
        "size":size,
        "brand":brand,
        "min_price":min_price_default,
        "max_price":max_price_default
    };
    get_response_search(data, 'POST');
});

//select the size product

$(document).on('click', '.config-size-list > li > a', function (e) {
    e.preventDefault();
    size = $(this).html();
    $(this).parent().addClass('active').siblings().removeClass('active');

    const data = {
        "color":color,
        "size":size,
        "brand":brand,
        "min_price":min_price_default,
        "max_price":max_price_default
    };

    get_response_search(data, 'POST');
});

//select the brand product
$(document).on('click', '.config-brands-list > li > a', function (e) {
    e.preventDefault();
    $(this).parent().addClass('active').siblings().removeClass('active');
    brand = $(this).attr('href').replace(/[_\W]+/g,'');

    const data = {
        "color":color,
        "size":size,
        "brand":brand,
        "min_price":min_price_default,
        "max_price":max_price_default
    };

    get_response_search(data, 'POST');
});

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT TO FILTER PRODUCT IN SEARCH
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('submit', '#form-price-filter', function (e) {
    e.preventDefault();
    const rang = $(this).find('#filter-price-range').html(),
        str_min_price = rang.split('-')[0],
        str_max_price = rang.split('-')[1],
        min_price     = str_min_price.replace(/[_\W]+/g, ""),
        max_price     = str_max_price.replace(/[_\W]+/g, "");
    $('#min-price').val(min_price);
    $('#max-price').val(max_price);
    const data = {
        "color":color,
        "size":size,
        "brand":brand,
        "min_price":min_price,
        "max_price":max_price
    };

    get_response_search(data, 'POST');

});




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT ADD PRODUCT AND DELETE TO LIST FAVORITE
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', '#add-to-favorite', function (e) {
    e.preventDefault();

    const product_id = $(this).parents('form').find('#product-id').val(),

          data = {
            'product_id':product_id
           };

    if($(this).is($('.bg-success'))){

        const route = $(this).parents('form').data('delete');
        $(this).removeClass('bg-success');

        delete_product_to_favorite('DELETE', route, data);
        get_count_favorite();

    }else{

        const route = $('meta[name="csrf-token"]').data('favorite');
        $(this).addClass('bg-success');

        add_product_to_favorite('POST', route, data);
        get_count_favorite();
    }


});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT SELECT COUNTRY FOR ESTIMATE SHIPPING
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).on('change', '#country-shipping', function (e) {
    e.preventDefault();

    country = $(this).val();
    get_states(country);
});



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT UPDATE PRODUCT IN THE CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    let canProductUpdateCart = true;

    // Take the quantity

    $(document).on('change', '#product-update-quantity', function () {
        qty = parseInt($(this).val());
    });

    $(document).on('submit', '#product-form-update-cart', function (e) {
        e.preventDefault();

        if(!canProductUpdateCart) return;

        const url      = $(this).attr('action'),
            redirect   = $('meta[name="csrf-token"]').data('cart'),
            product_id = parseInt($(this).find('#product-id').val()),

            data = {
                "product_id":product_id,
                "color":color,
                "qty":qty
            };

        requestAjax('PUT', url, data);

        // Prevent new product from being added
        canProductUpdateCart = false;

        load_cart();
        location.href = redirect;
        // Allow a new product to be added after 5 seconds
        setTimeout(function(){
            canProductUpdateCart = true;
        }, 5000);


    });






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT DELETE PRODUCT IN THE DETAIL CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $(document).on('click', '#product-action-row .btn-remove', function (e) {
        e.preventDefault();
        const rowId = $(this).data("content"),
            route   = $(this).data('action'),
            data = {
                "rowId":rowId
            };

        fetch(
            route,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: "DELETE",
                body: JSON.stringify(data),
            }
        ).then(data => data.json())

            .then(data => {
                load_detail_cart();
                load_cart();

            }).catch(error => {
            console.log(error)
        });


    });


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT  ADD PRODUCT  IN THE CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    let canProductAddCart = true;

    // Take the quantity

    $(document).on('change', '#product-quantity', function () {
        qty = parseInt($(this).val());
    });

    $(document).on('submit', '#product-form-add-cart', function (e) {
        e.preventDefault();

        if(!canProductAddCart) return;

        const url      = $(this).attr('action'),
            product_id = parseInt($(this).find('#product-id').val()),
            data = {
                "product_id":product_id,
                "color":color,
                "qty":qty
            };

        requestAjax('POST', url, data);

        // Prevent new product from being added
        canProductAddCart = false;

        load_cart();

        // Allow a new product to be added after 5 seconds
        setTimeout(function(){
            canProductAddCart = true;
        }, 5000);

    });



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT  ADD PRODUCT QUICK VIEW IN THE CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    let canQuickViewAddCart = true;

    // Take the quantity
    $(document).on('change', '#quick-view-quantity', function () {
        qty = parseInt($(this).val());
    });


    $(document).on('submit', '#product-quick-view-form-add-cart', function (e) {
        e.preventDefault();

        if(!canQuickViewAddCart) return;

        const url      = $(this).attr('action'),
            product_id = parseInt($(this).find('#product-id').val()),
            data = {
                "product_id":product_id,
                "color":color,
                "qty":qty
            };

        requestAjax('POST', url, data);

        // Prevent new product from being added
        canQuickViewAddCart = false;

        load_cart();

        // Allow a new product to be added after 5 seconds
        setTimeout(function(){
            canQuickViewAddCart = true;
        }, 5000);
    });




/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT HOME ADD PRODUCT IN THE CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    let canHomeAddCart = true;

    $(document).on('submit', '#home-form-add-cart', function (e) {
        e.preventDefault();

        if(!canHomeAddCart) return;

        const url      = $(this).attr('action'),
            qty      = 1,
            product_id = parseInt($(this).find('#product-id').val()),
            data = {
                "product_id":product_id,
                "qty":qty,
            };
        requestAjax('POST', url, data);

        // Prevent new product from being added
        canHomeAddCart = false;

        //refresh the cart
        load_cart();

        // Allow a new product to be added after 5 seconds
        setTimeout(function(){
            canHomeAddCart = true;
        }, 5000);
    });



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT REFRESH CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    // Automatically refresh the shouts every 20 seconds
    //setInterval(load_cart,1000);


    // Fetch the latest cart
    function load_cart(){

        const url   = $('meta[name="csrf-token"]').data('fetch');

        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
            }
        ).then(response => response.json())

            .then(response => {
                cart_dropdown.empty();

                cart_dropdown.append(response);

            }).catch(error => {
            console.log(error)
        });
    }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ANOTHER PART OF SCRIPT DELETE PRODUCT IN THE CART
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $(document).on('click', '#cart-dropdown .btn-remove', function (e) {
        e.preventDefault();
        const rowId = $(this).data("content"),
            route   = $(this).data('route'),
            data = {
                "rowId":rowId
            };

        fetch(
            route,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: "DELETE",
                body: JSON.stringify(data),
            }
        ).then(data => data.json())

            .then(data => {

                load_cart();
                load_mini_cart();

            }).catch(error => {
            console.log(error)
        });


    });




    // Fetch the latest detail cart
    function load_detail_cart(){

        const url   = $('meta[name="csrf-token"]').data('fetch-detail-cart');


        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method:"GET"
            }
        ).then(response => response.json())

            .then(response => {
                tbody.empty();

                tbody.append(response);

            }).catch(error => {
            console.log(error)
        });
    }



    // Fetch the detail in mini-cart
    function load_mini_cart(){

        const url   = $('meta[name="csrf-token"]').data('fetch-detail-mini-cart');


        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method:"GET"
            }
        ).then(response => response.json())

            .then(response => {
                tbody_mini_cart.empty();

                tbody_mini_cart.append(response);

            }).catch(error => {
            console.log(error)
        });
    }

    // GET STATES BY COUNTRY
    function get_states(country){

        const url   = $('meta[name="csrf-token"]').data('states'),
              data  = {
                   "country":country
              };

        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method:"POST",
                body: JSON.stringify(data),
            }
        ).then(response => response.json())

            .then(response => {

                state_shipping_select.empty();
                state_shipping_select.append(response);

            }).catch(error => {
            console.log(error)
        });
    }


    // GET DATA SEARCH PRODUCT

    function get_response_search(data,method) {

        const url   = $('meta[name="csrf-token"]').data('search');

        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method:method,
                body: JSON.stringify(data)
            }
        ).then(response => response.json())

            .then(response => {

                filter_search.empty();
                filter_search.append(response);

            }).catch(error => {
            console.log(error);
        });
    }

    // GET COUNT FAVORITE
    function get_count_favorite(){

        const url   = $('meta[name="csrf-token"]').data('count-favorite');


        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method:"GET",
            }
        ).then(response => response.json())

            .then(response => {

                count_favorite.empty();
                count_favorite.append(response.count);

            }).catch(error => {
            console.log(error);
        });
    }

    // Allows to recover the selected inputs
    function get_filter(class_name) {
        let values = [];
        $('.'+class_name+':checked').each(function () {
            values.push($(this).val());
        });
        return values;
    }

    function add_product_to_favorite(method, route, data) {
        return requestAjax(method, route, data);
    }

    function delete_product_to_favorite(method, route, data) {
        return requestAjax(method, route, data);
    }

    function requestAjax(method, url, data) {

        fetch(
            url,
            {
                headers: {
                    "Content-Type":"application/json",
                    "Accept":"application/json, text-plain, */*",
                    "X-Requested-With":"XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: method,
                body: JSON.stringify(data),
            }
        ).then(data => data.json())

            .then(data => {
                console.log(data);
                return true;
            }).catch(error => {
            console.log(error)
        });
    }

});
