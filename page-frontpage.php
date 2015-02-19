<?php
/*
 * Template Name: Front Page
*/

get_header(); 

$sidebar_position = get_theme_mod( 'sidebar_position' );

if( empty($sidebar_position) ):
	$sidebar_position = 'two-sidebar';
endif;

$latest_post_box = get_theme_mod( 'latest_post_box' );
?>

<div class="<?php if ( !empty($latest_post_box) ) { echo 'no-sidebar'; } ?>">

<div id="primary" class="content-area <?php echo $sidebar_position; ?>">	
    <div id="content" class="site-content" role="main" style="<?php 
    			if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'full-width') ): 
    				echo 'margin-right: 0';
    			endif;
    			?>">
        
    	<div class="w1">
    		<div class="w2" style="<?php 
    			if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position==='full-width') ):
    				echo 'margin-left: 0';
    			elseif( $sidebar_position==='two-sidebar-right' ):
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

        			<?php if ( function_exists( 'cwp_megaresponsive_pro_latest_news') ): cwp_megaresponsive_pro_latest_news(); endif; ?>

        			<?php if ( function_exists( 'cwp_megaresponsive_pro_home_slider') ): cwp_megaresponsive_pro_home_slider(); endif; ?>

        			<?php if ( function_exists( 'cwp_megaresponsive_pro_latest_post_category') ): cwp_megaresponsive_pro_latest_post_category(); endif; ?>

					
                    <?php if ( get_theme_mod('latest_post_box') != 1 ): ?>
						
                        <div id="main-content">
                            <div id="main-content-inner" class="list-posts"></div>
                        </div>
                    
                    <?php endif; ?>


                </div>
            </div><!-- #main-content -->

            <?php if( ($sidebar_position === 'one-sidebar-left') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position === 'two-sidebar') ): ?>
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
	if( ($sidebar_position === 'one-sidebar-right') || ($sidebar_position === 'two-sidebar-right') || ($sidebar_position==='two-sidebar') ): 
		get_sidebar();
	endif;
?>

<input type="hidden" id="load_posts" value="<?php echo get_template_directory_uri(); ?>" /> 

</div><!-- .no-sidebar -->

<?php get_footer(); ?>