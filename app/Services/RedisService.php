<?php


namespace App\Services;


use App\Helpers\Auth;
use App\Services\Contracts\RedisServiceContract;
use Illuminate\Support\Facades\Redis;

class RedisService implements RedisServiceContract
{

    /**
     * @param $userId
     * @param $counterName
     * @return mixed
     */
    public function incrementCounterOperationUser($userId, $counterName)
    {

        if (Redis::hExists("user:{$userId}:counter", $counterName)){

            return Redis::hIncrBy("user:{$userId}:counter", $counterName, 1);
        }

        return Redis::hset("user:{$userId}:counter", $counterName, 1);
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getCounterOperationUser($userId)
    {
        return Redis::hGetAll("user:{$userId}:counter");
    }

    /**
     * @param $userId
     * @param $counterName
     * @return mixed
     */
    public function decrementCounterOperationUser($userId, $counterName)
    {
        if (Redis::hExists("user:{$userId}:counter", $counterName)){

            return Redis::hIncrBy("user:{$userId}:counter", $counterName, -1);
        }
        return false;
    }

    /**
     * @return mixed
     */
    public function getStores()
    {
        return Redis::hMGetAll();
    }

    /**
     * @return mixed
     */
    public function counterStore()
    {
        // TODO: Implement counterStore() method.
    }

    /**
     * @param $stores
     * @return mixed
     */
    public function setStores($stores)
    {
        // TODO: Implement setStores() method.
    }
}
