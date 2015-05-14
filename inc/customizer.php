<?php
/**
 * cwp-megaresponsive-pro Theme Customizer
 *
 * @package cwp-megaresponsive-pro
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cwp_megar_customize_register( $wp_customize ) {

	class cwp_megaresponsive_pro_Theme_Support extends WP_Customize_Control
	{
		public function render_content()
		{

		}

	} 

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage'; 

    /* theme notes */	
    $wp_customize->add_section( 'codeinwp_theme_notes' , 
        array(
            'title'         =>  __('ThemeIsle theme notes','cwp-megaresponsive-pro'),
            'description'   => sprintf( __( "Thank you for being part of this! We've spent almost 6 months building ThemeIsle without really knowing if anyone will ever use a theme or not, so we're very grateful that you've decided to work with us. Wanna <a href='http://themeisle.com/contact/' target='_blank'>say hi</a>?		<br/><br/><a href='http://themeisle.com/demo/?theme=MegaResponsive-Pro' target='_blank' />View Theme Demo</a> | <a href='http://themeisle.com/forums/forum/megaresponsive-pro' target='_blank'>Get theme support</a><br/><br/><a href='http://themeisle.com/documentation-megaresponsive-pro' target='_blank'>Documentation</a>")),
            'priority'      => 30,	
        )
    );	
    $wp_customize->add_setting(
        'codeinwp_theme_notes'
    );	
    $wp_customize->add_control( new cwp_megaresponsive_pro_Theme_Support( $wp_customize, 'codeinwp_theme_notes',
	    array(
	        'section' => 'codeinwp_theme_notes',
	   )
	));

    /* logo */
    $wp_customize->add_section( 'themeslug_logo_section' , array(
        'title'       => __( 'Logo', 'cwp-megaresponsive-pro' ),
        'priority'    => 31,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );

    $wp_customize->add_setting( 'themeslug_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
        'label'    => __( 'Logo', 'cwp-megaresponsive-pro' ),
        'section'  => 'themeslug_logo_section',
        'settings' => 'themeslug_logo',
    ) ) );       



   
    $wp_customize->add_setting('sidebar_position', array(
    'default' => 'two-sidebar',
    ));
    $wp_customize->add_control('sidebar_position', array(
      'label'      => __('Sidebar position', 'cwp-megaresponsive-pro'),
      'section'    => 'layout',
      'settings'   => 'sidebar_position',
      'type'       => 'radio',
      'choices'    => array(
        'one-sidebar-right'     => 'One sidebar (right)',
        'one-sidebar-left'      => 'One sidebar (left)',
        'full-width'            => 'Full width',
        'two-sidebar-right'     => 'Two Sidebar (right)',
        'two-sidebar'           => 'Two Sidebar (left and right)',
      ),
    ));
    $wp_customize->add_section('layout' , array(
        'title' => __('Layout','cwp_megar'),
    ));





    /* Frontpage */
    $wp_customize->add_section('frontpage' , array(
        'title'     => __('Frontpage', 'cwp_megar'),
        'priority'  => 150
    ));

    /* Latest new box */
    $wp_customize->add_setting('latest_news_box');
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'latest_news_box',
            array(
                'label'     => __('Hide Latest news Box', 'cwp-megaresponsive-pro'),
                'section'   => 'frontpage',
                'settings'  => 'latest_news_box',
                'type'      => 'checkbox',
                'priority'  => 10,
            )
        )
    );

    /* Latest new box */
    $wp_customize->add_setting('show_slider');

    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'show_slider',
            array(
                'label'     => __('Hide Slider', 'cwp-megaresponsive-pro'),
                'section'   => 'frontpage',
                'settings'  => 'show_slider',
                'type'      => 'checkbox',
                'priority'  => 20,
            )
        )
    );

    $wp_customize->add_setting( 
        'slider_title',
        array(
            'default'   => 'Featured Story',
        )
    );
    $wp_customize->add_control( 'slider_title', array(
        'label'    => __( 'Slider title', 'cwp-megaresponsive-pro' ),
        'section'  => 'frontpage',
        'settings' => 'slider_title',
        'priority'    => 30,
    ) );

    /* Category */
    function get_categories_select() {
     $teh_cats = get_categories();
        $results;
        $count = count($teh_cats);
        for ($i=0; $i < $count; $i++) {
          if (isset($teh_cats[$i]))
            $results[$teh_cats[$i]->slug] = $teh_cats[$i]->name;
          else
            $count++;
        }
      return $results;
    }

    /* Select category for slider */
    $wp_customize->add_setting(
        'tcx_category'
    );
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'tcx_category',
            array(
                'label'    => __('Select category for Slider', 'cwp-megaresponsive-pro' ),
                'settings' => 'tcx_category',
                'section'  => 'frontpage',
                'priority'  => 40,
            )
        )
    );



    /* Latest new box */
    $wp_customize->add_setting('display_categories_box', array());
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'display_categories_box',
            array(
                'label'     => __('Hide posts by category', 'cwp-megaresponsive-pro'),
                'section'   => 'frontpage',
                'settings'  => 'display_categories_box',
                'type'      => 'checkbox',
                'priority'  =>  41,
            )
        )
    );



    /* Category */
    $wp_customize->add_setting(
        'category_box1'
    );
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'category_box1',
            array(
                'label'    => __('Select category box 1', 'cwp-megaresponsive-pro' ),
                'settings' => 'category_box1',
                'section'  => 'frontpage',
                'priority'  => 50,
            )
        )
    );



    /* Category */
    $wp_customize->add_setting(
        'category_box2'
    );
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'category_box2',
            array(
                'label'    => __( 'Select category box 2', 'cwp-megaresponsive-pro' ),
                'settings' => 'category_box2',
                'section'  => 'frontpage',
                'priority'  => 60,
            )
        )
    );

    /* Category */
    $wp_customize->add_setting(
        'category_box3'
    );
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'category_box3',
            array(
                'label'    => __('Select category box 3', 'cwp-megaresponsive-pro' ),
                'settings' => 'category_box3',
                'section'  => 'frontpage',
                'priority'  => 70,
            )
        )
    );

    /* Category */
    $wp_customize->add_setting(
        'category_box4'
    );
    $wp_customize->add_control(
        new WP_Customize_Category_Control(
            $wp_customize,
            'category_box4',
            array(
                'label'    => __('Select category box 4', 'cwp-megaresponsive-pro' ),
                'settings' => 'category_box4',
                'section'  => 'frontpage',
                'priority'  => 80,
            )
        )
    );



    /* Latest new box */
    $wp_customize->add_setting('latest_post_box');
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'latest_post_box',
            array(
                'label'     => __('Hide Latest posts', 'cwp-megaresponsive-pro'),
                'section'   => 'frontpage',
                'settings'  => 'latest_post_box',
                'type'      => 'checkbox',
                'priority'  =>  1,
            )
        )
    );






    $wp_customize->add_section('post_page' , array(
        'title'     => __('Post page settings', 'cwp-megaresponsive-pro'),
        'priority'  => 160
    ));


    /* Social buttons */
    $wp_customize->add_setting('post_social_button', array(
        'default'    => '1',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'post_social_button',
            array(
                'label'     => __('Enable Social buttons', 'cwp-megaresponsive-pro'),
                'section'   => 'post_page',
                'settings'  => 'post_social_button',
                'type'      => 'checkbox',
                'priority'  => 1
            )
        )
    );


    /* Related posts */
    $wp_customize->add_setting('post_page_relatedposts', array(
        'default'    => '1',
    ));
    $wp_customize->add_control(
        new WP_Customize_Control(
            $wp_customize,
            'post_page_relatedposts',
            array(
                'label'     => __('Enable Related posts', 'cwp-megaresponsive-pro'),
                'section'   => 'post_page',
                'settings'  => 'post_page_relatedposts',
                'type'      => 'checkbox',
                'priority'  => 2
            )
        )
    );

    $wp_customize->add_setting(
        'site_colors_main_title',
        array(
            'default'     => '#ffffff'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_main_title',
            array(
                'label'      => __( 'Site title', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_main_title',
                'priority'   => 30
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_header_bg',
        array(
            'default'     => '#092f40'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color',
            array(
                'label'      => __( 'Header background', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_header_bg',
                'priority'   => 31
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_header_borderbottom',
        array(
            'default'     => '#eb4549'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_border',
            array(
                'label'      => __( 'Header border', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_header_borderbottom',
                'priority'   => 32
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_header_menu',
        array(
            'default'     => '#d9e6ec'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_menu',
            array(
                'label'      => __( 'Header menu text', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_header_menu',
                'priority'   => 33
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_header_menu_hover',
        array(
            'default'     => '#eb4549'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_menu_hover',
            array(
                'label'      => __( 'Header menu over', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_header_menu_hover',
                'priority'   => 34
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_buttons',
        array(
            'default'     => '#eb4549'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_buttons',
            array(
                'label'      => __( 'Buttons', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_buttons',
                'priority'   => 35
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_buttons_text',
        array(
            'default'     => '#ffffff'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_buttons_text',
            array(
                'label'      => __( 'Buttons text', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_buttons_text',
                'priority'   => 36
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_links',
        array(
            'default'     => '#eb4549'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_links',
            array(
                'label'      => __( 'Links', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_links',
                'priority'   => 37
            )
        )
    );


    $wp_customize->add_setting(
        'site_colors_text',
        array(
            'default'     => '#092f40'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_text',
            array(
                'label'      => __( 'Text', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_text',
                'priority'   => 38
            )
        )
    );

    $wp_customize->add_setting(
        'site_colors_title',
        array(
            'default'     => '#092f40'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color_title',
            array(
                'label'      => __( 'Title', 'cwp-megaresponsive-pro' ),
                'section'    => 'colors',
                'settings'   => 'site_colors_title',
                'priority'   => 39 
            )
        )
    );



    $wp_customize->add_section('footer' , array(
        'title'     => __('Insert code', 'cwp-megaresponsive-pro'),
        'priority'  => 170
    ));

    $wp_customize->add_setting( 'css_insert' );
    $wp_customize->add_control( 
        new Example_Customize_Textarea_Control( 
            $wp_customize, 
            'insert_css', 
            array(
                'label'     => __('Insert css', 'cwp-megaresponsive-pro'),
                'section'   => 'footer',
                'settings'  => 'css_insert',
            )
        )
    );

    $wp_customize->add_setting( 'script_insert' );
    $wp_customize->add_control( 
        new Example_Customize_Textarea_Control( 
            $wp_customize, 
            'insert_script', 
            array(
                'label'     => __('Insert script', 'cwp-megaresponsive-pro'),
                'section'   => 'footer',
                'settings'  => 'script_insert',
            )
        )
    );
	
	 $wp_customize->add_section('general_options' , array(
        'title'     => __('General options', 'cwp-megaresponsive-pro'),
        'priority'  => 170
    ));
	
	$wp_customize->add_setting( 'cwp_megaresponsive_pro_email_address' );
	$wp_customize->add_control( 'cwp_megaresponsive_pro_email_address', array(
			'label'    => __( 'Email address', 'cwp-megaresponsive-pro' ),
	      	'section'  => 'general_options',
	      	'settings' => 'cwp_megaresponsive_pro_email_address',
			'priority'    => 5,
	));



}
add_action( 'customize_register', 'cwp_megar_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cwp_megar_customize_preview_js() {
	wp_enqueue_script( 'cwp_megar_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'cwp_megar_customize_preview_js' );



if( class_exists( 'WP_Customize_Control' ) ):
class Example_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
    }
}
endif;