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
            $goods = $this->goodsService->get();
            return response()->json($goods);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function registerProduct(Request $request){
        try{

            $params = [[
                "operationType" =>  "101",
                "goodsName" => "apple",
                "goodsCode" => "001",
                "measureUnit" => "101",
                "unitPrice" => "6999.99",
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

            $data = json_encode($params);
            return $this->goodsService->register($data);

        }catch(\Exception $ex){
           return response()->json([$ex->getMessage()], 400);
        }
    }

}
