<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();
        \App\Models\Raffle::factory(10)->create();
        $this->call([
            RaffleUserTableSeeder::class,
        ]);
    }
}
