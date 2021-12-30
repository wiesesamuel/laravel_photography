<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string("title")->nullable();
            $table->string("url")->default('/images/wiese.png');

            $table->string("absolute_path");
            $table->string("file_name");
            $table->string("thumbnail_path")->nullable();

            $table->text("description")->nullable();
            $table->string("orientation")->nullable();

            $table->string("Artist")->nullable();
            $table->string("DateTime")->nullable();
            $table->integer("Width")->nullable();
            $table->integer("Height")->nullable();
            $table->string("Camera")->nullable();
            $table->string("CameraLens")->nullable();
            $table->string("CCDWidth")->nullable();
            $table->string("ExposureTime")->nullable();
            $table->string("ApertureNumber")->nullable();

            $table->float("aspectRatio")->nullable();
            $table->boolean("horizontal")->nullable();

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
        Schema::dropIfExists('images');
    }
}
