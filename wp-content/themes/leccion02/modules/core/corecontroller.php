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

      $datos['body'] = 'bg-dark bg-gradient text-white';
      $datos['height'] = 'height: 100dvh;';

      $this->atributos = $datos;

      return $this->atributos;
   }
}
