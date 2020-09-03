<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToDroidUser extends Migration
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
        $userIds = App\User::all()->pluck('id')->toArray();

        // Clean up orphaned rows
        App\DroidUser::whereNotIn('droids_id', $droidIds)->delete();
        App\DroidUser::whereNotIn('user_id', $userIds)->delete();


        Schema::table('droid_user', function (Blueprint $table)
        {
            // link droid_id
            $table->unsignedBigInteger('droids_id')->change();
            $table->foreign('droids_id')->references('id')->on('droids')->onDelete('cascade');

            // link user_id
            $table->unsignedBigInteger('user_id')->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('droid_user', function (Blueprint $table) {
            //
        });
    }
}
