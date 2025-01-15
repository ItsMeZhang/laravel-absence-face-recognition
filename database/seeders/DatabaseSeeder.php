<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // data dummy for company
        \App\Models\Company::create([
            'name' => 'PT. ABC Indonesia',
            'email' => 'admin@abcindo.com',
            'address' => 'Jl. Raya Kedung Turi No. 20, Sleman, DIY',
            'latitude' => '-7.747033',
            'longitude' => '110.355398',
            'radius_km' => '0.5',
            'time_in' => '08:00',
            'time_out' => '17:00',
        ]);

        User::factory()->create([
            'name' => 'Ivan Chandra Sutanto',
            'email' => 'ivancandracong@gmail.com',
            'password' => Hash::make('12345678'),
        ]);


        $this->call([
            AttendanceSeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
