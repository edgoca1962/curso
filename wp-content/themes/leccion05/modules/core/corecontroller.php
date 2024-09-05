<?php

namespace MYDOMAIN\Modules\Core;

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
      $this->atributos = [];
      ThemeSetup::get_instance();
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
      $datos['commentsTemplate'] = '/modules/core/view/core-comments.php';
      $datos['footerclass'] = 'container pt-5';
      $datos['footertemplate'] = 'modules/core/view/core-footer';


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

         default:
            if (isset($_GET['cpt']) || in_array($postType, [])) {
               $titulo = 'No hay un información registrada';
            } else {
               $titulo = 'Página no existe';
            }
            $datos['navbar'] = 'modules/core/view/navbar';
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
      $datos['agregarpost'] = '';
      $datos['div6'] = 'my-5';

      if (is_front_page() || is_page('core-principal') || is_page('core-login')) {
         $fullpage = false;
         if ($fullpage) {
            $datos['height'] = ($fullpage) ? '100dvh' : '30dvh';
         }
         if (is_page('core-login')) {
            $datos['banner'] = '';
            $datos['navbar'] = '';
            $datos['titulo'] = '';
            $datos['height'] = '100dvh';
            $datos['section'] = '';
            $datos['div1'] = '';
            $datos['div2'] = '';
            $datos['agregarpost'] = '';
            $datos['div3'] = '';
            $datos['sidebarlefttemplate'] = '';
            $datos['div4'] = '';
            $datos['div5'] = '';
            $datos['div6'] = '';
            $datos['div7'] = '';
            $datos['div8'] = '';
            $datos['sidebarrighttemplate'] = '';
         }
         $datos['footerclass'] = '';
         $datos['footertemplate'] = '';
      }
      return $datos;
   }
}
