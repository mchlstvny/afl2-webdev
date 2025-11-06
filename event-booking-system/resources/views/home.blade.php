@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="min-h-screen flex items-center justify-center relative overflow-hidden grid-pattern">
        <div class="absolute inset-0 bg-linear-to-br from-dark-space via-deep-space to-space-gray"></div>
        
        <!-- Animated Orbs -->
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-electric-purple/20 rounded-full blur-3xl animate-pulse-glow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-neo-blue/20 rounded-full blur-3xl animate-pulse-glow" style="animation-delay: 2s;"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10" data-aos="fade-up">
            <div class="mb-8">
                <h1 class="font-orbitron text-6xl md:text-8xl font-black mb-6 cyber-gradient tracking-tight">
                    ENTER THE
                    <span class="block text-transparent bg-clip-text bg-linear-to-r from-matrix-green to-neo-blue neon-text">
                        NEXUS
                    </span>
                </h1>
                
                <p class="font-exo text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Temukan konser dan pertunjukan terbaik dari artis-artis Indonesia favoritmu.
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <a href="{{ route('events.index') }}" 
                   class="glow-button font-rajdhani text-lg font-bold text-white px-12 py-4">
                    JELAJAHI EVENT
                </a>
                
                <div class="flex items-center space-x-4 text-neo-blue">
                    <div class="w-2 h-2 bg-neo-blue rounded-full animate-pulse"></div>
                    <span class="font-exo text-sm uppercase tracking-widest">LIVE CONNECTIONS</span>
                    <div class="w-2 h-2 bg-neo-blue rounded-full animate-pulse"></div>
                </div>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-6 h-10 border-2 border-neo-blue rounded-full flex justify-center">
                <div class="w-1 h-3 bg-neo-blue rounded-full mt-2"></div>
            </div>
        </div>
    </section>

    <!-- Featured Events -->
    <section class="py-20 relative">
        <div class="absolute inset-0 bg-linear-to-t from-dark-space/80 to-transparent z-0"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="font-orbitron text-4xl md:text-5xl font-bold mb-4 cyber-gradient">
                    FEATURED <span class="text-matrix-green neon-text">EVENTS</span>
                </h2>
                <p class="font-exo text-xl text-gray-400 max-w-2xl mx-auto">
                    Pengalaman konser terbaik dari panggung paling ikonik di Indonesia
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestEvents as $event)
                <div class="cyber-card p-6 group cursor-pointer transform transition-all duration-500 hover:scale-105"
                     data-aos="zoom-in" data-aos-delay="{{ $loop->index * 200 }}">
                    <div class="mb-6 h-48 rounded-xl overflow-hidden relative">
                        <img src="{{ $event->image_url }}" alt="{{ $event->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <div class="absolute top-4 right-4">
                            <span class="bg-electric-purple/90 text-white px-3 py-1 rounded-full font-rajdhani text-sm font-bold neon-text">
                                {{ $event->date_time->format('M d') }}
                            </span>
                        </div>
                        
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black/80 to-transparent p-4">
                            <h3 class="font-orbitron text-xl text-white font-bold">{{ $event->name }}</h3>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center text-gray-400 font-exo text-sm">
                            <span class="w-2 h-2 bg-neo-blue rounded-full mr-2"></span>
                            {{ $event->location }}
                        </div>
                        
                        <div class="flex justify-between items-center">
                            @foreach($event->tickets as $ticket)
                            <span class="font-rajdhani text-xs bg-neo-blue/20 text-neo-blue px-2 py-1 rounded">
                                {{ $ticket->type }}
                            </span>
                            @endforeach
                        </div>
                        
                        <a href="{{ route('events.show', $event) }}" 
                           class="block w-full text-center bg-linear-to-r from-neo-blue/20 to-electric-purple/20 hover:from-neo-blue/30 hover:to-electric-purple/30 text-white py-3 rounded-lg font-rajdhani font-semibold tracking-wide border border-neo-blue/30 transition-all duration-300 group-hover:border-neo-blue/60">
                            DETAIL EVENT
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-linear-to-b from-space-gray to-dark-space">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div class="cyber-card p-6" data-aos="fade-up">
                    <div class="font-orbitron text-3xl text-neo-blue mb-2 neon-text">50+</div>
                    <div class="font-exo text-gray-400">EVENT</div>
                </div>
                <div class="cyber-card p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="font-orbitron text-3xl text-electric-purple mb-2 neon-text">10K+</div>
                    <div class="font-exo text-gray-400">PENGGUNA AKTIF</div>
                </div>
                <div class="cyber-card p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="font-orbitron text-3xl text-cyber-pink mb-2 neon-text">24 / 7</div>
                    <div class="font-exo text-gray-400">LIVE SUPPORT</div>
                </div>
                <div class="cyber-card p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="font-orbitron text-3xl text-matrix-green mb-2 neon-text">100%</div>
                    <div class="font-exo text-gray-400">KEAMANAN</div>
                </div>
            </div>
        </div>
    </section>
@endsection