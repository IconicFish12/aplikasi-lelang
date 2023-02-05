<?php

use App\Models\Barang;
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
        Schema::create('tb_penawaran', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Barang::class, 'barang_id');
            $table->foreignIdFor(User::class, 'user_id');
            $table->string('harga_penawaran');
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
        Schema::dropIfExists('tb_penawaran');
    }
};
