<?php

use Illuminate\Database\Seeder;

class organizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('organizations')->insert([
            ['id'=>1,'organizationName'=>'Asociación de Ex-Alumnos del Colegio de Agricultura y Artes Mecánicas',
                'organizationInitials'=>'ALUMNI','organizationType_code'=>1,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
                ],
            ['id'=>2,'organizationName'=>'Asoc. de Ingeniería Civil y Agrimensura',
                'organizationInitials'=>'AICA','organizationType_code'=>1,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>3,'organizationName'=>'American Institute of Chemical Engineers',
                'organizationInitials'=>'AICHE','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>4,'organizationName'=>'Institute of Electrical and Electronics Engineers',
                'organizationInitials'=>'IEEE','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>5,'organizationName'=>'Sociedad de Ingenieros Hispanos Profesionales',
                'organizationInitials'=>'SHPE','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>6,'organizationName'=>'TEATRUM',
                'organizationInitials'=>'TEATRUM','organizationType_code'=>2,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>7,'organizationName'=>'Society of Women Engineers',
                'organizationInitials'=>'SWE','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>8,'organizationName'=>'Tau Beta Pi',
                'organizationInitials'=>'TBP','organizationType_code'=>1,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>9,'organizationName'=>'Colegio Chess Club',
                'organizationInitials'=>'CAC','organizationType_code'=>6,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>10,'organizationName'=>'Jóvenes Cristianos del Parque',
                'organizationInitials'=>'JCP','organizationType_code'=>5,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>11,'organizationName'=>'National Society of Professional Engineers',
                'organizationInitials'=>'NSPE','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>12,'organizationName'=>'Grupo de Estudiantes de Apoyo del Recinto',
                'organizationInitials'=>'GEAR','organizationType_code'=>4,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>13,'organizationName'=>'Green Buildings & Sustainability',
                'organizationInitials'=>'GBS','organizationType_code'=>8,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>14,'organizationName'=>'MEDLIFE',
                'organizationInitials'=>'MEDLIFE','organizationType_code'=>1,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>15,'organizationName'=>'National Society of Leadership and Success',
                'organizationInitials'=>'NSLS','organizationType_code'=>3,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>16,'organizationName'=>'Grupo Apostolado Católico',
                'organizationInitials'=>'GAC','organizationType_code'=>5,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>17,'organizationName'=>'Asociación de Estudiantes de Matemáticas y Ciencias en Computación',
                'organizationInitials'=>'AEMCC','organizationType_code'=>1,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ],
            ['id'=>18,'organizationName'=>'CHORIUM',
                'organizationInitials'=>'CHORIUM','organizationType_code'=>2,'isActive'=>1,
                'created_at' => DB::raw('now()'),'updated_at' => DB::raw('now()')
            ]

        ]);
    }
}
