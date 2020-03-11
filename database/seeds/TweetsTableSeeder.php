<?php

use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //First Tweet
      DB::table('tweets')->insert(array(
        'user_id' => rand(2,6),
        'message' => 'My first tweet!'
      ));

      //Second Tweet
      DB::table('tweets')->insert(array(
        'user_id' => rand(2,6),
        'message' => 'Hello, world!'
      ));

      //Third Tweet
      DB::table('tweets')->insert(array(
        'user_id' => rand(2,6),
        'message' => 'Yo! Sup?'
      ));

      //Let's try faker to prepopulate with lots of imaginary data quickly!

      $faker = Faker\Factory::create();

      foreach(range(1, 5) as $index){
        DB::table('users')->insert(array(
          'name' => $faker->name,
          'email' => $faker->email,
          'password' => $faker->password
        ));
      DB::table('tweets')->insert(array(
        'user_id'=>$faker->numberBetween($min = 2, $max = 6),
        'message'=>$faker->catchphrase
      ));
      }
    }
}
