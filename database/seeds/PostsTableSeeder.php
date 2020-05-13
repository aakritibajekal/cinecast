<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
    
        foreach( range(1, 40) as $index )
         {
            DB::table( 'posts' )->insert( array(
                'content' => $faker->paragraph,
                'picture' => $faker->imageUrl($width = 640, $height = 480),
                'user_id' => $faker->randomElement(User::pluck( 'id' )->toArray()), 
                'likes_count' => $faker->randomDigitNotNull,
                'posted_at' => $faker->dateTimeThisYear(),
                
            ));
    }

    }
}
