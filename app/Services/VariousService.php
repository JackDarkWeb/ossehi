<?php


namespace App\Services;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class VariousService
{

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function variousFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->variousRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @return \string[][]
     */
    protected function variousRules()
    {
        return [
            'title' => ['required', 'max:225',  'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'string'],
            'type' => ['required', Rule::in(['announce', 'publicity', 'recruitment']), 'string'],
        ];
    }
}
