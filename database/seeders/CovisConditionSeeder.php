<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisCondition;

class CovisConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisCondition::create([
            'code' => '001',
            'name' => 'Terawat',
            'note' => 'Agunan Terawat',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisCondition::create([
            'code' => '002',
            'name' => 'Tidak Terawat',
            'note' => 'Agunana Tidak Terawat',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisCondition::create([
            'code' => '003',
            'name' => 'Tampak Belakang Tidak Terjangkau Untuk Difoto',
            'note' => 'Tampak Belakang Tidak Terjangkau Untuk Difoto',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisCondition::create([
            'code' => '004',
            'name' => 'Lain - Lain',
            'note' => 'Lain - Lain',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
    }
}
