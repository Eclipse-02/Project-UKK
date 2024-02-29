<?php

namespace Database\Seeders;

use App\Models\RoomFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomFacility::create([
            'name' => 'TV',
            'desc' => '14 inch',
        ]);
    }
}
