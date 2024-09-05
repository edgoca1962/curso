<?php


/**
 * Functions Theme
 * 
 * @package MYDOMANIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

if (!defined('MYDOMAIN_DIR_PATH')) {
   define('MYDOMAIN_DIR_PATH', untrailingslashit(get_template_directory()));
}
if (!defined('MYDOMAIN_DIR_STYLE')) {
   define('MYDOMAIN_DIR_STYLE', untrailingslashit(get_stylesheet_uri()));
}
if (!defined('MYDOMAIN_DIR_URI')) {
   define('MYDOMAIN_DIR_URI', untrailingslashit(get_template_directory_uri()));
}
if (!defined('MYDOMAIN_POST_THUMBNAIL_URI')) {
   define('MYDOMAIN_POST_THUMBNAIL_URI', untrailingslashit(get_the_post_thumbnail_url()));
}
if (!defined('MYDOMAIN_MODULOS')) {
   define('MYDOMAIN_MODULOS', []);
}
if (!defined('MYDOMAIN_CPT_MODULO')) {
   define('MYDOMAIN_CPT_MODULO', []);
}

require_once MYDOMAIN_DIR_PATH . '/modules/core/autoloader.php';

if (!function_exists('MYDOMAIN_get_theme_instance')) {
   function MYDOMAIN_get_theme_instance()
   {
      CoreController::get_instance();
   }
   MYDOMAIN_get_theme_instance();
}
