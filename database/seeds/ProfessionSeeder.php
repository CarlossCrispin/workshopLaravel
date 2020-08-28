<?php

use \App\Profession;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Profession::create([
            'title' => 'Back-end developer', 
        ]);

        /*  DB::table('professions')->insert([
            'title' => 'Back-end developer', 
        ]); */

        Profession::create([
            'title' => 'Front-end developer',
        ]);

        Profession::create([
             'title' => 'Desing Web',   
        ]);

        Profession::create([
            'title' => 'Otro',
        ]);

        factory(Profession::class, 17 )->create();
    }
}
