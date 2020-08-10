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
            $table->string('droid_designation')->nullable()->default(NULL);
            $table->string('builder_name')->nullable()->default(NULL);
            $table->string('description')->nullable()->default(NULL);
            $table->string('colors')->nullable()->default(NULL);
            $table->string('mobility')->nullable()->default(NULL);
            $table->string('electronics')->nullable()->default(NULL);
            $table->string('control_system')->nullable()->default(NULL);
            $table->string('drive_system')->nullable()->default(NULL);
            $table->string('power')->nullable()->default(NULL);
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
