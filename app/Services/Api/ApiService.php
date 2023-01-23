<?php

namespace App\Services\Api;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use CarboN\Carbon;

class ApiService
{
    protected $client;
    protected $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = 'http://127.0.0.1:9880/efristcs/ws/tcsapp/getInformation';
    }

    public function get()
    {
        try {
            $response = $this->client->get($this->url);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function post($data)
    {
        try {

            $current_time = Carbon::now()->toDateTimeString();
            $response = $this->client->post($this->url, [
                'json' => $data,
                'on_before_send' => function (RequestOptions $options) use ($current_time) {
                    $options['headers']['Pre-Request-Script'] = "<script>console.log('current time: $current_time');</script>";
                }
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function getRequestBody($encypted_data, $interfaceCode)
    {

        $globalInfo = $this->getGlobalInfo($interfaceCode);
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


    private function getGlobalInfo($interfaceCode)
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
            "interfaceCode" => $interfaceCode,
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
