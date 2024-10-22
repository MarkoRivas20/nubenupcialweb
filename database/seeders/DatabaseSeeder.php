<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // User::factory(10)->create();

        $this->call([
            OptionSeeder::class
        ]);

        Category::create([
            'name' => 'categoria 1'
        ]);

        Category::create([
            'name' => 'categoria 2'
        ]);
        
        Product::factory(20)->create();
    }
}
