<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\CommodityCategoryService;

class CommodityCategoryController extends Controller
{
    
   protected $commodityCategoryService;

   public function __construct(CommodityCategoryService $commodityCategoryService)
   {
    $this->commodityCategoryService = $commodityCategoryService;
   }

    public function index(){
        try{
           return $this->commodityCategoryService->get();
        }catch(\Exception $ex){
             return response()->json(['error' => $ex->getMessage()]);
        }
    }
}
