
export default class Validator {

    static lang = $('meta[http-equiv="X-UA-Compatible"]').attr('lang');



    /**
     * Show the error if it exist
     * @param idInput
     * @param errorClass
     * @param text
     * @returns {*}
     */
    static error = (idInput, errorClass, text) => {

        setTimeout(function(){
            return $(idInput).prev(errorClass).html(text).show();
        }, 1000);
        return  $(idInput).prev(errorClass).html(`${this.lang === 'fr' ? 'Vérification ...' : 'Checking ...'}`).show();
    }

    /**
     * Clear the error if it exist
     * @param idInput
     * @param errorClass
     * @returns {*}
     */
    static clearError = (idInput, errorClass) => {

        setTimeout(function () {
            return $(errorClass).hide();
        }, 1000);
        return $(idInput).prev(errorClass).html(`${this.lang === 'fr' ? 'Vérification ...' : 'Checking ...'}`).show();
    }

    /**
     * Check if the value is phone
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isPhone(idForm, idInput){
        return /(^\+[0-9]{3}|^00[0-9]{3})([0-9]{8,9}$)/.test(Validator.getValue(idForm, idInput));
    }

    /**
     * Check if the value is integer
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isInteger(idForm, idInput){
        return /^[0-9]+$/.test(Validator.getValue(idForm, idInput));
    }

    /**
     * Check if the value is float
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isFloat(idForm, idInput){
        return /((^[0-9]+\.[0-9]+$)|(^[0-9]+$))/.test(Validator.getValue(idForm, idInput));
    }

    /**
     * Check if the value is name
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isName(idForm, idInput){
        return /^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/.test(Validator.getValue(idForm, idInput));
    }

    /**
     * Check if the value is mail
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isMail(idForm, idInput){
        return /(^[a-z0-9]+)@([a-z0-9])+(\.)([a-z]{2,4})/.test(Validator.getValue(idForm, idInput));
    }

    /**
     * Check if the value is string
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isString(idForm, idInput){
       return /^[a-zA-Zçéèêëíìîïñóòôöõúùûüýÿæàâ0-9 ,/|_;().:?\-#$%@&]+$/.test(Validator.getValue(idForm, idInput));
    }

    /**
     *
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isText(idForm, idInput){
        let value = Validator.getValue(idForm, idInput);
        return value.length > 6;
        //return (/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ0-9 ,\-#$%@&]+$/.test(value) && value.length > 6);
    }


    /**
     * Check if the password value contain 6 characters
     * and must contain uppercase, lowercase and number
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static isPassword(idForm, idInput){
        let value = Validator.getValue(idForm, idInput);
        return !(!/[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ]/.test(value) || !/[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ]/.test(value) || !/[0-9]/.test(value) || value.length < 6);
    }



    /**
     * GET value input
     * @param idForm
     * @param idInput
     * @returns {*|string|undefined|jQuery}
     */
    static getValue(idForm, idInput){
        return  ($(idForm).find(idInput).val()).trim();
    }

    /**
     * GET ALL VALUES SELECTED IN INPUT
     * @param idInput
     * @returns {jQuery}
     */
    static getSelectedValues(idInput){
        return $(`${idInput} :selected`).map((_,e) => e.value).get();
    }

    /**
     * get valid value input
     * @param idForm
     * @param idInput
     * @param funcValidValue
     * @returns {*|string|undefined|jQuery|null}
     */
    static getValidValue(idForm, idInput, funcValidValue){
        if (funcValidValue(idForm, idInput))
            return Validator.getValue(idForm, idInput);
        return null;
    }

    /**
     * Check if the input checkbox
     * @param idForm
     * @param idInput
     * @returns {boolean}
     */
    static checkBoxInput(idForm, idInput){
        return $(idForm).find(idInput).is($('input:checked'));
    }

    /**
     *
     * @param method
     * @param url
     * @param func_callback
     */
    static requestAjaxElementary(method, url, func_callback){

        let formData = new FormData(),
            property = $('input[name="file"]').prop('files')[0];
            formData.append('file', property);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: url,
            method: method,
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: func_callback
        });
    }

    /**
     *
     * @param input
     * @param idSrc
     * @param size
     * @param extensions
     * @param errorClass
     * @param errorsText
     * @returns {{error: number}}
     */
    static uploadFile(input, idSrc, size, extensions = [], errorClass, errorsText = {filterTypeText: '', filterSizeText: ''}) {

        if (input.files && input.files[0]) {

            let reader = new FileReader(),
                extension  = input.files[0].name.split('.').pop().toLocaleLowerCase();

            if(jQuery.inArray(extension, extensions) < 0){

                Validator.error(input, errorClass, errorsText.filterTypeText);

                return {error: 1};
            }

            if(input.files[0].size >= size){

                Validator.error(input, errorClass, errorsText.filterSizeText);

                return {error: 1};
            }

            reader.onload = function (e) {

                $(idSrc).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);

            return {error: 0}
        }

    }

    /**
     * Make the request Ajax
     * @param method
     * @param url
     * @param dynamic_function
     * @param data
     */
    static requestAjax(method, url, dynamic_function, data = []) {

        if(method === 'GET' || method === 'get'){
            fetch(
                url,
                {
                    headers: {
                        "Content-Type":"application/json",
                        "Accept":"application/json, text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                }
            ).then(response => response.json())

                .then(response => {

                    dynamic_function(response);

                }).catch(error => {
                console.log(error)
            });

        }else{

            fetch(
                url,
                {
                    headers: {
                        "Content-Type":"application/json",
                        "Accept":"application/json, text-plain, */*",
                        "X-Requested-With":"XMLHttpRequest",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                    body: JSON.stringify(data),
                }
            ).then(response => response.json())

                .then(response => {

                    dynamic_function(response);

                }).catch(error => {
                console.log(error)
            });
        }

    }

    /**
     *
     * @param idForm
     * @param idInput
     * @param errorClass
     * @param errorsText
     * @param funcValidValue
     * @returns {{error: boolean, value: string}}
     */
    static validationInput(idForm, idInput, errorClass, errorsText = {requiredText: '', filterText: ''}, funcValidValue){

        let error,
            value = Validator.getValue(idForm, idInput);
        if(Validator.isEmpty(value)){
            Validator.error(idInput, errorClass, errorsText.requiredText);
            error = false;
        }else if(!funcValidValue(idForm, idInput)){
            Validator.error(idInput, errorClass, errorsText.filterText);
            error = false;
        }else{
            Validator.clearError(idInput, errorClass);
            error = true;
        }

        return {value: value, error: error};
    }

    /**
     * Check if the input is empty
     * @param idForm
     * @param idInput
     * @param errorClass
     * @param errorText
     */
    static requiredInput(idForm, idInput, errorClass, errorText = {'requiredText' : ''}) {
        if (Validator.isEmpty(Validator.getValue(idForm, idInput)))
            return Validator.error(idInput, errorClass, errorText.requiredText);
    }

    /**
     * Confirm the password
     * @param idForm
     * @param idPass
     * @param idConfirmPass
     * @param errorClass
     * @param errorText
     * @returns {boolean}
     */
    static confirmPassword(idForm, idPass, idConfirmPass, errorClass, errorText = {'confirmText' : ''}){
        let error;
        if (Validator.getValue(idForm, idPass) !== Validator.getValue(idForm, idConfirmPass)){
            Validator.error(idConfirmPass, errorClass, errorText.confirmText);
            error = false;
        }else {
            Validator.clearError(idConfirmPass, errorClass);
            error = true;
        }
        return error;
    }



    /**
     * Check if the value is empty
     * @param value
     * @returns {boolean}
     */
    static isEmpty(value){

        if (Validator.isObject(value)){
            return Object.keys(value).length === 0;
        }
        return (typeof value === 'undefined' ||
            value === null ||
            value === 0 ||
            value === "" ||
            value === "0" ||
            value === false
        );
    }

    /**
     * Check if the value is Object
     * @param value
     * @returns {boolean}
     */
    static isObject(value){
        return value instanceof Object && !Array.isArray(value);
    }

}
