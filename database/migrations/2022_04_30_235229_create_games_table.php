<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('dev_id');
            $table->string('game_name');
            $table->string('game_version');
            $table->integer('price');
            $table->json('promotional'); // type(img, video), placeholder, url, desc
            $table->string('game_data_path');
            $table->dateTime('date_published');
            $table->string('short_desc');
            $table->string('content_rating')->default('PEGI 7');
            $table->text('about_game');
            $table->string('requirement_processor');
            $table->string('requirement_os');
            $table->string('requirement_memory');
            $table->string('requirement_graphic');
            $table->string('requirement_storage');
            $table->enum('status', ['pending', 'published', 'denied'])->default('pending');
            $table->text('admin_note')->nullable();

            $table->timestamps();

            $table->foreign('genre_id')->references('id')->on('game_genres');
            $table->foreign('dev_id')->references('id')->on('developers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}
