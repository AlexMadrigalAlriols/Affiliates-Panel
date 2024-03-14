<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shop_roles = [
            'Owner',
            'Admin',
            'Manager',
            'Worker'
        ];

        $global_roles = [
            'Super Admin',
            'User'
        ];

        foreach ($global_roles as $role) {
            Role::create([
                'title' => $role,
                'type' => Role::TYPES['global']
            ]);
        }

        foreach ($shop_roles as $role) {
            Role::create([
                'title' => $role,
                'type' => Role::TYPES['shop']
            ]);
        }
    }
}
