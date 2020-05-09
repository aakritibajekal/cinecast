<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('follower_id')->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->boolean('followed')->nullable();
            $table->timestamps();

            $table->foreign( 'follower_id' )
            ->references( 'id' )
            ->on( 'profiles' )
            ->onDelete( 'cascade' );

            $table->foreign( 'profile_id' )
            ->references( 'id' )
            ->on( 'profiles' )
            ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
