<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $user = new User();

        // Seed test admin
        $seededSupervisorEmail = 'admin@admin.com';
        $roleSupervisor = Role::where('slug','=','supervisor')->first();
        $user = User::where('email', '=', $seededSupervisorEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededSupervisorEmail,
                'password'                       => Hash::make('password'),
                'remember_token'                 => str_random(64),

            ]);
            
            $user->save();
        }
        
        // Seed test user
        $seededEmployeeEmail = 'user@user.com';
        $roleEmployee = Role::where('slug','=','employee')->first();
        $user = User::where('email', '=', $seededEmployeeEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededEmployeeEmail,
                'password'                       => Hash::make('password'),
                'remember_token'                 => str_random(64),
            ]);

            $user->save();
        }

    }
}
