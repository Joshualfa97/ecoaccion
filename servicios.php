<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * servicios.php - Página Cómo Ayudar / Servicios
 * 
 * Las cards se generan dinámicamente desde un arreglo JavaScript (cards.js)
 * Mínimo 6 cards requeridas: Reforestación, Limpieza de ríos, Educación ambiental,
 * Reciclaje comunitario, Voluntariado, Donaciones
 * Usa imagenes.php para gestión centralizada de imágenes
 */
$IMAGENES = include 'includes/imagenes.php';
?>
<?php include 'includes/header.php'; ?>

<!-- ========================================
     HERO SERVICIOS
     ======================================== -->
<section class="hero" style="min-height: 50vh;" aria-labelledby="servicios-hero-title">
    <div class="hero__background">
        <img src="<?= $IMAGENES['hero_servicios'] ?>" 
             alt="" 
             class="hero__bg-image"
             aria-hidden="true">
    </div>
    <div class="container hero__content">
        <h1 id="servicios-hero-title" class="hero__title">Cómo Ayudar</h1>
        <p class="hero__slogan">Elige la forma en que quieres ser parte del cambio</p>
        <p class="hero__problem">Cada acción suma. Encuentra la que mejor se adapte a ti.</p>
    </div>
</section>

<!-- ========================================
     GRID DE SERVICIOS (CARDS DINÁMICAS)
     ======================================== -->
<section class="section" aria-labelledby="servicios-title">
    <div class="container">
        <header class="section__header">
            <h2 id="servicios-title" class="section__title">Nuestros Programas</h2>
            <p class="section__subtitle">6 formas concretas de participar en la conservación ambiental de Costa Rica</p>
        </header>
        
        <!-- CONTENEDOR DONDE SE INSERTARÁN LAS CARDS DINÁMICAMENTE -->
        <div class="services-grid" role="list" aria-label="Programas de acción ambiental">
            <!-- Las cards se generan e insertan aquí mediante JavaScript (cards.js) -->
            <!-- Ver js/cards.js para el arreglo de datos y lógica de renderizado -->
        </div>
        
        <!-- Mensaje de carga mientras JavaScript renderiza -->
        <div class="loading-placeholder" style="text-align: center; padding: var(--spacing-3xl); color: var(--color-gray-500);" aria-live="polite">
            <div style="display: inline-block; width: 40px; height: 40px; border: 3px solid var(--color-primary); border-top-color: transparent; border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: var(--spacing-md);"></div>
            <p>Cargando programas...</p>
            <style>
                @keyframes spin { to { transform: rotate(360deg); } }
            </style>
        </div>
    </div>
</section>

<!-- ========================================
     CTA ADICIONAL
     ======================================== -->
<section class="section" style="background-color: var(--color-light);">
    <div class="container" style="text-align: center; max-width: 800px; margin: 0 auto;">
        <h2 class="section__title">¿No encontraste lo que buscabas?</h2>
        <p class="section__subtitle" style="margin-bottom: var(--spacing-xl);">
            También puedes proponernos una nueva iniciativa, convertirte en embajador ambiental
            o hacer una donación directa para apoyar nuestros viveros y campañas.
        </p>
        <div style="display: flex; gap: var(--spacing-md); justify-content: center; flex-wrap: wrap;">
            <a href="contacto.php?tipo=campañas" class="btn btn--primary btn--large">Proponer Idea</a>
            <a href="contacto.php?tipo=donacion" class="btn btn--secondary btn--large">Donar Directamente</a>
        </div>
    </div>
</section>

<!-- Inyectar configuración de imágenes ANTES de cargar footer (que carga cards.js) -->
<script>
// Configuración de imágenes para cards.js (desde includes/imagenes.php)
window.IMAGENES_CONFIG = {
    'servicio_reforestacion': '<?= $IMAGENES['servicio_reforestacion'] ?>',
    'servicio_limpieza_rios': '<?= $IMAGENES['servicio_limpieza_rios'] ?>',
    'servicio_educacion_ambiental': '<?= $IMAGENES['servicio_educacion_ambiental'] ?>',
    'servicio_reciclaje_comunitario': '<?= $IMAGENES['servicio_reciclaje_comunitario'] ?>',
    'servicio_voluntariado': '<?= $IMAGENES['servicio_voluntariado'] ?>',
    'servicio_donaciones': '<?= $IMAGENES['servicio_donaciones'] ?>',
    'servicio_reforestacion_alt': '<?= $IMAGENES['servicio_reforestacion_alt'] ?>',
    'servicio_limpieza_rios_alt': '<?= $IMAGENES['servicio_limpieza_rios_alt'] ?>',
    'servicio_educacion_ambiental_alt': '<?= $IMAGENES['servicio_educacion_ambiental_alt'] ?>',
    'servicio_reciclaje_comunitario_alt': '<?= $IMAGENES['servicio_reciclaje_comunitario_alt'] ?>',
    'servicio_voluntariado_alt': '<?= $IMAGENES['servicio_voluntariado_alt'] ?>',
    'servicio_donaciones_alt': '<?= $IMAGENES['servicio_donaciones_alt'] ?>',
};
</script>

<?php include 'includes/footer.php'; ?>

<!-- Script para ocultar placeholder de carga cuando cards.js termine -->
<script>
// El placeholder de carga se oculta automáticamente cuando cards.js dispara el evento 'cardsRendered'
document.addEventListener('cardsRendered', function(e) {
    const placeholder = document.querySelector('.loading-placeholder');
    if (placeholder) {
        placeholder.style.display = 'none';
    }
    console.log('Servicios.php: Cards renderizadas -', e.detail.count, 'programas');
});

// Fallback por si cards.js falla
setTimeout(function() {
    const placeholder = document.querySelector('.loading-placeholder');
    const grid = document.querySelector('.services-grid');
    if (placeholder && grid && grid.children.length === 0) {
        placeholder.innerHTML = '<p style="color: var(--color-error);">No se pudieron cargar los programas. <a href="#" onclick="location.reload()">Reintentar</a></p>';
    }
}, 3000);
</script>