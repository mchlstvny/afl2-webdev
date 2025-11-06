@extends('layouts.app')

@section('content')
    <section class="py-20 min-h-screen grid-pattern">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Event Info -->
                <div data-aos="fade-right">
                    <!-- Event Header -->
                    <div class="cyber-card p-8 mb-8">
                        <h1 class="font-orbitron text-4xl md:text-5xl text-white font-bold mb-4 cyber-gradient">
                            {{ $event->name }}
                        </h1>
                        
                        <div class="flex items-center space-x-6 mb-6">
                            <div class="flex items-center text-neo-blue font-rajdhani font-semibold">
                                <span class="w-2 h-2 bg-neo-blue rounded-full mr-2 animate-pulse"></span>
                                {{ $event->location }}
                            </div>
                            <div class="flex items-center text-matrix-green font-rajdhani font-semibold">
                                <span class="w-2 h-2 bg-matrix-green rounded-full mr-2 animate-pulse"></span>
                                {{ $event->date_time->format('F d, Y - H:i') }}
                            </div>
                        </div>
                    </div>

                    <!-- Event Description -->
                    <div class="cyber-card p-8 mb-8">
                        <h3 class="font-orbitron text-2xl text-neo-blue mb-4">EVENT OVERVIEW</h3>
                        <p class="font-exo text-gray-300 leading-relaxed text-lg">
                            {{ $event->description }}
                        </p>
                    </div>

                    <!-- Event Image -->
                    <div class="cyber-card p-4">
                        <img src="{{ $event->image_url }}" alt="{{ $event->name }}" 
                             class="w-full h-64 object-cover rounded-lg">
                    </div>
                </div>
                
                <!-- Booking Section -->
                <div data-aos="fade-left">
                    <div class="cyber-card p-8 sticky top-24">
                        <h2 class="font-orbitron text-3xl text-center mb-8 cyber-gradient">
                            SECURE YOUR ACCESS
                        </h2>
                        
                        <!-- Notifications -->
                        @if(session('success'))
                        <div class="cyber-card bg-matrix-green/20 border-matrix-green p-4 mb-6">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-matrix-green rounded-full mr-3 animate-pulse"></span>
                                <span class="font-rajdhani font-semibold text-matrix-green">{{ session('success') }}</span>
                            </div>
                        </div>
                        @endif
                        
                        @if(session('error'))
                        <div class="cyber-card bg-cyber-pink/20 border-cyber-pink p-4 mb-6">
                            <div class="flex items-center">
                                <span class="w-3 h-3 bg-cyber-pink rounded-full mr-3 animate-pulse"></span>
                                <span class="font-rajdhani font-semibold text-cyber-pink">{{ session('error') }}</span>
                            </div>
                        </div>
                        @endif
                        
                        <!-- Booking Form -->
                        <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            @foreach($event->tickets as $ticket)
                            <div class="cyber-card p-6 cursor-pointer transition-all duration-300 ticket-option hover:border-neo-blue/60 hover:shadow-lg hover:shadow-neo-blue/20">
                                <input type="radio" name="ticket_id" value="{{ $ticket->id }}" id="ticket-{{ $ticket->id }}" class="hidden ticket-radio">
                                
                                <label for="ticket-{{ $ticket->id }}" class="cursor-pointer block">
                                    <div class="flex justify-between items-center mb-4">
                                        <div>
                                            <h3 class="font-orbitron text-xl text-white">{{ $ticket->type }}</h3>
                                            <p class="font-exo text-gray-400 text-sm">
                                                {{ $ticket->quantity_available }} access codes remaining
                                            </p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-orbitron text-2xl text-neo-blue">Rp {{ number_format($ticket->price) }}</p>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- Quantity Selector -->
                                <div class="mt-4 hidden quantity-selector">
                                    <label class="block font-rajdhani text-gray-400 mb-2 font-semibold">ACCESS QUANTITY:</label>
                                    <div class="flex items-center space-x-4">
                                        <input type="number" name="quantity" min="1" max="{{ $ticket->quantity_available }}" 
                                               class="cyber-input w-20 text-center font-orbitron" value="1">
                                        <span class="font-exo text-gray-400 text-sm">max {{ $ticket->quantity_available }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                            <button type="submit" 
                                    class="w-full glow-button font-rajdhani text-lg font-bold py-4 mt-6">
                                BAYAR
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ticketOptions = document.querySelectorAll('.ticket-option');
            
            ticketOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active state from all options
                    ticketOptions.forEach(opt => {
                        opt.classList.remove('border-neo-blue/60', 'shadow-lg', 'shadow-neo-blue/20', 'bg-neo-blue/10');
                        opt.querySelector('.quantity-selector').classList.add('hidden');
                    });
                    
                    // Add active state to clicked option
                    this.classList.add('border-neo-blue/60', 'shadow-lg', 'shadow-neo-blue/20', 'bg-neo-blue/10');
                    this.querySelector('.quantity-selector').classList.remove('hidden');
                    
                    // Check the radio button
                    const radio = this.querySelector('.ticket-radio');
                    radio.checked = true;
                });
            });
        });
    </script>
@endsection