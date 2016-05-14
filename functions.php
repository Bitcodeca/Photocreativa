<?php
/*
	==========================================
	 Include scripts
	==========================================
*/
function awesome_script_enqueue() {
	//css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
    wp_enqueue_style('fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0', 'all');
	wp_enqueue_style('jgallery', get_template_directory_uri() . '/css/jgallery.css', array(), '1.0.0', 'all');
	wp_enqueue_style('jgallerymin', get_template_directory_uri() . '/css/jgallery.min.css', array(), '1.0.0', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/awesome.css', array(), '1.0.0', 'all');
	//js
	wp_enqueue_script('jquery', 'http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js', array(), '1.0.0', true);
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.4', true);
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/awesome.js', array(), '1.0.0', true);
	wp_enqueue_script('isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '1.0.0', true);
	wp_enqueue_script('fancyboxjs', get_template_directory_uri() . '/js/jquery.fancybox.js', array(), '1.0.0', true);
	wp_enqueue_script('mixitupjs',  'http://cdn.jsdelivr.net/jquery.mixitup/latest/jquery.mixitup.min.js?v=2.1.9', array(), '1.0.0', true);
	wp_enqueue_script('mixituppaginationjs',  'http://tseoc.co.uk/chris/jquery.mixitup-pagination.min.js', array(), '1.0.0', true);
	wp_enqueue_script('jgalleryminjs', get_template_directory_uri() . '/js/jgallery.min.js', array(), '1.0.0', true);
	wp_enqueue_script('touchswipejs', get_template_directory_uri() . '/js/touchswipe.min.js', array(), '1.0.0', true);
}

add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/
function awesome_theme_setup() {
	
	add_theme_support('menus');
	
	register_nav_menu('primary', 'Nav principal');
	register_nav_menu('secondary', 'Nav secundario');
	
}

add_action('init', 'awesome_theme_setup');

/*
	==========================================
	 Theme support function
	==========================================
*/
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_action( 'init', 'album_taxonomy', 0 );

function album_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'albums', 'taxonomy general name' ),
    'singular_name' => _x( 'album', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search albums' ),
    'popular_items' => __( 'Popular albums' ),
    'all_items' => __( 'All albums' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit album' ), 
    'update_item' => __( 'Update album' ),
    'add_new_item' => __( 'Add New album' ),
    'new_item_name' => __( 'New album Name' ),
    'separate_items_with_commas' => __( 'Separate albums with commas' ),
    'add_or_remove_items' => __( 'Add or remove albums' ),
    'choose_from_most_used' => __( 'Choose from the most used albums' ),
    'menu_name' => __( 'Albums' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('albums','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'album' ),
  ));
}
add_action( 'init', 'cover_taxonomy', 0 );

function cover_taxonomy() {

// Labels part for the GUI

  $labels = array(
    'name' => _x( 'covers', 'taxonomy general name' ),
    'singular_name' => _x( 'cover', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search covers' ),
    'popular_items' => __( 'Popular covers' ),
    'all_items' => __( 'All covers' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit cover' ), 
    'update_item' => __( 'Update cover' ),
    'add_new_item' => __( 'Add New cover' ),
    'new_item_name' => __( 'New cover Name' ),
    'separate_items_with_commas' => __( 'Separate covers with commas' ),
    'add_or_remove_items' => __( 'Add or remove covers' ),
    'choose_from_most_used' => __( 'Choose from the most used covers' ),
    'menu_name' => __( 'Covers' ),
  ); 

// Now register the non-hierarchical taxonomy like tag

  register_taxonomy('covers','post',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cover' ),
  ));
}

function my_custom_sliders_posttype(){
   $args = array(
   'labels'=> array( 'name'=>'sliders',
       'singular_name'=> 'slider',
       'menu_name'=>'Sliders',
       'name_admin_bar'=> 'sliders',
       'all_items' =>'View all sliders',
       'add_new'=> 'Add New sliders' ),
   'description' =>"This post type is for sliders",
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt',
    ),
   'query_var'=>true,
  );
  register_post_type( "sliders", $args );
 }
 add_action("init","my_custom_sliders_posttype");
 
 function filmpost(){
   $args = array(
   'labels'=> array( 'name'=>'film',
       'singular_name'=> 'film',
       'menu_name'=>'Film',
       'name_admin_bar'=> 'film',
       'all_items' =>'View all Films',
       'add_new'=> 'Add New Film' ),
   'description' =>"This post type is for Films",
   'taxonomies' => array('category'),
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
   'query_var'=>true,
  );
  register_post_type( "film", $args );
 }
 add_action("init","filmpost");
 
 function designpost(){
   $args = array(
   'labels'=> array( 'name'=>'design',
       'singular_name'=> 'design',
       'menu_name'=>'Design',
       'name_admin_bar'=> 'design',
       'all_items' =>'View all Design',
       'add_new'=> 'Add New Design' ),
   'description' =>"This post type is for Design",
   'taxonomies' => array('category', 'albums', 'covers'),
   'public' => true,
   'exclude_from_search'=>false,
   'publicly_queryable'=> true,
   'show_ui' => true,
   'show_in_menu'=> true,
   'show_in_admin_bar'=> true,
   'menu_position'=>6,
   'capability_type'=> 'page',
   'supports'=> array( 'title', 'editor', 'author', 'thumbnail', 'excerpt'),
   'query_var'=>true,
  );
  register_post_type( "design", $args );
 }
 add_action("init","designpost");
 
 /******************************************************************************
 * Enable Bootstrap Active Class In Navigation Menu
 *****************************************************************************/
class Bootstrap_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() )
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu dropdown-menu\">\n";
    }

    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        if($item->current || $item->current_item_ancestor || $item->current_item_parent){
            $class_names .= ' active';
        }
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names .'>';
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
        $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
        $atts['href']   = ! empty( $item->url )        ? $item->url        : '';
        $atts['class']  = ($item->hasChildren)         ? 'dropdown-toggle' : '';
        $atts['data-toggle']  = ($item->hasChildren)   ? 'dropdown'        : '';
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        if( $item->hasChildren) {
            $item_output .= ' <b class="caret"></b>';
        }
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
update_option('image_default_link_type','none');
