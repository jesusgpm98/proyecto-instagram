<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('images')->insert([
        'image_path' => 'foto1.jpg',
        'description' => 'primera foto',
        'user_id' => '1'
      ]);

      DB::table('images')->insert([
        'image_path' => 'foto2.jpg',
        'description' => 'segunda foto',
        'user_id' => '2'
      ]);
    }
}
