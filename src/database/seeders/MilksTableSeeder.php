<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Milk;

class MilksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Milk::create([
            'id' => 1,
            'day_id' => '1',
            'time' => '09:30:00',
            'amount' => '120',
            'memo' => '',
        ]);
        Milk::create([
            'id' => 2,
            'day_id' => '1',
            'time' => '12:00:00',
            'amount' => '100',
            'memo' => 'あまり飲まなかった',
        ]);
        Milk::create([
            'id' => 3,
            'day_id' => '1',
            'time' => '15:30:00',
            'amount' => '100',
            'memo' => '',
        ]);
    }
}
