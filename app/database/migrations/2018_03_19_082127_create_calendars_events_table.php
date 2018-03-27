<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendars_id')->unsigned();
            $table->integer('events_id')->unsigned();
            $table->foreign('calendars_id')->references('id')->on('calendars');
            $table->foreign('events_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calendars_events');
    }
}
