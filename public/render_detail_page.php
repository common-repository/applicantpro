<?php
$header_bg_color = get_option('header_bg_color');
$header_title_color = get_option('header_title_color');
$button_bg_color = get_option('button_bg_color');
$button_text_color = get_option('button_text_color');
$listing_subtitle_color = get_option('listing_subtitle_color');
$applicant_social_media_enable = get_option('applicant_social_media_enable');

$employment_additional = get_option('employment_additional');
$department_additional = get_option('department_additional');
$close_date_additional = get_option('close_date_additional');
$show_pay_information = get_option('show_pay_information');
$show_job_location = get_option('show_job_location');

$referencenumber = get_query_var( 'referencenumber');
$root_domain[3] = 'prevueaps.com';
$root_domain[4] = 'applicantpro.com';
$root_domain[8] = 'prevueapspro.com';
$root_domain[10] = 'applicantpool.com';
$root_domain[12] = 'applicantlist.com';
$root_domain[13] = 'exactapplicant.com';
$root_domain[14] = 'applicantpro1.com';
$root_domain[15] = 'applicantpro2.com';
$root_domain[16] = 'applicantpro3.com';
$root_domain[17] = 'hirelist.com';
$root_domain[24] = 'talentplushire.com';
$root_domain[25] = 'recruit4business.com';
$root_domain[27] = 'aaimtrack.com';
$root_domain[30] = 'prevueaps.ca';
$root_domain[31] = 'workbrightats.com';
$root_domain[32] = 'isolvedhire.com';
$root_domain[33] = 'efficientapply.com';
$root_domain[34] = 'recruitpro.com';
$root_domain[35] = 'itnhire.com';
$root_domain[36] = 'mitcawm.com';
$root_domain[37] = 'mitccwm.com';
$root_domain[38] = 'casellehire.com';
$root_domain[39] = 'asurehire.com';
$root_domain[40] = 'rapidrecruitats.com';
$root_domain[41] = 'hiringoptimization.com';
$root_domain[42] = 'momentumrecruiter.com';
$root_domain[43] = 'talentasap.io';
$root_domain[44] = 'mysmarthire.com';
$root_domain[45] = 'disahire.com';
$root_domain[46] = 'referenceservicesinc.com';
$root_domain[47] = 'rushtohire.com';

$add_source = (isset($_GET['source'])) ? '&source=' . intval($_GET['source']) : '';

	$apppro_data = get_apppro_xml_data();

if (count($apppro_data) == 0) {
	echo '<div class="applicantpro_main cf min-height"><h2 style="padding:20px 0;">No Current Job Openings.</h2></div></div>';
} else {
	?>
	<style type="text/css">
		<?php if($listing_subtitle_color){?>
		#applicantpro .job-time span{ color: <?php echo $listing_subtitle_color;?> !important;}
		<?php }?>
	</style>
	<!-- Start Search Job -->
	<div class="light-blue search-job job-details" style="<?php
	if ($header_bg_color != '') {
		echo 'background:' . $header_bg_color . '; ';
	}
	?>">
		<div class="applicantpro_main">
			<?php $back_result = strtok($_SERVER["REQUEST_URI"], '?'); ?>
			<div class="ap_title_5"><a href="javascript:history.back();" style="<?php
				if ($header_title_color != '') {
					echo 'color:' . $header_title_color . '; ';
				}
				?>">&lt; Back To Results</a></div>
		</div>
	</div>
	<!-- End Search Job -->
	<?php
	$flag = 0;
	$logo_set = false;
//    $root_domain_url = 'javascript:void(0)';
	foreach ($apppro_data['job'] as $job) {
		if (trim($job['referencenumber']) == $referencenumber) {
			$flag = 1;
			$job_title = !empty($job['title']) ? $job['title'] : '';
			
			if(!empty($show_job_location)) {// Use Job Location
				$city = !empty($job['jl_city']) ? $job['jl_city'] : '';
				$state = !empty($job['jl_state']) ? $job['jl_state'] : '';
				$postalcode = !empty($job['jl_postalcode']) ? $job['jl_postalcode'] : '';
			} else {// Use Job Ad Location
				$city = !empty($job['city']) ? $job['city'] : '';
				$state = !empty($job['state']) ? $job['state'] : '';
				$postalcode = !empty($job['postalcode']) ? $job['postalcode'] : '';
			}
			$country = !empty($job['country']) ? $job['country'] : '';
			
			$jobtype = !empty($job['jobtype']) ? $job['jobtype'] : '';
			$jobdate = !empty($job['date']) ? date("m/d/Y", strtotime($job['date'])) : '';
			$enddate = !empty($job['end_date']) ? date("m/d/Y", strtotime($job['end_date'])) : '';
			$department = !empty($job['org_unit_title']) ? $job['org_unit_title'] : '';
			$job_description = !empty($job['description']) ? $job['description'] : '';

			if (isset($job['root_domain']) && $logo_set == false) {
				if ($job['root_domain'] == 'ApplicantList') {
					$applicant_logo = plugin_dir_url(__FILE__) . 'images/applicant-list.png';
				}
				if($job['root_domain'] == 'iSolved Hire') {
					$applicant_logo = plugin_dir_url(__FILE__) . 'images/isolved.png';
				}
				$root_domain_url = !empty($job['root_domain_url']) ? $job['root_domain_url'] : '';
				$logo_set = true;
			}

			?>
			<!-- Start Job List -->
			<?php
				$rd_url = $root_domain[$applicantpro_token_array[1]];
				if(!empty($rd_url)) {?>
					<img src="https://feeds.<?=$rd_url?>/jobs/images/tracker.php?site_id=<?=$applicantpro_token_array[0]?>&listing_id=<?=$job['referencenumber']?>>&source_id=0">
			<?php }?>
			<div class="cf">
				<div class="applicantpro_main cf">
					<div class="ap_row">
						<div class="news-details">
							<div class="ap_title_3"><?php echo $job_title; ?></div>

							<div class="job-time">
								<?php if($department_additional == 1) { ?>
									<span>
										<b>Department: </b><?php echo $department ?>
									</span>
									<div style="flex: 0 0 25px;"></div>
								<?php } ?>
								<?php if($close_date_additional == 1) { ?>
									<span>
										<b>Close Date: </b><?php echo $enddate ?>
									</span>
									<div style="flex: 0 0 25px;"></div>
								<?php } ?>
								<?php if($employment_additional == 1) { ?>
									<div class="icon" style="margin-right: 3px;">
										<?php echo file_get_contents(__DIR__.'/images/icons/time-line.svg'); ?>
									</div>
									<span>
										<?php echo $jobtype; ?>
									</span>
									<div style="flex: 0 0 25px;"></div>
								<?php } ?>
								<?php if($show_pay_information && !empty($job['salary'])) { ?>
									<div class="icon" style="margin-right: 3px;">
										<?php echo file_get_contents(__DIR__.'/images/icons/money.svg'); ?>
									</div>
									<span>
										<?php echo $job['salary']; ?>
									</span>
									<div style="flex: 0 0 25px;"></div>
								<?php } ?>
								<div class="icon" style="margin-right: 3px;">
								  <?php echo file_get_contents(__DIR__.'/images/icons/location.svg'); ?>
								</div>
								<span>
								  <?php
									  if(!empty($city))
										  echo ucfirst($city) . ', ';

									  if(!empty($state))
										  echo $state . ', ';

									  if(!empty($country))
										  echo $country . ' - ';

									  echo rtrim($postalcode, '- ');
								  ?>
								</span>
							</div>
							<div class="ap_title_5">Description</div>
							<div class="job-description">
								<?php echo $job_description; ?>
							</div>
							<div class="apply-now apply-bottom">
								<a target="_blank" href="<?=$job['url'] . $add_source?>" style="<?php
								if ($button_bg_color != '') {
									echo 'background-color:' . $button_bg_color . '; ';
								} if ($button_text_color != '') {
									echo 'color:' . $button_text_color . '; ';
								}
								?>">Apply Now</a>
							</div>

						</div>
						<div class="right-sidebar">
							<div class="apply-now"><a target="_blank" href="<?=$job['url'] . $add_source?>" style="<?php
								if ($button_bg_color != '') {
									echo 'background-color:' . $button_bg_color . '; ';
								} if ($button_text_color != '') {
									echo 'color:' . $button_text_color . '; ';
								}
								?>">Apply Now</a></div>
								<?php
								if ($applicant_social_media_enable == 1) {
									$applicant_twitter_url = get_option('applicant_twitter_url');
									$applicant_facebook_url = get_option('applicant_facebook_url');
									$applicant_linkedin_url = get_option('applicant_linkedin_url');
									$applicant_instagram_url = get_option('applicant_instagram_url');
									?>
								<div class="social-media">
									<div class="ap_title_6">Social Media</div>
									<?php if ($applicant_twitter_url != '') { ?>
										<a
										  href="<?php echo $applicant_twitter_url; ?>"
										  target="_blank"
										>
										  <div class="icon large">
											<?php echo file_get_contents(__DIR__.'/images/icons/twitter-square.svg'); ?>
										  </div>
										</a>
									<?php } ?>
									<?php if ($applicant_linkedin_url != '') { ?>
										<a
										  href="<?php echo $applicant_linkedin_url; ?>"
										  target="_blank"
										>
										  <div class="icon large">
											<?php echo file_get_contents(__DIR__.'/images/icons/linkedin-square.svg'); ?>
										  </div>
										</a>
									<?php } ?>
									<?php if ($applicant_facebook_url != '') { ?>
										<a
										  href="<?php echo $applicant_facebook_url; ?>"
										  target="_blank"
										>
										  <div class="icon large">
											<?php echo file_get_contents(__DIR__.'/images/icons/facebook-square.svg'); ?>
										  </div>
										</a>
									<?php } ?>
									<?php if ($applicant_instagram_url != '') { ?>
										<a
										  href="<?php echo $applicant_instagram_url; ?>"
										  target="_blank"
										>
										  <div class="icon large">
											<?php echo file_get_contents(__DIR__.'/images/icons/instagram-square.svg'); ?>
										  </div>
										</a>
									<?php } ?>
								</div>
							<?php } ?>
							<div class="applicant-power cf"><a href="<?php echo $root_domain_url;?>" target="_blank"><img src="<?php echo $applicant_logo; ?>"></a></div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Job List -->
			<?php
		}
	}
	if ($flag == 0) {
		echo '<div class="cf"><div class="applicantpro_main cf"><div class="row"><div class="col-md-12"><div class="joblist"><h3 style="margin-top:15px;">No jobs found</h3></div></div></div></div></div>';
	}
}
?>
