<?php

use Illuminate\Database\Seeder;

class MovementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('movements')->insert([
            'name' => 'Chiro',
            'filename' => 'logo-chiro.png'
        ]);
        DB::table('movements')->insert([
            'name' => 'JNM',
            'filename' => 'logo-jnm.png'
        ]);
        DB::table('movements')->insert([
            'name' => 'KLJ',
            'filename' => 'logo-klj.png'
        ]);
        DB::table('movements')->insert([
            'name' => 'KSA',
            'filename' => 'logo-ksa.png'
        ]);
        DB::table('movements')->insert([
            'name' => 'Scouts',
            'filename' => 'logo-scouts.png'
        ]);
        DB::table('movements')->insert([
            'name' => 'Anders',
            'filename' => 'logo-other.svg'
        ]);
    }
}
