<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'code' => '001',
            'name' => 'Wulung Sujayatno',
        ]);

        DB::table('teams')->insert([
            'code' => '002',
            'name' => 'Dwiyana Adipoetra',
        ]);
    }
}
