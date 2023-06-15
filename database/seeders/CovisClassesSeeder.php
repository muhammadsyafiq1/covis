<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CovisClasses;

class CovisClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovisClasses::create([
            'code' => 'RGL',
            'name' => 'Regular',
            'note' => 'Regular class inside of town',
            'is_active' => 1,
            'created_by' => 'System Administrator',
        ]);
        CovisClasses::create([
            'code' => 'OBM',
            'name' => 'LK Motor',
            'note' => 'Out of town duty by motorcycle',
            'is_active' => 1,
            'created_by' => 'System Administrator',
        ]);
        CovisClasses::create([
            'code' => 'OBC',
            'name' => 'LK Mobil',
            'note' => 'Out of town duty by car',
            'is_active' => 1,
            'created_by' => 'System Administrator',
        ]);
    }
}
