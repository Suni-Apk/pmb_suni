<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'               => $this->faker->userName,
            'phone'              => $this->faker->unique()->phoneNumber,
            'gender'             => 'Laki-Laki',
            'active'             => 1,
            'token'              => rand(1111111, 999999),
            'role'               => 'Mahasiswa',
            'email'              => $this->faker->unique()->safeEmail(),
            'email_verified_at'  => now(),
            'remember_token'     => Str::random(10),
            'status'             => 'on',
            'password'           => bcrypt('password'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
