<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Str;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Lấy danh sách ID của các user (bỏ qua user admin)
        $userId = User::where('email', 'admin@example.com')->first()['id'];
        logger($userId);

        // Tạo 2 cửa hàng ngẫu nhiên
        for ($i = 0; $i < 2; $i++) {
            // Chọn ngẫu nhiên một user ID từ danh sách

            Store::create([
                'user_id' => $userId,
                'name' => 'Store ' . Str::random(5),
                'description' => 'This is a random store created by seeder.',
            ]);
        }
    }
}
