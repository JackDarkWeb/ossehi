<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Contracts\ResetPasswordServiceContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /**
     * @var
     */
    protected UserServiceContract $userService;
    protected ResetPasswordServiceContract $resetPasswordService;

    function __construct(UserServiceContract $userService, ResetPasswordServiceContract $resetPasswordService)
    {
        $this->middleware('guest');

        $this->userService = $userService;
        $this->resetPasswordService = $resetPasswordService;

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    function store(Request $request){

        $errors = $this->userService->recoveryEmailFormRequest($request);

        if (!is_null($errors)){

            return response()->json(['success' => false, 'email' => $errors->get('email')[0]], 400);
        }

        $user = $this->userService->checkUser($request->get('email'));

        if ($user){

            $token = $this->resetPasswordService->getUniqueToken($request->get('email'));

            $this->resetPasswordService->stockResetPasswordToken(['email' => $request->get('email'), 'token' => $token]);

            $this->resetPasswordService->sendResetPasswordLink($request->get('email'), $token);

            return response()->json(['success' => true, 'message' => __('passwords.sent')], 200);
        }
        return response()->json(['success' => false, 'email' => __('auth.user')], 404);
    }
}
