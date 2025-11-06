<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        $types = ['VIP', 'Regular', 'Economy'];
        $prices = [
            'VIP' => $faker->numberBetween(500000, 1500000),
            'Regular' => $faker->numberBetween(200000, 450000),
            'Economy' => $faker->numberBetween(75000, 180000)
        ];
        $type = $faker->randomElement($types);

        return [
            'type' => $type,
            'price' => $prices[$type],
            'quantity_available' => $faker->numberBetween(30, 150)
        ];
    }
}