@extends('layouts.app')

@section('content')
    <section class="py-20 min-h-screen grid-pattern">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-16" data-aos="fade-up">
                <h1 class="font-orbitron text-5xl md:text-6xl font-bold mb-6 cyber-gradient">
                    SEMUA <span class="text-cyber-pink neon-text">EVENT</span>
                </h1>
                <p class="font-exo text-xl text-gray-400 max-w-2xl mx-auto">
                    Jelajahi semua konser dan pertunjukan musik Indonesia yang tersedia
                </p>
            </div>

            <!-- Events Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div class="cyber-card p-6 group cursor-pointer transform transition-all duration-500 hover:scale-105"
                     data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Event Image -->
                    <div class="mb-6 h-48 rounded-xl overflow-hidden relative">
                        <img src="{{ $event->image_url }}" alt="{{ $event->name }}" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        
                        <!-- Date Badge -->
                        <div class="absolute top-4 right-4">
                            <span class="bg-matrix-green/90 text-dark-space px-3 py-1 rounded-full font-rajdhani text-sm font-bold">
                                {{ $event->date_time->format('d M') }}
                            </span>
                        </div>
                        
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-transparent to-transparent opacity-60"></div>
                    </div>

                    <!-- Event Info -->
                    <div class="space-y-4">
                        <h3 class="font-orbitron text-2xl text-white font-bold group-hover:text-neo-blue transition-colors duration-300">
                            {{ $event->name }}
                        </h3>
                        
                        <div class="flex items-center text-gray-400 font-exo text-sm">
                            <span class="w-2 h-2 bg-electric-purple rounded-full mr-2 animate-pulse"></span>
                            {{ $event->location }}
                        </div>
                        
                        <p class="text-gray-300 font-exo text-sm leading-relaxed line-clamp-2">
                            {{ $event->description }}
                        </p>

                        <!-- Ticket Types - Horizontal Compact -->
                        <div class="flex justify-between items-center py-3 border-t border-b border-gray-700/50">
                            @foreach($event->tickets as $ticket)
                            <div class="text-center flex-1">
                                <div class="flex flex-col items-center space-y-1">
                                    <span class="font-rajdhani text-xs text-gray-400 uppercase tracking-wide">{{ $ticket->type }}</span>
                                    <span class="font-orbitron text-neo-blue text-sm">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            @if(!$loop->last)
                            <div class="w-px h-6 bg-gray-600/50"></div>
                            @endif
                            @endforeach
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('events.show', $event) }}" 
                           class="block w-full text-center bg-linear-to-r from-neo-blue/20 to-cyber-pink/20 hover:from-neo-blue/30 hover:to-cyber-pink/30 text-white py-3 rounded-lg font-rajdhani font-semibold tracking-wide border border-neo-blue/30 transition-all duration-300 group-hover:border-cyber-pink/60 group-hover:shadow-lg group-hover:shadow-cyber-pink/20">
                            DETAIL EVENT
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($events->hasPages())
            <div class="mt-16 flex justify-center" data-aos="fade-up">
                <div class="cyber-card p-6">
                    <div class="flex items-center space-x-4 font-rajdhani">
                        <!-- Previous Button -->
                        @if($events->onFirstPage())
                        <span class="px-4 py-2 text-gray-500 cursor-not-allowed border border-gray-600 rounded-lg">
                            ← Sebelumnya
                        </span>
                        @else
                        <a href="{{ $events->previousPageUrl() }}" 
                           class="px-4 py-2 text-neo-blue border border-neo-blue/30 rounded-lg hover:bg-neo-blue/10 transition-all duration-300 hover:shadow-lg hover:shadow-neo-blue/20">
                            ← Sebelumnya
                        </a>
                        @endif

                        <!-- Page Numbers -->
                        <div class="flex space-x-2">
                            @foreach($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                                @if($page == $events->currentPage())
                                <span class="px-4 py-2 bg-neo-blue text-dark-space font-bold rounded-lg border border-neo-blue">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $url }}" 
                                   class="px-4 py-2 text-white border border-neo-blue/30 rounded-lg hover:bg-neo-blue/10 transition-all duration-300">
                                    {{ $page }}
                                </a>
                                @endif
                            @endforeach
                        </div>

                        <!-- Next Button -->
                        @if($events->hasMorePages())
                        <a href="{{ $events->nextPageUrl() }}" 
                           class="px-4 py-2 text-neo-blue border border-neo-blue/30 rounded-lg hover:bg-neo-blue/10 transition-all duration-300 hover:shadow-lg hover:shadow-neo-blue/20">
                            Berikutnya →
                        </a>
                        @else
                        <span class="px-4 py-2 text-gray-500 cursor-not-allowed border border-gray-600 rounded-lg">
                            Berikutnya →
                        </span>
                        @endif
                    </div>

                    <!-- Page Info -->
                    <div class="text-center mt-4">
                        <p class="font-exo text-gray-400 text-sm">
                            Menampilkan <span class="text-matrix-green font-bold">{{ $events->firstItem() }}-{{ $events->lastItem() }}</span> 
                            dari <span class="text-electric-purple font-bold">{{ $events->total() }}</span> event
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Empty State -->
            @if($events->count() == 0)
            <div class="text-center py-16" data-aos="fade-up">
                <div class="cyber-card p-12 max-w-2xl mx-auto">
                    <div class="w-24 h-24 bg-neo-blue/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-neo-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-orbitron text-2xl text-white mb-4">BELUM ADA EVENT</h3>
                    <p class="font-exo text-gray-400 mb-6">Nantikan event-event seru dari artis Indonesia favoritmu</p>
                    <a href="{{ route('home') }}" class="glow-button font-rajdhani font-bold px-8 py-3">
                        KEMBALI KE BERANDA
                    </a>
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection