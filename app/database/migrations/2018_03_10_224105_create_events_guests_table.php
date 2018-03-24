<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_guests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('events_id')->unsigned();
            $table->integer('users_id')->unsigned();
            $table->integer('access_levels_id')->unsigned();
            $table->integer('invitation_statuses_id')->unsigned();
            $table->boolean('is_organizer')->default(false);
            $table->foreign('events_id')->references('id')->on('events');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('access_levels_id')->references('id')->on('access_levels');
            $table->foreign('invitation_statuses_id')->references('id')->on('invitation_statuses');
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
        Schema::dropIfExists('events_guests');
    }
}
