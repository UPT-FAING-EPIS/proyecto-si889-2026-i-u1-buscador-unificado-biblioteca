
// Funciones globales para estrellas y comentarios
window.generarEstrellas = function(rating) {
    const fullStars = Math.floor(rating);
    let stars = '';
    for (let i = 0; i < fullStars; i++) stars += '★';
    for (let i = stars.length; i < 5; i++) stars += '☆';
    return stars;
};

// Inicializar tooltips de Bootstrap si existen
document.addEventListener('DOMContentLoaded', function() {
    // Configurar scroll horizontal para carruseles
    const scrolls = document.querySelectorAll('.books-scroll');
    scrolls.forEach(container => {
        container.addEventListener('wheel', (e) => {
            if (e.deltaY !== 0) {
                e.preventDefault();
                container.scrollLeft += e.deltaY;
            }
        });
    });
});

/**
 * LÓGICA DE CARRUSEL INTELIGENTE
 * Controla la visibilidad de las flechas y el desplazamiento suave
 */

function updateArrowVisibility(container) {
    const parent = container.parentElement;
    const prevBtn = parent.querySelector('.prev');
    const nextBtn = parent.querySelector('.next');
    
    if (!prevBtn || !nextBtn) return;

    // Detectar si el scroll está al inicio o al final
    const isAtStart = container.scrollLeft <= 15;
    const isAtEnd = container.scrollLeft + container.clientWidth >= container.scrollWidth - 15;

    // Alternar clase de visibilidad
    prevBtn.classList.toggle('arrow-hidden', isAtStart);
    nextBtn.classList.toggle('arrow-hidden', isAtEnd);
}

document.addEventListener('DOMContentLoaded', function() {
    const scrolls = document.querySelectorAll('.books-scroll');

    scrolls.forEach(container => {
        // Ejecutar al cargar para inicializar flechas
        setTimeout(() => updateArrowVisibility(container), 300);

        // Actualizar al hacer scroll
        container.addEventListener('scroll', () => {
            updateArrowVisibility(container);
        });
    });

    // Manejar clics en las flechas
    document.addEventListener('click', function(e) {
        const arrow = e.target.closest('.prev, .next');
        if (!arrow) return;

        const container = arrow.parentElement.querySelector('.books-scroll');
        if (!container) return;

        // Calcular cuánto mover (80% del ancho visible)
        const scrollAmount = container.clientWidth * 0.8;
        const direction = arrow.classList.contains('next') ? 1 : -1;

        container.scrollBy({
            left: scrollAmount * direction,
            behavior: 'smooth'
        });
    });
});

// Watchlist: add/remove via AJAX
document.addEventListener('click', async function(e) {
    const btn = e.target.closest('.watchlist-btn');
    if (!btn) return;

    // Prevent click-through to underlying links or parents
    try { e.preventDefault(); } catch (err) {}
    try { e.stopPropagation(); } catch (err) {}

    // Ensure we have book data
    const bookKey = btn.dataset.bookKey;
    const source = btn.dataset.source || 'academic';
    const titulo = btn.dataset.titulo || '';
    const autor = btn.dataset.autor || '';

    // Check session flag set by server
    if (typeof window.NexusUserId === 'undefined' || window.NexusUserId === null) {
        showToast('¡Ups! Inicia sesión con tu cuenta de Google para guardar tus libros favoritos', 'warning');
        return;
    }

    const icon = btn.querySelector('.watchlist-icon') || btn.querySelector('i');
    const isSaved = icon ? icon.classList.contains('fas') : false;

    try {
        if (!isSaved) {
            // Add
            const res = await fetch('/nexuslib/index.php?action=add-watchlist', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ book_key: bookKey, source: source, titulo: titulo, autor: autor })
            });
            if (res.ok) {
                if (icon) { icon.classList.remove('far'); icon.classList.add('fas'); icon.style.color = '#f59e0b'; }
                showToast('Guardado en tu lista', 'success');
            } else {
                showToast('Error al guardar. Intenta nuevamente.', 'danger');
            }
        } else {
            // Remove
            const res = await fetch('/nexuslib/index.php?action=remove-watchlist', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ book_key: bookKey })
            });
            if (res.ok) {
                if (icon) { icon.classList.remove('fas'); icon.classList.add('far'); icon.style.color = 'rgba(255,255,255,0.9)'; }
                showToast('Eliminado de tu lista', 'info');
            } else {
                showToast('Error al eliminar. Intenta nuevamente.', 'danger');
            }
        }
    } catch (err) {
        showToast('Error de red. Intenta más tarde.', 'danger');
    }
});

function showToast(message, type = 'info') {
    let container = document.getElementById('nexus-toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'nexus-toast-container';
        container.style.position = 'fixed';
        container.style.top = '16px';
        container.style.right = '16px';
        container.style.zIndex = '99999';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-bg-${type} border-0 show`;
    toast.role = 'alert';
    toast.ariaLive = 'assertive';
    toast.ariaAtomic = 'true';
    toast.style.minWidth = '220px';
    toast.style.marginBottom = '8px';
    toast.innerHTML = `<div class="d-flex"><div class="toast-body">${message}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div>`;

    container.appendChild(toast);
    setTimeout(() => { toast.classList.remove('show'); toast.remove(); }, 3000);
}