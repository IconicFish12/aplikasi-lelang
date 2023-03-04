<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup_barang extends Model
{
    use HasFactory;

    protected $table = 'tb_backup_barang';
    protected $guarded = [];

    public function lelang()
    {
        return $this->hasMany(Backup_barang::class, "backup_id");
    }

    public function searsh(string $search)
    {
        # code...
    }
}
