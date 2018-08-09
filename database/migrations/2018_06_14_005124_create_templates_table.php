<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
//            $table->increments('id');
            $table->increments('templateId');
            $table->integer('templateGroupId')->references('templateGroupId')->on('template_groups');
            $table->integer('templateImageId')->references('templateImageId')->on('template_images');
            $table->string('imageUrl');
            $table->string('name');
            $table->boolean('isActive');
            $table->boolean('isPublic');
            $table->rememberToken();
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
        Schema::dropIfExists('templates');
    }
}
