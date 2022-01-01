<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('extension',50)->comment('拡張子');
            $table->string('category',50)->nullable()->comment('models名指定');
            $table->string('type',20)->nullable()->comment('categoryカラムが「reservation」の場合「新規」か「全員」か「新規,全員」を指定');
            $table->string('url',255)->unique()->comment('画像名.拡張子');
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
        Schema::dropIfExists('photos');
    }
}
