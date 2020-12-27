import Helpers from "./Helpers.js";
import Validator from "./Validator.js";

export default class StoreProduct extends Helpers{


    /**
     * Remove and Add the product on the favorite lists
     * @param product
     * @param addRouteName
     * @param destroyRouteName
     * @constructor
     */
    static addOrRemoveProductToFavoriteLists(product, addRouteName, destroyRouteName){

        const dataProduct = $(product).parents('form').find('#product-dt').val(),
              product_id  = $(product).parents('form').find('#product-id').val();

        let requestFavorite = new Object();

        if($(product).is($('.bg-success'))){

            $(product).removeClass('bg-success');

            this.discountFavoriteCount();

            Validator.requestAjax('DELETE', destroyRouteName, function (response) {});

            return;
        }

        $(product).addClass('bg-success');


        requestFavorite.product    = dataProduct;
        requestFavorite.product_id = product_id;

        Validator.requestAjax('POST', addRouteName, function (response) {
            if (response.success){
                StoreProduct.increaseFavoriteCount();
            }
        }, requestFavorite);

    }


    static addOrRemoveProductToCart(product, addRouteName, outDevisePrice){

        let requestCart = new Object();

        const price_total_id = $('.cart-total-price');

        if (product.id === 'btn-added-cart'){

            const dataNewProduct = JSON.parse($(product).parents('form').find('#product-dt').val()),

                  qty = parseInt($(product).parents('form').find('#product-quantity').val()),
                  product_color = $(product).parents('form').find('#product-color').val(),
                  product_size = $(product).parents('form').find('#product-size').val(),

                  price_total_cart_default = this.cleanPrice(price_total_id.html()),

                  price = this.cleanPrice(dataNewProduct.price),

                  total = price_total_cart_default + price*qty;

            requestCart.product_id = dataNewProduct.id;
            requestCart.quantity   = qty;
            requestCart.color      = product_color;
            requestCart.size       = product_size;

            Validator.requestAjax('POST', addRouteName, function (response) {

                if (response.success){

                    price_total_id.html(`${total >= 0 ? (StoreProduct.FormatNumber(total, '2', '.', ' ')) : 0.00} ${outDevisePrice}`);

                    StoreProduct.increaseCartCount(qty);

                    if (StoreProduct.operationCart(dataNewProduct, qty, response.rawId)){

                        StoreProduct.renderNewProductToCart(dataNewProduct, qty, response.rawId);
                    }
                }

            }, requestCart);

            return;
        }



        const rowId = $(product).data('row'),

            product_row_id = $(`.product_${rowId}`),

            price_total_cart_default = this.cleanPrice(price_total_id.html()),

            price_product_remove     = this.cleanPrice(product_row_id.find('#cart-product-price').html()),

            qty_product_remove       = parseInt(product_row_id.find('.cart-product-qty').html()),

            total = price_total_cart_default - (price_product_remove*qty_product_remove);




       Validator.requestAjax('DELETE', `/${this.lang}/shopping/cart/destroy/${rowId}`, function (response) {

           if (response.success){

               product_row_id.remove();

               price_total_id.html(`${ total >= 0 ? (StoreProduct.FormatNumber(total, '2', '.', ' ')) : 0.00} ${outDevisePrice}`)

               StoreProduct.discountCartCount(qty_product_remove);
           }

       });

    }



    /**
     * Check if the product already in the cart
     * @param dataNewProduct
     * @param qty
     * @param rawId
     * @returns {boolean}
     */
    static operationCart(dataNewProduct, qty, rawId){

        const allProductsCart = ($('.dropdown-cart-products').find('form').serialize()).split('&'),

              found  = allProductsCart.find(element => element === `item_${rawId}=${rawId}`),

              product_id = $(`.product_${rawId}`);

        if (found !== undefined){

            const old_qty = parseInt(product_id.find('.cart-product-qty').html()),

                  new_qty = parseInt(qty);

            product_id.find('.cart-product-qty').html(old_qty + new_qty);

            return false;
        }

        return true
    }


    /**
     * Render the new product in the cart
     * @param dataNewProduct
     * @param qty
     * @param rawId
     */
    static renderNewProductToCart(dataNewProduct, qty, rawId){

        const productDetails = $('.dropdown-cart-products');

        productDetails.append(`

            <div class="product product_${rawId}" id="product_${rawId}">

                <div class="product-details">

                    <h4 class="product-title">
                        <a href="${dataNewProduct.url}">${dataNewProduct.title}</a>
                    </h4>

                    <span class="cart-product-info">
                        <span class="cart-product-qty">${qty}</span>
                                x ${dataNewProduct.price} ${dataNewProduct.devise}
                    </span>
                    <span class="d-none" id="cart-product-price">${dataNewProduct.price}</span>

                </div><!-- End .product-details -->

                <figure class="product-image-container">
                    <a href="${dataNewProduct.url}" class="product-image">
                        <img src="${dataNewProduct.image}" alt="product">
                    </a>
                    <a href="#" class="btn-remove" id="btn-remove" data-row="${rawId}"  title="Remove Product"><i class="icon-cancel"></i></a>
                </figure>

                <form>
                     <input type="hidden" id="product-cart-id" name="item_${rawId}" value="${rawId}"/>
                </form>
            </div>

        `);
    }

    /**
     *Counter of products favorites
     * @returns {number}
     */
    static favoriteCount(){
       return parseInt($('#favorite-count').html());
    }

    /**
     * Counter of products in the cart
     * @returns {number}
     */
    static cartCount(){
        return parseInt($('.counter-of-cart').html());
    }


    /**
     *
     * @returns {*|jQuery}
     */
    static increaseFavoriteCount(){

        let x = this.favoriteCount();

        return $('#favorite-count').html(++x);
    }

    /**
     *
     * @returns {*|jQuery}
     */
    static increaseCartCount(qty){

        let x = this.cartCount();

        return $('.counter-of-cart').html(x + parseInt(qty));
    }

    /**
     *
     * @returns {*|jQuery}
     */
    static discountFavoriteCount(){

        let x = this.favoriteCount();

        if (x === 0) return ;

        return $('#favorite-count').html(--x);
    }

    /**
     *
     * @returns {*|jQuery}
     */
    static discountCartCount(qty){

        let x = this.cartCount();

        if (x === 0) return ;

        return $('.counter-of-cart').html(x - parseInt(qty));
    }


    /**
     * Add product to favorite lists in local storage
     * @param index
     * @param product
     */
    static addProductToFavorite(index, product)
    {
        this.setLocalStorage(index, product);
    }

    /**
     * Delete product in favorite lists
     * @param index
     */
    static deleteProductInFavoriteLists(index){
        this.destroyValueLocalStorage(index);
    }










}
