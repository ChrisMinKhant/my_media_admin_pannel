<?php

namespace Database\Seeders;

use App\Models\ActionLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ActionLog::factory(20)->create();
    }
}
