<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    public $incrementing = false; // karena id tidak auto-increment
    public $timestamps = false;   
    protected $fillable = ['idkategori', 'nama_kategori'];
}
