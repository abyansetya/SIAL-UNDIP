<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        // Mengambil semua user
        $users = User::all();

        foreach ($users as $user) {
            // Tentukan role berdasarkan awalan NIM/NIP
            $roles = []; // Menyimpan role yang akan dikaitkan

            // Cek awalan NIM/NIP
            if (substr($user->NIM_NIP, 0, 3) === '240') {
                // Jika NIM_NIP diawali dengan '240', set role sebagai Mahasiswa
                $roles[] = Role::where('nama', 'Mahasiswa')->first();
            } elseif (substr($user->NIM_NIP, 0, 3) === '197') {
                // Jika NIM_NIP diawali dengan '197', tambahkan beberapa role yang mungkin
                $roleBagianAkademik = Role::where('nama', 'Bagian Akademik')->first();
                $roleDekan = Role::where('nama', 'Dekan')->first();
                $roleKetuaProdi = Role::where('nama', 'Ketua Prodi')->first();
                $rolePembimbingAkademik = Role::where('nama', 'Pembimbing Akademik')->first();

                // Logika untuk mengatur role
                if ($roleBagianAkademik) {
                    $roles[] = $roleBagianAkademik;
                }

                if ($roleDekan) {
                    $roles[] = $roleDekan;
                }

                if ($roleKetuaProdi) {
                    $roles[] = $roleKetuaProdi;
                }

                if ($rolePembimbingAkademik) {
                    $roles[] = $rolePembimbingAkademik;
                }

                // Logika untuk pembatasan role
                // Jika user memiliki role Bagian Akademik (id 2) atau Pembimbing Akademik (id 4)
                $userRoles = UserRole::where('user_id', $user->id)->pluck('role_id')->toArray();

                if (in_array($roleBagianAkademik->id, $userRoles) && in_array($rolePembimbingAkademik->id, $userRoles)) {
                    // Jika user sudah memiliki kedua role ini, jangan tambahkan role lain
                    continue;
                }

                // Jika user memiliki role Dekan (id 1), tidak bisa memiliki role lain
                if (in_array($roleDekan->id, $userRoles)) {
                    continue;
                }

                // Jika user hanya memiliki role Ketua Prodi, bisa memiliki Pembimbing Akademik
                if (in_array($roleKetuaProdi->id, $userRoles) && $rolePembimbingAkademik) {
                    $roles[] = $rolePembimbingAkademik; // Bisa menambahkan Pembimbing Akademik
                }
            }

            // Hanya jika role ditemukan, tambahkan ke tabel pivot
            foreach ($roles as $role) {
                if ($role) {
                    UserRole::create(['user_id' => $user->id, 'role_id' => $role->id]);
                }
            }
        }
    }
}
