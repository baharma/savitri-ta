<?php

namespace Database\Seeders;

use App\Models\Penjualan as ModelsPenjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class penjualan extends Seeder
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
                'user_id'=>1,
                'nama_barang'=>'asu'
            ]
            ];
        foreach ($users as $user) {
            ModelsPenjualan::create($user);
        }
    }
}
