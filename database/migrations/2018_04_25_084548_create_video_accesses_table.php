<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('video_id');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('access_type')->comment('1 - PayPayl, 2 - Yandex, 3 - ArmCoins');
            $table->unsignedInteger('shopping_id')->nullable()->default(null);


            $table->timestamps();

            //relations:
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shopping_id')->references('id')->on('shopping')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_accesses');
    }
}
