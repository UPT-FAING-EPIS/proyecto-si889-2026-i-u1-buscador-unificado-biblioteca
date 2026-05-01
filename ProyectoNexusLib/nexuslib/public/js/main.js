document.addEventListener('DOMContentLoaded', function() {
    
    // === 1. LÓGICA DEL LECTOR DE GOOGLE (VISTA PREVIA) ===
    const btn = document.getElementById('open-reader-btn');
    const canvas = document.getElementById('viewerCanvas');

    if (btn && canvas) {
        console.log('Sistema de lectura detectado.');

        function checkBookAvailability() {
            const isbn = btn.getAttribute('data-isbn');
            if (!isbn) return;
            const script = document.createElement('script');
            script.src = `https://books.google.com/books?bibkeys=ISBN:${isbn}&jscmd=viewapi&callback=handleBookResult`;
            document.head.appendChild(script);
        }

        checkBookAvailability();

        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const isbn = btn.getAttribute('data-isbn');
            if (typeof google === 'undefined' || !google.books) {
                alert('La librería de Google no está disponible.');
                return;
            }
            canvas.style.display = 'block';
            canvas.innerHTML = ''; 
            try {
                const viewer = new google.books.DefaultViewer(canvas);
                viewer.load('ISBN:' + isbn);
            } catch (err) {
                console.error('Error al instanciar el visor:', err);
            }
            window.scrollTo({ top: canvas.offsetTop - 50, behavior: 'smooth' });
        });
    }

    // === 2. LÓGICA DE EXPANSIÓN DE DESCRIPCIÓN (VER MÁS) ===
    // Se ejecuta de forma independiente al lector de Google
    const desc = document.getElementById('bookDescription');
    const toggleBtn = document.getElementById('toggleDescription');

    if (desc && toggleBtn) {
        // Usamos un pequeño retraso para asegurar que el navegador calculó las alturas del texto
        setTimeout(() => {
            if (desc.scrollHeight > desc.clientHeight) {
                toggleBtn.style.display = 'inline-block';
            }
        }, 200);

        toggleBtn.addEventListener('click', function() {
            const isClamped = desc.classList.contains('clamped');
            if (isClamped) {
                desc.classList.remove('clamped');
                toggleBtn.innerHTML = '▲ Ver menos';
            } else {
                desc.classList.add('clamped');
                toggleBtn.innerHTML = '▼ Ver más';
            }
        });
    }
});

// === 3. FUNCIÓN GLOBAL DE DISPONIBILIDAD (GOOGLE) ===
window.handleBookResult = function(data) {
    const btn = document.getElementById('open-reader-btn');
    if (!btn) return;
    const isbn = btn.getAttribute('data-isbn');
    const bookData = data[`ISBN:${isbn}`];

    if (!bookData || bookData.preview === 'noview') {
        btn.classList.add('btn-disabled');
        btn.innerHTML = '<i class="fas fa-eye-slash"></i> Vista No Disponible';
        btn.style.pointerEvents = 'none';
        btn.title = "No hay vista previa disponible.";
    }
};

// === 4. LÓGICA DE CARRUSEL INTELIGENTE ===
function updateArrowVisibility(container) {
    const parent = container.parentElement;
    const prevBtn = parent.querySelector('.prev');
    const nextBtn = parent.querySelector('.next');
    if (!prevBtn || !nextBtn) return;
    const isAtStart = container.scrollLeft <= 10;
    const isAtEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 10;
    prevBtn.classList.toggle('arrow-hidden', isAtStart);
    nextBtn.classList.toggle('arrow-hidden', isAtEnd);
}

// Inicialización de carruseles
document.addEventListener('DOMContentLoaded', function() {
    const scrolls = document.querySelectorAll('.books-scroll, .scroll-row, .carousel-container');
    scrolls.forEach(container => {
        setTimeout(() => updateArrowVisibility(container), 300);
        container.addEventListener('scroll', () => updateArrowVisibility(container));
    });

    document.addEventListener('click', function(e) {
        const arrow = e.target.closest('.prev, .next');
        if (!arrow) return;
        const container = arrow.parentElement.querySelector('.books-scroll, .scroll-row, .carousel-container');
        if (!container) return;
        const scrollAmount = container.clientWidth * 0.8;
        const direction = arrow.classList.contains('next') ? 1 : -1;
        container.scrollBy({ left: scrollAmount * direction, behavior: 'smooth' });
    });
});