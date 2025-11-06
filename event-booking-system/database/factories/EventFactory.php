<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('id_ID');

        $artists = [
            // Artis Populer
            'Nadin Amizah - Live in Concert',
            'Dewa 19 Reunion Tour',
            'Sheila On 7 - Beraksi Kembali',
            'Raisa - It\'s Personal',
            'Tulus - Monokrom Tour',
            'HIVI! - Senandika Tour',
            'Ghea Indrawari - Realita Cinta',
            'Fiersa Besari - Konser Cerita',
            'Yovie & Nuno - Symphony',
            'Ardhito Pramono - Collages',
            
            // Band Indie
            'Diskoria - Dance Party',
            'Reality Club - Neon Tour',
            'The Overtunes - Intimate Session',
            'Maliq & D\'Essentials - Soulful Night',
            'Fourtwnty - Nostalgia',
            'Banda Neira - Cerita Senja',
            'Barasuara - Telepati Tour',
            'The Panturas - Garage Rock Night',
            'Kunto Aji - Mantra Mantra',
            'Dialog Senja - Akustik Special',
            
            // Jazz & Soul
            'Tompi - Jazz Reflections',
            'Ruth Sahanaya - The Legend Returns',
            'Andien - Soulful Journey',
            'Glenn Fredly Tribute Concert',
            'Martha & Ten2Five - Jazz Night',
            
            // Rock & Alternative
            'Slank - Konser 40 Tahun',
            'Superman Is Dead - Punk Rock Party',
            'Netral - Energi Positif',
            'Boomerang - 90s Rock Revival',
            'Padi - Save Our Soul',
            
            // Pop Melayu
            'Rizky Febian - Melangkah Tour',
            'Lesti DA - The Voice of Dangdut',
            'Judika - Sang Juara',
            'Armada - Hijrah Lahir Batin',
            'Ungu - Tempat Terindah'
        ];

        $locations = [
            'GBK Stadium, Jakarta',
            'Istora Senayan, Jakarta',
            'Jiexpo Kemayoran, Jakarta',
            'SICC, BSD City',
            'Parkir Timur Senayan, Jakarta',
            'Dago Tea House, Bandung',
            'Ciputra Artpreneur, Jakarta',
            'Balai Sarbini, Jakarta',
            'The Kasablanka Hall, Jakarta',
            'Studio 14, Kemang Village',
            'Bengkel Space, SCBD Jakarta',
            'Jogja Expo Center, Yogyakarta',
            'Surabaya City Square, Surabaya',
            'Trans Studio Mall, Bandung',
            'Mall Taman Anggrek, Jakarta',
            'Plenary Hall JCC, Jakarta',
            'Tenzer Hall, Bandung',
            'Lapangan Karebosi, Makassar',
            'Gedung Sabuga, Bandung',
            'East Coast Center, Batam'
        ];

        $descriptions = [
            'Nikmati malam tak terlupakan bersama salah satu penyanyi-penulis lagu paling berbakat di Indonesia dalam konser intim yang penuh emosi.',
            'Konser spektakuler dengan lagu-lagu legendaris yang akan membawa Anda bernostalgia ke masa keemasan musik Indonesia.',
            'Malam penuh energi dengan hits terbaik sepanjang masa yang akan membuat Anda bernyanyi dan menari sepanjang konser.',
            'Sebuah perjalanan musikal yang penuh emosi dan cerita kehidupan dalam setiap lirik lagu.',
            'Konser konseptual dengan visual arts menakjubkan dan penampilan musik yang memukau para penonton.',
            'Malam musik penuh jiwa dengan produksi panggung yang megah dan efek spesial yang memukau.',
            'Sesi akustik intim dengan storytelling interaktif antara artis dan penonton.',
            'Konser megah dengan iringan orkestra lengkap dan penampilan spesial tamu undangan.',
            'Pengalaman musik yang tak terlupakan dengan aransemen baru dari lagu-lagu hits.',
            'Konser kolaborasi spesial dengan musisi-musisi ternama Indonesia.',
            'Perayaan musik dengan konsep yang segar dan penampilan yang energik.',
            'Malam penuh kenangan dengan lagu-lagu yang mewarnai perjalanan hidup banyak orang.',
            'Konser eksklusif dengan setlist spesial yang dirancang khusus untuk penggemar setia.',
            'Pertunjukan musik dengan teknologi audio-visual tercanggih dan efek panggung spektakuler.',
            'Experience yang intimate dengan akses meet & greet bersama artis.'
        ];

        return [
            'name' => $faker->randomElement($artists),
            'description' => $faker->randomElement($descriptions),
            'location' => $faker->randomElement($locations),
            'date_time' => $faker->dateTimeBetween('+1 week', '+1 year'),
            'image_url' => $this->getEventImage()
        ];
    }

   private function getEventImage(): string
    {
        $faker = \Faker\Factory::create('id_ID');
        
        $musicImageIds = [
            11,   
            39,   
            56,  
            64,   
            96,  
            125, 
            152,  
            168,  
            184,  
            195,  
            201,    
            219,  
            237,  
            256,  
            294,  
            312, 
            329,  
            345,  
            367,  
            384,  
            398,  
            412, 
            428,  
            445,  
            467,  
            489,  
            502, 
            523,  
            541,  
        ];
        
        $imageId = $faker->randomElement($musicImageIds);
        return "https://picsum.photos/id/{$imageId}/500/300";
    }
}