<?php

/**
 * 
 * Plantilla para el Botón Regresar de los posts
 * 
 * @package: EGC000
 */


use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();
?>

<a class="btn btn-warning btn-sm mb-3" href="<?php echo get_post_type_archive_link($core->get_atributo('regresar')) . 'page/' . $core->get_atributo('pag_ant') . '/?' . $core->get_atributo('parametros') ?>">Regresar</a>