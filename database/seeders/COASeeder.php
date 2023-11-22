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
                "id_user" => 1,
                "kode_buku" => "1-1100",
                "name_akun" => "Kas",
                "klasifikasi_akun" => "Aktiva",
            ],
            [
                "id_user" => 1,
                "kode_buku" => "1-1200",
                "name_akun" => "Piutang Usaha",
                "klasifikasi_akun" => "Aktiva",
            ],
            [
                "id_user" => 1,
                "kode_buku" => "2-1100",
                "name_akun" => "Utang Usaha",
                "klasifikasi_akun" => "Liabilitas",
            ],
            [
                "id_user" => 1,
                "kode_buku" => "3-1100",
                "name_akun" => "Modal Usaha",
                "klasifikasi_akun" => "Ekuitas",
            ],
            [
                "id_user" => 1,
                "kode_buku" => "4-1100",
                "name_akun" => "Penjualan",
                "klasifikasi_akun" => "Pendapatan",
            ],
            [
                "id_user" => 1,
                "kode_buku" => "5-1100",
                "name_akun" => "Beban Sewa",
                "klasifikasi_akun" => "Beban",
            ],
            [
                "id_user" => 2,
                "kode_buku" => "5-1200",
                "name_akun" => "Beban Listrik",
                "klasifikasi_akun" => "Beban",
            ],
            [
                "id_user" => 2,
                "kode_buku" => "5-1300",
                "name_akun" => "Beban Air",
                "klasifikasi_akun" => "Beban",
            ],
            [
                "id_user" => 2,
                "kode_buku" => "5-1300",
                "name_akun" => "Beban Gaji",
                "klasifikasi_akun" => "Beban",
            ],
        ]);
    }
}
