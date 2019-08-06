<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $userRole = UserRole::create([
                'user_id'                        => 1,
                'role_id'                        => 1,
            ]);

            $userRole = UserRole::create([
                'user_id'                        => 2,
                'role_id'                        => 2,
            ]);

            $userRole->save();
        }
}
