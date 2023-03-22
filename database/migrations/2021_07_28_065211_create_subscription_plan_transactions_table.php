<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan_transactions', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->BigInteger('user_id');
            $table->BigInteger('plan_id');
            $table->string('transaction_id');
            $table->dateTime('transaction_time');
            $table->float('transaction_amount',8,2);
            $table->enum('transaction_status',['completed','pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plan_transactions');
    }
}
