<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('businesses')) {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('business_image')->nullable();
            $table->string('menu_image')->nullable();
            $table->string('interior_image')->nullable();
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade'); // Reference the correct table
            $table->time('start_time');
            $table->time('end_time');
            $table->string('address');
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }
    }

    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
