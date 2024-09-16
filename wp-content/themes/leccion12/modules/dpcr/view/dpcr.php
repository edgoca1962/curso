<?php

/**
 * 
 * Plantilla para listar los Posts
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>

<div id=<?php the_ID() ?> class="col">
   <div class="card border-0 shadow bg-transparent">
      <img class="rounded-top" src="<?php echo MYDOMAIN_DIR_URI . '/assets/img/sjo.png' ?>" alt="">
      <div class="card-body">
         <h5 class="card-title">
            <a class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href=" <?php echo $core->get_atributo('enlace') . '?pag=' . $core->get_atributo('pag') .  $core->get_atributo('parametros') ?>"><?php echo $core->get_atributo('dpcr_nombre') ?></a>
         </h5>
      </div>
   </div>
</div>