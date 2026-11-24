<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * contacto.php - Página de Contacto
 * 
 * Formulario con validaciones JavaScript y PHP
 * Acordeón FAQ con preguntas frecuentes
 * Envía a gracias.php mediante POST
 * Usa imagenes.php para gestión centralizada de imágenes
 */
$IMAGENES = include 'includes/imagenes.php';
?>
<?php include 'includes/header.php'; ?>

<!-- ========================================
     HERO CONTACTO
     ======================================== -->
<section class="hero" style="min-height: 50vh;" aria-labelledby="contacto-hero-title">
    <div class="hero__background">
        <img src="<?= img_url($IMAGENES, 'hero_contacto') ?>" 
             alt="" 
             class="hero__bg-image"
             aria-hidden="true">
    </div>
    <div class="container hero__content">
        <h1 id="contacto-hero-title" class="hero__title">Contacto</h1>
        <p class="hero__slogan">¿Listo para ser parte del cambio? Escríbenos</p>
        <p class="hero__problem">Tu mensaje llega directo a nuestro equipo de coordinación</p>
    </div>
</section>

<!-- ========================================
     FORMULARIO Y FAQ
     ======================================== -->
<section class="section" aria-labelledby="contacto-main-title">
    <div class="container">
        <header class="section__header">
            <h2 id="contacto-main-title" class="section__title">Envíanos tu Mensaje</h2>
            <p class="section__subtitle">Completa el formulario y te responderemos en menos de 48 horas</p>
        </header>
        
        <div class="contact-grid">
            <!-- FORMULARIO DE CONTACTO -->
            <form class="form-container" id="contactForm" action="gracias.php" method="POST" novalidate>
                <h3 class="form__title">Formulario de Contacto</h3>
                
                <!-- NOMBRE -->
                <div class="form__group">
                    <label for="nombre" class="form__label">Nombre completo <span aria-hidden="true">*</span></label>
                    <input 
                        type="text" 
                        id="nombre" 
                        name="nombre" 
                        class="form__input" 
                        placeholder="Juan Pérez"
                        required
                        autocomplete="name"
                        aria-describedby="error-nombre"
                        maxlength="100"
                    >
                    <div class="form__error" id="error-nombre" aria-live="polite"></div>
                </div>
                
                <!-- CORREO -->
                <div class="form__group">
                    <label for="correo" class="form__label">Correo electrónico <span aria-hidden="true">*</span></label>
                    <input 
                        type="email" 
                        id="correo" 
                        name="correo" 
                        class="form__input" 
                        placeholder="juan@ejemplo.com"
                        required
                        autocomplete="email"
                        aria-describedby="error-correo"
                        maxlength="100"
                    >
                    <div class="form__error" id="error-correo" aria-live="polite"></div>
                </div>
                
                <!-- TELÉFONO -->
                <div class="form__group">
                    <label for="telefono" class="form__label">Teléfono (8 dígitos) <span aria-hidden="true">*</span></label>
                    <input 
                        type="tel" 
                        id="telefono" 
                        name="telefono" 
                        class="form__input" 
                        placeholder="22223333"
                        required
                        autocomplete="tel"
                        aria-describedby="error-telefono"
                        maxlength="15"
                        pattern="[\d\s\-]{8,15}"
                        inputmode="numeric"
                    >
                    <div class="form__error" id="error-telefono" aria-live="polite"></div>
                </div>
                
                <!-- TIPO DE AYUDA -->
                <div class="form__group">
                    <label for="tipoAyuda" class="form__label">Tipo de ayuda <span aria-hidden="true">*</span></label>
                    <select id="tipoAyuda" name="tipoAyuda" class="form__select" required aria-describedby="error-tipoAyuda" autocomplete="off">
                        <option value="">Seleccione una opción</option>
                        <option value="voluntariado">Voluntariado</option>
                        <option value="donacion">Donación</option>
                        <option value="campañas">Participación en campañas</option>
                    </select>
                    <div class="form__error" id="error-tipoAyuda" aria-live="polite"></div>
                </div>
                
                <!-- MENSAJE / DISPONIBILIDAD -->
                <div class="form__group">
                    <label for="mensaje" class="form__label">Disponibilidad o motivo <span aria-hidden="true">*</span></label>
                    <textarea 
                        id="mensaje" 
                        name="mensaje" 
                        class="form__textarea" 
                        placeholder="Cuéntanos tu disponibilidad horaria, motivación, experiencia previa o cualquier detalle..."
                        required
                        aria-describedby="error-mensaje"
                        maxlength="2000"
                    ></textarea>
                    <div class="form__error" id="error-mensaje" aria-live="polite"></div>
                    <div class="form__hint" style="font-size: var(--font-size-xs); color: var(--color-gray-500); margin-top: var(--spacing-xs); display: flex; justify-content: space-between; align-items: center;">
                        <span>Mínimo 20 caracteres - Máximo 2000 caracteres</span>
                        <span id="charCount" class="char-count char-count--normal">0/2000</span>
                    </div>
                </div>
                
                <!-- BOTÓN ENVIAR -->
                <button type="submit" class="btn btn--primary form__submit" style="width: 100%;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="margin-right: var(--spacing-sm);">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    Enviar Mensaje
                </button>
            </form>
            
            <!-- FAQ CARDS -->
            <aside class="faq-container" aria-labelledby="faq-title">
                <h3 id="faq-title" class="faq__title">Preguntas Frecuentes</h3>
                
                <div class="faq__cards" role="list" aria-label="Preguntas frecuentes">
                    <!-- FAQ 1 -->
                    <article class="faq__card" role="listitem">
                        <button class="faq__card-header" aria-expanded="true" aria-controls="faq-answer-1">
                            <span class="faq__card-question">¿Cómo puedo unirme?</span>
                            <svg class="faq__card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div class="faq__card-content" id="faq-answer-1" role="region" aria-hidden="false">
                            <div class="faq__card-body">
                                <p class="faq__answer-text">
                                    Es muy sencillo: completa el formulario de contacto seleccionando "Voluntariado" como tipo de ayuda.
                                    Nuestro equipo de coordinación te contactará para agendar una entrevista breve y asignarte a la campaña
                                    que mejor se adapte a tu perfil, disponibilidad y ubicación. No se requiere experiencia previa,
                                    solo ganas de aprender y aportar.
                                </p>
                            </div>
                        </div>
                    </article>
                    
                    <!-- FAQ 2 -->
                    <article class="faq__card" role="listitem">
                        <button class="faq__card-header" aria-expanded="false" aria-controls="faq-answer-2">
                            <span class="faq__card-question">¿Dónde se realizan las actividades?</span>
                            <svg class="faq__card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div class="faq__card-content" id="faq-answer-2" role="region" aria-hidden="true">
                            <div class="faq__card-body">
                                <p class="faq__answer-text">
                                    Trabajamos en 12 comunidades de Costa Rica, principalmente en: Zona Norte (San Carlos, Guatuso),
                                    Caribe (Limón, Talamanca), Pacífico Central (Puntarenas, Quepos) y Valle Central.
                                    Las actividades específicas varían: reforestación en áreas protegidas y fincas privadas,
                                    limpieza en ríos como Río Grande de Tárcoles, Río Virilla y Río Reventazón,
                                    y talleres en escuelas y centros comunales. Al inscribirte te informamos las próximas fechas
                                    y ubicaciones cercanas a ti.
                                </p>
                            </div>
                        </div>
                    </article>
                    
                    <!-- FAQ 3 -->
                    <article class="faq__card" role="listitem">
                        <button class="faq__card-header" aria-expanded="false" aria-controls="faq-answer-3">
                            <span class="faq__card-question">¿Cómo se utilizan las donaciones?</span>
                            <svg class="faq__card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div class="faq__card-content" id="faq-answer-3" role="region" aria-hidden="true">
                            <div class="faq__card-body">
                                <p class="faq__answer-text">
                                    La transparencia es pilar fundamental. Las donaciones se destinan a:
                                </p>
                                <ul style="margin: var(--spacing-md) 0; padding-left: var(--spacing-lg); line-height: 2;">
                                    <li><strong>Viveros propios:</strong> Producción de árboles nativos (60% del presupuesto)</li>
                                    <li><strong>Logística:</strong> Transporte de voluntarios, herramientas, materiales de seguridad</li>
                                    <li><strong>Educación:</strong> Materiales didácticos, capacitación de docentes, talleres</li>
                                    <li><strong>Monitoreo:</strong> Seguimiento de supervivencia de árboles, calidad de agua</li>
                                    <li><strong>Operación:</strong> Seguros, permisos, plataforma digital, coordinación</li>
                                </ul>
                                <p class="faq__answer-text">
                                    Publicamos informes financieros trimestrales en nuestra web. Cada donante recibe certificado
                                    de aporte y reporte de impacto anual.
                                </p>
                            </div>
                        </div>
                    </article>
                    
                    <!-- FAQ 4 -->
                    <article class="faq__card" role="listitem">
                        <button class="faq__card-header" aria-expanded="false" aria-controls="faq-answer-4">
                            <span class="faq__card-question">¿Necesito experiencia previa?</span>
                            <svg class="faq__card-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <div class="faq__card-content" id="faq-answer-4" role="region" aria-hidden="true">
                            <div class="faq__card-body">
                                <p class="faq__answer-text">
                                    <strong>Absolutamente no.</strong> Nuestros programas están diseñados para todos los niveles.
                                    Cada actividad comienza con una capacitación en sitio dirigida por nuestro equipo técnico.
                                    Recibirás:
                                </p>
                                <ul style="margin: var(--spacing-md) 0; padding-left: var(--spacing-lg); line-height: 2;">
                                    <li>Inducción de seguridad y uso de herramientas</li>
                                    <li>Técnicas de plantación según especie y terreno</li>
                                    <li>Identificación de especies nativas vs invasoras</li>
                                    <li>Protocolos de limpieza de ríos y manejo de residuos</li>
                                </ul>
                                <p class="faq__answer-text">
                                    Además, contamos con el programa "Padrino Verde" donde voluntarios experimentados
                                    acompañan a nuevos participantes en sus primeras 3 actividades. La diversidad de
                                    edades y profesiones enriquece la experiencia: desde estudiantes hasta jubilados,
                                    todos aprenden y aportan.
                                </p>
                            </div>
                        </div>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Script para contador de caracteres en textarea y mejoras del acordeón -->
<script>
(function() {
    'use strict';
    
    // ========================================
    // ELEMENTOS COMUNES
    // ========================================
    const mensajeTextarea = document.getElementById('mensaje');
    const charCount = document.getElementById('charCount');
    
    // ========================================
    // CONTADOR DE CARACTERES EN TEXTAREA
    // ========================================
    if (mensajeTextarea && charCount) {
        function updateCharCount() {
            const length = mensajeTextarea.value.length;
            const maxLength = parseInt(mensajeTextarea.getAttribute('maxlength'), 10) || 2000;
            const minLength = 20; // Validación vía JS, minlength no es válido en textarea
            
            charCount.textContent = `${length}/${maxLength}`;
            
            // Usar clases CSS en lugar de style directo
            charCount.classList.remove('char-count--error', 'char-count--warning', 'char-count--normal');
            if (length < minLength) {
                charCount.classList.add('char-count--error');
            } else if (length > maxLength * 0.9) {
                charCount.classList.add('char-count--warning');
            } else {
                charCount.classList.add('char-count--normal');
            }
        }
        
        mensajeTextarea.addEventListener('input', updateCharCount);
        updateCharCount();
    }
    
    // ========================================
    // ACORDEÓN FAQ CARDS - SOLO UNO ABIERTO A LA VEZ
    // ========================================
    const faqCards = document.querySelectorAll('.faq__card');
    let currentlyOpenCard = null;
    
    if (faqCards.length > 0) {
        faqCards.forEach(card => {
            const header = card.querySelector('.faq__card-header');
            const content = card.querySelector('.faq__card-content');
            const icon = card.querySelector('.faq__card-icon');
            
            if (!header || !content) return;
            
            // Inicializar estado (solo la primera abierta)
            const isInitiallyOpen = header.getAttribute('aria-expanded') === 'true';
            if (isInitiallyOpen) {
                currentlyOpenCard = card;
                content.style.maxHeight = content.scrollHeight + 'px';
                content.setAttribute('aria-hidden', 'false');
                if (icon) icon.style.transform = 'rotate(180deg)';
            } else {
                content.style.maxHeight = '0';
                content.setAttribute('aria-hidden', 'true');
            }
            
            header.addEventListener('click', () => {
                const isOpen = header.getAttribute('aria-expanded') === 'true';
                
                // Si ya está abierto, cerrarlo
                if (isOpen) {
                    closeCard(card);
                    currentlyOpenCard = null;
                    return;
                }
                
                // Si hay otra tarjeta abierta, cerrarla primero
                if (currentlyOpenCard && currentlyOpenCard !== card) {
                    closeCard(currentlyOpenCard);
                }
                
                // Abrir esta tarjeta
                openCard(card);
                currentlyOpenCard = card;
            });
            
            // Soporte teclado
            header.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    header.click();
                }
            });
        });
    }
    
    function openCard(card) {
        const header = card.querySelector('.faq__card-header');
        const content = card.querySelector('.faq__card-content');
        const icon = card.querySelector('.faq__card-icon');
        
        header.setAttribute('aria-expanded', 'true');
        content.setAttribute('aria-hidden', 'false');
        content.style.maxHeight = content.scrollHeight + 'px';
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
    
    function closeCard(card) {
        const header = card.querySelector('.faq__card-header');
        const content = card.querySelector('.faq__card-content');
        const icon = card.querySelector('.faq__card-icon');
        
        header.setAttribute('aria-expanded', 'false');
        content.setAttribute('aria-hidden', 'true');
        content.style.maxHeight = '0';
        if (icon) icon.style.transform = 'rotate(0deg)';
    }
    
    // ========================================
    // PRELLENADO DESDE URL
    // ========================================
    const params = new URLSearchParams(window.location.search);
    const tipo = params.get('tipo');
    const servicio = params.get('servicio');
    
    if (tipo) {
        const select = document.getElementById('tipoAyuda');
        if (select) {
            select.value = tipo;
            // Validar via ValidationController si existe
            if (window.ValidationController) {
                window.ValidationController.validateField(select);
            }
        }
    }
    
    if (servicio && mensajeTextarea && !mensajeTextarea.value) {
        const servicioNombres = {
            'reforestacion': 'Reforestación',
            'limpieza-rios': 'Limpieza de Ríos',
            'educacion-ambiental': 'Educación Ambiental',
            'reciclaje-comunitario': 'Reciclaje Comunitario',
            'voluntariado': 'Voluntariado',
            'donaciones': 'Donaciones'
        };
        const nombre = servicioNombres[servicio] || servicio;
        mensajeTextarea.value = `Me interesa participar en: ${nombre}.\n\n`;
        mensajeTextarea.dispatchEvent(new Event('input', { bubbles: true }));
    }
    
})();
</script>