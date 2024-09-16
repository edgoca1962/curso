<?php

/**
 * 
 * Plantilla para le botón regresar
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>
<?php if ($core->get_atributo('parametros_btn_regresar') != '') : ?>
   <div class="mb-3">
      <a href="<?php echo get_post_type_archive_link('dpcr') . '?' . $core->get_atributo('parametros_btn_regresar') ?>" type="button" class="btn btn-warning">Regresar</a>
   </div>
<?php endif; ?>