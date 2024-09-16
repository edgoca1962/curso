<?php

namespace MYDOMAIN\Modules\Dpcr;

/**
 * 
 * Creación de campos personalizados para DVCR
 */

use MYDOMAIN\Modules\Core\Singleton;

class DpcrModel
{
   use Singleton;

   public function __construct()
   {
      add_action('add_meta_boxes', [$this, 'set_campos']);
      add_action('save_post', [$this, 'save_provincia_id']);
      add_action('save_post', [$this, 'save_provincia']);
      add_action('save_post', [$this, 'save_canton_id']);
      add_action('save_post', [$this, 'save_canton']);
      add_action('save_post', [$this, 'save_distrito_id']);
      add_action('save_post', [$this, 'save_distrito']);
      add_action('save_post', [$this, 'save_barrio_id']);
      add_action('save_post', [$this, 'save_barrio']);
      $this->set_paginas();
   }
   public function set_campos()
   {
      add_meta_box(
         '_provincia_id',
         'Provincia ID',
         [$this, 'set_provincia_id_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_provincia',
         'Provincia',
         [$this, 'set_provincia_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_canton_id',
         'Cantón ID',
         [$this, 'set_canton_id_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_canton',
         'Cantón',
         [$this, 'set_canton_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_distrito_id',
         'Distrito ID',
         [$this, 'set_distrito_id_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_distrito',
         'Distrito',
         [$this, 'set_distrito_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_barrio_id',
         'Barrio ID',
         [$this, 'set_barrio_id_cbk'],
         'dpcr',
         'normal',
         'default'
      );
      add_meta_box(
         '_barrio',
         'Barrio',
         [$this, 'set_barrio_cbk'],
         'dpcr',
         'normal',
         'default'
      );
   }
   public function set_provincia_id_cbk($post)
   {
      wp_nonce_field('provincia_id_nonce', 'provincia_id_nonce');
      $provincia_id = get_post_meta($post->ID, '_provincia_id', true);
      echo '<input type="text" style="width:20%" id="provincia_id" name="provincia_id" value="' . esc_attr($provincia_id) . '" ></input>';
   }
   public function save_provincia_id($post_id)
   {
      if (!isset($_POST['provincia_id_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['provincia_id_nonce'], 'provincia_id_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['provincia_id'])) {
         return;
      }
      $provincia_id = sanitize_text_field($_POST['provincia_id']);
      update_post_meta($post_id, '_provincia_id', $provincia_id);
   }
   public function set_provincia_cbk($post)
   {
      wp_nonce_field('provincia_nonce', 'provincia_nonce');
      $provincia = get_post_meta($post->ID, '_provincia', true);
      echo '<input type="text" style="width:20%" id="provincia" name="provincia" value="' . esc_attr($provincia) . '" ></input>';
   }
   public function save_provincia($post_id)
   {
      if (!isset($_POST['provincia_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['provincia_nonce'], 'provincia_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['provincia'])) {
         return;
      }
      $provincia = sanitize_text_field($_POST['provincia']);
      update_post_meta($post_id, '_provincia', $provincia);
   }
   public function set_canton_id_cbk($post)
   {
      wp_nonce_field('canton_id_nonce', 'canton_id_nonce');
      $canton_id = get_post_meta($post->ID, '_canton_id', true);
      echo '<input type="text" style="width:20%" id="canton_id" name="canton_id" value="' . esc_attr($canton_id) . '" ></input>';
   }
   public function save_canton_id($post_id)
   {
      if (!isset($_POST['canton_id_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['canton_id_nonce'], 'canton_id_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['canton_id'])) {
         return;
      }
      $canton_id = sanitize_text_field($_POST['canton_id']);
      update_post_meta($post_id, '_canton_id', $canton_id);
   }
   public function set_canton_cbk($post)
   {
      wp_nonce_field('canton_nonce', 'canton_nonce');
      $canton = get_post_meta($post->ID, '_canton', true);
      echo '<input type="text" style="width:20%" id="canton" name="canton" value="' . esc_attr($canton) . '" ></input>';
   }
   public function save_canton($post_id)
   {
      if (!isset($_POST['canton_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['canton_nonce'], 'canton_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['canton'])) {
         return;
      }
      $canton = sanitize_text_field($_POST['canton']);
      update_post_meta($post_id, '_canton', $canton);
   }
   public function set_distrito_id_cbk($post)
   {
      wp_nonce_field('distrito_id_nonce', 'distrito_id_nonce');
      $distrito_id = get_post_meta($post->ID, '_distrito_id', true);
      echo '<input type="text" style="width:20%" id="distrito_id" name="distrito_id" value="' . esc_attr($distrito_id) . '" ></input>';
   }
   public function save_distrito_id($post_id)
   {
      if (!isset($_POST['distrito_id_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['distrito_id_nonce'], 'distrito_id_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['distrito_id'])) {
         return;
      }
      $distrito_id = sanitize_text_field($_POST['distrito_id']);
      update_post_meta($post_id, '_distrito_id', $distrito_id);
   }
   public function set_distrito_cbk($post)
   {
      wp_nonce_field('distrito_nonce', 'distrito_nonce');
      $distrito = get_post_meta($post->ID, '_distrito', true);
      echo '<input type="text" style="width:20%" id="distrito" name="distrito" value="' . esc_attr($distrito) . '" ></input>';
   }
   public function save_distrito($post_id)
   {
      if (!isset($_POST['distrito_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['distrito_nonce'], 'distrito_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['distrito'])) {
         return;
      }
      $distrito = sanitize_text_field($_POST['distrito']);
      update_post_meta($post_id, '_distrito', $distrito);
   }
   public function set_barrio_id_cbk($post)
   {
      wp_nonce_field('barrio_id_nonce', 'barrio_id_nonce');
      $barrio_id = get_post_meta($post->ID, '_barrio_id', true);
      echo '<input type="text" style="width:20%" id="barrio_id" name="barrio_id" value="' . esc_attr($barrio_id) . '" ></input>';
   }
   public function save_barrio_id($post_id)
   {
      if (!isset($_POST['barrio_id_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['barrio_id_nonce'], 'barrio_id_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['barrio_id'])) {
         return;
      }
      $barrio_id = sanitize_text_field($_POST['barrio_id']);
      update_post_meta($post_id, '_barrio_id', $barrio_id);
   }
   public function set_barrio_cbk($post)
   {
      wp_nonce_field('barrio_nonce', 'barrio_nonce');
      $barrio = get_post_meta($post->ID, '_barrio', true);
      echo '<input type="text" style="width:20%" id="barrio" name="barrio" value="' . esc_attr($barrio) . '" ></input>';
   }
   public function save_barrio($post_id)
   {
      if (!isset($_POST['barrio_nonce'])) {
         return;
      }
      if (!wp_verify_nonce($_POST['barrio_nonce'], 'barrio_nonce')) {
         return;
      }
      if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
         return;
      }
      if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
         if (!current_user_can('edit_page', $post_id)) {
            return;
         }
      } else {
         if (!current_user_can('edit_post', $post_id)) {
            return;
         }
      }
      if (!isset($_POST['barrio'])) {
         return;
      }
      $barrio = sanitize_text_field($_POST['barrio']);
      update_post_meta($post_id, '_barrio', $barrio);
   }
   private function set_paginas()
   {
      $paginas = [
         'csv' =>
         [
            'slug' => 'dpcr-staging',
            'titulo' => 'Pruebas DPCR (MEIC)'
         ],
      ];
      foreach ($paginas as $pagina) {

         $pags = get_posts([
            'post_type' => 'page',
            'post_status' => 'publish',
            'name' => $pagina['slug'],
         ]);
         if (count($pags) > 0) {
         } else {
            $post_data = array(
               'post_type' => 'page',
               'post_title' => $pagina['titulo'],
               'post_name' => $pagina['slug'],
               'post_status' => 'publish',
            );
            wp_insert_post($post_data);
         }
      }
   }
}
