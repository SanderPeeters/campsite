<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressColumnsToCampsiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campsites', function (Blueprint $table) {
            $table->string('latitude', 255)->change();
            $table->string('longitude', 255)->change();
            $table->renameColumn('address', 'street');
            $table->string('city');
            $table->string('zipcode');
            $table->integer('province_id')->unsigned();
            $table->integer('state_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campsites', function (Blueprint $table) {
            //
        });
    }
}
