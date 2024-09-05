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
<div id="<?php echo "articulo_" . get_the_ID() ?>" class="col">
   <div class="card border-0 shadow text-black h-100">
      <img src="<?php echo get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/post/post.jpg' ?>" class="card-img-top object-fit-cover" alt="imagen Post">
      <div class="card-header">
         Featured
      </div>
      <div class="card-body">
         <h5 class="card-title">
            <a class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="<?php echo esc_url(get_the_permalink(get_the_ID())) . '?pag=' . $core->get_atributo('pag') .  $core->get_atributo('parametros') ?>"><?php echo get_the_title() ?></a>
         </h5>
         <p class="card-text"><?php the_excerpt() ?></p>
      </div>
      <div class="card-footer text-body-secondary d-flex justify-content-center">
         <form id="articulo_btn_<?php the_ID() ?>">
            <?php if ($core->get_atributo('nivel_acceso') >= 20) : ?>
               <button name="post_editar" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
               <button name="post_borrar" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
            <?php endif; ?>
            <button name="post_compartir" class="btn btn-outline-success"><i class="fa-brands fa-whatsapp"></i></button>
            <input name="nonce" type="hidden" value="<?php echo wp_create_nonce('post_mantenimiento') ?>">
            <input name="endpoint" type="hidden" value="<?php echo admin_url('admin-ajax.php') ?>">
            <input name="post_id" type="hidden" value="<?php the_ID() ?>">
         </form>
      </div>
   </div>
</div>