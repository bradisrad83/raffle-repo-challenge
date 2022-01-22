<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Raffle;
use App\Models\Winner;

class RaffleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::select('id')->get();
        Raffle::all()->each(function ($raffle) use ($userIds) {
            $raffle->users()->attach($userIds->random(100));
        });
    }
}
