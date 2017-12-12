<?php

use Illuminate\Database\Seeder;

class organizationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_statuses')->insert([
            ['code' => 1,'description' => 'Activa','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Inactiva','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
