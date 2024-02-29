<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(LaratrustSeeder::class);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'no_hp' => '088297976356',
        ])->addRole('admin');

        \App\Models\User::create([
            'name' => 'Receptionist',
            'email' => 'receptionist@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'no_hp' => '088297976356',
        ])->addRole('receptionist');

        \App\Models\User::create([
            'name' => 'Cleaner',
            'email' => 'cleaner@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'no_hp' => '088297976356',
        ])->addRole('cleaner');

        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),
            'no_hp' => '088297976356',
        ])->addRole('user');

        $this->call([
            PromotionSeeder::class,
            AddOnSeeder::class,
            FacilitySeeder::class,
            TypeSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
