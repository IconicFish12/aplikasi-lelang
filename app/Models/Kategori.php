<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "tb_kategori";
    protected $guarded = [];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }

    public function history_lelang()
    {
        return $this->hasMany(History_lelang::class, 'petugas_id');
    }

    public function searsh(string $search)
    {
        # code...
    }
}
