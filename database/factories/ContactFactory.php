<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'contact' => $this->faker->numerify('#########'),
            'email' => $this->faker->unique()->safeEmail,
            'user_id' => User::factory()
        ];
    }
}