<?php
/**
 * imagenes.php - Configuración centralizada de imágenes
 * 
 * NOMBRES ESPECÍFICOS QUE DEBEN COINCIDIR CON ARCHIVOS EN CARPETA img/
 * Coloca tus archivos en img/ con estos nombres exactos:
 * 
 * Uso: 
 *   $IMAGENES = include 'includes/imagenes.php';
 *   echo $IMAGENES['hero_index'];  // devuelve 'img/hero-index.jpg'
 * 
 *   En JS: window.IMAGENES_CONFIG['servicio_reforestacion']
 */

return [
    // ========================================
    // HERO / FONDOS PRINCIPALES
    // ========================================
    'hero_index'        => 'img/hero-index.jpg',
    'hero_nosotros'     => 'img/hero-nosotros.jpg',
    'hero_servicios'    => 'img/hero-servicios.jpg',
    'hero_contacto'     => 'img/hero-contacto.jpg',
    'hero_inscripcion'  => 'img/hero-inscripcion.jpg',
    
    // ========================================
    // CARRUSEL INDEX.PHP (5 slides)
    // ========================================
    'carousel_1'        => 'img/carousel-1-reforestacion.jpg',
    'carousel_2'        => 'img/carousel-2-limpieza-rios.jpg',
    'carousel_3'        => 'img/carousel-3-educacion.jpg',
    'carousel_4'        => 'img/carousel-4-reciclaje.jpg',
    'carousel_5'        => 'img/carousel-5-voluntariado.jpg',
    
    // Textos alternativos para accesibilidad
    'carousel_1_alt'    => 'Voluntarios plantando árboles nativos en zona de reforestación',
    'carousel_2_alt'    => 'Grupo de voluntarios limpiando residuos de un río costarricense',
    'carousel_3_alt'    => 'Niños participando en taller de educación ambiental al aire libre',
    'carousel_4_alt'    => 'Centro de reciclaje comunitario organizado con materiales separados',
    'carousel_5_alt'    => 'Grupo diverso de voluntarios trabajando juntos en proyecto ambiental',
    
    // Captions del carrusel
    'carousel_1_title'  => 'Reforestación en Acción',
    'carousel_1_text'   => 'Más de 5,000 árboles nativos sembrados en zonas protegidas',
    'carousel_2_title'  => 'Limpieza de Ríos',
    'carousel_2_text'   => 'Recuperando la salud de nuestras cuencas hidrográficas',
    'carousel_3_title'  => 'Educación Ambiental',
    'carousel_3_text'   => 'Formando a las nuevas generaciones en cuidado del planeta',
    'carousel_4_title'  => 'Reciclaje Comunitario',
    'carousel_4_text'   => 'Economía circular en acción en 12 comunidades',
    'carousel_5_title'  => 'Voluntariado Unido',
    'carousel_5_text'   => '300+ voluntarios comprometidos con la causa',
    
    // ========================================
    // SERVICIOS (6 cards) - cards.js
    // ========================================
    'servicio_reforestacion'       => 'img/servicio-reforestacion.jpg',
    'servicio_limpieza_rios'       => 'img/servicio-limpieza-rios.jpg',
    'servicio_educacion_ambiental' => 'img/servicio-educacion-ambiental.jpg',
    'servicio_reciclaje_comunitario'=> 'img/servicio-reciclaje-comunitario.jpg',
    'servicio_voluntariado'        => 'img/servicio-voluntariado.jpg',
    'servicio_donaciones'          => 'img/servicio-donaciones.jpg',
    
    // Alts de servicios
    'servicio_reforestacion_alt'       => 'Voluntarios plantando árboles en zona reforestada',
    'servicio_limpieza_rios_alt'       => 'Grupo limpiando río costarricense',
    'servicio_educacion_ambiental_alt' => 'Taller de educación ambiental con niños',
    'servicio_reciclaje_comunitario_alt'=> 'Centro de reciclaje comunitario organizado',
    'servicio_voluntariado_alt'        => 'Grupo de voluntarios trabajando juntos',
    'servicio_donaciones_alt'          => 'Manos entregando donación simbólica',
    
    // ========================================
    // LOGOS E ICONOS
    // ========================================
    'logo_principal'   => 'img/logo-principal.png',
    'logo_footer'      => 'img/logo-footer.png',
    'favicon'          => 'img/favicon.ico',
    
    // ========================================
    // PLACEHOLDERS AUTOMÁTICOS (fallback si no existe archivo)
    // ========================================
    'placeholder'           => 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=ECOACCI%C3%93N',
    'placeholder_square'    => 'https://via.placeholder.com/400x400/2d6a4f/ffffff?text=ECOACCI%C3%93N',
    'placeholder_hero'      => 'https://via.placeholder.com/1920x800/2d6a4f/ffffff?text=ECOACCI%C3%93N+COSTA+RICA',
    'placeholder_carousel'  => 'https://via.placeholder.com/1200x550/2d6a4f/ffffff?text=ECOACCI%C3%93N',
    'placeholder_card'      => 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=ECOACCI%C3%93N',
    'placeholder_servicio'  => 'https://via.placeholder.com/600x400/2d6a4f/ffffff?text=SERVICIO',
];

// ========================================
// FUNCIONES HELPER
// ========================================

/**
 * Obtiene URL de imagen con fallback automático a placeholder
 * Verifica si el archivo local existe en img/, si no usa placeholder
 * @param array $imagenes - Array de configuración
 * @param string $key - Clave de la imagen
 * @return string URL
 */
function img_url($imagenes, $key) {
    $localPath = $imagenes[$key] ?? '';
    
    // Si es ruta local (empieza con img/), verificar si existe
    if (str_starts_with($localPath, 'img/')) {
        $fullPath = __DIR__ . '/../' . $localPath;
        if (file_exists($fullPath)) {
            return $localPath;
        }
        // Si no existe, usar placeholder correspondiente
        $placeholderKey = 'placeholder_' . str_replace(['servicio_', 'hero_', 'carousel_'], '', $key);
        return $imagenes[$placeholderKey] ?? $imagenes['placeholder'];
    }
    
    return $localPath ?: $imagenes['placeholder'];
}

/**
 * Genera tag <img> completo con fallback y lazy loading
 * @param array $imagenes
 * @param string $key
 * @param string $alt
 * @param string $class
 * @return string HTML img tag
 */
function img_tag($imagenes, $key, $alt = '', $class = '') {
    $src = img_url($imagenes, $key);
    $altText = $alt ?: ($imagenes[$key . '_alt'] ?? 'Imagen ECOACCIÓN Costa Rica');
    $classAttr = $class ? ' class="' . $class . '"' : '';
    return '<img src="' . $src . '" alt="' . $altText . '"' . $classAttr . ' loading="lazy">';
}