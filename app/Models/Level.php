<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = "tb_level";
    protected $guarded = [];

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'level_id');
    }
}
