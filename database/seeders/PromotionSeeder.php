<?php

namespace Database\Seeders;

use App\Models\PromotionCode;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PromotionCode::create([
            'code_name' => 'BERKAHMELIMPAH',
            'discount' => 10,
            'begin_at' => Carbon::now(),
            'end_at' => Carbon::now(),
        ]);
    }
}
