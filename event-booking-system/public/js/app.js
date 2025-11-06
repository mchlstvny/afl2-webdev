// Initialize AOS
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 1000,
        once: true
    });

    // Create particles background
    createParticles();

    // Ticket selection functionality
    initializeTicketSelection();
});

// Create particles background
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    if (!particlesContainer) return;

    const particleCount = 50;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        
        // Random position
        particle.style.left = Math.random() * 100 + 'vw';
        particle.style.top = Math.random() * 100 + 'vh';
        
        // Random size
        const size = Math.random() * 3 + 1;
        particle.style.width = size + 'px';
        particle.style.height = size + 'px';
        
        // Random animation delay and duration
        particle.style.animationDelay = Math.random() * 8 + 's';
        particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
        
        // Random color
        const colors = ['#00F5FF', '#B026FF', '#FF00E5', '#00FF8D'];
        particle.style.background = colors[Math.floor(Math.random() * colors.length)];
        
        particlesContainer.appendChild(particle);
    }
}

// Ticket selection functionality
function initializeTicketSelection() {
    const ticketOptions = document.querySelectorAll('.ticket-option');
    
    if (ticketOptions.length === 0) return;
    
    ticketOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove active class from all options
            ticketOptions.forEach(opt => {
                opt.classList.remove('border-neo-blue/60', 'shadow-lg', 'shadow-neo-blue/20', 'bg-neo-blue/10');
                const quantitySelector = opt.querySelector('.quantity-selector');
                if (quantitySelector) {
                    quantitySelector.classList.add('hidden');
                }
            });
            
            // Add active class to clicked option
            this.classList.add('border-neo-blue/60', 'shadow-lg', 'shadow-neo-blue/20', 'bg-neo-blue/10');
            const quantitySelector = this.querySelector('.quantity-selector');
            if (quantitySelector) {
                quantitySelector.classList.remove('hidden');
            }
            
            // Check the radio button
            const radio = this.querySelector('.ticket-radio');
            if (radio) {
                radio.checked = true;
            }
        });
    });
}

// Form validation
function validateBookingForm() {
    const selectedTicket = document.querySelector('input[name="ticket_id"]:checked');
    const quantityInput = document.querySelector('input[name="quantity"]');
    
    if (!selectedTicket) {
        alert('Pilih jenis tiket terlebih dahulu');
        return false;
    }
    
    if (!quantityInput || quantityInput.value < 1) {
        alert('Masukkan jumlah tiket yang valid');
        return false;
    }
    
    return true;
}

// Utility function for number formatting (Rupiah)
function formatRupiah(amount) {
    return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}