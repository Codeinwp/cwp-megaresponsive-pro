<?php
/**
 * @package cwp-megaresponsive-pro
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
	    	<div class="post-categories">
				<?php the_category(' / '); ?>
			</div>
            
            <?php cwp_megaresponsive_pro_content_nav_single('nav-below'); ?>
            
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php cwp_megaresponsive_pro_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>	
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">		
		<?php
			the_content(); 
		
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'cwp-megaresponsive-pro' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'cwp-megaresponsive-pro' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'cwp-megaresponsive-pro' ) );

			if ( ! cwp_megaresponsive_pro_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cwp-megaresponsive-pro' );
				} else {
					$meta_text = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cwp-megaresponsive-pro' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cwp-megaresponsive-pro' );
				} else {
					$meta_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'cwp-megaresponsive-pro' );
				}

			} // end check for categories on this blog

			$meta_text = __( 'Tags: %1$s','cwp-megaresponsive-pro' );

			printf(
				$meta_text,
				$tag_list,
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( 'Edit', 'cwp-megaresponsive-pro' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->


	<?php
		if ( function_exists( cwp_megaresponsive_pro_social_icons_single() ) ){
			cwp_megaresponsive_pro_social_icons_single();
		}
	 ?>

</article><!-- #post-## -->