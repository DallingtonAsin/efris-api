<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use CarboN\Carbon;

class GoodsService
{
    protected $client;
    protected $apiUrl;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = 'http://127.0.0.1:9880/efristcs/ws/tcsapp/getInformation';
    }

    public function get()
    {
        try {
            $response = $this->client->get('https://api.publicapis.org/entries');
            $data = json_decode($response->getBody()->getContents());
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function register($data)
    {
        try {
            $encypted_data = base64_encode($data);
            $current_time = Carbon::now()->toDateTimeString();
            $requestBody = $this->getRequestBody($encypted_data);
            $response = $this->client->post($this->apiUrl, [
                'json' => $requestBody,
                'on_before_send' => function (RequestOptions $options) use ($current_time) {
                    $options['headers']['Pre-Request-Script'] = "<script>console.log('current time: $current_time');</script>";
                }
            ]);

            $response = json_decode($response->getBody()->getContents());
            return $response;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private function getRequestBody($encypted_data)
    {

        $globalInfo = $this->getGlobalInfo();
        $description = [
            "codeType" => "0",
            "encryptCode" => "1",
            "zipCode" => "0"
        ];

        $requestBody = [
            "data" => [
                "content" => $encypted_data,
                "signature" => "",
                "dataDescription" => $description
            ],
            "globalInfo" => $globalInfo,
            "returnStateInfo" => [
                "returnCode" => "",
                "returnMessage" => ""
            ]
        ];

        return $requestBody;
    }

    private function getGlobalInfo()
    {

        $tinNumber = "1000295178";
        $deviceNo = "TCS9361463868332739";

        $extendField =  [
            "responseDateFormat" => "dd/MM/yyyy",
            "responseTimeFormat" => "dd/MM/yyyy HH:mm:ss"
        ];

        $globalInfo =  [
            "appId" => "AP01",
            "version" => "1.1.20191201",
            "dataExchangeId" => "9230489223014123",
            "interfaceCode" => "T130",
            "requestCode" => "TP",
            "requestTime" => Carbon::now()->toDateTimeString(),
            "responseCode" => "TA",
            "userName" => "admin",
            "deviceMAC" => "FFFFFFFFFFFF",
            "deviceNo" => $deviceNo,
            "tin" => $tinNumber,
            "brn" => "",
            "taxpayerID" => "1",
            "longitude" => "116.397128",
            "latitude" => "39.916527",
            "extendField" => $extendField
        ];

        return $globalInfo;
    }
}
