<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Diaper;

class DiapersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Diaper::create([
            'id' => 1,
            'day_id' => '1',
            'time' => '10:30:00',
            'type' => '1',
            'memo' => '',
        ]);
        Diaper::create([
            'id' => 2,
            'day_id' => '1',
            'time' => '14:30:00',
            'type' => '2',
            'memo' => '',
        ]);
        Diaper::create([
            'id' => 3,
            'day_id' => '1',
            'time' => '16:30:00',
            'type' => '1',
            'memo' => '',
        ]);
        Diaper::create([
            'id' => 4,
            'day_id' => '1',
            'time' => '03:00:00',
            'type' => '2',
            'memo' => 'ねむい',
        ]);
    }
}
