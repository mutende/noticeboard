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
            'role_id' => 1,
            'password' => bcrypt('trial123'),
        ]);
    }
}
