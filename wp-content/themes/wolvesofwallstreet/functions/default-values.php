<?php
function get_site_primary_logo(){ return get_template_directory_uri().'/images/white-logo.png';	}
function get_site_secondary_logo(){ return get_template_directory_uri().'/images/logo-color.png'; }
function catch_footer_site_logo(){ return get_template_directory_uri().'/images/footer_logo.png'; }
function catch_banner_image_content(){ return get_template_directory_uri().'/images/front-banner-img.jpg'; }
function catch_banner_video_sourceone(){ return get_template_directory_uri().'/videos/catch-video-banner.mp4'; }
function catch_banner_video_sourcetwo(){ return get_template_directory_uri().'/videos/catch-video-banner.webm'; }
function catch_about_image_backgrd(){ return get_template_directory_uri().'/images/about-bg.jpg'; }
function catch_team_image_content(){ return get_template_directory_uri().'/images/leader-image.png'; }
function catch_map_image_content(){ return get_template_directory_uri().'/images/map.png'; }

function all_default_values($field){
	$default=array();
	//Header
	$default['catch_header_primary_logo']		=get_site_primary_logo();
	$default['catch_header_secondary_logo']		=get_site_secondary_logo();
	$default['catch_header_employees_link']		="#";
	$default['catch_header_ftp_link']			="#";
	$default['catch_header_linkedin_link']		="#";
	//Footer
	$default['catch_footer_site_logo']			=catch_footer_site_logo();
	$default['catch_footer_copyright_text']		='Copyright 2016 &copy; Catch Engineering. All rights reserved.';
	$default['catch_global_tag']				='Eget a parturient sapien quisque cum parturient dapibus ultrices dignissim tortor';
	//Top Popup
	$default['catch_contact_address_content']	='<p>#1100, 940 – 6th Avenue S.W.</p>
<p>Calgary AB, Canada, T2P 3T1</p>';
	$default['catch_contact_numbers_content']	='<p>Phone: 1.587.390.7500</p>
<p>Fax: 1.403.770.8728</p>';
	$default['catch_contact_email_content']		='<h4>Email us</h4>
<p>Please feel free to send us a message at</p>
<p><a href="mailto:info@catchengineering.com">info@catchengineering.com</a></p>';
	$default['catch_contact_form_shortcode']	='[contact-form-7 id="273" title="Contact Form"]';
	//Banner
	$default['catch_banner_image_content']		=catch_banner_image_content();
	$default['catch_banner_video_sourceone']	=catch_banner_video_sourceone();
	$default['catch_banner_video_sourcetwo']	=catch_banner_video_sourcetwo();
	$default['catch_banner_caption_heading']	="Scelerisque eu in mauris.";
	$default['catch_banner_caption_content']	="Nibh sociosqu fringilla nunc condimentum etiam enim primis natoque ac duis suspendisse sodales tempor a euismod a aliquam condimentum scelerisque.";
	//Tags
	$default['catch_first_tag_line']			='"If you are making or using electricity,chances are we can help you"';
	$default['catch_second_tag_line']			='Eget a parturient sapien quisque cum parturient dapibus ultrices dignissim tortor';
	$default['catch_innnerpage_tags']			='Eget a parturient sapien quisque cum parturient dapibus ultrices dignissim tortor';	
	//Client
	$default['catch_client_heading_text']		="Some of our Clients";
	//About
	$default['catch_about_image_backgrd']		=catch_about_image_backgrd();	
	$default['catch_about_buttons_text']		="Learn More";
	$default['catch_about_buttons_link']		=site_url()."/our-company/";
	//Team
	$default['catch_team_heading_text']			="Leadership Through Engagement";
	$default['catch_team_image_content']		=catch_team_image_content();
	//Blog
	$default['catch_blog_heading_text']			="Latest From Project Profiles";
	$default['catch_blog_subhdng_text']			="Sociis feugiat aptent etiam vulputate dictumst id faucibus sociosqu";
	$default['catch_blog_buttons_text']			="All Profiles";
	$default['catch_blog_buttons_link']			=site_url()."/blog/";
	//Map
	$default['catch_map_heading_text']			="Where we work";
	$default['catch_map_image_content']			=catch_map_image_content();
	
	
	return $default[$field];
	}
?>