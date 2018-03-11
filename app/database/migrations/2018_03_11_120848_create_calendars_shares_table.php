<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars_shares', function (Blueprint $table) {
            $table->integer('calendars_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('access_levels_id')->unsigned();
            $table->foreign('calendars_id')->references('id')->on('calendars');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('access_levels_id')->references('id')->on('access_levels');
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
        Schema::dropIfExists('calendars_shares');
    }
}
