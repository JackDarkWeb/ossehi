<?php


namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class StoreProductService
{

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function storeProductFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->StoreRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function storeProductUpdateFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->updateRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @return \string[][]
     */
    protected function storeRules()
    {
        return [

            'title' => ['required', 'max:225', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'regex:/((^[0-9]+\.[0-9]+$)|(^[0-9]+$))/'],
            'devise' => ['required', Rule::in(['USD', 'EUR', 'XOF', 'UAH', 'NGN' ]), 'string'],
            'image' => ['required', 'string'],
            'colors' => ['array'],
            'sizes' => ['array'],
            'brands' => ['array'],
        ];
    }


    /**
     * @return \string[][]
     */
    protected function updateRules()
    {
        return [

            'title' => ['required', 'max:225', 'string'],
            'description' => ['required', 'string'],
            'price' => ['regex:/((^[0-9]+\.[0-9]+$)|(^[0-9]+$))/'],
            'devise' => [ Rule::in(['USD', 'EUR', 'XOF', 'UAH', 'NGN' ]), 'string'],
            'image' => ['required', 'string'],
            'colors' => ['array'],
            'sizes' => ['array'],
            'brands' => ['array'],
        ];
    }
}
