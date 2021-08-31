<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name'=>'Admin']);
DB::table('user_role')->insert(['user_id'=>'1' , 'role_id'=>'1']);
DB::table('roles')->insert(['name'=>'User']);
DB::table('user_role')->insert(['user_id'=>'1' , 'role_id'=>'2']);

    }
}
