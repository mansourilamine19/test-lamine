<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class CurlApi
{

    public function __construct()
    {

    }

    public function curlGet($url, $jwt)
    {
        $client = HttpClient::create();
        $responseJson = $client->request(
            'GET',
            $url,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $jwt,
                    'Accept' => 'application/json',
                ],
            ]
        );
        $response = $responseJson->toArray();
        return $response;
    }

    public function curlPost($url, $jwt, $data)
    {

    }

    public function curlPatch($url, $jwt, $data)
    {

    }

    public function curlRemove($url, $jwt)
    {

    }

}