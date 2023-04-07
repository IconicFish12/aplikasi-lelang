<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = "tb_petugas";
    protected $guarded = [];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'petugas_id');
    }

    public function history_lelang()
    {
        return $this->hasMany(History_lelang::class, 'petugas_id');
    }

    public function search(string $search)
    {
        # code...
    }
}
