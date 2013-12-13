<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
	<?php wp_title('&laquo;', true, 'right'); ?>
	<?php bloginfo('name'); ?>
	</title>
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/styles.css">
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/font-awesome.min.css">
	
	
	<link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700|Pontano+Sans&subset=latin,greek-ext,latin-ext' rel='stylesheet' type='text/css'>
	
	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
	<script src="<?php bloginfo('template_directory'); ?>/js/jquery.flexslider.js" type="text/javascript"></script>
	
</head>

<body <?php body_class(); ?>>

<div id="header">
	<div class="container">
		<div class="logo">
			<a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_directory'); ?>/img/logo-alexandre-mareuil.svg" type="image/svg+xml"></a>
		</div>
		<div class="aside">
			<div class="search">
				<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
						<div>
							<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php _e( 'Search', 'woocommerce' ); ?>" />
							<input type="hidden" id="searchsubmit" value="<?php echo esc_attr__( 'Zoeken' ); ?>" />
							<input type="hidden" name="post_type" value="product" />
						</div>
					</form>
			</div>
			<div class="language">
			<ul>
				<?php
					if( function_exists('icl_get_languages') ):
					    $languages = icl_get_languages('skip_missing=1');
					      
					    foreach($languages as $language) {
				
					        if($language['active']) {
					            $link .= '<li><a href="' . $language['url'] . '" class="current">' . $language['native_name'] . '</a></li> ';
					      
					        } else {
					            $link .= '<li><a href="' . $language['url'] . '">' . $language['native_name'] . '</a></li> ';
					        }
					    }
					    echo $link;
					endif;
				?>	
			</ul>
		</div>
			<div class="fnav">
			<?php
				$defaults = array(
					'theme_location'  => '',
					'menu'            => 'fnav-fr',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'fnav',
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
			?>
		</div>
		</div>
		<div class="mnav">
			<?php {
				$defaults = array(
					'theme_location'  => '',
					'menu'            => 'mnav-en',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => '',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
				);
				wp_nav_menu( $defaults ); }
			?>

		</div>
	</div>
</div>

