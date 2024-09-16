<?php

/**
 * 
 * Plantilla para agregar POSTS
 * 
 * @package MYDOMAIN
 * 
 */


use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>

<button class="btn btn-warning btn-sm mb-3">
   <a class="text-decoration-none text-black" href="#"><i class="fa-solid fa-calendar-plus"></i> Agregar Artículo</a>
</button>