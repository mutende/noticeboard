<?php

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
        DB::table('roles')->insert([
            'role'=> 'Superuser',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'role'=> 'Operations',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'role' => 'Administration',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'role' => 'Finance',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'role' => 'HR',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        DB::table('roles')->insert([
            'role'=> 'Instructors',
            'created_at'=> date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([

            'role'=> 'All Staff',
            'created_at'=> date('Y-m-d H:i:s'),

        ]);
    }
}
