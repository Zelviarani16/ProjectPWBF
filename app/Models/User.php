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
    protected $primaryKey = 'iduser'; // penting!
    public $timestamps = false;

    protected $fillable = [
        'nama', 
        'email', 
        'password'
    ];

    public function pemilik()
    {
        return $this->hasOne(Pemilik::class, 'iduser', 'iduser');
    }

    // Relasi Many-to-Many ke Role
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'iduser', 'idrole');
    }

    public function roleUser()
    {
        // Satu user bisa punya banyak role (tp 1 yang aktif)
        return $this->hasMany(RoleUser::class, 'iduser');
    }
}
