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
            ['id'=>1,'userEmail'=>'jesse.villafane@upr.edu','userType_code'=>1],
            ['id'=>2,'userEmail'=>'yomarachaliff.lucianofigueroa@upr.edu','userType_code'=>1]
        ]);

        DB::table('staff')->insert([
            ['id'=>1,'staffName'=>'Jesse Villafane',
                'staffEmail'=>'jesse.villafane@upr.edu','staffPhone'=>'9090',
                'staffType_code'=>1,'user_id'=>1,'isActive'=>1],
            ['id'=>2,'staffName'=>'Yomarachaliff Luciano',
                'staffEmail'=>'yomarachaliff.lucianofigueroa@upr.edu','staffPhone'=>'9090',
                'staffType_code'=>1,'user_id'=>2,'isActive'=>1]
        ]);

        DB::table('facilities_managers')->insert([
            ['id'=>1,'managerName'=>'Jesse Villafane',
                'managerEmail'=>'jesse.villafane@upr.edu','managerPhone'=>'9090',
                'user_id'=>1,'isActive'=>0],
            ['id'=>2,'managerName'=>'Yomarachaliff Luciano',
                'managerEmail'=>'yomarachaliff.lucianofigueroa@upr.edu','managerPhone'=>'9090',
                'user_id'=>2,'isActive'=>0]
        ]);


    }
}
