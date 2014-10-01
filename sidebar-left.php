<?php
/*
* 
* The Sidebar containing the main widget areas. 
* 
* @package cwp-megaresponsive-pro
*/
?>
<div id="secondary" class="widget-area" role="complementary">
	<?php 
		if ( is_active_sidebar( 'sidebar-2' ) ) :
			
			dynamic_sidebar( 'sidebar-2' );

		else: ?>
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
				<aside id="archives" class="widget">
					<h1 class="widget-title"><?php _e( 'Archives', 'cwp-megaresponsive-pro' ); ?></h1>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
				<aside id="meta" class="widget">
					<h1 class="widget-title"><?php _e( 'Meta', 'cwp-megaresponsive-pro' ); ?></h1>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>
	<?php endif; ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
    	
		<?php 
			wp_nav_menu( array( 
								'container'       => 'div',
								'container_class' => 'footer-menu',
								'theme_location' => 'footer', 
								'fallback_cb' => false,
								'depth' => 1
								)); 
		?>

	</footer><!-- #colophon -->
    
</div><!-- #secondary -->