<?php


namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class StoreService
{




    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function storeFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->StoreRules());
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
            'name' => ['required', 'string'],
        ];
    }
}
