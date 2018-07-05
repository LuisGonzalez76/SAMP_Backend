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
            ['id' => 1, 'building' => 'Chardon', 'space' => 'Figueroa Chapel', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 2, 'building' => 'Centro de Estudiantes', 'space' => 'Salón Tarzan', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 3, 'building' => 'Chardon', 'space' => 'La Placita','facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 4, 'building' => 'Centro de Estudiantes', 'space' => 'Tercer Piso', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 5, 'building' => 'Stefani', 'space' => 'S-230', 'facilityDepartment' => 'Ingeniería Mecánica', 'isActive' => 1],
            ['id' => 6, 'building' => 'Centro de Estudiantes', 'space' => '1er piso - Frente a ATH', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 7, 'building' => 'Centro de Estudiantes', 'space' => '2do piso- Salón Tarzán', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 8, 'building' => 'Centro de Estudiantes', 'space' => '3er piso - Tarima', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 9, 'building' => 'Centro de Estudiantes', 'space' => '3er piso - Terraza Externa', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 10, 'building' => 'Centro de Estudiantes', 'space' => '4to piso - Sala de Tranquilidad', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 11, 'building' => 'Centro de Estudiantes', 'space' => '4to piso - Mezzanine', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 12, 'building' => 'Centro de Estudiantes', 'space' => '6to piso - CE600 Salas de Entrevistas', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 13, 'building' => 'Celis', 'space' => 'Celis - 008', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 14, 'building' => 'Celis', 'space' => 'Celis - 009', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 15, 'building' => 'Celis', 'space' => 'Celis - 010', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 16, 'building' => 'Celis', 'space' => 'Celis - Anfiteatro 116', 'facilityDepartment' => 'Asuntos Academicos', 'isActive' => 1],
            ['id' => 17, 'building' => 'Celis', 'space' => 'Celis - 119', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 18, 'building' => 'Celis', 'space' => 'Celis - 202', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 19, 'building' => 'Celis', 'space' => 'Celis - 302', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 20, 'building' => 'Celis', 'space' => 'Celis - 305', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 21, 'building' => 'Física', 'space' => 'Departamento de Matemáticas', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 22, 'building' => 'Física', 'space' => 'F-A', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 23, 'building' => 'Física', 'space' => 'F-B', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 24, 'building' => 'Física', 'space' => 'F-C', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 25, 'building' => 'Física', 'space' => 'Lobby de Geología', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 26, 'building' => 'Física', 'space' => 'Lobby de Ciencias Marinas', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 27, 'building' => 'Stefani', 'space' => 'S-203', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 28, 'building' => 'Stefani', 'space' => 'S-204', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 29, 'building' => 'Stefani', 'space' => 'S-205', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 30, 'building' => 'Stefani', 'space' => 'S-230', 'facilityDepartment' => 'Ingeniería Mecánica', 'isActive' => 1],
            ['id' => 31, 'building' => 'Stefani', 'space' => 'Lobby de Stefani', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 32, 'building' => 'Stefani', 'space' => 'Mesa A', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 33, 'building' => 'Stefani', 'space' => 'Mesa B', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 34, 'building' => 'Stefani', 'space' => 'Mesa C', 'facilityDepartment' => 'Ingeniería Electrica', 'isActive' => 1],
            ['id' => 35, 'building' => 'Chardón', 'space' => 'Lobby de Chardón', 'facilityDepartment' => ' Decanato de Administración', 'isActive' => 1],
            ['id' => 36, 'building' => 'Chardón', 'space' => 'Pared de Chardón abajo', 'facilityDepartment' => ' Decanato de Administración', 'isActive' => 1],
            ['id' => 37, 'building' => 'Chardón', 'space' => 'CH-221', 'facilityDepartment' => 'Departamento de Inglés', 'isActive' => 1],
            ['id' => 38, 'building' => 'Chardón', 'space' => 'CH-222', 'facilityDepartment' => 'Departamento de Inglés', 'isActive' => 1],
            ['id' => 39, 'building' => 'Chardón', 'space' => 'CH-223', 'facilityDepartment' => 'Departamento de Inglés', 'isActive' => 1],
            ['id' => 40, 'building' => 'Chardón', 'space' => 'CH-224', 'facilityDepartment' => 'Departamento de Inglés', 'isActive' => 1],
            ['id' => 41, 'building' => 'Chardón', 'space' => 'CH-225', 'facilityDepartment' => 'Departamento de Inglés', 'isActive' => 1],
            ['id' => 42, 'building' => 'Biblioteca', 'space' => 'Lobby de Biblioteca', 'facilityDepartment' => 'Biblioteca General', 'isActive' => 1],
            ['id' => 43, 'building' => 'Biblioteca', 'space' => 'Salas de Estudio', 'facilityDepartment' => 'Biblioteca General', 'isActive' => 1],
            ['id' => 44, 'building' => 'Piñero', 'space' => 'Lobby de Piñero', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 45, 'building' => 'Piñero', 'space' => 'Anfiteatro Piñero 213', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 46, 'building' => 'Piñero', 'space' => 'Piñero 205', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 47, 'building' => 'Piñero', 'space' => 'Piñero 206', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 48, 'building' => 'Piñero', 'space' => 'Piñero 207', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 49, 'building' => 'Piñero', 'space' => 'Piñero 208', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 50, 'building' => 'Piñero', 'space' => 'Piñero 212', 'facilityDepartment' => 'Decano Asociado', 'isActive' => 1],
            ['id' => 51, 'building' => 'Biología', 'space' => 'Auditorio B-392', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 52, 'building' => 'Biología', 'space' => 'Lobby de Biología', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 53, 'building' => 'Biología', 'space' => 'Salón de Biología', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 54, 'building' => 'Enfermería', 'space' => 'Anfiteatro de Enfermería', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 55, 'building' => 'Enfermería', 'space' => 'Lobby de Enfermería', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 56, 'building' => 'Enfermería', 'space' => 'Salón de Enfermería', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 57, 'building' => 'Química', 'space' => 'Sala Abbot', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 58, 'building' => 'Química', 'space' => 'Edificio de Sánchez Hidalgo', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 59, 'building' => 'Química', 'space' => 'Sala de Proyección 203', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 60, 'building' => 'Química', 'space' => 'Sala de Proyección 204', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 61, 'building' => 'Administración de Empresas', 'space' => 'AE - 242', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 62, 'building' => 'Administración de Empresas', 'space' => 'AE - 248', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 63, 'building' => 'Administración de Empresas', 'space' => 'Salón AE - 305', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 64, 'building' => 'Administración de Empresas', 'space' => 'Salón AE - 405', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 65, 'building' => 'Administración de Empresas', 'space' => 'Patio Interior', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],
            ['id' => 66, 'building' => 'Administración de Empresas', 'space' => 'Lobby de Empresas', 'facilityDepartment' => 'Actividades Sociales', 'isActive' => 1],

        ]);
    }
}
