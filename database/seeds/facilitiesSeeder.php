<?php

use Illuminate\Database\Seeder;

class facilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('facilities')->insert([
            ['id' => 1, 'building' => 'Chardon', 'space' => 'Figueroa Chapel',
                'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 2, 'building' => 'Centro de Estudiantes', 'space' => 'Salón Tarzan',
                'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 3, 'building' => 'Chardon', 'space' => 'La Placita',
                'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 4, 'building' => 'Centro de Estudiantes', 'space' => 'Tercer Piso',
                'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 5, 'building' => 'Stefani', 'space' => 'S-230',
                'facilityDepartment' => 'Ingeniería Mecánica', 'isActive' => 1],
            ['id' => 6, 'building' => 'Stefani', 'space' => 'Lobby',
                'facilityDepartment' => 'Ingeniería Eléctrica', 'isActive' => 1],
        ]);
    }
}
