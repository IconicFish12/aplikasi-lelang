<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;

    protected $table = "tb_lelang";
    protected $guarded = [];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, "barang_id");
    }

    public function searsh(string $search)
    {
        # code...
    }
}
