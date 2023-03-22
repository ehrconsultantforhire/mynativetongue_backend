<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->int('age');
            $table->string('country_code')->nullable();
            $table->string('mobile_no');
            $table->string('profile_image')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->enum('email_verified',['yes','no'])->default('no');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->enum('is_subscribed',['true','false'])->default('false');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
