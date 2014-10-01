<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package cwp-megaresponsive-pro
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
    


<script type="text/javascript">
  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<script type="text/javascript"><!--
	var template_url = "<?php bloginfo('template_url'); ?>";
	// -->
</script>

<?php 
	wp_head(); 

	if( function_exists( 'cwp_megaresponsive_pro_style_pro' ) ): 
		cwp_megaresponsive_pro_style_pro();
	endif;

	$css_insert = get_theme_mod('css_insert');
	if( !empty($css_insert) ):
		echo '<style type="text/css">';
		echo $css_insert;
		echo '</style>';
	endif;
?>

</head>

<body <?php body_class(); ?>>
<?php $has_header = get_header_image(); if($has_header != false) :?>
<img src="<?php header_image(); ?>" alt="" />
<?php endif; ?>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
	
    	<div class="site-branding">
            <?php if ( get_theme_mod( 'themeslug_logo' ) ) : ?>
                <a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo get_theme_mod( 'themeslug_logo' ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
            <?php else: ?>
			     <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			     <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php endif; ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle"><span class="glyphicon glyphicon-align-justify"></span></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary','menu_id' => 'menu-testing-menu' ) ); ?>
		</nav><!-- #site-navigation -->
        
		</div><!-- .container -->
    </header><!-- #masthead -->

	<div id="main" class="site-main">
    	<div class="container">