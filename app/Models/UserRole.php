<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles'; // Nama tabel pivot

    protected $fillable = ['user_id', 'role_id']; // Menentukan kolom yang dapat diisi massal

    // Mendefinisikan relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Mendefinisikan relasi ke Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
