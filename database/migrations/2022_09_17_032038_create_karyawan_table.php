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
            $table->string("nama_panggilan");
            $table->string('jenis_kelamin',20);
            $table->string('alamat');
            $table->string('nomor_telp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->date('tanggal_masuk');
            $table->string('referensi');
            $table->integer('status')->default(1);
            $table->string("no_ktp");
            $table->string("no_kk");
            $table->string("file_ktp")->nullable();
            $table->string("file_kk")->nullable();
            $table->string("photo")->nullable();
            $table->string("video")->nullable();
            $table->string("nama_ayah");
            $table->string("nama_ibu");
            $table->string("pekerjaan_ayah");
            $table->string("pekerjaan_ibu");
            $table->string("nama_kontak1");
            $table->string("nama_kontak2");
            $table->string("nomor_telp1");
            $table->string("nomor_telp2");
            $table->integer('jabatan_id')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('lokasi_id')->default(0);
            $table->integer('divisi_id')->default(0);
            
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
