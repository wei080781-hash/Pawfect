<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->first();

        if ($user === null) {
            $this->command->error('目前沒有會員資料，無法建立商品。');

            return;
        }

        Product::create([
            'user_id' => $user->id,
            'name' => '皇家犬用飼料',
            'description' => '適合成犬日常食用的犬用飼料。',
            'price' => 350,
            'stock' => 20,
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => '鮮肉主食罐',
            'description' => '適合貓咪食用的主食罐。',
            'price' => 80,
            'stock' => 50,
            'is_active' => true,
        ]);

        Product::create([
            'user_id' => $user->id,
            'name' => '耐咬寵物玩具',
            'description' => '適合日常互動與遊戲的寵物玩具。',
            'price' => 199,
            'stock' => 15,
            'is_active' => true,
        ]);
    }
}
