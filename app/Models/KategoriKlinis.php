<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    protected $table = 'kategori_klinis';
    protected $primaryKey = 'idkategori_klinis';
    public $incrementing = false; // karena id tidak auto increment
    public $timestamps = false;   // kalau tabel tidak punya created_at/updated_at

    protected $fillable = ['idkategori_klinis', 'nama_kategori_klinis'];
}
