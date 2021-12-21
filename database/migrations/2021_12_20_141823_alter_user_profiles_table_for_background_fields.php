<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserProfilesTableForBackgroundFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('background')->default('flat')->nullable()->after('theme');
            $table->string('background_color_one')->default('#000000')->nullable()->after('background');
            $table->string('background_color_two')->default('#333333')->nullable()->after('background_color_one');
            $table->string('direction')->default('0')->nullable()->after('background_color_two');
            $table->string('background_image')->default('assets/appearances/background-white.jpg')->nullable()->after('direction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            //
        });
    }
}
