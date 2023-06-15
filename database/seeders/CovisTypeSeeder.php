<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisType;

class CovisTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisType::create([
            'code' => '001',
            'name' => 'Apartemen',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '002',
            'name' => 'Gudang',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '003',
            'name' => 'Kantor',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '004',
            'name' => 'Kapal',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '005',
            'name' => 'Kendaraan',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '006',
            'name' => 'Kios',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '007',
            'name' => 'Mesin',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '008',
            'name' => 'Pabrik',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '009',
            'name' => 'Persediaan Barang',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '010',
            'name' => 'Ruko',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '011',
            'name' => 'Rumah Tinggal',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '012',
            'name' => 'Tanah Bangunan',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
        CovisType::create([
            'code' => '013',
            'name' => 'Tanah Kosong',
            'is_active' => 1,
            'created_by' => 'System Administrator'
        ]);
    }
}
