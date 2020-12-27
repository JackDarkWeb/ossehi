<?php


namespace App\Services;



use App\Repositories\Contracts\UserRepositoryContract;
use App\Services\Contracts\UserServiceContract;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class UserService implements UserServiceContract
{

    protected UserRepositoryContract $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return $this->userRepository->createUser($request);
    }


    public function updateUserWithPassword($request)
    {
        return $this->userRepository->updateWithPassword($request);
    }

    public function updateUserWithoutPassword($request)
    {
        return $this->userRepository->updateWithoutPassword($request);
    }

    /**
     * @param $email
     * @param $password
     * @return mixed
     */
    public function updatePassword($email, $password)
    {
        return $this->userRepository->updatePassword($email, $password);
    }

    /**
     * Return null if not found user
     * @param $email
     * @return mixed
     */
    public function checkUser($email)
    {
        return $this->userRepository->findByEmail($email);
    }

    /**
     * Return null if not found user
     * @param $email
     * @return mixed
     */
    public function checkAuthUser($email)
    {
        return $this->userRepository->findByIdAndEmail($email);
    }

    /**
     * @param $user
     * @param $request
     * @return bool|mixed
     */
    public function verificationPassword($user, $request){
        return $user->password === sha1($request->get('password'));
    }

    /**
     * @param object $user
     * @return bool|mixed
     */
     public function createSession(object $user){
         //return $user->email;
        Session::put('auth', [
            'id' => $user->id,
            'email' => $user->email
        ]);
        return true;
    }

    /**
     * @param $request
     * @return MessageBag|null
     */
    public function registerFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->registerRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function loginFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->loginOrRecoveryEmailRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function updateUserFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->updateUserRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @param $request
     * @return MessageBag|mixed|null
     */
    public function recoveryEmailFormRequest($request)
    {
        $validate = Validator::make($request->all(), $this->loginOrRecoveryEmailRules());
        if($validate->fails())
            return $validate->errors();
        return null;
    }

    /**
     * @return \string[][]
     */
    protected function registerRules()
    {
        return [
            'email' => ['required', 'unique:users', 'email:rfc,dns,filter'],
            'password' => ['required', 'min:6']
        ];
    }

    /**
     * @return \string[][]
     */
    protected function updateUserRules()
    {
        return [
            'first_name' => ['required','string', 'max:255', 'regex:/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/'],
            'last_name' => ['required','string', 'max:255', 'regex:/^[a-zA-Zéèêëíìîïñóòôöõúùûüýÿæ -]+$/'],
            'email' => ['required','email:rfc,dns,filter'],
        ];
    }

    /**
     * @return \string[][]
     */
   protected function loginOrRecoveryEmailRules()
   {
        return [
            'email' => ['required', 'email:rfc,dns,filter']
        ];
   }



}
