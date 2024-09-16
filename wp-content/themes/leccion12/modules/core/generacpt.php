<?php

namespace MYDOMAIN\Modules\Core;

class GeneraCPT
{
   use Singleton;

   private $atributos;

   function __construct()
   {
      add_action('init', [$this, 'add_custom_post_types']);
   }

   function add_custom_post_types()
   {

      $this->atributos =
         [
            'dpcr' => [
               "plural" => "dpcrs",
               "icon"   => "dashicons-book"
            ],
         ];

      foreach ($this->atributos as $type => $data) {

         $labels = array(
            'name'                  => _x(ucfirst($type), 'Post Type General Name', 'EGC000'),
            'singular_name'         => _x(ucfirst($type), 'Post Type Singular Name', 'EGC000'),
            'menu_name'             => __(ucfirst($data['plural']), 'EGC000'),
            'name_admin_bar'        => __(ucfirst($data['plural']), 'EGC000'),
            'add_new'               => __('Agregar', 'EGC000'),
            'add_new_item'          => __('Agregar nuevo(a)', 'EGC000'),
            'new_item'              => __('Nuevo(a)', 'EGC000'),
            'edit_item'             => __('Editar', 'EGC000'),
            'update_item'           => __('Actualizar', 'EGC000'),
            'view_item'             => __('Ver ' . $type, 'EGC000'),
            'view_items'            => __('Ver ' . $data['plural'], 'EGC000'),
            'all_items'             => __('Todos(as)', 'EGC000'),
            'search_items'          => __('Buscar ' . $type, 'EGC000'),
            'parent_item_colon'     => __(ucfirst($data['plural']) . ' padre:', 'EGC000'),
            'not_found'             => __("No hay $type", 'EGC000'),
            'not_found_in_trash'    => __("No hay $type", 'EGC000'),
            'archives'              => __('Archivo ' . $data['plural'], 'EGC000'),
            'attributes'            => __('Atributos ' . $type, 'EGC000'),
            'insert_into_item'      => __('Insertar ' . $type, 'EGC000'),
            'uploaded_to_this_item' => __('Subir ' . $type, 'EGC000'),
            'items_list'            => __('Lista ' . $type, 'EGC000'),
            'items_list_navigation' => __('Navegación ' . $data['plural'], 'EGC000'),
            'filter_items_list'     => __('Filtro ' . $data['plural'], 'EGC000'),
         );

         $rewrite = array(
            'slug'       => $type,
            'with_front' => true,
            'pages'      => true,
            'feeds'      => true,
         );
         //title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', 'post-formats
         $args = array(
            'label'               => __(ucfirst($type), 'EGC000'),
            'description'         => __('Contenido de ' . $data['plural'], 'EGC000'),
            'labels'              => $labels,
            'supports'            => array('title', 'editor', 'thumbnail', 'custom-fields', 'comments', 'author', 'post-formats'),
            'taxonomies'          => $data['taxonomies'] ?? [],
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_icon'           => $data['icon'],
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'rewrite'             => $rewrite,
            'capability_type'     => [$type, $data['plural']],
            'map_meta_cap'        => true,
            'show_in_rest'        => true,
            'rest_base'           => $data['plural'],

         );

         register_post_type($type, $args);

         $admin = get_role('administrator');
         $capabilities = $this->get_capacidades($type, $data['plural']);
         foreach ($capabilities as $capability) {
            if (!$admin->has_cap($capability)) {
               $admin->add_cap($capability);
            }
         }
      }
      flush_rewrite_rules();
   }
   private function get_capacidades($singular, $plural)
   {
      $capacidades = [
         'edit_post' => "edit_$singular",
         'read_post' => "read_$singular",
         'delete_post' => "delete_$singular",
         'edit_posts' => "edit_$plural",
         'edit_others_posts' => "edit_others_$plural",
         'publish_posts' => "publish_$plural",
         'read_private_posts' => "read_private_$plural",
         'read' => "read",
         'delete_posts' => "delete_$plural",
         'delete_private_posts' => "delete_private_$plural",
         'delete_published_posts' => "delete_published_$plural",
         'delete_others_posts' => "delete_others_$plural",
         'edit_private_posts' => "edit_private_$plural",
         'edit_published_posts' => "edit_published_$plural",
         'create_posts' => "edit_$plural",
      ];
      return $capacidades;
   }
}
