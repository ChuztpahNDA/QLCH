<?php
namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Create a new product.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    /**
     * Update an existing product.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Product
     */
    public function updateProduct(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * @return void
     */
    public function deleteProduct(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     * @return \App\Models\Product
     */
    public function getProductById(int $id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProducts($filters)
    {
        return Product::with('store')->filter($filters)->get();
    }
}

