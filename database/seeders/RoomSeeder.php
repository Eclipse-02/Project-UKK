<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Basic Rooms
        Room::create([
            'type_id' => 1,
            'room_number' => 101,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 1,
            'room_number' => 102,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 1,
            'room_number' => 103,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 1,
            'room_number' => 104,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 1,
            'room_number' => 105,
            'facility' => null,
            'status' => 'AV',
        ]);

        // Luxury Rooms
        Room::create([
            'type_id' => 2,
            'room_number' => 201,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 2,
            'room_number' => 202,
            'facility' => null,
            'status' => 'AV',
        ]);

        Room::create([
            'type_id' => 2,
            'room_number' => 203,
            'facility' => null,
            'status' => 'AV',
        ]);
    }
}
