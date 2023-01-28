<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use App\Services\Api\ApiService;

class InvoiceService
{
    protected $client, $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->client = new Client();
        $this->apiService = $apiService;
    }

    public function issueInvoice($data)
    {
        try {

            $json_data = json_encode($data);
            // return $data;
            $encypted_data = base64_encode($json_data);
            $requestBody = $this->apiService->getRequestBody($encypted_data, "T109");

            return $this->apiService->post($requestBody);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
