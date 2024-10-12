<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition()
    {
        return [
            'job_title' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'location' => $this->faker->city,
            'description' => $this->faker->paragraph, // You can adjust this to any length
        ];
    }
}
