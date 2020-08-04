<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroidsTable extends Migration
{
    /**
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droids', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('description');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('droids');
    }
}


