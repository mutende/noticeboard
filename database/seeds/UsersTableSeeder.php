<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Zalego Admin',
            'email' => 'admin@zalego.com',
            'phonenumber'=>'+254723274774',
            'role_id' => 1,
            'password' => bcrypt('zalego123'),
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
    }
}
