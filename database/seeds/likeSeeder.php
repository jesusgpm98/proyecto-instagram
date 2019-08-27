<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class likeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('likes')->insert([
        'user_id' => '1',
        'image_id' => '1'
      ]);

      DB::table('likes')->insert([
        'user_id' => '2',
        'image_id' => '2'
      ]);
    }
}
