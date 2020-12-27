import Validator from "./Validator.js";
import Helpers from "./Helpers.js";

export default class ShippingForm {

    static request = new Object();
    static idStateShipping = $('#state-shipping');

    /**
     * Get the states of the country selected
     * @param country
     * @param routeName
     * @param default_state
     */
    static getStates(country, routeName, default_state){

        this.request.country = country;

         Validator.requestAjax('POST', routeName, function (response) {
            ShippingForm.renderStates(response, default_state);
        }, this.request)
    }

    /**
     * Render the html
     * @param response
     * @param default_state
     */
    static renderStates(response, default_state){

        this.idStateShipping.empty();

        Object.entries(response.states).forEach(entry => {

            const [key, value] = entry;

            ShippingForm.idStateShipping.append(`<option value="${value}" ${value === default_state ? 'selected' : ''}>${value}</option>`);
        });
    }

}
