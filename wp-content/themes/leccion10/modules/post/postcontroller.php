<?php

namespace MYDOMAIN\Modules\Post;

/**
 * 
 * Controlador para el Blog
 * 
 * @package: MYDOMAIN
 * 
 */

use MYDOMAIN\Modules\Core\Singleton;

class PostController
{
   use Singleton;
   private $atributos;

   private function __construct()
   {
      $this->atributos = [];
      $this->set_roles();
      $this->set_paginas();
      add_action('wp_ajax_post_registrar', [$this, 'MYDOMAIN_post_registrar']);
      add_action('wp_ajax_post_editar', [$this, 'MYDOMAIN_post_editar']);
      add_action('wp_ajax_post_borrar', [$this, 'MYDOMAIN_post_borrar']);
      add_action('wp_ajax_post_compartir', [$this, 'MYDOMAIN_post_compartir']);
   }
   public function get_atributos($postType = 'post')
   {
      $this->atributos['bg-html'] = 'bg-white';
      $this->atributos['body-style'] = '';
      $this->atributos['body'] = 'bg-white text-black';

      $this->atributos['imagen'] = $this->get_datos($postType)['imagen'];
      $this->atributos['titulo'] = $this->get_datos($postType)['titulo'];
      $this->atributos['subtitulo'] = $this->get_datos($postType)['subtitulo'];
      $this->atributos['div1'] = 'container-fluid';
      $this->atributos['div5'] = 'mt-5 mb-3';
      $this->atributos['div7'] = $this->get_datos($postType)['div7'];
      $this->atributos['templatepart'] = $this->get_datos($postType)['templatepart'];
      $this->atributos['templatepartnone'] = 'modules/' . $postType . '/view/' . $postType . '-none';
      $this->atributos['parametros'] = $this->get_datos($postType)['parametros'];
      $this->atributos['agregarpost'] = ''; //'modules/' . $postType . '/view/' . $postType . '-agregar';
      $this->atributos['sidebarrighttemplate'] = 'modules/post/view/post-sidebarright';

      return $this->atributos;
   }
   private function get_datos($postType)
   {
      $datos['titulo'] = 'Blog';
      $datos['subtitulo'] = '';
      $datos['div7'] = '';
      if (is_single()) {
         $datos['templatepart'] = 'modules/' . $postType . '/view/' . $postType . '-single';
         $datos['subtitulo'] = get_the_title();
      } else {
         if (is_page()) {
            $datos['templatepart'] = 'modules/' . $postType . '/view/' . get_post(get_the_ID())->post_name;
            $datos['titulo'] = get_the_title();
            if (is_front_page()) {
               $datos['banner'] = '';
               $datos['height'] = '100dvh';
               $datos['div1'] = '';
               $datos['div2'] = '';
               $datos['div4'] = '';
               $datos['div6'] = '';
               $datos['templatepartnone'] = '';
               $datos['sidebarrighttemplate'] = '';
               $datos['footerclass'] = '';
               $datos['footertemplate'] = '';
            }
         } else {
            $datos['templatepart'] = 'modules/' . $postType . '/view/' . $postType;
            $datos['div7'] = 'row row-cols-1 g-5 row-cols-md-2 g-md-3 row-cols-xl-2 g-xl-4 mb-5';
         }
      }

      $datos['parametros'] = '';
      $datos['imagen'] = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/bg.jpg';

      if (is_user_logged_in()) {
         $usuarioRoles = wp_get_current_user()->roles;
         if (in_array('gestorart', $usuarioRoles)) {
            $datos['nivel_acceso'] = 20;
         } elseif (in_array('revisorart', $usuarioRoles)) {
            $datos['nivel_acceso'] = 30;
         } elseif (in_array('aprobadorart', $usuarioRoles)) {
            $datos['nivel_acceso'] = 40;
         } elseif (in_array('adminart', $usuarioRoles)) {
            $datos['nivel_acceso'] = 50;
         } else {
            $datos['nivel_acceso'] = 0;
         }
      } else {
         $datos['nivel_acceso'] = 10;
      }


      return $datos;
   }
   private function set_roles()
   {
      add_role('gestorart', 'Gestor Art', get_role('subscriber')->capabilities);          //20 Contributor puede ver y editar solo lo suyo sin publicar
      add_role('revisorart', 'Revisor Art', get_role('subscriber')->capabilities);        //30 Author puede ver, editar y publicar lo suyo y su grupo
      add_role('aprobadorart', 'Aprobador Art', get_role('subscriber')->capabilities);    //40 Editor puede ver, editar y publicar lo suyo y lo de otros
      add_role('adminart', 'Admin. Art', get_role('subscriber')->capabilities);           //50 Administrador 
   }
   private function set_paginas()
   {
      $paginas = [
         'cambio_clave' =>
         [
            'slug' => 'post-cambio-clave',
            'titulo' => 'Cambio de Contraseña Post'
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
   public function MYDOMAIN_post_registrar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'post_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         wp_send_json_success(['titulo' => 'Artículo Registrado', 'msg' => 'El artículo ha sido registrado correctamente.']);
      }
   }
   public function MYDOMAIN_post_editar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'post_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         wp_send_json_success(['titulo' => 'Artículo Editado', 'msg' => 'Las modificaciones del artículo se han registrado correctamente.']);
      }
   }
   public function MYDOMAIN_post_borrar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'post_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         if (!isset($_POST['post_id'])) {
            return;
         }
         $post_id = sanitize_text_field($_POST['post_id']);
         $post = get_post($post_id);
         if (!$post) {
            return;
         }
         $comments = get_comments(array('post_id' => $post_id));
         foreach ($comments as $comment) {
            wp_delete_comment($comment->comment_ID, true);
         }
         $attachments = get_attached_media('', $post_id);
         foreach ($attachments as $attachment) {
            $file_path = get_attached_file($attachment->ID);
            if (file_exists($file_path)) {
               unlink($file_path);
            }
            $meta = wp_get_attachment_metadata($attachment->ID);
            $upload_dir = wp_upload_dir();
            if (isset($meta['sizes'])) {
               foreach ($meta['sizes'] as $size) {
                  $size_path = pathinfo($file_path);
                  $size_file = $upload_dir['basedir'] . '/' . $size_path['dirname'] . '/' . $size['file'];
                  if (file_exists($size_file)) {
                     unlink($size_file);
                  }
               }
            }
            wp_delete_attachment($attachment->ID, true);
         }
         wp_delete_post($post_id, true);
         wp_send_json_success(['titulo' => 'Artículo Borrado', 'msg' => 'El artículo ha sido borrado correctamente.']);
      }
   }
   public function MYDOMAIN_post_compartir()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'post_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         wp_send_json_success(['titulo' => 'Artículo Compartido', 'msg' => 'El artículo ha sido compartido correctamente.']);
      }
   }
}
