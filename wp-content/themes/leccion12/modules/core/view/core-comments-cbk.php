<?php
if (!function_exists('core_get_comments')) :
   function core_get_comments($comment, $args, $depth)
   {
?>
      <li id="li-comment-<?php comment_ID() ?>">
         <section>
            <div class="container">
               <div class="row ">
                  <div class="col ext-white">
                     <div class="d-flex flex-start align-items-center">
                        <div class="shadow-1-strong me-3">
                           <?php echo get_avatar($comment, '32', 'gravatar_default', '', ['class' => 'rounded-circle']) ?>
                        </div>
                        <div>
                           <h6 class="fw-bold text-warning mb-1"><?php echo get_comment_author() ?></h6>
                           <p class="text-white small mb-0">
                              <?php printf(esc_html__('%1$s at %2$s', 'EGC000'), date('l, d-m-Y', strtotime(get_comment_date())),  date('H:i', strtotime(get_comment_time()))) ?>
                           </p>
                        </div>
                     </div>
                     <p class="mt-3 mb-4 pb-2">
                        <?php comment_text() ?>
                     </p>
                  </div>
               </div>
            </div>
         </section>
      </li>
<?php
   }
endif;
