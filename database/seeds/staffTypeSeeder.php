<?php

use Illuminate\Database\Seeder;

class staffTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('staff_types')->insert([
            ['code' => 1,'description' => 'Admin','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Staff','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
