<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
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
        Schema::create('tb_backup_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->string('nama_barang');
            $table->string('harga_barang');
            $table->longText('deskripsi_barang');
            $table->enum('status_lelang', ["ditutup", "dibuka"])->default('ditutup');
            $table->enum('proses', ["belum", "sedang", "sudah"])->default('belum');
            $table->timestamps();
        });

        // $status = DB::select("SELECT 1 FROM pg_type WHERE typname = 'status_backup'");
        // $proses = DB::select("SELECT 1 FROM pg_type WHERE typname = 'proses_backup'");

        // if (!$status && !$proses) {
        //     DB::statement("CREATE TYPE status_backup AS ENUM ('ditutup', 'dibuka')");
        //     DB::statement("CREATE TYPE proses_backup AS ENUM ('belum', 'sedang', 'sudah')");
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("DROP TYPE IF EXISTS status_backup CASCADE");
        // DB::statement("DROP TYPE IF EXISTS proses_backup CASCADE");

        Schema::dropIfExists('tb_backup_barang');
    }
};
