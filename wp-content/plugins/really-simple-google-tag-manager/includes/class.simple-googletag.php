<?php

/**
* Loading google tag manager scripts in header and body.
*/
class Simple_Googletag 
{

	/**
   * [$_instance]
   * @var null
  */
  private static $_instance = null;

  /**
   * [instance] Initializes a singleton instance
   * @return [HTMega_Addons_Elementor]
  */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }
	
	function __construct()
	{
		if ( ! function_exists('is_plugin_active') ){ include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }
    add_action( 'init', [ $this, 'i18n' ] );
    add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
   * [i18n] Load Text Domain
   * @return [void]
  */
  public function i18n() {
    load_plugin_textdomain( 'simple-googletag', false, dirname( plugin_basename( SIMPLE_GOOGLE_TAG_ROOT ) ) . '/languages/' );
  }

  public function init() {
  	// Plugins Required File
  	$this->includes();
  	if(simple_googletag_get_id()){
  		add_action( 'wp_head', [ $this, 'simple_googletag_header_scirpt_render' ] );
  		add_action('wp_body_open', [ $this, 'simple_googletag_body_scirpt_render' ]);
  	}
  }
  public function includes() {
    require_once ( SIMPLE_GOOGLE_TAG_PATH . 'admin/Recommended_Plugins.php' );
  	require_once ( SIMPLE_GOOGLE_TAG_PATH . 'admin/admin-init.php' );
  }

 	public function simple_googletag_header_scirpt_render(){
 		?>
 			<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer',<?php echo "'".simple_googletag_get_id()."'"; ?>);</script>
		<!-- End Google Tag Manager -->
 		<?php
 	}

 	public function simple_googletag_body_scirpt_render(){
 		?>
 			<!-- Google Tag Manager (noscript) -->
 			<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo simple_googletag_get_id(); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
 			<!-- End Google Tag Manager (noscript) -->
 		<?php
 	}

}

Simple_Googletag::instance();
