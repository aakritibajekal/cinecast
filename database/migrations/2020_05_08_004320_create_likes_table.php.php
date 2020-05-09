<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('likes_id')->nullable();
            $table->string('likeable_type');
            $table->softDeletes();
            $table->timestamps();

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
        Schema::dropIfExists('likes');
    }
}