<?php

use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
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
            DB::table( 'users' )->insert( array(
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $faker->password,
                'created_at' => date( "Y-m-d H:i:s" ),
            ));
    }

    }
}
