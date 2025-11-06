<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        return [
            'quantity' => $faker->numberBetween(1, 4),
            'total_price' => fn($attributes) => $attributes['quantity'] * $faker->numberBetween(150000, 500000),
            'booking_code' => 'ID-' . $faker->bothify('??##??##'),
            'status' => 'confirmed'
        ];
    }
}