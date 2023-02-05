<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_lelang extends Model
{
    use HasFactory;

    protected $table = "histori_lelang";
    protected $guarded = [];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
