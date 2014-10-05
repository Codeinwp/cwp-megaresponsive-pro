<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package cwp-megaresponsive-pro
 */
?>
		</div><!-- .container -->
	</div><!-- #main -->
</div><!-- #page -->

<?php
 
	wp_footer();
	$script_insert = get_theme_mod('script_insert');
	if( !empty($script_insert) ):
		echo '<script type="text/javascript">';
			echo $script_insert;
		echo '</script>';
	endif;
	
?>
</body>
</html>