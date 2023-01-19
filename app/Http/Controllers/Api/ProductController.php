<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Api\ProductService;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function create(Request $request)
    {
        try{
        $userData = $request->all();
        $user = $this->productService->create($userData);
        return response()->json($user);
        }catch(\Exception $ex){
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function get($id)
    {
        $user = $this->productService->get($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $userData = $request->all();
        $user = $this->productService->update($id, $userData);
        return response()->json($user);
    }

    public function delete($id)
    {
        $user = $this->productService->delete($id);
        return response()->json($user);
    }

    public function increaseStock(){
        try{
            return response()->json(['success' => 'OK']);
        }catch(\Exception $ex){
            throw $ex;
        }
    }

    public function decreaseStock(){
        try{
            return response()->json(['success' => 'OK']);
        }catch(\Exception $ex){
            throw $ex;
        }
    }
}
