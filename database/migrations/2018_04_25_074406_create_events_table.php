<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->char('title', 255);
            $table->text('description_en')->nullable()->default(null);
            $table->text('description_ru')->nullable()->default(null);
            $table->text('iframe_code')->nullable()->default(null);
            $table->text('maps_code')->nullable()->default(null);
            $table->char('place', 255)->nullable()->default(null);
            $table->char('image', 255)->nullable()->default(null);
            $table->char('open_graph_image', 255)->nullable()->default(null);

            $table->dateTime('date_start');
            $table->dateTime('date_stop');
            $table->double('price_us', 8, 2)->nullable()->default(0);
            $table->unsignedInteger('price_ru')->nullable()->default(0);
            $table->unsignedInteger('price_arc')->nullable()->default(0);

            $table->char('paypal_btn', 255)->nullable()->default(null);
            $table->char('paypal_item_id', 255)->nullable()->default(null);
            $table->char('yandex_btn', 255)->nullable()->default(null);

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
        Schema::dropIfExists('events');
    }
}
