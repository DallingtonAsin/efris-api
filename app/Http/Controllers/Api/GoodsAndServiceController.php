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

}
