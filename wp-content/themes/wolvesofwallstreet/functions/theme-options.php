<?php
add_action('init','weaversweb_ftn_options');
if(!function_exists('weaversweb_ftn_options')){
	function weaversweb_ftn_options(){
		// If using image radio buttons,define a directory path
		$imagepath = get_stylesheet_directory_uri().'/images/'; 
		$options = array(
		/* ---------------------------------------------------------------------------- */
		/* Header Setting */
		/* ---------------------------------------------------------------------------- */
		array("name" => "Header Section",
			  "type" => "heading"),
		array("name" => "Choose Site Logo",
			  "desc" => "Optimal size: 311px width by 84px height.",
			  "id"   => "weaversweb_header_logo",
			  "std"  => "",
			  "type" => "upload"),
		/* ---------------------------------------------------------------------------- */
		/* Other Setting */
		/* ---------------------------------------------------------------------------- */
		array("name" => "Other Section",
			  "type" => "heading"),
		array("name" => "Date Time for Timer",
			  "desc" => "Enter date time for timer",
			  "id"   => "weaversweb_datetime_timer",
			  "std"  => "2021-01-01 15:37:25",
			  "type" => "text"),
		/* ---------------------------------------------------------------------------- */
		/* Footer Setting */
		/* ---------------------------------------------------------------------------- */
		array("name" => "Footer Section",
			  "type" => "heading"),
		array("name" => "Choose Site Logo",
			  "desc" => "Optimal size: 481px width by 94px height.",
			  "id"   => "weaversweb_footer_logo",
			  "std"  => "",
			  "type" => "upload"),
		array("name" => "Footer Note",
			  "desc" => "Enter footer note",
			  "id"   => "weaversweb_footer_note",
			  "std"  => "",
			  "type" => "textarea"),
		array("name" => "Bottom Copyright",
			  "desc" => "Enter Copyright Text Content",
			  "id"   => "weaversweb_footer_copyright",
			  "std"  => "",
			  "type" => "text"),
		/* ---------------------------------------------------------------------------- */
		/* Social Link Setting */
		/* ---------------------------------------------------------------------------- */
		array("name" => "Social Link Section",
			  "type" => "heading"),	
		array("name" => "Github Link",
			  "desc" => "Enter github link",
			  "id"   => "weaversweb_github_link",
			  "std"  => "#",
			  "type" => "text"),
		array("name" => "Etherscan Link",
			  "desc" => "Enter Etherscan link",
			  "id"   => "weaversweb_etherscan_link",
			  "std"  => "#",
			  "type" => "text"),
		array("name" => "Discord Link",
			  "desc" => "Enter Discord link",
			  "id"   => "weaversweb_discord_link",
			  "std"  => "#",
			  "type" => "text"),
		array("name" => "TG Link",
			  "desc" => "Enter TG link",
			  "id"   => "weaversweb_tg_link",
			  "std"  => "#",
			  "type" => "text"),
		array("name" => "Twitter Link",
			  "desc" => "Enter Twitter link",
			  "id"   => "weaversweb_twitter_link",
			  "std"  => "#",
			  "type" => "text"),		
			);		
		weaversweb_ftn_update_option('of_template',$options);
		}
	}
?>