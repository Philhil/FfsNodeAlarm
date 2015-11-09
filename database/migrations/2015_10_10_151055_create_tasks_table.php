<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('node_id')->unsigned();
            $table->foreign('node_id')->references('id')->on('nodes');
            $table->boolean('active');
            $table->timestamp('intervall')->nullable();
            $table->timestamp('lastrun')->nullable();
            $table->timestamp('offlinesince')->nullable();
            $table->timestamp('lastalert')->nullable();
            $table->boolean('smsalarm');
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
        Schema::drop('tasks');
    }
}
