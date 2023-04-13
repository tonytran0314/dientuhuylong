<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('page_infos')->insert([
            'full_address' => 'Số 218, đường Quốc Lộ 50, ấp Bình Long, xã Song Bình, huyện Chợ Gạo, tỉnh Tiền Giang',
            'tinh_address' => 'Tiền Giang',
            'huyentinh_address' => 'huyện Chợ Gạo, tỉnh Tiền Giang',
            'phone_number' => '0918689080',
            'email_address' => 'dientu.huylong@gmail.com',
            'description' => 'Mô tả về điện tử Huy Long'
        ]);
    }
}
