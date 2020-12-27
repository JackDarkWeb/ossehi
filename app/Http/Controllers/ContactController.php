<?php

namespace App\Http\Controllers;

use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    function showContactForm(){

        return view('contact');
    }

    function store(Request $request){

        $errors = $this->contactService->contactFormRequest($request);

        if (!is_null($errors)){
            return response()->json(['success' => false, 'messages' => $errors], 400);
        }

        $this->contactService->sendContactMail($request);

        return response()->json(['success' => true, 'message' => __("Thanks :name, we have received your message. We will get back to you in 24 hours maximum", ['name' => "<strong>{$request->get('name')}</strong>"])], 200);
    }
}
