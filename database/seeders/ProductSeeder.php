<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables to avoid conflicts
        DB::table('product_images')->truncate();
        DB::table('products')->truncate();
        DB::table('tags')->truncate();
        DB::table('colors')->truncate();
        DB::table('sizes')->truncate();

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Seed tags, colors, and sizes
        $tags = Tag::factory()->count(10)->create();
        $colors = Color::factory()->count(10)->create();
        $sizes = Size::factory()->count(10)->create();

        // Seed products and related data
        Product::factory()
            ->count(10)
            ->create()
            ->each(function ($product) use ($tags, $colors, $sizes) {
                // Attach tags, colors, and sizes
                $product->tags()->attach($tags->random(3));
                $product->colors()->attach($colors->random(3));
                $product->sizes()->attach($sizes->random(3));

                // Create product images
                ProductImage::factory()->count(3)->create(['product_id' => $product->id]);
            });
    }
}