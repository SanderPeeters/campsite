<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeadowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meadows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campsite_id')->unsigned;
            $table->integer('capacity');
            $table->integer('sq_meters');
            $table->boolean('tents_allowed')->default(0);
            $table->boolean('campfire_allowed')->default(0);
            $table->boolean('has_water')->default(0);
            $table->boolean('has_electricity')->default(0);
            $table->text('extra_info');
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
        Schema::dropIfExists('meadows');
    }
}
