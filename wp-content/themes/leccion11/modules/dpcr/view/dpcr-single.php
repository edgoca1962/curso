<?php

/**
 * 
 * Plantilla Single del Post
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();
$core->set_atributo('commentsTemplate', '');

?>

<section id="dpcr_single">
   <div id=<?php the_ID() ?> class="col my-5">
      <h3><?php echo 'Barrio: ' . get_post_meta(get_the_ID(), '_barrio', true) ?></h3>
      <div id="map" class="rounded" style="height: 600px; width: 100%;"></div>
   </div>
   <div class="card-footer text-body-secondary d-flex justify-content-center">
      <form id="dpcr_btns">
         <?php if ($core->get_atributo('nivel_acceso') >= 20) : ?>
            <button name="dpcr_editar" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
            <button name="dpcr_borrar" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
         <?php endif; ?>
         <input name="nonce" type="hidden" value="<?php echo wp_create_nonce('dpcr_mantenimiento') ?>">
         <input name="endpoint" type="hidden" value="<?php echo admin_url('admin-ajax.php') ?>">
         <input name="post_id" type="hidden" value="<?php the_ID() ?>">
      </form>
   </div>
</section>

<?php $direccion = get_post_meta(get_the_ID(), '_barrio', true) . ', ' . get_post_meta(get_the_ID(), '_distrito', true) . ', ' . get_post_meta(get_the_ID(), '_canton', true) . ', ' . get_post_meta(get_the_ID(), '_provincia', true) ?>

<script>
   function initMap() {
      // Crear una nueva instancia de geocoder
      var geocoder = new google.maps.Geocoder();
      // Obtener el contenedor donde se mostrará el mapa
      var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 12,
         center: {
            lat: -34.397,
            lng: 150.644
         } // Coordenadas iniciales
      });

      // Dirección obtenida del custom field en PHP
      var direccion = "<?php echo esc_js($direccion); ?>";

      // Geocodificar la dirección y centrar el mapa en la ubicación
      geocoder.geocode({
         'address': direccion
      }, function(results, status) {
         if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
               map: map,
               position: results[0].geometry.location
            });
         } else {
            alert('No se pudo encontrar la dirección: ' + status);
         }
      });
   }

   // Cargar el mapa una vez que la API de Google Maps se haya cargado
   window.onload = function() {
      initMap();
   };
</script>