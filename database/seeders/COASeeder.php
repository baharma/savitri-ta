<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class COASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('akuns')->insert([
            [
                "id" => "9aa21c72-4711-43f9-87f6-a5969ee55747",
                "id_user" => 1,
                "kode_buku" => "1-1100",
                "name_akun" => "Kas",
                "klasifikasi_akun" => "Aktiva",
            ],
            [
                "id" => "9aa21de7-2d6d-4bf8-a27d-ea8d03af5b16",
                "id_user" => 1,
                "kode_buku" => "1-1200",
                "name_akun" => "Piutang Usaha",
                "klasifikasi_akun" => "Aktiva",
            ],
            [
                "id" => "9aa21e2f-53e6-4a68-857f-9bf0450aab7b",
                "id_user" => 1,
                "kode_buku" => "2-1100",
                "name_akun" => "Utang Usaha",
                "klasifikasi_akun" => "Liabilitas",
            ],
            [
                "id" => "9aa21e73-f74d-47a7-a5d1-44a551b2aae1",
                "id_user" => 1,
                "kode_buku" => "3-1100",
                "name_akun" => "Modal Usaha",
                "klasifikasi_akun" => "Ekuitas",
            ],
            [
                "id" => "9aa21ebe-679a-4989-b28d-4270c1641f54",
                "id_user" => 1,
                "kode_buku" => "4-1100",
                "name_akun" => "Penjualan",
                "klasifikasi_akun" => "Pendapatan",
            ],
            [
                "id" => "9aa21f02-f6ef-437f-b09f-a593b8e9bee7",
                "id_user" => 1,
                "kode_buku" => "5-1100",
                "name_akun" => "Beban Sewa",
                "klasifikasi_akun" => "Beban",
            ],
            [
                "id" => "9aa597ac-ba66-44fd-9192-eeed454a61b7",
                "id_user" => 2,
                "kode_buku" => "5-1200",
                "name_akun" => "Beban Listrik",
                "klasifikasi_akun" => "Beban",
            ],
            [
                "id" => "9aa597dd-a1b4-4d7e-91a4-1abf6fd3ec62",
                "id_user" => 2,
                "kode_buku" => "5-1300",
                "name_akun" => "Beban Air",
                "klasifikasi_akun" => "Beban", 
            ],
            [
                "id" => "9aa59801-2712-49dd-a22f-d37e7f669da1",
                "id_user" => 2,
                "kode_buku" => "5-1300",
                "name_akun" => "Beban Gaji",
                "klasifikasi_akun" => "Beban",
            ],
        ]);
    }
}
