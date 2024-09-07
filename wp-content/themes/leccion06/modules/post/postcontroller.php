<?php

namespace MYDOMAIN\Modules\Post;

/**
 * 
 * Controlador para el Blog
 * 
 * @package: MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\Singleton;

class PostController
{
   use Singleton;
   private $atributos;

   private function __construct()
   {
      $this->atributos = [];
   }

   public function get_atributos($postType = 'post')
   {
      $this->atributos['titulo'] = $this->get_datos($postType)['titulo'];
      $this->atributos['subtitulo'] = $this->get_datos($postType)['subtitulo'];
      $this->atributos['div1'] = 'container-fluid';
      $this->atributos['div5'] = 'mt-5 mb-3';
      $this->atributos['div7'] = $this->get_datos($postType)['div7'];
      $this->atributos['templatepart'] = $this->get_datos($postType)['templatepart'];
      $this->atributos['templatepartnone'] = 'modules/' . $postType . '/view/' . $postType . '-none';
      $this->atributos['parametros'] = $this->get_datos($postType)['parametros'];

      return $this->atributos;
   }
   private function get_datos($postType)
   {
      $datos['titulo'] = 'Blog';
      $datos['subtitulo'] = '';
      $datos['div7'] = '';
      if (is_single()) {
         $datos['templatepart'] = 'modules/' . $postType . '/view/' . $postType . '-single';
         $datos['subtitulo'] = get_the_title();
      } else {
         if (is_page()) {
            $datos['templatepart'] = 'modules/' . $postType . '/view/' . get_post(get_the_ID())->post_name;
            $datos['titulo'] = get_the_title();
            if (is_front_page()) {
               $datos['banner'] = '';
               $datos['height'] = '100dvh';
               $datos['div1'] = '';
               $datos['div2'] = '';
               $datos['div4'] = '';
               $datos['div6'] = '';
               $datos['div7'] = '';
               $datos['templatepartnone'] = '';
               $datos['sidebarrighttemplate'] = '';
               $datos['footerclass'] = '';
               $datos['footertemplate'] = '';
            }
         } else {
            $datos['templatepart'] = 'modules/' . $postType . '/view/' . $postType;
            $datos['div7'] = 'row row-cols-1 g-5 row-cols-md-2 g-md-3 row-cols-xl-2 g-xl-4';
         }
      }

      $datos['parametros'] = '';

      return $datos;
   }
}
