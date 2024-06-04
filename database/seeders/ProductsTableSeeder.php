<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Lấy danh sách tất cả các cửa hàng
        $stores = Store::all();

        foreach ($stores as $store) {
            // Tạo 10 sản phẩm cho mỗi cửa hàng
            for ($i = 0; $i < 10; $i++) {
                $name = $faker->words(3, true);
                $salesPrice = $faker->numberBetween(10, 1000);

                Product::create([
                    'store_id' => $store->id,
                    'image' => 'https://via.placeholder.com/400x300.png?text=' . urlencode($name),
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'description' => $faker->paragraph(3),
                    'sales_price' => $salesPrice,
                    'purchase_price' => $faker->numberBetween(5, $salesPrice),
                    'quantity' => $faker->numberBetween(0, 100),
                ]);
            }
        }
    }
}
