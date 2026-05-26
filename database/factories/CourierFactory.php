<?php

namespace Database\Factories;

use App\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Courier>
 */
class CourierFactory extends Factory
{
    protected $model = Courier::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => strtoupper(fake()->unique()->bothify('CRR-####')),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'service_area' => fake()->city(),
            'level' => fake()->numberBetween(1, 5),
            'is_active' => fake()->boolean(85),
            'registered_at' => fake()->dateTimeBetween('-1 year'),
        ];
    }
}
