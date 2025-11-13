@extends('layouts.app')

@section('content')
    <section class="py-20 min-h-screen grid-pattern flex items-center justify-center">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto text-center" data-aos="zoom-in">
                <!-- Success Animation -->
                <div class="mb-8">
                    <div class="w-32 h-32 bg-matrix-green/20 rounded-full flex items-center justify-center mx-auto mb-6 border-4 border-matrix-green/50 animate-pulse">
                        <svg class="w-16 h-16 text-matrix-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                <!-- Confirmation Message -->
                <div class="cyber-card p-8 mb-8 border-matrix-green/50">
                    <h1 class="font-orbitron text-4xl md:text-5xl font-bold mb-4 text-matrix-green neon-text">
                        ACCESS GRANTED
                    </h1>
                    <p class="font-exo text-xl text-gray-300 mb-2">Tiket anda telah diamankan!</p>
                    <p class="font-rajdhani text-neo-blue">Welcome to the nexus</p>
                </div>
                
                <!-- Booking Details -->
                <div class="cyber-card p-8 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left mb-8">
                        <div>
                            <h3 class="font-orbitron text-electric-purple text-xl mb-4">DATA EVENT</h3>
                            <p class="font-rajdhani text-white text-lg font-semibold">{{ $booking->ticket->event->name }}</p>
                            <p class="font-exo text-gray-400">{{ $booking->ticket->event->location }}</p>
                        </div>
                        
                        <div>
                            <h3 class="font-orbitron text-neo-blue text-xl mb-4">INFO AKSES</h3>
                            <p class="font-exo text-white"><strong>Level:</strong> {{ $booking->ticket->type }}</p>
                            <p class="font-exo text-white"><strong>Kuantitas:</strong> {{ $booking->quantity }}</p>
                            <p class="font-exo text-white"><strong>Total:</strong> Rp {{ number_format($booking->total_price) }}</p>
                        </div>
                    </div>
                    
                    <!-- Access Code -->
                    <div class="p-6 bg-linear-to-r from-neo-blue/10 to-electric-purple/10 rounded-lg border border-neo-blue/30">
                        <h3 class="font-orbitron text-cyber-pink text-xl mb-4">KODE AKSES ANDA</h3>
                        <p class="font-orbitron text-3xl text-white glitch tracking-widest">{{ $booking->booking_code }}</p>
                        <p class="font-exo text-gray-400 text-sm mt-2">SIMPAN KODE INI SECARA RAHASIA</p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('events.index') }}" 
                       class="glow-button font-rajdhani font-bold px-8 py-4">
                        JELAJAHI EVENT LAIN
                    </a>
                    
                    <button onclick="window.print()" 
                            class="px-8 py-4 border border-neo-blue text-neo-blue rounded-lg font-rajdhani font-bold hover:bg-neo-blue/10 transition-colors duration-300">
                        PRINT PASS
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection