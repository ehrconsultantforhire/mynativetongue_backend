<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_games', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('word_id');
            $table->enum('word_status',['correct','wrong','times_up','quit','pass','none'])->default('none');
            $table->timestamp('word_time');
            $table->foreign('member_id')->references('id')->on('team_members')->onDelete('cascade');
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_games');
    }
}
