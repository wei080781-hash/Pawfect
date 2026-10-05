<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => '狗狗',
                'slug' => 'dogs',
                'sort_order' => 1,
                'children' => [
                    [
                        'name' => '狗狗飼料',
                        'slug' => 'dog-food',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => '狗狗玩具',
                        'slug' => 'dog-toys',
                        'sort_order' => 2,
                    ],
                    [
                        'name' => '狗狗零食',
                        'slug' => 'dog-treats',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'name' => '貓咪',
                'slug' => 'cats',
                'sort_order' => 2,
                'children' => [
                    [
                        'name' => '貓咪飼料',
                        'slug' => 'cat-food',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => '貓咪玩具',
                        'slug' => 'cat-toys',
                        'sort_order' => 2,
                    ],
                    [
                        'name' => '貓咪零食',
                        'slug' => 'cat-treats',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'name' => '其他動物',
                'slug' => 'other-animals',
                'sort_order' => 3,
                'children' => [
                    [
                        'name' => '其他動物飼料',
                        'slug' => 'other-animal-food',
                        'sort_order' => 1,
                    ],
                    [
                        'name' => '其他動物玩具',
                        'slug' => 'other-animal-toys',
                        'sort_order' => 2,
                    ],
                    [
                        'name' => '其他動物零食',
                        'slug' => 'other-animal-treats',
                        'sort_order' => 3,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'];

            unset($categoryData['children']);

            $category = Category::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $category->id;

                Category::create($childData);
            }
        }
    }
}