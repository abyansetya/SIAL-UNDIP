<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['nama']; // Menentukan kolom yang dapat diisi massal

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles'); // Relasi many-to-many dengan User
    }
}
