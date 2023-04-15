<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Trần Gia Huy',
            'email' => 'giahuytran14301@gmail.com',
            'image' => '6431350e8e8d0.jpg',
            'address' => 'Tiền Giang',
            'phone_number' => '12345678',
            'email_verified_at' => null,
            'password' => 'kojunua11',
            'remember_token' => null
        ]);
        User::factory()->count(10)->create();
    }
}
