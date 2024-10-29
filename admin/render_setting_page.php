<?php
if (!current_user_can('manage_options')) {
	wp_die('Unauthorized user');
}

$updated = false;
// save setting into database
if (isset($_POST['save_changes']) && $_POST['save_changes'] != '') {

	check_admin_referer('applicantpro__settings_nonce');

	if (isset($_POST['header_bg_color'])) {
		$header_bg_color = sanitize_hex_color($_POST['header_bg_color']);
		update_option('header_bg_color', $header_bg_color);
	}

	if (isset($_POST['header_title_color'])) {
		$header_title_color = sanitize_hex_color($_POST['header_title_color']);
		update_option('header_title_color', $header_title_color);
	}

	if (isset($_POST['listing_link_color'])) {
		$listing_link_color = sanitize_hex_color($_POST['listing_link_color']);
		update_option('listing_link_color', $listing_link_color);
	}
	
	if (isset($_POST['listing_hover_color'])) {
		$listing_hover_color = sanitize_hex_color($_POST['listing_hover_color']);
		update_option('listing_hover_color', $listing_hover_color);
	}
	
	if (isset($_POST['listing_subtitle_color'])) {
		$listing_subtitle_color = sanitize_hex_color($_POST['listing_subtitle_color']);
		update_option('listing_subtitle_color', $listing_subtitle_color);
	}

	if (isset($_POST['button_bg_color'])) {
		$button_bg_color = sanitize_hex_color($_POST['button_bg_color']);
		update_option('button_bg_color', $button_bg_color);
	}

	if (isset($_POST['button_text_color'])) {
		$button_text_color = sanitize_hex_color($_POST['button_text_color']);
		update_option('button_text_color', $button_text_color);
	}

	if (isset($_POST['twitter_url'])) {
		$twitter_url = wp_unslash($_POST['twitter_url']);
		update_option('applicant_twitter_url', $twitter_url);
	}

	if (isset($_POST['facebook_url'])) {
		$facebook_url = wp_unslash($_POST['facebook_url']);
		update_option('applicant_facebook_url', $facebook_url);
	}

	if (isset($_POST['linkedin_url'])) {
		$linkedin_url = wp_unslash($_POST['linkedin_url']);
		update_option('applicant_linkedin_url', $linkedin_url);
	}
	
	if (isset($_POST['instagram_url'])) {
		$instagram_url = wp_unslash($_POST['instagram_url']);
		update_option('applicant_instagram_url', $instagram_url);
	}

	if (isset($_POST['social_media_enable'])) {
		$social_media_enable = wp_unslash($_POST['social_media_enable']);
		update_option('applicant_social_media_enable', $social_media_enable);
	} else {
		update_option('applicant_social_media_enable', '');
	}

	if (isset($_POST['map_enable'])) {
		$map_enable = wp_unslash($_POST['map_enable']);
		update_option('map_enable', $map_enable);
	} else {
		update_option('map_enable', '');
	}
	
	if (isset($_POST['cityzip_filter'])) {
		$cityzip_filter = wp_unslash($_POST['cityzip_filter']);
		update_option('cityzip_filter', $cityzip_filter);
	} else {
		update_option('cityzip_filter', '');
	}

	if (isset($_POST['classification_filter'])) {
		$classification_filter = wp_unslash($_POST['classification_filter']);
		update_option('classification_filter', $classification_filter);
	} else {
		update_option('classification_filter', '');
	}

	if (isset($_POST['employment_filter'])) {
		$employment_filter = wp_unslash($_POST['employment_filter']);
		update_option('employment_filter', $employment_filter);
	} else {
		update_option('employment_filter', '');
	}

	if (isset($_POST['country_filter'])) {
		$country_filter = wp_unslash($_POST['country_filter']);
		update_option('country_filter', $country_filter);
	} else {
		update_option('country_filter', '');
	}

	if (isset($_POST['state_label'])) {
		$state_label = wp_unslash($_POST['state_label']);
		update_option('state_label', $state_label);
	}

	if (isset($_POST['classification_label'])) {
		$classification_label = wp_unslash($_POST['classification_label']);
		update_option('classification_label', $classification_label);
	}

	if (isset($_POST['employment_additional'])) {
		$employment_additional = wp_unslash($_POST['employment_additional']);
		update_option('employment_additional', $employment_additional);
	} else {
		update_option('employment_additional', '');
	}

	if (isset($_POST['department_additional'])) {
		$department_additional = wp_unslash($_POST['department_additional']);
		update_option('department_additional', $department_additional);
	} else {
		update_option('department_additional', '');
	}

	if (isset($_POST['close_date_additional'])) {
		$close_date_additional = wp_unslash($_POST['close_date_additional']);
		update_option('close_date_additional', $close_date_additional);
	} else {
		update_option('close_date_additional', '');
	}
	
	if (isset($_POST['show_pay_information'])) {
		$show_pay_information = wp_unslash($_POST['show_pay_information']);
		update_option('show_pay_information', $show_pay_information);
	} else {
		update_option('show_pay_information', '');
	}
	
	if (isset($_POST['show_job_location'])) {
		$show_job_location = wp_unslash($_POST['show_job_location']);
		update_option('show_job_location', $show_job_location);
	} else {
		update_option('show_job_location', '');
	}

	if (isset($_POST['map_active_color'])) {
		$map_active_color = sanitize_hex_color($_POST['map_active_color']);
		update_option('map_active_color', $map_active_color);
	}
	
	if (isset($_POST['map_inactive_color'])) {
		$map_inactive_color = sanitize_hex_color($_POST['map_inactive_color']);
		update_option('map_inactive_color', $map_inactive_color);
	}
	
	if (isset($_POST['clear_cache'])) {
		delete_transient('apppro_data');
	}
	
	$updated = true;
}

$header_bg_color = get_option('header_bg_color');
$header_title_color = get_option('header_title_color');
$listing_link_color = get_option('listing_link_color');
$button_bg_color = get_option('button_bg_color');
$button_text_color = get_option('button_text_color');
$listing_hover_color = get_option('listing_hover_color');
$listing_subtitle_color = get_option('listing_subtitle_color');

$applicant_twitter_url = get_option('applicant_twitter_url');
$applicant_facebook_url = get_option('applicant_facebook_url');
$applicant_linkedin_url = get_option('applicant_linkedin_url');
$applicant_instagram_url = get_option('applicant_instagram_url');
$applicant_social_media_enable = get_option('applicant_social_media_enable');

$map_enable = get_option('map_enable');
$cityzip_filter = get_option('cityzip_filter');
$classification_filter = get_option('classification_filter');
$employment_filter = get_option('employment_filter');
$country_filter = get_option('country_filter');
$map_active_color = get_option('map_active_color');
$map_inactive_color = get_option('map_inactive_color');

$state_label = get_option('state_label');
$classification_label = get_option('classification_label');

$employment_additional = get_option('employment_additional');
$department_additional = get_option('department_additional');
$close_date_additional = get_option('close_date_additional');
$show_pay_information = get_option('show_pay_information');
$show_job_location = get_option('show_job_location');
if($show_job_location === false) {// default ON
	$show_job_location = '1';
	update_option('show_job_location', $show_job_location);
}

?>
<?php if ($updated) { ?>
	<div id="message" class="updated notice is-dismissible"><p><strong><?php _e('Settings saved.'); ?></strong></p></div>
<?php } ?>
	<div class="wrap" id="applicantpro">
	<h1>ApplicantPro Settings</h1>
	<p>Use <code>[applicantpro]</code> shortcode to display jobs.</p>
	<form method="post">
		<h2 class="title">Map</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Enable Map </th>
					<td><fieldset>
							<label for="map_enable"><input name="map_enable" type="checkbox" id="map_enable" value="1" <?php
														   if ($map_enable != '') {
															   echo 'checked';
														   }
														   ?> ></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2 class="title">Filter</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">City/Zipcode Field in Filter</th>
					<td><fieldset>
							<label for="cityzip_filter"><input name="cityzip_filter" type="checkbox" id="cityzip_filter" value="1" <?php
														   if ($cityzip_filter != '') {
															   echo 'checked';
														   }
														   ?> ></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Classification Field in Filter</th>
					<td><fieldset>
							<label for="classification_filter"><input name="classification_filter" type="checkbox" id="classification_filter" value="1" <?php
														   if ($classification_filter != '') {
															   echo 'checked';
														   }
														   ?> ></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Employment Type Field in Filter</th>
					<td><fieldset>
							<label for="employment_filter"><input name="employment_filter" type="checkbox" id="employment_filter" value="1" <?php
														   if ($employment_filter != '') {
															   echo 'checked';
														   }
														   ?> ></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row">Country Field in Filter</th>
				<td><fieldset>
						<label for="country_filter"><input name="country_filter" type="checkbox" id="country_filter" value="1" <?php
							if ($country_filter != '') {
								echo 'checked';
							}
							?> ></label>
					</fieldset></td>
			</tr>
			</tbody>
		</table>
		<h2 class="title">Labels</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Label for State Field</th>
					<td><fieldset>
							<label for="state_label"><input name="state_label" type="text" id="state_label" value="<?php if($state_label != '') { echo $state_label; } else { echo "State"; } ?>"></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Label for Classification Field</th>
					<td><fieldset>
						<label for="classification_label"><input name="classification_label" type="text" id="classification_label" value="<?php if($classification_label != '') { echo $classification_label; } else { echo "Classification"; } ?>"></label>
						</fieldset></td>
				</tr>
			</tbody>
		</table>
		<h2 class="title">Additional Information for Job Listings</h2>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row">Show Employment Type</th>
				<td><fieldset>
						<label for="employment_additional"><input name="employment_additional" type="checkbox" id="employment_additional" value="1" <?php
							if ($employment_additional != '') {
								echo 'checked';
							}
							?> ></label>
					</fieldset></td>
			</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row">Show Department</th>
				<td><fieldset>
						<label for="department_additional"><input name="department_additional" type="checkbox" id="department_additional" value="1" <?php
							if ($department_additional != '') {
								echo 'checked';
							}
							?> ></label>
					</fieldset></td>
			</tr>
			</tbody>
		</table>
		<table class="form-table" role="presentation">
			<tbody>
			<tr>
				<th scope="row">Show Closing Date</th>
				<td><fieldset>
						<label for="close_date_additional"><input name="close_date_additional" type="checkbox" id="close_date_additional" value="1" <?php
							if ($close_date_additional != '') {
								echo 'checked';
							}
							?> ></label>
					</fieldset></td>
			</tr>
			<tr>
				<th scope="row">Show Pay Information</th>
				<td><fieldset>
						<label for="show_pay_information">
							<input name="show_pay_information" type="checkbox" id="show_pay_information" value="1" <?php
								if ($show_pay_information != '') {
									echo 'checked';
								}
							?> >
						</label>
					</fieldset></td>
			</tr>
			<tr>
				<th scope="row">Show Job Location</th>
				<td><fieldset>
						<label for="show_job_location">
							<input name="show_job_location" type="checkbox" id="show_job_location" value="1" <?php
								if ($show_job_location != '') {
									echo 'checked';
								}
							?> >
						</label>
					</fieldset></td>
			</tr>
			</tbody>
		</table>
		<h2 class="title">Colors</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row"><label for="map_active_color">Map</label></th>
					<td class="map-table">
						<div class="col-md-3"><span class="span-2">Active</span> <span class="span-1"><input type="text" name="map_active_color" value="<?Php echo $map_active_color; ?>" class="my-color-field map_active_color" data-default-color="" /></span></div>
						<div class="col-md-3"><span class="span-2">Inactive</span> <span class="span-1"><input type="text" name="map_inactive_color" value="<?Php echo $map_inactive_color; ?>" class="my-color-field map_inactive_color" data-default-color="" /></span></div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="header_bg_color">Header</label></th>
					<td class="map-table">
						<div class="col-md-3"><span class="span-2">Background</span> <span class="span-1"><input type="text" name="header_bg_color" value="<?Php echo $header_bg_color; ?>" class="my-color-field header_bg_color" data-default-color="" /></span></div>
						<div class="col-md-3"><span class="span-2">Text</span> <span class="span-1"><input type="text" name="header_title_color" value="<?Php echo $header_title_color; ?>" class="my-color-field header_title_color" data-default-color="" /></span></div>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="listing_link_color">Listing Title</label></th>
					<td class="map-table">
						<div class="col-md-3"><span class="span-2">Link</span> <span class="span-1"><input type="text" name="listing_link_color" value="<?Php echo $listing_link_color; ?>" class="my-color-field listing_link_color" data-default-color="" /></span></div>
						<div class="col-md-3"><span class="span-2">Link Hover</span> <span class="span-1"><input type="text" name="listing_hover_color" value="<?Php echo $listing_hover_color; ?>" class="my-color-field listing_hover_color" data-default-color="" /></span></div>
						<div class="col-md-3"><span class="span-2">Subtitle</span> <span class="span-1"><input type="text" name="listing_subtitle_color" value="<?Php echo $listing_subtitle_color; ?>" class="my-color-field listing_subtitle_color" data-default-color="" /></span></div>
					</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="button_bg_color">Button</label></th>
					<td class="map-table">
						<div class="col-md-3"><span class="span-2">Background</span> <span class="span-1"><input type="text" name="button_bg_color" value="<?Php echo $button_bg_color; ?>" class="my-color-field button_bg_color" data-default-color="" /></span></div>
						<div class="col-md-3"><span class="span-2">Text</span> <span class="span-1"><input type="text" name="button_text_color" value="<?Php echo $button_text_color; ?>" class="my-color-field button_text_color" data-default-color="" /></span></div>
					</td>
				</tr>
				
			</tbody>
		</table>
		<h2 class="title">Social Media</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Enable Social Media Icons</th>
					<td><fieldset>
							<label for="social_media_enable"><input name="social_media_enable" type="checkbox" id="social_media_enable" value="1" <?php
if ($applicant_social_media_enable != '') {
	echo 'checked';
}
?> ></label>
						</fieldset>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="twitter_url">Twitter URL</label></th>
					<td><input name="twitter_url" type="text" id="twitter_url" value="<?php echo $applicant_twitter_url; ?>" class="regular-text" ></td>
				</tr>
				<tr>
					<th scope="row"><label for="facebook_url">Facebook URL</label></th>
					<td><input name="facebook_url" type="text" id="facebook_url" value="<?php echo $applicant_facebook_url; ?>" class="regular-text" ></td>
				</tr>
				<tr>
					<th scope="row"><label for="linkedin_url">LinkedIn URL</label></th>
					<td><input name="linkedin_url" type="text" id="linkedin_url" value="<?php echo $applicant_linkedin_url; ?>" class="regular-text" ></td>
				</tr>
				<tr>
					<th scope="row"><label for="instagram_url">Instagram URL</label></th>
					<td><input name="instagram_url" type="text" id="instagram_url" value="<?php echo $applicant_instagram_url; ?>" class="regular-text" ></td>
				</tr>
			</tbody>
		</table>
		<h2 class="title">Cache</h2>
		<table class="form-table" role="presentation">
			<tbody>
				<tr>
					<th scope="row">Clear Cache </th>
					<td><fieldset>
							<label for="clear_cache"><input name="clear_cache" type="checkbox" id="clear_cache" value="1"></label>
						</fieldset>
					</td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field('applicantpro__settings_nonce'); ?>
		<p class="submit"><input type="submit" name="save_changes" id="save_changes" class="button button-primary" value="Save Changes"></p>
	</form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$('.my-color-field').wpColorPicker();
	});
</script>
