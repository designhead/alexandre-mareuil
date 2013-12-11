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

	/**
	 *	Determine what the current category to highlight
	 */
	$current_category = 0; $current_term = null;
	if ( is_singular('product') ) {
		$terms = get_the_terms(get_the_ID(), 'product_cat');

		// get the first term returned.
		foreach($terms as $_term){
			$current_term = $_term;
			break;
		}
		$current_category = $current_term->term_id;

	} elseif ( is_product_category() ) {
		$current_term = get_queried_object();
		$current_category = $current_term->term_id;
	}

	$output = wp_list_categories(array(
		'taxonomy' => 'product_cat',
		'title_li' => '',
		'style' => 'list',
		'current_category' => $current_category,
		'hide_empty' => false,
		'echo' => false
	));

	/**
	 *	If we have a current category
	 */
	if( is_object( $current_term ) ) {
		$term_ids = get_ancestors($current_term->term_id, 'product_cat');

		foreach($term_ids as $ancestor) {
			$pattern = '/(cat-item-'.$ancestor.')/';
			$output = preg_replace ( $pattern, '$1 current-cat-ancestor', $output );
		}
	}

  echo '<div id="content">';
  echo '<div class="container">';
  echo '<div class="sidebar left">';
  echo '<ul class="categories">';

	echo $output;

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
function alex_mareuil_set_boutique($template){

	if( is_page() )
		boutique_off();

	if( strpos ( $template, 'archive-product.php' ) ||
		( isset( $_GET['boutique'] ) && 'on' == $_GET['boutique'] ) ) {
		boutique_on();
	}

	if( isset( $_GET['boutique'] ) && 'off' == $_GET['boutique'] )
		boutique_off();

	return $template;
}
add_filter('template_include', 'alex_mareuil_set_boutique', 999);

function boutique_on() {
	$_SESSION['boutique'] = true;
}

function boutique_off() {
	$_SESSION['boutique'] = false;
}

function is_boutique(){

 	if( ! isset( $_SESSION['boutique'] ) ){
 		boutique_off();
 	}

 	return $_SESSION['boutique'];
}


?>