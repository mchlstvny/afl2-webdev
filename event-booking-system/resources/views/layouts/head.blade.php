<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Event Booking - Neo Future</title>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;400;500;600;700&family=Exo+2:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'neo-blue': '#00F5FF',
                    'electric-purple': '#B026FF',
                    'cyber-pink': '#FF00E5',
                    'matrix-green': '#00FF8D',
                    'dark-space': '#0A0A0F',
                    'deep-space': '#12121F',
                    'space-gray': '#1A1A2E'
                },
                fontFamily: {
                    'orbitron': ['Orbitron', 'sans-serif'],
                    'rajdhani': ['Rajdhani', 'sans-serif'],
                    'exo': ['Exo 2', 'sans-serif']
                },
                animation: {
                    'glow': 'glow 2s ease-in-out infinite alternate',
                    'float': 'float 6s ease-in-out infinite',
                    'pulse-glow': 'pulse-glow 4s ease-in-out infinite',
                }
            }
        }
    }
</script>