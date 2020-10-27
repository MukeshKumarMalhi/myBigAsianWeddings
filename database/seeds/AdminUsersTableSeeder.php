<?php

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $id = uniqid();
      DB::table('users')->insert([
          'id' => $id,
          'role_id' => 1,
          'name' => "Omar Ali",
          'email' => 'admin_omar_ali@gmail.com',
          'password' => bcrypt('omarali123456')
      ]);
    }
}
