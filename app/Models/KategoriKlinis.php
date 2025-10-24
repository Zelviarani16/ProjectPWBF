<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKlinis extends Model
{
    use HasFactory;

    // nama tabel
    protected $table = 'kategori_klinis';

    // primary key
    protected $primaryKey = 'idkategori_klinis';

    // field yang boleh diisi mass assignment
    protected $fillable = [
        'nama_kategori_klinis'
    ];
}