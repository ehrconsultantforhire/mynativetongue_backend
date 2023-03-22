<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = 
        [
            [
            'name' =>  'admin',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ],
            [
            'name' =>  'user',
            'created_at'   =>  date('Y-m-d H:i:s'),
            'updated_at'   =>  date('Y-m-d H:i:s'),
            ]
        ];
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::table('roles')->insert($roles);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
