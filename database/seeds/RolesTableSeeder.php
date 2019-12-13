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
        ]);
        DB::table('roles')->insert([
            'role'=> 'Operations',
        ]);
        DB::table('roles')->insert([           
            'role' => 'Administration',
        ]);
        DB::table('roles')->insert([            
            'role' => 'Finance',    
        ]);
        DB::table('roles')->insert([    
            'role' => 'Human Resource',           
        ]);
        DB::table('roles')->insert([           
            'role'=> 'Instructors',    
        ]);

        DB::table('roles')->insert([
            'id'=>0,
            'role'=> 'All Staff',
        ]);
    }
}
