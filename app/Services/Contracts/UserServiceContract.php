<?php


namespace App\Services\Contracts;


interface UserServiceContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function updatePassword($email, $password);

    /**
     * @param $request
     * @return mixed
     */
    public function updateUserWithPassword($request);

    /**
     * @param $request
     * @return mixed
     */
    public function updateUserWithoutPassword($request);


    /**
     * @param $request
     * @return mixed
     */
    public function registerFormRequest($request);

    /**
     * @param $request
     * @return mixed
     */
    public function loginFormRequest($request);


    /**
     * @param $request
     * @return mixed
     */
    public function updateUserFormRequest($request);

    /**
     * @param $request
     * @return mixed
     */
    public function recoveryEmailFormRequest($request);

    /**
     * @param object $user
     * @return mixed
     */
    public function createSession(object $user);

    /**
     * @param $email
     * @return mixed
     */
    public function checkUser($email);

    /**
     * @param $email
     * @return mixed
     */
    public function checkAuthUser($email);

    /**
     * @param $user
     * @param $request
     * @return mixed
     */
    public function verificationPassword($user, $request);
}
