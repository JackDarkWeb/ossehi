<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

interface ResetPasswordRepositoryContract
{
    /**
     * @param $email
     * @return Model|Builder|object|null
     */
    function findByEmail($email);

    /**
     * @param $token
     * @return Model|Builder|object|null
     */
    function findByToken($token);

    /**
     * @param array $data
     * @return bool
     */
    function create(array $data);

    /**
     * @param array $data
     * @return int
     */
    function update(array $data);
}
