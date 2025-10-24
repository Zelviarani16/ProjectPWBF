<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'warna_tanda',
        'jenis_kelamin',
        'idpemilik',
        'idras_hewan'
    ];

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik');
    }

    // Relasi ke Ras Hewan
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan');
    }
}
