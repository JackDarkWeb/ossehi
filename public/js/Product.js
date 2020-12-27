import Validator from "./Validator.js";
import Helpers from "./Helpers.js";

export default class Product extends Helpers{

    static response = new Object();

    /**
     *
     * @param idForm
     * @param idInput
     * @param idInputCompare
     * @param errorClass
     * @param errorsText
     * @param errorTextMore
     * @returns {{error: boolean, value: *}|{error: *, value: *}}
     */
    static discountPrice(idForm, idInput, idInputCompare, errorClass, errorsText, errorTextMore){

        const old_price = parseFloat(Validator.getValue(idForm, idInputCompare));

        this.response = Validator.validationInput(idForm, idInput, errorClass, errorsText, Validator.isFloat);

        if (this.response.error){

            if (this.response.value < old_price){

                Validator.clearError(idInput, errorClass);

                return {value: this.response.value, error: this.response.error, route: $(idForm).attr('action')};
            }

            Validator.error(idInput, errorClass, errorTextMore);

            return {value: this.response.value, error: false};
        }


        return {value: this.response.value, error: this.response.error};
    }

    /**
     *
     * @param old_price
     * @param discount_price
     */
    static renderBoxPrice(old_price, discount_price = null){

        const priceBoxId = $(`#price-box${$('#discount-form').data('id')}`);

        priceBoxId.empty();

        priceBoxId.append(`
             <span class="old-price">${old_price}</span>
             <span class="product-price ${discount_price ? '' : 'd-none'}">${discount_price}</span>
        `);
    }

    static renderBtnCancelDiscount(routeName, text = 'Cancel discount'){

        const btnCancelId = $(`#btn-cancel-discount${$('#discount-form').data('id')}`);

        btnCancelId.empty();

        btnCancelId.append(`
            <span class="btn-icon btn-add-cart cancel-discount"  title="${text}" data-action="${routeName}"><i class="fas fa-percent"></i>${text.toUpperCase()}</span>
        `);

    }


}
