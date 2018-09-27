<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('ustream_id')->nullable()->default(null);
            $table->integer('upload_video_id')->nullable()->default(null);
            $table->char('title', 255);
            $table->text('description')->nullable()->default(null);
            $table->text('resolutions')->nullable()->default(null);
            $table->tinyInteger('resolution_status')->default(0)->comment('0 - nothing, 1 - all resolutions, 2 - in progress');
            $table->text('iframe_code')->nullable()->default(null);
            $table->char('image', 255)->nullable()->default(null);
            $table->char('open_graph_image', 255)->nullable()->default(null);
            $table->dateTime('public_date')->nullable()->default(null);
            $table->double('price', 8, 2)->nullable()->default(null);
            $table->integer('buy')->default(0);
            $table->unsignedInteger('views')->default(0);

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
        Schema::dropIfExists('videos');
    }
}
