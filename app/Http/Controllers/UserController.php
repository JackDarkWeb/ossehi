<?php

namespace App\Http\Controllers;


use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserServiceContract $userService;

    function __construct(UserServiceContract $userService)
    {
        $this->middleware('auth');

        $this->userService = $userService;
    }

    public function updateUser(Request $request)
    {
        $errors = $this->userService->updateUserFormRequest($request);

        if (!is_null($errors)){

            return response()->json(['success' => false, 'messages' => $errors], 400);
        }

        $user = $this->userService->checkAuthUser($request->get('email'));

        if (!$user){

            // Check if the mail belongs to another person
            $other_user = $this->userService->checkUser($request->get('email'));

            if ($other_user){

                return response()->json(['success' => false, 'email' => __('validation.user')]);
            }
        }

        if ($request->get('change_password'))
        {
            $this->userService->updateUserWithPassword($request);

        }else{

            $this->userService->updateUserWithoutPassword($request);
        }
        return response()->json(['success' => true, 'message' => __('auth.update')], 200);
    }
}
