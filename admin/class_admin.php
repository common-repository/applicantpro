<?php
/**
 *
 * @package    applicantpro
 * @subpackage applicantpro/admin
 * @author     ApplicantPro
 */
class apppro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0
	 * @access   private
	 * @var      string    ApplicantPro The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0
	 * @access   private
	 * @var      string ApplicantPro The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0
	 * @param    string ApplicantPro 
	 * @param    string 1.0
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

                if(isset($_GET['page']) && in_array($_GET['page'], ['apppro_home','apppro_settings'])){
                    // Initialize admin custom style and script.
                    add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
                }

		// Add Menu items
		add_action( 'admin_menu', array( $this, 'apppro_top_menu' ) );

	}

	/**
	 * Register the stylesheets for the admin area.
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker');
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Add plugin menu pages.
	 */
	public function apppro_top_menu(){
   		
   		// Add main main menu page
   		add_menu_page( 'ApplicantPro', 'ApplicantPro', 'manage_options', 'apppro_home', array( $this, 'render_home_page' ) );

   		// Add setting menu page
   		add_submenu_page( 'apppro_home', 'Settings', 'Settings', 'manage_options', 'apppro_settings', array( $this, 'render_setting_page' ) );
   	}

   	/**
	 * Render applicant pro admin home page.
	 */
	public function render_home_page(){
		include(  plugin_dir_path( __FILE__ ) . 'render_home_page.php' );
 	}

 	/**
	 * Render applicant pro admin setting page.
	 */
	public function render_setting_page(){
	 	include( plugin_dir_path( __FILE__ ) . 'render_setting_page.php' );
	}

}
