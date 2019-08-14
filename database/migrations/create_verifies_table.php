<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('secret', 36)->unique();
            $table->string('code', 20);
            $table->enum('via', ['sms']);
            $table->string('receiver', 100);
            $table->string('for', 20);
            $table->json('data');
            $table->boolean('verified')->default(false);
            $table->tinyInteger('tries')->default(0);
            $table->tinyInteger('max_tries')->default(3);
            $table->unsignedInteger('expires_in')->default(120);     // expiration in seconds
            $table->integer('exception_code')->nullable();
            $table->text('exception')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifies');
    }
}
