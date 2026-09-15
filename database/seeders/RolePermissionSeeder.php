<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'manage pages', 'manage services', 'manage products',
            'manage news', 'manage messages',
            'manage settings', 'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'manage pages', 'manage services', 'manage products', 'manage news',
        ]);

        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@agriwebsite.test'],
            ['name' => 'Super Admin', 'password' => bcrypt('Password123!'), 'is_active' => true, 'email_verified_at' => now()]
        );
        $superAdmin->assignRole('admin');
    }
}
