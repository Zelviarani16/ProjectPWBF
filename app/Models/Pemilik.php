<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    public $timestamps = false;

    // Fillable utk memastikan kolom yg diisi memang diizinkan. Kalau kolom tidak ada di ffillable laravel akan emmasukkannya dan biasanya akan menolak mass assignment 
    protected $fillable = [
        'idpemilik',
        'iduser',
        'no_wa', 
        'alamat'
    ];

    // Relasi ke tabel user (kolomnya iduser, bukan id)
    public function user()
    {
        // iduser pertama merupakan kolom di tabel pemilik sedangkan
        // iduser kedua merupakan kolom di tabel user yg menjadi PK utk dicocokkan
        // maksudnya, "Pemilik ini terkait dengan User yang punya iduser sama dengan iduser di tabel pemilik."
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    // Relasi ke pet
    public function pets()
    {
        return $this->hasMany(Pet::class, 'idpemilik');
    }
}
