<?php


namespace App\Services;


use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class ShippingOrderService
{
    /**
     * @param $request
     * @return MessageBag|null
     */
    public function shippingOrderFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->rules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }


    /**
     * @return \string[][]
     */
    protected function rules()
    {
        return [
            'first_name' => ['required','string', 'max:255', 'regex:/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/'],
            'last_name' => ['required','string', 'max:255', 'regex:/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/'],
            'phone' => ['required', Rule::phone()->country([Helper::userLocation()->iso_code])->type('mobile')],
        ];
    }
}
