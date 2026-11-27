/**
 * menu.js - Mobile First Responsive Menu
 */

(function() {
    'use strict';
    
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mainNav = document.getElementById('mainNav');
    
    if (!hamburgerBtn || !mainNav) {
        console.warn('Menu.js: Elementos no encontrados');
        return;
    }
    
    // Toggle menu
    hamburgerBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = mainNav.classList.toggle('header__nav--open');
        hamburgerBtn.setAttribute('aria-expanded', isOpen);
        hamburgerBtn.setAttribute('aria-label', isOpen ? 'Cerrar menú' : 'Abrir menú');
    });
    
    // Cerrar al click en enlace (mobile)
    mainNav.querySelectorAll('.header__nav-link').forEach(function(link) {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 700) {
                mainNav.classList.remove('header__nav--open');
                hamburgerBtn.setAttribute('aria-expanded', 'false');
            }
        });
    });
    
    // Cerrar al resize a desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 700) {
            mainNav.classList.remove('header__nav--open');
            hamburgerBtn.setAttribute('aria-expanded', 'false');
        }
    });
    
    console.log('Menu.js: Mobile-first cargado');
})();