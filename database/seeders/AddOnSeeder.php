<?php

namespace Database\Seeders;

use App\Models\RoomAddOn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomAddOn::create([
            'name' => 'Kas',
            'price' => 100000,
        ]);
    }
}
