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
            'name' => 'Super User',
            'email' => 'superuser@gmail.com',
            'phonenumber'=>'+254723274774',
            'role_id' => 1,
            'password' => bcrypt('trial123'),
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
    }
}
