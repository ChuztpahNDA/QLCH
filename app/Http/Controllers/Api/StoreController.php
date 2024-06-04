<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StoreService;
use Illuminate\Http\Request;
use App\Http\Requests\Store\IndexRequest;
use App\Http\Requests\Store\StoreRequest;
use App\Http\Requests\Store\UpdateRequest;



class StoreController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index(IndexRequest $request)
    {
        $filters = $request->validated();
        $stores = $this->storeService->getAllStores($filters);
        return response()->json($stores);
    }

    public function show($id)
    {
        $store = $this->storeService->getStoreById($id);
        return response()->json($store);
    }

    public function store(StoreRequest $request)
    {
        $filters = $request->validated();
        $user = auth('api')->user();
        $data = $request->only(['name', 'description']);
        $data['user_id'] = $user->id;
        $store = $this->storeService->createStore($data);
        return response()->json($store, 201);
    }

    public function update(UpdateRequest $request, $id)
    {
        $filters = $request->validated();
        $data = $request->only(['user_id', 'name', 'description']);
        $store = $this->storeService->updateStore($id, $data);
        return response()->json($store);
    }

    public function destroy($id)
    {
        $this->storeService->deleteStore($id);
        return response()->json(null, 204);
    }
}
