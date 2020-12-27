<?php


namespace App\Repositories\Contracts;


interface NewsLetterRepositoryContract
{
    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

    /**
     * @param $request
     * @return mixed
     */
    public function create($request);

    /**
     * @param $email
     * @return mixed
     */
    public function stop($email);

}
