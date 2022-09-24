<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkinout', function (Blueprint $table) {
            $table->id();
            $table->string("nik");
            $table->date('tanggal');
            $table->time('jam');
            $table->integer('status')->default(0);
            $table->text("photo")->nullable();
            $table->integer('status_acc')->default(0);
            $table->string('user_acc')->nullable();
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
        Schema::dropIfExists('checkinout');
    }
};
