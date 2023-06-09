<?php 
/*
Widget Name: Off Canvas
Description: Toggle Content off canvas.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;

use TheplusAddons\Theplus_Element_Load;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Off_Canvas extends Widget_Base {
		
	public function get_name() {
		return 'tp-off-canvas';
	}

    public function get_title() {
        return __('Off Canvas', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-bars theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts','theplus-offcanvas'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Off Canvas Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'content_template',
			[
				'label'       => __( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
			]
		);
		$this->add_control(
			'select_toggle_canvas',
			[
				'label' => __( 'Select Option', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'icon'  => __( 'Icon', 'theplus' ),
					'button' => __( 'Call To Action', 'theplus' ),					
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'toggle_icon_style',
			[
				'label' => __( 'Icon Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),					
					'style-3' => __( 'Style 3', 'theplus' ),					
				],				
				'condition' => [
					'select_toggle_canvas' => 'icon',
				],
			]
		);
		$this->add_control(
			'toggle_icon_size',
			[
				'label' => __( 'Icon Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 150,
					],
				],
				'condition' => [
					'select_toggle_canvas' => 'icon',					
				],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'toggle_icon_weight',
			[
				'label' => __( 'Icon Weight', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 5,
						'step' => 0.5,
					],
				],
				'condition' => [
					'select_toggle_canvas' => 'icon',					
				],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3 span.menu_line' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'toggle_icon_padding',
			[
				'label' => __( 'Icon Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'select_toggle_canvas' => 'icon',					
				],
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Off Canvas', 'theplus' ),
				'condition' => [					
					'select_toggle_canvas' => 'button',
				],
			]
		);
		$this->add_control(
			'button_icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [					
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
					'none'  => __( 'None', 'theplus' ),
				],
				'separator' => 'before',
				'condition' => [					
					'select_toggle_canvas' => 'button',
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => __( 'Icon', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'label_block' => false,
				'default' => 'fa fa-chevron-right',
				'condition' => [
					'select_toggle_canvas' => 'button',
					'button_icon_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'button_icons_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'options' => theplus_icons_mind(),
				'condition' => [
					'select_toggle_canvas' => 'button',
					'button_icon_style' => 'icon_mind',
				],
			]
		);
		$this->add_control(
			'button_before_after',
			[
				'label' => __( 'Icon Position', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after' => __( 'After', 'theplus' ),
					'before' => __( 'Before', 'theplus' ),
				],
				'condition' => [
					'select_toggle_canvas' => 'button',
					'button_icon_style!' => 'none',
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'condition' => [
					'select_toggle_canvas' => 'button',
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',					
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => __( 'Icon Size', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 200,
					],
				],
				'condition' => [
					'select_toggle_canvas' => 'button',
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => __( 'Alignment', 'theplus' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'prefix_class' => 'text-%s',
				'default' => 'center',
			]
		);
		$this->end_controls_section();
		/*Call to Action 1 Style*/
		/*Extra Options Content*/
		$this->start_controls_section(
			'extra_option_content_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'content_open_style',
			[
				'label' => __( 'Content Open Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide'  => __( 'Slide', 'theplus' ),
					'push' => __( 'Push Content', 'theplus' ),
					'reveal' => __( 'Reveal Content', 'theplus' ),
					'slide-along' => __( 'Slide Along Content', 'theplus' ),					
					'corner-box' => __( 'Corner Box', 'theplus' ),
				],
				'selectors' => [
					'.plus-{{ID}}-open .plus-{{ID}}.plus-canvas-content-wrap.plus-visible' => '-webkit-transform: translate3d(0,0,0);transform: translate3d(0,0,0);',					
				],
			]
		);
		$this->add_control(
			'content_open_direction',
			[
				'label' => __( 'Content Open Direction', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'theplus' ),
					'right' => __( 'Right', 'theplus' ),
					'top' => __( 'Top', 'theplus' ),
					'bottom' => __( 'Bottom', 'theplus' ),
				],
				'condition' => [
					'content_open_style!' => 'corner-box',					
				],
			]
		);
		$this->add_control(
			'content_open_corner_box_direction',
			[
				'label' => __( 'Corner Box Direction', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => [
					'top-left'  => __( 'Top Left', 'theplus' ),
					'top-right' => __( 'Top Right', 'theplus' ),					
				],
				'condition' => [
					'content_open_style' => 'corner-box',					
				],
			]
		);
		$this->add_responsive_control(
			'content_open_width',
			[
				'label' => __( 'Content Open Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 800,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 300,
				],
				'selectors' => [
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top,.plus-{{ID}}.plus-canvas-content-wrap.plus-bottom' => 'width: 100%;height: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}.plus-canvas-content-wrap' => 'width: {{SIZE}}{{UNIT}};',			
					'.plus-{{ID}}-open.plus-push.plus-open.plus-left .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-left .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-left .plus-offcanvas-container' => '-webkit-transform: translate3d({{SIZE}}{{UNIT}}, 0, 0);transform: translate3d({{SIZE}}{{UNIT}}, 0, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-right .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-right .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-right .plus-offcanvas-container' => '-webkit-transform: translate3d(-{{SIZE}}{{UNIT}}, 0, 0);transform: translate3d(-{{SIZE}}{{UNIT}}, 0, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-top .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-top .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-top .plus-offcanvas-container' => '-webkit-transform: translate3d(0,{{SIZE}}{{UNIT}}, 0);transform: translate3d( 0,{{SIZE}}{{UNIT}}, 0);',
					'.plus-{{ID}}-open.plus-push.plus-open.plus-bottom .plus-offcanvas-container,.plus-{{ID}}-open.plus-reveal.plus-open.plus-bottom .plus-offcanvas-container,.plus-{{ID}}-open.plus-slide-along.plus-open.plus-bottom .plus-offcanvas-container' => '-webkit-transform: translate3d(0,-{{SIZE}}{{UNIT}}, 0);transform: translate3d( 0,-{{SIZE}}{{UNIT}}, 0);',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-corner-box' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top-left.plus-corner-box' => '-webkit-transform: translate3d(-{{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);transform: translate3d(-{{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);',
					'.plus-{{ID}}.plus-canvas-content-wrap.plus-top-right.plus-corner-box' => '-webkit-transform: translate3d({{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);transform: translate3d({{SIZE}}{{UNIT}},-{{SIZE}}{{UNIT}},0);',
				],
			]
		);
		$this->add_control(
			'event_esc_close_content',
			[
				'label' => __( 'Esc Button Close Content', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'event_body_click_close_content',
			[
				'label' => __( 'Outer Click Close Content', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		/*Fixed Buton Toggle*/
		$this->add_control(
			'fixed_toggle_button',
			[
				'label' => __( 'Fixed Toggle Button', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'show_scroll_window_offset',
			[
				'label' => __( 'Show Menu Scroll Offset', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'scroll_top_offset_value',
			[
				'label' => __( 'Scroll Top Offset Value', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => 'px',
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'condition' => [
					'fixed_toggle_button' => [ 'yes' ],
					'show_scroll_window_offset' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'fixed_toggle_position' );
		/*desktop  start*/
		$this->start_controls_tab( 'fixed_toggle_desktop',
			[
				'label' => __( 'Desktop', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);		
		$this->add_control(
			'd_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),		
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'd_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'd_left_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'd_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],					
				],
			]
		);
		$this->add_control(
			'd_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 2000,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'd_right_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'd_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],				
				],
			]
		);
		$this->add_control(
			'd_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => 5,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 800,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'd_top_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'd_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],					
				],
			]
		);
		$this->add_control(
			'd_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 800,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'd_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_tab();
		/*desktop end*/
		/*tablet start*/
		$this->start_controls_tab( 'fixed_toggle_tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 1200,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
					't_left_auto' => [ 'yes' ],
				],
			]
		);
		
		$this->add_control(
			't_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 1200,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
					't_right_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 800,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
					't_top_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			't_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 800,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					't_responsive' => [ 'yes' ],
					't_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_tab();
		/*tablet end*/
		/*mobile start*/
		$this->start_controls_tab( 'fixed_toggle_mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 700,
						'step' => 1,
					],
				],
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
					'm_left_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 700,
						'step' => 1,
					],
				],
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
					'm_right_auto' => [ 'yes' ],
				],
			]
		);
		
		$this->add_control(
			'm_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 700,
						'step' => 1,
					],
				],
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
					'm_top_auto' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
			'm_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => -100,
						'max' => 700,
						'step' => 1,
					],
				],
				'condition'    => [
					'fixed_toggle_button' => [ 'yes' ],
					'm_responsive' => [ 'yes' ],
					'm_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_tab();
		/*mobile end*/
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Extra Options Content*/
		/*Toggle Content Style*/
		$this->start_controls_section(
            'toggle_content_section_styling',
            [
                'label' => __('Open Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,				
            ]
        );
		$this->add_responsive_control(
			'open_content_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
							'top' => '10',
							'right' => '25',
							'bottom' => '10',
							'left' => '25',
							'isLinked' => false 
				],
				'selectors' => [
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-content-editor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->start_controls_tabs( 'tabs_open_content_style' );
		$this->start_controls_tab(
			'tab_open_content_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'open_content_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap',
			]
		);
		$this->add_responsive_control(
			'open_content_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.plus-{{ID}}.plus-canvas-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'open_content_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap',				
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_open_content_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'open_content_hover_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'open_content_close_icon_heading',
			[
				'label' => __( 'Close Icon', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'open_content_close_icon_display',
			[
				'label' => __( 'Display Close Icon', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'open_content_close_icon_align',
			[
				'label' => __( 'Icon Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'theplus' ),
						'icon' => 'fa fa-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'theplus' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'right',
				'toggle' => true,
				'label_block' => false,
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_open_content_close_style' );
		$this->start_controls_tab(
			'tab_open_content_close_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'open_content_close_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:before,.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:after' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'open_content_close_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close',
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'open_content_close_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'open_content_close_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close',
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_open_content_close_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'open_content_close_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover:before,.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover:after' => 'border-bottom-color: {{VALUE}}',
				],
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'open_content_close_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover',
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'open_content_close_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'open_content_close_hover_shadow',
				'selector' => '.plus-{{ID}}.plus-canvas-content-wrap .plus-offcanvas-close:hover',
				'condition' => [					
					'open_content_close_icon_display' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'open_content_overlay_heading',
			[
				'label' => __( 'Overlay Color', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'open_content_overlay_background',
				'label' => __( 'Overlay Color', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '.plus-offcanvas-content-widget.plus-{{ID}}-open .plus-offcanvas-container:after',
			]
		);
		$this->end_controls_section();
		/*Toggle Content Style*/
		/*Toggle Icon Style*/
		$this->start_controls_section(
            'toggle_icon_style_section_styling',
            [
                'label' => __('Toggle Icon/Humberger', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [					
					'select_toggle_canvas' => 'icon',
				],
            ]
        );
		$this->add_control(
			'icon_border',
			[
				'label' => __( 'Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'icon_border_style',
			[
				'label'   => __( 'Border Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __( 'None', 'theplus' ),
					'solid'  => __( 'Solid', 'theplus' ),
					'dotted' => __( 'Dotted', 'theplus' ),
					'dashed' => __( 'Dashed', 'theplus' ),
					'groove' => __( 'Groove', 'theplus' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'border-style: {{VALUE}};',
				],
				'condition' => [					
					'icon_border' => 'yes',
				],				
			]
		);
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2 span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3 span.menu_line' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3',
			]
		);
		
		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_border' => 'yes',
					'icon_border_style!' => 'none',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'     => __( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'border-color: {{VALUE}};',					
				],
				'condition' => [
					'icon_border' => 'yes',
					'icon_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'icon_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover span.menu_line,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover span.menu_line' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover',
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label'     => __( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover' => 'border-color: {{VALUE}};',					
				],
				'separator' => 'before',
				'condition' => [
					'icon_border' => 'yes',
					'icon_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'icon_hover_radius',
			[
				'label'      => __( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-1:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-2:hover,{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn.humberger-style-3:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle icon Style*/
		/*Toggle Button Style*/
		$this->start_controls_section(
            'toggle_style_section_styling',
            [
                'label' => __('Toggle Button', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [					
					'select_toggle_canvas' => 'button',
				],
            ]
        );
		$this->add_control(
			'button_full_width',
			[
				'label' => __( 'Full Width Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
							'top' => '10',
							'right' => '25',
							'bottom' => '10',
							'left' => '25',
							'isLinked' => false 
				],
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn',
			]
		);
		$this->add_control(
			'button_border',
			[
				'label' => __( 'Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'button_border_style',
			[
				'label'   => __( 'Border Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'none'   => __( 'None', 'theplus' ),
					'solid'  => __( 'Solid', 'theplus' ),
					'dotted' => __( 'Dotted', 'theplus' ),
					'dashed' => __( 'Dashed', 'theplus' ),
					'groove' => __( 'Groove', 'theplus' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-style: {{VALUE}};',
				],
				'condition' => [					
					'button_border' => 'yes',
				],
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'color: {{VALUE}};',					
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn',
			]
		);
		
		$this->add_responsive_control(
			'button_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_border' => 'yes',
					'button_border_style!' => 'none',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-color: {{VALUE}};',					
				],
				'condition' => [
					'button_border' => 'yes',
					'button_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn',				
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'button_text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover',
			]
		);
		$this->add_control(
			'button_border_hover_color',
			[
				'label'     => __( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'border-color: {{VALUE}};',					
				],
				'separator' => 'before',
				'condition' => [
					'button_border' => 'yes',
					'button_border_style!' => 'none'
				],
			]
		);

		$this->add_responsive_control(
			'button_hover_radius',
			[
				'label'      => __( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-offcanvas-wrapper .offcanvas-toggle-btn:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Button Style*/
		$this->start_controls_section(
            'content_scrolling_bar_section_styling',
            [
                'label' => __('Content Scrolling Bar', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,				
				
            ]
        );
		$this->add_control(
			'display_scrolling_bar',
			[
				'label' => __( 'Content Scrolling Bar', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),				
				'default' => 'yes',
			]
		);
		
		$this->start_controls_tabs( 'tabs_scrolling_bar_style' );
		$this->start_controls_tab(
			'tab_scrolling_bar_scrollbar',
			[
				'label' => __( 'Scrollbar', 'theplus' ),
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_control(
			'scroll_scrollbar_width',
			[
				'label' => __( 'ScrollBar Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'scroll_scrollbar_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar',
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_thumb',
			[
				'label' => __( 'Thumb', 'theplus' ),
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'scroll_thumb_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb',
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'scroll_thumb_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',					
				],
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'scroll_thumb_shadow',
				'selector' => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-thumb',
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_track',
			[
				'label' => __( 'Track', 'theplus' ),
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'scroll_track_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track',
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'scroll_track_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'scroll_track_shadow',
				'selector' => '.plus-canvas-content-wrap.plus-{{ID}}::-webkit-scrollbar-track',
				'condition' => [
					'display_scrolling_bar' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Button Style*/
		$this->start_controls_section(
            'section_animation_styling',
            [
                'label' => __('On Scroll View Animation', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'animation_effects',
			[
				'label'   => __( 'In Animation Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => theplus_get_animation_options(),
			]
		);
		$this->add_control(
            'animation_delay',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Animation Delay', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 50,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 4000,
						'step' => 15,
					],
				],
				'condition' => [
					'animation_effects!' => 'no-animation',
				],
            ]
        );
		$this->add_control(
            'animation_duration_default',
            [
				'label'   => esc_html__( 'Animation Duration', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'animation_effects!' => 'no-animation',
				],
			]
		);
		$this->add_control(
            'animate_duration',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Duration Speed', 'theplus'),
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'	=> 100,
						'max'	=> 10000,
						'step' => 100,
					],
				],
				'condition' => [
					'animation_effects!' => 'no-animation',
					'animation_duration_default' => 'yes',
				],
            ]
        );
		$this->add_control(
			'animation_out_effects',
			[
				'label'   => __( 'Out Animation Effect', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => theplus_get_out_animation_options(),
				'separator' => 'before',
				'condition' => [
					'animation_effects!' => 'no-animation',
				],
			]
		);
		$this->add_control(
            'animation_out_delay',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Out Animation Delay', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 50,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 4000,
						'step' => 15,
					],
				],
				'condition' => [
					'animation_effects!' => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				],
            ]
        );
		$this->add_control(
            'animation_out_duration_default',
            [
				'label'   => esc_html__( 'Out Animation Duration', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'animation_effects!' => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				],
			]
		);
		$this->add_control(
            'animation_out_duration',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Duration Speed', 'theplus'),
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min'	=> 100,
						'max'	=> 10000,
						'step' => 100,
					],
				],
				'condition' => [
					'animation_effects!' => 'no-animation',
					'animation_out_effects!' => 'no-animation',
					'animation_out_duration_default' => 'yes',
				],
            ]
        );
		$this->end_controls_section();
	}
	
	 protected function render() {

        $settings = $this->get_settings_for_display();
		$widget_uid='canvas-'.$this->get_id();
		$content_id=$this->get_id();
		$fixed_toggle_button = ($settings["fixed_toggle_button"]=='yes') ? 'position-fixed' : '';
		$show_scroll_window_offset = ($settings["fixed_toggle_button"]=='yes' && $settings['show_scroll_window_offset']=='yes') ? 'scroll-view' : '';
		$scroll_top_offset_value = ($settings["fixed_toggle_button"]=='yes' && $settings['show_scroll_window_offset']=='yes') ? 'data-scroll-view="'.$settings['scroll_top_offset_value']["size"].'"' : '';
		
		$content_open_style=$settings["content_open_style"];
		$content_open_direction=$settings["content_open_direction"];
		$display_scrolling_bar=($settings["display_scrolling_bar"]!='yes') ? 'scroll-bar-disable' : '';
		$event_esc_close_content=($settings["event_esc_close_content"]=='yes') ? 'yes' : 'no';
		$event_body_click_close_content=($settings["event_body_click_close_content"]=='yes') ? 'yes' : 'no';
		if($content_open_style=='corner-box'){
			$content_open_direction=$settings["content_open_corner_box_direction"];
		}
		
		$animation_effects=$settings["animation_effects"];
		$animation_delay=$settings["animation_delay"]["size"];			
		if($animation_effects=='no-animation'){
			$animated_class = '';
			$animation_attr = '';
		}else{
			$animate_offset = theplus_scroll_animation();
			$animated_class = 'animate-general';
			$animation_attr = ' data-animate-type="'.esc_attr($animation_effects).'" data-animate-delay="'.esc_attr($animation_delay).'"';
			$animation_attr .= ' data-animate-offset="'.esc_attr($animate_offset).'"';
			if($settings["animation_duration_default"]=='yes'){
				$animate_duration=$settings["animate_duration"]["size"];
				$animation_attr .= ' data-animate-duration="'.esc_attr($animate_duration).'"';
			}
			if(!empty($settings["animation_out_effects"]) && $settings["animation_out_effects"]!='no-animation'){
				$animation_attr .= ' data-animate-out-type="'.esc_attr($settings["animation_out_effects"]).'" data-animate-out-delay="'.esc_attr($settings["animation_out_delay"]["size"]).'"';					
				if($settings["animation_out_duration_default"]=='yes'){						
					$animation_attr .= ' data-animate-out-duration="'.esc_attr($settings["animation_out_duration"]["size"]).'"';
				}
			}
		}
		
		$uid = uniqid("canvas-");
		$data_attr = 'data-settings={"content_id":"'.$content_id.'","transition":"'.esc_attr($content_open_style).'","direction":"'.esc_attr($content_open_direction).'","esc_close":"'.esc_attr($event_esc_close_content).'","body_click_close":"'.esc_attr($event_body_click_close_content).'"}';
		//button
		$toggle_content='';
		$full_width_button=($settings["select_toggle_canvas"]=='button' && !empty($settings['button_full_width']) && $settings['button_full_width']=='yes') ? 'btn_full_width' : '';
		if($settings["select_toggle_canvas"]=='button'){
			$toggle_content .='<div class="offcanvas-toggle-btn toggle-button-style '.esc_attr($fixed_toggle_button).' '.esc_attr($full_width_button).'">';
				$toggle_content .= $this->render_text_one();
			$toggle_content .='</div>';
		}
		if($settings["select_toggle_canvas"]=='icon' && !empty($settings["toggle_icon_style"])){
			if($settings["toggle_icon_style"]=='style-1' || $settings["toggle_icon_style"]=='style-2' || $settings["toggle_icon_style"]=='style-3'){
				$toggle_content .='<div class="offcanvas-toggle-btn humberger-'.esc_attr($settings["toggle_icon_style"]).' '.esc_attr($fixed_toggle_button).'">';
					$toggle_content .='<span class="menu_line menu_line--top"></span>';
					$toggle_content .='<span class="menu_line menu_line--center"></span>';
					$toggle_content .='<span class="menu_line menu_line--bottom"></span>';
				$toggle_content .='</div>';
			}
		}
		
		$off_canvas ='<div class="plus-offcanvas-wrapper '.esc_attr($widget_uid).' '.$animated_class.' '.esc_attr($show_scroll_window_offset).'" data-canvas-id="'.esc_attr($widget_uid).'" '.$data_attr.' '.$scroll_top_offset_value.' '.$animation_attr.'>';
			
			$off_canvas .='<div class="offcanvas-toggle-wrap">';
				$off_canvas .=$toggle_content;
			$off_canvas .='</div>';
			
			$off_canvas .='<div class="plus-canvas-content-wrap plus-'.esc_attr($content_id).' plus-'.esc_attr($content_open_direction).' plus-'.esc_attr($content_open_style).' '.esc_attr($display_scrolling_bar).'">';
				if(!empty($settings["open_content_close_icon_display"]) && $settings["open_content_close_icon_display"]=='yes'){					
					$off_canvas .='<div class="plus-offcanvas-header direction-'.esc_attr($settings["open_content_close_icon_align"]).'"><div class="plus-offcanvas-close plus-offcanvas-close-'.$content_id.'" role="button"></div></div>';
				}
				if(!empty($settings['content_template'])){
					$off_canvas .='<div class="plus-content-editor">'.Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['content_template'] ).'</div>';
				}
			$off_canvas .='</div>';
			
		$off_canvas .='</div>';
		
		if(!empty($settings["fixed_toggle_button"]) && $settings["fixed_toggle_button"]=='yes'){
			$off_canvas .='<style>';
			$rpos='auto';$bpos='auto';$ypos='auto';$xpos='auto';
				if($settings['d_left_auto']=='yes'){
					if(!empty($settings['d_pos_xposition']['size']) || $settings['d_pos_xposition']['size']=='0'){
						$xpos=$settings['d_pos_xposition']['size'].$settings['d_pos_xposition']['unit'];
					}
				}
				if($settings['d_top_auto']=='yes'){
					if(!empty($settings['d_pos_yposition']['size']) || $settings['d_pos_yposition']['size']=='0'){
						$ypos=$settings['d_pos_yposition']['size'].$settings['d_pos_yposition']['unit'];
					}
				}
				if($settings['d_bottom_auto']=='yes'){
					if(!empty($settings['d_pos_bottomposition']['size']) || $settings['d_pos_bottomposition']['size']=='0'){
						$bpos=$settings['d_pos_bottomposition']['size'].$settings['d_pos_bottomposition']['unit'];
					}
				}
				if($settings['d_right_auto']=='yes'){
					if(!empty($settings['d_pos_rightposition']['size']) || $settings['d_pos_rightposition']['size']=='0'){
						$rpos=$settings['d_pos_rightposition']['size'].$settings['d_pos_rightposition']['unit'];
					}
				}
				
				$off_canvas.='.'.esc_attr($widget_uid).' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';}';
				
				if(!empty($settings['t_responsive']) && $settings['t_responsive']=='yes'){
					$tablet_xpos='auto';$tablet_ypos='auto';$tablet_bpos='auto';$tablet_rpos='auto';
					if($settings['t_left_auto']=='yes'){
						if(!empty($settings['t_pos_xposition']['size']) || $settings['t_pos_xposition']['size']=='0'){
							$tablet_xpos=$settings['t_pos_xposition']['size'].$settings['t_pos_xposition']['unit'];
						}
					}
					if($settings['t_top_auto']=='yes'){
						if(!empty($settings['t_pos_yposition']['size']) || $settings['t_pos_yposition']['size']=='0'){
							$tablet_ypos=$settings['t_pos_yposition']['size'].$settings['t_pos_yposition']['unit'];
						}
					}
					if($settings['t_bottom_auto']=='yes'){
						if(!empty($settings['t_pos_bottomposition']['size']) || $settings['t_pos_bottomposition']['size']=='0'){
							$tablet_bpos=$settings['t_pos_bottomposition']['size'].$settings['t_pos_bottomposition']['unit'];
						}
					}
					if($settings['t_right_auto']=='yes'){
						if(!empty($settings['t_pos_rightposition']['size']) || $settings['t_pos_rightposition']['size']=='0'){
							$tablet_rpos=$settings['t_pos_rightposition']['size'].$settings['t_pos_rightposition']['unit'];
						}
					}
					
					$off_canvas.='@media (min-width:601px) and (max-width:990px){.'.esc_attr($widget_uid).' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';}';
					
					$off_canvas.='}';
				}
				if(!empty($settings['m_responsive']) && $settings['m_responsive']=='yes'){
					$mobile_xpos='auto';$mobile_ypos='auto';$mobile_bpos='auto';$mobile_rpos='auto';
					if($settings['m_left_auto']=='yes'){
						if(!empty($settings['m_pos_xposition']['size']) || $settings['m_pos_xposition']['size']=='0'){
							$mobile_xpos=$settings['m_pos_xposition']['size'].$settings['m_pos_xposition']['unit'];
						}
					}
					if($settings['m_top_auto']=='yes'){
						if(!empty($settings['m_pos_yposition']['size']) || $settings['m_pos_yposition']['size']=='0'){
							$mobile_ypos=$settings['m_pos_yposition']['size'].$settings['m_pos_yposition']['unit'];
						}
					}
					if($settings['m_bottom_auto']=='yes'){
						if(!empty($settings['m_pos_bottomposition']['size']) || $settings['m_pos_bottomposition']['size']=='0'){
							$mobile_bpos=$settings['m_pos_bottomposition']['size'].$settings['m_pos_bottomposition']['unit'];
						}
					}
					if($settings['m_right_auto']=='yes'){
						if(!empty($settings['m_pos_rightposition']['size']) || $settings['m_pos_rightposition']['size']=='0'){
							$mobile_rpos=$settings['m_pos_rightposition']['size'].$settings['m_pos_rightposition']['unit'];
						}
					}
					$off_canvas.='@media (max-width:600px){.'.esc_attr($widget_uid).' .offcanvas-toggle-wrap .offcanvas-toggle-btn.position-fixed{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr($mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';}';
					
					$off_canvas.='}';
				}
			$off_canvas .='</style>';
		}
		echo $off_canvas;
	}
	
    protected function content_template() {
	
    }
	protected function render_text_one(){
		$icons_after=$icons_before=$button_text='';
		$settings = $this->get_settings_for_display();
		
		$before_after = $settings['button_before_after'];
		$button_text = $settings['button_text'];
		
		if($settings["button_icon_style"]=='font_awesome'){
			$icons=$settings["button_icon"];
		}else if($settings["button_icon_style"]=='icon_mind'){
			$icons=$settings["button_icons_mind"];
		}else{
			$icons='';
		}
		
		if($before_after=='before' && !empty($icons)){
			$icons_before = '<i class="btn-icon button-before '.esc_attr($icons).'"></i>';
		}
		if($before_after=='after' && !empty($icons)){
		   $icons_after = '<i class="btn-icon button-after '.esc_attr($icons).'"></i>';
		}
		
		$button_text =$icons_before.'<span class="btn-text">'.$button_text.'</span>'. $icons_after;
		
		return $button_text;
	}
}
