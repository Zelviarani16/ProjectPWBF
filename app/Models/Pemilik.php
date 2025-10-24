<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    protected $fillable = ['no_wa', 'alamat', 'iduser'];

    // Relasi ke tabel user (kolomnya iduser, bukan id)
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke pet
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik');
    }
}
