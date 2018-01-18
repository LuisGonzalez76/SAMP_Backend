<?php

use Illuminate\Database\Seeder;

class organizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_types')->insert([
            ['code' => 1,'description' => 'Académica','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Artes','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Profesional','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 4,'description' => 'Cívica','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 5,'description' => 'Religiosa','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 6,'description' => 'Deportiva','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 7,'description' => 'Política','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 8,'description' => 'Social','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 9,'description' => 'Otros','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
