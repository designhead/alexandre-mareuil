<div id="footer">
	<?php
		$defaults = array(
			'theme_location'  => '',
			'menu'            => 'footer-fr',
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
			'depth'           => 1,
			'walker'          => ''
		);
		wp_nav_menu( $defaults );
	?>
</div>

	<?php

global $post;     // if outside the loop

if ( is_shop() ) {
    echo '<div class="bg shop"></div>';

}
elseif ( is_product_category() ) {
    echo '<div class="bg shop"></div>';
}
elseif ( is_product() ) {
    echo '<div class="bg shop"></div>';
}
elseif ( is_product_tag() ) {
    echo '<div class="bg shop"></div>';
}
elseif ( is_cart() ) {
    echo '<div class="bg shop"></div>';
}
elseif ( is_checkout() ) {
    echo '<div class="bg shop"></div>';
}
elseif ( is_account_page() ) {
    echo '<div class="bg shop"></div>';
}
else {
    echo '<div class="bg"></div>';
}
?>

<!-- Start Google Analytics implementation -->
<script type="text/javascript">
  function ccAddAnalytics(){
    $.getScript('http://www.google-analytics.com/ga.js', function() { 
      var GATracker = _gat._createTracker('UA-XXXXXXX-X');
      GATracker._trackPageview(); 
    } );
  }; 
</script>
<!-- End Google Analytics implementation -->

<?php wp_footer(); ?>

</body></html>