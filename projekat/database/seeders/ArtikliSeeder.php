<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('artikli')->insert([
            'naziv'=>'Artikal 1',
            'opis'=>'Opis artikla 1',
            'slikaLink'=>'slika1.jpg',
            'stanje'=>100,
            'osnovnaCena'=>1200,
            'procenatPopusta'=>0,
            'id_kategorija'=>1
        ]);
        DB::table('artikli')->insert([
            'naziv'=>'Artikal 2',
            'opis'=>'Opis artikla 2',
            'slikaLink'=>'slika2.jpg',
            'stanje'=>200,
            'osnovnaCena'=>2100,
            'procenatPopusta'=>10,
            'id_kategorija'=>1
        ]);
        DB::table('artikli')->insert([
            'naziv'=>'Artikal 3',
            'opis'=>'Opis artikla 3',
            'slikaLink'=>'slika3.jpg',
            'stanje'=>150,
            'osnovnaCena'=>1300,
            'procenatPopusta'=>5,
            'id_kategorija'=>2
        ]);
        DB::table('artikli')->insert([
            'naziv'=>'Artikal 4',
            'opis'=>'Opis artikla 4',
            'slikaLink'=>'slika4.jpg',
            'stanje'=>120,
            'osnovnaCena'=>1000,
            'procenatPopusta'=>0,
            'id_kategorija'=>3
        ]);
        DB::table('artikli')->insert([
            'naziv'=>'Artikal 5',
            'opis'=>'Opis artikla 5',
            'slikaLink'=>'slika5.jpg',
            'stanje'=>110,
            'osnovnaCena'=>500,
            'procenatPopusta'=>0,
            'id_kategorija'=>4
        ]);
    }
}
