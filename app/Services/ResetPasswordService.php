<?php


namespace App\Services;


use App\Mail\ResetPasswordEmail;
use App\Repositories\Contracts\ResetPasswordRepositoryContract;
use App\Services\Contracts\ResetPasswordServiceContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordService implements ResetPasswordServiceContract
{
    protected ResetPasswordRepositoryContract $resetPasswordRepository;

    public function __construct(ResetPasswordRepositoryContract $resetPasswordRepository)
    {
        $this->resetPasswordRepository = $resetPasswordRepository;
    }

    /**
     * @param $token
     * @return Model|Builder|object|null
     */
    function verificationToken($token){

        $user = $this->resetPasswordRepository->findByToken($token);

        if($user){
            return $user;
        }
        return null;
    }

    /**
     * @param array $data
     * @return bool
     */
    function stockResetPasswordToken(array $data){

        $count = $this->resetPasswordRepository->findByEmail($data['email']);

        if($count)

            return $this->resetPasswordRepository->update($data);

        return $this->resetPasswordRepository->create($data);
    }

    /**
     * @param $token
     * @return mixed|string|null
     */
    function VerifyResetPasswordLink($token){

        $count = $this->resetPasswordRepository->findByToken($token);

        if (is_null($count)){
            return null;
        }

        $code = Crypt::decryptString($token);
        $detach = explode('e-ossehi',$code);
        $time   = $detach[1];
        $var    = end($detach);

        $expire_time = strtotime('+1 day', $time);

        if((time() > $expire_time)){
            return null;
        }
        return $var;
    }

    public function sendResetPasswordLink($email, $token){

        Mail::to($email)->send(new ResetPasswordEmail($token));
    }

    /**
     * @param string $var
     * @return string
     */
    public function getUniqueToken(string $var)
    {
        $code = Str::random();
        $time = time();
        return Crypt::encryptString("{$code}e-ossehi{$time}e-ossehi{$var}");
    }


}
