<?php

namespace App\Services\Api;

use GuzzleHttp\Client;

class InvoiceService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function issueInvoice()
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
