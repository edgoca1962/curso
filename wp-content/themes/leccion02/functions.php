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
require_once MYDOMAIN_DIR_PATH . '/modules/core/autoloader.php';

if (!function_exists('MYDOMAIN_get_theme_instance')) {
   function MYDOMAIN_get_theme_instance()
   {
      CoreController::get_instance();
   }
   MYDOMAIN_get_theme_instance();
}
function MYDOMAIN_register_scripts_styles()
{
   wp_enqueue_style('styles', MYDOMAIN_DIR_STYLE, array(), microtime(), 'all');
   wp_enqueue_style('bootstrapStyles', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", array(), '5.3.3', 'all');
   wp_enqueue_style('Animate', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css", array(), '', 'all');


   wp_enqueue_script('scripts', MYDOMAIN_DIR_URI . '/assets/main.js', array('jquery'), null, true);
   wp_enqueue_script('BootstrapScripts', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js", array('jquery'), '5.3.3', true);
   wp_enqueue_script('SweetAlert2', "https://cdn.jsdelivr.net/npm/sweetalert2@11", array(), '2.11', true);
   wp_enqueue_script('FontAwesome', "https://use.fontawesome.com/releases/v5.15.4/js/all.js", array(), '5.15.4', true);
}
add_action('wp_enqueue_scripts', 'MYDOMAIN_register_scripts_styles');
