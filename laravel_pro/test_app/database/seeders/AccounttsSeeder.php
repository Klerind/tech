<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accountts;

class AccounttsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Accountts::factory()
                ->count(3)
                ->sequence(
                    ['accountt' => 'Facebook'],
                    ['accountt' => 'Twitter'],
                    ['accountt' => 'YouTube']
                )
                ->create();
    }
}
