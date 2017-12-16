<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(activityStatusSeeder::class);
        $this->call(counselorStatusSeeder::class);
        $this->call(managerStatusSeeder::class);
        $this->call(activityTypeSeeder::class);
        $this->call(staffTypeSeeder::class);
        $this->call(organizationTypeSeeder::class);
        $this->call(organizationRoleSeeder::class);
        $this->call(userTypeSeeder::class);
        $this->call(facilityDepartmentSeeder::class);
        $this->call(organizationStatusSeeder::class);
        $this->call(CounselorSeeder::class);
        $this->call(ManagerSeeder::class);


    }
}
