export default class Helpers {

    static $doc = $(document);

    static lang   = $('meta[http-equiv="X-UA-Compatible"]').attr('lang');
    static devise = $('meta[name="csrf-token"]').data('devise').toUpperCase();



    static outDevisePrice(){

        const devises = {
            USD: "$",
            EUR: "€",
            XOF: "XOF",
            UAH: "&#8372;",
            NGN: "&#8358;"
        };
        return devises[Helpers.devise];
    }

    /**
     * Check if the value is empty
     * @param value
     * @returns {boolean}
     */
    static isEmpty(value){

        if (Helpers.isObject(value)){
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

    /**
     * Puts the first letter of the word in uppercase
     * @param value
     * @returns {string}
     */
    static ucfirst(value){
        return value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
    }

    /**
     *
     * @param price
     * @returns {number}
     */
    static cleanPrice(price){

        return parseFloat(price.replace(' ', ''));
    }

    static FormatNumber (number, decimals, decPoint, thousandsSep){

        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

        const n = !isFinite(+number) ? 0 : +number
        const prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
        const sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
        const dec = (typeof decPoint === 'undefined') ? '.' : decPoint
        let s = ''

        const toFixedFix = function (n, prec) {
            if (('' + n).indexOf('e') === -1) {
                return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
            } else {
                const arr = ('' + n).split('e')
                let sig = ''
                if (+arr[1] + prec > 0) {
                    sig = '+'
                }
                return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
            }
        }

        // @todo: for IE parseFloat(0.55).toFixed(0) = 0;

        s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.');

        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
        }

        if ((s[1] || '').length < prec) {
            s[1] = s[1] || ''
            s[1] += new Array(prec - s[1].length + 1).join('0')
        }

        return s.join(dec)
    }

    /**
     * Reset the array
     * @param array
     * @returns {number}
     */
    static resetArray(array){
        array.length = 0;
    }

    /**
     *
     * @param object
     * @returns {Object}
     */
    static resetObject(object){
        object = new Object();
        return object;
    }

    /**
     * Change the devise
     * @param idDevise
     * @returns {string}
     */
    static changeDevise(idDevise){

        switch (idDevise) {
            case 'devise-usd':
                return 'USD';
            case 'devise-eur':
                return 'EUR';
            case 'devise-ua':
                return 'UAH';
            case 'devise-ngn':
                return 'NGN';
            default:
                return 'XOF';
        }
    }

    static requirePrefixPhone(idForm, idInput, indicative){

        if(indicative.length > Helpers.getValue(idForm, idInput).length){
            Helpers.setValue(idForm, idInput, '')
            Helpers.setValue(idForm, idInput, indicative)
        }
    }

    /**
     * set input value
     * @param idForm
     * @param idInput
     * @param value
     */
    static setValue(idForm, idInput, value){
        $(idForm).find(idInput).val(value);
    }

    /**
     * GET value input
     * @param idForm
     * @param idInput
     * @returns {*|string|undefined|jQuery}
     */
    static getValue(idForm, idInput){
        return  $(idForm).find(idInput).val();
    }

    /**
     *
     * @param idContainerHide
     * @param idContainerShow
     */
    static displayContainer(idContainerHide, idContainerShow){
       $(idContainerHide).addClass('d-none');
       $(idContainerShow).removeClass('d-none');
    }

    /**
     *
     * @param idForm
     * @param idInput
     */
    static submitWithEnter(idForm, idInput) {

        Helpers.$doc.on('keypress', `${idForm} ${idInput}`, function (event) {

            if(event.which === 13){

                event.preventDefault();

                $(idForm).find("#submit").click();
            }
        });
    }

    static setLocalStorage(key, value){
        window.localStorage;
        localStorage.setItem(key, value);
    }

    static getValueLocalStorage(key) {
        return localStorage.getItem(key);
    }

    static deleteValueLocalStorage(keys) {
        const array = keys.split(',');
        $.each(array, function (key, value) {
            return localStorage.removeItem(value);
        });
    }

    static destroyValueLocalStorage(key) {
        return localStorage.removeItem(key)
    }

}
