<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Profile;
use App\Post;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();
    
        foreach( range(1, 10) as $index ) {
            DB::table( 'comments' )->insert( array(
                'content' => $faker->paragraph,
                'profile_id' => $faker->randomElement(Profile::pluck( 'id' )->toArray()),
                'post_id' => $faker->randomElement(Post::pluck( 'id' )->toArray()),
            ));
    }

    }
}
