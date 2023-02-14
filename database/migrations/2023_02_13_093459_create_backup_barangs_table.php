<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_backup_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->string('nama_barang');
            $table->date('tgl_pelelangan');
            $table->string('harga_barang');
            $table->longText('deskripsi_barang');
            $table->string('foto');
            $table->enum('status_lelang', ["ditutup", "dibuka"])->default('ditutup');
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
        Schema::dropIfExists('tb_backup_barangs');
    }
};