<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@emading.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Guru Test',
            'email' => 'guru@emading.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@emading.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
    }
}