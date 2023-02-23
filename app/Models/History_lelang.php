<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_lelang extends Model
{
    use HasFactory;

    protected $table = "tb_history_lelang";
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
