<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

                    <div id="main-content">
                        <div id="main-content-inner" class="list-posts"></div>
                     </div>

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
	if( ($sidebar_position==='one-sidebar-right') || ($sidebar_position==='two-sidebar-right')  || ($sidebar_position==='two-sidebar') ): 
		get_sidebar();
	endif;
?>

<input type="hidden" id="load_posts" value="<?php echo get_template_directory_uri(); ?>" /> 

</div><!-- .no-sidebar -->

<?php get_footer(); ?>