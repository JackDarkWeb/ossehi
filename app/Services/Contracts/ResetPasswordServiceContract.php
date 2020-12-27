<?php


namespace App\Services\Contracts;


interface ResetPasswordServiceContract
{
    /**
     * @param $token
     * @return mixed
     */
    public function verificationToken($token);

    /**
     * @param array $data
     * @return mixed
     */
    public function stockResetPasswordToken(array $data);

    /**
     * @param $token
     * @return mixed
     */
    public function VerifyResetPasswordLink($token);

    /**
     * @param string $var
     * @return mixed
     */
    public function getUniqueToken(string $var);

    /**
     * @param $email
     * @param $token
     * @return mixed
     */
    public function sendResetPasswordLink($email, $token);


}
