<?php 
namespace TheplusAddons;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

final class Theplus_Element_Load {
	/**
		* Core singleton class
		* @var self - pattern realization
	*/
	private static $_instance;

	/**
	 * @var Manager
	 */
	private $_modules_manager;

	/**
	 * @deprecated
	 * @return string
	 */
	public function get_version() {
		return THEPLUS_VERSION;
	}
	
	/**
	* Cloning disabled
	*/
	public function __clone() {
	}
	
	/**
	* Serialization disabled
	*/
	public function __sleep() {
	}
	
	/**
	* De-serialization disabled
	*/
	public function __wakeup() {
	}
	
	/**
	* @return \Elementor\Theplus_Element_Loader
	*/
	public static function elementor() {
		return \Elementor\Plugin::$instance;
	}
	
	/**
	* @return Theplus_Element_Loader
	*/
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	/**
	 * we loaded module manager + admin php from here
	 * @return [type] [description]
	 */
	private function includes() {	
		if( !class_exists( 'Theplus_SL_Plugin_Updater' ) && THEPLUS_TYPE=='store') {
			include( THEPLUS_PATH . 'includes/Theplus_SL_Plugin_Updater.php' );
		}
		require_once THEPLUS_INCLUDES_URL .'plus_addon.php';
		require_once THEPLUS_INCLUDES_URL .'template-api.php';
		require THEPLUS_INCLUDES_URL.'theplus_options.php';
		require THEPLUS_PATH.'modules/theplus-integration.php';
		
		require_once THEPLUS_PATH .'modules/helper-function.php';
		
		if ( file_exists(THEPLUS_INCLUDES_URL . 'plus-options/metabox/init.php' ) ) {
			require_once THEPLUS_INCLUDES_URL.'plus-options/includes.php';
		}
		
		if( empty( get_option( 'theplus-notice-dismissed' ) ) ) {
			add_action( 'admin_notices',array($this, 'thepluskey_verify_notify'));
		}
		
	}
	
	
	public function theplus_register_scripts() {
		
		$theplus_performance=get_option( 'theplus_performance' );		
		
		$plus_extras=theplus_get_option('general','extras_elements');
		$theplus_options=get_option('theplus_options');
		if(!empty($theplus_performance['compress_minify_js'])){
			$minify_js=$theplus_performance['compress_minify_js'];
		}else{
			$minify_js='disable';
		}
		wp_enqueue_script("jquery-effects-core");
		$options = get_option( 'theplus_api_connection_data' );
		$check_elements=theplus_get_option('general','check_elements');
		$switch_api = (!empty($options['gmap_api_switch'])) ? $options['gmap_api_switch'] : '';
		
		if(!empty($options['theplus_google_map_api'])){
			$theplus_google_map_api=$options['theplus_google_map_api'];
		}else{
			$theplus_google_map_api='AIzaSyAVRU9TRlsqthh0Z3zpaDvzIXeQuctSat8';
		}
		if((empty($theplus_options) || (isset($check_elements) && !empty($check_elements) && in_array('tp_google_map',$check_elements))) && (empty($switch_api) || $switch_api=='enable')){
			wp_enqueue_script( 'gmaps-js','//maps.googleapis.com/maps/api/js?key='.$theplus_google_map_api.'&sensor=false', array('jquery'), null, false, true);
		}
		wp_enqueue_script( 'modernizr_js', THEPLUS_ASSETS_URL .'js/extra/modernizr.min.js');
		wp_register_script( 'easepack_js', THEPLUS_ASSETS_URL .'js/extra/easepack.min.js'); //EasePack.min.js canvas style 3	
		wp_register_script( 'raf_js',THEPLUS_ASSETS_URL .'js/extra/rAF.js',array(),'', true);//all canvas 3		
		wp_register_script( 'projector_js', THEPLUS_ASSETS_URL .'js/extra/stats.min.js',array(),'', true);//all canvas 3
		wp_register_script( 'particleground_js', THEPLUS_ASSETS_URL .'js/extra/jquery.particleground.js'); // canvas style 6
		wp_register_script( 'social-chaffle', THEPLUS_ASSETS_URL .'js/extra/jquery.chaffle.min.js',array(),'', true ); // social text chaffle
		
		wp_register_script( 'before-after', THEPLUS_ASSETS_URL .'js/main/theplus-before-after.js',array(),'', true ); //before after js
		wp_register_script( 'plus-datatable', THEPLUS_ASSETS_URL .'js/extra/jquery.datatables.min.js',array('jquery'),'', true ); //table widget
	
		wp_register_script( 'circle-menu', THEPLUS_ASSETS_URL .'js/extra/jquery.circlemenu.js',array(),'', true ); // Circle menu js		
		wp_register_script( 'page-scroll-nav', THEPLUS_ASSETS_URL .'js/extra/pagescroll2id.js',array(),'', true ); // Scroll Navigation js		
		wp_enqueue_script( 'circle-progress', THEPLUS_ASSETS_URL .'js/extra/circle-progress.js',array(),'', true ); // progress bar js
		
		if(empty($theplus_performance['isotope_js_load']) || $theplus_performance['isotope_js_load'] != "disable"){
			wp_enqueue_script( 'isotope-js', THEPLUS_ASSETS_URL .'js/extra/isotope.pkgd.js',array('jquery'),'', true );
			wp_enqueue_script( 'packery-mode-js', THEPLUS_ASSETS_URL .'js/extra/packery-mode.pkgd.min.js',array('jquery'),'', true );
		}else if(isset($theplus_performance['isotope_js_load']) && $theplus_performance['isotope_js_load'] == "enable"){
			wp_enqueue_script( 'isotope-js', THEPLUS_ASSETS_URL .'js/extra/isotope.pkgd.js',array('jquery'),'', true );
			wp_enqueue_script( 'packery-mode-js', THEPLUS_ASSETS_URL .'js/extra/packery-mode.pkgd.min.js',array('jquery'),'', true );
		}
		
		if(isset($plus_extras) && empty($plus_extras) && empty($theplus_options)){
			wp_enqueue_script( 'skrollr', THEPLUS_ASSETS_URL . 'js/extra/skrollr.min.js',array('jquery'),'', true);
		}else if(isset($plus_extras) && !empty($plus_extras) && in_array('section_scroll_animation',$plus_extras)){		
			wp_enqueue_script( 'skrollr', THEPLUS_ASSETS_URL . 'js/extra/skrollr.min.js',array('jquery'),'', true);
		}
		
		wp_enqueue_script( 'theplus_ele_frontend_scripts', THEPLUS_ASSETS_URL . 'js/extra/app.min.js',array(),'', false );
		wp_register_script( 'theplus-offcanvas', THEPLUS_ASSETS_URL .'js/main/theplus-offcanvas.js',array(),'', true ); // Off canvas
		echo '<script> var theplus_ajax_url = "'.admin_url('admin-ajax.php').'";</script>';
		wp_localize_script('theplus_frontend_scripts', 'ajax_var', array(
			'url' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce')
		));
		if($minify_js=='enable'){
			wp_enqueue_script( 'theplus-custom', THEPLUS_ASSETS_URL .'js/main/theplus-custom.min.js',array('jquery'),THEPLUS_VERSION, false);
		}else{
			wp_enqueue_script( 'theplus-custom', THEPLUS_ASSETS_URL .'js/main/theplus-custom.js',array('jquery'),THEPLUS_VERSION, false);
		}
	}
	
	/**
	* Widget Include required files
	*
	*/
	public function include_widgets()
	{	
		require_once THEPLUS_PATH.'modules/theplus-include-widgets.php';		
	}
	
	public function theplus_enqueue_style() {
		$theplus_performance=get_option( 'theplus_performance' );
		$get_name = wp_get_theme();
		
		if(!empty($theplus_performance['compress_minify_css'])){
			$minify_css=$theplus_performance['compress_minify_css'];
		}else{
			$minify_css='disable';
		}
		
		wp_enqueue_style( 'theplus-extras-css', THEPLUS_URL . 'assets/css/extra/plus-extras.css', [], THEPLUS_VERSION );
		if($minify_css=='enable'){
			wp_enqueue_style( 'pt_theplus-style-min',THEPLUS_URL .'assets/css/main/theplus_style_min.css');
		}else{
			wp_enqueue_style( 'pt_theplus-style',THEPLUS_URL .'assets/css/main/theplus_style.css');
		}
		
		wp_register_style( 'info-box-css', THEPLUS_URL . 'assets/css/main/theplus-info-box-style.css', [], THEPLUS_VERSION );//infobox
		wp_register_style( 'theplus-tabs-tours-ele', THEPLUS_URL . 'assets/css/main/theplus-tabs-tours.css', [], THEPLUS_VERSION );//tabs-tours
		wp_register_style( 'theplus-stylist-list', THEPLUS_URL .'assets/css/main/theplus-stylist-list.css', [], THEPLUS_VERSION );//stylist list
		wp_register_style( 'theplus-pricing-table', THEPLUS_URL .'assets/css/main/theplus-pricing-table.css', [], THEPLUS_VERSION );//pricing-table
				
		wp_register_style( 'theplus-pricing-list', THEPLUS_URL .'assets/css/main/theplus-pricing-list.css', [], THEPLUS_VERSION );//pricing list
		wp_register_style( 'theplus-advertisement-banner', THEPLUS_URL .'assets/css/main/theplus-addbanner.css', [], THEPLUS_VERSION );//advertsment-banner
		
		wp_register_style( 'tp-columns-bootstrap', THEPLUS_URL .'assets/css/extra/tp-bootstrap-grid.css'); //bootstrap column grid css	
		wp_register_style( 'plus-blog-style', THEPLUS_URL .'assets/css/main/theplus-blog-style.css'); //blogs
		wp_register_style( 'plus-testimonial-style', THEPLUS_URL .'assets/css/main/theplus-testimonial-style.css'); //testimonial
		wp_register_style( 'plus-client-style', THEPLUS_URL .'assets/css/main/theplus-client-style.css'); //client
		wp_register_style( 'plus-gallery-style', THEPLUS_URL .'assets/css/main/theplus-gallery-style.css'); //gallery
		wp_register_style( 'plus-team-member-style', THEPLUS_URL .'assets/css/main/theplus-team-member-style.css'); //Team Member
		wp_register_style( 'plus-cf7-style', THEPLUS_URL .'assets/css/main/theplus-cf7-style.css'); //contact form 7
		wp_register_style( 'plus-hotspot-style', THEPLUS_URL .'assets/css/main/theplus-hotspot.css'); //hotspot
		wp_register_style( 'plus-product-style', THEPLUS_URL .'assets/css/main/theplus-product-style.css'); //product
		wp_register_style( 'plus-timeline-style', THEPLUS_URL .'assets/css/main/theplus-timeline-style.css'); //timeline
		wp_register_style( 'plus-scroll-navigation', THEPLUS_URL .'assets/css/main/theplus-scroll-navigation.css'); //scroll navigation
	}
	public function theplus_register_style(){
		wp_enqueue_style( 'theplus-editor-css', THEPLUS_URL . 'assets/css/main/theplus-editor-style.css', [], THEPLUS_VERSION );
		wp_enqueue_style( 'tp-columns-bootstrap', THEPLUS_URL . 'assets/css/extra/tp-bootstrap-grid.css', [], THEPLUS_VERSION );
	}
	public function theplus_editor_styles() {
		wp_enqueue_style( 'theplus-ele-admin', THEPLUS_ASSETS_URL .'css/admin/theplus-ele-admin.css', array(),THEPLUS_VERSION,false );
	}
	public function theplus_elementor_admin_css() {  
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_style( 'theplus-ele-admin', THEPLUS_ASSETS_URL .'css/admin/theplus-ele-admin.css', array(),THEPLUS_VERSION,false );
		wp_enqueue_script( 'theplus-admin-js', THEPLUS_ASSETS_URL .'js/admin/theplus-admin.js', array(),THEPLUS_VERSION,false );		
	}
	function theplus_mime_types($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
	
	/*
	 * Admin notice text
	 */
	public function thepluskey_verify_notify(){
		echo '<div class="plus-key-notify notice notice-info is-dismissible">';
			echo '<h3>'.esc_html('Activation Required.', 'theplus' ) .'</h3>';
			echo '<p>'. esc_html__( 'Thanks for installation of The Plus Addons. Please go to', 'theplus' ) .' ';
			echo '<b>'. esc_html__( '"The Plus Settings -> Activate Plugin"', 'theplus' ) .'</b>';
			echo ' '. esc_html__( 'for plugin activation with license key.', 'theplus' ) .'</p>';
		echo '</div>';
	}
	
	public function add_elementor_category() {
			
		$elementor = \Elementor\Plugin::$instance;
		
		//Add elementor category
		$elementor->elements_manager->add_category('plus-essential', 
			[
				'title' => esc_html__( 'PlusEssential', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-listing', 
			[
				'title' => esc_html__( 'PlusListing', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-creatives', 
			[
				'title' => esc_html__( 'PlusCreatives', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-tabbed', 
			[
				'title' => esc_html__( 'PlusTabbed', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-social', 
			[
				'title' => esc_html__( 'PlusSocial', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		$elementor->elements_manager->add_category('plus-adapted', 
			[
				'title' => esc_html__( 'Plus Adapted', 'theplus' ),
				'icon' => 'fa fa-plug',
			],
			1
		);
		
	}
	

	function theplus_settings_links ( $links ) {
		$setting_link = array(
				'<a href="' . admin_url( 'admin.php?page=theplus_options' ) . '">'.esc_html__("Settings","theplus").'</a>',
			);
		return array_merge( $links, $setting_link );
	
	}
	
	private function hooks() {
	
		add_action( 'elementor/init', [ $this, 'add_elementor_category' ] );
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'theplus_editor_styles' ] );
		$this->include_widgets();
		theplus_widgets_include()->init();
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'theplus_register_style' ] );
		
		add_action( 'elementor/frontend/before_register_scripts', [ $this, 'theplus_register_scripts' ] );
		
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'theplus_enqueue_style' ] );
		
		add_filter('upload_mimes', array( $this,'theplus_mime_types'));
		// Include some backend files
		add_action( 'admin_enqueue_scripts', [ $this,'theplus_elementor_admin_css'] );
		add_filter( 'plugin_action_links_' . THEPLUS_PBNAME ,[ $this, 'theplus_settings_links'] );
	}
	
	/**
	 * ThePlus_Load constructor.
	 */
	private function __construct() {
		// Register class automatically
		$this->includes();
		// Finally hooked up all things
		$this->hooks();
		theplus_elements_integration()->init();
		
	}
}

function theplus_addon_load()
{
	return Theplus_Element_Load::instance();
}
// Get theplus_addon_load Running
theplus_addon_load();	