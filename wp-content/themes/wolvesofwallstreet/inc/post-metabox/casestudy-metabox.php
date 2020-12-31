<?php
function bannercontent_section_add_meta_box(){
	$screens = array('page');
	//if(is_page(7)){
		foreach($screens as $screen){
			add_meta_box(
			'featured_section_sectionid',
			__('Featured Project Section','arc'),
			'bannercontent_section_meta_box_callback',
			$screen
			);			
			}
		//}
	}
add_action('add_meta_boxes','bannercontent_section_add_meta_box');
function bannercontent_section_meta_box_callback($post){
	wp_nonce_field('bannercontent_section_save_meta_box_data','bannercontent_section_meta_box_nonce');
	$value = get_post_meta($post->ID,'_bannercontent_section_value_key',true);
	echo '<label for="bannercontent_section_field">';
	_e('Select Image Option: ','arc');
	echo '</label> '; ?><br />
	<div style="padding:5px 0 0 0;"><input type="radio" id="bannercontent_section_field" name="bannercontent_section_field" value="0" <?php if($value == '0'){?> checked="checked"<?php } ?> />Disable Image Option</div>
	<div style="padding:5px 0 0 0;"><input type="radio" id="bannercontent_section_field" name="bannercontent_section_field" value="1" <?php if($value == '1'){?> checked="checked"<?php } ?>/>Services Utilities Image</div>
    <div style="padding:5px 0 0 0;"><input type="radio" id="bannercontent_section_field" name="bannercontent_section_field" value="2" <?php if($value == '2'){?> checked="checked"<?php } ?>/>Services Industrial Image</div>
    <?php
	}
function bannercontent_section_save_meta_box_data($post_id){
	if(!isset($_POST['bannercontent_section_meta_box_nonce'])){
		return;
		}
	if(!wp_verify_nonce($_POST['bannercontent_section_meta_box_nonce'],'bannercontent_section_save_meta_box_data')){
		return;
		}
	if(defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){
		return;
		}
	if(isset($_POST['post_type'])&& 'projects' == $_POST['post_type']){
		if(!current_user_can('edit_page',$post_id)){
			return;
			}
		}else{
		if(!current_user_can('edit_post',$post_id)){
			return;
			}
		}
	if(!isset($_POST['bannercontent_section_field'])){
		return;
		}
	$my_data = sanitize_text_field($_POST['bannercontent_section_field']);
	update_post_meta($post_id,'_bannercontent_section_value_key',$my_data);
	}
add_action('save_post','bannercontent_section_save_meta_box_data');