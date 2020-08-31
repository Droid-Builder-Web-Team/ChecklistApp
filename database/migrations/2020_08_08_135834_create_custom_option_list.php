<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOptionList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_option_list', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('version');
            $table->string('section');
            $table->string('frontImage');
            $table->string('sideImageFore')->nullable()->default(NULL);
            $table->string('sideImageBack')->nullable()->default(NULL);
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
        Schema::dropIfExists('custom_option_list');
    }
}
