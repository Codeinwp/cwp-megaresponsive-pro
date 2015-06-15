<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package cwp-megaresponsive-pro
 */
 
get_header(); 

$sidebar_position = get_theme_mod( 'sidebar_position' );

if( empty($sidebar_position) ):
	$sidebar_position = 'two-sidebar';
endif;

?>

<div class="no-sidebar">

<div id="primary" class="content-area <?php echo $sidebar_position ?>"> 
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

			            <div id="main-content-inner" class="list-posts">
							<header class="page-header">
								<h1 class="page-title">
									<?php
										if ( is_category() ) :
											single_cat_title();
											$cat_id = get_query_var('cat');
										?>	
											<input type="hidden" id="catid" value="<?php echo $cat_id; ?>" />		
										<?php	
										elseif ( is_tag() ) :
											single_tag_title();
											$tag_name = single_tag_title('',false);
											
											$tmp = get_term_by('slug', $tag_name , 'post_tag');
											
										?>	
											<input type="hidden" id="tag_id" value="<?php echo $tmp->slug; ?>" />		
										<?php	

										elseif ( is_author() ) :
											if(get_query_var('author_name')) :
												
												$curauth = get_user_by('slug', get_query_var('author_name'));
											else :
												
												$curauth = get_userdata(get_query_var('author'));
											endif;
											
											
										?>								
											<input type="hidden" id="author_id" value="<?php  echo $curauth->ID;  ?>" />							
										<?php	
											the_post();
											printf( __( 'Author: %s', 'cwp-megaresponsive-pro' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
											
											rewind_posts();

										elseif ( is_day() ) :
											printf( __( 'Day: %s', 'cwp-megaresponsive-pro' ), '<span>' . get_the_date() . '</span>' );

										elseif ( is_month() ) :							
											$month_archive = get_query_var('monthnum');							
											$year_archive = get_query_var('year');
										?>								
											<input type="hidden" id="year_id" value="<?php  echo $year_archive;  ?>" />							
											<input type="hidden" id="month_id" value="<?php echo $month_archive; ?>" />
										<?php	
											printf( __( 'Month: %s', 'cwp-megaresponsive-pro' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

										elseif ( is_year() ) :							
											$year_archive = get_query_var('year');
										?>								
											<input type="hidden" id="year_id" value="<?php  echo $year_archive;  ?>" />							
										<?php	
											printf( __( 'Year: %s', 'cwp-megaresponsive-pro' ), '<span>' . get_the_date( 'Y' ) . '</span>' );							

										elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
											_e( 'Asides', 'cwp-megaresponsive-pro' );

										elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
											_e( 'Images', 'cwp-megaresponsive-pro');

										elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
											_e( 'Videos', 'cwp-megaresponsive-pro' );

										elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
											_e( 'Quotes', 'cwp-megaresponsive-pro' );

										elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
											_e( 'Links', 'cwp-megaresponsive-pro' );

										else :
											_e( 'Archives', 'cwp-megaresponsive-pro' );

										endif;
									?>
								</h1>
								<?php
									// Show an optional term description.
									$term_description = term_description();
									if ( ! empty( $term_description ) ) :
										printf( '<div class="taxonomy-description">%s</div>', $term_description );
									endif;
								?>
							</header><!-- .page-header -->			

						</div><!-- #main-content-inner -->

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

    <input type="hidden" id="load_posts" value="<?php echo get_template_directory_uri(); ?>" /> 

</div><!-- .no-sidebar -->

<?php get_footer(); ?>
