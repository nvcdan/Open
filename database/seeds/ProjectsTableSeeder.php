<?php

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $project = Project::create([
            'name'            => $faker->randomElement($array = array('Hospiweb','From Vacation','Bio-Medical', 'WeBill', 'Eng Translation', 'Medix ', 'Some Creations', 'Schooly Help', 'Christmas Letter')),
            'description'      => $faker->paragraph(2, true),
            'instruction'      => $faker->paragraph(3, true),
            'deadline'         => $faker->dateTimeBetween($startDate = 'now', $endDate = '2 weeks'),
            'currency'         => $faker->currencyCode,
            'budget'           => $faker->randomNumber($nbDigits = 4),
            'user_id'          => 1,
        ]);
        
        $project->save();
        }

    }

