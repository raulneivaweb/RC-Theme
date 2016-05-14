<?php
/**
 * Functions Package Nexo Themes
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 */


/* ==========================================================================
    Init Core Essentials files to theme
    ========================================================================== */
require_once ( get_template_directory() . '/core/core-init.php' );




/* ==========================================================================
    Load files to theme
    ========================================================================== */
$includes = array(
    // Theme functions
    'inc/theme-functions.php',

    // Theme Cpts
    'inc/theme-cpt.php',

    // Comments
    'inc/theme-comments.php',

    // Widgets
    'inc/theme-widgets.php',

    // Plugins included
    'inc/theme-plugins.php',

    // Assets Javavascript and CSS front-end
    'inc/theme-css.php',
    'inc/theme-js.php',
);


foreach ( $includes as $i ) {
    locate_template( $i, true );
}




/*-----------------------------------------------------------------------------------*/
/* Você pode adicionar funções personalizadas a partir daqui*/
/*-----------------------------------------------------------------------------------*/








/*-----------------------------------------------------------------------------------*/
/* Não adicione nenhum código depois daqui ou o céu vai cair :D */
/*-----------------------------------------------------------------------------------*/
?>
