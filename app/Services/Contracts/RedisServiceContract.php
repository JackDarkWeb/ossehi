<?php


namespace App\Services\Contracts;


interface RedisServiceContract
{
    /**
     * @param $userId
     * @param $counterName
     * @return mixed
     */
    public function incrementCounterOperationUser($userId, $counterName);

    /**
     * @param $userId
     * @param $counterName
     * @return mixed
     */
    public function decrementCounterOperationUser($userId, $counterName);

    /**
     * @param $userId
     * @return mixed
     */
    public function getCounterOperationUser($userId);

    /**
     * @param $stores
     * @return mixed
     */
    public function setStores($stores);

    /**
     * @return mixed
     */
    public function getStores();

    /**
     * @return mixed
     */
    public function counterStore();
}
