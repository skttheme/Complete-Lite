<?php
/**
 * SKT Complete Lite Theme Customizer
 *
 * @package SKT Complete Lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function complete_lite_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class complete_lite_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	class WP_Customize_Textarea_Control extends WP_Customize_Control {
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

function complete_lite_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('display_header_text');
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#383939',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','complete-lite'),
 			'description' => __( 'More color options in PRO Version.', 'complete-lite'),				
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('top_bar',array(
			'title'	=> __('Top Bar','complete-lite'),
			'priority'	=> null,
	));
	$wp_customize->add_setting('complete_lite_options[topbar-left-info]', array(
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control( new complete_lite_Info( $wp_customize, 'topbar-left-info', array(
		'label'	=> __('Top Left Section','complete-lite'),
        'section' => 'top_bar',
        'settings' => 'complete_lite_options[topbar-left-info]'
        ) )
    );
	$wp_customize->add_setting('top_phone',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('top_phone',array(
			'label'	=> __('Phone Number:','complete-lite'),
			'section'	=> 'top_bar',
			'setting'	=> 'top_phone'
	));
	
	$wp_customize->add_setting('top_email',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('top_email',array(
			'label'	=> __('Email:','complete-lite'),
			'section'	=> 'top_bar',
			'setting'	=> 'top_email'
	));	
	
	$wp_customize->add_setting('complete_lite_options[topbar-right-info]', array(
		'type' => 'info_control',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'wp_kses_post'
	)
	);

    $wp_customize->add_control( new complete_lite_Info( $wp_customize, 'topbar-right-info', array(
		'label'	=> __('Top Right Section','complete-lite'),
        'section' => 'top_bar',
        'settings' => 'complete_lite_options[topbar-right-info]'
        ) )
    );
	$wp_customize->add_setting('top_right1',array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize, 'top_right1', array(
			'type' => 'textarea',
			'label'	=> __('Text1:','complete-lite'),
			'section'	=> 'top_bar',
			'setting'	=> 'top_right1'
	)));
	
	$wp_customize->add_setting('top_right2',array(
			'default'	=> null,
			'sanitize_callback' => 'wp_kses_post',
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize, 'top_right2', array(
			'type' => 'textarea',
			'label'	=> __('Text2:','complete-lite'),
			'section'	=> 'top_bar',
			'setting'	=> 'top_right2'
	)));
	
	$wp_customize->add_setting('hide_topbar',array(
			'default' => true,
			'sanitize_callback' => 'complete_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'hide_topbar', array(
		   'settings' => 'hide_topbar',
    	   'section'   => 'top_bar',
    	   'label'     => __('Uncheck This Option To Display Header Top Bar','complete-lite'),
    	   'type'      => 'checkbox'
     ));			

// Home Page Boxes 	
	$wp_customize->add_section('page_boxes',array(
		'title'	=> __('Home Boxes','complete-lite'),
		'description' => sprintf( __( 'Featured Image Dimensions : ( 70 X 70 )<br/> Select Featured Image for these pages <br /> How to set featured image %s', 'complete-lite' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_THEME_FEATURED_SET_VIDEO_URL.'"' ), __( 'Click Here ?', 'complete-lite' )
				)
			),
		'priority'	=> null
	));
	
		$wp_customize->add_setting('featured_heading',array(
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('featured_heading',array(
			'label'	=> __('Title:','complete-lite'),
			'section'	=> 'page_boxes',
			'setting'	=> 'featured_heading'
	));
	
	$wp_customize->add_setting('page-setting1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box one:','complete-lite'),
			'section'	=> 'page_boxes'	
	));
	
	$wp_customize->add_setting('page-setting2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box two:','complete-lite'),
			'section'	=> 'page_boxes'
	));
	
	$wp_customize->add_setting('page-setting3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box three:','complete-lite'),
			'section'	=> 'page_boxes'
	));	
	
	$wp_customize->add_setting('page-setting4',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting4',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box four:','complete-lite'),
			'section'	=> 'page_boxes'
	));	
	 
	$wp_customize->add_setting('hide_boxes',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
	));	 

	$wp_customize->add_control( 'hide_boxes', array(
    	   'section'   => 'page_boxes',
    	   'label'     => __('Uncheck This Option To Display Page Boxes','complete-lite'),
    	   'type'      => 'checkbox'
     ));	
 
// Home Boxes
	
	// Slider Section
	$wp_customize->add_section(
        'slider_section',
        array(
            'title' => __('Slider Settings', 'complete-lite'),
            'priority' => null,
            'description' => __( 'Featured Image Size Should be ( 1838x599 ) More slider settings available in PRO Version.', 'complete-lite' ),			
        )
    );
	
	
	$wp_customize->add_setting('page-setting7',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting7',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','complete-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting8',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting8',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','complete-lite'),
			'section'	=> 'slider_section'
	));	
	
	$wp_customize->add_setting('page-setting9',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'complete_lite_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting9',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','complete-lite'),
			'section'	=> 'slider_section'
	));	// Slider Section
	
	$wp_customize->add_setting('hide_slides',array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
	));	 

	$wp_customize->add_control( 'hide_slides', array(
    	   'section'   => 'slider_section',
    	   'label'     => 'Uncheck To Show Slider',
    	   'type'      => 'checkbox'
     ));		
	// Slider Section
 
	$wp_customize->add_section('social_sec',array(
			'title'	=> __('Social Settings','complete-lite'),
			'description' => __( 'Add social icons link here. more social icons available in PRO Version', 'complete-lite' ),			
			'priority'		=> null
	));
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> __('Add facebook link here','complete-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'fb_link'
	));	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> __('Add twitter link here','complete-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'twitt_link'
	));
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gplus_link',array(
			'label'	=> __('Add google plus link here','complete-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'gplus_link'
	));
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('linked_link',array(
			'label'	=> __('Add linkedin link here','complete-lite'),
			'section'	=> 'social_sec',
			'setting'	=> 'linked_link'
	));
	$wp_customize->add_section('footer_text',array(
			'title'	=> __('Footer Area','complete-lite'),
			'priority'	=> null,
			'description'	=> __('Add footer about text','complete-lite')
	));
	$wp_customize->add_setting('about_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('about_title',array(
			'label'	=> __('Add about title here','complete-lite'),
			'section'	=> 'footer_text',
			'setting'	=> 'about_title'
	));
	
	$wp_customize->add_setting('about_description', array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_kses_post'
	));	
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize,'about_description', array(
				'type' => 'textarea',
				'label'	=> __('Add about description for footer','complete-lite'),
				'section'	=> 'footer_text',
				'setting'	=> 'about_description'
			)
		)
	);
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> __('Add contact title here','complete-lite'),
			'section'	=> 'footer_text',
			'setting'	=> 'contact_title'
	));
	
	$wp_customize->add_setting('contact_add',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control(	new WP_Customize_Textarea_Control( $wp_customize, 'contact_add', array(
				'label'	=> __('Add contact address here','complete-lite'),
				'section'	=> 'footer_text',
				'setting'	=> 'contact_add'
			)
		)
	);
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('contact_no',array(
			'label'	=> __('Add contact number here.','complete-lite'),
			'section'	=> 'footer_text',
			'setting'	=> 'contact_no'
	));
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> __('Add you email here','complete-lite'),
			'section'	=> 'footer_text',
			'setting'	=> 'contact_mail'
	));
	
	$wp_customize->add_setting('hide_footer',array(
			'default' => true,
			'sanitize_callback' => 'complete_lite_sanitize_checkbox',
			'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'hide_footer', array(
    	    'section'   => 'footer_text',
    	    'label'     => __('Uncheck This Option To Display Footer area','complete-lite'),
    	    'type'      => 'checkbox'
     ));
	
	
}
add_action( 'customize_register', 'complete_lite_customize_register' );

//Integer
function complete_lite_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function complete_lite_custom_css(){
		?>
        	<style type="text/css">
					
					a, .header .header-inner .nav ul li a:hover, 
					.signin_wrap a:hover,
					.header .header-inner .nav ul li.current_page_item a,					
					.services-wrap .one_fourth:hover .ReadMore,
					.services-wrap .one_fourth:hover h3,
					.services-wrap .one_fourth:hover .fa,
					#sidebar ul li a:hover,
					.MoreLink:hover,
					.ReadMore a:hover,
					.services-wrap .one_fourth:hover .ReadMore a,
					.cols-3 ul li a:hover, .cols-3 ul li.current_page_item a, .header .header-inner .logo h1 span, .blog_lists h2 a
					{ color:<?php echo esc_attr(get_theme_mod('color_scheme','#383939') ); ?>;}
					
					.social-icons a:hover, 
					.pagination ul li .current, .pagination ul li a:hover, 
					#commentform input#submit:hover,
					.nivo-controlNav a.active, .signin_wrap, .header .header-inner .nav ul li a:hover, .header .header-inner .nav .current-menu-parent > a, .header .header-inner .nav .current_page_item > a, .header .header-inner .nav .current-menu-item > a, .slidebtn a, #footer-wrapper
					{ background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#383939')); ?>;}
					
					.services-wrap .one_fourth:hover .ReadMore,
					.services-wrap .one_fourth:hover .fa,
					.MoreLink:hover
					{ border-color:<?php echo esc_attr(get_theme_mod('color_scheme','#383939')); ?>;}
					
			</style>
<?php       
}
         
add_action('wp_head','complete_lite_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function complete_lite_customize_preview_js() {
	wp_enqueue_script( 'complete_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'complete_lite_customize_preview_js' );


function complete_lite_custom_customize_enqueue() {
	wp_enqueue_script( 'completelite-custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'complete_lite_custom_customize_enqueue' );