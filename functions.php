<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );
add_theme_support( 'woocommerce' );


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

add_action( 'init', 'jk_remove_wc_breadcrumbs' );
function jk_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

add_action( 'woocommerce_single_product_summary','the_content', 9 );

function my_theme_wrapper_start() {

	$current_category = 0; $current_term = null;
	if ( is_singular('product') ) {
		$terms = get_the_terms(get_the_ID(), 'product_cat');

		foreach($terms as $term){
			if( '0' == $term->parent ) {
				$current_term = $term;
				break;
			}
		}
	} elseif ( is_product_category() ) {
		$current_term = get_queried_object();
	}

	if( is_object( $current_term ) ) {
		$ancestors = get_ancestors($current_term, 'product-cat');

		$current_category = $current_term->term_id;
	}

  echo '<div id="content">';
  echo '<div class="container">';
  echo '<div class="sidebar left">';
  echo '<ul class="categories">';
  wp_list_categories(array('taxonomy' => 'product_cat', 'title_li' => '','style' => 'list','current_category' => $current_category, 'hide_empty' => true));
  echo '</ul>';
  echo '</div>';
  echo '<div class="shop">';
}

function my_theme_wrapper_end() {
  echo '</div>';
  echo '<div class="sidebar right">';
  $defaults = array(
	'theme_location'  => '',
	'menu'            => 'shop-fr',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'shop',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => '',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 1,
	'walker'          => ''
	);
  wp_nav_menu( $defaults );
  echo '</div>';
  echo '</div>';
  echo '</div>';
}

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

/**
 *	Switch between boutique modes
 */
session_start();
function alex_mareuil_set_boutique(){
	global $post;

	if ( is_admin() ) return;

	if( is_page() ) { //is_page( woocommerce_get_page_id( 'shop' ))
		// turn off boutique presentation
		$_SESSION['boutique'] = false;

		// determine if we are on the "boutique" or "shop" page
		$boutique = get_page_by_path('boutique'); // get the boutique page id

		$boutique_fr = icl_object_id($post->ID, 'page', true, 'fr'); // translate the id of the current page to french

		if( $boutique == $boutique_fr ) $_SESSION['boutique'] = true;

	}

}
add_action('init', 'alex_mareuil_set_boutique');

function is_boutique(){

 	if( ! isset( $_SESSION['boutique'] ) ){
 		$_SESSION['boutique'] = false;
 	}

 	return $_SESSION['boutique'];
}


?>