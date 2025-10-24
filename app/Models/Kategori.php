<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'Kategori';
    protected $primaryKey = 'idkategori';
    protected $fillable = ['nama_kategori'];
    public $timestamps = false;
}