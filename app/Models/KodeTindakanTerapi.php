<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    use HasFactory;

    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;
    protected $fillable = [
        'kode', 
        'deskripsi_tindakan_terapi',
        'idkategori',
        'idkategori_klinis',
        ];


    // Relasi ke Kategori dan Kategori Klinis 
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    // Relasi ke kategori klinis
    public function kategoriKlinis()
    {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis');
    }
}