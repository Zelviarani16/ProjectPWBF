<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Pemilik;
use App\Models\Role;
use App\Models\RoleUser;

// ????
class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'iduser'; 
    public $timestamps = false;

    protected $fillable = [
        'nama', 
        'email', 
        'password'
    ];

    protected $hidden = [
        'password',
    ];

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi Many-to-Many ke Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 
        'role_user', // tabel pivot
        'iduser', // fk di abel pivot ke tabel user
        'idrole'
    )->withPivot('idrole_user', 'status'); // fk di tabel pivot utk role
    }

    public function roleUser()
    {
        return $this->hasOne(RoleUser::class, 'iduser')->where('status', '1');
    }


    // public function roleUser()
    // {
    //     // Satu user bisa punya banyak role (tp 1 yang aktif)
    //     return $this->hasMany(RoleUser::class, 'iduser');
    // }

    public function isDokter()
    {
        return $this->roles()->where('nama_role', 'dokter')->exists();
    }

    public function perawat()
    {
        return $this->hasOne(Perawat::class,
        'iduser',
        'iduser');
    }

    // Helper method utk cek role
    public function hasRole($roleName)
    {
        return $this->roles()->where('nama_role', $roleName)->exists();
    }

    // Helper method utk cek apakah user adalah perawat
    public function isPerawat()
    {
        return $this->hasRole('perawat');
    }
}
