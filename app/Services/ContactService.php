<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

class ContactService
{



    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function contactFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->rules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     */
    public function sendContactMail($request){
        Mail::to(config('mail.from.address'))->send(new ContactEmail($request));
    }

    /**
     * @return \string[][]
     */
    protected function rules()
    {
        return [
            'name' => ['required','string', 'max:255', 'regex:/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/'],
            'email' => ['required','email:rfc,dns,filter'],
            'phone' => ['required', Rule::phone()->country([Helper::userLocation()->iso_code])->type('mobile')],
            'message' => ['required', 'min:5']
        ];
    }
}
