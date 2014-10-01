<?php
/**
 * The template for displaying 404 pages (Not Found).
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
    <div id="content" class="site-content" role="main" style="<?php 
                if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'full-width') ): 
                    echo 'margin-right: 0';
                endif;
                ?>">
        
        <div class="w1">
            <div class="w2" style="<?php 
                if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'full-width') ): 
                    echo 'margin-left: 0';
                elseif( $sidebar_position === 'two-sidebar-right' ):
                    echo 'margin-left: 200px; margin-right: 0';
                endif;
                ?>">

            <div class="main-content">
                <div class="frontpage-wrap" style="<?php 
                    if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'full-width') ): 
                        echo 'margin-left: 0';
                    elseif( $sidebar_position === 'two-sidebar-right' ):
                        echo 'margin-left: 0; margin-right: 30px';
                    endif;
                ?>">


					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'cwp-megaresponsive-pro' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'cwp-megaresponsive-pro' ); ?></p>

							<?php get_search_form(); ?>

							<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

							<?php if ( cwp_megaresponsive_pro_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
							<div class="widget widget_categories">
								<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'cwp-megaresponsive-pro' ); ?></h2>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 10,
									) );
								?>
								</ul>
							</div><!-- .widget -->
							<?php endif; ?>

							<?php
							/* translators: %1$s: smiley */
							$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'cwp-megaresponsive-pro' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
							?>

							<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div><!-- .page-content -->
					</section><!-- .error-404 -->



                </div>
            </div><!-- #main-content -->


            <?php if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position === 'two-sidebar') ): ?>
                <div class="sidebar-left-wrap" style="<?php 
                        if( $sidebar_position === 'two-sidebar-right' ):
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
	if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position === 'two-sidebar') ): 
		get_sidebar();
	endif;
?>

</div><!-- .no-sidebar -->

<?php get_footer(); ?>