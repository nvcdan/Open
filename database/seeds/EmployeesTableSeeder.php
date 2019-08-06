<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

            $employee = Employee::create([
                'user_id'                        => 2,
                'project_id'                     => 1,
                'job_title'                      => $faker->jobTitle,
                'responsability'                 => $faker->word,
            ]);

            $employee->save();
        }
}
