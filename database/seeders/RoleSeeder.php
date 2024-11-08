<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $adminRole->syncPermissions([
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
        ]);

        $user = User::find(1);
        $user->assignRole('admin');

        $userRole = Role::create([
            'name' => 'user'
        ]);

        $userRole->syncPermissions([
            'manage orders users',
        ]);
    }
}
