<?php


namespace App\Repositories\Eloquents;


use App\Helpers\Helper;
use App\Models\NewsLetter;
use App\Repositories\Contracts\NewsLetterRepositoryContract;

class NewsLetterRepository implements NewsLetterRepositoryContract
{

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email)
    {
        // TODO: Implement findByEmail() method.
    }

    /**
     * @param $request
     * @return mixed
     */
    public function create($request)
    {
        return NewsLetter::create([
            'email' => $request->get('email'),
            'location' => json_encode(Helper::userLocation(), true)
        ]);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function stop($email)
    {
        // TODO: Implement stop() method.
    }
}
