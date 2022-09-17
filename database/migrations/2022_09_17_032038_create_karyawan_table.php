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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string("nama");
            $table->string('email',100);
            $table->string('jenis_kelamin',20);
            $table->string('alamat');
            $table->string('nomor_telp');
            $table->date('tanggal_lahir');
            $table->string('status_perkawinan');
            $table->integer('jabatan_id')->default(0);
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('karyawan');
    }
};
