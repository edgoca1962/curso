<?php

/**
 * 
 * Planitlla para cambio contraseña.
 * 
 * @package MYDOMAIN
 * 
 */


?>

<section class="d-flex justify-content-center pt-5">
   <div class="col-md-6">
      <form id="cambiar_clave" class="row g-3 needs-validation float" novalidate>
         <div class="d-flex form-floating mb-3 border-bottom">
            <input type="password" class="form-control bg-transparent border-0 shadow-none text-white" id="clave_actual" name="clave_actual" placeholder="contraseña" required>
            <label for="clave_actual">Contraseña </label>
            <span class="mt-4" style="font-size: 70%;"><i id="ver_clave_actual" class="fa-solid fa-eye"></i></i></span>
         </div>
         <div class="d-flex form-floating mb-3 border-bottom">
            <input type="password" class="form-control bg-transparent border-0 shadow-none text-white" id="clave_nueva" name="clave_nueva" placeholder="contraseña" required>
            <label for="clave_nueva">Contraseña nueva</label>
            <span class="mt-4" style="font-size: 70%;"><i id="ver_clave_nueva" class="fa-solid fa-eye"></i></i></span>
         </div>
         <div class="d-flex form-floating mb-3 border-bottom">
            <input type="password" class="form-control bg-transparent border-0 shadow-none text-white" id="confirmar_clave" name="confirmar_clave" placeholder="contraseña" required>
            <label for="confirmar_clave">Comprobación</label>
            <span class="mt-4" style="font-size: 70%;"><i id="ver_confirmar_clave" class="fa-solid fa-eye"></i></i></span>
         </div>
         <div class="form-group">
            <button type="submit" class="btn btn-warning btn-sm mb-3">Cambiar Clave</button>
            <button id="btn_cancelar" type="button" class="btn btn-secondary btn-sm mb-3">Cancelar</button>
         </div>
   </div>
   <input type="hidden" name="action" value="cambiar_clave">
   <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('cambiar_clave') ?>">
   <input type="hidden" name="endpoint" value="<?php echo admin_url('admin-ajax.php') ?>">
</section>