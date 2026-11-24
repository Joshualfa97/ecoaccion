/**
 * cards.js - Generación dinámica de cards de servicios
 * 
 * Este archivo implementa:
 * - Array de datos de servicios (configurable via IMAGENES_CONFIG global)
 * - Generación de HTML dinámico desde JavaScript
 * - Inserción en el DOM usando template strings
 * - Event delegation para botones de cards
 * 
 * Las imágenes se toman de window.IMAGENES_CONFIG (definido en servicios.php desde imagenes.php)
 * Si no existe, usa placeholders como fallback.
 */

(function() {
    'use strict';

    // ========================================
    // CONFIGURACIÓN DE IMÁGENES (desde PHP)
    // ========================================
    
    /**
     * Obtiene la configuración de imágenes desde la variable global
     * que se define en servicios.php (proveniente de includes/imagenes.php)
     * @returns {Object} Configuración de imágenes
     */
    function getImagenesConfig() {
        // window.IMAGENES_CONFIG se inyecta desde PHP en servicios.php
        return window.IMAGENES_CONFIG || {
            // Fallbacks por si no se carga la config PHP
            'servicio_reforestacion': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Reforestaci%C3%B3n',
            'servicio_limpieza_rios': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Limpieza+R%C3%ADos',
            'servicio_educacion_ambiental': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Educaci%C3%B3n+Ambiental',
            'servicio_reciclaje_comunitario': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Reciclaje+Comunitario',
            'servicio_voluntariado': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Voluntariado',
            'servicio_donaciones': 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=Donaciones',
            'servicio_reforestacion_alt': 'Voluntarios plantando árboles en zona reforestada',
            'servicio_limpieza_rios_alt': 'Grupo limpiando río costarricense',
            'servicio_educacion_ambiental_alt': 'Taller de educación ambiental con niños',
            'servicio_reciclaje_comunitario_alt': 'Centro de reciclaje comunitario organizado',
            'servicio_voluntariado_alt': 'Grupo de voluntarios trabajando juntos',
            'servicio_donaciones_alt': 'Manos entregando donación simbólica',
        };
    }

    // ========================================
    // DATOS: ARREGLO DE SERVICIOS
    // ========================================
    
    /**
     * Arreglo (array) de objetos que representan cada servicio
     * Cada objeto es una "fila" de datos con propiedades consistentes
     * 
     * ¿Qué es un arreglo?
     * - Una estructura de datos ordenada que almacena múltiples valores
     * - En JavaScript: [valor1, valor2, valor3]
     * - Aquí almacenamos objetos: [{prop: val}, {prop: val}]
     * - Se accede por índice: servicios[0], servicios[1]...
     * - Se recorre con: forEach, map, for...of, for clásico
     * 
     * Las imágenes se resuelven dinámicamente desde getImagenesConfig()
     */
    function createServiciosArray() {
        const IMG = getImagenesConfig();
        
        return [
            {
                id: 'reforestacion',
                titulo: 'Reforestación',
                descripcion: 'Plantamos árboles nativos en zonas degradadas para recuperar bosques, proteger cuencas hidrográficas y capturar CO2. Cada árbol sembrado es un legado para las futuras generaciones.',
                imagen: IMG['servicio_reforestacion'],
                alt: IMG['servicio_reforestacion_alt'],
                icono: '🌳',
                categoria: 'Campo',
                duracion: 'Todo el año',
                botonTexto: 'Participar',
                botonAccion: 'voluntariado'
            },
            {
                id: 'limpieza-rios',
                titulo: 'Limpieza de Ríos',
                descripcion: 'Organizamos jornadas de limpieza en ríos y quebradas para eliminar residuos sólidos, proteger la fauna acuática y devolver la salud a nuestros cuerpos de agua.',
                imagen: IMG['servicio_limpieza_rios'],
                alt: IMG['servicio_limpieza_rios_alt'],
                icono: '💧',
                categoria: 'Agua',
                duracion: 'Época seca',
                botonTexto: 'Unirse',
                botonAccion: 'voluntariado'
            },
            {
                id: 'educacion-ambiental',
                titulo: 'Educación Ambiental',
                descripcion: 'Impartimos talleres en escuelas, comunidades y empresas sobre biodiversidad, cambio climático, reciclaje y consumo responsable. La educación es la base del cambio duradero.',
                imagen: IMG['servicio_educacion_ambiental'],
                alt: IMG['servicio_educacion_ambiental_alt'],
                icono: '📚',
                categoria: 'Educación',
                duracion: 'Todo el año',
                botonTexto: 'Solicitar taller',
                botonAccion: 'contacto'
            },
            {
                id: 'reciclaje-comunitario',
                titulo: 'Reciclaje Comunitario',
                descripcion: 'Establecemos centros de acopio y rutas de reciclaje en comunidades, capacitando a familias en separación de residuos y economía circular.',
                imagen: IMG['servicio_reciclaje_comunitario'],
                alt: IMG['servicio_reciclaje_comunitario_alt'],
                icono: '♻️',
                categoria: 'Residuos',
                duracion: 'Permanente',
                botonTexto: 'Ver centros',
                botonAccion: 'info'
            },
            {
                id: 'voluntariado',
                titulo: 'Voluntariado',
                descripcion: 'Conectamos personas con causas ambientales. Desde jornadas de un día hasta programas de largo plazo, hay una forma de ayudar para cada perfil y disponibilidad.',
                imagen: IMG['servicio_voluntariado'],
                alt: IMG['servicio_voluntariado_alt'],
                icono: '🤝',
                categoria: 'Participación',
                duracion: 'Flexible',
                botonTexto: 'Inscribirse',
                botonAccion: 'voluntariado'
            },
            {
                id: 'donaciones',
                titulo: 'Donaciones',
                descripcion: 'Tu aporte económico financia viveros, herramientas, transporte de voluntarios, materiales educativos y mantenimiento de áreas protegidas. Cada colón cuenta.',
                imagen: IMG['servicio_donaciones'],
                alt: IMG['servicio_donaciones_alt'],
                icono: '💚',
                categoria: 'Apoyo',
                duracion: 'Cuando quieras',
                botonTexto: 'Donar ahora',
                botonAccion: 'donacion'
            }
        ];
    }

    // Crear el array de servicios (se ejecuta una vez al cargar el script)
    const servicios = createServiciosArray();

    // ========================================
    // SELECTORES Y ELEMENTOS DOM
    // ========================================

    const SERVICES_CONTAINER_SELECTOR = '.services-grid';
    let servicesContainer = null;

    // ========================================
    // FUNCIONES DE GENERACIÓN HTML
    // ========================================

    /**
     * Genera el HTML para una card individual usando template strings
     * 
     * ¿Cómo se genera HTML dinámicamente?
     * - Usamos template literals (comillas invertidas ` `)
     * - Permiten interpolación: ${variable}
     * - Pueden tener múltiples líneas
     * - Se crea el string completo y se inserta al DOM
     * 
     * @param {Object} servicio - Objeto con datos del servicio
     * @param {number} index - Índice en el array (para animaciones escalonadas)
     * @returns {string} HTML de la card
     */
    function generateServiceCardHTML(servicio, index) {
        // Calcular delay de animación escalonado (staggered)
        const animationDelay = index * 100; // ms
        
        return `
            <article 
                class="service-card" 
                data-service-id="${servicio.id}"
                data-action="${servicio.botonAccion}"
                style="animation-delay: ${animationDelay}ms;"
            >
                <div class="service-card__image-wrapper">
                    <img 
                        src="${servicio.imagen}" 
                        alt="${servicio.alt}"
                        class="service-card__image"
                        loading="lazy"
                        width="600"
                        height="400"
                    >
                    <div class="service-card__category">${servicio.categoria}</div>
                </div>
                <div class="service-card__content">
                    <div class="service-card__header">
                        <span class="service-card__icon" aria-hidden="true">${servicio.icono}</span>
                        <h3 class="service-card__title">${servicio.titulo}</h3>
                    </div>
                    <p class="service-card__text">${servicio.descripcion}</p>
                    <div class="service-card__meta">
                        <span class="service-card__duration" aria-label="Duración: ${servicio.duracion}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" width="16" height="16">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>
                            ${servicio.duracion}
                        </span>
                    </div>
                    <button 
                        type="button" 
                        class="btn btn--primary service-card__btn"
                        data-action="${servicio.botonAccion}"
                        data-service="${servicio.id}"
                        aria-label="${servicio.botonTexto} para ${servicio.titulo}"
                    >
                        ${servicio.botonTexto}
                    </button>
                </div>
            </article>
        `;
    }

    /**
     * Genera el HTML completo para todas las cards
     * 
     * ¿Cómo se recorre el arreglo?
     * - Usamos Array.map() que transforma cada elemento
     * - map() retorna un NUEVO array con los resultados
     * - Luego usamos join('') para concatenar todos los strings
     * 
     * @returns {string} HTML concatenado de todas las cards
     */
    function generateAllCardsHTML() {
        return servicios.map((servicio, index) => generateServiceCardHTML(servicio, index)).join('');
    }

    // ========================================
    // INSERCIÓN EN EL DOM
    // ========================================

    /**
     * Inserta las cards generadas en el contenedor
     * 
     * ¿Cómo se insertan elementos mediante JavaScript?
     * 1. innerHTML - Reemplaza TODO el contenido interno (rápido, pero destruye nodos existentes)
     * 2. insertAdjacentHTML() - Insere sin destruir nodos existentes (más control)
     * 3. appendChild() - Para nodos ya creados (más rendimiento)
     * 4. DocumentFragment - Para inserciones masivas (mejor rendimiento)
     * 
     * Usamos innerHTML por simplicidad académica, pero en producción
     * se preferiría DocumentFragment o insertAdjacentHTML.
     */
    function renderCards() {
        console.log('Cards.js: renderCards() llamado');
        servicesContainer = document.querySelector(SERVICES_CONTAINER_SELECTOR);
        
        if (!servicesContainer) {
            console.warn('Cards.js: Contenedor .services-grid no encontrado');
            return;
        }

        console.log('Cards.js: Generando HTML para', servicios.length, 'servicios');
        
        // Generar y insertar HTML
        const cardsHTML = generateAllCardsHTML();
        servicesContainer.innerHTML = cardsHTML;
        
        console.log('Cards.js: HTML insertado, botones en DOM:', servicesContainer.querySelectorAll('.service-card__btn').length);
        
        // Agregar event listeners a los botones
        attachCardButtonListeners();
        
        // Disparar evento personalizado para que otros scripts sepan que las cards están listas
        document.dispatchEvent(new CustomEvent('cardsRendered', {
            detail: { count: servicios.length, container: servicesContainer }
        }));
        
        console.log(`Cards.js: ${servicios.length} cards renderizadas ✓`);
    }

    // ========================================
    // MANEJO DE EVENTOS
    // ========================================

    /**
     * Adjunta listeners a los botones de las cards
     * Usa event delegation en el contenedor para mejor rendimiento
     */
    function attachCardButtonListeners() {
        if (!servicesContainer) {
            console.warn('Cards.js: attachCardButtonListeners - servicesContainer es null');
            return;
        }
        
        console.log('Cards.js: Adjuntando event listeners a', servicesContainer);
        
        // Event Delegation: un solo listener en el contenedor padre
        servicesContainer.addEventListener('click', handleCardButtonClick);
        servicesContainer.addEventListener('keydown', handleCardButtonKeydown);
        
        console.log('Cards.js: Event listeners adjuntados ✓');
    }

    /**
     * Maneja clics en botones de cards
     * @param {Event} event - Evento de clic
     */
    function handleCardButtonClick(event) {
        console.log('Cards.js: Click detectado en', event.target);
        const button = event.target.closest('.service-card__btn');
        if (!button) {
            console.log('Cards.js: No es un botón de card (closest returned null)');
            return;
        }
        
        console.log('Cards.js: Botón clickeado:', button.dataset);
        
        const action = button.dataset.action;
        const serviceId = button.dataset.service;
        const service = servicios.find(s => s.id === serviceId);
        
        console.log('Cards.js: Acción:', action, 'Servicio:', serviceId);
        
        // Ejecutar acción según tipo
        handleServiceAction(action, service, button);
    }

    /**
     * Maneja teclado en botones de cards (Enter/Espacio)
     * @param {KeyboardEvent} event - Evento de teclado
     */
    function handleCardButtonKeydown(event) {
        const button = event.target.closest('.service-card__btn');
        if (!button) return;
        
        if (event.key === 'Enter' || event.key === ' ') {
            event.preventDefault();
            button.click();
        }
    }

    /**
     * Ejecuta la acción correspondiente al botón presionado
     * @param {string} action - Tipo de acción
     * @param {Object} service - Objeto del servicio
     * @param {HTMLButtonElement} button - Botón clickeado
     */
    function handleServiceAction(action, service, button) {
        // Feedback visual
        button.classList.add('btn--loading');
        const originalText = button.textContent;
        button.textContent = 'Cargando...';
        button.disabled = true;
        
        // Simular acción asíncrona
        setTimeout(() => {
            button.classList.remove('btn--loading');
            button.textContent = originalText;
            button.disabled = false;
            
            switch (action) {
                case 'voluntariado':
                    // Redirigir a contacto con tipo preseleccionado
                    window.location.href = `contacto.php?tipo=voluntariado&servicio=${service.id}`;
                    break;
                case 'donacion':
                    window.location.href = `contacto.php?tipo=donacion&servicio=${service.id}`;
                    break;
                case 'contacto':
                    window.location.href = `contacto.php?servicio=${service.id}`;
                    break;
                case 'info':
                    showServiceInfo(service);
                    break;
                default:
                    console.log(`Acción no reconocida: ${action}`);
            }
        }, 800);
    }

    /**
     * Muestra información adicional del servicio (modal simple)
     * @param {Object} service - Objeto del servicio
     */
    function showServiceInfo(service) {
        // Crear modal simple dinámicamente
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
                <button class="modal__close" aria-label="Cerrar">&times;</button>
                <div class="modal__header">
                    <span class="modal__icon" aria-hidden="true">${service.icono}</span>
                    <h2 id="modal-title" class="modal__title">${service.titulo}</h2>
                </div>
                <div class="modal__body">
                    <img src="${service.imagen}" alt="${service.alt}" class="modal__image">
                    <p class="modal__description">${service.descripcion}</p>
                    <div class="modal__meta">
                        <div class="modal__meta-item">
                            <strong>Categoría:</strong> ${service.categoria}
                        </div>
                        <div class="modal__meta-item">
                            <strong>Disponibilidad:</strong> ${service.duracion}
                        </div>
                    </div>
                </div>
                <div class="modal__footer">
                    <button class="btn btn--primary modal__action-btn" data-action="${service.botonAccion}" data-service="${service.id}">
                        ${service.botonTexto}
                    </button>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
        document.body.classList.add('no-scroll');
        
        // Focus management
        const closeBtn = modal.querySelector('.modal__close');
        const actionBtn = modal.querySelector('.modal__action-btn');
        closeBtn.focus();
        
        // Cerrar modal
        function closeModal() {
            modal.remove();
            document.body.classList.remove('no-scroll');
        }
        
        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });
        document.addEventListener('keydown', function handleEsc(e) { if (e.key === 'Escape') { closeModal(); document.removeEventListener('keydown', handleEsc); } });
        
        // Acción del botón en modal
        actionBtn.addEventListener('click', () => {
            closeModal();
            handleServiceAction(service.botonAccion, service, actionBtn);
        });
    }

    // ========================================
    // FUNCIONES DE UTILIDAD PARA FILTRADO/BÚSQUEDA
    // ========================================

    /**
     * Filtra y vuelve a renderizar cards por categoría
     * @param {string} categoria - Categoría a filtrar (vacío = todas)
     */
    function filterByCategory(categoria) {
        if (!servicesContainer) return;
        
        const filtered = categoria 
            ? servicios.filter(s => s.categoria === categoria)
            : servicios;
        
        const cardsHTML = filtered.map((servicio, index) => generateServiceCardHTML(servicio, index)).join('');
        servicesContainer.innerHTML = cardsHTML;
        attachCardButtonListeners();
    }

    /**
     * Busca cards por texto en título o descripción
     * @param {string} query - Texto a buscar
     */
    function searchServices(query) {
        if (!servicesContainer) return;
        
        const lowerQuery = query.toLowerCase().trim();
        const filtered = lowerQuery
            ? servicios.filter(s => 
                s.titulo.toLowerCase().includes(lowerQuery) ||
                s.descripcion.toLowerCase().includes(lowerQuery) ||
                s.categoria.toLowerCase().includes(lowerQuery)
            )
            : servicios;
        
        const cardsHTML = filtered.map((servicio, index) => generateServiceCardHTML(servicio, index)).join('');
        servicesContainer.innerHTML = cardsHTML;
        attachCardButtonListeners();
    }

    // ========================================
    // API PÚBLICA
    // ========================================

    window.CardsController = {
        // Renderizar todas las cards
        render: renderCards,
        
        // Obtener datos de servicios
        getServicios: () => [...servicios], // Retorna copia para inmutabilidad
        
        // Obtener un servicio por ID
        getServicio: (id) => servicios.find(s => s.id === id),
        
        // Filtrar por categoría
        filterByCategory,
        
        // Buscar por texto
        searchServices,
        
        // Agregar nuevo servicio dinámicamente
        addServicio: function(nuevoServicio) {
            const servicioConId = {
                ...nuevoServicio,
                id: nuevoServicio.id || nuevoServicio.titulo.toLowerCase().replace(/\s+/g, '-')
            };
            servicios.push(servicioConId);
            if (servicesContainer) {
                renderCards();
            }
        },
        
        // Actualizar servicio existente
        updateServicio: function(id, cambios) {
            const index = servicios.findIndex(s => s.id === id);
            if (index !== -1) {
                servicios[index] = { ...servicios[index], ...cambios };
                if (servicesContainer) {
                    renderCards();
                }
                return true;
            }
            return false;
        },
        
        // Recargar imágenes desde config (útil si cambia IMAGENES_CONFIG)
        reloadImages: function() {
            // Recrear array con nueva config
            const nuevosServicios = createServiciosArray();
            servicios.length = 0;
            servicios.push(...nuevosServicios);
            if (servicesContainer) {
                renderCards();
            }
        }
    };

    // ========================================
    // INICIALIZACIÓN
    // ========================================

    function init() {
        console.log('Cards.js: init() ejecutado');
        
        // Solo renderizar si estamos en la página de servicios
        const container = document.querySelector(SERVICES_CONTAINER_SELECTOR);
        console.log('Cards.js: Contenedor encontrado:', container ? 'SÍ' : 'NO');
        
        if (container) {
            renderCards();
        } else {
            console.log('Cards.js: No hay contenedor .services-grid en esta página');
        }
        
        console.log('Cards.js: Módulo cargado -', servicios.length, 'servicios disponibles');
    }

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();