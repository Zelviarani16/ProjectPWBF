<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false;

    protected $fillable = ['nama_role'];

    // Relasi Many-to-Many ke User
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser');
    }
}
