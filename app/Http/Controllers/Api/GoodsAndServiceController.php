<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\GoodsService;
use Illuminate\Http\Request;

class GoodsAndServiceController extends Controller
{

    protected $goodsService;

    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;
    }

    public function get(Request $request){
        try{

            $data = [
                "goodsCode" => "",
                "goodsName " => "apple",
                "commodityCategoryName" => "",
                "pageNo" => "10",
                "pageSize" => "10",
                "branchId" => "",
                "serviceMark" => "",
                "haveExciseTax" => "",
                "startDate" => "",
                "endDate" => "",
                "combineKeywords" => "",
                "goodsTypeCode" => ""
            ];

            $goods = $this->goodsService->get($data);
            return response()->json($goods);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }
    

    public function getRegistedProducts(){
        try{
            $data = [
                "goodsCode" => "",
                "goodsName " => "apple",
                "commodityCategoryName" => "",
                "pageNo" => "10",
                "pageSize" => "10",
                "branchId" => "",
                "serviceMark" => "",
                "haveExciseTax" => "",
                "startDate" => "",
                "endDate" => "",
                "combineKeywords" => "",
                "goodsTypeCode" => ""
            ];

            $goods = $this->goodsService->get($data);
            return response()->json($goods);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function registerProduct(Request $request){
        try{

            $params = [[
                "operationType" =>  "101",
                "goodsName" => "orange",
                "goodsCode" => "003",
                "measureUnit" => "101",
                "unitPrice" => "5999.99",
                "currency" => "101",
                "commodityCategoryId" => "10111301",
                "haveExciseTax" => "102",
                "description" => "1",
                "stockPrewarning" => "10",
                "pieceMeasureUnit" => "",
                "havePieceUnit" => "102",
                "pieceUnitPrice" => "",
                "packageScaledValue" => "",
                "pieceScaledValue" => "",
                "exciseDutyCode" => "",
                "haveOtherUnit" => "102"
            ]];

            return $this->goodsService->register($params);

        }catch(\Exception $ex){
           return response()->json([$ex->getMessage()], 400);
        }
    }

}
