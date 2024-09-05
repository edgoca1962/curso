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

<!DOCTYPE html>
<html class="<?php echo $core->get_atributo('bg-html') ?>" <?php language_attributes() ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">
   <title>Document</title>
   <?php wp_head(); ?>
</head>

<body <?php body_class($core->get_atributo('body')) ?> style="<?php echo $core->get_atributo('body-style') ?>">
   <?php wp_body_open() ?>
   <header>
      <?php get_template_part($core->get_atributo('navbar')) ?>
      <?php get_template_part($core->get_atributo('banner')) ?>
   </header>
   <section class="<?php echo $core->get_atributo('section') ?>" style="<?php echo $core->get_atributo('section-style') ?>">
      <div class="<?php echo $core->get_atributo('div1') ?>"> <!-- div1 -->
         <div class="<?php echo $core->get_atributo('div2') ?>"> <!-- div2 -->
            <div class="<?php echo $core->get_atributo('div3') ?>"> <!-- div3 -->
               <?php get_template_part($core->get_atributo('sidebarlefttemplate')) ?>
            </div>
            <div class="<?php echo $core->get_atributo('div4') ?>"> <!-- div4 -->
               <div class="<?php echo $core->get_atributo('div5') ?>"> <!-- div5 -->
                  <h5>Incluir boton para agregar post</h5>
                  <?php if (have_posts()) : ?>
                     <div class="<?php echo $core->get_atributo('div6') ?>"> <!-- div6 -->
                        <div class="<?php echo $core->get_atributo('div7') ?>"> <!-- div7 -->
                           <?php
                           while (have_posts()) :
                              the_post();
                              get_template_part($core->get_atributo('templatepart'));
                              if (is_page()) {
                                 the_content();
                              }
                              if ((comments_open() || get_comments_number())) {
                                 comments_template('');
                              }
                           endwhile;
                           ?>
                        </div>
                        <h5>Inlcuir Navegación</h5>
                        <?php get_template_part('') ?>
                     </div>
                  <?php else : ?>
                     <?php get_template_part($core->get_atributo('templatepartnone')) ?>
                  <?php endif; ?>
               </div>
            </div>
            <div class="<?php echo $core->get_atributo('div8') ?>"> <!-- div8 -->
               <?php get_template_part($core->get_atributo('sidebarrighttemplate')) ?>
            </div>
         </div>
         <footer class="<?php echo $core->get_atributo('footerclass') ?>">
            <?php get_template_part($core->get_atributo('footertemplate')) ?>
         </footer>
      </div>
   </section>
   <?php wp_footer() ?>
</body>

</html>