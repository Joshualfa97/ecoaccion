<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * inscripcion.php - Página de Inscripción para Voluntariado/Donaciones
 * 
 * Formulario completo con validaciones JavaScript y PHP
 * Recibe parámetros URL para pre-seleccionar tipo y servicio
 * Envía a gracias-inscripcion.php mediante POST
 */
$IMAGENES = include 'includes/imagenes.php';

// Obtener parámetros URL
$tipoPredefinido = $_GET['tipo'] ?? '';
$servicioPredefinido = $_GET['servicio'] ?? '';

$tiposValidos = ['voluntariado', 'donacion', 'campañas'];
$serviciosValidos = ['reforestacion', 'limpieza-rios', 'educacion-ambiental', 'reciclaje-comunitario', 'voluntariado', 'donaciones'];

$nombresServicios = [
    'reforestacion' => 'Reforestación',
    'limpieza-rios' => 'Limpieza de Ríos',
    'educacion-ambiental' => 'Educación Ambiental',
    'reciclaje-comunitario' => 'Reciclaje Comunitario',
    'voluntariado' => 'Voluntariado General',
    'donaciones' => 'Donaciones'
];
?>
<?php include 'includes/header.php'; ?>

<!-- ========================================
     HERO INSCRIPCIÓN
     ======================================== -->
<section class="hero" style="min-height: 50vh;" aria-labelledby="inscripcion-hero-title">
    <div class="hero__background">
        <img src="<?= $IMAGENES['hero_inscripcion'] ?>" 
             alt="" 
             class="hero__bg-image"
             aria-hidden="true">
    </div>
    <div class="container hero__content">
        <h1 id="inscripcion-hero-title" class="hero__title">Inscripción</h1>
        <p class="hero__slogan">Únete a ECOACCIÓN COSTA RICA</p>
        <p class="hero__problem">Completa tus datos para participar en nuestras actividades</p>
    </div>
</section>

<!-- ========================================
     FORMULARIO DE INSCRIPCIÓN
     ======================================== -->
<section class="section" aria-labelledby="inscripcion-main-title">
    <div class="container">
        <header class="section__header">
            <h2 id="inscripcion-main-title" class="section__title">Formulario de Inscripción</h2>
            <p class="section__subtitle">Todos los campos marcados con * son obligatorios</p>
        </header>
        
        <div class="form-container" style="max-width: 800px; margin: 0 auto;">
            <form id="inscripcionForm" action="gracias-inscripcion.php" method="POST" novalidate>
                <!-- CAMPO OCULTO: TIPO DE INSCRIPCIÓN -->
                <input type="hidden" name="tipoInscripcion" id="tipoInscripcion" value="<?= htmlspecialchars($tipoPredefinido) ?>">
                <input type="hidden" name="servicioInteres" id="servicioInteres" value="<?= htmlspecialchars($servicioPredefinido) ?>">
                
                <!-- SECCIÓN 1: DATOS PERSONALES -->
                <fieldset class="form__section">
                    <legend class="form__section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                        Datos Personales
                    </legend>
                    
                    <div class="form__row">
                        <div class="form__group">
                            <label for="nombre" class="form__label">Nombre(s) <span aria-hidden="true">*</span></label>
                            <input 
                                type="text" 
                                id="nombre" 
                                name="nombre" 
                                class="form__input" 
                                placeholder="Juan"
                                required
                                autocomplete="given-name"
                                aria-describedby="error-nombre"
                                maxlength="50"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                            >
                            <div class="form__error" id="error-nombre" aria-live="polite"></div>
                        </div>
                        
                        <div class="form__group">
                            <label for="apellidos" class="form__label">Apellidos <span aria-hidden="true">*</span></label>
                            <input 
                                type="text" 
                                id="apellidos" 
                                name="apellidos" 
                                class="form__input" 
                                placeholder="Pérez González"
                                required
                                autocomplete="family-name"
                                aria-describedby="error-apellidos"
                                maxlength="100"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                            >
                            <div class="form__error" id="error-apellidos" aria-live="polite"></div>
                        </div>
                    </div>
                    
                    <div class="form__row">
                        <div class="form__group">
                            <label for="cedula" class="form__label">Cédula / DIMEX <span aria-hidden="true">*</span></label>
                            <input 
                                type="text" 
                                id="cedula" 
                                name="cedula" 
                                class="form__input" 
                                placeholder="1-1234-5678 o DIMEX"
                                required
                                autocomplete="off"
                                aria-describedby="error-cedula"
                                maxlength="20"
                                pattern="[\d\-]+"
                            >
                            <div class="form__error" id="error-cedula" aria-live="polite"></div>
                            <small class="form__hint">Formato: 1-1234-5678 (costarricenses) o número DIMEX (residentes)</small>
                        </div>
                        
                        <div class="form__group">
                            <label for="fechaNacimiento" class="form__label">Fecha de nacimiento <span aria-hidden="true">*</span></label>
                            <input 
                                type="date" 
                                id="fechaNacimiento" 
                                name="fechaNacimiento" 
                                class="form__input" 
                                required
                                aria-describedby="error-fechaNacimiento"
                                max="<?= date('Y-m-d', strtotime('-13 years')) ?>"
                            >
                            <div class="form__error" id="error-fechaNacimiento" aria-live="polite"></div>
                        </div>
                    </div>
                </fieldset>
                
                <!-- SECCIÓN 2: CONTACTO -->
                <fieldset class="form__section">
                    <legend class="form__section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        Información de Contacto
                    </legend>
                    
                    <div class="form__row">
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
                                maxlength="8"
                                pattern="\d{8}"
                                inputmode="numeric"
                            >
                            <div class="form__error" id="error-telefono" aria-live="polite"></div>
                        </div>
                    </div>
                    
                    <div class="form__group">
                        <label for="provincia" class="form__label">Provincia <span aria-hidden="true">*</span></label>
                        <select id="provincia" name="provincia" class="form__select" required aria-describedby="error-provincia">
                            <option value="">Seleccione provincia</option>
                            <option value="San José">San José</option>
                            <option value="Alajuela">Alajuela</option>
                            <option value="Cartago">Cartago</option>
                            <option value="Heredia">Heredia</option>
                            <option value="Guanacaste">Guanacaste</option>
                            <option value="Puntarenas">Puntarenas</option>
                            <option value="Limón">Limón</option>
                        </select>
                        <div class="form__error" id="error-provincia" aria-live="polite"></div>
                    </div>
                    
                    <div class="form__group">
                        <label for="canton" class="form__label">Cantón / Distrito <span aria-hidden="true">*</span></label>
                        <input 
                            type="text" 
                            id="canton" 
                            name="canton" 
                            class="form__input" 
                            placeholder="Ej: San José, Carmen"
                            required
                            autocomplete="address-level2"
                            aria-describedby="error-canton"
                            maxlength="100"
                        >
                        <div class="form__error" id="error-canton" aria-live="polite"></div>
                    </div>
                </fieldset>
                
                <!-- SECCIÓN 3: TIPO DE PARTICIPACIÓN -->
                <fieldset class="form__section">
                    <legend class="form__section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Tipo de Participación
                    </legend>
                    
                    <div class="form__group">
                        <label class="form__label">¿Cómo quieres participar? <span aria-hidden="true">*</span></label>
                        <div class="radio-group" role="radiogroup" aria-label="Tipo de participación">
                            <label class="radio-option">
                                <input type="radio" name="tipoParticipacion" value="voluntariado" id="tipo-voluntariado" <?= $tipoPredefinido === 'voluntariado' ? 'checked' : '' ?> required>
                                <span class="radio-custom"></span>
                                <span class="radio-label">
                                    <strong>Voluntariado</strong> - Participar en actividades de campo (reforestación, limpiezas, etc.)
                                </span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="tipoParticipacion" value="donacion" id="tipo-donacion" <?= $tipoPredefinido === 'donacion' ? 'checked' : '' ?>>
                                <span class="radio-custom"></span>
                                <span class="radio-label">
                                    <strong>Donación</strong> - Aporte económico para viveros, logística, educación
                                </span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="tipoParticipacion" value="campañas" id="tipo-campañas" <?= $tipoPredefinido === 'campañas' ? 'checked' : '' ?>>
                                <span class="radio-custom"></span>
                                <span class="radio-label">
                                    <strong>Participación en campañas</strong> - Unirme a eventos específicos programados
                                </span>
                            </label>
                        </div>
                        <div class="form__error" id="error-tipoParticipacion" aria-live="polite"></div>
                    </div>
                    
                    <!-- CAMPO CONDICIONAL: SERVICIO DE INTERÉS (solo voluntariado/campañas) -->
                    <div class="form__group" id="grupo-servicio" style="display: none;">
                        <label for="servicioInteresSelect" class="form__label">Actividad de interés <span aria-hidden="true">*</span></label>
                        <select id="servicioInteresSelect" name="servicioInteresSelect" class="form__select" aria-describedby="error-servicioInteresSelect">
                            <option value="">Seleccione una actividad</option>
                            <option value="reforestacion" <?= $servicioPredefinido === 'reforestacion' ? 'selected' : '' ?>>Reforestación</option>
                            <option value="limpieza-rios" <?= $servicioPredefinido === 'limpieza-rios' ? 'selected' : '' ?>>Limpieza de Ríos</option>
                            <option value="educacion-ambiental" <?= $servicioPredefinido === 'educacion-ambiental' ? 'selected' : '' ?>>Educación Ambiental</option>
                            <option value="reciclaje-comunitario" <?= $servicioPredefinido === 'reciclaje-comunitario' ? 'selected' : '' ?>>Reciclaje Comunitario</option>
                        </select>
                        <div class="form__error" id="error-servicioInteresSelect" aria-live="polite"></div>
                    </div>
                    
                    <!-- CAMPO CONDICIONAL: MONTO DONACIÓN (solo donacion) -->
                    <div class="form__group" id="grupo-donacion" style="display: none;">
                        <label for="montoDonacion" class="form__label">Monto de donación (₡) <span aria-hidden="true">*</span></label>
                        <input 
                            type="number" 
                            id="montoDonacion" 
                            name="montoDonacion" 
                            class="form__input" 
                            placeholder="10000"
                            min="1000"
                            max="10000000"
                            step="1000"
                            aria-describedby="error-montoDonacion"
                            inputmode="numeric"
                        >
                        <div class="form__error" id="error-montoDonacion" aria-live="polite"></div>
                        <small class="form__hint">Mínimo ₡1,000 - Máximo ₡10,000,000</small>
                    </div>
                </fieldset>
                
                <!-- SECCIÓN 4: DISPONIBILIDAD Y EXPERIENCIA -->
                <fieldset class="form__section">
                    <legend class="form__section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        Disponibilidad y Experiencia
                    </legend>
                    
                    <div class="form__group">
                        <label for="disponibilidad" class="form__label">Disponibilidad horaria <span aria-hidden="true">*</span></label>
                        <select id="disponibilidad" name="disponibilidad" class="form__select" required aria-describedby="error-disponibilidad">
                            <option value="">Seleccione disponibilidad</option>
                            <option value="fines-semana">Fines de semana (sábados/domingos)</option>
                            <option value="entre-semana">Entre semana (lunes a viernes)</option>
                            <option value="ambos">Cualquier día</option>
                            <option value="eventual">Solo eventos puntuales</option>
                        </select>
                        <div class="form__error" id="error-disponibilidad" aria-live="polite"></div>
                    </div>
                    
                    <div class="form__group">
                        <label for="experiencia" class="form__label">Experiencia previa (opcional)</label>
                        <textarea 
                            id="experiencia" 
                            name="experiencia" 
                            class="form__textarea" 
                            placeholder="Cuéntanos si tienes experiencia en voluntariado, trabajo ambiental, primeros auxilios, etc."
                            maxlength="1000"
                            rows="4"
                        ></textarea>
                        <div class="form__hint" style="font-size: var(--font-size-xs); color: var(--color-gray-500); margin-top: var(--spacing-xs);">
                            <span id="charCountExperiencia" style="float: right;">0/1000</span>
                        </div>
                    </div>
                    
                    <div class="form__group">
                        <label for="habilidades" class="form__label">Habilidades / Conocimientos (opcional)</label>
                        <textarea 
                            id="habilidades" 
                            name="habilidades" 
                            class="form__textarea" 
                            placeholder="Ej: Conducción 4x4, primeros auxilios, biología, carpintería, fotografía, redes sociales, etc."
                            maxlength="1000"
                            rows="3"
                        ></textarea>
                        <div class="form__hint" style="font-size: var(--font-size-xs); color: var(--color-gray-500); margin-top: var(--spacing-xs);">
                            <span id="charCountHabilidades" style="float: right;">0/1000</span>
                        </div>
                    </div>
                </fieldset>
                
                <!-- SECCIÓN 5: CONTACTO DE EMERGENCIA -->
                <fieldset class="form__section">
                    <legend class="form__section-title">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        Contacto de Emergencia (Obligatorio para voluntariado)
                    </legend>
                    
                    <div class="form__row">
                        <div class="form__group">
                            <label for="emergenciaNombre" class="form__label">Nombre completo <span aria-hidden="true">*</span></label>
                            <input 
                                type="text" 
                                id="emergenciaNombre" 
                                name="emergenciaNombre" 
                                class="form__input" 
                                placeholder="María González"
                                required
                                autocomplete="off"
                                aria-describedby="error-emergenciaNombre"
                                maxlength="100"
                                pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+"
                            >
                            <div class="form__error" id="error-emergenciaNombre" aria-live="polite"></div>
                        </div>
                        
                        <div class="form__group">
                            <label for="emergenciaTelefono" class="form__label">Teléfono (8 dígitos) <span aria-hidden="true">*</span></label>
                            <input 
                                type="tel" 
                                id="emergenciaTelefono" 
                                name="emergenciaTelefono" 
                                class="form__input" 
                                placeholder="22223333"
                                required
                                autocomplete="off"
                                aria-describedby="error-emergenciaTelefono"
                                maxlength="8"
                                pattern="\d{8}"
                                inputmode="numeric"
                            >
                            <div class="form__error" id="error-emergenciaTelefono" aria-live="polite"></div>
                        </div>
                    </div>
                    
                    <div class="form__group">
                        <label for="emergenciaRelacion" class="form__label">Relación <span aria-hidden="true">*</span></label>
                        <select id="emergenciaRelacion" name="emergenciaRelacion" class="form__select" required aria-describedby="error-emergenciaRelacion">
                            <option value="">Seleccione relación</option>
                            <option value="familiar">Familiar</option>
                            <option value="amigo">Amigo/a</option>
                            <option value="pareja">Pareja</option>
                            <option value="otro">Otro</option>
                        </select>
                        <div class="form__error" id="error-emergenciaRelacion" aria-live="polite"></div>
                    </div>
                </fieldset>
                
                <!-- TÉRMINOS Y CONDICIONES -->
                <div class="form__group form__group--checkbox">
                    <input 
                        type="checkbox" 
                        id="terminos" 
                        name="terminos" 
                        class="form__checkbox" 
                        required
                        aria-describedby="error-terminos"
                    >
                    <label for="terminos" class="form__checkbox-label">
                        Acepto los <a href="#" class="form__link">Términos y Condiciones</a> y la <a href="#" class="form__link">Política de Privacidad</a> de ECOACCIÓN COSTA RICA. Autorizo el tratamiento de mis datos personales para fines de coordinación de actividades ambientales. <span aria-hidden="true">*</span>
                    </label>
                    <div class="form__error" id="error-terminos" aria-live="polite"></div>
                </div>
                
                <div class="form__group form__group--checkbox">
                    <input 
                        type="checkbox" 
                        id="comunicaciones" 
                        name="comunicaciones" 
                        class="form__checkbox"
                    >
                    <label for="comunicaciones" class="form__checkbox-label">
                        Deseo recibir información sobre futuras campañas, noticias y eventos de ECOACCIÓN COSTA RICA por correo electrónico.
                    </label>
                </div>
                
                <!-- BOTÓN ENVIAR -->
                <button type="submit" class="btn btn--primary form__submit" style="width: 100%; margin-top: var(--spacing-lg);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" style="margin-right: var(--spacing-sm);">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    Enviar Inscripción
                </button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

<!-- Estilos específicos para esta página -->
<style>
.form__section {
    background: var(--color-light);
    border-radius: var(--border-radius-lg);
    padding: var(--spacing-xl);
    margin-bottom: var(--spacing-xl);
    border: 1px solid var(--color-gray-200);
}

.form__section-title {
    display: flex;
    align-items: center;
    gap: var(--spacing-sm);
    font-size: var(--font-size-lg);
    font-weight: 600;
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
    padding-bottom: var(--spacing-md);
    border-bottom: 2px solid var(--color-primary);
}

.form__section-title svg {
    flex-shrink: 0;
    color: var(--color-primary);
}

.form__row {
    display: grid;
    grid-template-columns: 1fr;
    gap: var(--spacing-lg);
}

@media (min-width: 701px) {
    .form__row {
        grid-template-columns: 1fr 1fr;
    }
}

.radio-group {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-md);
}

.radio-option {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    padding: var(--spacing-md);
    border: 2px solid var(--color-gray-200);
    border-radius: var(--border-radius-md);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.radio-option:hover {
    border-color: var(--color-primary-light);
    background: rgba(45, 106, 79, 0.05);
}

.radio-option input[type="radio"] {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.radio-custom {
    width: 22px;
    height: 22px;
    border: 2px solid var(--color-gray-300);
    border-radius: 50%;
    position: relative;
    flex-shrink: 0;
    margin-top: 2px;
    transition: all var(--transition-fast);
}

.radio-option input:checked + .radio-custom {
    border-color: var(--color-primary);
    background: var(--color-primary);
}

.radio-option input:checked + .radio-custom::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 8px;
    height: 8px;
    background: var(--color-white);
    border-radius: 50%;
}

.radio-label {
    font-size: var(--font-size-base);
    line-height: 1.5;
    color: var(--color-gray-700);
}

.radio-label strong {
    display: block;
    margin-bottom: var(--spacing-xs);
    color: var(--color-gray-900);
}

.form__group--checkbox {
    margin-top: var(--spacing-lg);
}

.form__checkbox {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.form__checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: var(--spacing-md);
    cursor: pointer;
    font-size: var(--font-size-sm);
    line-height: 1.6;
    color: var(--color-gray-700);
}

.form__checkbox-label::before {
    content: '';
    width: 22px;
    height: 22px;
    border: 2px solid var(--color-gray-300);
    border-radius: var(--border-radius-sm);
    flex-shrink: 0;
    margin-top: 2px;
    transition: all var(--transition-fast);
    background: var(--color-white);
}

.form__checkbox:checked + .form__checkbox-label::before {
    border-color: var(--color-primary);
    background: var(--color-primary) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E") center / 14px no-repeat;
}

.form__checkbox:focus-visible + .form__checkbox-label::before {
    outline: 2px solid var(--color-primary);
    outline-offset: 2px;
}

.form__link {
    color: var(--color-primary);
    text-decoration: underline;
}

.form__link:hover {
    color: var(--color-primary-dark);
}

.form__hint {
    display: block;
    margin-top: var(--spacing-xs);
    font-size: var(--font-size-xs);
    color: var(--color-gray-500);
}
</style>

<!-- Script para validaciones y campos condicionales -->
<script>
(function() {
    'use strict';
    
    const form = document.getElementById('inscripcionForm');
    if (!form) return;
    
    // ========================================
    // CAMPOS CONDICIONALES SEGÚN TIPO PARTICIPACIÓN
    // ========================================
    
    const tipoRadios = form.querySelectorAll('input[name="tipoParticipacion"]');
    const grupoServicio = document.getElementById('grupo-servicio');
    const grupoDonacion = document.getElementById('grupo-donacion');
    const servicioSelect = document.getElementById('servicioInteresSelect');
    const montoDonacion = document.getElementById('montoDonacion');
    
    function toggleConditionalFields() {
        const tipo = form.querySelector('input[name="tipoParticipacion"]:checked')?.value;
        
        // Ocultar todos
        grupoServicio.style.display = 'none';
        servicioSelect.required = false;
        servicioSelect.removeAttribute('aria-required');
        
        grupoDonacion.style.display = 'none';
        montoDonacion.required = false;
        montoDonacion.removeAttribute('aria-required');
        
        // Mostrar según tipo
        if (tipo === 'voluntariado' || tipo === 'campañas') {
            grupoServicio.style.display = 'block';
            servicioSelect.required = true;
            servicioSelect.setAttribute('aria-required', 'true');
        } else if (tipo === 'donacion') {
            grupoDonacion.style.display = 'block';
            montoDonacion.required = true;
            montoDonacion.setAttribute('aria-required', 'true');
        }
    }
    
    tipoRadios.forEach(radio => {
        radio.addEventListener('change', toggleConditionalFields);
    });
    
    // Inicializar
    toggleConditionalFields();
    
    // ========================================
    // CONTADORES DE CARACTERES
    // ========================================
    
    function setupCharCounter(textareaId, counterId, maxLength) {
        const textarea = document.getElementById(textareaId);
        const counter = document.getElementById(counterId);
        if (!textarea || !counter) return;
        
        function update() {
            const len = textarea.value.length;
            counter.textContent = `${len}/${maxLength}`;
            counter.style.color = len > maxLength * 0.9 ? 'var(--color-warning)' : 'var(--color-gray-500)';
        }
        textarea.addEventListener('input', update);
        update();
    }
    
    setupCharCounter('experiencia', 'charCountExperiencia', 1000);
    setupCharCounter('habilidades', 'charCountHabilidades', 1000);
    
    // ========================================
    // VALIDACIONES
    // ========================================
    
    const VALIDATION_RULES = {
        nombre: { required: true, minLength: 2, maxLength: 50, pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/, messages: { required: 'El nombre es obligatorio', minLength: 'Mínimo 2 caracteres', maxLength: 'Máximo 50 caracteres', pattern: 'Solo letras y espacios' }},
        apellidos: { required: true, minLength: 2, maxLength: 100, pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/, messages: { required: 'Los apellidos son obligatorios', minLength: 'Mínimo 2 caracteres', maxLength: 'Máximo 100 caracteres', pattern: 'Solo letras y espacios' }},
        cedula: { required: true, minLength: 5, maxLength: 20, pattern: /^[\d\-]+$/, messages: { required: 'La cédula es obligatoria', minLength: 'Muy corto', maxLength: 'Máximo 20 caracteres', pattern: 'Solo números y guiones' }},
        fechaNacimiento: { required: true, messages: { required: 'La fecha de nacimiento es obligatoria' }},
        correo: { required: true, pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/, messages: { required: 'El correo es obligatorio', pattern: 'Correo inválido' }},
        telefono: { required: true, pattern: /^\d{8}$/, messages: { required: 'El teléfono es obligatorio', pattern: 'Exactamente 8 dígitos' }},
        provincia: { required: true, messages: { required: 'Seleccione una provincia' }},
        canton: { required: true, minLength: 2, messages: { required: 'El cantón es obligatorio', minLength: 'Mínimo 2 caracteres' }},
        tipoParticipacion: { required: true, messages: { required: 'Seleccione un tipo de participación' }},
        servicioInteresSelect: { messages: { required: 'Seleccione una actividad' }},
        montoDonacion: { messages: { required: 'Ingrese el monto' }},
        disponibilidad: { required: true, messages: { required: 'Seleccione disponibilidad' }},
        emergenciaNombre: { required: true, minLength: 2, pattern: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/, messages: { required: 'Nombre de emergencia obligatorio', minLength: 'Mínimo 2 caracteres', pattern: 'Solo letras y espacios' }},
        emergenciaTelefono: { required: true, pattern: /^\d{8}$/, messages: { required: 'Teléfono de emergencia obligatorio', pattern: 'Exactamente 8 dígitos' }},
        emergenciaRelacion: { required: true, messages: { required: 'Seleccione relación' }},
        terminos: { required: true, messages: { required: 'Debe aceptar términos y condiciones' }}
    };
    
    function getFieldGroup(field) {
        return field.closest('.form__group');
    }
    
    function getErrorElement(group) {
        return group?.querySelector('.form__error');
    }
    
    function showFieldError(field, message) {
        const group = getFieldGroup(field);
        if (!group) return;
        group.classList.add('form__group--error');
        const errorEl = getErrorElement(group);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.setAttribute('role', 'alert');
        }
        field.setAttribute('aria-invalid', 'true');
    }
    
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
    }
    
    function validateField(field) {
        const name = field.name;
        const rules = VALIDATION_RULES[name];
        if (!rules) return true;
        
        const value = field.type === 'checkbox' ? field.checked : field.value.trim();
        
        // Radio group validation
        if (field.type === 'radio') {
            const checked = form.querySelector(`input[name="${name}"]:checked`);
            if (rules.required && !checked) {
                const group = field.closest('.radio-group') || getFieldGroup(field);
                if (group) {
                    group.classList.add('form__group--error');
                    const errorEl = group.querySelector('.form__error') || form.querySelector(`#error-${name}`);
                    if (errorEl) {
                        errorEl.textContent = rules.messages.required;
                        errorEl.setAttribute('role', 'alert');
                    }
                }
                return false;
            } else {
                const group = field.closest('.radio-group') || getFieldGroup(field);
                if (group) {
                    group.classList.remove('form__group--error');
                    const errorEl = group.querySelector('.form__error') || form.querySelector(`#error-${name}`);
                    if (errorEl) errorEl.textContent = '';
                }
                return true;
            }
        }
        
        // Checkbox validation
        if (field.type === 'checkbox') {
            if (rules.required && !field.checked) {
                showFieldError(field, rules.messages.required);
                return false;
            }
            clearFieldError(field);
            return true;
        }
        
        // Required
        if (rules.required && !value) {
            showFieldError(field, rules.messages.required);
            return false;
        }
        
        if (!rules.required && !value) {
            clearFieldError(field);
            return true;
        }
        
        // Min length
        if (rules.minLength && value.length < rules.minLength) {
            showFieldError(field, rules.messages.minLength);
            return false;
        }
        
        // Max length
        if (rules.maxLength && value.length > rules.maxLength) {
            showFieldError(field, rules.messages.maxLength);
            return false;
        }
        
        // Pattern
        if (rules.pattern && !rules.pattern.test(value)) {
            showFieldError(field, rules.messages.pattern);
            return false;
        }
        
        // Fecha nacimiento - validar edad mínima 13 años
        if (name === 'fechaNacimiento' && value) {
            const birth = new Date(value);
            const today = new Date();
            const age = today.getFullYear() - birth.getFullYear();
            const m = today.getMonth() - birth.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birth.getDate())) age--;
            if (age < 13) {
                showFieldError(field, 'Debe ser mayor de 13 años');
                return false;
            }
        }
        
        // Monto donación
        if (name === 'montoDonacion' && value) {
            const num = parseInt(value, 10);
            if (num < 1000 || num > 10000000) {
                showFieldError(field, 'Monto entre ₡1,000 y ₡10,000,000');
                return false;
            }
        }
        
        clearFieldError(field);
        return true;
    }
    
    function validateForm() {
        const fields = form.querySelectorAll('input[required], textarea[required], select[required]');
        let isValid = true;
        let firstInvalid = null;
        
        // Validar radios por grupo
        const radioGroups = new Set();
        form.querySelectorAll('input[type="radio"][required]').forEach(r => radioGroups.add(r.name));
        radioGroups.forEach(name => {
            const checked = form.querySelector(`input[name="${name}"]:checked`);
            const rules = VALIDATION_RULES[name];
            if (rules?.required && !checked) {
                isValid = false;
                const firstRadio = form.querySelector(`input[name="${name}"]`);
                if (firstRadio && !firstInvalid) firstInvalid = firstRadio;
            }
        });
        
        // Validar campos normales
        fields.forEach(field => {
            if (field.type !== 'radio') {
                if (!validateField(field)) {
                    isValid = false;
                    if (!firstInvalid) firstInvalid = field;
                }
            }
        });
        
        if (firstInvalid) {
            firstInvalid.focus();
            firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        return isValid;
    }
    
    // Event listeners
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (validateForm()) {
            form.submit();
        }
    });
    
    form.addEventListener('blur', (e) => {
        if (e.target.matches('input, textarea, select')) {
            validateField(e.target);
        }
    }, true);
    
    form.addEventListener('input', (e) => {
        if (e.target.matches('input, textarea, select')) {
            const group = getFieldGroup(e.target);
            if (group && group.classList.contains('form__group--error')) {
                validateField(e.target);
            }
        }
    }, true);
    
    // Validar radios al cambiar
    tipoRadios.forEach(r => r.addEventListener('change', () => validateField(r)));
    
    console.log('Inscripcion.js: Formulario inicializado ✓');
})();
</script>