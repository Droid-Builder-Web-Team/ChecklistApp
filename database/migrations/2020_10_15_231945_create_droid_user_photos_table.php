<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDroidUserPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('droid_user_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('droid_user_id')->references('id')->on('droid_user')->onDelete('cascade');
            $table->string('path');
            $table->boolean('cover')->default(false);
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
        Schema::dropIfExists('droid_user_photos');
    }
}
