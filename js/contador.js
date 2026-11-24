/**
 * contador.js - Contador animado para estadísticas
 * 
 * Este archivo implementa:
 * - IntersectionObserver para detectar cuando las estadísticas entran en viewport
 * - Animación de números con easing (suavizado)
 * - Formateo de números con separadores de miles
 * - Configuración flexible por elemento
 * - Fallback garantizado para que siempre animen
 */

(function() {
    'use strict';

    // ========================================
    // CONFIGURACIÓN
    // ========================================

    const CONFIG = {
        // Selector para los elementos contador
        selector: '.stat-card__number, .history__summary-number, .allies-summary-number',
        // Atributo data- con el valor final
        dataAttribute: 'data-count',
        // Duración de la animación en ms
        duration: 1800,
        // Función de easing (suavizado)
        easing: 'easeOutQuart',
        // Umbral de visibilidad para IntersectionObserver (0-1)
        threshold: 0.1,
        // Margen alrededor del viewport para activar antes
        rootMargin: '0px 0px 100px 0px',
        // Solo animar una vez
        once: true
    };

    // ========================================
    // FUNCIONES DE EASING
    // ========================================

    const EASING_FUNCTIONS = {
        linear: t => t,
        easeOutQuart: t => 1 - Math.pow(1 - t, 4),
        easeOutCubic: t => 1 - Math.pow(1 - t, 3),
        easeOutExpo: t => t === 1 ? 1 : 1 - Math.pow(2, -10 * t)
    };

    // ========================================
    // UTILIDADES
    // ========================================

    /**
     * Formatea un número con separadores de miles
     * @param {number} num - Número a formatear
     * @param {string} locale - Locale para formateo
     * @returns {string} Número formateado
     */
    function formatNumber(num, locale = 'es-CR') {
        return new Intl.NumberFormat(locale).format(num);
    }

    /**
     * Parsea el valor objetivo desde el elemento
     * @param {HTMLElement} element - Elemento contador
     * @returns {number} Valor numérico objetivo
     */
    function parseTargetValue(element) {
        const dataValue = element.getAttribute(CONFIG.dataAttribute);
        if (dataValue) {
            return parseInt(dataValue.replace(/[.,\s]/g, ''), 10);
        }
        const textValue = element.textContent.replace(/[.,\s]/g, '');
        return parseInt(textValue, 10) || 0;
    }

    /**
     * Verifica si el elemento ya fue animado
     * @param {HTMLElement} element - Elemento a verificar
     * @returns {boolean}
     */
    function isAnimated(element) {
        return element.hasAttribute('data-animated');
    }

    /**
     * Marca el elemento como animado
     * @param {HTMLElement} element - Elemento a marcar
     */
    function markAsAnimated(element) {
        element.setAttribute('data-animated', 'true');
    }

    // ========================================
    // ANIMACIÓN DEL CONTADOR
    // ========================================

    /**
     * Anima un contador individual
     * @param {HTMLElement} element - Elemento a animar
     * @param {Object} options - Opciones de configuración
     */
    function animateCounter(element, options = {}) {
        // Evitar animar dos veces
        if (isAnimated(element)) return;
        
        const target = parseTargetValue(element);
        if (target === 0) return; // No animar si target es 0
        
        const duration = options.duration || CONFIG.duration;
        const easingFn = EASING_FUNCTIONS[options.easing || CONFIG.easing] || EASING_FUNCTIONS.easeOutQuart;
        const locale = options.locale || 'es-CR';
        
        // Guardar valor inicial (normalmente 0)
        const startValue = 0;
        const startTime = performance.now();
        
        console.log('Animando contador:', element.className, 'target:', target);
        
        // Función de animación usando requestAnimationFrame
        function updateCounter(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const easedProgress = easingFn(progress);
            const currentValue = Math.floor(startValue + (target - startValue) * easedProgress);
            
            // Actualizar el texto con número formateado
            element.textContent = formatNumber(currentValue, locale);
            
            // Continuar animación si no ha terminado
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                // Asegurar valor final exacto
                element.textContent = formatNumber(target, locale);
                markAsAnimated(element);
                
                console.log('Contador completado:', element.className, 'valor:', target);
                
                // Disparar evento personalizado
                element.dispatchEvent(new CustomEvent('counterComplete', {
                    detail: { target, element },
                    bubbles: true
                }));
            }
        }
        
        // Iniciar animación
        requestAnimationFrame(updateCounter);
    }

    // ========================================
    // INTERSECTION OBSERVER
    // ========================================

    /**
     * Crea el IntersectionObserver para detectar visibilidad
     * @returns {IntersectionObserver}
     */
    function createObserver() {
        const options = {
            root: null, // viewport
            rootMargin: CONFIG.rootMargin,
            threshold: CONFIG.threshold
        };

        return new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    if (!isAnimated(element)) {
                        console.log('IntersectionObserver: animando', element.className);
                        animateCounter(element);
                    }
                    
                    // Si solo debe animar una vez, dejar de observar
                    if (CONFIG.once) {
                        observer.unobserve(element);
                    }
                } else if (!CONFIG.once) {
                    // Si no es "once", resetear para volver a animar
                    const element = entry.target;
                    element.removeAttribute('data-animated');
                    element.textContent = formatNumber(0);
                }
            });
        }, options);
    }

    // ========================================
    // INICIALIZACIÓN
    // ========================================

    function init() {
        // Buscar todos los elementos contador
        const counters = document.querySelectorAll(CONFIG.selector);
        
        if (counters.length === 0) {
            console.warn('Contador.js: No se encontraron elementos contador');
            return;
        }

        // Debug: mostrar qué elementos se encontraron
        console.log('Contador.js: Iniciando con', counters.length, 'contadores');
        
        counters.forEach((c, i) => {
            console.log(`  ${i}: class="${c.className}" data-count="${c.getAttribute('data-count')}" text="${c.textContent.trim()}"`);
        });

        // Crear observer
        const observer = createObserver();
        let animatedImmediately = 0;

        // PASO 1: Verificar visibilidad inmediata y animar los que ya se ven
        counters.forEach(counter => {
            // Guardar target si no existe
            if (!counter.hasAttribute('data-count')) {
                const val = parseInt(counter.textContent.replace(/[.,\s]/g, ''), 10) || 0;
                counter.setAttribute('data-count', val);
            }

            // Verificar visibilidad
            const rect = counter.getBoundingClientRect();
            const isVisible = rect.top < window.innerHeight && rect.bottom > 0;
            
            if (isVisible && !counter.hasAttribute('data-animated')) {
                animateCounter(counter);
                animatedImmediately++;
            } else {
                counter.textContent = '0'; // Reset a 0
                observer.observe(counter);
            }
        });

        // FALLBACK INMEDIATO: si no hay IntersectionObserver support o falla
        setTimeout(() => {
            const counters2 = document.querySelectorAll(CONFIG.selector);
            counters2.forEach(counter => {
                if (!counter.hasAttribute('data-animated')) {
                    console.log('Timeout fallback: animando', counter.className);
                    animateCounter(counter);
                }
            });
        }, 300);

        // FALLBACK SEGURO: a los 2 segundos forzar todo
        setTimeout(() => {
            const counters3 = document.querySelectorAll(CONFIG.selector);
            counters3.forEach(counter => {
                if (!counter.hasAttribute('data-animated')) {
                    console.warn('Fallback 2s: forzando animación', counter.className);
                    animateCounter(counter);
                }
            });
        }, 2000);

        console.log('Contador.js: Inicializado -', counters.length, 'contadores');
    }

    // ========================================
    // AUTO-INICIALIZACIÓN
    // ========================================

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();