<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('common');
            $table->string('official');
            $table->string('region');
            $table->string('subregion');
            $table->string('lat');
            $table->string('lang');
            $table->float('area', 10, 2);
            $table->string('googleMaps');
            $table->string('openStreetMaps');
            $table->integer('population');
            $table->string('flag_png');
            $table->string('flag_svg');
            $table->string('coat_of_arm_png');
            $table->string('coat_of_arm_svg');
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
        Schema::dropIfExists('countries');
    }
}
