<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan password aman
            'role' => 'admin',
            'unit' => 'sekretariat',
            'nip' => '123456'

        ]);

        User::create([
            'name' => 'GS',
            'email' => 'general@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan password aman
            'role' => 'gs',
            'unit' => 'sekretariat',
            'nip' => '1234567'
        ]);
    }
}
