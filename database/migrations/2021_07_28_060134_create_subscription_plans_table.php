<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->float('price',8,2);
            $table->BigInteger('words');
            $table->BigInteger('min_words')->nullable();
            $table->BigInteger('show_words')->nullable();
            $table->enum('team_type',['fixed','unlimited'])->default('fixed');
            $table->BigInteger('teams');
            $table->time('game_play_time');
            $table->enum('random_words',['yes','no'])->default('yes');
            $table->enum('sound_effects',['yes','no'])->default('yes');
            $table->enum('plan_type',['paid','free'])->default('paid');
            $table->BigInteger('validity_in_months')->nullable();
            $table->enum('status',['active','inactive'])->default('active');
            $table->BigInteger('action_by')->nullable();
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
        Schema::dropIfExists('subscription_plans');
    }
}
