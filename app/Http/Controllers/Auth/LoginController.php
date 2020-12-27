<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected UserServiceContract $userService;

    function __construct(UserServiceContract $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    public function showLoginForm(){
        return view('auth.login-popup');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    function store(Request $request)
    {
        $errors = $this->userService->loginFormRequest($request);

        if (!is_null($errors)){
            return response()->json(['success' => false, 'email' => $errors->get('email')[0]], 400);
        }

        $user = $this->userService->checkUser($request->get('email'));

        if ($user){

            if (!$this->userService->verificationPassword($user, $request)){
                return response()->json(['success' => false, 'password' => __('auth.password')], 404);
            }
            //dd($this->userService->createSession($user));
            $this->userService->createSession($user);
            return response()->json(['success' => true], 200);
        }

        return response()->json(['success' => false, 'email' => __('auth.user')], 404);
    }
}
