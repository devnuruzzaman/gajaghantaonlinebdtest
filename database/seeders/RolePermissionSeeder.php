<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'dashboard.view',
            'customers.view',
            'customers.create',
            'customers.edit',
            'customers.delete',
            'packages.view',
            'packages.create',
            'packages.edit',
            'packages.delete',
            'routers.view',
            'routers.create',
            'routers.edit',
            'routers.delete',
            'billing.view',
            'billing.create',
            'billing.edit',
            'billing.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        $adminRole->givePermissionTo(Permission::all());
        $staffRole->givePermissionTo([
            'dashboard.view',
            'customers.view',
            'packages.view',
            'routers.view',
            'billing.view',
        ]);

        // Create default admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@isp.local'],
            [
                'name' => 'ISP Admin',
                'password' => bcrypt('password'),
            ]
        );
        $admin->assignRole('admin');
    }
}
