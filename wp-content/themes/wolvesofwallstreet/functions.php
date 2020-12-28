<?php
/*****************************************
* Weaver's Web Functions & Definitions *
*****************************************/
$functions_path = get_template_directory().'/functions/';
$post_type_path = get_template_directory().'/inc/post-types/';
$post_meta_path = get_template_directory().'/inc/post-metabox/';
$theme_function_path = get_template_directory().'/inc/theme-functions/';
/*--------------------------------------*/
/* Multipost Thumbnail Functions
/*--------------------------------------*/
require_once($functions_path.'multipost-thumbnail/multi-post-thumbnails.php');
if(class_exists('MultiPostThumbnails')){
	$types = array('page');
	foreach($types as $type){
		new MultiPostThumbnails(array(
			'label' => 'Top Banner Image',
			'id' => 'top-banner-image',
			'post_type' => $type
			));
		}		
	}
add_image_size('top-banner-size-image', 1920, 700,true);
/*--------------------------------------*/
/* Optional Panel Helper Functions
/*--------------------------------------*/
require_once($functions_path.'admin-functions.php');
require_once($functions_path.'admin-interface.php');
require_once($functions_path.'theme-options.php');
require_once($functions_path.'default-values.php');
function weaversweb_ftn_wp_enqueue_scripts(){
    if(!is_admin()){
        wp_enqueue_script('jquery');
        if(is_singular()and get_site_option('thread_comments')){
            wp_print_scripts('comment-reply');
			}
		}
	}
add_action('wp_enqueue_scripts','weaversweb_ftn_wp_enqueue_scripts');
function weaversweb_ftn_get_option($name){
    $options = get_option('weaversweb_ftn_options');
    if(isset($options[$name]))
        return $options[$name];
	}
function weaversweb_ftn_update_option($name, $value){
    $options = get_option('weaversweb_ftn_options');
    $options[$name] = $value;
    return update_option('weaversweb_ftn_options', $options);
	}
function weaversweb_ftn_delete_option($name){
    $options = get_option('weaversweb_ftn_options');
    unset($options[$name]);
    return update_option('weaversweb_ftn_options', $options);
	}
function get_theme_value($field){	
	$field1=weaversweb_ftn_get_option($field);
	$field_default=all_default_values($field);
	if(!empty($field1)){
		$field_val=$field1;
		}else{
		$field_val=$field_default;	
		}
	return	$field_val;
	}
/*--------------------------------------*/
/* Post Type Helper Functions
/*--------------------------------------*/
// require_once($post_type_path.'clients.php');
// require_once($post_type_path.'jobs.php');
// require_once($post_type_path.'services.php');
// require_once($post_type_path.'team_member.php');
// require_once($post_type_path.'testimonials.php');
/*--------------------------------------*/
/* Post Meta Helper Functions
/*--------------------------------------*/
// require_once($post_meta_path.'casestudy-metabox.php');
/*--------------------------------------*/
/* Theme Functions
/*--------------------------------------*/
// require_once($theme_function_path.'extra-functions.php');
/*--------------------------------------*/
/* Theme Helper Functions
/*--------------------------------------*/
if(!function_exists('weaversweb_theme_setup')):
	function weaversweb_theme_setup(){
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		register_nav_menus(array(
			'primary-left' => __('Primary Left Menu','weaversweb'),
			'primary-right' => __('Primary Right Menu','weaversweb'),
			'primary-mobile' => __('Primary Mobile Menu','weaversweb'),
			));
		add_theme_support('html5',array('search-form','comment-form','comment-list','gallery','caption'));
		}
	endif;
add_action('after_setup_theme','weaversweb_theme_setup');
function weaversweb_widgets_init(){
	register_sidebar(array(
		'name'          => __('Widget Area','weaversweb'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.','weaversweb'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
		));
  register_sidebar(array(
    'name'          => __('Header language change','weaversweb'),
    'id'            => 'sidebar-lang_change',
    'description'   => __('Add widgets here to appear in your sidebar.','weaversweb'),
    'before_widget' => '<div id="%1$s" class="lang_change %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="lang_change-title">',
    'after_title'   => '</h2>',
    ));
	}
add_action('widgets_init','weaversweb_widgets_init');
function weaversweb_scripts(){
	wp_enqueue_style('weaversweb-bootstrap',get_template_directory_uri().'/css/bootstrap.min.css',array());
	wp_enqueue_style('weaversweb-font-awesome',get_template_directory_uri().'/css/fontawesome-all.min.css',array());
	wp_enqueue_style('weaversweb-animate',get_template_directory_uri().'/css/animate.min.css',array());
    wp_enqueue_style('weaversweb-fancybox',get_template_directory_uri().'/css/jquery.fancybox.min.css',array());
/*	wp_enqueue_style('weaversweb-owlcarousal',get_template_directory_uri().'/css/owl.carousel.min.css',array());
	wp_enqueue_style('weaversweb-owlcarousal-theme',get_template_directory_uri().'/css/owl.theme.default.min.css',array());*/
	wp_enqueue_style('weaversweb-custom',get_template_directory_uri().'/css/custom.css',array());
	wp_enqueue_style('weaversweb-style',get_stylesheet_uri());

	wp_enqueue_script('weaversweb-popper', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js",array('jquery'),'20201217',true);
	wp_enqueue_script('weaversweb-bootstrap-bundle',get_template_directory_uri().'/js/bootstrap.bundle.js',array('jquery'),'20201217',true);
	wp_enqueue_script('weaversweb-bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'20201217',true);
/*	wp_enqueue_script('weaversweb-owlcarousal-script',get_template_directory_uri().'/js/owl.carousel.min.js',array('jquery'),'20201217',true);*/
    wp_enqueue_script('weaversweb-fancybox-script',get_template_directory_uri().'/js/jquery.fancybox.min.js',array('jquery'),'20201217',true);
	wp_enqueue_script('weaversweb-fontawesome-script',get_template_directory_uri().'/js/fontawesome-all.min.js',array('jquery'),'20201217',true);
	wp_enqueue_script('weaversweb-script',get_template_directory_uri().'/js/main.js',array('jquery'),'20201217',true);
	wp_localize_script( 'weaversweb-script', 'weaversAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'TimerDate' => get_theme_value('weaversweb_datetime_timer') ) );
	}
add_action('wp_enqueue_scripts','weaversweb_scripts');
add_filter('comments_template','legacy_comments');
function legacy_comments($file){
	if(!function_exists('wp_list_comments'))	$file = TEMPLATEPATH .'/legacy.comments.php';
	return $file;
	}

add_action( 'cmb2_admin_init', 'theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function theme_options_metabox() {
  /**
   * Registers options page menu item and form.
   */
  $header_options = new_cmb2_box( array(
    'id'           => 'weavers_theme_options_page',
    'title'        => esc_html__( 'Theme Options', 'weavers' ),
    'object_types' => array( 'options-page' ),
    'option_key'      => 'weavers_theme_options', //The option key and admin menu page slug.
    'icon_url'        => 'dashicons-admin-generic', // Menu icon. Only applicable if 'parent_slug' is left empty.
    'save_button'     => esc_html__( 'Save Options', 'weavers' ), // The text for the options-page save button. Defaults to 'Save'.
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'FOR ENGLISH LANGUAGE', 'weavers' ),
    // 'desc' => esc_html__( 'Enter fourth token details three', 'weavers' ),
    'id'   => 'weavers_english_title',
    'type' => 'title',
  ) );


  $header_options->add_field( array(
    'name' => esc_html__( 'Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter token number', 'weavers' ),
    'id'   => 'weavers_token_number',
    'type' => 'text',
    'default'=>'01',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'First Token Title', 'weavers' ),
    'desc' => esc_html__( 'Enter first token title', 'weavers' ),
    'id'   => 'weavers_first_token_title',
    'type' => 'text',
    'default'=>'BUY WOLF TOKEN',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'First Token Logo', 'weavers' ),
    'desc' => esc_html__( 'Enter first token Logo', 'weavers' ),
    'id'   => 'weavers_first_token_logo',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'First Token List', 'weavers' ),
    'desc' => esc_html__( 'Enter first token list', 'weavers' ),
    'id'   => 'weavers_first_token_list',
    'type' => 'wysiwyg',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token number', 'weavers' ),
    'id'   => 'weavers_sec_token_number',
    'type' => 'text',
    'default'=>'02',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token title left', 'weavers' ),
    'id'   => 'weavers_sec_token_title_left',
    'type' => 'text',
    'default'=>'WOLVES',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Sub-Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token sub-title left', 'weavers' ),
    'id'   => 'weavers_sec_token_subtitle_left',
    'type' => 'text',
    'default'=>'HOLDERS & STAKERS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Logo Left', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token Logo left', 'weavers' ),
    'id'   => 'weavers_sec_token_logo_left',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token title right', 'weavers' ),
    'id'   => 'weavers_sec_token_title_right',
    'type' => 'text',
    'default'=>'TOP BOIS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Sub-Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token sub-title right', 'weavers' ),
    'id'   => 'weavers_sec_token_subtitle_right',
    'type' => 'text',
    'default'=>'FARMERS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Logo Right', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token Logo right', 'weavers' ),
    'id'   => 'weavers_sec_token_logo_right',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Second Token Details', 'weavers' ),
    'desc' => esc_html__( 'Enter sec token details', 'weavers' ),
    'id'   => 'weavers_sec_token_details',
    'type' => 'textarea_small',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter third token number', 'weavers' ),
    'id'   => 'weavers_third_token_number',
    'type' => 'text',
    'default'=>'03',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter third token title left', 'weavers' ),
    'id'   => 'weavers_third_token_title_left',
    'type' => 'text',
    'default'=>'CORPORATE RAIDING',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Logo Left', 'weavers' ),
    'desc' => esc_html__( 'Enter third token Logo left', 'weavers' ),
    'id'   => 'weavers_third_token_logo_left',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter third token title right', 'weavers' ),
    'id'   => 'weavers_third_token_title_right',
    'type' => 'text',
    'default'=>'HOSTILE DEFENCE',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Logo Right', 'weavers' ),
    'desc' => esc_html__( 'Enter third token Logo right', 'weavers' ),
    'id'   => 'weavers_third_token_logo_right',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Third Token Details', 'weavers' ),
    'desc' => esc_html__( 'Enter third token details', 'weavers' ),
    'id'   => 'weavers_third_token_details',
    'type' => 'textarea_small',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Fourth Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter fourth token number', 'weavers' ),
    'id'   => 'weavers_fourth_token_number',
    'type' => 'text',
    'default'=>'04',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Fourth Token Details One', 'weavers' ),
    'desc' => esc_html__( 'Enter fourth token details one', 'weavers' ),
    'id'   => 'weavers_fourth_token_details_one',
    'type' => 'textarea_small',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Fourth Token Details Two', 'weavers' ),
    'desc' => esc_html__( 'Enter fourth token details two', 'weavers' ),
    'id'   => 'weavers_fourth_token_details_two',
    'type' => 'textarea_small',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Fourth Token Details Three', 'weavers' ),
    'desc' => esc_html__( 'Enter fourth token details three', 'weavers' ),
    'id'   => 'weavers_fourth_token_details_three',
    'type' => 'textarea_small',
  ) );



  $header_options->add_field( array(
    'name' => esc_html__( 'FOR CHINESE LANGUAGE', 'weavers' ),
    // 'desc' => esc_html__( 'Enter fourth token details three', 'weavers' ),
    'id'   => 'weavers_chinese_title',
    'type' => 'title',
  ) );



  /*Chaines*/
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese token number', 'weavers' ),
    'id'   => 'china_weavers_token_number',
    'type' => 'text',
    'default'=>'01',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese First Token Title', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese first token title', 'weavers' ),
    'id'   => 'china_weavers_first_token_title',
    'type' => 'text',
    'default'=>'BUY WOLF TOKEN',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese First Token Logo', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese first token Logo', 'weavers' ),
    'id'   => 'china_weavers_first_token_logo',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese First Token List', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese first token list', 'weavers' ),
    'id'   => 'china_weavers_first_token_list',
    'type' => 'wysiwyg',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token number', 'weavers' ),
    'id'   => 'china_weavers_sec_token_number',
    'type' => 'text',
    'default'=>'02',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token title left', 'weavers' ),
    'id'   => 'china_weavers_sec_token_title_left',
    'type' => 'text',
    'default'=>'WOLVES',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Sub-Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token sub-title left', 'weavers' ),
    'id'   => 'china_weavers_sec_token_subtitle_left',
    'type' => 'text',
    'default'=>'HOLDERS & STAKERS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Logo Left', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token Logo left', 'weavers' ),
    'id'   => 'china_weavers_sec_token_logo_left',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token title right', 'weavers' ),
    'id'   => 'china_weavers_sec_token_title_right',
    'type' => 'text',
    'default'=>'TOP BOIS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Sub-Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token sub-title right', 'weavers' ),
    'id'   => 'china_weavers_sec_token_subtitle_right',
    'type' => 'text',
    'default'=>'FARMERS',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Logo Right', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token Logo right', 'weavers' ),
    'id'   => 'china_weavers_sec_token_logo_right',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Second Token Details', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese sec token details', 'weavers' ),
    'id'   => 'china_weavers_sec_token_details',
    'type' => 'textarea_small',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token number', 'weavers' ),
    'id'   => 'china_weavers_third_token_number',
    'type' => 'text',
    'default'=>'03',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Title Left', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token title left', 'weavers' ),
    'id'   => 'china_weavers_third_token_title_left',
    'type' => 'text',
    'default'=>'CORPORATE RAIDING',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Logo Left', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token Logo left', 'weavers' ),
    'id'   => 'china_weavers_third_token_logo_left',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Title Right', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token title right', 'weavers' ),
    'id'   => 'china_weavers_third_token_title_right',
    'type' => 'text',
    'default'=>'HOSTILE DEFENCE',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Logo Right', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token Logo right', 'weavers' ),
    'id'   => 'china_weavers_third_token_logo_right',
     'type' => 'file',
    'text'    => array('add_upload_file_text' => 'Upload image'),
    'query_args' => array(
    'type' => array(
      'image/gif',
      'image/jpeg',
      'image/png',
     ),
        )
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Third Token Details', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese third token details', 'weavers' ),
    'id'   => 'china_weavers_third_token_details',
    'type' => 'textarea_small',
  ) );

  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Fourth Token Number', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese fourth token number', 'weavers' ),
    'id'   => 'china_weavers_fourth_token_number',
    'type' => 'text',
    'default'=>'04',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Fourth Token Details One', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese fourth token details one', 'weavers' ),
    'id'   => 'china_weavers_fourth_token_details_one',
    'type' => 'textarea_small',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Fourth Token Details Two', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese fourth token details two', 'weavers' ),
    'id'   => 'china_weavers_fourth_token_details_two',
    'type' => 'textarea_small',
  ) );
  $header_options->add_field( array(
    'name' => esc_html__( 'Chinese Fourth Token Details Three', 'weavers' ),
    'desc' => esc_html__( 'Enter Chinese fourth token details three', 'weavers' ),
    'id'   => 'china_weavers_fourth_token_details_three',
    'type' => 'textarea_small',
  ) );
}

/*Timer Shortcode*/
function timer_shortcode( $atts, $content = null ) {
	return '<p class="countdown-timer"></p>';
}
add_shortcode( 'Timer', 'timer_shortcode' );

function wolves_chart_shortcode( $atts, $content = null ){
  if( ICL_LANGUAGE_CODE == 'en' ){
    $html = '<div class="token-one t-white">
        <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'weavers_token_number').'</div>
        <h5>'.cmb2_get_option('weavers_theme_options', 'weavers_first_token_title').'</h5>
        <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'weavers_first_token_logo').'" alt="" /></div>
        <div class="wolf-token-list">
            '.cmb2_get_option('weavers_theme_options', 'weavers_first_token_list').'
        </div>
    </div>
    <div class="token-two t-white">
        <div class="token-two-wrap d-flex">
              <div class="token-two-left">
                   <h5>'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_subtitle_left').'</h5>
                   <h2>'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_title_left').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_logo_left').'" alt="" /></div>
              </div>
              <div class="token-two-right">
                   <h5>'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_subtitle_right').'</h5>
                   <h2>'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_title_right').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_logo_right').'" alt="" /></div>
              </div>
        </div>
        <div class="token-two-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_number').'</div>
            '.cmb2_get_option('weavers_theme_options', 'weavers_sec_token_details').'
        </div>
    </div>
    <div class="token-three t-white">
       <div class="token-three-wrap d-flex">
              <div class="token-three-left">
                   <h2>'.cmb2_get_option('weavers_theme_options', 'weavers_third_token_title_left').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'weavers_third_token_logo_left').'" alt="" /></div>
              </div>
              <div class="token-three-right">
                   <h2>'.cmb2_get_option('weavers_theme_options', 'weavers_third_token_title_right').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'weavers_third_token_logo_right').'" alt="" /></div>
              </div>
        </div>
        <div class="token-three-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'weavers_third_token_number').'</div>
            <p>'.cmb2_get_option('weavers_theme_options', 'weavers_third_token_details').'</p>
        </div>
    </div>          
    <div class="token-four t-white">
        <div class="token-four-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'weavers_fourth_token_number').'</div>
            <div class="token-four-content-wrap">
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'weavers_fourth_token_details_one').'</p></div>
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'weavers_fourth_token_details_two').'</p></div>
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'weavers_fourth_token_details_three').'</p></div>
            </div>
        </div>
    </div>';
  }else{
    $html = '<div class="token-one t-white">
        <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'china_weavers_token_number').'</div>
        <h5>'.cmb2_get_option('weavers_theme_options', 'china_weavers_first_token_title').'</h5>
        <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'china_weavers_first_token_logo').'" alt="" /></div>
        <div class="wolf-token-list">
            '.cmb2_get_option('weavers_theme_options', 'china_weavers_first_token_list').'
        </div>
    </div>
    <div class="token-two t-white">
        <div class="token-two-wrap d-flex">
              <div class="token-two-left">
                   <h5>'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_subtitle_left').'</h5>
                   <h2>'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_title_left').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_logo_left').'" alt="" /></div>
              </div>
              <div class="token-two-right">
                   <h5>'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_subtitle_right').'</h5>
                   <h2>'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_title_right').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_logo_right').'" alt="" /></div>
              </div>
        </div>
        <div class="token-two-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_number').'</div>
            '.cmb2_get_option('weavers_theme_options', 'china_weavers_sec_token_details').'
        </div>
    </div>
    <div class="token-three t-white">
       <div class="token-three-wrap d-flex">
              <div class="token-three-left">
                   <h2>'.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_title_left').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_logo_left').'" alt="" /></div>
              </div>
              <div class="token-three-right">
                   <h2>'.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_title_right').'</h2>
                   <div class="wolf-token-icon"><img src="'.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_logo_right').'" alt="" /></div>
              </div>
        </div>
        <div class="token-three-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_number').'</div>
            <p>'.cmb2_get_option('weavers_theme_options', 'china_weavers_third_token_details').'</p>
        </div>
    </div>          
    <div class="token-four t-white">
        <div class="token-four-content">
            <div class="token-number">- '.cmb2_get_option('weavers_theme_options', 'china_weavers_fourth_token_number').'</div>
            <div class="token-four-content-wrap">
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'china_weavers_fourth_token_details_one').'</p></div>
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'china_weavers_fourth_token_details_two').'</p></div>
                <div class="four-content-wr"><p>'.cmb2_get_option('weavers_theme_options', 'china_weavers_fourth_token_details_three').'</p></div>
            </div>
        </div>
    </div>';
  }
	return $html;
}
add_shortcode( 'WolvesProcessChart', 'wolves_chart_shortcode' );