<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History_lelang extends Model
{
    use HasFactory;

    protected $table = "histori_lelang";
    protected $primaryKey = 'id_history';
    public $timestamps = false;
    protected $guarded = [];
}
