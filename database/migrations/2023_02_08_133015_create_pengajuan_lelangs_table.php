<?php

use App\Models\User;
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
        Schema::create('tb_pengajuan_lelangs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'user_id');
            $table->foreignIdFor(Kategori::class, 'kategori_id');
            $table->string("nama_barang");
            $table->integer("harga_barang");
            $table->integer("harga_lelang");
            $table->date('lelang_dimulai');
            $table->date('lelang_diakhiri');
            $table->enum("status_pengajuan", ["disetujui", "tidak_setujui"])->default('tidak_setujui');
            $table->timestamps();
        });

        // if (!DB::select("SELECT 1 FROM pg_type WHERE typname = 'status_pengajuan'")) {
        //     DB::statement("CREATE TYPE status_pengajuan AS ENUM ('disetujui', 'tidak_setujui')");
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::statement("DROP TYPE IF EXISTS status_pengajuan");

        Schema::dropIfExists('tb_pengajuan_lelangs');
    }
};
