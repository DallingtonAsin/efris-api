<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use App\Services\Api\ApiService;
use App\Repositories\Api\ProductRepository;

class StockService
{
    protected $client;
    protected $productRepository;
    protected $apiService;

    public function __construct(ProductRepository $productRepository, ApiService $apiService)
    {
        $this->client = new Client();
        $this->productRepository = $productRepository;
        $this->apiService = $apiService;
    }

    public function create($stockData)
    {
        try {
            $request_data = json_encode($stockData);
            $encypted_data = base64_encode($request_data);

            $requestBody = $this->apiService->getRequestBody($encypted_data, "T131");
            return $this->apiService->post($requestBody);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function get($id)
    {
        try {
            // $response = $this->client->get('https://example.com/api/users/'.$id);
            // $data = json_decode($response->getBody()->getContents());
            $data = [
                'success' => 'Ok'
            ];
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update($id, $productData)
    {
        try {
            $response = $this->client->put('https://example.com/api/users/'.$id, [
                'form_params' => $productData
            ]);
            $data = json_decode($response->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            $response = $this->client->delete('https://example.com/api/users/'.$id);
            $data = json_decode($response->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
