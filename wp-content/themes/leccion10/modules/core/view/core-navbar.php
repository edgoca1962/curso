<?php

/**
 * 
 * Plantilla Navbar
 * 
 * @package MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\CoreController;

$core = CoreController::get_instance();
$atributos = $core->get_datos();

?>
<header>
   <nav id="main_navbar" class="navbar navbar-expand-lg navbar-dark fixed-top shadow">
      <div class="container-fluid">
         <div id="logo" class="navbar-brand logo">
            <div class="d-flex justify-content-center">
               <a href="<?= esc_url(site_url('/')) ?>">
                  <img class="<?php echo $core->get_atributo('classLogo') ?>" style="width: <?php echo $core->get_atributo('logoSize') ?>; height:auto;" src="<?php echo (has_custom_logo()) ? wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0] : MYDOMAIN_DIR_URI . '/assets/img/fghblanco.png' ?>" alt="Logo">
               </a>
            </div>
         </div>
         <div class="row">
            <?php if (is_user_logged_in()) : ?>
               <div id="menuAvatarMenu" class="col navbar nav-item me-3">
                  <div class="col navbar-toggler border-0">
                     <img src="<?php echo (get_user_meta(get_current_user_ID(), 'custom_avatar', true)) ? wp_get_attachment_url(get_user_meta(get_current_user_ID(), 'custom_avatar', true)) : MYDOMAIN_DIR_URI . '/assets/img/Avatar.png' ?>" class="rounded-circle border border-2 border-white" style="height: 2rem; width:2rem;" alt="Imágen Usuario">
                  </div>
               </div>
            <?php endif; ?>
            <button id="btnmenu" class="col navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>
         </div>
         <div class="justify-content-end collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (!is_user_logged_in()) : ?>
               <div class="navbar nav-item ms-2">
                  <a class="nav-link" aria-current="page" href="<?php echo esc_url(site_url('/')) ?>">Home</a>
               </div>
            <?php endif; ?>
            <?php
            if (is_user_logged_in()) {
               wp_nav_menu(
                  array(
                     'theme_location' => 'principal',
                     'container' => false,
                     'menu_class' => 'nav navbar-nav ms-auto mb-2 mb-lg-0',
                     'walker' => new Walker_Nav_Primary()
                  )
               );
            }
            if ($core->get_atributo('nivel_acceso') >= 100) {
               wp_nav_menu(
                  array(
                     'theme_location' => 'administrador',
                     'container' => false,
                     'menu_class' => 'nav navbar-nav mb-2 mb-lg-0',
                     'walker' => new Walker_Nav_Primary()
                  )
               );
            }
            ?>
            <?php if (is_user_logged_in()) : ?>
               <div id="menuAvatar" class="navbar nav-item">
                  <div class="col-2">
                     <img src="<?php echo (get_user_meta(get_current_user_ID(), 'custom_avatar', true)) ? wp_get_attachment_url(get_user_meta(get_current_user_ID(), 'custom_avatar', true)) : MYDOMAIN_DIR_URI . '/assets/img/Avatar.png' ?>" class="rounded-circle border border-2 border-white" style="height: 2rem; width:2rem;" alt="Imágen Usuario">
                  </div>
               </div>
            <?php endif; ?>
            <div id="btn_menu" class="navbar nav-item ms-2">
               <button type="button" class="btn btn-warning">
                  <?php if (is_user_logged_in()) : ?>
                     <a class="nav-link text-dark" aria-current="page" href="<?= wp_logout_url('/') ?>"></span><i class="fas fa-sign-out-alt"></i> Salir</a>
                  <?php else : ?>
                     <a class="nav-link text-dark" aria-current="page" href="<?= esc_url(site_url('/core-login')) ?>"><i class="fas fa-sign-in-alt"></i> Ingresar</a>
                  <?php endif ?>
               </button>
            </div>
         </div>
      </div>
   </nav>
</header>