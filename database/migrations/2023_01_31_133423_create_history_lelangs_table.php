<?php

use App\Models\Backup_barang;
use App\Models\User;
// use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Penawaran;
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
            $table->foreignIdFor(Lelang::class, 'lelang_id');
            $table->foreignIdFor(Penawaran::class, 'penawaran_id');
            $table->foreignIdFor(Backup_barang::class, 'backup_id');
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
