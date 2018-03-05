<?php

use Illuminate\Database\Seeder;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['id'=>1,'userEmail'=>'jesse.villafane@upr.edu','userType_code'=>1]
        ]);

        DB::table('staff')->insert([
            ['id'=>1,'staffName'=>'Jesmarie Hernandez',
                'staffEmail'=>'jesse.villafane@upr.edu','staffPhone'=>'7871234567',
                'staffType_code'=>1,'user_id'=>1,'isActive'=>1]
        ]);

        DB::table('facilities_managers')->insert([
            ['id'=>1,'managerName'=>'Jesmarie Hernandez',
                'managerEmail'=>'jesse.villafane@upr.edu','managerPhone'=>'7871234567',
                'user_id'=>1,'isActive'=>0]
        ]);


    }
}
