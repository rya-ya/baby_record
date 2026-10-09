<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\HomesTableSeeder;
use Database\Seeders\BabiesTableSeeder;
use Database\Seeders\DaysTableSeeder;
use Database\Seeders\MilksTableSeeder;
use Database\Seeders\DiapersTableSeeder;
use Database\Seeders\SleepsTableSeeder;

use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        User::factory()->create([
            'name' => '笠野',
            'email' => 'test1@yahoo.co.jp',
            'password' => Hash::make('12345678'),
        ]);

        User::factory()->create([
            'name' => '山田',
            'email' => 'test2@yahoo.co.jp',
            'password' => Hash::make('98765432'),
        ]);


        $this->call([
            HomesTableSeeder::class,
            BabiesTableSeeder::class,
            DaysTableSeeder::class,
            MilksTableSeeder::class,
            DiapersTableSeeder::class,
            SleepsTableSeeder::class,
        ]);
    }
}
