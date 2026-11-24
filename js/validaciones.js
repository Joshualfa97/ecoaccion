/**
 * validaciones.js - Validación del formulario de contacto (Cliente)
 * 
 * Este archivo implementa:
 * - Validación en tiempo real (on blur/input)
 * - Validación al enviar (submit)
 * - Mensajes de error amigables y accesibles
 * - Patrones de validación para cada campo
 * - Estados visuales de error/éxito
 */

(function() {
    'use strict';

    // ========================================
    // CONFIGURACIÓN DE VALIDACIONES
    // ========================================

    const VALIDATION_RULES = {
        nombre: {
            required: true,
            minLength: 2,
            maxLength: 100,
            pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/,
            messages: {
                required: 'El nombre es obligatorio',
                minLength: 'El nombre debe tener al menos 2 caracteres',
                maxLength: 'El nombre no puede exceder 100 caracteres',
                pattern: 'El nombre solo puede contener letras y espacios'
            }
        },
        correo: {
            required: true,
            pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
            messages: {
                required: 'El correo electrónico es obligatorio',
                pattern: 'Ingrese un correo electrónico válido (ejemplo@dominio.com)'
            }
        },
        telefono: {
            required: true,
            pattern: /^\d{8}$/,
            messages: {
                required: 'El teléfono es obligatorio',
                pattern: 'El teléfono debe tener exactamente 8 dígitos (ej: 22223333)'
            }
        },
        tipoAyuda: {
            required: true,
            messages: {
                required: 'Seleccione un tipo de ayuda'
            }
        },
        mensaje: {
            required: true,
            minLength: 20,
            maxLength: 2000,
            messages: {
                required: 'El mensaje es obligatorio',
                minLength: 'El mensaje debe tener al menos 20 caracteres',
                maxLength: 'El mensaje no puede exceder 2000 caracteres'
            }
        }
    };

    // ========================================
    // ESTADO DEL FORMULARIO
    // ========================================

    let form = null;
    let submitButton = null;
    let isSubmitting = false;

    // ========================================
    // UTILIDADES DE VALIDACIÓN
    // ========================================

    /**
     * Obtiene el grupo del formulario (contenedor del campo)
     * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} field - Campo del formulario
     * @returns {HTMLElement} Grupo del formulario
     */
    function getFieldGroup(field) {
        return field.closest('.form__group');
    }

    /**
     * Obtiene el elemento de mensaje de error
     * @param {HTMLElement} group - Grupo del formulario
     * @returns {HTMLElement|null} Elemento de error
     */
    function getErrorElement(group) {
        return group ? group.querySelector('.form__error') : null;
    }

    /**
     * Muestra error en un campo
     * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} field - Campo con error
     * @param {string} message - Mensaje de error
     */
    function showFieldError(field, message) {
        const group = getFieldGroup(field);
        if (!group) return;
        
        group.classList.add('form__group--error');
        const errorEl = getErrorElement(group);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.setAttribute('role', 'alert');
        }
        
        // ARIA para accesibilidad
        field.setAttribute('aria-invalid', 'true');
        field.setAttribute('aria-describedby', errorEl?.id || '');
    }

    /**
     * Limpia error de un campo
     * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} field - Campo a limpiar
     */
    function clearFieldError(field) {
        const group = getFieldGroup(field);
        if (!group) return;
        
        group.classList.remove('form__group--error');
        const errorEl = getErrorElement(group);
        if (errorEl) {
            errorEl.textContent = '';
            errorEl.removeAttribute('role');
        }
        
        field.removeAttribute('aria-invalid');
        field.removeAttribute('aria-describedby');
    }

    /**
     * Valida un campo individual según sus reglas
     * @param {HTMLInputElement|HTMLTextAreaElement|HTMLSelectElement} field - Campo a validar
     * @returns {boolean} True si es válido
     */
    function validateField(field) {
        const name = field.name;
        const rules = VALIDATION_RULES[name];
        const value = field.value.trim();
        
        if (!rules) return true; // Sin reglas = válido
        
        // Validar requerido
        if (rules.required && !value) {
            showFieldError(field, rules.messages.required);
            return false;
        }
        
        // Si no es requerido y está vacío, es válido
        if (!rules.required && !value) {
            clearFieldError(field);
            return true;
        }
        
        // Validar longitud mínima
        if (rules.minLength && value.length < rules.minLength) {
            showFieldError(field, rules.messages.minLength);
            return false;
        }
        
        // Validar longitud máxima
        if (rules.maxLength && value.length > rules.maxLength) {
            showFieldError(field, rules.messages.maxLength);
            return false;
        }
        
        // Validar patrón (regex)
        if (rules.pattern && !rules.pattern.test(value)) {
            showFieldError(field, rules.messages.pattern);
            return false;
        }
        
        // Para selects, verificar que no sea la opción por defecto (value="")
        if (field.tagName === 'SELECT' && rules.required && !value) {
            showFieldError(field, rules.messages.required);
            return false;
        }
        
        // Si pasó todas las validaciones
        clearFieldError(field);
        return true;
    }

    /**
     * Valida todo el formulario
     * @returns {boolean} True si todo es válido
     */
    function validateForm() {
        if (!form) return false;
        
        const fields = form.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;
        let firstInvalidField = null;
        
        fields.forEach(field => {
            if (!validateField(field)) {
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            }
        });
        
        // Enfocar primer campo inválido
        if (firstInvalidField) {
            firstInvalidField.focus();
            // Scroll suave al campo
            firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        return isValid;
    }

    // ========================================
    // EVENT HANDLERS
    // ========================================

    /**
     * Maneja evento blur (salida de foco) - validar campo individual
     * @param {FocusEvent} event - Evento de foco
     */
    function handleBlur(event) {
        const field = event.target;
        if (field.matches('input, textarea, select')) {
            validateField(field);
        }
    }

    /**
     * Maneja evento input - limpiar error mientras escribe
     * @param {Event} event - Evento de input
     */
    function handleInput(event) {
        const field = event.target;
        if (field.matches('input, textarea, select')) {
            const group = getFieldGroup(field);
            if (group && group.classList.contains('form__group--error')) {
                // Validar en tiempo real solo si ya tenía error
                validateField(field);
            }
        }
    }

    /**
     * Maneja envío del formulario
     * @param {SubmitEvent} event - Evento de submit
     */
    function handleSubmit(event) {
        event.preventDefault();
        
        if (isSubmitting) return;
        
        if (!validateForm()) {
            return;
        }
        
        // Formulario válido - proceder con envío
        submitForm();
    }

    /**
     * Envía el formulario - deja que el formulario nativo haga el POST
     */
    function submitForm() {
        isSubmitting = true;
        submitButton.disabled = true;
        submitButton.textContent = 'Enviando...';
        submitButton.classList.add('btn--loading');
        
        // El formulario ya tiene action="gracias.php" method="POST"
        // Solo necesitamos hacer submit nativo después de validar
        form.submit();
    }

    /**
     * Maneja tecla Enter en textarea (no enviar, solo nueva línea)
     * @param {KeyboardEvent} event - Evento de teclado
     */
    function handleTextareaKeydown(event) {
        if (event.key === 'Enter' && !event.shiftKey && event.target.tagName === 'TEXTAREA') {
            // Permitir nueva línea normal en textarea
            return;
        }
    }

    // ========================================
    // INICIALIZACIÓN
    // ========================================

    function init() {
        // Selector más robusto: busca por id, action, o clase
        form = document.querySelector('#contactForm, form[action="gracias.php"], form.form-container');
        
        if (!form) {
            console.error('Validaciones.js: No se encontró formulario de contacto');
            return;
        }
        
        submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
        
        if (!submitButton) {
            console.error('Validaciones.js: No se encontró botón submit en el formulario');
        }
        
        // Agregar event listeners
        form.addEventListener('submit', handleSubmit);
        form.addEventListener('blur', handleBlur, true); // Captura para todos los campos
        form.addEventListener('input', handleInput, true);
        form.addEventListener('change', handleInput, true); // Para selects y checkboxes
        form.addEventListener('keydown', handleTextareaKeydown);
        
        // Prellenar desde URL params si vienen de servicios.php
        populateFromURLParams();
        
        // Configurar IDs para aria-describedby en errores
        setupErrorIds();
        
        console.log('Validaciones.js: Formulario de contacto inicializado ✓');
    }

    /**
     * Configura IDs únicos para los elementos de error (accesibilidad)
     */
    function setupErrorIds() {
        if (!form) return;
        
        const errorElements = form.querySelectorAll('.form__error');
        errorElements.forEach((el, index) => {
            if (!el.id) {
                el.id = `error-${el.closest('.form__group')?.querySelector('input, textarea, select')?.name || index}`;
            }
        });
    }

    /**
     * Prellena campos desde parámetros URL (ej: ?tipo=voluntariado&servicio=reforestacion)
     */
    function populateFromURLParams() {
        const params = new URLSearchParams(window.location.search);
        
        // Prellenar tipo de ayuda
        const tipo = params.get('tipo');
        if (tipo) {
            const select = form.querySelector('[name="tipoAyuda"]');
            if (select) {
                select.value = tipo;
                // Disparar cambio para validación visual
                select.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }
        
        // Prellenar servicio en mensaje
        const servicio = params.get('servicio');
        const mensajeTextarea = form.querySelector('[name="mensaje"]');
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
    }

    // ========================================
    // API PÚBLICA
    // ========================================

    window.ValidationController = {
        // Validar formulario completo
        validate: validateForm,
        
        // Validar campo específico
        validateField,
        
        // Limpiar todos los errores
        clearAllErrors: function() {
            if (!form) return;
            const fields = form.querySelectorAll('input, textarea, select');
            fields.forEach(clearFieldError);
        },
        
        // Obtener datos del formulario
        getFormData: function() {
            if (!form) return null;
            return Object.fromEntries(new FormData(form).entries());
        },
        
        // Establecer datos del formulario
        setFormData: function(data) {
            if (!form) return;
            Object.entries(data).forEach(([name, value]) => {
                const field = form.querySelector(`[name="${name}"]`);
                if (field) {
                    field.value = value;
                    validateField(field);
                }
            });
        },
        
        // Habilitar/deshabilitar envío
        setSubmitting: function(state) {
            isSubmitting = state;
            if (submitButton) {
                submitButton.disabled = state;
                submitButton.textContent = state ? 'Enviando...' : 'Enviar mensaje';
            }
        }
    };

    // Inicializar cuando el DOM esté listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();