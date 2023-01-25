<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\FinanceService;

class FinanceController extends Controller
{
    protected $invoiceService;

    public function __construct(FinanceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function issueCreditNote(){
        try{
            $this->invoiceService->issueCreditNote();
            return response()->json(['success' => 'OK']);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }


    public function issueDebtNote(){
        try{
            $this->invoiceService->issueDebtNote();
            return response()->json(['success' => 'OK']);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }
}
