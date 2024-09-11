<?php

namespace MYDOMAIN\Modules\Core;

/**
 * 
 * Clase Core
 * 
 * @package MYDOMANIN
 * 
 */

use MYDOMAIN\Modules\Post\PostController;

class CoreController
{
   use Singleton;
   private $atributos;
   private function __construct()
   {
      require_once MYDOMAIN_DIR_PATH . "/modules/core/walker.php";
      require_once MYDOMAIN_DIR_PATH . "/modules/core/view/core-comments-cbk.php";

      $this->atributos = [];
      ThemeSetup::get_instance();
      PostController::get_instance();
      $this->set_paginas();
      add_action('wp_ajax_nopriv_ingresar', [$this, 'MYDOMAIN_ingresar']);
      add_action('wp_ajax_ingresar', [$this, 'MYDOMAIN_ingresar']);
      add_action('wp_ajax_cambiar_clave', [$this, 'MYDOMAIN_cambiar_clave']);
      add_action('wp_ajax_csvfile', [$this, 'MYDOMAIN_csvfile']);
   }
   public function set_atributo($parametro, $valor)
   {
      $this->atributos[$parametro] = $valor;
   }
   public function get_atributo($parametro)
   {
      return $this->atributos[$parametro];
   }
   public function get_datos()
   {
      $postType = get_post_type();
      if (isset($_GET['cpt'])) {
         $postType = sanitize_text_field($_GET['cpt']);
      } else {
         if (get_post_type() == 'page') {
            $PrefijoPage = substr(get_post(get_the_ID())->post_name, 0, strpos(get_post(get_the_ID())->post_name, '-'));
            if (isset(MYDOMAIN_CPT_MODULO[$PrefijoPage])) {
               $postType = $PrefijoPage;
            }
         }
      }
      if (is_user_logged_in()) {
         $usuarioRoles = wp_get_current_user()->roles;
         if (in_array('administrator', $usuarioRoles)) {
            $datos['nivel_acceso'] = 100;
         } elseif (in_array('useradmingeneral', $usuarioRoles)) {
            $datos['nivel_acceso'] = 100;
         } elseif (in_array('subscriber', $usuarioRoles)) {
            $datos['nivel_acceso'] = 10;
         } else {
            $datos['nivel_acceso'] = 0;
         }
      } else {
         $datos['nivel_acceso'] = 10;
         /*
         $user = new \WP_User(1);
         $user->remove_role('subscriber');
         $user->add_role('subscriber');
         */
      }
      $datos['post_type'] = $postType;

      $datos['bg-html'] = 'bg-dark';
      $datos['body-style'] = '';
      $datos['body'] = 'bg-dark bg-gradient text-white';
      $datos['banner'] = 'modules/core/view/core-banner';
      $datos['navbar'] = 'modules/core/view/core-navbar';
      $datos['section'] = '';
      $datos['section-style'] = '';
      $datos['div1'] = 'container';
      $datos['div2'] = 'row';
      $datos['div3'] = 'col-12 col-xl-3';
      $datos['sidebarlefttemplate'] = 'modules/core/view/core-sidebarleft';
      $datos['div4'] = 'col-12 col-xl-6';
      $datos['div5'] = '';
      $datos['div6'] = '';
      $datos['div7'] = '';
      $datos['templatepart'] = (is_page()) ? 'modules/core/view/' . get_post(get_the_ID())->post_name : '';
      $datos['comentarios'] = true;
      $datos['navegacion'] = true;
      $datos['templatepartnone'] = 'modules/core/view/core-templatepartnone';
      $datos['div8'] = 'col-12 col-xl-3';
      $datos['sidebarrighttemplate'] = 'modules/core/view/core-sidebarright';
      $datos['footerclass'] = 'container pt-5';
      $datos['footertemplate'] = 'modules/core/view/core-footer';

      $datos['pag'] = $this->get_pags()['pag'];
      $datos['pag_ant'] = $this->get_pags()['pag_ant'];
      $datos['imagen'] = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : MYDOMAIN_DIR_URI . '/assets/img/bg.jpg';
      $datos['height'] = '60dvh';
      $datos['fontweight'] = 'fw-lighter';
      $datos['display'] = 'display-3';
      $datos['titulo'] = get_the_title();
      $datos['displaysub'] = 'display-4';
      $datos['subtitulo'] = '';
      $datos['displaysub2'] = 'display-5';
      $datos['subtitulo2'] = '';

      $datos['redireccion'] = '/';
      $datos['logoSize'] = '50px';
      $datos['classLogo'] = 'rounded-circle';
      $datos['commentsTemplate'] = '/modules/core/view/core-comments.php';
      $datos['templatepartdenegado'] = 'modules/core/view/core-denegado';
      $datos['regresar'] = $postType;
      $datos['btn_regresar'] = is_single() ? 'modules/core/view/core-btn-regresar' : '';

      $atributosModulos = $this->get_datos_modulos($postType);

      $this->atributos = array_replace_recursive($datos, $atributosModulos);

      return $this->atributos;
   }
   private function get_datos_modulos($postType)
   {
      $datos = [];
      switch ($postType) {
         case 'page':
            $datos = $this->get_datos_page();
            break;

         case 'post':
            $datos = PostController::get_instance()->get_atributos();
            break;

         default:
            if (isset($_GET['cpt']) || in_array($postType, [])) {
               $titulo = 'No hay un información registrada';
            } else {
               $titulo = 'Página no existe';
            }
            $datos['navbar'] = 'modules/core/view/navbar';
            $datos['height'] = '100dvh';
            $datos['titulo'] = $titulo;
            $datos['sidebarlefttemplate'] = '';
            $datos['sidebarrightclass'] = '';
            $datos['sidebarrighttemplate'] = '';
            $datos['agregarpost'] = '';
            $datos['footerclass'] = '';
            $datos['footertemplate'] = '';
            break;
      }

      return $datos;
   }
   public function get_datos_page()
   {
      $datos['height'] = '60dvh';
      $datos['agregarpost'] = '';
      $datos['div6'] = 'my-5';

      if (is_front_page() || is_page('core-principal') || is_page('core-login')) {
         $datos['height'] = '100dvh';
         $datos['section'] = '';
         $datos['div1'] = '';
         $datos['div2'] = '';
         $datos['agregarpost'] = '';
         $datos['div3'] = '';
         $datos['div4'] = '';
         $datos['div5'] = '';
         $datos['div6'] = '';
         $datos['div7'] = '';
         $datos['div8'] = '';
         $datos['sidebarlefttemplate'] = '';
         $datos['sidebarrighttemplate'] = '';
         if (is_page('core-login')) {
            if (is_user_logged_in()) {
               $datos['titulo'] = 'Ya se encuentra ingresado';
            } else {
               $datos['banner'] = '';
               $datos['navbar'] = '';
               $datos['titulo'] = '';
            }
         }
         $datos['footerclass'] = '';
         $datos['footertemplate'] = '';
      }
      return $datos;
   }
   private function get_pags()
   {
      $pags = [];
      if (isset(explode("/", $_SERVER['REQUEST_URI'])[3])) {
         if (explode("/", $_SERVER['REQUEST_URI'])[3] != '') {
            if (explode("/", $_SERVER['REQUEST_URI'])[3] == 'page') {
               $pags['pag'] = 0;
            } else {
               $pags['pag'] = explode("/", $_SERVER['REQUEST_URI'])[3];
            }
         } else {
            $pags['pag'] = 0;
         }
      } else {
         $pags['pag'] = 1;
      }
      if (isset($_GET['pag'])) {
         $pags['pag_ant'] = sanitize_text_field($_GET['pag']);
         if ($pags['pag_ant'] == 0) {
            $pags['pag_ant'] = 1;
         }
      } else {
         $pags['pag_ant'] = 1;
      }
      return $pags;
   }
   private function set_paginas()
   {
      $paginas = [
         'principal' =>
         [
            'slug' => 'core-principal',
            'titulo' => 'Página Principal'
         ],
         'blog' =>
         [
            'slug' => 'blog',
            'titulo' => 'Blog'
         ],
         'cambio_clave' =>
         [
            'slug' => 'core-cambio-clave',
            'titulo' => 'Cambio de Contraseña'
         ],
         'login' =>
         [
            'slug' => 'core-login',
            'titulo' => 'Login'
         ],
         'csvfile' =>
         [
            'slug' => 'core-cpt-import',
            'titulo' => 'Importar Datos'
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
   public function MYDOMAIN_ingresar()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'frm_ingreso')) {
         wp_send_json_error('Error de seguridad', 401);
         wp_die();
      } else {
         $credenciales = array();
         $credenciales['user_login'] = $_POST['usuario'];
         $credenciales['user_password'] = $_POST['clave'];
         $credenciales['remember'] = true;
         $ingresar = wp_signon($credenciales, false);
         if (is_wp_error($ingresar)) {
            wp_send_json_error(['titulo' => 'Error', 'msg' => 'El usuario y la contraseña no coinciden.']);
         } else {
            wp_send_json_success(['titulo' => 'Ingreso', 'msg' => 'Se validaron las credenciales correctamente.']);
         }
      }
   }
   public function MYDOMAIN_cambiar_clave()
   {

      if (!wp_verify_nonce($_POST['nonce'], 'cambiar_clave')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         if (isset($_POST['clave_actual'])) {
            $clave_actual = sanitize_text_field($_POST['clave_actual']);
            $clave_nueva = sanitize_text_field($_POST['clave_nueva']);
            $clave_nueva2 = sanitize_text_field($_POST['clave_nueva2']);
            $user_id = get_current_user_id();
            $current_user = get_user_by('id', $user_id);
            if ($current_user && wp_check_password($clave_actual, $current_user->data->user_pass, $current_user->ID)) {
               if ($clave_nueva != $clave_nueva2) {
                  wp_send_json_error(['titulo' => 'Error', 'msg' => 'No coincide la nueva clave y su confirmación.']);
               } else {
                  wp_set_password($clave_nueva, $current_user->ID);
                  wp_send_json_success('Cambio clave exitoso');
               }
            } else {
               wp_send_json_error(['titulo' => 'Error', 'msg' => 'La clave actual es incorrecta.']);
            }
         } else {
            wp_send_json_error(['titulo' => 'Error', 'msg' => 'Error en la información.']);
         }
      }
   }
   public function MYDOMAIN_csvfile()
   {
      if (!wp_verify_nonce($_POST['nonce'], 'csvfile')) {
         wp_send_json_error('Error de seguridad', 401);
      } else {
         $campos = [];
         $registro = 0;
         $post_fields = [];
         $post_meta = [];
         $args = [];

         if (($file = fopen($_FILES['csvfile']['tmp_name'], "r")) !== FALSE) {
            $campos = fgetcsv($file);
            $contador = 1;
            while (($data = fgetcsv($file)) !== false) {
               $registro = count($campos);
               $primerRegistro = true;
               for ($i = 0; $i < $registro; $i++) {
                  if ($primerRegistro && ctype_digit($data[$i])) {
                     $post_fields['import_id'] = $data[$i];
                  } elseif (substr(trim($campos[$i]), 0, 4) === 'post') {
                     $post_fields[$campos[$i]] = $data[$i];
                  } else {
                     $post_meta[$campos[$i]] = $data[$i];
                  }
                  $primerRegistro = false;
               }
               if (count($post_meta)) {
                  $args = array_merge($post_fields, array('meta_input' => $post_meta));
               } else {
                  $args = $post_fields;
               }
               wp_insert_post($args);
               $contador++;
            }
            wp_send_json_success(['titulo' => 'Procesado', 'msg' => "El archivo fue procesado exitosamente. ($contador)", 'args' => $args]);
         } else {
            wp_send_json_error(['titulo' => 'Error', 'msg' => 'Archivo no encontrado.']);
         }
         fclose($file);
         die();
      }
   }
}
