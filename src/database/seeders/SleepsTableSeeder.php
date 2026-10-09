<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sleep;

class SleepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sleep::create([
            'id' => 1,
            'day_id' => '1',
            'start_time' => '09:30:00',
            'end_time' => '10:30:00',
            'memo' => 'よく寝た',
        ]);
        Sleep::create([
            'id' => 2,
            'day_id' => '1',
            'start_time' => '13:00:00',
            'end_time' => '13:30:00',
            'memo' => '',
        ]);
    }
}
