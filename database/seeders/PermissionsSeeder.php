<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'ticket_view',
            'ticket_create',
            'ticket_delete',
            'voucher_view',
            'voucher_create',
            'voucher_delete',
            'announce_view',
            'announce_create',
            'announce_delete',
            'announce_edit',
            'client_view',
            'configuration_view',
            'configuration_edit'
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create([
                'title' => $permission,
            ]);
        }
    }
}
