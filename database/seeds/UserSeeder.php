<?php
use \App\User;
use \App\Profession;
use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$professions = DB::select('SELECT id FROM professions WHERE title = ?', ['Back-end developer']);
        // $professions = DB::table('professions')->select('id')->take(1)->get();
        // $profession = DB::table('professions')->select('id', 'title')->where('title','=', 'Back-end developer')->first();

        $professionId = Profession::whereTitle('Back-end developer')
            ->value('id');
        // dd($profession);

        

        User::create([
            'name' => 'Carlos Crispin',
            'email' => 'carlos.crispin.cc@gmail.com',
            'password' =>  bcrypt('laravel'),
            'profession_id' => $professionId,
            'is_admin' => true
        ]);

        factory(User::class)->create([
            'profession_id' => $professionId
        ]);

        factory(User::class, 25)->create();

        /* User::create([
            'name' => 'Magarita Gomez',
            'email' => 'Magos@gmail.com',
            'password' =>  bcrypt('laravel'),
            'profession_id' => $professionId
        ]);
    
        User::create([
            'name' => 'Motserrat Mendoza',
            'email' => 'monyrrat@gmail.com',
            'password' =>  bcrypt('laravel'),
            'profession_id' => null
        ]); */
    }
}
