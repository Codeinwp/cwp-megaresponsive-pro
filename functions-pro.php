<?php

/***********************************/
/*****  Custom image sizes *********/
/***********************************/

add_image_size( 'small_size', 130, 80, true );

add_image_size( 'slider_img_size', 300, 190, true );

/***********************************/
/**** Social icon (single.php) *****/
/***********************************/

function cwp_megaresponsive_pro_social_icons_single(){

	$post_social_button = get_theme_mod( 'post_social_button' );
	
	if( !empty($post_social_button) || !isset($post_social_button) ):
	
		echo '<div class="bottom-social-wrap">';
			echo '<div id="twitter" data-url="'.get_permalink().'" data-text="'.get_permalink().'" data-title="Tweet"></div>';
			echo '<div id="facebook" data-url="'.get_permalink().'" data-text="'.get_permalink().'" data-title="Like"></div>';
			echo '<div id="googleplus" data-url="'.get_permalink().'" data-text="'.get_permalink().'" data-title="g+1"></div>';
			echo '<div id="linkedin" data-url="'.get_permalink().'" data-text="'.get_permalink().'" data-title="Share"></div>';		
		echo '</div>';

	endif;

}

/**********************************************/
/*********** Related post (single.php) ********/
/**********************************************/

function cwp_megaresponsive_pro_related_post(){
	
	$posttags = get_the_tags();	
	
	$tag_list = array();
	
	if ($posttags) {
		foreach($posttags as $tag) {
			array_push($tag_list,$tag->term_id); 
		}
	}
	
	$notin = get_option('sticky_posts');
	array_push($notin, get_the_ID());
	
	if($tag_list) {
		$args = array(
			'posts_per_page' => 6,
			'post__not_in' => $notin,
			'tag__in'  => $tag_list
		);
	}
	else {
		$args = array(
			'posts_per_page' => 6,
			'post__not_in' => $notin
		);
	}
	$the_query = new WP_Query( $args );
	
	if( $the_query->have_posts() ):
	
		echo '<div id="relatedposts"><h2>'.__( "Related Posts", "cwp-megaresponsive-pro"). '</h2><ul>';
		
		while ( $the_query->have_posts() ) : $the_query->the_post();
				?> 
				<li>

					<a href="<?php echo get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" class="relatedthumb">
					<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'small_size' ); ?>
					<?php endif; ?>
					</a>
					
						<p class="relatedcontent">
							<a href="<?php echo get_permalink()?>" rel="bookmark" title="<?php the_title(); ?>" ><?php the_title(); ?></a>
							<span class="relatedposted"><?php echo get_the_date('M jS, Y') ?> / <?php comments_number( 'no comments', 'one commennt', '% comments' ); ?></span>
						</p>
				</li>
				
				<?php
				
		endwhile;
		
		echo '</ul></div>';
		
	endif;	
	wp_reset_postdata();
	
}

/*********************************************/
/**** Latest new box: top of the homepage ***/
/*******************************************/
	
function cwp_megaresponsive_pro_latest_news(){

	$cwp_megaresponsive_pro_latest_news_box = get_theme_mod('latest_news_box');
	if( $cwp_megaresponsive_pro_latest_news_box != 1 ):
?>
 	<!-- Latest news box -->
   	<div class="latest-news-wrap">
		<div id="latest-news" class="carousel vertical slide" data-ride="carousel">
			<div class="latest-news-title"><p><?php _e('Latest News','cwp-megaresponsive-pro'); ?></p></div>
			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<?php
				
					$cwp_megaresponsive_pro_query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '3') );

					$latest_news_cont = 1;	
					
					if ( $cwp_megaresponsive_pro_query->have_posts() ):
						
						while ( $cwp_megaresponsive_pro_query->have_posts() ):
						
							$cwp_megaresponsive_pro_query->the_post();
							
							if($latest_news_cont):
								$active_class = 'active';
								$latest_news_cont = 0;
							else:
								$active_class = '';
							endif;
							
							echo '<div class="item '.$active_class.'">';
								echo '<a href="'.get_permalink().'" title="'.get_the_title().'">'.get_the_title().' - <span>'.human_time_diff(get_post_time('U'), current_time('timestamp')) .' '.__('ago','cwp-megaresponsive-pro').'</span></a>';
							echo '</div>';
							
						endwhile;
						
					endif;
					
					wp_reset_postdata();
				
				?>
			</div><!-- .carousel-inner -->
					
		</div><!-- #latest-news" -->

    </div><!-- .latest-news-wrap -->
<?php
	endif;

}

/************************************************/
/************* Slider homepage ******************/
/************************************************/

function cwp_megaresponsive_pro_home_slider() {

	$cwp_megaresponsive_pro_show_slider = get_theme_mod('show_slider');
	
	if( $cwp_megaresponsive_pro_show_slider != 1 ):

		$cwp_megaresponsive_pro_slider_category = get_theme_mod('tcx_category');

		if(!empty($cwp_megaresponsive_pro_slider_category)):
			$cwp_megaresponsive_pro_query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '5', 'cat' => $cwp_megaresponsive_pro_slider_category) );
		else:
			$cwp_megaresponsive_pro_query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '5') );
		endif;

		$slider_cont = 1;	
					
		if ( $cwp_megaresponsive_pro_query->have_posts() ):
		
			echo '<div class="frontpage-content-wrap">';

				echo '<div id="home-carousel" class="carousel slide" data-ride="carousel">';

					echo '<div class="featured-story-wrap">';
								
						echo '<p class="featured-main-title">'; 
										
							$slider_title = get_theme_mod('slider_title');
							
							if ( !empty($slider_title) ): 
								echo $slider_title; 
							else:
								_e('Featured Story', 'cwp-megaresponsive-pro');
							endif; 
					
						echo '</p>';

						echo '<div class="carousel-inner">';
						
							while ( $cwp_megaresponsive_pro_query->have_posts() ):
										
								$cwp_megaresponsive_pro_query->the_post();
											
								if($slider_cont):
									$active_class = 'active';
									$slider_cont = 0;
								else:
									$active_class = '';
								endif;
								
								echo '<div class="item '.$active_class.'">';
								
									if ( has_post_thumbnail() ) :
										echo '<a href="'.get_permalink().'" rel="bookmark" title="'.get_the_title().'" class="featured-img-wrap">';
											the_post_thumbnail( 'slider_img_size' );
										echo '</a>';
									endif;
									?>	
								    <div class="featured-content-wrap">
										<a href="<?php the_permalink(); ?>" class="featured-title" title="<?php the_title(); ?>"><?php the_title(); ?></a>
										<p class="featured-posted-on">
											<?php cwp_megaresponsive_pro_posted_on(); ?>
								        </p>
								        <div class="featured-content">
								        	<?php the_excerpt(); ?>
											<a href="<?php the_permalink(); ?>" class="read-more"><?php _e('Read More','cwp-megaresponsive-pro'); ?></a>
								        </div>
									</div>
									<?php
								echo '</div>';
			
							endwhile;
							
						echo '</div>';
					echo '</div>';

					?>		
					<div class="carousel-nav-wrap">
						<a class="left carousel-control carousel-nav" href="#home-carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control carousel-nav" href="#home-carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
					</div>
				</div>
		</div>
		<?php				
		endif;
					
		wp_reset_postdata();
		
	endif;

}

/*************************************/
/***** Latest post homepage *********/
/************************************/

function cwp_megaresponsive_pro_latest_post_category() {

	$display_categories_box = get_theme_mod( 'display_categories_box' );
	
	if ( $display_categories_box != 1 ): ?>

            		<div class="frontpage-latest-post-wrap">
            			<?php for ( $i=1; $i < 5; $i++ ) { ?>
            				<?php if ( get_theme_mod( 'category_box'.$i ) ): 
            					$categToShow = get_theme_mod( 'category_box'.$i );
            				?>
			            		<div class="frontpage-post-box">
			            			<p class="frontpage-categ-title">
			            				<?php 
											echo get_cat_name($categToShow);
			            				 ?>
			            			</p>
									<?php
									
										$cwp_megaresponsive_pro_query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => '4', 'cat' => $categToShow) );
		
										if ( $cwp_megaresponsive_pro_query->have_posts() ):
		
											while ( $cwp_megaresponsive_pro_query->have_posts() ):
												$cwp_megaresponsive_pro_query->the_post();
											?>
												<div class="frontpage-little-post">
													<a href="<?php echo get_the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>" class="frontpage-little-img">
													<?php if ( has_post_thumbnail() ) : ?>
														<?php the_post_thumbnail( 'small_size' ); ?>
													<?php endif; ?>
													</a>
													<a href="<?php echo get_the_permalink()?>" class="frontpage-little-title"><?php the_title() ?></a>
													<p class="frontpage-little-posted-on"><?php echo get_the_date('M jS, Y') ?> / <?php comments_number( 'no comments', 'one commennt', '% comments' ); ?></p>
												</div><!-- .frontpage-little-post -->
											<?php
											endwhile;
											echo '<a href="'.get_category_link( $categToShow ).'" class="view-all">'.__('View All','cwp-megaresponsive-pro').'</a>';
										endif;
										
										wp_reset_postdata();
									?>
			            		</div><!-- .frontpage-post-box -->
	            		<?php endif; ?>
	            	<?php } //end for ?>
	            </div><!-- .frontpage-latest-post-wrap -->
	<?php endif;
}

function cwp_megaresponsive_pro_style_pro() {

	echo ' <style type="text/css">';

	echo '	.site-header{ background: '. get_theme_mod('site_colors_header_bg') .'}';
	echo '	.main-navigation ul ul{ background-color: '. get_theme_mod('site_colors_header_bg') .'}';
	echo '	.latest-news-title{ background-color: '. get_theme_mod('site_colors_header_bg') .'}';
	
	echo '	.site-header .container{ border-color: '. get_theme_mod('site_colors_header_borderbottom') .'}';

	echo '	a.read-more, .carousel-nav, a.view-all, .post-categories{ background: '. get_theme_mod('site_colors_buttons') .'}';

	echo '	.glyphicon-chevron-left:before, 
			.glyphicon-chevron-right:before, 
			a.read-more, 
			a.view-all, 
			.post-categories li a, 
			.post-categories a { 
				color: '. get_theme_mod('site_colors_buttons_text') .' !important }';
	
	echo '	a, a:visited, a:hover, a:focus, a:active,
			.hentry:hover .entry-title a,
			a.featured-title:hover,
			.featured-main-title,
			.widget .widget-title {
				color: '. get_theme_mod('site_colors_links') .'}';

	echo '	input[type="submit"],
			button,
			.navigation-single a{ 
				background: '. get_theme_mod('site_colors_buttons') .';
				border-color: '. get_theme_mod('site_colors_buttons') .';
				color: '. get_theme_mod('site_colors_buttons_text') .';
			}';

	echo '	body, input, select, textarea { color: '. get_theme_mod('site_colors_text') .'}';

	echo '	.main-navigation a{ color: '. get_theme_mod('site_colors_header_menu') .'}';
	echo '	.latest-news-title p{ color: '. get_theme_mod('site_colors_header_menu') .' !important}';

	echo '	.main-navigation a:hover, .main-navigation li:hover > a{ color: '. get_theme_mod('site_colors_header_menu_hover') .' !important}';


	echo '	.hentry .entry-title a, 
			.hentry .entry-title,
			.frontpage-categ-title{ 
				color: '. get_theme_mod('site_colors_title') .';
			}';

	echo '	.site-branding h1 a,
			.site-branding h2{ 
				color: '. get_theme_mod('site_colors_main_title') .';
			}';

	echo '</style>';

}



if (class_exists('WP_Customize_Control')) {
    class WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;','cwp-megaresponsive-pro' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );
 
            // Hackily add in the data link parameter.
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                $this->label,
                $dropdown
            );
        }
    }
}
