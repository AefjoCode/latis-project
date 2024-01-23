<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            [
                'nama_lembaga' => 'latiseducation'
            ],
            [
                'nama_lembaga' => 'tutorindonesia'
            ]
        ]);
    }
}
