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
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->string("nik");
            $table->date("tanggal");
            $table->integer('jam_kerja_id')->default(0);
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->time('lembur')->nullable();
            $table->time('telat')->nullable();
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
        Schema::dropIfExists('absen');
    }
};
