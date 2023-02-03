<?php

use App\Models\Barang;
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
        Schema::create('tb_lelang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Barang::class, 'barang_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Petugas::class, 'petugas_id');
            $table->date('tgl_lelang');
            $table->string('harga_lelang');
            $table->enum('status_lelang', ['dibuka', 'ditutup']);
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
        Schema::dropIfExists('tb_lelang');
    }
};
