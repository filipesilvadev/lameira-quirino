<?php
namespace TheplusAddons\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Theplus_Elements_Widgets' ) ) {

	/**
	 * Define Theplus_Elements_Widgets class
	 */
	class Theplus_Elements_Widgets extends Widget_Base{

		public function __construct() {
			parent::__construct();
			$this->add_actions();
		}

		public function get_name() {
			return 'plus-elementor-widget';
		}
		
		public function register_controls_widget_magic_scroll($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];
			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}
			$widget->add_control(
				'magic_scroll',
				[
					'label'        => esc_html__( 'Magic Scroll', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),
					'render_type'  => 'template',					
				]
			);
			$widget->add_group_control(
				\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
				array(
					'label' => __( 'Scroll Options', 'theplus' ),
					'name'           => 'scroll_option',
					'render_type'  => 'template',
					'condition'    => [
						'magic_scroll' => [ 'yes' ],
					],
				)
			);
			$widget->start_controls_tabs( 'tabs_magic_scroll' );
			$widget->start_controls_tab(
				'tab_scroll_from',
				[
					'label' => __( 'Initial', 'theplus' ),
					'condition'    => [
						'magic_scroll' => [ 'yes' ],
					],
				]
			);
			$widget->add_group_control(
				\Theplus_Magic_Scroll_From_Style_Group::get_type(),
				array(
					'label' => __( 'Initial Position', 'theplus' ),
					'name'           => 'scroll_from',
					'condition'    => [
						'magic_scroll' => [ 'yes' ],
					],
				)
			);
			$widget->end_controls_tab();
			$widget->start_controls_tab(
				'tab_scroll_to',
				[
					'label' => __( 'Final', 'theplus' ),
					'condition'    => [
						'magic_scroll' => [ 'yes' ],
					],
				]
			);
			$widget->add_group_control(
				\Theplus_Magic_Scroll_To_Style_Group::get_type(),
				array(
					'label' => __( 'Final Position', 'theplus' ),
					'name'           => 'scroll_to',
					'condition'    => [
						'magic_scroll' => [ 'yes' ],
					],
				)
			);
			
			$widget->end_controls_tab();
			$widget->end_controls_tabs();

		}
		public function register_controls_widget_tooltip($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];

			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}

			$widget->add_control(
				'plus_tooltip',
				[
					'label'        => esc_html__( 'Tooltip', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),
					'render_type'  => 'template',
					'separator' => 'before',
				]
			);

			$widget->start_controls_tabs( 'plus_tooltip_tabs' );

			$widget->start_controls_tab(
				'plus_tooltip_content_tab',
				[
					'label' => esc_html__( 'Content', 'theplus' ),
					'render_type'  => 'template',
					'condition' => [
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_tooltip_content_type',
				[
					'label' => __( 'Content Type', 'theplus' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'normal_desc',
					'options' => [
						'normal_desc'  => __( 'Text Content', 'theplus' ),
						'content_wysiwyg'  => __( 'WYSIWYG Editor', 'theplus' ),
					],
					'render_type'  => 'template',
					'condition' => [
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_tooltip_content_desc',
				[
					'label' => __( 'Description', 'theplus' ),
					'type' => Controls_Manager::TEXTAREA,
					'rows' => 5,
					'default' => __( 'Luctus nec ullamcorper mattis', 'theplus' ),
					'condition' => [
						'plus_tooltip_content_type' => 'normal_desc',
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_tooltip_content_wysiwyg',
				[
					'label' => __( 'Tooltip Content', 'theplus' ),
					'type' => Controls_Manager::WYSIWYG,
					'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
					'render_type'  => 'template',
					'condition' => [
						'plus_tooltip_content_type' => 'content_wysiwyg',
						'plus_tooltip' => 'yes',
					],
				]				
			);
			$widget->add_control(
				'plus_tooltip_content_align',
				[
					'label'   => esc_html__( 'Text Alignment', 'theplus' ),
					'type'    => Controls_Manager::CHOOSE,
					'default' => 'center',
					'options' => [
						'left'    => [
							'title' => esc_html__( 'Left', 'theplus' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'theplus' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'theplus' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
					],
					'condition' => [
						'plus_tooltip_content_type' => 'normal_desc',
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'plus_tooltip_content_typography',
					'selector' => '{{WRAPPER}} .tippy-tooltip .tippy-content',
					'condition' => [
						'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
						'plus_tooltip' => 'yes',
					],
				]
			);

			$widget->add_control(
				'plus_tooltip_content_color',
				[
					'label'  => esc_html__( 'Text Color', 'theplus' ),
					'type'   => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tippy-tooltip .tippy-content,{{WRAPPER}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
					],
					'condition' => [
						'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->end_controls_tab();

			$widget->start_controls_tab(
				'plus_tooltip_styles_tab',
				[
					'label' => esc_html__( 'Style', 'theplus' ),
					'condition' => [
						'plus_tooltip' => 'yes',
					],
				]
			);
			$widget->add_group_control(
				\Theplus_Tooltips_Option_Group::get_type(),
				array(
					'label' => __( 'Tooltip Options', 'theplus' ),
					'name'           => 'tooltip_opt',
					'render_type'  => 'template',
					'condition'    => [
						'plus_tooltip' => [ 'yes' ],
					],
				)
			);
			$widget->add_group_control(
				\Theplus_Tooltips_Option_Style_Group::get_type(),
				array(
					'label' => __( 'Style Options', 'theplus' ),
					'name'           => 'tooltip_style',
					'render_type'  => 'template',
					'condition'    => [
						'plus_tooltip' => [ 'yes' ],
					],
				)
			);
			$widget->end_controls_tab();
			$widget->end_controls_tabs();

		}
		
		public function register_controls_widget_mouseparallax($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];

			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}

			$widget->add_control(
				'plus_mouse_move_parallax',
				[
					'label'        => esc_html__( 'Mouse Move Parallax', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),					
					'render_type'  => 'template',
					'separator' => 'before',
				]
			);
			$widget->add_group_control(
				\Theplus_Mouse_Move_Parallax_Group::get_type(),
				array(
					'label' => __( 'Parallax Options', 'theplus' ),
					'name'           => 'plus_mouse_parallax',
					'render_type'  => 'template',
					'condition'    => [
						'plus_mouse_move_parallax' => [ 'yes' ],
					],
				)
			);
		}
		
		public function register_controls_widget_tilt_parallax($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];

			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}

			$widget->add_control(
				'plus_tilt_parallax',
				[
					'label'        => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),					
					'render_type'  => 'template',
					'separator' => 'before',
				]
			);
			$widget->add_group_control(
				\Theplus_Tilt_Parallax_Group::get_type(),
				array(
					'label' => __( 'Tilt Options', 'theplus' ),
					'name'           => 'plus_tilt_opt',
					'render_type'  => 'template',
					'condition'    => [
						'plus_tilt_parallax' => [ 'yes' ],
					],
				)
			);
		}
		public function register_controls_widget_reveal_effect($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];

			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}

			$widget->add_control(
				'plus_overlay_effect',
				[
					'label'        => esc_html__( 'Overlay Special Effect', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),					
					'render_type'  => 'template',
					'separator' => 'before',
				]
			);
			$widget->add_group_control(
				\Theplus_Overlay_Special_Effect_Group::get_type(),
				array(
					'label' => __( 'Overlay Color', 'theplus' ),
					'name'           => 'plus_overlay_spcial',
					'render_type'  => 'template',
					'condition'    => [
						'plus_overlay_effect' => [ 'yes' ],
					],
				)
			);
		}
		
		public function register_controls_widget_continuous_animation($widget, $widget_id, $args) {
			static $widgets = [
				'section_plus_extra_adv', /* Section */
			];

			if ( ! in_array( $widget_id, $widgets ) ) {
				return;
			}

			$widget->add_control(
				'plus_continuous_animation',
				[
					'label'        => esc_html__( 'Continuous Animation', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),					
					'render_type'  => 'template',
					'separator' => 'before',
				]
			);
			$widget->add_control(
				'plus_animation_effect',
				[
					'label' => __( 'Animation Effect', 'theplus' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'pulse',
					'options' => [
						'pulse'  => __( 'Pulse', 'theplus' ),
						'floating'  => __( 'Floating', 'theplus' ),
						'tossing'  => __( 'Tossing', 'theplus' ),
						'rotating'  => __( 'Rotating', 'theplus' ),
					],
					'render_type'  => 'template',
					'condition' => [
						'plus_continuous_animation' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_animation_hover',
				[
					'label'        => esc_html__( 'Hover Animation', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'theplus' ),
					'label_off'    => esc_html__( 'No', 'theplus' ),					
					'render_type'  => 'template',
					'condition' => [
						'plus_continuous_animation' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_animation_duration',
				[	
					'label' => __( 'Duration Time', 'theplus' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => 's',
					'range' => [
						's' => [
							'min' => 0.5,
							'max' => 50,
							'step' => 0.1,
						],
					],
					'default' => [
						'unit' => 's',
						'size' => 2.5,
					],
					'selectors'  => [
						'{{WRAPPER}} .plus-widget-wrapper' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'plus_continuous_animation' => 'yes',
					],
				]
			);
			$widget->add_control(
				'plus_transform_origin',
				[
					'label' => __( 'Transform Origin', 'theplus' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'center center',
					'options' => [
						'top left'  => __( 'Top Left', 'theplus' ),
						'top center"'  => __( 'Top Center', 'theplus' ),
						'top right'  => __( 'Top Right', 'theplus' ),
						'center left'  => __( 'Center Left', 'theplus' ),
						'center center'  => __( 'Center Center', 'theplus' ),
						'center right'  => __( 'Center Right', 'theplus' ),
						'bottom left'  => __( 'Bottom Left', 'theplus' ),
						'bottom center'  => __( 'Bottom Center', 'theplus' ),
						'bottom right'  => __( 'Bottom Right', 'theplus' ),
					],
					'selectors'  => [
						'{{WRAPPER}} .plus-widget-wrapper' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
					],
					'render_type'  => 'template',
					'condition' => [
						'plus_continuous_animation' => 'yes',
						'plus_animation_effect' => 'rotating',
					],
				]
			);
		}
		protected function add_actions() {
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_magic_scroll' ], 10, 3 );
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_tooltip' ], 10, 3 );
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_mouseparallax' ], 10, 3 );
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_tilt_parallax' ], 10, 3 );
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_reveal_effect' ], 10, 3 );
			add_action( 'elementor/element/before_section_end', [ $this, 'register_controls_widget_continuous_animation' ], 10, 3 );
			
		}
	}

}