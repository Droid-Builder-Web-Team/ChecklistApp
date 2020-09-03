<?php

use App\Droid;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToParts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Find all current ids
        $droidIds = App\Droid::all()->pluck('id')->toArray();

        // Clean up orphaned rows
        App\Part::whereNotIn('droids_id', $droidIds)->delete();

        Schema::table('parts', function (Blueprint $table)
        {
            // link droid_id
            $table->unsignedBigInteger('droids_id')->change();
            $table->foreign('droids_id')->references('id')->on('droids')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parts', function (Blueprint $table) {
            //
        });
    }
}
