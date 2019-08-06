<?php

use App\Models\User;
use App\Models\UserRole;
use App\Models\Role;
use Illuminate\Database\Seeder;


class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('slug', '=', 'supervisor')->first() === null) {
            $SupervisorRole = Role::create([
                'name'        => 'Supervisor',
                'slug'        => 'supervisor',
                'description' => 'Supervisor Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('slug', '=', 'employee')->first() === null) {
            $employeeRole = Role::create([
                'name'        => 'Employee',
                'slug'        => 'employee',
                'description' => 'Employee Role',
                'level'       => 1,
            ]);
        }
    }
}
