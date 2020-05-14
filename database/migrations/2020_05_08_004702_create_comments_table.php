<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create( 'comments', function (Blueprint $table ) {
            $table->id();
            $table->longText( 'content' );
            $table->boolean( 'is_gif' )->default( false );
            $table->unsignedBigInteger( 'user_id' )->nullable();
            $table->unsignedBigInteger( 'post_id' )->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references( 'id' )
                ->on( 'users' )
                ->onDelete( 'cascade' );

            $table->foreign( 'post_id' )
                ->references( 'id' )
                ->on( 'posts' )
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
        Schema::dropIfExists('comments');
    }
}
