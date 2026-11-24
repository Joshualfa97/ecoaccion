/**
 * menu.js - Manejo del menú hamburguesa y navegación responsive
 * 
 * Este archivo controla:
 * - Apertura/cierre del menú hamburguesa en móviles
 * - Accesibilidad (ARIA, focus management)
 * - Cierre automático al hacer clic en un enlace
 * - Cierre con tecla Escape
 */

(function() {
    'use strict';

    // ========================================
    // SELECCIÓN DE ELEMENTOS DEL DOM
    // ========================================
    
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mainNav = document.getElementById('mainNav');
    const navLinks = mainNav ? mainNav.querySelectorAll('.header__nav-link') : [];
    
    // Estado del menú
    let isMenuOpen = false;

    // ========================================
    // FUNCIONES PRINCIPALES
    // ========================================

    /**
     * Alterna la visibilidad del menú móvil
     * @param {boolean} forceState - Fuerza un estado específico (true = abierto, false = cerrado)
     */
    function toggleMenu(forceState) {
        const newState = typeof forceState === 'boolean' ? forceState : !isMenuOpen;
        
        if (newState === isMenuOpen) return;
        
        isMenuOpen = newState;
        
        // Actualizar atributos ARIA para accesibilidad
        hamburgerBtn.setAttribute('aria-expanded', isMenuOpen);
        hamburgerBtn.setAttribute('aria-label', isMenuOpen ? 'Cerrar menú' : 'Abrir menú');
        
        // Toggle de clases CSS para animaciones
        if (isMenuOpen) {
            mainNav.classList.add('header__nav--open');
            document.body.classList.add('no-scroll');
            // Enfocar el primer enlace para navegación por teclado
            setTimeout(() => {
                const firstLink = mainNav.querySelector('.header__nav-link');
                if (firstLink) firstLink.focus();
            }, 100);
        } else {
            mainNav.classList.remove('header__nav--open');
            document.body.classList.remove('no-scroll');
            // Devolver foco al botón hamburguesa
            hamburgerBtn.focus();
        }
    }

    /**
     * Cierra el menú explícitamente
     */
    function closeMenu() {
        if (isMenuOpen) {
            toggleMenu(false);
        }
    }

    /**
     * Maneja el clic en el botón hamburguesa
     * @param {Event} event - Evento de clic
     */
    function handleHamburgerClick(event) {
        event.stopPropagation();
        toggleMenu();
    }

    /**
     * Maneja clics en enlaces de navegación
     * Cierra el menú en móviles tras la navegación
     * @param {Event} event - Evento de clic
     */
    function handleNavLinkClick(event) {
        // Solo cerrar en móviles (cuando el botón hamburguesa es visible)
        if (window.getComputedStyle(hamburgerBtn).display !== 'none') {
            closeMenu();
        }
    }

    /**
     * Maneja tecla Escape para cerrar menú
     * @param {KeyboardEvent} event - Evento de teclado
     */
    function handleKeydown(event) {
        if (event.key === 'Escape' && isMenuOpen) {
            closeMenu();
        }
        
        // Trap focus dentro del menú cuando está abierto
        if (isMenuOpen && event.key === 'Tab') {
            trapFocus(event);
        }
    }

    /**
     * Trap focus dentro del menú para accesibilidad
     * @param {KeyboardEvent} event - Evento de teclado
     */
    function trapFocus(event) {
        const focusableElements = mainNav.querySelectorAll(
            'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        if (event.shiftKey && document.activeElement === firstElement) {
            event.preventDefault();
            lastElement.focus();
        } else if (!event.shiftKey && document.activeElement === lastElement) {
            event.preventDefault();
            firstElement.focus();
        }
    }

    /**
     * Cierra el menú al hacer clic fuera de él
     * @param {Event} event - Evento de clic
     */
    function handleOutsideClick(event) {
        if (isMenuOpen && 
            !mainNav.contains(event.target) && 
            !hamburgerBtn.contains(event.target)) {
            closeMenu();
        }
    }

    /**
     * Maneja cambios de tamaño de ventana
     * Cierra el menú si se redimensiona a desktop
     */
    function handleResize() {
        if (window.innerWidth >= 701 && isMenuOpen) {
            closeMenu();
        }
    }

    // ========================================
    // INICIALIZACIÓN DE EVENT LISTENERS
    // ========================================

    function init() {
        // Verificar que los elementos existan
        if (!hamburgerBtn || !mainNav) {
            console.warn('Menu.js: Elementos del menú no encontrados');
            return;
        }

        // Event listeners
        hamburgerBtn.addEventListener('click', handleHamburgerClick);
        
        navLinks.forEach(link => {
            link.addEventListener('click', handleNavLinkClick);
        });
        
        document.addEventListener('keydown', handleKeydown);
        document.addEventListener('click', handleOutsideClick);
        window.addEventListener('resize', handleResize);
        
        // Manejar navegación con botón atrás/adelante del navegador
        window.addEventListener('popstate', closeMenu);
        
        console.log('Menu.js: Inicializado correctamente');
    }

    // ========================================
    // API PÚBLICA (para uso externo si se necesita)
    // ========================================

    window.MenuController = {
        open: () => toggleMenu(true),
        close: closeMenu,
        toggle: toggleMenu,
        isOpen: () => isMenuOpen
    };

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();