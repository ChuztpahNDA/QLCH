<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Tắt kiểm tra khóa ngoại trong quá trình seeding
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate các bảng trước khi seeding để tránh trùng lặp
        $this->truncateTables(['users', 'stores', 'products']);

        // Chạy các seeder
        $this->call([
            UsersTableSeeder::class,
            StoresTableSeeder::class,
            ProductsTableSeeder::class,
            // Thêm các seeder khác ở đây nếu có
        ]);

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Truncate các bảng được chỉ định.
     *
     * @param array $tables
     * @return void
     */
    protected function truncateTables(array $tables)
    {
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
