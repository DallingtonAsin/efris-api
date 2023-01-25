<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Api\InvoiceService;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function issue(){
        try{
            $this->invoiceService->issueInvoice();
            return response()->json(['success' => 'OK']);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }
}
