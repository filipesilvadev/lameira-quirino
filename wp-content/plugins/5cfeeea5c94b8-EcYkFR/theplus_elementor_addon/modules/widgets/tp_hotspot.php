<?php 
/*
Widget Name: Hotspot
Description: Style of pin point tooltips.
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
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

use TheplusAddons\Theplus_Element_Load;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Hotspot extends Widget_Base {
		
	public function get_name() {
		return 'tp-hotspot';
	}

    public function get_title() {
        return __('Hotspot', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-thumb-tack theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }
	
	public function get_style_depends() {
		return [ 'plus-hotspot-style' ];
	}
	
    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'hotspot_image',[
				'label' => __( 'Hotspot Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'layer_position',
			[
				'label' => __( 'Pin Position', 'theplus' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'select_option',
			[
				'label' => __( 'Pin Type', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon'  => __( 'Icon', 'theplus' ),
					'image'  => __( 'Image', 'theplus' ),
					'text'  => __( 'Text', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'select_option' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'label_block' => false,
				'default' => 'fa fa-chevron-right',
				'condition' => [
					'select_option' => 'icon',
					'icon_style' => 'font_awesome',
				],
			]
		);
		$repeater->add_control(
			'icons_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'options' => theplus_icons_mind(),
				'condition' => [
					'select_option' => 'icon',
					'icon_style' => 'icon_mind',
				],
			]
		);
		$repeater->add_control(
			'pin_image',[
				'label' => __( 'Pin Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'pin_text',
			[
				'label' => __( 'Pin Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Theplus', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->start_controls_tabs( 'icon_style_options' );
		$repeater->start_controls_tab( 'icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label'  => esc_html__( 'Icon Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner .pin-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'pin_bg_color',
			[
				'label'  => esc_html__( 'Background Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner .pin-loop-content' => 'background: {{VALUE}}',
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab( 'icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$repeater->add_control(
			'icon_hover_color',
			[
				'label'  => esc_html__( 'Icon Hover Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner:hover .pin-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_control(
			'pin_hover_bg_color',
			[
				'label'  => esc_html__( 'Background Hover Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner:hover .pin-loop-content' => 'background: {{VALUE}}',
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		
		$repeater->start_controls_tabs( 'responsive_device' );
		$repeater->start_controls_tab( 'normal',
			[
				'label' => __( 'Desktop', 'theplus' ),
			]
		);
		/*desktop  start*/
		$repeater->add_control(
			'd_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),				
			]
		);

		$repeater->add_control(
			'd_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 40,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'd_left_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'd_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
			]
		);
		$repeater->add_control(
			'd_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 40,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'd_right_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'd_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),				
			]
		);
		$repeater->add_control(
			'd_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 20,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'd_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'd_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
			]
		);
		$repeater->add_control(
			'd_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 20,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
				],
				'separator' => 'after',
				'condition'    => [
					'd_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		/*desktop end*/
		/*tablet start*/
		$repeater->start_controls_tab( 'tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
			]
		);
		$repeater->add_control(
			't_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
			]
		);
		$repeater->add_control(
			't_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_left_auto' => [ 'yes' ],
				],
			]
		);
		
		$repeater->add_control(
			't_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_right_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			't_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		/*tablet end*/
		/*mobile start*/
		$repeater->start_controls_tab( 'mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
			]
		);
		$repeater->add_control(
			'm_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
			]
		);
		$repeater->add_control(
			'm_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_left_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_right_auto' => [ 'yes' ],
				],
			]
		);
		
		$repeater->add_control(
			'm_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->add_control(
			'm_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		/*mobile end*/
		$repeater->add_control(
			'pin_content_options',[
				'label' => __( 'Pin Content', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->start_controls_tabs( 'plus_tooltip_tabs' );

		$repeater->start_controls_tab(
			'plus_tooltip_content_tab',
			[
				'label' => esc_html__( 'Content', 'theplus' ),
			]
		);
		$repeater->add_control(
			'plus_tooltip_content_type',
			[
				'label' => __( 'Content Type', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal_desc',
				'options' => [
					'normal_desc'  => __( 'Content Text', 'theplus' ),
					'content_wysiwyg'  => __( 'Content WYSIWYG', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'plus_tooltip_content_desc',
			[
				'label' => __( 'Description', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Luctus nec ullamcorper mattis', 'theplus' ),
				'condition' => [
					'plus_tooltip_content_type' => 'normal_desc',
				],
			]
		);
		$repeater->add_control(
			'plus_tooltip_content_wysiwyg',
			[
				'label' => __( 'Tooltip Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'condition' => [
					'plus_tooltip_content_type' => 'content_wysiwyg',
				],
			]				
		);
		$repeater->add_control(
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
				'label_block' => false,
				'selectors'  => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'plus_tooltip_content_type' => 'normal_desc',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plus_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content',
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],					
				],
			]
		);

		$repeater->add_control(
			'plus_tooltip_content_color',
			[
				'label'  => esc_html__( 'Text Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],					
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'plus_tooltip_styles_tab',
			[
				'label' => esc_html__( 'Style', 'theplus' ),
			]
		);
		$repeater->add_group_control(
			\Theplus_Tooltips_Option_Group::get_type(),
			array(
				'label' => __( 'Tooltip Options', 'theplus' ),
				'name'           => 'tooltip_opt',
				'render_type'  => 'template',
			)
		);
		$repeater->add_group_control(
			\Theplus_Loop_Tooltips_Option_Style_Group::get_type(),
			array(
				'label' => __( 'Style Options', 'theplus' ),
				'name'           => 'tooltip_style',
				'render_type'  => 'template',
			)
		);
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
		$repeater->add_control(
			'extra_options',[
				'label' => __( 'Extra Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'image_effect',[
				'label' => __( 'Continues Effect','theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal-drop_waves',
				'options' => [
					'' => __( 'None','theplus' ),
					'pulse' => __( 'Pulse','theplus' ),
					'floating' => __( 'Floating','theplus' ),
					'tossing' => __( 'Tossing','theplus' ),
					'normal-drop_waves' => __( 'Normal Drop Waves','theplus' ),
					'image-drop_waves' => __( 'Continue Drop Waves','theplus' ),					
					'hover_drop_waves' => __( 'Hover Drop Waves','theplus' ),
				],
			]
		);
		$repeater->add_control(
			'drop_waves_color',
			[
				'label' => __( 'Drop Wave Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.hover_drop_waves:after,{{WRAPPER}} .pin-hotspot-loop{{CURRENT_ITEM}} .pin-loop-inner.normal-drop_waves:after' => 'background: {{VALUE}}'
				],
				'condition'    => [
					'image_effect' => [ 'normal-drop_waves','image-drop_waves','hover_drop_waves' ],
				],
			]
		);
		
		$this->add_control(
            'pin_hotspot',
            [
				'label' => __( 'Add Multiple Pin Hotspot', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
				'description' => 'Add Pin Sections with Positions.',
                'default' => [
					'select_option' => '',
				],
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{select_option}}}',
            ]
        );
		$this->end_controls_section();
		/*Icon Style*/
		$this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Pin Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'pin_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Size', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font i.pin-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		
		
		$this->add_responsive_control(
            'icon_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Pin Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'icon_radius',
			[
				'label' => __( 'Icon Radius', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-font',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-font',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Pin Icon Style*/
		/*Pin Image Style*/
		$this->start_controls_section(
            'section_pin_image_styling',
            [
                'label' => __('Pin Image', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
            'pin_image_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Pin Image Size', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 25,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image img.pin-icon' => 'max-width: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_responsive_control(
            'pin_image_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Pin Image Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_image_style' );
		$this->start_controls_tab(
			'tab_image_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-image',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-image',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Pin Image Style*/
		/*Pin Text Style*/
		$this->start_controls_section(
            'section_text_styling',
            [
                'label' => __('Pin Text', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => __( 'Text Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text .pin-icon',
			]
		);
		$this->add_control(
			'text_padding',
			[
				'label' => __( 'Text Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'text_border_radius',
			[
				'label' => __( 'Border Radius', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text,{{WRAPPER}} .pin-loop-inner.image-drop_waves:after,{{WRAPPER}} .pin-loop-inner.hover_drop_waves:hover:after,{{WRAPPER}} .pin-loop-inner.normal-drop_waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_text_style' );
		$this->start_controls_tab(
			'tab_text_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'text_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-content.pin-icon-text',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_text_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'text_hover_box_shadow',
				'selector' => '{{WRAPPER}} .pin-hotspot-loop .pin-loop-inner:hover .pin-loop-content.pin-icon-text',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Pin Text Style*/
		/*Extra Option*/
		$this->start_controls_section(
            'section_extra_option_styling',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'overlay_color_option',
			[
				'label' => __( 'Hover Overlay Color', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => __( 'Overlay Background Color', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .theplus-hotspot .theplus-hotspot-inner:after',
				'condition' => [
					'overlay_color_option' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Extra Option*/
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
				'label'   => __( 'Choose Animation Effect', 'theplus' ),
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
		$overlay_color_option =($settings["overlay_color_option"]=='yes') ? 'overlay-bg-color' : '';
			
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
			
			/*-- pin cascading ---*/
				$pin_loop='';
				if(!empty($settings['pin_hotspot'])) {
						
					foreach($settings['pin_hotspot'] as $item) {
						$css_loop='';
						$uid_loop=uniqid("pin");
						$list_img=$select_option=$continue_effect='';
						
						if(!empty($item['image_effect'])){
							$continue_effect=$item['image_effect'];
						}
						
							$this->add_render_attribute( '_tooltip', 'data-tippy', '', true );

							if (!empty($item['plus_tooltip_content_type']) && $item['plus_tooltip_content_type']=='normal_desc') {
								$this->add_render_attribute( '_tooltip', 'title', $item['plus_tooltip_content_desc'], true );
							}else if (!empty($item['plus_tooltip_content_type']) && $item['plus_tooltip_content_type']=='content_wysiwyg') {
								$tooltip_content=$item['plus_tooltip_content_wysiwyg'];
								$this->add_render_attribute( '_tooltip', 'title', $tooltip_content, true );
							}
							
							$plus_tooltip_position=($item["tooltip_opt_plus_tooltip_position"]!='') ? $item["tooltip_opt_plus_tooltip_position"] : 'top';
							$this->add_render_attribute( '_tooltip', 'data-tippy-placement', $plus_tooltip_position, true );
							
							$tooltip_interactive =($item["tooltip_opt_plus_tooltip_interactive"]=='' || $item["tooltip_opt_plus_tooltip_interactive"]=='yes') ? 'true' : 'false';
							$this->add_render_attribute( '_tooltip', 'data-tippy-interactive', $tooltip_interactive, true );
							
							$plus_tooltip_theme=($item["tooltip_opt_plus_tooltip_theme"]!='') ? $item["tooltip_opt_plus_tooltip_theme"] : 'dark';
							$this->add_render_attribute( '_tooltip', 'data-tippy-theme', $plus_tooltip_theme, true );
							
							
							$tooltip_arrow =($item["tooltip_opt_plus_tooltip_arrow"]!='none' || $item["tooltip_opt_plus_tooltip_arrow"]=='') ? 'true' : 'false';
							$this->add_render_attribute( '_tooltip', 'data-tippy-arrow', $tooltip_arrow , true );
							
							$plus_tooltip_arrow=($item["tooltip_opt_plus_tooltip_arrow"]!='') ? $item["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
							$this->add_render_attribute( '_tooltip', 'data-tippy-arrowtype', $plus_tooltip_arrow, true );
							
							$plus_tooltip_animation=($item["tooltip_opt_plus_tooltip_animation"]!='') ? $item["tooltip_opt_plus_tooltip_animation"] : 'shift-toward';
							$this->add_render_attribute( '_tooltip', 'data-tippy-animation', $plus_tooltip_animation, true );
							
							$plus_tooltip_x_offset=($item["tooltip_opt_plus_tooltip_x_offset"]!='') ? $item["tooltip_opt_plus_tooltip_x_offset"] : 0;
							$plus_tooltip_y_offset=($item["tooltip_opt_plus_tooltip_y_offset"]!='') ? $item["tooltip_opt_plus_tooltip_y_offset"] : 0;
							$this->add_render_attribute( '_tooltip', 'data-tippy-offset', $plus_tooltip_x_offset .','. $plus_tooltip_y_offset, true );
							
							$tooltip_duration_in =($item["tooltip_opt_plus_tooltip_duration_in"]!='') ? $item["tooltip_opt_plus_tooltip_duration_in"] : 250;
							$tooltip_duration_out =($item["tooltip_opt_plus_tooltip_duration_out"]!='') ? $item["tooltip_opt_plus_tooltip_duration_out"] : 200;
							$tooltip_trigger =($item["tooltip_opt_plus_tooltip_triggger"]!='') ? $item["tooltip_opt_plus_tooltip_triggger"] : 'mouseenter';
							$tooltip_arrowtype =($item["tooltip_opt_plus_tooltip_arrow"]!='') ? $item["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
						
						if($item['select_option']=='icon'){
							$icons='';
							if(!empty($item["icon_style"]) && $item["icon_style"]=='font_awesome'){
								$icons=$item["icon_fontawesome"];
							}else if(!empty($item["icon_style"]) && $item["icon_style"]=='icon_mind'){
								$icons='fa '.$item["icons_mind"];
							}
							$list_img = '<i class=" '.esc_attr($icons).' pin-icon" ></i>';
							$select_option='pin-icon-font';
						}else if($item['select_option']=='image'){
							$image=$image_alt='';
							if(!empty($item["pin_image"]["url"])){
								$image=$item["pin_image"]["url"];
							}
							$image_id=$item["pin_image"]["id"];
							$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
							if(!$image_alt){
								$image_alt = get_the_title($image_id);
							}else if(!$image_alt){
								$image_alt = 'Plus icon image';
							}
							$list_img = '<img src="'.esc_url($image).'" class="pin-icon" alt="'.esc_attr($image_alt).'" />';
							$select_option='pin-icon-image';
						}else if($item['select_option']=='text'){
							$text='';
							if(!empty($item["pin_text"])){
								$text=$item["pin_text"];
							}
							$list_img = '<div class="pin-icon ">'.esc_html($text).'</div>';
							$select_option='pin-icon-text';
						}
						
						$pin_loop .= '<div id="'.esc_attr($uid_loop).'" class="pin-hotspot-loop '.esc_attr($uid_loop).' elementor-repeater-item-'.esc_attr($item['_id']). '" '.$this->get_render_attribute_string( '_tooltip' ).'>';
							$pin_loop .= '<div class="pin-loop-inner '.esc_attr($continue_effect).'">';
								$pin_loop .= '<div class="pin-loop-content '.esc_attr($select_option).'">';
									$pin_loop .=$list_img;
								$pin_loop .= '</div>';
							$pin_loop .= '</div>';
						$pin_loop .='</div>';
						
						$rpos='auto';$bpos='auto';$ypos='auto';$xpos='auto';
						if($item['d_left_auto']=='yes'){
							if(!empty($item['d_pos_xposition']['size']) || $item['d_pos_xposition']['size']=='0'){
								$xpos=$item['d_pos_xposition']['size'].$item['d_pos_xposition']['unit'];
							}
						}
						if($item['d_top_auto']=='yes'){
							if(!empty($item['d_pos_yposition']['size']) || $item['d_pos_yposition']['size']=='0'){
								$ypos=$item['d_pos_yposition']['size'].$item['d_pos_yposition']['unit'];
							}
						}
						if($item['d_bottom_auto']=='yes'){
							if(!empty($item['d_pos_bottomposition']['size']) || $item['d_pos_bottomposition']['size']=='0'){
								$bpos=$item['d_pos_bottomposition']['size'].$item['d_pos_bottomposition']['unit'];
							}
						}
						if($item['d_right_auto']=='yes'){
							if(!empty($item['d_pos_rightposition']['size']) || $item['d_pos_rightposition']['size']=='0'){
								$rpos=$item['d_pos_rightposition']['size'].$item['d_pos_rightposition']['unit'];
							}
						}
						
						$css_loop.='.pin-hotspot-loop.'.esc_attr($uid_loop).'{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';margin: 0 auto;}';
						
						if(!empty($item['t_responsive']) && $item['t_responsive']=='yes'){
							$tablet_xpos='auto';$tablet_ypos='auto';$tablet_bpos='auto';$tablet_rpos='auto';
							if($item['t_left_auto']=='yes'){
								if(!empty($item['t_pos_xposition']['size']) || $item['t_pos_xposition']['size']=='0'){
									$tablet_xpos=$item['t_pos_xposition']['size'].$item['t_pos_xposition']['unit'];
								}
							}
							if($item['t_top_auto']=='yes'){
								if(!empty($item['t_pos_yposition']['size']) || $item['t_pos_yposition']['size']=='0'){
									$tablet_ypos=$item['t_pos_yposition']['size'].$item['t_pos_yposition']['unit'];
								}
							}
							if($item['t_bottom_auto']=='yes'){
								if(!empty($item['t_pos_bottomposition']['size']) || $item['t_pos_bottomposition']['size']=='0'){
									$tablet_bpos=$item['t_pos_bottomposition']['size'].$item['t_pos_bottomposition']['unit'];
								}
							}
							if($item['t_right_auto']=='yes'){
								if(!empty($item['t_pos_rightposition']['size']) || $item['t_pos_rightposition']['size']=='0'){
									$tablet_rpos=$item['t_pos_rightposition']['size'].$item['t_pos_rightposition']['unit'];
								}
							}
							
							$css_loop.='@media (min-width:601px) and (max-width:990px){.pin-hotspot-loop.'.esc_attr($uid_loop).'{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';margin: 0 auto;}}';
						}
						if(!empty($item['m_responsive']) && $item['m_responsive']=='yes'){
							$mobile_xpos='auto';$mobile_ypos='auto';$mobile_bpos='auto';$mobile_rpos='auto';
							if($item['m_left_auto']=='yes'){
								if(!empty($item['m_pos_xposition']['size']) || $item['m_pos_xposition']['size']=='0'){
									$mobile_xpos=$item['m_pos_xposition']['size'].$item['m_pos_xposition']['unit'];
								}
							}
							if($item['m_top_auto']=='yes'){
								if(!empty($item['m_pos_yposition']['size']) || $item['m_pos_yposition']['size']=='0'){
									$mobile_ypos=$item['m_pos_yposition']['size'].$item['m_pos_yposition']['unit'];
								}
							}
							if($item['m_bottom_auto']=='yes'){
								if(!empty($item['m_pos_bottomposition']['size']) || $item['m_pos_bottomposition']['size']=='0'){
									$mobile_bpos=$item['m_pos_bottomposition']['size'].$item['m_pos_bottomposition']['unit'];
								}
							}
							if($item['m_right_auto']=='yes'){
								if(!empty($item['m_pos_rightposition']['size']) || $item['m_pos_rightposition']['size']=='0'){
									$mobile_rpos=$item['m_pos_rightposition']['size'].$item['m_pos_rightposition']['unit'];
								}
							}
							$css_loop.='@media (max-width:600px){.pin-hotspot-loop.'.esc_attr($uid_loop).'{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr($mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';margin: 0 auto;}}';
						}
						
						$pin_loop .='<script>						
						jQuery( document ).ready(function() {
							tippy( "#'.esc_attr($uid_loop).'" , {
								arrowType : "'.$tooltip_arrowtype.'",
								duration : ['.esc_attr($tooltip_duration_in).','.esc_attr($tooltip_duration_out).'],
								trigger : "'.esc_attr($tooltip_trigger).'",
								appendTo: document.querySelector("#'.esc_attr($uid_loop).'")
							});
						});						
						</script>';
						$pin_loop .='<style>'.$css_loop.'</style>';
					}
				}
			/*-- pin cascading ---*/
			
			$hotspot='<div class="theplus-hotspot '.esc_attr($animated_class).'" '.$animation_attr.'>';
				$hotspot .='<div class="theplus-hotspot-inner '.$overlay_color_option.'">';
				
				if(!empty($settings['hotspot_image']["url"])){
					$image_id=$settings["hotspot_image"]["id"];
					$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
					if(!$image_alt){
						$image_alt = get_the_title($image_id);
					}else if(!$image_alt){
						$image_alt = 'Plus hotspot image';
					}
					$hotspot .='<img class="hotspot-image" src="'.esc_url($settings['hotspot_image']["url"]).'" alt="'.esc_attr($image_alt).'">';
				}
				$hotspot .='<div class="hotspot-content-overlay">';
					$hotspot .= $pin_loop;
				$hotspot .='</div>';
				
				$hotspot .='</div>';
			$hotspot .='</div>';
		
		echo $hotspot;
	}
	
    protected function content_template() {
	
    }

}
