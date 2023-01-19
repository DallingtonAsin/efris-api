<?php

namespace App\Services\Api;

use GuzzleHttp\Client;

class FinanceService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function issueCreditNote()
    {
        try {
            $response = $this->client->get('https://example.com/api/users/');
            $data = json_decode($response->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function issueDebtNote()
    {
        try {
            $response = $this->client->get('https://example.com/api/users/');
            $data = json_decode($response->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
