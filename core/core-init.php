<?php
/**
 * Vars to easy call config paths and plugins core inside the theme
 *
 * @package Nexo Themes
 * @author Rhuan Carlos <rhcarlosweb@gmail.com>
 * @version: 1.0
 */

// File Security Check
if (!defined('ABSPATH')) exit;

/* ==========================================================================
	Multi language
	========================================================================== */

// function to change language via $_GET parameters
add_filter('locale', 'nexo_theme_localization');
function nexo_theme_localization($locale) {

	// change language with get value 'lang'
	if (isset($_GET['lang'])) {
		return sanitize_key($_GET['lang']);
	}

	return $locale;
}
// Load languages
load_theme_textdomain('nexothemes', get_template_directory() . '/languages');



/* ==========================================================================
	Define contants to paths of theme
	========================================================================== */

/* Paths Theme */
define('NEXO_THEME_PATH', trailingslashit(TEMPLATEPATH));
define('NEXO_THEME_DIR', trailingslashit(get_template_directory_uri()));
?>