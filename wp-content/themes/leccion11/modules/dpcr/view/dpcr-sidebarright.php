<?php

/**
 * 
 * Plantilla side bar derecha para posts
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>
<div class="row mt-5 mb-3" <?php echo ($core->get_atributo('nivel_acceso') >= 10) ? '' : 'hidden' ?>>
   <div class="position-relative">
      <form id="frmbuscar" class="d-flex">
         <input id="impbuscar" class="form-control w-100 me-2" type="text" style="width: 0;" placeholder="Buscar en División Política" aria-label="Search">
      </form>
      <div id="resultados" class="container invisible position-absolute search-overlay rounded-3 w-100 bg-white" style="height:300px; z-index: 10;">
         <div class="d-flex justify-content-between">
            <h5>Resultados</h5><span id="btn_cerrar"><i class="far fa-times-circle"></i></span>
         </div>
         <div id="resultados_busqueda" data-url="<?= get_site_url() . '/wp-json/wp/v2/dpcrs?search=' ?>" data-msg="No se encontraron registros"></div>
      </div>
   </div>
</div>
<section class="d-flex justify-content-center">
   <div class="col-12 col-md-6 col-xl-12 card mt-5 border-0 shadow">
      <img id="evento1" src="" class="card-img-top object-fit-cover" style="height: 250px;" alt="Evento">
      <div class="card-body">
         <h5 class="card-title">Eventos</h5>
         <h6 class="card-subtitle mb-2 text-muted ">Subtítulo</h6>
         <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Est voluptas officiis et maiores aut veritatis exercitationem dignissimos animi dolorem voluptate ratione, minima aspernatur sint expedita beatae eveniet ex placeat itaque quis. Voluptas perspiciatis et consequatur corporis nihil molestiae, distinctio unde alias id fugit quos quam facere, accusamus mollitia numquam iusto.</p>
      </div>
      <input type="hidden" id="evento_foto" value="events">
   </div>
</section>