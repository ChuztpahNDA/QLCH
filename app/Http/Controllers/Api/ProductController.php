<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(IndexRequest $request)
    {
        $filters = $request->validated();
        $products = $this->productService->getProducts($filters);
        return response()->json($products);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return response()->json($product);
    }

    public function store(StoreRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $product = $this->productService->createProduct($data);

        return response()->json($product, 201);
    }

    public function update(UpdateRequest $request, $id)
    {
        $request->validated();
        $data = $request->all();
        $product = $this->productService->updateProduct($id, $data);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(null, 204);
    }
}


