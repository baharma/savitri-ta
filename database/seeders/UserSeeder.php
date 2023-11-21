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
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir'
            ],
            [
                'name' => 'Pemilik',
                'email' => 'pemilik@gmail.com',
                'password' => Hash::make('pemilik123'),
                'role' => 'pemilik'
            ]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
