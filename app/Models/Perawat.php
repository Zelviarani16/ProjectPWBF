<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    use HasFactory;

    protected $table = 'perawat';            // nama tabel
    protected $primaryKey = 'id_perawat';    // primary key
    public $timestamps = false;      // kalau tabel tdk ada created/updated at         // tabel tidak punya created_at, updated_at

    protected $fillable = [
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'pendidikan',
        'iduser',
    ];

    // relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
