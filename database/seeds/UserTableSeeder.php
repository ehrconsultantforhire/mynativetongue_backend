<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = 
        [
	        [   
            'name' =>  'Admin',
            'email' =>     'admin@gmail.com',
            'age'=> 0,
            'country_code'=> '+91',
            'mobile_no'=> '1234567890',
            'password' =>   bcrypt('Admin@123'),
            'role_id' =>    1,
            'email_verified' =>  'yes',
	        'status' =>  'active',
	        'created_at'   =>  date('Y-m-d H:i:s'),
	        'updated_at'   =>  date('Y-m-d H:i:s'),
	        ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('users')->insert($user);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
