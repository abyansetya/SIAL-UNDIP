<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRole>
 */
class UserRoleFactory extends Factory
{
    protected $model = \App\Models\UserRole::class;

    public function definition()
    {
        // Ambil user dan role yang ada
        $user = User::inRandomOrder()->first(); // Ambil user acak
        $role = Role::inRandomOrder()->first(); // Ambil role acak

        // Atur logika untuk mengaitkan user dengan role sesuai ketentuan
        if (in_array($role->nama, ['Mahasiswa', 'Bagian Akademik', 'Pembimbing Akademik'])) {
            // Hanya satu role untuk Mahasiswa, Bagian Akademik, dan Pembimbing Akademik
            return [
                'user_id' => $user->id,
                'role_id' => $role->id,
            ];
        } else {
            // Untuk Dekan, bisa menjadi Ketua Prodi
            $additionalRole = Role::where('nama', 'Ketua Prodi')->inRandomOrder()->first();

            return [
                'user_id' => $user->id,
                'role_id' => $role->id,
            ];
        }
    }
}