<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Customer::create([
                'ten_khachhang' => $faker->name,
                'sodienthoai' => $faker->phoneNumber,
                'ma_khachhang' => $faker->unique()->ean8
            ]);
        }
    }
}
