<?php

use Illuminate\Database\Seeder;

class organizationRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organization_roles')->insert([
            ['code' => 1,'description' => 'Presidente','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 2,'description' => 'Vice-Presidente','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 3,'description' => 'Secretario','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 4,'description' => 'Tesorero','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')],
            ['code' => 5,'description' => 'Miembro','created_at' => DB::raw('now()'),
                'updated_at' => DB::raw('now()')]
        ]);
    }
}
