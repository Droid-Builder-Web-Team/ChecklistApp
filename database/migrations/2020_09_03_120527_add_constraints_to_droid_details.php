<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToDroidDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Find all current droid ids
        $droidIds = App\Droid::all()->pluck('id')->toArray();
        $droidUserIds = App\DroidUser::all()->pluck('id')->toArray();

        // Clean up orphaned rows
        App\DroidDetail::whereNotIn('droids_id', $droidIds)->delete();
        App\DroidDetail::whereNotIn('droid_user_id', $droidUserIds)->delete();

        Schema::table('droid_details', function (Blueprint $table)
        {
            // link droid_id
            $table->unsignedBigInteger('droids_id')->change();
            $table->foreign('droids_id')->references('id')->on('droids')->onDelete('cascade');

            // link droid_user_id
            $table->unsignedBigInteger('droid_user_id')->change();
            $table->foreign('droid_user_id')->references('id')->on('droid_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('droid_details', function (Blueprint $table) {
            //
        });
    }
}
