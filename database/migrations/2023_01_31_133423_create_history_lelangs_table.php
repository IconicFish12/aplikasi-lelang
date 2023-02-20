<?php

use App\Models\Kategori;
use App\Models\Petugas;
use App\Models\User;
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
        Schema::create('tb_history_lelang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->foreignIdFor(Petugas::class, 'petugas_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('nama_barang');
            $table->string('harga_barang');
            $table->string('harga_lelang');
            $table->date('tgl_lelang');
            $table->enum('jenis_transaksi', ['jual', 'sewa']);
            $table->enum('proses', ["belum", "sedang", "sudah"])->default('belum');
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
        Schema::dropIfExists('history_lelang');
    }
};
