<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->char('hash', 255);
            $table->string('username');
            $table->string('email')->unique()->nullable()->default(null);
            $table->string('password')->nullable()->default(null);
            $table->string('old_password')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->string('surname')->nullable()->default(null);
            $table->char('facebook', 255)->nullable()->default(null);
            $table->char('google_plus', 255)->nullable()->default(null);
            $table->char('vkontakte', 255)->nullable()->default(null);
            $table->dateTime('last_login_date')->nullable()->default(null);
            $table->boolean('active')->default(0)->comment('Active e-mail');
            $table->boolean('newsletter')->default(0);
            $table->date('birth_date')->nullable()->default(null);

            $table->rememberToken();
            $table->boolean('admin')->default(0);
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
        Schema::dropIfExists('users');
    }
}
