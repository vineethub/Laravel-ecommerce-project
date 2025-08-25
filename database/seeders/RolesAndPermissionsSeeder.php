<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Use firstOrCreate to prevent duplicates
        Permission::firstOrCreate(['name' => 'access admin panel']);
        Permission::firstOrCreate(['name' => 'manage products']);
        Permission::firstOrCreate(['name' => 'manage categories']);
        Permission::firstOrCreate(['name' => 'manage orders']);
        Permission::firstOrCreate(['name' => 'manage users']);

        // Create roles and assign created permissions
        $customerRole = Role::firstOrCreate(['name' => 'customer']);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'access admin panel',
            'manage products',
            'manage categories',
            'manage orders'
        ]);
        
        $superAdminRole = Role::firstOrCreate(['name' => 'Super-Admin']);

        // --- Assign a Super-Admin Role to a User ---
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password')
            ]
        );
        $user->assignRole($superAdminRole);
    }
}
