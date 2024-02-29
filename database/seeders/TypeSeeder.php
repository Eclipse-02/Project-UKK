<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomType::create([
            'name' => 'Basic',
            'price' => 6000000,
            'bed_qty' => 1,
            'bed_type' => 'King',
        ]);

        RoomType::create([
            'name' => 'Luxury',
            'price' => 10000000,
            'bed_qty' => 2,
            'bed_type' => 'Queen',
        ]);
    }
}
