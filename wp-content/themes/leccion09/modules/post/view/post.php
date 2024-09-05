<?php

/**
 * 
 * Plantilla principal
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = CoreController::get_instance()->get_datos();

?>
<div id="<?php echo "articulo_" . get_the_ID() ?>" <?php post_class('col sticky') ?>>
   <div class="card border-0 shadow text-black h-100">
      <img src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/post/post.jpg' ?>" class="card-img-top" alt="imagen Post">
      <div class="card-body">
         <h5 class="card-title">
            <a class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="<?php echo esc_url(get_the_permalink(get_the_ID())) . '?pag=' . $core->get_atributo('pag') .  $core->get_atributo('parametros') ?>"><?php echo get_the_title() ?></a>
         </h5>
         <p class="card-text"><?php the_excerpt() ?></p>
      </div>
   </div>
</div>