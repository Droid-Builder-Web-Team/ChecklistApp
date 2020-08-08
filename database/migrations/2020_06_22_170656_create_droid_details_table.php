<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroidDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droid_details', function (Blueprint $table) {
            $table->id();
            $table->integer('droid_user_id')->unsigned();
            $table->integer('droids_id');
            $table->string('droid_designation');
            $table->string('builder_name');
            $table->string('description');
            $table->string('colors');
            $table->string('mobility');
            $table->string('electronics');
            $table->string('control_system');
            $table->string('drive_system');
            $table->string('power');
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
        Schema::dropIfExists('droid_details');
    }
}
