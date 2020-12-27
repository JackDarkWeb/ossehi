<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Services\Contracts\ResetPasswordServiceContract;
use App\Services\Contracts\UserServiceContract;


class ResetPasswordController extends Controller
{
    /**
     * @var
     */
    protected ResetPasswordServiceContract $resetPasswordService;
    protected UserServiceContract $userService;

    function __construct(ResetPasswordServiceContract $resetPasswordService, UserServiceContract $userService)
    {
        $this->middleware('guest');

        $this->resetPasswordService = $resetPasswordService;
        $this->userService = $userService;
    }

    public function showPasswordResetForm(){

        if(!request()->slug){
            return back();
        }

        if(!$this->resetPasswordService->VerifyResetPasswordLink(request()->slug)){

            return redirect(route_name('home'))->with('notify_generals', __('passwords.token'));
        }

        return view('auth.reset-password',[
            'slug' => request()->slug
        ]);
    }

    public function store(ResetPasswordFormRequest $formRequest){

       $var = $this->resetPasswordService->VerifyResetPasswordLink($formRequest->slug);

        if(!$var){
            return back()->with('notify_generals', __('passwords.token'))->withInput();
        }

        $this->userService->updatePassword($var, $formRequest->get('password'));

        return redirect(route_name('home'))->with('notify_generals', __('passwords.reset'));
    }
}
