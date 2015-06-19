<?php
/**
 * cwp-megaresponsive-pro functions and definitions
 *
 * @package cwp-megaresponsive-pro
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function cwp_megaresponsive_pro_setup() {

	load_theme_textdomain( 'cwp-megaresponsive-pro', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'cwp-megaresponsive-pro' ),
		'footer' => __( 'Footer Menu', 'cwp-megaresponsive-pro' ),
		'sidebar_menu' => __( 'Sidebar menu', 'cwp-megaresponsive-pro' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'cwp_megar_custom_background_args', array(
		'default-color' => 'fefefe',
		'default-image' => '',
	) ) );

	
    /**
     * Implement the Custom Header feature.
     */
    //require get_template_directory() . '/inc/custom-header.php';
	$args = array(
		'width'         => 980,
		'height'        => 60,
		'default-image' => '',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );
    
    /**
     * Custom template tags for this theme.
     */
    require get_template_directory() . '/inc/template-tags.php';
    
    /**
     * Custom functions that act independently of the theme templates.
     */
    require get_template_directory() . '/inc/extras.php';
    
    /**
     * Customizer additions.
     */
    require get_template_directory() . '/inc/customizer.php';
    
    /**
     * Load Jetpack compatibility file.
     */
    require get_template_directory() . '/inc/jetpack.php';
    
    /**
	 *
     */
	require get_template_directory() . '/functions-pro.php';



    /**
     * Enabling Support for Post Thumbnails.
     */
    add_theme_support( 'post-thumbnails' ); 
            
}
add_action( 'after_setup_theme', 'cwp_megaresponsive_pro_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cwp_megar_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar right', 'cwp-megaresponsive-pro' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar left', 'cwp-megaresponsive-pro' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'cwp_megar_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function cwp_megar_scripts() {
	
	wp_enqueue_style( 'cwp_megaresponsive_pro_bootstrap-style', get_template_directory_uri() . '/css/bootstrap.css', array(), '20130801', 'all' );
	
	wp_enqueue_style( 'cwp_megaresponsive_pro_custom-style', get_template_directory_uri() . '/css/bootstrap-responsive.css', array(), '20130801', 'all' );
	
	wp_enqueue_style( 'cwp_megaresponsive_pro_style', get_stylesheet_uri() );
	
	wp_enqueue_script( 'cwp_megaresponsive_pro_bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20130801', true );

	wp_enqueue_script( 'cwp_megaresponsive_pro_functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20130801', true );

	wp_enqueue_script( 'cwp_megaresponsive_pro_navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20120206', true );
    
    wp_enqueue_script( 'cwp_megaresponsive_pro_ajaxLoop', get_template_directory_uri() . '/js/ajaxLoop.js', array('jquery'), '1.0.0', true );
	
    wp_enqueue_script( 'cwp_megaresponsive_pro_sharrre', get_template_directory_uri() . '/js/jquery.sharrre.min.js', array('jquery'), '1.0.0', true );
    
	wp_enqueue_script( 'cwp_megaresponsive_pro_skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '20130115', true );		
	wp_register_style( 'cwp_megaresponsive_pro_open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Roboto+Slab');    
	
	wp_enqueue_style( 'cwp_megaresponsive_pro_open-sans' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'cwp_megaresponsive_pro_keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'cwp_megar_scripts' );


/*
 * No title
 */
add_filter( 'the_title', 'cwp_megaresponsive_pro_no_title');
function cwp_megaresponsive_pro_no_title ($title) { 
	if( $title == "" ){ 
		$title = "(No title)"; 
	} 
	return $title; 
}

function cwp_megaresponsive_pro_add_editor_styles() {
    add_editor_style( '/css/custom-editor-style.css' );
}
add_action( 'init', 'cwp_megaresponsive_pro_add_editor_styles' );

/*
 *  Load more posts
 */
add_action('wp_ajax_cwp_loop', 'cwp_megaresponsive_pro_loop_callback');
add_action('wp_ajax_nopriv_cwp_loop', 'cwp_megaresponsive_pro_loop_callback');

function cwp_megaresponsive_pro_loop_callback() {
	
	global $post;
  
	$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 0;
	$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;
	$catt = (isset($_GET['catNumber'])) ? $_GET['catNumber'] : -1;
	$yearr = (isset($_GET['yearPar'])) ? $_GET['yearPar'] : -1;
	$monthh = (isset($_GET['monthPar'])) ? $_GET['monthPar'] : -1;
	$authorr = (isset($_GET['authorPar'])) ? $_GET['authorPar'] : -1;
	$tagg = (isset($_GET['tagPar'])) ? $_GET['tagPar'] : -1;
	
	$posts_displayed_array = (isset($_GET['uniqueNames'])) ? $_GET['uniqueNames'] : array();
	if( !empty($posts_displayed_array) ):
		foreach($posts_displayed_array as $post_displayed_k => $post_displayed_v):
			$posts_displayed_array[$post_displayed_k] = substr($post_displayed_v, 5);
		endforeach;
	endif;
	
	if($catt != -1):
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'cat' 			=>  $catt,
	   'post_status' 	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	elseif($yearr != -1 && $monthh != -1):
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'year' 			=>  $yearr,
	   'monthnum' 		=> $monthh,
	   'post_status' 	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	
	elseif($yearr != -1):
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'year' 			=>  $yearr,
	   'post_status' 	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	
	elseif($authorr != -1):
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'author' 		=>  $authorr,
	   'post_status'	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	
	elseif($tagg != -1):
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'tag' 			=>  $tagg,
	   'post_status' 	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	
	else:
 
	query_posts(array(
       'posts_per_page' => $numPosts,
       'paged'          => $page,
	   'post_status' 	=> 'publish',
	   'post__not_in' 	=> $posts_displayed_array
	));
	endif;

	while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">

				<div class="entry-thumbnail"> 
				<?php
					if ( has_post_thumbnail() ) {
						?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">
						<?php
							the_post_thumbnail(array(250,250), array('class' => 'alignleft'));
						?>
						</a>
					<?php
					}
				?>
			   </div>
			   
			<div class="entry-meta meta-top">
				<div class="post-categories">
					<?php the_category(' / '); ?>
				</div>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php cwp_megaresponsive_pro_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>	
			</div>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</header><!-- .entry-header -->

			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			<?php else : ?>
			<div class="entry-content">
				<?php 
					the_excerpt(); 
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'cwp-megaresponsive-pro' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php endif; ?>
			
		</article><!-- #post-## -->
       
       
      <?php endwhile;
	  
	die(); // this is required to return a proper result
}