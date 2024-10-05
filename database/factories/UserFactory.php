<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Password default
            'NIM_NIP' => $this->faker->unique()->numerify('##############'), // Format NIM/NIP
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'status' => 'aktif',
            'wali_id' => null, // Atur sesuai kebutuhan
        ];
    }

    public function mahasiswa()
    {
        return $this->state(function (array $attributes) {
            return [
                'NIM_NIP' => $this->faker->unique()->numerify('240###########'), // Format NIM
                'email' => $this->faker->unique()->userName . '@student.com', // Email dengan domain @student.com
            ];
        });
    }

    public function dekan()
    {
        return $this->state(function (array $attributes) {
            return [
                'NIM_NIP' => $this->faker->unique()->numerify('197###########'), // Format NIP
                'email' => $this->faker->unique()->userName . '@lecturer.com',
            ];
        });
    }

    public function pembimbingAkademik()
    {
        return $this->state(function (array $attributes) {
            return [
                'NIM_NIP' => $this->faker->unique()->numerify('NIP########'), // Format NIP
            ];
        });
    }

    public function bagianAkademik()
    {
        return $this->state(function (array $attributes) {
            return [
                'NIM_NIP' => $this->faker->unique()->numerify('NIP########'), // Format NIP
            ];
        });
    }

    public function ketuaProdi()
    {
        return $this->state(function (array $attributes) {
            return [
                'NIM_NIP' => $this->faker->unique()->numerify('NIP########'), // Format NIP
            ];
        });
    }
}
