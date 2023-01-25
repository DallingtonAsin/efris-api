<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\GoodsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GoodsAndServiceController extends Controller
{

    protected $goodsService;

    public function __construct(GoodsService $goodsService)
    {
        $this->goodsService = $goodsService;
    }

    public function get()
    {
        try {

            $data = [
                "goodsCode" => "001",
                "pageNo" => "10",
                "pageSize" => "10",

                // "goodsCode" => "",
                // "goodsName " => "",
                // "commodityCategoryName" => "",
                // "pageNo" => "10",
                // "pageSize" => "10",
                // "branchId" => "",
                // "serviceMark" => "",
                // "haveExciseTax" => "",
                // "startDate" => "",
                // "endDate" => "",
                // "combineKeywords" => "",
                // "goodsTypeCode" => ""
            ];

            $goods = $this->goodsService->get($data);
            return response()->json($goods);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }


    public function registerProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'goodsName' => 'required',
            'goodsCode' => 'required',
            'measureUnit' => 'required',
            'unitPrice' => 'required',
            'currency' => 'required',
            'commodityCategoryId' => 'required',
            'stockPrewarning' => 'required',
            'haveExciseTax' => 'required',
            'havePieceUnit' => 'required',
            'haveOtherUnit' => 'required'
        ]);

        try {
            if ($validator->fails()) {

                $message = $validator->errors()->all();
                return response()->json(['error' => $message], 400);

            } else {

                $goodsName = $request->input('goodsName');
                $goodsCode = $request->input('goodsCode');
                $measureUnit = $request->input('measureUnit');
                $unitPrice = $request->input('unitPrice');
                $currency = $request->input('currency');
                $commodityCategoryId = $request->input('commodityCategoryId');
                $stockPrewarning = $request->input('stockPrewarning');
                $haveExciseTax = $request->input('haveExciseTax');
                $havePieceUnit = $request->input('havePieceUnit');
                $haveOtherUnit = $request->input('haveOtherUnit');

                $params = [[
                    "operationType" =>  "101",
                    "goodsName" => $goodsName,
                    "goodsCode" =>  $goodsCode,
                    "measureUnit" => $measureUnit,
                    "unitPrice" => $unitPrice,
                    "currency" => $currency,
                    "commodityCategoryId" => $commodityCategoryId,
                    "haveExciseTax" => $haveExciseTax,
                    "description" => "1",
                    "stockPrewarning" => $stockPrewarning,
                    "pieceMeasureUnit" => "",
                    "havePieceUnit" => $havePieceUnit,
                    "pieceUnitPrice" => "",
                    "packageScaledValue" => "",
                    "pieceScaledValue" => "",
                    "exciseDutyCode" => "",
                    "haveOtherUnit" => $haveOtherUnit
                ]];

                return $this->goodsService->register($params);
            }
        } catch (\Exception $ex) {
            return response()->json([$ex->getMessage()], 400);
        }
    }
}
