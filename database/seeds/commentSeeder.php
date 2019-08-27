<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class commentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('comments')->insert([
        'content' => 'buena foto amigos',
        'user_id' => '1',
        'image_id' => '1'
      ]);

      DB::table('comments')->insert([
        'content' => 'Que lindos',
        'user_id' => '2',
        'image_id' => '2'
      ]);
    }
}
