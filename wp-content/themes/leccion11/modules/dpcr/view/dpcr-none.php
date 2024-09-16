<?php

/**
 * 
 * Plantilla para mostrar que no hay posts.
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>

<h3>No hay registros de la División Política de Costa Rica</h3>