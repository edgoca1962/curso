<?php

namespace MYDOMAIN\Modules\Core;

use MYDOMAIN\Modules\Post\PostController;

/**
 * 
 * Clase Core
 * 
 * @package MYDOMANIN
 * 
 */

class CoreController
{
   use Singleton;
   private $atributos;
   private function __construct()
   {
      require_once MYDOMAIN_DIR_PATH . "/modules/core/walker.php";

      $this->atributos = [];
      ThemeSetup::get_instance();
      $this->set_paginas();
   }
   public function set_atributo($parametro, $valor)
   {
      $this->atributos[$parametro] = $valor;
   }
   public function get_atributo($parametro)
   {
      return $this->atributos[$parametro];
   }
   public function get_datos()
   {
      $postType = get_post_type();
      if (isset($_GET['cpt'])) {
         $postType = sanitize_text_field($_GET['cpt']);
      } else {
         if (get_post_type() == 'page') {
            $PrefijoPage = substr(get_post(get_the_ID())->post_name, 0, strpos(get_post(get_the_ID())->post_name, '-'));
            if (isset(MYDOMAIN_CPT_MODULO[$PrefijoPage])) {
               $postType = $PrefijoPage;
            }
         }
      }

      $datos['post_type'] = $postType;

      $datos['bg-html'] = 'bg-dark';
      $datos['body-style'] = '';
      $datos['body'] = 'bg-dark bg-gradient text-white';
      $datos['banner'] = 'modules/core/view/core-banner';
      $datos['navbar'] = 'modules/core/view/core-navbar';
      $datos['section'] = '';
      $datos['section-style'] = '';
      $datos['div1'] = 'container';
      $datos['div2'] = 'row';
      $datos['div3'] = 'col-12 col-xl-3';
      $datos['sidebarlefttemplate'] = 'modules/core/view/core-sidebarleft';
      $datos['div4'] = 'col-12 col-xl-6';
      $datos['div5'] = '';
      $datos['div6'] = '';
      $datos['div7'] = '';
      $datos['templatepart'] = (is_page()) ? 'modules/core/view/' . get_post(get_the_ID())->post_name : '';
      $datos['comentarios'] = true;
      $datos['navegacion'] = true;
      $datos['templatepartnone'] = 'modules/core/view/core-templatepartnone';
      $datos['div8'] = 'col-12 col-xl-3';
      $datos['sidebarrighttemplate'] = 'modules/core/view/core-sidebarright';
      $datos['footerclass'] = 'container pt-5';
      $datos['footertemplate'] = 'modules/core/view/core-footer';

      $datos['pag'] = $this->get_pags()['pag'];
      $datos['pag_ant'] = $this->get_pags()['pag_ant'];
      $datos['imagen'] = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/bg.jpg';
      $datos['height'] = '60dvh';
      $datos['fontweight'] = 'fw-lighter';
      $datos['display'] = 'display-3';
      $datos['titulo'] = get_the_title();
      $datos['displaysub'] = 'display-4';
      $datos['subtitulo'] = '';
      $datos['displaysub2'] = 'display-5';
      $datos['subtitulo2'] = '';

      $datos['redireccion'] = '/';
      $datos['logoSize'] = '50px';
      $datos['classLogo'] = 'rounded-circle';

      $atributosModulos = $this->get_datos_modulos($postType);

      $this->atributos = array_replace_recursive($datos, $atributosModulos);

      return $this->atributos;
   }
   private function get_datos_modulos($postType)
   {
      $datos = [];
      switch ($postType) {
         case 'page':
            $datos = $this->get_datos_page();
            break;

         case 'post':
            $datos = PostController::get_instance()->get_atributos();
            break;

         default:
            if (isset($_GET['cpt']) || in_array($postType, [])) {
               $titulo = 'No hay un información registrada';
            } else {
               $titulo = 'Página no existe';
               $datos['div1'] = '';
               $datos['div2'] = '';
               $datos['div3'] = '';
               $datos['div4'] = '';
               $datos['div5'] = '';
               $datos['div6'] = '';
               $datos['div7'] = '';
               $datos['div8'] = '';
            }
            $datos['navbar'] = 'modules/core/view/core-navbar';
            $datos['height'] = '100dvh';
            $datos['titulo'] = $titulo;
            $datos['sidebarlefttemplate'] = '';
            $datos['sidebarrightclass'] = '';
            $datos['sidebarrighttemplate'] = '';
            $datos['agregarpost'] = '';
            $datos['footerclass'] = '';
            $datos['footertemplate'] = '';
            break;
      }

      return $datos;
   }
   public function get_datos_page()
   {
      $datos['height'] = '60dvh';
      $datos['agregarpost'] = '';
      $datos['div6'] = 'my-5';

      if (is_front_page() || is_page('core-principal') || is_page('core-login')) {
         $datos['height'] = '100dvh';
         $datos['section'] = '';
         $datos['div1'] = '';
         $datos['div2'] = '';
         $datos['agregarpost'] = '';
         $datos['div3'] = '';
         $datos['div4'] = '';
         $datos['div5'] = '';
         $datos['div6'] = '';
         $datos['div7'] = '';
         $datos['div8'] = '';
         $datos['sidebarlefttemplate'] = '';
         // $datos['templatepart'] = '';
         $datos['sidebarrighttemplate'] = '';
         if (is_page('core-login')) {
            $datos['banner'] = '';
            $datos['navbar'] = '';
            $datos['titulo'] = '';
         }
         $datos['footerclass'] = '';
         $datos['footertemplate'] = '';
      }
      return $datos;
   }
   private function get_pags()
   {
      $pags = [];
      if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
         if (explode("/", $_SERVER['REQUEST_URI'])[3] != '') {
            if (explode("/", $_SERVER['REQUEST_URI'])[3] == 'page') {
               $pags['pag'] = 0;
            } else {
               $pags['pag'] = explode("/", $_SERVER['REQUEST_URI'])[3];
            }
         } else {
            $pags['pag'] = 0;
         }
      } else {
         $pags['pag'] = 1;
      }
      if (isset($_GET['pag'])) {
         $pags['pag_ant'] = sanitize_text_field($_GET['pag']);
         if ($pags['pag_ant'] == 0) {
            $pags['pag_ant'] = 1;
         }
      } else {
         $pags['pag_ant'] = 1;
      }
      return $pags;
   }
   private function set_paginas()
   {
      $paginas = [
         'principal' =>
         [
            'slug' => 'core-principal',
            'titulo' => 'Página Principal'
         ],
         'blog' =>
         [
            'slug' => 'blog',
            'titulo' => 'Blog'
         ],
         'cambio_clave' =>
         [
            'slug' => 'core-cambio-clave',
            'titulo' => 'Cambio de Contraseña'
         ],
         'login' =>
         [
            'slug' => 'core-login',
            'titulo' => 'Login'
         ],
      ];
      foreach ($paginas as $pagina) {
         $pags = get_posts([
            'post_type' => 'page',
            'post_status' => 'publish',
            'name' => $pagina['slug'],
         ]);
         if (count($pags) > 0) {
         } else {
            $post_data = array(
               'post_type' => 'page',
               'post_title' => $pagina['titulo'],
               'post_name' => $pagina['slug'],
               'post_status' => 'publish',
            );
            wp_insert_post($post_data);
         }
      }
   }
}
