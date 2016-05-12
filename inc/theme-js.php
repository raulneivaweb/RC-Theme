<?php
/**
 * Registro de javascript
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 * @return mixed Registra javascript no front-end do site
 */
function nexo_javascripts_assets() {
    // hoverintent
    wp_enqueue_script('hoverIntent', null, array('jquery'), null, true);

    // superfish
    wp_enqueue_script('superfish', NEXO_THEME_DIR . 'inc/plugins/superfish/superfish.min.js', array('jquery'), null, true);

    // main
    $ver_js = filemtime(get_template_directory() . '/inc/js/main.js');
    wp_enqueue_script( 'main', NEXO_THEME_DIR . 'inc/js/main.js', array('jquery'), $ver_js, true );
}
add_action('wp_enqueue_scripts', 'nexo_javascripts_assets', 100);
?>