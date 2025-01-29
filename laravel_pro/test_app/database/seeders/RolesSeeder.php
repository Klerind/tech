<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Roles::factory()
                ->count(3)
                ->sequence(
                    ['role' => 'pro seller'],
                    ['role' => 'seller'],
                    ['role' => 'programmer']
                )
                ->create();
    }
}
