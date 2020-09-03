<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConstraintsToBuildProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Find all current ids
        $droidUserIds = App\DroidUser::all()->pluck('id')->toArray();
        $partIds = App\Part::all()->pluck('id')->toArray();

        // Clean up orphaned rows
        App\BuildProgress::whereNotIn('droid_user_id', $droidUserIds)->delete();
        App\BuildProgress::whereNotIn('part_id', $partIds)->delete();

        Schema::table('build_progress', function (Blueprint $table)
        {
            // link part_id
            $table->unsignedBigInteger('part_id')->change();
            $table->foreign('part_id')->references('id')->on('parts')->onDelete('cascade');

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
        Schema::table('build_progress', function (Blueprint $table) {
            //
        });
    }
}
