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
<html <?php language_attributes() ?>>

<head>
   <meta charset="<?php bloginfo('charset'); ?>">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="profile" href="https://gmpg.org/xfn/11">
   <title>Document</title>
   <?php wp_head(); ?>
</head>

<body <?php body_class($core->get_atributo('body')) ?> style="<?php echo $core->get_atributo('height') ?>">
   <h3>Página principal</h3>
   <?php wp_footer() ?>
</body>

</html>