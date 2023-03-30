<?php
namespace RealySimleGoogleTag\Admin;

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

/**
 * Input Opiton for Google Tag Manager Container ID.
*/
class Simple_Googletag_Admin_Setting{
	
	function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		$this->plugin_recommendations();
	}

	function admin_menu() {
        add_menu_page(
			__('Google Tag Manager','simple-googletag'), 
			__('Google Tag Manager','simple-googletag'),
			'manage_options',
			'simple-googletag-setting-page',
			array( $this, 'plugin_page' ),
			SIMPLE_GOOGLE_TAG_URL.'admin/assets/images/s-penrose-square.png',
			66
		);
	}

	/**
     * [plugin_recommendations]
     * @return [void]
     */
    public function plugin_recommendations(){

        $get_instance = Recommended_Plugins::instance( 
            array( 
                'text_domain'       => 'simple-googletag', 
                'parent_menu_slug'  => 'simple-googletag-setting-page', 
                'menu_capability'   => 'manage_options', 
                'menu_page_slug'    => 'simple-tag-recommendations',
                'priority'          => 24,
                'assets_url'        => SIMPLE_GOOGLE_TAG_URL.'admin/assets',
                'hook_suffix'       => 'google-tag-manager_page_simple-tag-recommendations'
            )
        );

        $get_instance->add_new_tab( array(

        'title' => esc_html__( 'Recommended', 'simple-googletag' ),
        'active' => true,
        'plugins' => array(

            array(
                'slug'      => 'woolentor-addons',
                'location'  => 'woolentor_addons_elementor.php',
                'name'      => esc_html__( 'WooLentor', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-mega-for-elementor',
                'location'  => 'htmega_addons_elementor.php',
                'name'      => esc_html__( 'HT Mega', 'simple-googletag' )
            ),

            array(
                'slug'      => 'hashbar-wp-notification-bar',
                'location'  => 'init.php',
                'name'      => esc_html__( 'HashBar', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-slider-for-elementor',
                'location'  => 'ht-slider-for-elementor.php',
                'name'      => esc_html__( 'HT Slider For Elementor', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-contactform',
                'location'  => 'contact-form-widget-elementor.php',
                'name'      => esc_html__( 'HT Contact Form 7', 'simple-googletag' )
            ),

            array(
                'slug'      => 'extensions-for-cf7',
                'location'  => 'extensions-for-cf7.php',
                'name'      => esc_html__( 'Extensions For CF7', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-wpform',
                'location'  => 'wpform-widget-elementor.php',
                'name'      => esc_html__( 'HT WPForms', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-menu-lite',
                'location'  => 'ht-mega-menu.php',
                'name'      => esc_html__( 'HT Menu', 'simple-googletag' )
            ),

            array(
                'slug'      => 'insert-headers-and-footers-script',
                'location'  => 'init.php',
                'name'      => esc_html__( 'HT Script', 'simple-googletag' )
            ),

            array(
                'slug'      => 'wp-plugin-manager',
                'location'  => 'plugin-main.php',
                'name'      => esc_html__( 'WP Plugin Manager', 'simple-googletag' )
            ),

            array(
                'slug'      => 'wc-builder',
                'location'  => 'wc-builder.php',
                'name'      => esc_html__( 'WC Builder', 'simple-googletag' )
            ),

            array(
                'slug'      => 'whols',
                'location'  => 'whols.php',
                'name'      => esc_html__( 'Whols', 'simple-googletag' )
            ),

            array(
                'slug'      => 'just-tables',
                'location'  => 'just-tables.php',
                'name'      => esc_html__( 'JustTables', 'simple-googletag' )
            ),

            array(
                'slug'      => 'wc-multi-currency',
                'location'  => 'wcmilticurrency.php',
                'name'      => esc_html__( 'Multi Currency', 'simple-googletag' )
            )
        )

    ) );

    $get_instance->add_new_tab(array(
        'title' => esc_html__( 'You May Also Like', 'simple-googletag' ),
        'plugins' => array(

            array(
                'slug'      => 'woolentor-addons-pro',
                'location'  => 'woolentor_addons_pro.php',
                'name'      => esc_html__( 'WooLentor Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'WooLentor is one of the most popular WooCommerce Elementor Addons on WordPress.org. It has been downloaded more than 672,148 times and 60,000 stores are using WooLentor plugin. Why not you?', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'htmega-pro',
                'location'  => 'htmega_pro.php',
                'name'      => esc_html__( 'HT Mega Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/ht-mega-pro/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'HTMega is an absolute addon for elementor that includes 80+ elements & 360 Blocks with unlimited variations. HT Mega brings limitless possibilities. Embellish your site with the elements of HT Mega.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'swatchly-pro',
                'location'  => 'swatchly-pro.php',
                'name'      => esc_html__( 'Product Variation Swatches', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/swatchly-product-variation-swatches-for-woocommerce-products/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'Are you getting frustrated with WooCommerce’s current way of presenting the variants for your products? Well, say goodbye to dropdowns and start showing the product variations in a whole new light with Swatchly.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'whols-pro',
                'location'  => 'whols-pro.php',
                'name'      => esc_html__( 'Whols Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/whols-woocommerce-wholesale-prices/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'Whols is an outstanding WordPress plugin for WooCommerce that allows store owners to set wholesale prices for the products of their online stores. This plugin enables you to show special wholesale prices to the wholesaler. Users can easily request to become a wholesale customer by filling out a simple online registration form. Once the registration is complete, the owner of the store will be able to review the request and approve the request either manually or automatically.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'just-tables-pro',
                'location'  => 'just-tables-pro.php',
                'name'      => esc_html__( 'JustTables Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/wp/justtables/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'JustTables is an incredible WordPress plugin that lets you showcase all your WooCommerce products in a sortable and filterable table view. It allows your customers to easily navigate through different attributes of the products and compare them on a single page. This plugin will be of great help if you are looking for an easy solution that increases the chances of landing a sale on your online store.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'multicurrencypro',
                'location'  => 'multicurrencypro.php',
                'name'      => esc_html__( 'Multi Currency Pro for WooCommerce', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/multi-currency-pro-for-woocommerce/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'Multi-Currency Pro for WooCommerce is a prominent currency switcher plugin for WooCommerce. This plugin allows your website or online store visitors to switch to their preferred currency or their country’s currency.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'cf7-extensions-pro',
                'location'  => 'cf7-extensions-pro.php',
                'name'      => esc_html__( 'Extensions For CF7 Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/cf7-extensions/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'Contact Form7 Extensions plugin is a fantastic WordPress plugin that enriches the functionalities of Contact Form 7.This all-in-one WordPress plugin will help you turn any contact page into a well-organized, engaging tool for communicating with your website visitors by providing tons of advanced features like drag and drop file upload, repeater field, trigger error for already submitted forms, popup form response, country flags and dial codes with a telephone input field and acceptance field, etc. in addition to its basic features.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'hashbar-pro',
                'location'  => 'init.php',
                'name'      => esc_html__( 'HashBar Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'HashBar is a WordPress Notification / Alert / Offer Bar plugin which allows you to create unlimited notification bars to notify your customers. This plugin has option to show email subscription form (sometimes it increases up to 500% email subscriber), Offer text and buttons about your promotions. This plugin has the options to add unlimited background colors and images to make your notification bar more professional.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'wp-plugin-manager-pro',
                'location'  => 'plugin-main.php',
                'name'      => esc_html__( 'WP Plugin Manager Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/wp-plugin-manager-pro/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'WP Plugin Manager Pro is a specialized WordPress Plugin that helps you to deactivate unnecessary WordPress Plugins page wise and boosts the speed of your WordPress site to improve the overall site performance.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'ht-script-pro',
                'location'  => 'plugin-main.php',
                'name'      => esc_html__( 'HT Script Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/insert-headers-and-footers-code-ht-script/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'Insert Headers and Footers Code allows you to insert Google Analytics, Facebook Pixel, custom CSS, custom HTML, JavaScript code to your website header and footer without modifying your theme code.This plugin has the option to add any custom code to your theme in one place, no need to edit the theme code. It will save your time and remove the hassle for the theme update.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'ht-menu',
                'location'  => 'ht-mega-menu.php',
                'name'      => esc_html__( 'HT Menu Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/ht-menu-pro/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'WordPress Mega Menu Builder for Elementor', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'ht-slider-addons-pro',
                'location'  => 'ht-slider-addons-pro.php',
                'name'      => esc_html__( 'HT Slider Pro For Elementor', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/ht-slider-pro-for-elementor/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'HT Slider Pro is a plugin to create a slider for WordPress websites easily using the Elementor page builder. 80+ prebuild slides/templates are included in this plugin. There is the option to create a post slider, WooCommerce product slider, Video slider, image slider, etc. Fullscreen, full width and box layout option are included.', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'ht-google-place-review',
                'location'  => 'ht-google-place-review.php',
                'name'      => esc_html__( 'Google Place Review', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/google-place-review-plugin-for-wordpress/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( 'If you are searching for a modern and excellent google places review WordPress plugin to showcase reviews from Google Maps and strengthen trust between you and your site visitors, look no further than HT Google Place Review', 'simple-googletag' ),
            ),

            array(
                'slug'      => 'was-this-helpful',
                'location'  => 'was-this-helpful.php',
                'name'      => esc_html__( 'Was This Helpful?', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/was-this-helpful/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( "Was this helpful? is a WordPress plugin that allows you to take visitors' feedback on your post/pages or any article. A visitor can share his feedback by like/dislike/yes/no", 'simple-googletag' ),
            ),

            array(
                'slug'      => 'ht-click-to-call',
                'location'  => 'ht-click-to-call.php',
                'name'      => esc_html__( 'HT Click To Call', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/ht-click-to-call/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( "HT – Click to Call is a lightweight WordPress plugin that allows you to add a floating click to call button on your website. It will offer your website visitors an opportunity to call your business immediately at the right moment, especially when they are interested in your products or services and seeking more information.", 'simple-googletag' ),
            ),

            array(
                'slug'      => 'docus-pro',
                'location'  => 'docus-pro.php',
                'name'      => esc_html__( 'Docus Pro', 'simple-googletag' ),
                'link'      => 'https://hasthemes.com/plugins/docus-pro-youtube-video-playlist/',
                'author_link'=> 'https://hasthemes.com/',
                'description'=> esc_html__( "Embedding a YouTube playlist into your website plays a vital role to curate your content into several categories and make your web content more engaging and popular by keeping the visitors on your website for a longer period.", 'simple-googletag' ),
            ),

        )
    ));

    $get_instance->add_new_tab(array(
        'title' => esc_html__( 'Others', 'simple-googletag' ),
        'plugins' => array(

            array(
                'slug'      => 'ht-easy-google-analytics',
                'location'  => 'ht-easy-google-analytics.php',
                'name'      => esc_html__( 'HT Easy GA4 ( Google Analytics 4 )', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-instagram',
                'location'  => 'ht-instagram.php',
                'name'      => esc_html__( 'HT Feed', 'simple-googletag' )
            ),

            array(
                'slug'      => 'faster-youtube-embed',
                'location'  => 'faster-youtube-embed.php',
                'name'      => esc_html__( 'Faster YouTube Embed', 'simple-googletag' )
            ),

            array(
                'slug'      => 'wc-sales-notification',
                'location'  => 'wc-sales-notification.php',
                'name'      => esc_html__( 'WC Sales Notification', 'simple-googletag' )
            ),

            array(
                'slug'      => 'preview-link-generator',
                'location'  => 'preview-link-generator.php',
                'name'      => esc_html__( 'Preview Link Generator', 'simple-googletag' )
            ),

            array(
                'slug'      => 'quickswish',
                'location'  => 'quickswish.php',
                'name'      => esc_html__( 'QuickSwish', 'simple-googletag' )
            ),

            array(
                'slug'      => 'docus',
                'location'  => 'docus.php',
                'name'      => esc_html__( 'Docus – YouTube Video Playlist', 'simple-googletag' )
            ),

            array(
                'slug'      => 'data-captia',
                'location'  => 'data-captia.php',
                'name'      => esc_html__( 'DataCaptia', 'simple-googletag' )
            ),

            array(
                'slug'      => 'coupon-zen',
                'location'  => 'coupon-zen.php',
                'name'      => esc_html__( 'Coupon Zen', 'simple-googletag' )
            ),

            array(
                'slug'      => 'sirve',
                'location'  => 'sirve.php',
                'name'      => esc_html__( 'Sirve – Simple Directory Listing', 'simple-googletag' )
            ),

            array(
                'slug'      => 'ht-social-share',
                'location'  => 'ht-social-share.php',
                'name'      => esc_html__( 'HT Social Share', 'simple-googletag' )
            ),

        )
    ));

    }

	function admin_init(){
		register_setting( 'simple-googletag-settings-option', 'google_tag_manager_id' );
	}

	function plugin_page() {
		?>
	        <div class="wrap">
	            <h2><?php echo esc_html__( 'Really Simple Google Tag Manager Option','simple-googletag' ); ?></h2>
	            <form action='options.php' method='post'>
		            <?php
		            	$this->save_message();
		            	settings_fields( 'simple-googletag-settings-option' );
						do_settings_sections( 'simple-googletag-setting-page' ); 
		            ?>
		            <table class="form-table" role="presentation">
						<tbody>
							<tr>
								<?php $google_tag_manager_id = get_option( 'google_tag_manager_id' )?get_option( 'google_tag_manager_id' ): ''; ?>
								<th scope="row" style="width: 20%;"><?php echo esc_html__('Google Tag Manager Container ID : ','simple-googletag'); ?></th>
								<td>
									<input type="text" id="google_tag_manager_id" placeholder="GTM-XXXXXXX" name="google_tag_manager_id" value="<?php echo esc_attr( $google_tag_manager_id ); ?>"/>
									<p class="description"><?php echo esc_html__( 'Sample Container ID:  GTM-P6TJ764','simple-googletag'); ?></p>
								</td>
							</tr>
						</tbody>
					</table>
					<div>
						<?php submit_button(); ?>
					</div>
	        	</form>
	        	<P><strong><?php echo esc_html__("Find your container ID from ",'simple-googletag') ?><a href="<?php echo esc_url('https://tagmanager.google.com/#/home');?>" target="_blank"><?php echo esc_html__('Google Tag Manager Website.','simple-googletag');?></a></strong></P>
	        </div>
        <?php 
    }

    function save_message() {
    	$google_tag_manager_id = get_option( 'google_tag_manager_id' )?get_option( 'google_tag_manager_id' ):'';
        if( isset($_GET['settings-updated'])) { 
        	if($google_tag_manager_id):
			?>
	            <div class="updated notice is-dismissible"> 
	                <p><strong><?php echo esc_html__('Successfully Settings Saved.','simple-googletag') ?></strong></p>
	            </div>
	        <?php else: ?>
	        	<div class="notice notice-error is-dismissible"> 
	                <p><strong><?php echo esc_html__('Please Enter a Valid Container ID. Google Tag Manager Container ID Field is Empty.','simple-googletag') ?></strong></p>
	            </div>
            <?php
        	endif;
        }
    }
}

new Simple_Googletag_Admin_Setting();

?>
