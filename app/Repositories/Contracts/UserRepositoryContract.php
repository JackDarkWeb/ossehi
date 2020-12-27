<?php

namespace App\Repositories\Contracts;

interface UserRepositoryContract
{
    /**
     * @param $request
     * @return mixed
     */
    public function createUser($request);

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

    /**
     * @param $email
     * @return mixed
     */
    public function findByIdAndEmail($email);

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
    public function updateWithPassword($request);

    /**
     * @param $request
     * @return mixed
     */
    public function updateWithoutPassword($request);

    /**
     * @return mixed
     */
    public function count();
}
