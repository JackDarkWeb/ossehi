<?php


namespace App\Helpers;


use App\User;
use Illuminate\Support\Facades\Session;

class AuthHelperFacade
{

    /**
     * @return object|null
     */
    function user(){

        if (Session::has('auth')){
            return User::where('email', Session::get('auth')['email'])->first();
        }
        return null;
    }

    /**
     * @return mixed
     */
    function id(){
        return $this->user()->id ?? null;
    }

    /**
     * @return bool
     */
    function is(){
        if (is_null($this->user()))
            return false;
        return true;
    }
}
