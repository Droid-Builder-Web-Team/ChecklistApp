<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDroidIdOnDroidUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('droid_user', function (Blueprint $table)
        {
            // $table->renameColumn('droid_id', 'droids_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('droid_user', function (Blueprint $table)
        {
            $table->renameColumn('droids_id', 'droid_id');
        });
    }
}
