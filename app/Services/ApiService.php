<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait ApiService
{

    /**
     * @param $base
     * @return mixed
     * @throws GuzzleException
     */
    public static function apiDevise($base)
    {
        $client = new Client;

        //$key = "1f1dcfe67096815e09d3b89d3373400d";
        $key = "51001ac437bcc5231685cbc156abae88";

        $url = sprintf("http://data.fixer.io/api/latest?access_key=%s&base=%s", $key, $base);

        $response = $client->request('GET', $url);

        return json_decode($response->getBody()->getContents(), true);
    }

}
