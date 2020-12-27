<?php


namespace App\Repositories\Eloquents;


use App\Repositories\Contracts\ResetPasswordRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ResetPasswordRepository implements ResetPasswordRepositoryContract
{

    /**
     * @param $email
     * @return Model|Builder|object|null
     */
    function findByEmail($email){
        return DB::table("password_resets")->where("email", $email)
                                                 ->first();
    }

    /**
     * @param $token
     * @return Model|Builder|object|null
     */
    function findByToken($token){
        return DB::table("password_resets")->where("token", $token)
                                                 ->first();
    }

    /**
     * @param array $data
     * @return bool
     */
    function create(array $data){
        return DB::table('password_resets')->insert(['email' => $data['email'], 'token' => $data['token']]);
    }

    /**
     * @param array $data
     * @return int
     */
    function update(array $data){
        return DB::table('password_resets')->where($this->username(), $data['email'])->update(['token' => $data['token']]);
    }

    /**
     * @return string
     */
    protected function username(){
        return 'email';
    }

}
