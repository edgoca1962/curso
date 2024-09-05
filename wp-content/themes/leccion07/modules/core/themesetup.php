<?php

namespace MYDOMAIN\Modules\Core;

use MYDOMAIN\Modules\Core\Singleton;

/**
 * 
 * clase configuración WP theme.
 * @package: MYDOMAIN
 * 
 */


class ThemeSetup
{
   use Singleton;
   private function __construct()
   {
      add_action('after_setup_theme', [$this, 'MYDOMAIN_theme_functionality']);
      add_action('wp_enqueue_scripts', [$this, 'MYDOMAIN_register_scripts_styles']);
   }
   public function MYDOMAIN_theme_functionality()
   {
      load_theme_textdomain('MYDOMAIN', get_template_directory() . '/languages');
      add_theme_support('title-tag');
      add_theme_support('automatic-feed-links');
      add_theme_support('post-thumbnails');
      add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));
      add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
      add_theme_support('customize-selective-refresh-widgets');
      add_theme_support('wp-block-styles');
      add_theme_support('block-templates');
      add_theme_support('align-wide');
      add_theme_support('custom-logo', array('height' => 300, 'width' => 300, 'flex-width' => true, 'flex-height' => true,));
      register_nav_menus(
         array(
            'principal' => __('Menu Principal', 'MYDOMAIN'),
            'administrador' => __('Menu Administrador', 'MYDOMAIN'),
         )
      );
      global $content_width;
      if (!isset($content_width)) {
         $content_width = 1240;
      }
      add_role('useradmingeneral', 'Administrador(a) General', get_role('subscriber')->capabilities);
   }
   public function MYDOMAIN_register_scripts_styles()
   {
      wp_enqueue_style('styles', MYDOMAIN_DIR_STYLE, array(), microtime(), 'all');
      wp_enqueue_script('scripts', MYDOMAIN_DIR_URI . '/assets/main.js', array('jquery'), null, true);
   }
}
