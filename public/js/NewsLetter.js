import Validator from "./Validator.js";
import Helpers from "./Helpers.js";

export default class NewsLetter {

    static request = new Object();

    /**
     *
     * @param idForm
     * @param idInput
     * @param errorClass
     * @param errorsText
     */
    static create(idForm, idInput, errorClass, errorsText){

        const response = Validator.validationInput(idForm, idInput, errorClass, errorsText, Validator.isMail);

        if (!Validator.isEmpty(response.error)){

            this.request.email = response.value;

            Validator.requestAjax('POST', `/${Helpers.lang}/newsletter/create`, function (response) {

                if (response.success){

                    Helpers.setValue(idForm, idInput, '');

                    $(idForm).find(idInput).attr('placeholder', response.message);
                }else{

                    Validator.error(idInput, errorClass, response.message.email[0]);

                }
            }, this.request);
        }
    }

    /**
     *
     * @param value
     */
    static stopNewsLetterPop(value){

        this.request.stop_pop_newsletter = value;

        Validator.requestAjax('POST', `/${Helpers.lang}/helpers/stop-newsletter-pop`, function () {}, this.request)

    }


}
