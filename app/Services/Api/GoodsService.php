<?php

namespace App\Services\Api;

use GuzzleHttp\Client;

class GoodsService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get()
    {
        try {
            // $response = $this->client->get('https://example.com/api/users/');
            // $data = json_decode($response->getBody()->getContents());
            $data = [
                'success' => 'Ok'
            ];
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
