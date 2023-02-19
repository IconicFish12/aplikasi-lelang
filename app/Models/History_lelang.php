<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_lelang extends Model
{
    use HasFactory;

    protected $table = "tb_history_lelang";
    protected $guarded = [];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class);
    }

    public function backup()
    {
        return $this->belongsTo(Backup_barang::class);
    }
}
