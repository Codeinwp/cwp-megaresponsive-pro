<?php
/**
 * The Template for displaying all single posts.
 *
 * @package cwp-megaresponsive-pro
 */

get_header(); 

$sidebar_position = get_theme_mod( 'sidebar_position' );

if( empty($sidebar_position) ):
	$sidebar_position = 'two-sidebar';
endif;

?>

<div id="primary" class="content-area <?php echo $sidebar_position; ?>"> 
    <div id="content" class="site-content" role="main" style="<?php if( ($sidebar_position==='one-sidebar-left') || ($sidebar_position==='full-width') ): echo 'margin-right: 0'; endif; ?>">
        <div class="w1">
            <div class="w2" style="<?php 
                if( ($sidebar_position==='one-sidebar-right') || ($sidebar_position==='full-width') ): 
                    echo 'margin-left: 0';
                elseif( $sidebar_position==='two-sidebar-right' ):
                    echo 'margin-left: 200px; margin-right: 0';
                endif;
                ?>">

				<div class="main-content">
					<div class="frontpage-wrap" style="<?php 
						if( ($sidebar_position==='one-sidebar-right') || ($sidebar_position==='full-width') ): 
							echo 'margin-left: 0';
						elseif( $sidebar_position==='two-sidebar-right' ):
							echo 'margin-left: 0; margin-right: 30px';
						endif;
					?>">

					<?php
					
					while ( have_posts() ) : the_post();
						get_template_part( 'content', 'single' ); 
						
						/**************************************/
						/********** Related posts *************/
						/**************************************/
						
						$post_page_relatedposts = get_theme_mod( 'post_page_relatedposts' );
						
						if( !empty($post_page_relatedposts) || !isset($post_page_relatedposts) ):
						
							if ( function_exists( 'cwp_megaresponsive_pro_related_post' ) ) :
								cwp_megaresponsive_pro_related_post(); 
							endif;
							
						endif;
						
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ):
							comments_template();
						endif;
						
					endwhile;
					
					?>

					</div>
				</div><!-- #main-content -->

				<?php if( ($sidebar_position==='one-sidebar-left') || ($sidebar_position==='two-sidebar-right') || ($sidebar_position==='two-sidebar') ): ?>
					<div class="sidebar-left-wrap" style="<?php 
						if( $sidebar_position==='two-sidebar-right' ):
							echo 'float: right; margin-right: 0;';
						endif;
					?>">
					<?php get_sidebar('left');  ?>
					</div><!-- .side-content -->
				<?php endif; ?>

			</div><!-- .w2 -->
		</div><!-- .w1 -->

    </div><!-- #content -->	
</div><!-- #primary -->	

<?php
	if( ($sidebar_position==='one-sidebar-right') || ($sidebar_position==='two-sidebar-right') || ($sidebar_position==='two-sidebar') ): 
		get_sidebar();
	endif;

get_footer(); ?>