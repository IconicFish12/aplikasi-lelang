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

    public function backup_barang()
    {
        return $this->hasMany(Backup_barang::class, 'kategori_id');
    }

    public function history_lelang()
    {
        return $this->hasMany(History_lelang::class, 'kategori_id');
    }

    public function pengajuan_lelang()
    {
        return $this->hasMany(Pengajuan_lelang::class, 'kategori_id');

    }

    public function search(string $search)
    {
        # code...
    }
}
