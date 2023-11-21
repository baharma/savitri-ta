<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = [
            [
                'name' => 'Nyoman',
                'is_allow_debt' => true
            ],
            [
                'name' => 'Putu',
                'is_allow_debt' => true

            ],
            [
                'name' => 'Ketut',
                'is_allow_debt' => true
            ]
        ];
        foreach ($customer as $user) {
            Customer::create($user);
        }
    }
}
