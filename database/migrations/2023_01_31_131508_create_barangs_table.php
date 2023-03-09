<?php

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('tb_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->string('nama_barang');
            $table->string('harga_barang');
            $table->longText('deskripsi_barang');
            $table->string('foto')->nullable();
            $table->enum('status_lelang', ["ditutup", "dibuka"])->default('ditutup');
            $table->enum('proses', ["belum", "sedang", "sudah"])->default('belum');
            $table->timestamps();
        });

        // $status = DB::select("SELECT 1 FROM pg_type WHERE typname = 'status_barang'");
        // $proses = DB::select("SELECT 1 FROM pg_type WHERE typname = 'proses_barang'");

        // if (!$status && !$proses) {
        //     DB::statement("CREATE TYPE status_barang AS ENUM ('ditutup', 'dibuka')");
        //     DB::statement("CREATE TYPE proses_barang AS ENUM ('belum', 'sedang', 'sudah')");
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("DROP TYPE IF EXISTS status_barang CASCADE");
        // DB::statement("DROP TYPE IF EXISTS proses_barang CASCADE");

        Schema::dropIfExists('tb_barang');
    }
};
