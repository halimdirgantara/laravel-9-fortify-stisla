<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Muhammad Halim Dirgantara',
            'email' => 'halimdirgantara@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::factory()->count(9)->create();
    }
}
