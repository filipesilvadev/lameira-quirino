<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( 'Theplus_Elements_Integration' ) ) {

	/**
	 * Define Theplus_Elements_Integration class
	 */
	class Theplus_Elements_Integration {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		 /**
		 * Localize data array
		 *
		 * @var array
		 */
		public $localize_data = array();

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			
			add_action( 'elementor/controls/controls_registered', array( $this, 'add_controls' ), 10 );

			// Frontend messages
			$this->localize_data['messages'] = array(
				'invalidMail' => esc_html__( 'Please specify a valid e-mail', 'theplus' ),
			);
		}
		
		/**
		 * Add new controls.
		 *
		 * @param  object $controls_manager Controls manager instance.
		 * @return void
		 */
		public function add_controls( $controls_manager ) {

			$grouped = array(
				'plus-magic-scroll-from' => 'Theplus_Magic_Scroll_From_Style_Group',
				'plus-magic-scroll-to' => 'Theplus_Magic_Scroll_To_Style_Group',
				'plus-magic-scroll-option' => 'Theplus_Magic_Scroll_Option_Style_Group',
				'plus-tooltips-option' => 'Theplus_Tooltips_Option_Group',
				'plus-tooltips-option-style' => 'Theplus_Tooltips_Option_Style_Group',
				'plus-mouse-parallax-option' => 'Theplus_Mouse_Move_Parallax_Group',
				'plus-tilt-parallax-option' => 'Theplus_Tilt_Parallax_Group',
				'plus-overlay-special-effect-option' => 'Theplus_Overlay_Special_Effect_Group',
				'plus-loop-tooltips-option-style' => 'Theplus_Loop_Tooltips_Option_Style_Group',
			);
			$grouped_control = array(
				'plus-column-width' => 'Theplus_Column_Responsive',
			);
			foreach ( $grouped as $control_id => $class_name ) {
				if ( $this->include_control( $control_id, true ) ) {
					$controls_manager->add_group_control( $control_id, new $class_name() );
				}
			}
			foreach ( $grouped_control as $control_id => $class_name ) {
				if ( $this->include_control( $control_id, true ) ) {
					new $class_name();
				}
			}

		}
		
		/**
		 * Include control file by class name.
		 *
		 * @param  [type] $class_name [description]
		 * @return [type]             [description]
		 */
		public function include_control( $control_id, $grouped = false ) {

			$filename = sprintf('modules/controls/group/'.$control_id.'.php');

			if ( ! file_exists( THEPLUS_PATH.$filename ) ) {
				return false;
			}

			require THEPLUS_PATH.$filename;
			return true;
		}
		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of Theplus_Elements_Integration
 *
 * @return object
 */
function theplus_elements_integration() {
	return Theplus_Elements_Integration::get_instance();
}