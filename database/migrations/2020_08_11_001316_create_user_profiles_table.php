<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilestable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('homepage')->nullable();
            $table->string('facebook')->nullable();
            $table->string('github')->nullable();
            $table->string('instagram')->nullable();
            $table->string('avatar')->default('no-avatar.jpg');
            $table->timestamps();
        });

        $users = \App\User::all();
        foreach ($users as $user)
        {
            $profile = new \App\UserProfile();
            $profile->user_id = $user->id;
            $profile->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
