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
        Schema::create('master_gaji', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->float("gaji_pokok")->default(0);
            $table->float("lembur_perjam")->default(0);
            $table->float("tunjangan_jabatan")->default(0);
            $table->float("bonus")->default(0);
            $table->float("bonus_plus")->default(0);
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
        Schema::dropIfExists('master_gaji');
    }
};
