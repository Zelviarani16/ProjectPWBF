<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;
    
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    
    public $timestamps = true;
    // Karena sdh di set $timsetamps trus, maka laravel akan mengecek updated at juga
    // Maka hrs di set null krn kita tidak punya updated at
    const UPDATED_AT = null;

    protected $fillable = [
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
        'dokter_pemeriksa',
        'idreservasi_dokter',
        'idkode_tindakan_terapi'
    ];


    public function detail()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis');
    }

    public function reservasi()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }

    public function roleUserDokter()
    {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa', 'idrole_user');
    }

    // Accessor untuk nama dokter
    public function getNamaDokterAttribute()
    {
        return $this->roleUserDokter?->user?->nama ?? '-';
    }
}