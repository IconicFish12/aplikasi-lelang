<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "tb_barang";
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lelang()
    {
        return $this->hasMany(Lelang::class, 'barang_id');
    }

    public function penawaran()
    {
        return $this->belongsTo(Penawaran::class, 'barang_id');
    }

    public function searsh(string $search)
    {
        # code...
    }
}
