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
             $requestData = $this->getInvoiceData();
             return $this->invoiceService->issueInvoice($requestData);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()], 400);
        }
    }

    private function getSellerDetails(){
        $sellerDetails = [
            "tin" => "1000295178",
            "ninBrn" => "113905",
            "legalName" => "Casa Miltu Hotel",
            "businessName" => "",
            "address" => "",
            "mobilePhone" => "",
            "linePhone" => "",
            "emailAddress" => "casamiltuhtel@gmail.com",
            "placeOfBusiness" => "",
            "referenceNo" => "00000000012",
            "branchId" => "",
            "isCheckReferenceNo" => "",
            "branchName" => "Casa Miltu Hotel",
            "branchCode" => ""
        ];
       return $sellerDetails;
    }


    public function getInvoiceData(){

        $sellerDetails = $this->getSellerDetails();
        
        $basicInfo = [
                "invoiceNo" => "",
                "antifakeCode" => "",
                "deviceNo" => "TCS9361463868332739",
                "issuedDate" => date("Y-m-d H:i:s"),
                "operator" => "cashierName",
                "currency" => "UGX",
                "oriInvoiceId" => "",
                "invoiceType" => "1",
                "invoiceKind" => "1", // 1: invoice, 2: receipt
                "dataSource" => "106", 
                "invoiceIndustryCode" => "107",
                "isBatch" => ""  
        ];


        $buyerDetails = [
                "buyerTin" => "",
                "buyerNinBrn" => "",
                "buyerPassportNum" => "",
                "buyerLegalName" => "Casa Miltu Hotel",
                "buyerBusinessName" => "",
                "buyerAddress" => "",
                "buyerEmail" => "",
                "buyerMobilePhone" => "",
                "buyerLinePhone" => "",
                "buyerPlaceOfBusi" => "",
                "buyerType" => "1",
                "buyerCitizenship" => "",
                "buyerSector" => "",
                "buyerReferenceNo" => ""
        ];

        $buyerExtend = [
                "propertyType" => "",
                "district" => "",
                "municipalityCounty" => "",
                "divisionSubcounty" => "",
                "town" => "",
                "cellVillage" => "",
                "effectiveRegistrationDate" => "",
                "meterStatus" => ""
        ];

        $item1 = [
                "item" => "apple",
                "itemCode" => "001",
                "qty" => "2",
                "unitOfMeasure" => "103",
                "unitPrice" => "150.00",
                "total" => "300.00",
                "taxRate" => "0.18",
                "tax" => "45.76",
                "discountTotal" => "",
                "discountTaxRate" => "",
                "orderNumber" => "0", // required
                "discountFlag" => "2", // 0 (if discounted), 1 (discount on entire item), 2 (no dicount)
                "deemedFlag" => "2", // 1 - deemed, 2 - not deemed 
                "exciseFlag" => "2", // 1 - excise, 2 - not excise
                "categoryId" => "", 
                "categoryName" => "",
                "goodsCategoryId" => "10111301", // required
                "goodsCategoryName" => "",
                "exciseRate" => "",
                "exciseRule" => "",
                "exciseTax" => "",
                "pack" => "",
                "stick" => "",
                "exciseUnit" => "",
                "exciseCurrency" => "",
                "exciseRateName" => "",
                "vatApplicableFlag" => "1"
        ];

        $item2 = [
                "item" => "mango",
                "itemCode" => "002",
                "qty" => "3",
                "unitOfMeasure" => "103",
                "unitPrice" => "120.00",
                "total" => "360",
                "taxRate" => "0.18",
                "tax" => "54.92",
                "discountTotal" => "",
                "discountTaxRate" => "",
                "orderNumber" => "1",
                "discountFlag" => "2",
                "deemedFlag" => "2",
                "exciseFlag" => "2",
                "categoryId" => "Test",
                "categoryName" => "Test",
                "goodsCategoryId" => "10111301",
                "goodsCategoryName" => "Test",
                "exciseRate" => "",
                "exciseRule" => "",
                "exciseTax" => "",
                "pack" => "",
                "stick" => "",
                "exciseUnit" => "",
                "exciseCurrency" => "",
                "exciseRateName" => "",
                "vatApplicableFlag" => "1"
        ];

        $taxDetail1 = [
            "taxCategoryCode" => "01",
            "netAmount" => "3813.55",
            "taxRate" => "0.18",
            "taxAmount" => "686.45",
            "grossAmount" => "4500.00",
            "exciseUnit" => "",
            "exciseCurrency" => "",
            "taxRateName" => "123"
        ];

        $taxDetail2 = [
            "taxCategoryCode" => "05",
            "netAmount" => "1818.18",
            "taxRate" => "0.1",
            "taxAmount" => "181.82",
            "grossAmount" => "2000.00",
            "exciseUnit" => "101",
            "exciseCurrency" => "UGX",
            "taxRateName" => "123"
        ];

        $summary = [
                "netAmount" => "8379", // required
                "taxAmount" => "868", // required
                "grossAmount" => "9247", // required
                "itemCount" => "5", // required
                "modeCode" => "0", // required
                "remarks" => "This is another remark test.", // no
                "qrCode" => "asdfghjkl" // no
        ];

        $paymentMode1 = [
            "paymentMode" => "101", // required
            "paymentAmount" => "686.45", // required
            "orderNumber" => "a" // required
          ];

        $paymentMode2 = [
                "paymentMode" => "102",
                "paymentAmount" => "686.45",
                "orderNumber" => "a"
        ];

        $extend = [
                "reason" => "",
                "reasonCode" => "",
        ];

       $requestData = [
            "sellerDetails" => $sellerDetails,
            "basicInformation" => $basicInfo,
            "buyerDetails" => $buyerDetails,
            "buyerExtend" => $buyerExtend,
            "goodsDetails" => [$item1, $item2],
            "taxDetails" => [$taxDetail1, $taxDetail2],
            "summary" => $summary,
            "payWay" => [$paymentMode1, $paymentMode2],
            "extend" => $extend,
       ];

       return $requestData;


    }
}
