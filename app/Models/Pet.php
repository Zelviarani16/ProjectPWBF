<?php

namespace App\Models;

use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;

    protected $fillable = [
        'nama', 'tanggal_lahir', 'warna_tanda', 'jenis_kelamin', 'idpemilik', 'idras_hewan'
    ];

    // Relasi ke Pemilik
    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi ke Ras Hewan
    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}


