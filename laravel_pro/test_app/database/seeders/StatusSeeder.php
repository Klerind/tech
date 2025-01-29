<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Status::factory()
                ->count(3)
                ->sequence(
                    ['status' => 'Available now'],
                    ['status' => 'offline'],
                    ['status' => 'active']
                )
                ->create();
    }
}
