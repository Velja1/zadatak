<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategorijeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategorije')->insert([
            'naziv'=>'Katerogija 1'
        ]);
        DB::table('kategorije')->insert([
            'naziv'=>'Katerogija 2'
        ]);
        DB::table('kategorije')->insert([
            'naziv'=>'Katerogija 3'
        ]);
        DB::table('kategorije')->insert([
            'naziv'=>'Katerogija 4'
        ]);
        DB::table('kategorije')->insert([
            'naziv'=>'Katerogija 5'
        ]);
    }
}
