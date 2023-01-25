<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\StockService;
use App\Http\Controllers\Controller;
use App\Models\Api\StockRequestData;
use Illuminate\Support\Facades\Validator;

class StockController extends Controller
{
    protected $stockService;
    protected $stockRequestData;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
        $this->stockRequestData = new StockRequestData();
    }

    public function getStockRecords(){
        try{
           return $this->stockService->queryStockRecords();
        }  catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    public function create(Request $request)
    {
        try {
            $data = $this->getRequestData('101', '001', 'increase stock');
            return $this->stockService->create($data);
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    public function addStock(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'goodsCode' => 'required',
            'goodsTypeCode' => 'required',
            'quantity' => 'required',
            'unitPrice' => 'required',
            'stockInType' => 'required',
            'supplierTin' => 'required',
            'supplierName' => 'required',
            'remarks' => 'sometimes|nullable',
        ]);

        try {
            if ($validator->fails()) {
                $message = $validator->errors()->all();
                return response()->json(['error' => $message], 400);
            } else {

                $goodsCode = $request->input('goodsCode');
                $goodsTypeCode = $request->input('goodsTypeCode');
                $quantity = $request->input('quantity');
                $unitPrice = $request->input('unitPrice');
                $stockInType = $request->input('stockInType');
                $supplierTin = $request->input('supplierTin');
                $supplierName = $request->input('supplierName');
                $remarks = $request->input('remarks');

                $stockIn = $this->getIncreaseStockIn($supplierTin, $supplierName, $stockInType, $goodsTypeCode, $remarks);
                $goodsInStockItem = $this->getGoodsInStockItemObj($goodsCode, $quantity, $unitPrice, $remarks);

                $data = [
                    "goodsStockIn" => $stockIn,
                    "goodsStockInItem" => [$goodsInStockItem]
                ];

                // return response()->json($data, 200);
                return $this->stockService->create($data);
            }
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    public function decreaseStock(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'goodsCode' => 'required',
            'goodsTypeCode' => 'sometimes|nullable',
            'quantity' => 'required',
            'adjustType' => 'required',
            'remarks' => 'sometimes|nullable',
        ]);

        try {
            if ($validator->fails()) {
                $message = $validator->errors()->all();
                return response()->json(['error' => $message], 400);
            } else {

                $goodsCode = $request->input('goodsCode');
                $goodsTypeCode = $request->input('goodsTypeCode');
                $quantity = $request->input('quantity');
                $unitPrice = $request->input('unitPrice');
                $adjustType = $request->input('adjustType');
                $remarks = $request->input('remarks');

                $stockIn = $this->getDecreaseStockInObj($adjustType, $goodsTypeCode, $remarks);
                $goodsInStockItem = $this->getGoodsInStockItemObj($goodsCode, $quantity, $unitPrice, $remarks);

                $data = [
                    "goodsStockIn" => $stockIn,
                    "goodsStockInItem" => [$goodsInStockItem]
                ];

                return $this->stockService->create($data);
            }
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    private function getIncreaseStockIn($supplierTin, $supplierName, $stockInType, $goodsTypeCode, $remarks = null)
    {
        try {

            $stockIn = [
                "operationType" => '101',
                "supplierTin" => $supplierTin,
                "supplierName" => $supplierName,
                "adjustType" => '',
                "remarks" => $remarks,
                "stockInDate" => "",
                "stockInType" => $stockInType,
                "productionBatchNo" => "",
                "productionDate" => "",
                "branchId" => "",
                "invoiceNo" => "",
                "isCheckBatchNo" => "0",
                "rollBackIfError" => "0",
                "goodsTypeCode" => $goodsTypeCode
            ];

            return $stockIn;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private function getDecreaseStockInObj($adjustType, $goodsTypeCode, $remarks = null)
    {
        try {

            $stockIn = [
                "operationType" => '102',
                "supplierTin" => '',
                "supplierName" => '',
                "adjustType" => $adjustType,
                "remarks" => $remarks,
                "stockInDate" => "",
                "stockInType" => '',
                "productionBatchNo" => "",
                "productionDate" => "",
                "branchId" => "",
                "invoiceNo" => "",
                "isCheckBatchNo" => "0",
                "rollBackIfError" => "0",
                "goodsTypeCode" => ""
            ];

            return $stockIn;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    private function getGoodsInStockItemObj($goodsCode, $quantity, $unitPrice, $remarks)
    {
        try {

            $goodsInStockItem = [
                "commodityGoodsId" => "",
                "goodsCode" => $goodsCode,
                "measureUnit" => "",
                "quantity" => $quantity,
                "unitPrice" => $unitPrice,
                "remarks" => $remarks,
                "fuelTankId" => "",
                "lossQuantity" => "",
                "originalQuantity" => ""
            ];

            return $goodsInStockItem;
        } catch (\Exception $ex) {
            throw $ex;
        }
    }



    public function get($id)
    {
        $user = $this->stockService->get($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $userData = $request->all();
        $user = $this->stockService->update($id, $userData);
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = $this->stockService->delete($id);
        return response()->json($user);
    }
}
