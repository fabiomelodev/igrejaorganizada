<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birthdate' => $this->faker->date('Y-m-d', '2005-01-01'),
            'address' => $this->faker->address(),
            'gender' => $this->faker->randomElement(['masculine', 'feminine']),
            'is_active' => 1,
            'team_id' => 2,
            'position_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
