<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultPartSubsection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        App\Part::whereNull('sub_section')->update([
            'sub_section' => 'Print Files'
        ]);
        Schema::table('parts', function (Blueprint $table)
        {
            $table->string('sub_section')->default('Print Files')->change();
            $table->string('sub_section')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
