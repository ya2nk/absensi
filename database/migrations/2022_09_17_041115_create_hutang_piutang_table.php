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
        Schema::create('hutang_piutang', function (Blueprint $table) {
            $table->id();
            $table->integer('karyawan_id');
            $table->date('tanggal');
            $table->string('type');
            $table->string("keterangan");
            $table->float("nominal");
            $table->integer("status");
            $table->integer("bulan_gaji");
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
        Schema::dropIfExists('hutang_piutang');
    }
};
