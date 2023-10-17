<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'npp' => 'sdm',
            'level' => '1',
            'no_hp' => '1',
            'email' => 'sdm@pindadmedika.com',
            'password' => Hash::make('$PMU@2023'),
        ]);
    }
}
