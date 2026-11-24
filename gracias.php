<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * gracias.php - Página de Confirmación
 * 
 * Recibe datos por POST desde contacto.php
 * Valida nuevamente en servidor (PHP)
 * Muestra mensaje de agradecimiento personalizado
 * 
 * SEGURIDAD: Validación en servidor es OBLIGATORIA porque:
 * - JavaScript se puede desactivar en el navegador
 * - Los datos se pueden manipular (DevTools, Postman, curl)
 * - Es la última línea de defensa antes de procesar/guardar datos
 */

// ========================================
// CONFIGURACIÓN Y FUNCIONES DE VALIDACIÓN
// ========================================

/**
 * Sanitiza entrada para prevenir XSS
 * @param string $data
 * @return string
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Valida un campo y retorna error si existe
 * @param string $value
 * @param array $rules
 * @return string|null Mensaje de error o null si válido
 */
function validateField($value, $rules) {
    // Requerido
    if (!empty($rules['required']) && empty($value)) {
        return $rules['messages']['required'] ?? 'Este campo es obligatorio';
    }
    
    // Si no es requerido y está vacío, es válido
    if (empty($rules['required']) && empty($value)) {
        return null;
    }
    
    // Longitud mínima
    if (!empty($rules['minLength']) && strlen($value) < $rules['minLength']) {
        return $rules['messages']['minLength'] ?? "Mínimo {$rules['minLength']} caracteres";
    }
    
    // Longitud máxima
    if (!empty($rules['maxLength']) && strlen($value) > $rules['maxLength']) {
        return $rules['messages']['maxLength'] ?? "Máximo {$rules['maxLength']} caracteres";
    }
    
    // Patrón (regex)
    if (!empty($rules['pattern']) && !preg_match($rules['pattern'], $value)) {
        return $rules['messages']['pattern'] ?? 'Formato inválido';
    }
    
    // Validación específica de email con filter_var
    if (!empty($rules['email']) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return $rules['messages']['email'] ?? 'Correo electrónico inválido';
    }
    
    return null;
}

// ========================================
// REGLAS DE VALIDACIÓN (MISMAS QUE JS)
// ========================================

$validationRules = [
    'nombre' => [
        'required' => true,
        'minLength' => 2,
        'maxLength' => 100,
        'pattern' => '/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
        'messages' => [
            'required' => 'El nombre es obligatorio',
            'minLength' => 'El nombre debe tener al menos 2 caracteres',
            'maxLength' => 'El nombre no puede exceder 100 caracteres',
            'pattern' => 'El nombre solo puede contener letras y espacios'
        ]
    ],
    'correo' => [
        'required' => true,
        'email' => true,
        'maxLength' => 100,
        'messages' => [
            'required' => 'El correo electrónico es obligatorio',
            'email' => 'Ingrese un correo electrónico válido',
            'maxLength' => 'El correo no puede exceder 100 caracteres'
        ]
    ],
    'telefono' => [
        'required' => true,
        'pattern' => '/^\d{8}$/',
        'messages' => [
            'required' => 'El teléfono es obligatorio',
            'pattern' => 'El teléfono debe tener exactamente 8 dígitos'
        ]
    ],
    'tipoAyuda' => [
        'required' => true,
        'messages' => [
            'required' => 'Seleccione un tipo de ayuda'
        ]
    ],
    'mensaje' => [
        'required' => true,
        'minLength' => 20,
        'maxLength' => 2000,
        'messages' => [
            'required' => 'El mensaje es obligatorio',
            'minLength' => 'El mensaje debe tener al menos 20 caracteres',
            'maxLength' => 'El mensaje no puede exceder 2000 caracteres'
        ]
    ]
];

// ========================================
// PROCESAMIENTO DEL FORMULARIO
// ========================================

$errors = [];
$formData = [];
$isValid = true;

// Solo procesar si es POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Recopilar y sanitizar datos
    foreach ($validationRules as $field => $rules) {
        $rawValue = $_POST[$field] ?? '';
        $cleanValue = sanitizeInput($rawValue);
        $formData[$field] = $cleanValue;
        
        // Validar
        $error = validateField($cleanValue, $rules);
        if ($error) {
            $errors[$field] = $error;
            $isValid = false;
        }
    }
    
    // Validación adicional: tipoAyuda debe ser valor permitido
    $allowedTypes = ['voluntariado', 'donacion', 'campañas'];
    if (!empty($formData['tipoAyuda']) && !in_array($formData['tipoAyuda'], $allowedTypes)) {
        $errors['tipoAyuda'] = 'Tipo de ayuda no válido';
        $isValid = false;
    }
}

// ========================================
// SI HAY ERRORES, REDIRIGIR AL FORMULARIO
// ========================================

if (!$isValid) {
    // Guardar errores en sesión para mostrarlos en contacto.php
    session_start();
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $formData;
    
    // Redirigir de vuelta al formulario
    header('Location: contacto.php');
    exit;
}

// ========================================
// DATOS VÁLIDOS - PREPARAR PARA VISTA
// ========================================

// Mapear tipo de ayuda a texto legible
$tipoAyudaLabels = [
    'voluntariado' => 'Voluntariado',
    'donacion' => 'Donación',
    'campañas' => 'Participación en campañas'
];

$nombre = $formData['nombre'] ?? 'Amigo/a';
$tipoAyuda = $formData['tipoAyuda'] ?? 'voluntariado';
$tipoAyudaTexto = $tipoAyudaLabels[$tipoAyuda] ?? $tipoAyuda;
$correo = $formData['correo'] ?? '';
$telefono = $formData['telefono'] ?? '';
$mensaje = $formData['mensaje'] ?? '';

// ========================================
// VISTA DE AGRADECIMIENTO
// ========================================

include 'includes/header.php';
?>

<!-- ========================================
     PÁGINA DE GRACIAS
     ======================================== -->
<section class="thanks" aria-labelledby="thanks-title">
    <div class="container thanks__container">
        <!-- Icono de éxito animado -->
        <div class="thanks__icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
        </div>
        
        <h1 id="thanks-title" class="thanks__title">¡Gracias por tu Apoyo!</h1>
        
        <!-- Mensaje principal personalizado -->
        <p class="thanks__message">
            Gracias <strong><?= $nombre ?></strong> por apoyar nuestra causa mediante <strong><?= $tipoAyudaTexto ?></strong>.
        </p>
        
        <p class="thanks__message" style="margin-top: var(--spacing-md);">
            Tu mensaje ha sido recibido correctamente. Nuestro equipo de coordinación te contactará 
            a la brevedad posible (menos de 48 horas) al correo <strong><?= $correo ?></strong> 
            o al teléfono <strong><?= $telefono ?></strong>.
        </p>
        
        <!-- Detalles del envío -->
        <div class="thanks__details" role="region" aria-label="Detalles de tu envío">
            <h3 style="margin-bottom: var(--spacing-md); font-size: var(--font-size-lg); color: var(--color-gray-900);">Resumen de tu solicitud</h3>
            
            <div class="thanks__detail-item">
                <span class="thanks__detail-label">Nombre:</span>
                <span class="thanks__detail-value"><?= $nombre ?></span>
            </div>
            
            <div class="thanks__detail-item">
                <span class="thanks__detail-label">Correo:</span>
                <span class="thanks__detail-value"><?= $correo ?></span>
            </div>
            
            <div class="thanks__detail-item">
                <span class="thanks__detail-label">Teléfono:</span>
                <span class="thanks__detail-value"><?= $telefono ?></span>
            </div>
            
            <div class="thanks__detail-item">
                <span class="thanks__detail-label">Tipo de ayuda:</span>
                <span class="thanks__detail-value"><?= $tipoAyudaTexto ?></span>
            </div>
            
            <div class="thanks__detail-item">
                <span class="thanks__detail-label">Mensaje:</span>
                <span class="thanks__detail-value" style="max-width: 300px; word-break: break-word;"><?= nl2br($mensaje) ?></span>
            </div>
        </div>
        
        <!-- Próximos pasos -->
        <div style="background: var(--color-primary-light); color: var(--color-white); padding: var(--spacing-lg); border-radius: var(--border-radius-lg); margin: var(--spacing-xl) 0;">
            <h3 style="margin-bottom: var(--spacing-md);">¿Qué sigue ahora?</h3>
            <ul style="line-height: 2; padding-left: var(--spacing-lg);">
                <li>Recibirás un correo de confirmación automático</li>
                <li>Nuestro coordinador te llamará o escribirá en 24-48 horas</li>
                <li>Te informaremos las próximas actividades según tu preferencia</li>
                <li>Si elegiste donación, recibirás instrucciones de pago seguro</li>
            </ul>
        </div>
        
        <!-- Botones de acción -->
        <div style="display: flex; gap: var(--spacing-md); justify-content: center; flex-wrap: wrap; margin-top: var(--spacing-xl);">
            <a href="index.php" class="btn btn--primary thanks__btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Volver al Inicio
            </a>
            <a href="servicios.php" class="btn btn--secondary thanks__btn">
                Ver Más Formas de Ayudar
            </a>
            <a href="contacto.php" class="btn btn--outline thanks__btn">
                Enviar Otro Mensaje
            </a>
        </div>
        
        <!-- Nota de privacidad -->
        <p style="font-size: var(--font-size-sm); color: var(--color-gray-500); margin-top: var(--spacing-xl);">
            Tus datos se tratan según nuestra Política de Privacidad. No compartimos tu información con terceros.
            Puedes solicitar la eliminación de tus datos en cualquier momento escribiendo a info@ecoaccioncr.org
        </p>
    </div>
</section>

<!-- Script para animación de entrada -->
<script>
(function() {
    'use strict';
    
    // Animar contenedor al cargar
    const container = document.querySelector('.thanks__container');
    if (container) {
        container.style.opacity = '0';
        container.style.transform = 'translateY(20px)';
        container.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        
        requestAnimationFrame(() => {
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        });
    }
    
    // Confetti simple (opcional)
    function createConfetti() {
        const colors = ['#2d6a4f', '#40916c', '#52b788', '#d4a373', '#fff'];
        for (let i = 0; i < 30; i++) {
            const confetti = document.createElement('div');
            confetti.style.cssText = `
                position: fixed;
                width: 10px;
                height: 10px;
                background: ${colors[Math.floor(Math.random() * colors.length)]};
                left: ${Math.random() * 100}vw;
                top: -10px;
                border-radius: ${Math.random() > 0.5 ? '50%' : '0'};
                pointer-events: none;
                z-index: 9999;
                animation: fall ${2 + Math.random() * 3}s linear forwards;
            `;
            document.body.appendChild(confetti);
            
            setTimeout(() => confetti.remove(), 5000);
        }
    }
    
    // CSS para animación de confetti
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fall {
            to {
                transform: translateY(110vh) rotate(720deg);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
    
    // Lanzar confetti después de un breve delay
    setTimeout(createConfetti, 500);
    
})();
</script>

<?php include 'includes/footer.php'; ?>