<div id="applicantpro">
<?php 
	$applicantpro_tokens = [];
	for($i = 0; $i < 5; $i++) {
		$token_name = "applicantpro_token_{$i}";
		$token = get_option($token_name);
		if(!empty($token)) {
			$applicantpro_tokens[] = $token;
		}
	}
	$applicantpro_token = implode(',', $applicantpro_tokens);
	$applicantpro_token_array = explode('_', $applicantpro_token);
		
	global $filename;
	$filename = 'https://feeds.applicantpro.com/feeds/wordpress.xml?wordpress_token='.$applicantpro_token;

	$applicant_logo = plugin_dir_url( __FILE__ ).'images/applicant-pro.png';
	
	$reference = get_query_var( 'referencenumber');
	
	if ($reference && is_numeric($reference)) {
		include(  plugin_dir_path( __FILE__ ) . 'render_detail_page.php' );		
	} else {
		include(  plugin_dir_path( __FILE__ ) . 'render_listing_page.php' );		
	}
?>
</div>
