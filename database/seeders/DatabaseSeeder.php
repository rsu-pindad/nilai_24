<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::create([
            'npp' => '12337',
            'nama' => 'Iqbal Septyan',
            'penempatan' => 'PMU',
            'jabatan' => 'Pelaksana',
            'level' => '5',
            'no_hp' => '081381039900',
            'foto' => 'default.png',
            'email' => 'iqbalseptyan@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
