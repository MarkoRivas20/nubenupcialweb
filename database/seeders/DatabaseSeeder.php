<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Configuration;
use App\Models\Product;
use App\Models\Resource;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        User::create([
            'name' => 'Marko Antonio',
            'last_name' => 'Rivas Rios',
            'document_type' => 1,
            'document' => '70321131',
            'phone' => '963761877',
            'email' => 'marko.rivas98@gmail.com',
            'password' => Hash::make('pacarlos55')
        ]);

        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            OptionSeeder::class,
            TemplateSeeder::class
        ]);

        Category::create([
            'name' => 'categoria 1'
        ]);

        Category::create([
            'name' => 'categoria 2'
        ]);
        
        Product::factory(20)->create();

        Configuration::create([
            'content' => [
                'tax' => 18.00,
                'paymentMethod' => 1,
                'couponStatus' => 1
            ]
        ]);

        Resource::create([
            'name' => 'Canciones'
        ]);

        Resource::create([
            'name' => 'Imagenes'
        ]);
    }
}
