<?php

use App\Models\Level;
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
        Schema::create('tb_petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_petugas');
            $table->date('tgl_lahir')->nullable();
            $table->string('email');
            $table->string('password');
            $table->longText('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->string('telp', 25);
            $table->enum('role', ['admin', 'petugas'])->default('admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('tb_petugas');
    }
};
