<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisUsedFor;

class CovisUsedForSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisUsedFor::create([
            'code' => 'DIP',
            'name' => 'Dipakai Sendiri',
            'note' => 'Diapaki Sendiri',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisUsedFor::create([
            'code' => 'DSW',
            'name' => 'Disewakan',
            'note' => 'Disewakan',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisUsedFor::create([
            'code' => 'DLL',
            'name' => 'Lain - Lain',
            'note' => 'Lain - Lain',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
    }
}
