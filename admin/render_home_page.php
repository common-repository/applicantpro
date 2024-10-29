<?php
	if (!current_user_can('manage_options')) {
		wp_die('Unauthorized user');
	}

	$updated = false;
	$total_tokens = 5;
	
	// save setting into database
	if (isset($_POST['submit']) && $_POST['submit'] != '') {
		
		//verify each field has data, if not ignore it.
		$new_token_array = [];
		for($i = 0; $i < $total_tokens; $i++):
			$token_name = "applicantpro_token_{$i}";
			if(!empty($_POST[$token_name])):
				$new_token_array[] = $_POST[$token_name];
			endif;
		endfor;
		
		check_admin_referer('applicantpro__api_nonce');
		// update tokens
		for($i = 0; $i < $total_tokens; $i++) {
			$token_name = "applicantpro_token_{$i}";
			if(isset($_POST[$token_name])) {
				if(isset($new_token_array[$i])) {
					$new_token = $new_token_array[$i];
					update_option($token_name, $new_token);
				} else {
					update_option($token_name, '');
				}
			}
		}
		
		delete_transient('apppro_data');
	
		$updated = true;
	}

	//Get tokens
	$tokens = [];
	for($i = 0; $i < $total_tokens; $i++) {
		$tokens[$i] = get_option('applicantpro_token_'.$i);
	}
	
	$applicantpro_api = get_option('applicantpro_api');

?>
<?php if ($updated) { ?>
	<div id="message" class="updated notice is-dismissible"><p><strong><?php _e('Settings saved.'); ?></strong></p></div>
<?php } ?>

<div class="wrap" id="applicantpro">
	<h1>ApplicantPro Authentication</h1>
	<p>All tokens can be found in your Career Sites Applicant Tracking System->Career Site->Controls area.</p>
	<p>To remove a token just clear out the data and save.</p>
	<form method="post" name="applicantpro_api" class="applicantpro_login">
		<table class="form-table" role="presentation">
			<tbody>
			<?php
				foreach ($tokens as $key => $token) {
					if($key === 0) { // always show the first token
			?>
					<tr id="applicantpro_token_<?= $key ?>">
						<th scope="row"><label for="applicantpro_token_<?=$key?>">Token <?= $key + 1 ?>:</label></th>
						<td>
							<input style="width:90%;" name="applicantpro_token_<?= $key ?>" type="text" id="applicantpro_token_<?= $key ?>" class="regular-text" value="<?= $token; ?>">
						</td>
					</tr>
			<?php
						$last_key = $key + 1;
					} elseif($key > 0 && !empty($token)) {
			?>
				<tr id="applicantpro_token_<?= $key ?>">
					<th scope="row"><label for="applicantpro_token_<?=$key?>">Token <?= $key + 1 ?>:</label></th>
					<td>
						<input style="width:90%;" name="applicantpro_token_<?= $key ?>" type="text" id="applicantpro_token_<?= $key ?>" class="regular-text" value="<?= $token; ?>">
					</td>
				</tr>
			<?php
					$last_key = $key + 1;
					}
				}
			?>
			<tr id="new_token" style="display: none" id="applicantpro_token_<?= $last_key ?>">
				<th scope="row"><label for="applicantpro_token_<?=$last_key?>">Token <?= $last_key + 1 ?>:</label></th>
				<td>
					<input style="width:90%;" name="applicantpro_token_<?= $last_key ?>" type="text" id="applicantpro_token_<?= $last_key ?>" class="regular-text" value="">
				</td>
			</tr>
			</tbody>
		</table>
		
		<button type="button" id="add_token" data-id="<?=$last_key?>" class="button" style="display:<?=($last_key < 5) ? 'block' : 'none' ?>;">+</button>
		<?php wp_nonce_field('applicantpro__api_nonce'); ?>
		<p class="submit"><input type="submit" name="submit"  class="button button-primary" value="Save Changes"></p>
	</form>
</div>
