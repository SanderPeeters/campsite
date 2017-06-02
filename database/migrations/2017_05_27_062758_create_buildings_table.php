<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campsite_id')->unsigned;
            $table->integer('capacity')->nullable();
            $table->boolean('has_water')->default(0);
            $table->boolean('has_electricity')->default(0);
            $table->boolean('has_wifi')->default(0);
            $table->boolean('has_kitchen')->default(0);
            $table->integer('beds')->nullable();
            $table->integer('showers')->nullable();
            $table->integer('toilets')->nullable();
            $table->text('extra_info')->nullable();
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
        Schema::dropIfExists('buildings');
    }
}
