<!DOCTYPE html>
<html lang="id">
<head>
    @include('layouts.head')
</head>
<body class="min-h-screen relative">
    <!-- Animated Background Particles -->
    <div class="particles" id="particles"></div>
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 backdrop-blur-md bg-dark-space/80 border-b border-neo-blue/20">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="font-orbitron text-2xl font-bold cyber-gradient neon-text">
                    NEXUS.ID
                </a>
                
                <div class="flex space-x-8">
                    <a href="{{ route('home') }}" 
                       class="font-rajdhani text-lg text-white hover:text-neo-blue transition-colors duration-300 font-semibold tracking-wide">
                        BERANDA
                    </a>
                    <a href="{{ route('events.index') }}" 
                       class="font-rajdhani text-lg text-white hover:text-neo-blue transition-colors duration-300 font-semibold tracking-wide">
                        EVENT
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-neo-blue/20 mt-16 py-8 bg-dark-space/50">
        <div class="container mx-auto px-4 text-center">
            <p class="font-rajdhani text-gray-400 tracking-wider">© 2025 EVENT.NEXUS — Platform Tiket Konser Indonesia</p>
        </div>
    </footer>

    @include('layouts.scripts')
</body>
</html>