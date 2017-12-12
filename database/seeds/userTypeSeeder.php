<?php

use Illuminate\Database\Seeder;

class userTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_types')->insert([
            ['code' => 1,'description' => 'Admin','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Staff','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Estudiante','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 4,'description' => 'Consejero','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 5,'description' => 'Encargado de Facilidades','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
