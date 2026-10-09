<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Day;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create([
            'baby_id' => 1,
            'day' => '2026-10-09',
            'memo' => '',
        ]);
    }
}
