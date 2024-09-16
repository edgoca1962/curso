<?php

namespace MYDOMAIN\Modules\Dpcr;

use MYDOMAIN\Modules\Core\Singleton;

/**
 * 
 * Controlador para la División Política de Costa Rica
 * 
 * @package: MYDOMAIN
 * 
 */

class DpcrController
{
   use Singleton;
   private $atributos;

   private function __construct()
   {
      $this->atributos = [];
      add_action('pre_get_posts', [$this, 'dpcr_pre_get_posts']);
      add_action('wp_ajax_dpcr_cantones', [$this, 'dpcr_get_cantones']);
      add_action('wp_ajax_dpcr_distritos', [$this, 'dpcr_get_distritos']);
      add_action('wp_ajax_dpcr_barrios', [$this, 'dpcr_get_barrios']);
      add_action('wp_ajax_dpcr_registrar', [$this, 'dpcr_registrar']);
      add_action('wp_ajax_dpcr_editar', [$this, 'dpcr_editar']);
      add_action('wp_ajax_dpcr_borrar', [$this, 'dpcr_borrar']);
   }
   public function get_atributos($postType = 'dpcr')
   {
      $this->atributos['titulo'] = $this->get_datos($postType)['titulo'];
      $this->atributos['subtitulo'] = $this->get_datos($postType)['subtitulo'];
      $this->atributos['div1'] = 'container-fluid';
      $this->atributos['div5'] = 'mt-5 mb-3';
      $this->atributos['div7'] = $this->get_datos($postType)['div7'];
      $this->atributos['templatepart'] = $this->get_datos($postType)['templatepart'];
      $this->atributos['templatepartnone'] = "modules/$postType/view/$postType-none";
      $this->atributos['parametros'] = $this->get_datos($postType)['parametros'];
      $this->atributos['imagen'] = $this->get_datos($postType)['imagen'];

      $this->atributos['agregarpost'] = "modules/$postType/view/$postType-agregar";
      $this->atributos['sidebarrighttemplate'] = "modules/$postType/view/$postType-sidebarright";
      $this->atributos['sidebarlefttemplate'] = '';
      $this->atributos['div3'] = '';
      $this->atributos['div4'] = 'col-12 col-xl-9';
      $this->atributos['dpcr_nombre'] = $this->get_datos($postType)['dpcr_nombre'];
      $this->atributos['subtitulo2'] = $this->get_datos($postType)['subtitulo2'];
      $this->atributos['enlace'] = $this->get_datos($postType)['enlace'];
      $this->atributos['parametros_btn_regresar'] = $this->get_datos($postType)['parametros_btn_regresar'];
      $this->atributos['btn_regresar'] = $this->get_datos($postType)['btn_regresar'];
      $this->atributos['provincias'] = $this->dpcr_get_provincias();

      return $this->atributos;
   }
   private function get_datos($postType)
   {
      $datos['titulo'] = 'Div. Pol. de CR';
      $datos['subtitulo'] = '';
      $datos['div7'] = '';
      $datos['subtitulo2'] = '';
      $datos['enlace'] = get_post_type_archive_link('dpcr');
      if (is_single()) {
         $datos['templatepart'] = "modules/$postType/view/$postType-single";
         $datos['subtitulo'] = get_the_title();
      } else {
         if (is_page()) {
            $datos['templatepart'] = "modules/$postType/view/" . get_post(get_the_ID())->post_name;
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
            $datos['templatepart'] = "modules/$postType/view/$postType";
            $datos['div7'] = 'row row-cols-1 g-5 row-cols-md-3 g-md-3 row-cols-xl-4 g-xl-4 mb-5';
         }
      }

      $datos['imagen'] = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/bg.jpg';

      /** Implementacción de navegación entre la Div. Pol. */
      if (isset($_GET['provincia_id']) && isset($_GET['canton_id']) && isset($_GET['distrito_id']) && isset($_GET['barrio_id'])) {
         $datos['subtitulo'] = 'Provincia de ' . get_post_meta(get_the_ID(), '_provincia', true);
         $datos['subtitulo2'] = '<span class="fs-1">Cantón ' . get_post_meta(get_the_ID(), '_canton', true) . '</span><br><span class="fs-2">Distrito ' . get_post_meta(get_the_ID(), '_distrito', true) . '</span><br><span class="fs-3">Barrio ' . get_post_meta(get_the_ID(), '_barrio', true) . '<span>';
         $datos['parametros'] = '&provincia_id=' . get_post_meta(get_the_ID(), '_provincia_id', true) . '&canton_id=' . get_post_meta(get_the_ID(), '_canton_id', true) . '&distrito_id=' . get_post_meta(get_the_ID(), '_distrito_id', true) . '&barrio_id=' . get_post_meta(get_the_ID(), '_barrio_id', true);
         $datos['dpcr_nombre'] = get_post_meta(get_the_ID(), '_barrio', true);
      } elseif (isset($_GET['provincia_id']) && isset($_GET['canton_id']) && isset($_GET['distrito_id'])) {
         $datos['subtitulo'] = 'Provincia de ' . get_post_meta(get_the_ID(), '_provincia', true);
         $datos['subtitulo2'] = '<span class="fs-1">Cantón ' . get_post_meta(get_the_ID(), '_canton', true) . '</span><br><span class="fs-2">Distrito ' . get_post_meta(get_the_ID(), '_distrito', true);
         $datos['parametros'] = '&provincia_id=' . get_post_meta(get_the_ID(), '_provincia_id', true) . '&canton_id=' . get_post_meta(get_the_ID(), '_canton_id', true) . '&distrito_id=' . get_post_meta(get_the_ID(), '_distrito_id', true) . '&barrio_id=' . get_post_meta(get_the_ID(), '_barrio_id', true);
         $datos['dpcr_nombre'] = get_post_meta(get_the_ID(), '_barrio', true);
         $datos['enlace'] = get_the_permalink();
      } elseif (isset($_GET['provincia_id']) && isset($_GET['canton_id'])) {
         $datos['subtitulo'] = 'Provincia de ' . get_post_meta(get_the_ID(), '_provincia', true);
         $datos['subtitulo2'] = '<span class="fs-1">Cantón ' . get_post_meta(get_the_ID(), '_canton', true);
         $datos['parametros'] = '&provincia_id=' . get_post_meta(get_the_ID(), '_provincia_id', true) . '&canton_id=' . get_post_meta(get_the_ID(), '_canton_id', true) . '&distrito_id=' . get_post_meta(get_the_ID(), '_distrito_id', true);
         $datos['dpcr_nombre'] = get_post_meta(get_the_ID(), '_distrito', true);
      } elseif (isset($_GET['provincia_id'])) {
         $datos['subtitulo'] = 'Provincia de ' . get_post_meta(get_the_ID(), '_provincia', true);
         $datos['parametros'] = '&provincia_id=' . get_post_meta(get_the_ID(), '_provincia_id', true) . '&canton_id=' . get_post_meta(get_the_ID(), '_canton_id', true);
         $datos['dpcr_nombre'] = get_post_meta(get_the_ID(), '_canton', true);
      } else {
         $datos['parametros'] = '&provincia_id=' . get_post_meta(get_the_ID(), '_provincia_id', true);
         $datos['dpcr_nombre'] = get_post_meta(get_the_ID(), '_provincia', true);
      }

      $parametros_btn_regresar = $_SERVER['QUERY_STRING'];
      $totalParametros = count(explode('&', $parametros_btn_regresar));

      switch ($totalParametros) {
         case 2:
            $datos['parametros_btn_regresar'] = strstr($parametros_btn_regresar, '&provincia_id', true);
            break;
         case 3:
            $datos['parametros_btn_regresar'] = strstr($parametros_btn_regresar, '&canton_id', true);
            break;

         case 4:
            $datos['parametros_btn_regresar'] = strstr($parametros_btn_regresar, '&distrito_id', true);
            break;

         case 5:
            $datos['parametros_btn_regresar'] = strstr($parametros_btn_regresar, '&barrio_id', true);
            break;

         default:
            $datos['parametros_btn_regresar'] = '';
            break;
      }

      $datos['btn_regresar'] = "modules/$postType/view/$postType-btn-regresar";


      return $datos;
   }
   public function dpcr_pre_get_posts($query)
   {
      /*<pre><?php print_r($GLOBALS['wp_query']->request); ?></pre>*/
      if ($query->is_main_query() && !is_admin()) {
         if (is_post_type_archive('dpcr')) {
            $query->set('posts_per_page', 52);
            if (isset($_GET['provincia_id']) && isset($_GET['canton_id']) && isset($_GET['distrito_id'])) {
               $provincia_id = sanitize_text_field($_GET['provincia_id']);
               $canton_id = sanitize_text_field($_GET['canton_id']);
               $distrito_id = sanitize_text_field($_GET['distrito_id']);
               $meta_key = '_barrio';
               $meta_query =
                  [
                     [
                        'key' => '_provincia_id',
                        'value' => $provincia_id,
                     ],
                     [
                        'key' => '_canton_id',
                        'value' => $canton_id,
                     ],
                     [
                        'key' => '_distrito_id',
                        'value' => $distrito_id,
                     ]
                  ];

               $query->set('meta_query', $meta_query);
               $query->set('meta_key', $meta_key);
               add_filter('posts_groupby', function ($groupby) {
                  global $wpdb;
                  return "{$wpdb->postmeta}.meta_value";
               });
               $query->set('orderby', 'meta_value');
               $query->set('order', 'ASC');
            } elseif (isset($_GET['provincia_id']) && isset($_GET['canton_id'])) {
               $provincia_id = sanitize_text_field($_GET['provincia_id']);
               $canton_id = sanitize_text_field($_GET['canton_id']);
               $meta_key = '_distrito';
               $meta_query =
                  [
                     [
                        'key' => '_provincia_id',
                        'value' => $provincia_id,
                     ],
                     [
                        'key' => '_canton_id',
                        'value' => $canton_id,
                     ]
                  ];

               $query->set('meta_query', $meta_query);
               $query->set('meta_key', $meta_key);
               add_filter('posts_groupby', function ($groupby) {
                  global $wpdb;
                  return "{$wpdb->postmeta}.meta_value";
               });
               $query->set('orderby', 'meta_value');
               $query->set('order', 'ASC');
            } elseif (isset($_GET['provincia_id'])) {
               $provincia_id = sanitize_text_field($_GET['provincia_id']);
               $meta_key = '_canton';
               $meta_query =
                  [
                     [
                        'key' => '_provincia_id',
                        'value' => $provincia_id,
                     ]
                  ];

               $query->set('meta_query', $meta_query);
               $query->set('meta_key', $meta_key);
               add_filter('posts_groupby', function ($groupby) {
                  global $wpdb;
                  return "{$wpdb->postmeta}.meta_value";
               });
               $query->set('orderby', 'meta_value');
               $query->set('order', 'ASC');
            } else {
               $meta_key = '_provincia';
               $query->set('meta_key', $meta_key);
               add_filter('posts_groupby', function ($groupby) {
                  global $wpdb;
                  return "{$wpdb->postmeta}.meta_value";
               });
               $query->set('orderby', 'meta_value');
               $query->set('order', 'ASC');
            }
         }
      }
   }
   public function dpcr_get_provincias()
   {
      global $wpdb;

      $sql =
         "SELECT DISTINCT t1.meta_value AS ID, t2.meta_value AS provincia
            FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta t1
               ON (ID = t1.post_id)
            INNER JOIN $wpdb->postmeta t2
               ON (ID = t2.post_id)
            WHERE post_type = 'dpcr'
               AND (t1.meta_key = '_provincia_id' AND t1.meta_value !='')
               AND (t2.meta_key = '_provincia' AND t2.meta_value !='')
            ORDER BY t2.meta_value
            ";

      $provincias = $wpdb->get_results($sql, ARRAY_A);
      return $provincias;
   }
   public function dpcr_get_cantones()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'cantones')) {
         wp_send_json_error('Error de seguridad', 401);
         wp_die();
      } else {
         $provincia_id = sanitize_text_field($_POST['provincia_id']);
         global $wpdb;

         $sql =
            "SELECT DISTINCT t1.meta_value AS ID, t2.meta_value AS canton
            FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta t1
               ON (ID = t1.post_id)
            INNER JOIN $wpdb->postmeta t2
               ON (ID = t2.post_id)
            INNER JOIN $wpdb->postmeta t3
               ON (ID = t3.post_id)
            WHERE post_type = 'dpcr'
               AND (t1.meta_key = '_canton_id' AND t1.meta_value !='')
               AND (t2.meta_key = '_canton' AND t2.meta_value !='')
               AND (t3.meta_key = '_provincia_id' AND t3.meta_value = $provincia_id)
            ORDER BY t2.meta_value
            ";

         $cantones = $wpdb->get_results($sql, ARRAY_A);
         wp_send_json_success($cantones);
      }
   }
   public function dpcr_get_distritos()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'distritos')) {
         wp_send_json_error('Error de seguridad', 401);
         wp_die();
      } else {
         $provincia_id = sanitize_text_field($_POST['provincia_id']);
         $canton_id = sanitize_text_field($_POST['canton_id']);
         global $wpdb;

         $sql =
            "SELECT DISTINCT t1.meta_value AS ID, t2.meta_value AS distrito
            FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta t1
               ON (ID = t1.post_id)
            INNER JOIN $wpdb->postmeta t2
               ON (ID = t2.post_id)
            INNER JOIN $wpdb->postmeta t3
               ON (ID = t3.post_id)
            INNER JOIN $wpdb->postmeta t4
               ON (ID = t4.post_id)
            WHERE post_type = 'dpcr'
               AND (t1.meta_key = '_distrito_id' AND t1.meta_value != '')
               AND (t2.meta_key = '_distrito' AND t2.meta_value != '')
               AND (t3.meta_key = '_canton_id' AND t3.meta_value = $canton_id)
               AND (t4.meta_key = '_provincia_id' AND t4.meta_value = $provincia_id)
            ORDER BY t2.meta_value
            ";

         $distritos = $wpdb->get_results($sql, ARRAY_A);
         wp_send_json_success($distritos);
      }
   }
   public function dpcr_get_barrios()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'barrios')) {
         wp_send_json_error('Error de seguridad', 401);
         wp_die();
      } else {
         $provincia_id = sanitize_text_field($_POST['provincia_id']);
         $canton_id = sanitize_text_field($_POST['canton_id']);
         $distrito_id = sanitize_text_field($_POST['distrito_id']);
         global $wpdb;

         $sql =
            "SELECT DISTINCT t1.meta_value AS ID, t2.meta_value AS barrio
            FROM $wpdb->posts
            INNER JOIN $wpdb->postmeta t1
               ON (ID = t1.post_id)
            INNER JOIN $wpdb->postmeta t2
               ON (ID = t2.post_id)
            INNER JOIN $wpdb->postmeta t3
               ON (ID = t3.post_id)
            INNER JOIN $wpdb->postmeta t4
               ON (ID = t4.post_id)
            INNER JOIN $wpdb->postmeta t5
               ON (ID = t5.post_id)
            WHERE post_type = 'dpcr'
               AND (t1.meta_key = '_barrio_id' AND t1.meta_value != '')
               AND (t2.meta_key = '_barrio' AND t2.meta_value != '')
               AND (t3.meta_key = '_distrito_id' AND t3.meta_value = $distrito_id)
               AND (t4.meta_key = '_canton_id' AND t4.meta_value = $canton_id)
               AND (t5.meta_key = '_provincia_id' AND t5.meta_value = $provincia_id)
            ORDER BY t2.meta_value
            ";

         $barrios = $wpdb->get_results($sql, ARRAY_A);
         wp_send_json_success($barrios);
      }
   }
   public function dpcr_registrar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'dpcr_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         wp_send_json_success(['titulo' => 'Artículo Registrado', 'msg' => 'La división política ha sido registrada correctamente.']);
      }
   }
   public function dpcr_editar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'dpcr_mantenimiento')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         wp_send_json_success(['titulo' => 'Artículo Editado', 'msg' => 'Las modificaciones de la división política se han registrado correctamente.']);
      }
   }
   public function dpcr_borrar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'dpcr_mantenimiento')) {
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
         wp_send_json_success(['titulo' => 'División Política Borrada', 'msg' => 'La división política ha sido borrada correctamente.']);
      }
   }
}
