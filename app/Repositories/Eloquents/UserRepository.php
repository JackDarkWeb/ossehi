<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Auth;
use App\Helpers\Helper;
use App\Repositories\Contracts\UserRepositoryContract;
use App\User;


class UserRepository implements UserRepositoryContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function createUser($request)
    {

        return User::create([
            'email' => $request->get('email'),
            'password' => sha1($request->get('password')),
            'notify' => (bool)$request->get('notify'),
            'location' => json_encode(Helper::userLocation(), true),
        ]);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {

        return User::where('email', $email)->first();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function findByIdAndEmail($email)
    {

        return User::where('email', $email)->where('id', Auth::id())->first();
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function updatePassword($email, $password)
    {

        return User::where('email', $email)->update(['password' => sha1($password)]);
    }

    public function updateWithPassword($request)
    {

        return User::where('id', Auth::id())->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'password' => sha1($request->get('password')),
        ]);
    }

    public function updateWithoutPassword($request)
    {

        return User::where('id', Auth::id())->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
        ]);
    }

    /**
     * @return mixed
     */
    public function count()
    {
        return User::count();
    }
}
