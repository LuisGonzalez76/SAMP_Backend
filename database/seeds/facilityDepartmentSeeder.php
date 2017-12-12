<?php

use Illuminate\Database\Seeder;

class facilityDepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('facility_departments')->insert([
            ['code' => 1,'description' => 'Ingenieria','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Sociales','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Humanidades','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
