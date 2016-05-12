<?php
/**
 * Register of plugins vendor here, css and javascript files to showing on front-end
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 */
function nexo_plugins() {
    // superfish
    wp_enqueue_script('superfish', NEXO_THEME_DIR . 'inc/plugins/superfish/superfish.min.js', array('jquery'), null, true);
}

add_action( 'wp_enqueue_scripts', 'nexo_plugins' );
?>