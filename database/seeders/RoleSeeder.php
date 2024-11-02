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
        $admin = Role::create([
            'name' => 'admin',
        ]);

        $admin->syncPermissions([
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

        Role::create([
            'name' => 'user'
        ]);
    }
}
