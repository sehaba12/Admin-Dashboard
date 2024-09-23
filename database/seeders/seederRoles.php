<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Import the User model


class seederRoles extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $permissions = [
            'view chart',
            'view map',
            'view requests',
            'view users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(['view requests', 'view users']);
        $userRole->givePermissionTo(['view chart', 'view map']);

        // Create users and assign roles
        $user=User::find(12);

        $user->assignRole($adminRole);

        // User::updateOrCreate([
        //     'name' => 'Regular User',
        //     'email' => 'user@example.com',
        //     'password' => bcrypt('password'),
        // ])->assignRole($userRole);
    }
}
