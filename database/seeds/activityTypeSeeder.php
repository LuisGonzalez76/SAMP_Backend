<?php

use Illuminate\Database\Seeder;

class activityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('activity_types')->insert([
            ['code' => 1,'description' => 'Profesional','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Artística','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Religiosa','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 4,'description' => 'Recaudación','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 5,'description' => 'Social','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 6,'description' => 'Académica','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 7,'description' => 'Educativa','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 8,'description' => 'Cívica','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 9,'description' => 'Deportiva','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 10,'description' => 'Política','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 11,'description' => 'Venta de Comida','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],


        ]);
    }
}
