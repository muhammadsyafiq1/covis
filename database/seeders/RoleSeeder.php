<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'System Administrator',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Administrator',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Head',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Supervisor',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Support',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'Surveyor',
            'guard_name' => 'web'
        ]);
    }
}
