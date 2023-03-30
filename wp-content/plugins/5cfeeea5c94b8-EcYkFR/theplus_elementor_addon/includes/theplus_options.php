<?php
	
use Elementor\Plugin;
if (!defined('ABSPATH')) {
    exit;
}

class Theplus_Elementor_Plugin_Options
{
    
    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'theplus_options';
    
    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();
    
    /**
     * Options Page title
     * @var string
     */
    protected $title = '';
    
    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';
    protected $options_pages = array();
    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct()
    {
        // Set our title
		add_action( 'admin_enqueue_scripts', array( $this,'theplus_options_scripts') );
        $this->title = __('ThePlus Settings', 'theplus');
        require_once THEPLUS_INCLUDES_URL.'plus-options/cmb2-conditionals.php';
        // Set our CMB fields
        $this->fields = array(
        );
    }
    
    /**
     * Initiate our hooks
     * @since 1.0.0
     */
	public function theplus_options_scripts() {
		wp_enqueue_script( 'cmb2-conditionals', THEPLUS_URL .'includes/plus-options/cmb2-conditionals.js', array() );
		wp_enqueue_script('thickbox', null, array('jquery'));
		wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	}

    public function hooks()
    {
        add_action('admin_init', array(
            $this,
            'init'
        ));
        add_action('admin_menu', array(
            $this,
            'add_options_page'
        ));
    }
    
    /**
     * Register our setting to WP
     * @since  1.0.0
     */
    public function init()
    {
        //register_setting( $this->key, $this->key );
        $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
            register_setting($option_tab['id'], $option_tab['id']);
        }
    }
    
    /**
     * Add menu options page
     * @since 1.0.0
     */
    public function add_options_page()
    {
		$verify_api=theplus_check_api_status();
        $option_tabs = self::option_fields($verify_api);
        foreach ($option_tabs as $index => $option_tab) {
            if ($index == 0) {
                $this->options_pages[] = add_menu_page($this->title, $this->title, 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                )); //Link admin menu to first tab
                add_submenu_page($option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                )); //Duplicate menu link for first submenu page
            } else {
                $this->options_pages[] = add_submenu_page($option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array(
                    $this,
                    'admin_page_display'
                ));
            }
        }
    }
    
    /**
     * 
     * @since  1.0.0
     */
    public function admin_page_display()
    {
		$verify_api=theplus_check_api_status();
        $option_tabs = self::option_fields($verify_api);	
        $tab_forms   = array();
?>

		<div class="<?php  echo $this->key; ?>">
		<div id="ptplus-banner-wrap">
			<div id="ptplus-banner" class="ptplus-banner-sticky">
				<h2><?php echo esc_html__('ThePlus Settings','theplus'); ?><!--<span><img src="<?php echo THEPLUS_URL .'vc_elements/images/thepluslogo.png'; ?>"></span>--></h2>
				<div class="theplus-current-version wp-badge"> <?php echo esc_html__('Version','theplus'); ?> <?php echo THEPLUS_VERSION; ?></div>
			</div>
		</div>
		<h2 class="nav-tab-wrapper">
            	<?php
	        foreach ($option_tabs as $option_tab):
	            $tab_slug  = $option_tab['id'];
	            $nav_class = 'nav-tab';
	            if ($tab_slug == $_GET['page']) {
	                $nav_class .= ' nav-tab-active'; //add active class to current tab
	                $tab_forms[] = $option_tab; //add current tab to forms to be rendered
	            } ?>            	
            	<a class="<?php echo $nav_class; ?>" href="<?php  menu_page_url($tab_slug); ?>"><?php echo esc_html($option_tab['title']); ?></a>
           	<?php endforeach; ?>
        </h2>
		<?php foreach ($tab_forms as $tab_form): ?>
		
				<?php if($verify_api!=1){ ?>
					<input type="hidden" name="theplus_verified_api" id="theplus_verified_api" value="<?php echo esc_attr($verify_api); ?>" />
				<?php } ?>
				
				<?php if($tab_form['id']=='theplus_purchase_code'){ ?>
						<div class="theplus_about-tab changelog" style="padding-bottom: 0;">
						<?php if(THEPLUS_TYPE=='code'){ ?>
							<div class="feature-section">
								<h4 style="padding-left:15px;"><?php echo esc_html__('Verify your plugin in 4 easy steps : Read below or ','theplus');?><?php echo '<a href="https://youtu.be/X-9CxBP6nJY" target="_blank">Watch Our Video Tutorial</a>' ?></h4>					
								<p style="padding-left:15px;"><?php echo esc_html__('1. Visit this ','theplus'); ?><?php echo '<i><a href="https://store.theplusaddons.com/theplus-verify" target="_blank">Verification URL</a></i>, Where you need to enter your "Envato Purchase Code" and press "Submit" button.</br>  <b> Note</b> : How to get purchase code : visit this <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">URL</a> or check <a href="https://www.youtube.com/watch?v=UsoNThFMHv8" target="_blank"> Video</a>'; ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('2. Add Your Website URL in the form with your email address.','theplus'); ?> </br><?php echo '<b>Important</b> : Website URL must be Home URL. You can get that by going Settings -> General -> WordPress Address (URL) and copy URL from there.'; ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('3. You will get "The Plus Unique Key" after submitting your details. Now Copy that key.','theplus'); ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('4.Enter Your "The Plus Unique key" at Verification Area and Press "Save" Button. Your Plugin is now verified to use all functionalities.','theplus'); ?></p>
								
							</div>							
						<?php } ?>
						<?php if(THEPLUS_TYPE=='store'){ ?>
							<div class="feature-section">
								<h4 style="padding-left:15px;"><?php echo esc_html__('Verify your plugin in 4 easy steps :','theplus');?></h4>					
								<p style="padding-left:15px;"><?php echo esc_html__('1. Visit your ','theplus'); ?><?php echo '<i><a href="https://store.theplusaddons.com/checkout/purchase-history/" target="_blank">Purchase History</a></i>'; ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('2. In the Page of "Purchase History" Go to View Licenses -> Manage Sites.','theplus'); ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('3. Add Your Home URL in the form and press "Add Site". Important : Website URL must be Home URL. You can get that by going Settings -> General -> WordPress Address (URL) and copy URL from there.','theplus'); ?></p>
								<p style="padding-left:15px;"><?php echo esc_html__('4. Now Your License Key will be activated for your Entered Website URL. Use that License key to activate your plugin.','theplus'); ?></p>
								
								<p style="padding-left:15px;padding-top:5px;"><?php echo '<span style="color:red;font-size:20px;">*</span> For Visual Steps, Please check our video tutorial :  <i><a href="https://youtu.be/epiWtBPBtA0" target="_blank">Watch Video</a></i>'; ?></p>
							</div>
						<?php } ?>
					</div>
				<?PHP } ?>
				
				<?php if($tab_form['id']!='theplus_about_us' && $tab_form['id']!='theplus_import_data'){ ?>
					<div id="<?php echo esc_attr($tab_form['id']); ?>" class="group theplus_form_content">
						<?php cmb_metabox_form($tab_form, $tab_form['id']); ?>
					</div>
				<?php } ?>
				
				<?php if($tab_form['id']=='theplus_purchase_code'){
					echo theplus_message_display();
				} ?>
					
				<?php if($tab_form['id']=='theplus_about_us'){ ?>
				<div class="theplus_about-tab changelog">
					<div class="feature-section">
						<h4 style="padding-left:15px;"><?php echo esc_html__('Welcome to The Plus addons for Elementor. We have tried to get up as much as options possible with great customisation options for you. From this section, We have attached some links which will helpful to you.','theplus'); ?></h4>
						<div class="col-xs-6">
							<h3><?php echo esc_html__('Resources :','theplus'); ?></h3>
							<ul>
								<li>
									<a href="https://elementor.theplusaddons.com/documentation/" target="_blank"><?php echo esc_html__('Visit Our Main Page : Live Demo','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/widgets/" target="_blank"><?php echo esc_html__('Check our 50+ Widgets : Plus Widgets','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/plus-blocks/" target="_blank"><?php echo esc_html__('Our 500+ UI Blocks : Plus Blocks','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/pluslisting/" target="_blank"><?php echo esc_html__('Visit Grid Builder Options : Plus Listings','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/plus-templates/"><?php echo esc_html__('Check premade pages : Plus Pages','theplus'); ?></a></li>
							</ul>
						</div>
						
						<div class="col-xs-6">
							<ul style="padding-top: 40px;">
								<li><a href="https://elementor.theplusaddons.com/documentation/" target="_blank"><?php echo esc_html__('Checkout our detailed documentation : Online Documentation','theplus'); ?></a></li>
								<li><a href="https://www.youtube.com/playlist?list=PLFRO-irWzXaLK9H5opSt88xueTnRhqvO5" target="_blank"><?php echo esc_html__('Watch Our Video Tutorials : Video Library','theplus'); ?></a></li>
								<li><a href="https://posimyththemes.ticksy.com/" target="_blank"><?php echo esc_html__('Contact us for any queries : Support Forum','theplus'); ?></a></li>
								<li><a href="https://elementor.theplusaddons.com/pricing/" target="_blank"><?php echo esc_html__('Purchase Another License : Buy Now','theplus'); ?></a></li>								
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
				<?php if($tab_form['id']=='theplus_import_data'){
					wp_enqueue_script( 'jquery-masonry');
					$ajax = Plugin::$instance->common->get_component( 'ajax' );
				?>
				<div class="theplus_about-tab changelog">
					<div class="feature-section">
						<?php if(!empty($verify_api) && $verify_api==1){ ?>
						<div id="pt-plus-import-form">
							<div class="plus-template-main-category">
								<div class="theplus-import-template-library">
									<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/template-import.png"><?php echo esc_html__("Import","theplus"); ?>
								</div>
								<ul class="plus-main-category-list">
									<li class="active-open"><div class="plus-templates-tab" data-listing="special-blocks"><?php echo esc_html__("Special Blocks","theplus"); ?></div></li>
									<li><div class="plus-templates-tab" data-listing="plus-templates"><?php echo esc_html__("Plus Templates","theplus"); ?></div></li>
									<li><div class="plus-templates-tab" data-listing="plus-widgets"><?php echo esc_html__("Plus Widgets","theplus"); ?></div></li>
									<li><div class="plus-templates-tab" data-listing="plus-listing"><?php echo esc_html__("Plus Listing","theplus"); ?></div></li>							
								</ul>
								
								<div class="plus-import-listing-widgets">
									<div id="listing-special-blocks" class="widgets-listing-content active">
										<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/ajax-loader.gif" class="templates-loading" />
									</div>
									<div id="listing-plus-templates" class="widgets-listing-content">
										<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/ajax-loader.gif" class="templates-loading" />
									</div>
									<div id="listing-plus-widgets" class="widgets-listing-content">
										<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/ajax-loader.gif" class="templates-loading" />
									</div>
									<div id="listing-plus-listing" class="widgets-listing-content">
										<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/ajax-loader.gif" class="templates-loading" />
									</div>									
								</div>
							</div>
							
							<div id="elementor-import-template-area" class="theplus-import-template-library-form hidden">
								<form id="elementor-import-template-form" method="post" action="<?php echo admin_url( 'admin-ajax.php' ); ?>" enctype="multipart/form-data">
									<input type="hidden" name="action" value="elementor_library_direct_actions">
									<input type="hidden" name="library_action" value="direct_import_template">
									<input type="hidden" name="_nonce" value="<?php echo $ajax->create_nonce(); ?>">
									<h3><?php echo esc_html__("Import Designs (.Json)","theplus"); ?></h3>
									<fieldset id="elementor-import-template-form-inputs">
										<input type="file" name="file" accept=".json,application/json,.zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed" required>
										<input type="submit" class="button" value="<?php echo esc_attr__( 'Import Now', 'theplus' ); ?>">
									</fieldset>
								</form>
							</div>
									
						</div>
						<?php }else{ ?>
							<div class="pt-plus-page-form text-center">
								<div class="plus-notice-varified">
									<img src="<?php echo THEPLUS_ASSETS_URL; ?>/images/verify-plugin-note.png" />
									<div class="plus-notice-block-content">
										<div class="plus-notice-importance-title"><?php echo esc_html__('Important Notice','theplus'); ?></div>
										<div class="plus-notice-importance-desc-title"><?php echo '<a href="admin.php?page=theplus_purchase_code">'.esc_html__("Verify","theplus").'</a>'; ?><?php echo esc_html__(' your plugin and get access of all functionalities. Go to Verify section of settings to proceed further.','theplus'); ?></div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>	
				<?php } ?>
            	<?php  endforeach; ?>
		</div>
		<?php
    }
    
    /**
     * Defines the theme option metabox and field configuration
     * @since  1.0.0
     * @return array
     */
    public function option_fields($verify_api='')
    {
		
        // Only need to initiate the array once per page-load
        if (!empty($this->option_metabox)) {
            return $this->option_metabox;
        }
       
        $this->option_metabox[] = array(
            'id' => 'theplus_options',
            'title' => 'General Settings',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_options'
                )
            ),
            'show_names' => true,
            'fields' => array(
				array(
	                'name' => __('Widgets On/Off', 'theplus'),
	                'desc' => __('Use above option to hide/unhide widgets. If you want to use just few widgets, We suggest to uncheck rest, which will help you to improve performance of website.', 'theplus'),
	                'id' => 'check_elements',
	                'type' => 'multicheck',
					'select_all_button' => true,
					'default' =>array('tp_accordion','tp_adv_text_block','tp_advertisement_banner','tp_before_after','tp_blockquote','tp_blog_listout','tp_button','tp_carousel_anything','tp_carousel_remote','tp_cascading_image','tp_circle_menu','tp_clients_listout','tp_contact_form_7','tp_countdown','tp_dynamic_device','tp_draw_svg','tp_flip_box','tp_gallery_listout','tp_google_map','tp_heading_animation','tp_heading_title','tp_image_factory','tp_info_box','tp_mailchimp','tp_number_counter','tp_hotspot','tp_off_canvas','tp_pricing_list','tp_pricing_table','tp_product_listout','tp_post_search','tp_progress_bar','tp_row_background','tp_scroll_navigation','tp_social_icon','tp_style_list','tp_switcher','tp_smooth_scroll','tp_table','tp_tabs_tours','tp_team_member_listout','tp_testimonial_listout','tp_timeline','tp_video_player'),
	                'options' => array(
	                    'tp_accordion' => __('Accordion', 'theplus'),
	                    'tp_adv_text_block' => __('Advanced Text Block', 'theplus'),
						'tp_advertisement_banner' => __('Advertisement Banner', 'theplus'),
	                    'tp_before_after' => __('Before After', 'theplus'),
	                    'tp_blockquote' => __('Blockquote', 'theplus'),
	                    'tp_blog_listout' => __('Blog Listing', 'theplus'),
	                    'tp_button' => __('Button', 'theplus'),
						'tp_carousel_anything' => __('Carousel Anything', 'theplus'),
						'tp_carousel_remote' => __('Carousel Remote', 'theplus'),
	                    'tp_cascading_image' => __('Cascading Image', 'theplus'),
	                    'tp_circle_menu' => __('Circle Menu', 'theplus'),
	                    'tp_clients_listout' => __('Clients Listing', 'theplus'),
	                    'tp_contact_form_7' => __('Contact Form 7', 'theplus'),
	                    'tp_countdown' => __('Count Down', 'theplus'),
	                    'tp_dynamic_device' => __('Dynamic Device', 'theplus'),
	                    'tp_draw_svg' => __('Draw SVG', 'theplus'),
	                    'tp_flip_box' => __('Flip Box', 'theplus'),
	                    'tp_gallery_listout' => __('Gallery Listing', 'theplus'),
	                    'tp_google_map' => __('Google Map', 'theplus'),
	                    'tp_heading_animation' => __('Heading Animation', 'theplus'),
	                    'tp_heading_title' => __('Heading Title', 'theplus'),
						'tp_hotspot' => __('Hotspot', 'theplus'),
	                    'tp_image_factory' => __('Creative Image', 'theplus'),
	                    'tp_info_box' => __('Info Box', 'theplus'),
	                    'tp_mailchimp' => __('Mailchimp', 'theplus'),
	                    'tp_number_counter' => __('Number Counter', 'theplus'),
	                    'tp_off_canvas' => __('Off Canvas/Toggle', 'theplus'),
						'tp_pricing_list' => __('Pricing List', 'theplus'),
	                    'tp_pricing_table' => __('Pricing Table', 'theplus'),
	                    'tp_product_listout' => __('Product Listing', 'theplus'),
	                    'tp_post_search' => __('Post Search', 'theplus'),
	                    'tp_progress_bar' => __('Progress Bar', 'theplus'),
						'tp_row_background' => __('Row Background', 'theplus'),
						'tp_scroll_navigation' => __('Scroll Navigation', 'theplus'),
	                    'tp_social_icon' => __('Social Icon', 'theplus'),
	                    'tp_style_list' => __('Style List', 'theplus'),
	                    'tp_switcher' => __('Switcher', 'theplus'),
	                    'tp_smooth_scroll' => __('Smooth Scroll', 'theplus'),
						'tp_table' => __('Table', 'theplus'),
						'tp_tabs_tours' => __('Tabs/Tours', 'theplus'),
	                    'tp_team_member_listout' => __('Team Member Listing', 'theplus'),
	                    'tp_testimonial_listout' => __('Testimonial', 'theplus'),
	                    'tp_timeline' => __('Timeline', 'theplus'),
	                    'tp_video_player' => __('Video Player', 'theplus'),
	                )	                
	            ),
				array(
	                'name' => __('Plus Extras Options', 'theplus'),
	                'desc' => __('Use above option to hide/unhide Sections/Columns Plus Extras Options. If you want to use just few Options, We suggest to uncheck rest, which will help you to improve performance of website.', 'theplus'),
	                'id' => 'extras_elements',
	                'type' => 'multicheck',
					'select_all_button' => true,
					'default' => '',
	                'options' => array(
	                    'section_scroll_animation' => __('Section Scroll Animation', 'theplus'),	                    
	                    'section_custom_css' => __('Section Custom CSS', 'theplus'),	                    
	                    'column_sticky' => __('Sticky Column', 'theplus'),	                    
	                    'custom_width_column' => __('Custom/Media Width Column', 'theplus'),	                    
	                    'order_sort_column' => __('Order AND Width Column', 'theplus'),	                    
	                    'column_custom_css' => __('Column Custom CSS', 'theplus'),	                    
	                )
	            ),
            )
        );
        
        $this->option_metabox[] = array(
            'id' => 'post_type_options',
            'title' => 'Post Type Settings',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'post_type_options'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				/* client option start */
				array(
					'name' => __('Clients Post Type Settings', 'theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'client_post_title'
				),
				array(
						'name' => __('Select Post Type Type', 'theplus'),
						'desc' => '',
						'id' => 'client_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for clients custom post type name. Default: "theplus_clients"', 'theplus'),
				'default' => '',
				'id' => 'client_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default : "theplus_clients_cat" ', 'theplus'),
				'default' => '',
				'id' => 'client_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_clients" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'client_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_clients_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png'),
				'default' => '',
				'id' => 'client_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'client_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* client option start */
				/* testimonial option start */
				array(
					'name' => __('Testimonial Post Type Settings', 'theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'testimonial_post_title'
				),
				array(
						'name' => __('Select Post type Type', 'theplus'),
						'desc' => '',
						'id' => 'testimonial_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for testimonial custom post type name. Default: "theplus_testimonial"', 'theplus'),
				'default' => '',
				'id' => 'testimonial_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default :"theplus_testimonial_cat"', 'theplus'),
				'default' => '',
				'id' => 'testimonial_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_testimonial" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'testimonial_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_testimonial_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png' ),
				'default' => '',
				'id' => 'testimonial_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'testimonial_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* testimonial option start */
				/* Team Member option start */
				array(
					'name' => __('Team Member Post Type Settings','theplus'),
					'desc' => '',
					'type' => 'title',
					'id' => 'testimonial_post_title'
				),
				array(
						'name' => __('Select Team Member Post Type', 'theplus'),
						'desc' => '',
						'id' => 'team_member_post_type',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'plugin' => __('ThePlus Post Type', 'theplus'),
							'themes' => __('Prebuilt Theme Based', 'theplus'),
						)
				),
				array(
				'name' => __('Post Name : (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for team member custom post type name. Default: "theplus_team_member"', 'theplus'),
				'default' => '',
				'id' => 'team_member_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Category Taxonomy Value (Keep Blank if you want to keep default Name)', 'theplus'),
				'desc' => __('Enter value for Category Taxonomy Value. Default : "theplus_team_member_cat"', 'theplus'),
				'default' => '',
				'id' => 'team_member_category_plugin_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'plugin',
					),
				),
				array(
				'name' => __('Prebuilt Post Name : (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current post type name which is prebuilt with your theme. E.g.: "theplus_team_member" <a href="%s" class="thickbox" title="Get the Post Name of Custom Post type as per above Screenshot.">Check screenshot</a> for how to get that value from URL of your current post type.', 'theplus'), THEPLUS_URL.'assets/images/post-type-screenshot.png' ),
				'default' => '',
				'id' => 'team_member_theme_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				array(
				'name' => __('Prebuilt Category Taxonomy Value (You can find that from here)', 'theplus'),
				'desc' => sprintf( __('Enter the value of your current Category Taxonomy Value which is prebuilt with your theme.  E.g. : "theplus_team_member_cat" <a href="%s" class="thickbox" title="Get the Category Taxonomy Value as per above screenshot.">Check screenshot</a> for how to get that value from URL of your current taxonomy.', 'theplus'), THEPLUS_URL.'assets/images/taxonomy-screenshot.png' ),
				'default' => '',
				'id' => 'team_member_category_name',
				'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'team_member_post_type',
						'data-conditional-value' => 'themes',
					),
				),
				/* Team Member option start */
            )
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_import_data',
            'title' => 'Plus Designs',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_import_data'
                )
            ),
            'show_names' => true,
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_api_connection_data',
            'title' => 'Extra Options',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_api_connection_data'
                )
            ),
            'show_names' => true,
            'fields' => array(
			
				
				array(
						'name' => __('Google Map API Key', 'theplus'),
						'desc' => __('<b>NOTE :</b> Turn Off this key If you theme already have google key option. So, It will not generate error in console for multiple google map keys.', 'theplus'),
						'id' => 'gmap_api_switch',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'enable',
						'options' => array(
							'enable' => __('Show', 'theplus'),
							'disable' => __('Hide', 'theplus'),
						),
				),
	            array(
	                'name' => __('Google Map API Key', 'theplus'),
	                'desc' => __('This field is required if you want to use Advance Google Map element. You can obtain your own Google Maps Key here: (<a href="https://developers.google.com/maps/documentation/javascript/get-api-key">Click Here</a>)', 'theplus'),
	                'default' => '',
	                'id' => 'theplus_google_map_api',
	                'type' => 'text',
					'attributes' => array(
						'data-conditional-id'    => 'gmap_api_switch',
						'data-conditional-value' => 'enable',
					),
	            ),
				array(
	                'name' => __('Mailchimp API Key', 'theplus'),
	                'desc' => __('Go to your Mailchimp > Account > Extras > API Keys then create a key and paste here', 'theplus'),
	                'default' => '',
	                'id' => 'theplus_mailchimp_api',
	                'type' => 'text',
	            ),
				array(
	                'name' => __('Mailchimp List ID', 'theplus'),
	                'desc' => __('Go to your Mailchimp > List > Settings > List name and default > Copy the list ID and paste here.', 'theplus'),
	                'default' => '',
	                'id' => 'theplus_mailchimp_id',
	                'type' => 'text',
	            ),
				array(
						'name' => __('On Scroll View Animation Offset', 'theplus'),
						'desc' => __('Enter the value which will be used for offset of on scroll view animation. If you select 90, Then It will start taking effect from bottom\'s 10%. E.g. 90,85,80 etc.', 'theplus'),
						'id' => 'scroll_animation_offset',
						'type' => 'text',
						'attributes' => array(
							'type' => 'number',
							'pattern' => '\d*',
							'min'  => '30',
							'max'  => '120',							
						),
						'sanitization_cb' => 'absint',
						'escape_cb'       => 'absint',
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_performance',
            'title' => 'Performance',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_performance'
                )
            ),
            'show_names' => true,
            'fields' => array(
				array(
						'name' => __('Disable Isotope.JS', 'theplus'),
						'desc' => __('Some themes or plugins already have Isotop JS for listing functionality. You can turn this off to avoid conflicts.', 'theplus'),
						'id' => 'isotope_js_load',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'enable',
						'options' => array(							
							'enable' => __('Enable', 'theplus'),
							'disable' => __('Disable', 'theplus'),
						)
				),
				array(
						'name' => __('Minify CSS', 'theplus'),
						'desc' => __('Enable Minified CSS to have faster performance of website. Disable it if it have any conflicts with your other plugins. If you are using cache plugins and do change status of this, do remove cache and test website. You need to do hard refresh.', 'theplus'),
						'id' => 'compress_minify_css',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'enable' => __('Enable', 'theplus'),
						)
				),
				array(
						'name' => __('Minified JS', 'theplus'),
						'desc' => __('Enable Minified JS to have faster performance of website. Disable it if it have any conflicts with your other plugins. If you are using cache plugins and do change status of this, do remove cache and test website. You need to do hard refresh.', 'theplus'),
						'id' => 'compress_minify_js',
						'type' => 'select',
						'show_option_none' => true,
						'default' => 'disable',
						'options' => array(
							'disable' => __('Disable', 'theplus'),
							'enable' => __('Enable', 'theplus'),
						)
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_styling_data',
            'title' => 'Custom',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_styling_data'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				array( 
					'name' => __( 'Custom CSS', 'theplus' ),
					'desc' => __( 'Add Your Custom CSS Styles', 'theplus' ),
					'id' => 'theplus_custom_css_editor',
					'type' => 'textarea_code',
				),
				array( 
					'name' => __( 'Custom JS', 'theplus' ),
					'desc' => __( 'Add Your Custom JS Scripts', 'theplus' ),
					'id' => 'theplus_custom_js_editor',
					'type' => 'textarea_code',
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_purchase_code',
            'title' => 'Activate Plugin',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_purchase_code'
                )
            ),
            'show_names' => true,
            'fields' => array(				
				array(
					'name' => __('ThePlus Key', 'theplus'),
					'desc' => '',
					'default' => '',
					'id' => 'tp_api_key',
					'type' => 'text',
				),
			),
        );
		$this->option_metabox[] = array(
            'id' => 'theplus_about_us',
            'title' => 'About',
            'show_on' => array(
                'key' => 'options-page',
                'value' => array(
                    'theplus_about_us'
                )
            ),
            'show_names' => true,
        );
        return $this->option_metabox;
    }
   
    public function get_option_key($field_id)
    {
        $option_tabs = $this->option_fields();
        foreach ($option_tabs as $option_tab) { //search all tabs
            foreach ($option_tab['fields'] as $field) { //search all fields
                if ($field['id'] == $field_id) {
                    return $option_tab['id'];
                }
            }
        }
        return $this->key; //return default key if field id not found
    }
    /**
     * Public getter method for retrieving protected/private variables
     * @since  1.0.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get($field)
    {
        
        // Allowed fields to retrieve
        if (in_array($field, array('key','fields','title','options_page'), true)) {
            return $this->{$field};
        }
        if ('option_metabox' === $field) {
            return $this->option_fields();
        }
        
        throw new Exception('Invalid property: ' . $field);
    }
    
}


// Get it started
$Theplus_Elementor_Plugin_Options = new Theplus_Elementor_Plugin_Options();
$Theplus_Elementor_Plugin_Options->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  1.0.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function theplus_ele_get_option($key = '')
{
    global $Theplus_Elementor_Plugin_Options;
    return cmb_get_option($Theplus_Elementor_Plugin_Options->key, $key);
}