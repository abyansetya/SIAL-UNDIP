<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'nama',
        'email',
        'password',
        'NIM_NIP',
        'alamat',
        'telepon',
        'status',
        'wali_id', // Menyimpan ID wali jika ada
    ];

    // Kolom yang harus disembunyikan untuk array
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi dengan model User untuk wali
    public function wali()
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    // Relasi jika pengguna adalah wali dari banyak mahasiswa
    public function mahasiswa()
    {
        return $this->hasMany(User::class, 'wali_id');
    }

    // Jika menggunakan mutator untuk hashing password
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
    return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }

}
