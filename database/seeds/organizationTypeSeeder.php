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
            ['code' => 1,'description' => 'Profesional','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Honor','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Arte','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
