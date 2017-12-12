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
            ['code' => 2,'description' => 'Arte','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Religiosa','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 4,'description' => 'Venta','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
