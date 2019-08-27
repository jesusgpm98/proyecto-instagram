<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('users')->insert([
      'role' => 'User',
      'name' => 'Jesus',
      'lastName' => 'Perez',
      'username' => 'sadmin',
      'email' => 'jesusgabriel_98@hotmail.com',
      'password' => Hash::make('sadmin')
    ]);

    DB::table('users')->insert([
      'role' => 'User',
      'name' => 'Catherine',
      'lastName' => 'Lucero',
      'username' => 'clucero',
      'email' => 'cl819133@gmail.com',
      'password' => Hash::make('sadmin')
    ]);
  }
}
