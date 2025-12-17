<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisHewan extends Model
{
    use HasFactory;

    protected $table = 'jenis_hewan';    
    protected $primaryKey = 'idjenis_hewan';
    
    // Field yang boleh diisi mass assignment
    protected $fillable = [
        'nama_jenis_hewan'
    ];
    
    // Jika ada relasi ke tabel lain, tambahkan di sini
    // Contoh: relasi ke ras_hewan
    // public function rasHewan()
    // {
    //     return $this->hasMany(RasHewan::class, 'idjenis_hewan', 'idjenis_hewan');
    // }
}