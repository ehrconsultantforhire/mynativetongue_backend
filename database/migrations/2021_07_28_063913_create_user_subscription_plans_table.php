<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSubscriptionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_subscription_plans', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->BigInteger('user_id');
            $table->BigInteger('plan_id');
            $table->BigInteger('transaction_id');
            $table->date('subscription_start_date');
            $table->date('subscription_end_date');
            $table->enum('status',['active','inactive'])->default('inactive');
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
        Schema::dropIfExists('user_subscription_plans');
    }
}
