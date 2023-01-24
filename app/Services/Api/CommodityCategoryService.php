<?php

namespace App\Services\Api;

use App\Services\Api\ApiService;

class CommodityCategoryService
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    // get commodity categories 
    public function get()
    {
        try {

            $data = [
                "pageNo" => "10",
                "pageSize" => "10",
            ];

            $json_data = json_encode($data);
            $encypted_data = base64_encode($json_data);

            $requestBody = $this->apiService->getRequestBody($encypted_data, "T124");

            return $this->apiService->post($requestBody);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


}
