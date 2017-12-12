<?php

use Illuminate\Database\Seeder;

class managerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('manager_statuses')->insert([
            ['code' => 1,'description' => 'Pendiente','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Aprobado','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Denegado','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
