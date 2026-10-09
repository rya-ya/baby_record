<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Baby;

class BabiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Baby::create([
            'name'=>'ベビー',
            'gender'=>'1',
            'birthday'=>'2026-09-01',
            'memo' => 'テスト用',
            'home_id' => 1,
        ]);

    }
}
