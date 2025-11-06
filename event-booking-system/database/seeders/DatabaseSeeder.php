<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        $events = Event::factory(30)->create();

        // For each event, create 3 tickets
        $events->each(function ($event) {
            Ticket::factory(3)->create([
                'event_id' => $event->id
            ]);
        });

        $users = User::factory(10)->create();

        $users->each(function ($user) {
            $tickets = Ticket::inRandomOrder()->limit(2)->get();
            
            $tickets->each(function ($ticket) use ($user) {
                Booking::factory()->create([
                    'user_id' => $user->id,
                    'ticket_id' => $ticket->id,
                    'total_price' => fn($attributes) => $attributes['quantity'] * $ticket->price
                ]);
            });
        });
    }
}