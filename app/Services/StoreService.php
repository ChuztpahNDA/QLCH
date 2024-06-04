<?php
namespace App\Services;

use App\Models\Store;

class StoreService
{
    /**
     * Create a new store.
     *
     * @param array $data
     * @return \App\Models\Store
     */
    public function createStore(array $data)
    {
        return Store::create($data);
    }

    /**
     * Update an existing store.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Store
     */
    public function updateStore(int $id, array $data)
    {
        $store = Store::findOrFail($id);
        $store->update($data);
        return $store;
    }

    /**
     * Delete a store.
     *
     * @param int $id
     * @return void
     */
    public function deleteStore(int $id)
    {
        $store = Store::findOrFail($id);
        $store->delete();
    }

    /**
     * Get a store by ID.
     *
     * @param int $id
     * @return \App\Models\Store
     */
    public function getStoreById(int $id)
    {
        return Store::findOrFail($id);
    }

    /**
     * Get all stores.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStores($filters)
    {
        return Store::filter($filters)->get();
    }
}
