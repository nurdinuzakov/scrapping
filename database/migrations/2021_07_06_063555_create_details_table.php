<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('watch_id');
            $table->foreign('watch_id')->references('id')->on('watches');
            $table->integer('reference_number')->nullable();
            $table->integer('also_known')->nullable();
            $table->string('band_type')->nullable();
            $table->string('bezel')->nullable();
            $table->string('caliber')->nullable();
            $table->string('case_back')->nullable();
            $table->string('case_material')->nullable();
            $table->string('case_size')->nullable();
            $table->string('clasp_type')->nullable();
            $table->string('condition')->nullable();
            $table->string('crown')->nullable();
            $table->string('dial_color')->nullable();
            $table->string('watch_functions')->nullable();
            $table->string('gender')->nullable();
            $table->string('included')->nullable();
            $table->string('lug_material')->nullable();
            $table->string('movement')->nullable();
            $table->string('power_reserve')->nullable();
            $table->string('power_reserve_unit')->nullable();
            $table->string('signatures')->nullable();
            $table->string('strap_color')->nullable();
            $table->string('discontinued')->nullable();
            $table->string('limited_edition')->nullable();
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
        Schema::dropIfExists('details');
    }
}
