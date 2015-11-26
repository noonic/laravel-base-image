<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NoonicImageImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 250)->nullable();
            $table->text('description')->nullable();
            $table->string('path');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('images');
    }
}