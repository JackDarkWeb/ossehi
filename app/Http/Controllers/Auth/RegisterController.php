<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Notifications\SuccessfulRegistration;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;


class RegisterController extends Controller
{
    protected UserServiceContract $userService;

    function __construct(UserServiceContract $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    function store(Request $request)
    {
        $errors = $this->userService->registerFormRequest($request);

        if (!is_null($errors)){

            return response()->json(['success' => false, 'messages' => $errors], 400);
        }

        $user = $this->userService->create($request);

        $this->userService->createSession($user);

        // Notify the user when he registers
        $user->notify(new SuccessfulRegistration());

        return  response()->json(['success' => true], 201);
    }
}
