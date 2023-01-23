<?php

namespace App\Models\Api;

class StockRequestData{
    public $stockIn;
    public $goodsInStockItem;

    public function __construct()
    {
       $this->stockIn = [];
       $this->goodsInStockItem = []; 
    }

}