<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisAccessType;

class CovisRoadAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisAccessType::create([
            'code' => '001',
            'name' => 'Dapat Dilalui Oleh Min. 2 Kendaraan Roda 4',
            'note' => 'Dapat Dilalui Oleh Min. 2 Kendaraan Roda 4',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisAccessType::create([
            'code' => '002',
            'name' => 'Hanya Dapat Dilalui Oleh 1 Kendaraan Roda 4',
            'note' => 'Hanya Dapat Dilalui Oleh 1 Kendaraan Roda 4',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisAccessType::create([
            'code' => '003',
            'name' => 'Jalan Setapak',
            'note' => 'Jalan Setapak',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisAccessType::create([
            'code' => '004',
            'name' => 'Lain - Lain',
            'note' => 'Lain - Lain',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
    }
}
