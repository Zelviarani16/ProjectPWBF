<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    public $timestamps = false;

    protected $fillable = [
        'idpet',
        'idrole_user',
        'no_urut',
        'status'
    ];

    // Relasi ke Pet
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    // Relasi ke Pemilik lewat Pet
    public function pemilik()
    {
        return $this->pet->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    // Relasi ke Dokter (User) lewat role_user
    public function dokter()
    {
        return $this->belongsTo(User::class, 'idrole_user', 'iduser'); // asumsi idrole_user sudah sesuai
    }
}
