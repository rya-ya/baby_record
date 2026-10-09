<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Home;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Home::create([
            'name' => '笠野',
            'user_id' => 1,
        ]);

        Home::create([
            'name' => '山田',
            'user_id' => 2,
        ]);
    }
}
