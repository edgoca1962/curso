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
      $datos = [];

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

      $this->atributos = $datos;

      return $this->atributos;
   }
}
