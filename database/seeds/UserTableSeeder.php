<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Admin')->first();
        $role_user = Role::where('name', 'User')->first();

	    $user = new User();
	    $user->name = 'Admin';
	    $user->email = 'admin@example.com';
	    $user->password = bcrypt('123456');
	    $user->save();
	    $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@example.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
