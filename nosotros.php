<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * nosotros.php - Página Nosotros de ECOACCIÓN COSTA RICA
 * 
 * Contiene: Misión, Visión, Historia y Cards con estadísticas animadas
 * Usa imagenes.php para gestión centralizada de imágenes
 */
$IMAGENES = include 'includes/imagenes.php';
?>
<?php include 'includes/header.php'; ?>

<!-- ========================================
     HERO NOSOTROS
     ======================================== -->
<section class="hero" style="min-height: 50vh;" aria-labelledby="nosotros-hero-title">
    <div class="hero__background">
        <img src="<?= $IMAGENES['hero_nosotros'] ?>" 
             alt="" 
             class="hero__bg-image"
             aria-hidden="true">
    </div>
    <div class="container hero__content">
        <h1 id="nosotros-hero-title" class="hero__title">Nosotros</h1>
        <p class="hero__slogan">Conoce nuestra historia, misión y el impacto que hemos logrado juntos</p>
    </div>
</section>

<!-- ========================================
     MISIÓN, VISIÓN, HISTORIA
     ======================================== -->
<section class="section" aria-labelledby="about-title">
    <div class="container about-content">
        <header class="section__header">
            <h2 id="about-title" class="section__title">Quiénes Somos</h2>
            <p class="section__subtitle">Más de 15 años protegiendo el patrimonio natural de Costa Rica</p>
        </header>
        
        <div class="about-grid">
            <!-- MISIÓN -->
            <article class="about-card">
                <div class="about-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                </div>
                <h3 class="about-card__title">Misión</h3>
                <p class="about-card__text">
                    Restaurar y proteger los ecosistemas de Costa Rica mediante la reforestación con especies nativas,
                    la limpieza de cuerpos de agua, la educación ambiental comunitaria y el fomento del voluntariado,
                    garantizando un legado verde para las presentes y futuras generaciones.
                </p>
            </article>
            
            <!-- VISIÓN -->
            <article class="about-card">
                <div class="about-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <h3 class="about-card__title">Visión</h3>
                <p class="about-card__text">
                    Ser la organización referente en conservación ambiental participativa en Centroamérica,
                    donde cada comunidad costarricense sea guardiana activa de su entorno natural,
                    logrando un país carbono-neutral con bosques conectados y ríos limpios para el 2035.
                </p>
            </article>
            
            <!-- VALORES -->
            <article class="about-card">
                <div class="about-card__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                </div>
                <h3 class="about-card__title">Valores</h3>
                <p class="about-card__text">
                    <strong>Integridad:</strong> Actuamos con transparencia y ética.<br>
                    <strong>Colaboración:</strong> Creemos en el poder del trabajo conjunto.<br>
                    <strong>Ciencia:</strong> Nuestras acciones se basan en evidencia técnica.<br>
                    <strong>Empatía:</strong> Respetamos a las comunidades y la naturaleza.
                </p>
            </article>
        </div>
        
        <!-- HISTORIA / LÍNEA DE TIEMPO MODERNA -->
        <section class="history" aria-labelledby="history-title">
            <header class="history__header">
                <h3 id="history-title" class="history__title">Nuestra Historia</h3>
                <p class="history__subtitle">15 años transformando Costa Rica, un árbol a la vez</p>
            </header>
            
            <div class="history__timeline-modern" role="list" aria-label="Hitos de nuestra historia">
                <!-- 2009 - Fundación -->
                <article class="history__card" role="listitem" data-year="2009">
                    <div class="history__card-marker">
                        <span class="history__card-year">2009</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Fundación de ECOACCIÓN</h4>
                        <p class="history__card-text">Nace como iniciativa de un grupo de biólogos y comunitarios preocupados por la deforestación en la Zona Norte. Un sueño compartido: revertir la pérdida de bosques.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">Inicio</span>
                            <span class="history__card-tag">Zona Norte</span>
                        </div>
                    </div>
                </article>

                <!-- 2012 - Primera Campaña -->
                <article class="history__card history__card--reverse" role="listitem" data-year="2012">
                    <div class="history__card-marker">
                        <span class="history__card-year">2012</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Primera Campaña Masiva: "Un Árbol por Familia"</h4>
                        <p class="history__card-text">Lanzamos nuestra primera campaña nacional logrando 10,000 árboles en un solo año. Expansión exitosa a las provincias de Limón y Puntarenas.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">10,000 árboles</span>
                            <span class="history__card-tag">3 provincias</span>
                        </div>
                    </div>
                </article>

                <!-- 2015 - Ríos Limpios -->
                <article class="history__card" role="listitem" data-year="2015">
                    <div class="history__card-marker">
                        <span class="history__card-year">2015</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 6l6.5 6.5a4.5 4.5 0 0 0 3 1.5 4.5 4.5 0 0 0 1.5-3L18 6"/>
                                <path d="M16 6l-2-2 6-6"/>
                                <path d="M8 18l2-2 6-6"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Programa Ríos Limpios</h4>
                        <p class="history__card-text">Iniciamos limpiezas sistemáticas en 5 cuencas hidrográficas principales. Alianzas estratégicas con municipalidades y MINAE para proteger el recurso hídrico.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">5 cuencas</span>
                            <span class="history__card-tag">Alianzas público-privadas</span>
                        </div>
                    </div>
                </article>

                <!-- 2018 - Educación Formal -->
                <article class="history__card history__card--reverse" role="listitem" data-year="2018">
                    <div class="history__card-marker">
                        <span class="history__card-year">2018</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Educación Formal: "Guardianes del Bosque"</h4>
                        <p class="history__card-text">Creación del currículo ambiental adoptado por 50 escuelas públicas. Capacitación a 200 docentes para formar a las nuevas generaciones en conservación.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">50 escuelas</span>
                            <span class="history__card-tag">200 docentes</span>
                        </div>
                    </div>
                </article>

                <!-- 2021 - Reconocimiento Nacional -->
                <article class="history__card" role="listitem" data-year="2021">
                    <div class="history__card-marker">
                        <span class="history__card-year">2021</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Reconocimiento Nacional e Internacional</h4>
                        <p class="history__card-text">Premio Bandera Azul Ecológica y reconocimiento de la ONU como modelo de conservación comunitaria. Validación de 12 años de trabajo sostenido.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">Bandera Azul</span>
                            <span class="history__card-tag">Reconocimiento ONU</span>
                        </div>
                    </div>
                </article>

                <!-- 2024 - Expansión Digital -->
                <article class="history__card history__card--reverse" role="listitem" data-year="2024">
                    <div class="history__card-marker">
                        <span class="history__card-year">2024</span>
                        <div class="history__card-dot" aria-hidden="true"></div>
                    </div>
                    <div class="history__card-content">
                        <div class="history__card-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                                <path d="M8 21h8"/>
                                <path d="M12 17v4"/>
                            </svg>
                        </div>
                        <h4 class="history__card-title">Expansión Digital y Tecnológica</h4>
                        <p class="history__card-text">Lanzamiento de plataforma de voluntariado digital y app de monitoreo de reforestación en tiempo real. 12 comunidades conectadas mediante tecnología.</p>
                        <div class="history__card-meta">
                            <span class="history__card-tag">App móvil</span>
                            <span class="history__card-tag">12 comunidades</span>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- Resumen final -->
            <div class="history__summary">
                <div class="history__summary-stats">
                    <div class="history__summary-item">
                        <span class="history__summary-number" data-count="15">0</span>
                        <span class="history__summary-label">Años de Trayectoria</span>
                    </div>
                    <div class="history__summary-item">
                        <span class="history__summary-number" data-count="5000">0</span>
                        <span class="history__summary-label">Árboles Sembrados</span>
                    </div>
                    <div class="history__summary-item">
                        <span class="history__summary-number" data-count="12">0</span>
                        <span class="history__summary-label">Comunidades</span>
                    </div>
                    <div class="history__summary-item">
                        <span class="history__summary-number" data-count="50">0</span>
                        <span class="history__summary-label">Escuelas</span>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

<!-- ========================================
     ESTADÍSTICAS CON CONTADOR ANIMADO
     ======================================== -->
<section class="stats" aria-labelledby="stats-title">
    <div class="container">
        <header class="section__header" style="color: var(--color-white); margin-bottom: var(--spacing-xl);">
            <h2 id="stats-title" class="section__title" style="color: var(--color-white);">Nuestro Impacto en Números</h2>
            <p class="section__subtitle" style="color: rgba(255,255,255,0.8);">Resultados medibles de 15 años de trabajo comunitario</p>
        </header>
        
        <div class="stats__grid" role="list" aria-label="Estadísticas de impacto">
            <!-- 5000 árboles -->
            <article class="stat-card" role="listitem">
                <div class="stat-card__number" data-count="5000" id="stat-trees">0</div>
                <p class="stat-card__label">Árboles Sembrados</p>
            </article>
            
            <!-- 300 voluntarios -->
            <article class="stat-card" role="listitem">
                <div class="stat-card__number" data-count="300" id="stat-volunteers">0</div>
                <p class="stat-card__label">Voluntarios Activos</p>
            </article>
            
            <!-- 25 campañas -->
            <article class="stat-card" role="listitem">
                <div class="stat-card__number" data-count="25" id="stat-campaigns">0</div>
                <p class="stat-card__label">Campañas Ambientales</p>
            </article>
            
            <!-- 12 comunidades -->
            <article class="stat-card" role="listitem">
                <div class="stat-card__number" data-count="12" id="stat-communities">0</div>
                <p class="stat-card__label">Comunidades Beneficiadas</p>
            </article>
        </div>
    </div>
</section>

<!-- ========================================
     EQUIPO / ALIADOS
     ======================================== -->
<section class="section" aria-labelledby="team-title">
    <div class="container">
        <header class="section__header">
            <h2 id="team-title" class="section__title">Aliados Estratégicos</h2>
            <p class="section__subtitle">Trabajamos de la mano con instituciones públicas, privadas y comunidad científica</p>
        </header>
        
        <div class="cards" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🏛️</div>
                <h3 class="card__title">MINAE</h3>
                <p class="card__text">Ministerio de Ambiente y Energía</p>
            </article>
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🏛️</div>
                <h3 class="card__title">SINAC</h3>
                <p class="card__text">Sistema Nacional de Áreas de Conservación</p>
            </article>
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🎓</div>
                <h3 class="card__title">UCR / UNA</h3>
                <p class="card__text">Universidades públicas - Investigación</p>
            </article>
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🏘️</div>
                <h3 class="card__title">Municipalidades</h3>
                <p class="card__text">Gobiernos locales de 12 cantones</p>
            </article>
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🏢</div>
                <h3 class="card__title">Empresas Verdes</h3>
                <p class="card__text">Patrocinadores con responsabilidad social</p>
            </article>
            <article class="card" style="text-align: center; padding: var(--spacing-xl);">
                <div style="font-size: 3rem; margin-bottom: var(--spacing-md);">🌍</div>
                <h3 class="card__title">ONGs Internacionales</h3>
                <p class="card__text">Cooperación técnica y financiamiento</p>
            </article>
        </div>
    </div>
</section>

<!-- Forzar animación de contadores de impacto -->
<script>
(function() {
    'use strict';
    
    function animateCounter(el) {
        if (el.hasAttribute('data-animated')) return;
        const target = parseInt(el.getAttribute('data-count') || '0', 10);
        if (!target) return;
        
        el.setAttribute('data-animated', 'true');
        const duration = 1800;
        const start = performance.now();
        
        function tick(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 4);
            el.textContent = new Intl.NumberFormat('es-CR').format(Math.floor(target * eased));
            if (progress < 1) requestAnimationFrame(tick);
            else el.textContent = new Intl.NumberFormat('es-CR').format(target);
        }
        requestAnimationFrame(tick);
    }
    
    // Animar inmediatamente
    document.querySelectorAll('.stat-card__number').forEach(animateCounter);
    
    // Fallback al hacer scroll
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) animateCounter(e.target); });
    }, { rootMargin: '100px', threshold: 0.1 });
    
    document.querySelectorAll('.stat-card__number').forEach(el => {
        if (!el.hasAttribute('data-animated')) observer.observe(el);
    });
})();
</script>

<?php include 'includes/footer.php'; ?>