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
        Schema::create('jam_kerja_karyawan', function (Blueprint $table) {
            $table->id();
            $table->integer("karyawan_id")->default(0);
            $table->integer("divisi_id")->default(0);
            $table->integer("jam_kerja_id");
            $table->date("tanggal_berlaku");
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
        Schema::dropIfExists('jam_kerja_karyawan');
    }
};
