<?php


namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class ProductService
{

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function productFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->productRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function productUpdateFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->productUpdateRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @return \string[][]
     */
    protected function productRules()
    {
        return [
            'category' => ['required', 'integer'],
            'title' => ['required', 'max:225', 'string'],
            'description' => ['required', 'string'],
            'price' => ['required', 'regex:/((^[0-9]+\.[0-9]+$)|(^[0-9]+$))/'],
            'devise' => ['required', Rule::in(['USD', 'EUR', 'XOF', 'UAH', 'NGN' ]), 'string'],
            'image' => ['required', 'string'],
            'type' => ['required', Rule::in(['simple', 'vip']), 'string'],
            'colors' => ['array'],
            'sizes' => ['array'],
            'brands' => ['array'],
        ];
    }

    /**
     * @return \string[][]
     */
    protected function productUpdateRules()
    {
        return [
            'category' => ['required', 'integer'],
            'title' => ['required', 'max:225', 'string'],
            'description' => ['required', 'string'],
            'price' => ['regex:/((^[0-9]+\.[0-9]+$)|(^[0-9]+$))/'],
            'devise' => [Rule::in(['USD', 'EUR', 'XOF', 'UAH', 'NGN' ]), 'string'],
            'image' => ['required', 'string'],
            'type' => ['required', Rule::in(['simple', 'vip']), 'string'],
            'colors' => ['array'],
            'sizes' => ['array'],
            'brands' => ['array'],
        ];
    }
}
