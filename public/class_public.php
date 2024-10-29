<?php

/**
 *
 * @package    applicantpro
 * @subpackage applicantpro/public
 * @author     ApplicantPro
 */
class apppro_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0
     * @access   private
     * @var      string    $plugin_name   The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0
     * @access   private
     * @var      string $version   The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0
     * @param    string $plugin_name  The name of this plugin.
     * @param    string $version      The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        // Create shortcode for news listing.
        if (!is_admin()) {
            add_shortcode('applicantpro', array($this, 'subscribe_multilink_shortcode'));
        }
    }

    /**
     * Render shortcode.
     *
     * @param Array $atts shortcode parameters.
     */
    public function subscribe_multilink_shortcode($atts) {
        ob_start();
        include( plugin_dir_path(__FILE__) . 'render_shortcode.php' );
        return ob_get_clean();
    }

    /**
     * Search perform.
     *
     * @param Array $jobs all jobs.
     */
    public function search_jobs($rss_jobs, $get_keyword = '', $get_city = '', $get_state = '', $get_cities = '', $get_employment = '', $get_classification = '', $get_country = '', $show_job_location = 1) {
		$search_result = [];

        foreach ($rss_jobs as $job) {
            $keyword_check = 1;
            $city_check = 1;
			$cities_check = 1;
            $state_check = 1;
            $employment_check = 1;
            $classification_check = 1;
            $country_check = 1;

            if(!empty($get_state)) {
                $state_check = $this->search_state($get_state, $job, $show_job_location);
            }

            if(!empty($get_keyword)) {
                $keyword_check = $this->search_keyword($get_keyword, $job);
            }

            if(!empty($get_city)) {
                $city_check = $this->search_city($get_city, $job, $show_job_location);
            }

			if (!empty($get_cities)) {
				$cities_check = $this->search_cities($get_cities, $job, $show_job_location);
			}

            if(!empty($get_employment)) {
                $employment_check = $this->search_employment($get_employment, $job);
            }

            if (!empty($get_classification)) {
                $classification_check = $this->search_classification($get_classification, $job);
            }

            if(!empty($get_country)) {
                $country_check = $this->search_country($get_country, $job);
            }

            if ($keyword_check === 1 && $city_check === 1 && $state_check === 1 && $employment_check === 1
	            && $classification_check === 1 && $country_check === 1 && $cities_check === 1) {
                $search_result[] = $job;
            }
        }
        return $search_result;
    }

    /**
     * Search job by keyword in title.
     *
     * @param String $keyword keyword get variable
     * @param Array $job job to search information in.
     */

    public function search_keyword($keyword, $job) {
        if(strpos(strtolower($job['title']), strtolower($keyword)) === false) {
            return 0;
        }

        return 1;
    }

    /**
     * Search job by city or postal code.
     *
     * @param String $city city get variable
     * @param Array $job job to search information in.
     */

    public function search_city($city, $job, $show_job_location) {
        $job_city = $job['city'];
        $job_postalcode = $job['postalcode'];
        if(!empty($show_job_location)) {
            $job_city = $job['jl_city'];
            $job_postalcode = $job['jl_postalcode'];
        }

        if(strpos(strtolower((string) $job_city), strtolower($city)) === false && $job_postalcode !== $city) {
            return 0;
        }

        return 1;
    }

	/**
	 * Search job by cities label filters
	 *
	 * @param $cities
	 * @param $job
	 */

	public function search_cities($cities, $job, $show_job_location) {
        $job_city = !empty($show_job_location) ? $job['jl_city'] : $job['city'];
		if(strpos($cities, $job_city) === false) {
			return 0;
		}

		return 1;
	}

    /**
     * Search job by state.
     *
     * @param String $state state get variable
     * @param Array $job job to search information in.
     */

    public function search_state($state, $job, $show_job_location) {
        $job_state_abbreviation = !empty($show_job_location) ? $job['jl_state_abbreviation'] : $job['state_abbreviation'];
        if(strtolower($job_state_abbreviation) !== strtolower($state)) {
            return 0;
        }

        return 1;
    }

    /**
     * Search job by employment type.
     *
     * @param String $employment employment get variable
     * @param Array $job job to search information in.
     */


    public function search_employment($employment, $job) {
        if(strtolower($job['jobtype']) !== strtolower($employment)) {
            return 0;
        }

        return 1;
    }

    /**
     * Search job by classification.
     *
     * @param String $classification classification get variable
     * @param Array $job job to search information in.
     */

    public function search_classification($classification, $job) {
        if(is_array($job['category']) || strtolower($job['category']) !== strtolower($classification)) {
            return 0;
        }

        return 1;
    }

    /**
     * Search job by country.
     *
     * @param String $country country get variable
     * @param Array $job job to search information in.
     */

    public function search_country($country, $job) {
        if(is_array($job['country']) || strtolower($job['country']) !== strtolower($country)) {
            return 0;
        }

        return 1;
    }


}
