<?php
/**
 * Registro de CSS
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 * @return mixed Mostra css no front-end do site
 */
function nexo_styles_assets() {
    // Fontawesome
    wp_enqueue_style( 'fontawesome', NEXO_THEME_DIR . 'assets/fonts/fontawesome/css/font-awesome.min.css' );

    // Style Geral
    $ver = filemtime(get_template_directory() . '/style.css');
    wp_enqueue_style('style', NEXO_THEME_DIR . 'style.css', false, $ver, null);
}
add_action('wp_enqueue_scripts', 'nexo_styles_assets', 100);
?>