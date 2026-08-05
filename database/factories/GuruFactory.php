<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GuruFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numerify('####################'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'jabatan' => 'Guru Kelas',
            'status' => 'Aktif',
        ];
    }
}