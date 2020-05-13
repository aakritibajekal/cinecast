<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;

class ProfilesTableSeeder extends Seeder
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
    
        foreach( range(1, 50) as $index )
         {
            DB::table( 'profiles' )->insert( array(
                'username' => $faker->name,
                'profile_pic' => $faker->imageUrl($width = 640, $height = 480),
                'bio' => $faker->paragraph,
                'user_id' => $faker->unique()->randomElement(User::pluck( 'id' )->toArray()),
            ));
    }

    }
}
