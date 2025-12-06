<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'bidang_dokter',
        'iduser',
    ];

    // Relasi ke tabel user
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function pasien()
    {
        return $this->hasOneThrough(
            User::class,
            TemuDokter::class,
            'idreservasi_dokter', // FK TemuDokter di RekamMedis
            'iduser',             // FK User di Pemilik
            'idreservasi_dokter', // Local key di RekamMedis
            'iduser'              // Local key di TemuDokter
        );
    }

    public function getTanggalAttribute()
    {
        return $this->created_at?->format('d-m-Y') ?? '-';
    }



}