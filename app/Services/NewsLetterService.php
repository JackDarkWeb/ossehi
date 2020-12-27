<?php


namespace App\Services;



use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class NewsLetterService
{

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function newsLetterFormRequest($request)
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
            'email' => ['required','email:rfc,dns,filter', 'unique:news_letters'],
        ];
    }
}
