<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define top-level categories
        $topLevelCategories = [
            'Electronics',
            'Fashion',
            'Home & Garden',
            'Sports',
            'Toys'
        ];

        // Seed top-level categories
        foreach ($topLevelCategories as $topCategory) {
            $category = Category::create([
                'name' => $topCategory,
                'parent_id' => 0
            ]);

            // Define subcategories for each top-level category
            $subcategories = [
                'Electronics' => ['Mobile Phones', 'Computers', 'Cameras'],
                'Fashion' => ['Men', 'Women', 'Kids'],
                'Home & Garden' => ['Furniture', 'Garden Tools', 'Kitchen Appliances'],
                'Sports' => ['Fitness', 'Outdoor', 'Team Sports'],
                'Toys' => ['Action Figures', 'Puzzles', 'Board Games']
            ];

            // Seed subcategories
            if (array_key_exists($topCategory, $subcategories)) {
                foreach ($subcategories[$topCategory] as $subcategory) {
                    Category::create([
                        'name' => $subcategory,
                        'parent_id' => $category->id
                    ]);
                }
            }
        }
    }
}