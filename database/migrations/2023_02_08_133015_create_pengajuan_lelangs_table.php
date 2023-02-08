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
        Schema::create('tb_pengajuan_lelangs', function (Blueprint $table) {
            $table->id();
            $table->string("nama_pengguna");
            $table->string("nama_barang");
            $table->enum("status_pengajuan", ["disetujui", "tidak_setujui"]);
            $table->enum("jenis_transaksi", ["jual", "sewa"]);
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
        Schema::dropIfExists('pengajuan_lelangs');
    }
};
