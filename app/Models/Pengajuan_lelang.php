<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_lelang extends Model
{
    use HasFactory;

    protected $table = "tb_pengajuan_lelang";
    protected $guarded = [];

    public function searsh(string $search)
    {
        # code...
    }
}
