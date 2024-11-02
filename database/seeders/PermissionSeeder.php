<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'access dashboard',
            'manage options',
            'manage categories',
            'manage products',
            'manage covers',
            'manage orders',
            'manage users',
            'manage resources',
            'manage configurations',
            'manage coupons',
            'manage orders users',
            'manage templates',
            'manage sections',
            'manage invitations'
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
