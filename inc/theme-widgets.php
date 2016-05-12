<?php
/**
 * Include widgets files
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version 1.0
 */
foreach ( glob( dirname( __FILE__ ) . '/widgets/*.php' ) as $file ) {
    locate_template( $file, true );
}

?>