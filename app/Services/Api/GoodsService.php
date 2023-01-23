<?php

namespace App\Services\Api;

use App\Services\Api\ApiService;

class GoodsService
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // get registered goods
    public function get($data)
    {
        try {

            $json_data = json_encode($data);
            $encypted_data = base64_encode($json_data);

            $requestBody = $this->apiService->getRequestBody($encypted_data, "T127");

            return $this->apiService->post($requestBody);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    // register good
    public function register($data)
    {
        try {

            $request_data = json_encode($data);
            $encypted_data = base64_encode($request_data);

            $requestBody = $this->apiService->getRequestBody($encypted_data, "T130");
            return $this->apiService->post($requestBody);

        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
