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
            $table->integer('jam_kerja_id_1')->default(0);
            $table->integer('jam_kerja_id_2')->default(0);
            $table->time('jam_masuk_1');
            $table->time('jam_pulang_1');
            $table->time('jam_masuk_2');
            $table->time('jam_pulang_2');
            $table->time('lembur');
            $table->time('telat');
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
