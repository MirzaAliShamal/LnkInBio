<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserProfilesTableForButtonsFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('custom_button')->default('fill-rectangle')->nullable()->after('background_image');
            $table->string('button_background_color')->default('#ffffff')->nullable()->after('custom_button');
            $table->string('button_font_color')->default('#ffffff')->nullable()->after('button_background_color');
            $table->string('button_shadow_color')->default('#000000')->nullable()->after('button_font_color');
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
