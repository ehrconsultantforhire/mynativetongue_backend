<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPlanIdColumnWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('words', function (Blueprint $table) {
            $table->unsignedBigInteger('plan_id')->nullable()->after('id');
            $table->unsignedBigInteger('language_id')->nullable()->after('plan_id');
            $table->foreign('plan_id')->references('id')->on('subscription_plans')->onDelete('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
