<?php

use App\Models\Kategori;
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
        Schema::create('tb_pengajuan_lelangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->string("nama_barang");
            $table->date('lelang_dimulai');
            $table->date('lelang_diekhiri');
            $table->enum('jenis_transaksi', ['jual', 'sewa']);
            $table->enum("status_pengajuan", ["disetujui", "tidak_setujui"]);
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
        Schema::dropIfExists('tb_pengajuan_lelangs');
    }
};
