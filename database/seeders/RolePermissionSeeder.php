<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = ['project', 'employee', 'user', 'tags','role', 'setting'];
        $actions  = ['create', 'view', 'edit', 'delete'];

        foreach ($features as $feature) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "{$feature}.{$action}",
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
