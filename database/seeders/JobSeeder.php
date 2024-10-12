<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    public function run()
    {
        // Generate 50 job records using the factory
        Job::factory()->count(5)->create();
    }
}
