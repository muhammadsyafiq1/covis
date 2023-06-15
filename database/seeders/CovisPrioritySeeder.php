<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisPriority;

class CovisPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisPriority::create([
            'code' => 'NRM',
            'name' => 'Normal',
            'created_by' => 'System Administrator',
            'is_active' => 1
        ]);
        CovisPriority::create([
            'code' => 'URG',
            'name' => 'Urgent',
            'created_by' => 'System Administrator',
            'is_active' => 1
        ]);
    }
}
