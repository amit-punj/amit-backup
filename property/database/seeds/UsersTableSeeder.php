<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('users')->insert([
		    'name' => "Admin",
		    'last_name' => "Admin",
		    'email' => 'admin@gmail.com',
		    'password' => bcrypt('admin@123'),
		    'user_role' => 0,
		]);
        echo "Insert Successfully Email: admin@gmail.com, Password: admin@123";
    }
}
