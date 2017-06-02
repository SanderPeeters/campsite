<?php

use Illuminate\Database\Seeder;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            'name' => 'Antwerpen'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Brussels Hoofdstedelijk Gewest'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Henegouwen'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Limburg'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Luik'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Luxemburg'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Namen'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Oost-Vlaanderen'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Vlaams-Brabant'
        ]);
        DB::table('provinces')->insert([
            'name' => 'Waals-Brabant'
        ]);
        DB::table('provinces')->insert([
            'name' => 'West-Vlaanderen'
        ]);
    }
}
