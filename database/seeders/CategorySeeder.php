<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (Category::count() > 0) {
            // DB::table('faq')->delete();
            return;
        }
        $categories = [

            [

                'title' => 'Gym',
                'parent_id' => 0,
                'description' => 'shoes used for the gym.',

            ],

            [

                'title' => 'Boots',
                'parent_id' => 0,
                'description' => 'casual boot or industrial boots.',

            ],

            [

                'title' => 'Chukkas',
                'parent_id' => 0,
                'description' => 'Leather Shoe.',

            ],

            [

                'title' => 'Boat',
                'parent_id' => 0,
                'description' => 'water tolerant.',

            ],

            [

                'title' => 'Ballet',
                'parent_id' => 0,
                'description' => 'Shoes for ballet dance.',

            ],

            [

                'title' => 'Climbing',
                'parent_id' => 0,
                'description' => 'climbing walls.',

            ],

            [

                'title' => 'Hiking',
                'parent_id' => 0,
                'description' => 'Hiking shoes.',

            ],

            [

                'title' => 'Other',
                'parent_id' => 0,
                'description' => 'any order category.',

            ],
        ];
        foreach ($categories as $data) {
            $data['slug'] = Str::slug($data['title']);
            Category::create($data);
        }
    }
}
