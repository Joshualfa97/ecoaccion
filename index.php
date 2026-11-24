<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * index.php - Página principal de ECOACCIÓN COSTA RICA
 * 
 * Incluye header y footer mediante PHP include
 * Usa imagenes.php para gestión centralizada de imágenes
 * Muestra hero con carrusel de imágenes ambientales funcional
 */
$IMAGENES = include 'includes/imagenes.php';
?>
<?php include 'includes/header.php'; ?>

<!-- ========================================
     HERO SECTION
     ======================================== -->
<section class="hero" aria-labelledby="hero-title">
    <div class="hero__background">
        <!-- Imagen de fondo decorativa -->
        <img src="<?= $IMAGENES['hero_index'] ?>" 
             alt="" 
             class="hero__bg-image"
             aria-hidden="true">
    </div>
    
    <div class="container hero__content">
        <h1 id="hero-title" class="hero__title">ECOACCIÓN COSTA RICA</h1>
        <p class="hero__slogan">"Sembrando hoy el futuro de mañana"</p>
        <p class="hero__problem">La pérdida de áreas verdes y la contaminación ambiental afectan nuestras comunidades.</p>
        <a href="contacto.php" class="btn btn--primary btn--large hero__btn" role="button">Quiero ayudar</a>
    </div>
</section>

<!-- ========================================
     CARRUSEL DE IMÁGENES AMBIENTALES
     ======================================== -->
<section class="section" aria-labelledby="carousel-title">
    <div class="container">
        <header class="section__header">
            <h2 id="carousel-title" class="section__title">Nuestras Acciones en Imágenes</h2>
            <p class="section__subtitle">Momentos capturados durante nuestras campañas de reforestación, limpieza y educación ambiental</p>
        </header>
        
        <!-- CARRUSEL -->
        <div class="carousel" role="region" aria-label="Carrusel de actividades ambientales" data-carousel>
            <div class="carousel__track" id="carouselTrack">
                <!-- Slide 1: Reforestación -->
                <div class="carousel__slide">
                    <img src="<?= $IMAGENES['carousel_1'] ?>" 
                         alt="<?= $IMAGENES['carousel_1_alt'] ?>" 
                         class="carousel__image">
                    <div class="carousel__caption">
                        <h3 class="carousel__caption-title"><?= $IMAGENES['carousel_1_title'] ?></h3>
                        <p class="carousel__caption-text"><?= $IMAGENES['carousel_1_text'] ?></p>
                    </div>
                </div>
                
                <!-- Slide 2: Limpieza de ríos -->
                <div class="carousel__slide">
                    <img src="<?= $IMAGENES['carousel_2'] ?>" 
                         alt="<?= $IMAGENES['carousel_2_alt'] ?>" 
                         class="carousel__image">
                    <div class="carousel__caption">
                        <h3 class="carousel__caption-title"><?= $IMAGENES['carousel_2_title'] ?></h3>
                        <p class="carousel__caption-text"><?= $IMAGENES['carousel_2_text'] ?></p>
                    </div>
                </div>
                
                <!-- Slide 3: Educación ambiental -->
                <div class="carousel__slide">
                    <img src="<?= $IMAGENES['carousel_3'] ?>" 
                         alt="<?= $IMAGENES['carousel_3_alt'] ?>" 
                         class="carousel__image">
                    <div class="carousel__caption">
                        <h3 class="carousel__caption-title"><?= $IMAGENES['carousel_3_title'] ?></h3>
                        <p class="carousel__caption-text"><?= $IMAGENES['carousel_3_text'] ?></p>
                    </div>
                </div>
                
                <!-- Slide 4: Reciclaje comunitario -->
                <div class="carousel__slide">
                    <img src="<?= $IMAGENES['carousel_4'] ?>" 
                         alt="<?= $IMAGENES['carousel_4_alt'] ?>" 
                         class="carousel__image">
                    <div class="carousel__caption">
                        <h3 class="carousel__caption-title"><?= $IMAGENES['carousel_4_title'] ?></h3>
                        <p class="carousel__caption-text"><?= $IMAGENES['carousel_4_text'] ?></p>
                    </div>
                </div>
                
                <!-- Slide 5: Voluntariado -->
                <div class="carousel__slide">
                    <img src="<?= $IMAGENES['carousel_5'] ?>" 
                         alt="<?= $IMAGENES['carousel_5_alt'] ?>" 
                         class="carousel__image">
                    <div class="carousel__caption">
                        <h3 class="carousel__caption-title"><?= $IMAGENES['carousel_5_title'] ?></h3>
                        <p class="carousel__caption-text"><?= $IMAGENES['carousel_5_text'] ?></p>
                    </div>
                </div>
            </div>
            
            <!-- Botones de navegación -->
            <button class="carousel__btn carousel__btn--prev" aria-label="Imagen anterior" data-carousel-prev>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>
            
            <button class="carousel__btn carousel__btn--next" aria-label="Imagen siguiente" data-carousel-next>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
            
            <!-- Indicadores -->
            <div class="carousel__indicators" aria-label="Seleccionar imagen" data-carousel-indicators></div>
        </div>
    </div>
</section>

<!-- ========================================
     LLAMADA A LA ACCIÓN (CTA)
     ======================================== -->
<section class="section" style="background-color: var(--color-light);">
    <div class="container">
        <div style="text-align: center; max-width: 700px; margin: 0 auto;">
            <h2 class="section__title">Únete al Cambio</h2>
            <p class="section__subtitle" style="margin-bottom: var(--spacing-xl);">
                Cada acción cuenta. Ya sea plantando un árbol, limpiando un río, educando a otros o donando,
                tu participación hace la diferencia en Costa Rica.
            </p>
            <div style="display: flex; gap: var(--spacing-md); justify-content: center; flex-wrap: wrap;">
                <a href="servicios.php" class="btn btn--primary">Ver cómo ayudar</a>
                <a href="contacto.php" class="btn btn--secondary">Contactarnos</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Script específico del carrusel para index.php -->
<script>
/**
 * Carrusel funcional para index.php
 * Se inicializa automáticamente cuando el DOM está listo
 */
(function() {
    'use strict';
    
    const carousel = document.querySelector('[data-carousel]');
    if (!carousel) return;
    
    const track = carousel.querySelector('[data-carousel-track]') || carousel.querySelector('.carousel__track');
    const slides = track ? track.querySelectorAll('.carousel__slide') : [];
    const prevBtn = carousel.querySelector('[data-carousel-prev]');
    const nextBtn = carousel.querySelector('[data-carousel-next]');
    const indicatorsContainer = carousel.querySelector('[data-carousel-indicators]');
    
    let currentIndex = 0;
    let slideCount = slides.length;
    let autoPlayInterval = null;
    const AUTO_PLAY_DELAY = 5000;
    
    // Crear indicadores dinámicamente
    function createIndicators() {
        if (!indicatorsContainer || slideCount <= 1) return;
        
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i < slideCount; i++) {
            const btn = document.createElement('button');
            btn.className = 'carousel__indicator' + (i === 0 ? ' carousel__indicator--active' : '');
            btn.setAttribute('aria-label', `Ir a imagen ${i + 1} de ${slideCount}`);
            btn.dataset.index = i;
            btn.addEventListener('click', () => goToSlide(i));
            indicatorsContainer.appendChild(btn);
        }
    }
    
    // Actualizar posición del carrusel
    function updateCarousel() {
        if (!track) return;
        
        const offset = -currentIndex * 100;
        track.style.transform = `translateX(${offset}%)`;
        
        // Actualizar indicadores
        const indicators = indicatorsContainer?.querySelectorAll('.carousel__indicator');
        indicators?.forEach((indicator, i) => {
            indicator.classList.toggle('carousel__indicator--active', i === currentIndex);
        });
        
        // Actualizar ARIA
        carousel.setAttribute('aria-current', `slide ${currentIndex + 1} of ${slideCount}`);
    }
    
    // Ir a slide específico
    function goToSlide(index) {
        if (index < 0) index = slideCount - 1;
        if (index >= slideCount) index = 0;
        currentIndex = index;
        updateCarousel();
        resetAutoPlay();
    }
    
    // Slide siguiente
    function nextSlide() {
        goToSlide(currentIndex + 1);
    }
    
    // Slide anterior
    function prevSlide() {
        goToSlide(currentIndex - 1);
    }
    
    // Auto-play
    function startAutoPlay() {
        stopAutoPlay();
        autoPlayInterval = setInterval(nextSlide, AUTO_PLAY_DELAY);
    }
    
    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }
    
    function resetAutoPlay() {
        stopAutoPlay();
        startAutoPlay();
    }
    
    // Event listeners
    if (prevBtn) prevBtn.addEventListener('click', prevSlide);
    if (nextBtn) nextBtn.addEventListener('click', nextSlide);
    
    // Pausar al hover
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    
    // Pausar al focus (accesibilidad)
    carousel.addEventListener('focusin', stopAutoPlay);
    carousel.addEventListener('focusout', startAutoPlay);
    
    // Navegación por teclado
    carousel.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            prevSlide();
        } else if (e.key === 'ArrowRight') {
            e.preventDefault();
            nextSlide();
        }
    });
    
    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    
    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        stopAutoPlay();
    }, { passive: true });
    
    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        startAutoPlay();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) nextSlide();
            else prevSlide();
        }
    }
    
    // Inicializar
    createIndicators();
    updateCarousel();
    startAutoPlay();
    
    // Exponer API pública
    window.CarouselController = {
        next: nextSlide,
        prev: prevSlide,
        goTo: goToSlide,
        pause: stopAutoPlay,
        play: startAutoPlay
    };
    
    console.log('Carrusel index.php: Inicializado con', slideCount, 'slides');
})();
</script>