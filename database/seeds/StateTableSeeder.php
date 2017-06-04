<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            'name' => 'Brussel'
        ]);
        DB::table('states')->insert([
            'name' => 'Vlaanderen'
        ]);
        DB::table('states')->insert([
            'name' => 'Wallonië'
        ]);
    }
}
