<?php 
/*
Widget Name: Cascading Image 
Description: cascading multiple image creative effects.
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
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Cascading_Image extends Widget_Base {
		
	public function get_name() {
		return 'tp-cascading-image';
	}

    public function get_title() {
        return __('Image Cascading', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-object-group theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts',
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Image Cascading', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'layer_position',
			[
				'label' => __( 'Layer Position', 'theplus' ),
				'type' => Controls_Manager::HEADING,
			]
		);
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
		$repeater->add_control(
			'd_pos_width',[
				'label' => __( 'Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 2,
					],
				],
				'separator' => 'after',
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
		$repeater->add_control(
			't_pos_width',[
				'label' => __( 'Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 2,
					],
				],
				'separator' => 'after',
				'condition'    => [
					't_responsive' => [ 'yes' ],
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
		$repeater->add_control(
			'm_pos_width',[
				'label' => __( 'Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 2,
					],
				],
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		/*mobile end*/
		$repeater->add_control(
			'select_option',[
				'label' => __( 'Layer Type','theplus' ),
				'type' => Controls_Manager::SELECT,
				'separator' => 'before',
				'default' => 'image',				
				'options' => [
					'image' => __( 'Image','theplus' ),
					'text' => __( 'Text Content','theplus' ),
				],
			]
		);
		$repeater->add_control(
			'multiple_image',[
				'label' => __( 'Image Select', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'image_size',[
				'type' => Controls_Manager::TEXT,
				'label' => __('Image Size', 'theplus'),
				'label_block' => true,
				'default' => 'full',
				'description' => __("E.g. full, thumbnail, medium, tp-image-grid", "theplus"),						
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'text_content',
			[
				'label' => __( 'Text Content', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'ThePlus Addons', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'text_content_typography',
				'label' => __( 'Text Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content a',
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_content_shadow',
				'label' => __( 'Text Shadow', 'theplus' ),
				'selector' => '{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content',
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->add_control(
			'text_content_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content a' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->add_control(
			'text_content_hover_color',
			[
				'label' => __( 'Text Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}:hover .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}:hover .cascading-inner-content a' => 'color: {{VALUE}}',
				],
				'condition'    => [
					'select_option' => [ 'text' ],
				],
			]
		);
		$repeater->add_control(
			'extra_options',[
				'label' => __( 'Extra Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);		
		$repeater->add_control(
			'image_effect',[
				'label' => __( 'Continues Effect','theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'None','theplus' ),
					'pulse' => __( 'Pulse','theplus' ),
					'floating' => __( 'Floating','theplus' ),
					'tossing' => __( 'Tossing','theplus' ),
					'continue-scale' => __( 'Kenburns Scale','theplus' ),
					'hover-scale' => __( 'Hover Scale','theplus' ),
					'drop-waves' => __( 'Drop Waves','theplus' ),
					'hover-drop-waves' => __( 'Hover Drop Waves','theplus' ),
				],
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_control(
			'drop_waves_color',
			[
				'label' => __( 'Drop Wave Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after' => 'background: {{VALUE}}'
				],
				'condition'    => [
					'select_option' => [ 'image','text' ],
					'image_effect' => [ 'drop-waves','hover-drop-waves' ],
				],
			]
		);
		$repeater->add_control(
			'mask_image_display',[
				'label'   => esc_html__( 'Mask Image Shape', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'description' => __('Use PNG image with the shape you want to mask around Media Image.', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_control(
			'mask_shape_image',
			[
				'label' => __( 'Mask Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'description' => __( 'Use PNG image with the shape you want to mask around feature image.', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .cascading-inner-content' => 'mask-image: url({{URL}});-webkit-mask-image: url({{URL}});',
				],
				'condition' => [					
					'mask_image_display' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'mask_image_shadow',
			[
				'label' => __( 'Image Shadow', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => __( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}},{{WRAPPER}} .cascading-text{{CURRENT_ITEM}}' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				],
				'render_type' => 'ui',
				'condition' => [					
					'mask_image_display' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'loop_magic_scroll',[
				'label'   => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			[
				'label' => __( 'Scroll Options', 'theplus' ),
				'name'           => 'loop_scroll_option',
				'render_type'  => 'template',
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->start_controls_tabs( 'loop_tab_magic_scroll' );
		$repeater->start_controls_tab(
			'loop_tab_scroll_from',
			[
				'label' => __( 'Initial', 'theplus' ),
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			[
				'label' => __( 'Initial Position', 'theplus' ),
				'name'           => 'loop_scroll_from',
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'loop_tab_scroll_to',
			[
				'label' => __( 'Final', 'theplus' ),
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			[
				'label' => __( 'Final Position', 'theplus' ),
				'name'           => 'loop_scroll_to',
				'condition'    => [
					'loop_magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'plus_tooltip',
			[
				'label'        => esc_html__( 'Tooltip', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			]
		);

		$repeater->start_controls_tabs( 'plus_tooltip_tabs' );

		$repeater->start_controls_tab(
			'plus_tooltip_content_tab',
			[
				'label' => esc_html__( 'Content', 'theplus' ),
				'condition' => [
					'plus_tooltip' => 'yes',
				],
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
				'condition' => [
					'plus_tooltip' => 'yes',
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
					'plus_tooltip' => 'yes',
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
					'plus_tooltip' => 'yes',
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
				'selectors'  => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip' => 'yes',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plus_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content',
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
					'plus_tooltip' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'plus_tooltip_content_color',
			[
				'label'  => esc_html__( 'Text Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} .cascading-text{{CURRENT_ITEM}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
					'plus_tooltip' => 'yes',
				],
			]
		);
		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'plus_tooltip_styles_tab',
			[
				'label' => esc_html__( 'Style', 'theplus' ),
				'condition' => [
					'plus_tooltip' => 'yes',
				],
			]
		);
		$repeater->add_group_control(
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
		$repeater->add_group_control(
			\Theplus_Loop_Tooltips_Option_Style_Group::get_type(),
			array(
				'label' => __( 'Style Options', 'theplus' ),
				'name'           => 'tooltip_style',
				'render_type'  => 'template',
				'condition'    => [
					'plus_tooltip' => [ 'yes' ],
				],
			)
		);
		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();
		$repeater->add_control(
			'special_effect',[
				'label'   => esc_html__( 'Special Effect', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',				
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_control(
			'effect_color_1',[
				'label' => __('Effect Color 1', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#313131',
				'condition'    => [
					'special_effect' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'effect_color_2',[
				'label' => __('Effect Color 2', 'theplus'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff214f',
				'condition'    => [
					'special_effect' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'cascading_move_parallax',[
				'label'   => esc_html__( 'Parallax Move', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_control(
			'cascading_move_speed_x',[
				'label' => __( 'Move Parallax (X)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'cascading_move_parallax' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'cascading_move_speed_y',[
				'label' => __( 'Move Parallax (Y)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'range' => [
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'cascading_move_parallax' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'hover_parallax',[
				'label'   => esc_html__( 'On Hover Tilt', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'condition'    => [
					'select_option' => [ 'image','text' ],
				],
			]
		);
		$repeater->add_control(
			'parallax_translatez',[
				'label' => __( 'TranslateZ', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'hover_parallax' => 'yes',
				],
			]
		);
		$repeater->add_control(
            'link_option', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Link /Popup', 'theplus'),
				'default' => '',
				'separator' => 'before',
				'options' => [
                    '' => __('Select Option', 'theplus'),
                    'normal_link' => __('Link', 'theplus'),
					'popup_link' => __('Popup', 'theplus'),
                ],	
			]
        );
		$repeater->add_control(
			'image_link',
			[
				'label' => __( 'Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
				'separator' => 'after',
				'condition' => [
					'link_option' => [ 'normal_link' ],
				],
			]
		);
		$repeater->add_control(
			'popup_content',
			[
				'label' => __( 'Popup Content', 'theplus' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://www.youtube.com/watch?v=2ReiWfKUxIM&t=', 'theplus' ),
				'show_external' => false,
				'description' => __('Enter direct link of Youtube,Vimeo, Google Map or any other.', 'theplus'),
				'separator' => 'after',
				'default' => [
					'url' => '',
					'is_external' => false,
					'nofollow' => true,
				],
				'separator' => 'after',
				'condition' => [
					'link_option' => [ 'popup_link' ],
				],
			]
		);
		$repeater->start_controls_tabs( 'nav_shadow_style' );
		$repeater->start_controls_tab(
			'nav_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'overlay_background',
			[
				'label' => __( 'Overlay Background', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:after' => 'background: {{VALUE}}'
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_shadow',
				'selector' => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-image-inner',
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'opacity_normal',[
				'label' => __( 'Opacity', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 1,
				],
				'range' => [
					'%' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'transform_css',
			[
				'label' => __( 'Transform css', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'rotate(10deg) scale(1.1)', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};transform-style: preserve-3d;-ms-transform-style: preserve-3d;-moz-transform-style: preserve-3d;-webkit-transform-style: preserve-3d;'
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-image-inner,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content.hover-drop-waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'nav_shadow_active',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'hover_overlay_background',
			[
				'label' => __( 'Overlay Background', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}} .cascading-inner-content:hover:after' => 'background: {{VALUE}}'
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_hover_shadow',
				'selector' => '{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover',
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'opacity_hover',[
				'label' => __( 'Hover Opacity', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 1,
				],
				'range' => [
					'%' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover' => 'opacity: {{SIZE}};',
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'transform_hover_css',
			[
				'label' => __( 'Transform Hover css', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'rotate(10deg) scale(1.1)', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover' => 'transform: {{VALUE}};-ms-transform: {{VALUE}};-moz-transform: {{VALUE}};-webkit-transform: {{VALUE}};'
				],
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'border_radius_hover',
			[
				'label'      => __( 'Border Radius Hover', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content.drop-waves:after,{{WRAPPER}} .cascading-image{{CURRENT_ITEM}}:hover .cascading-inner-content.hover-drop-waves:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'separator' => 'before',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),	
				'default' => 'no',
				'condition'    => [
					'select_option' => [ 'image' ],
				],
			]
		);
		$repeater->add_control(
			'desktop_opt',[
				'label'   => esc_html__( 'Desktop', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image' ],
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'tablet_opt',[
				'label'   => esc_html__( 'Tablet', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image' ],
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'mobile_opt',[
				'label'   => esc_html__( 'Mobile', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'select_option' => [ 'image' ],
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		
		$this->add_control(
            'image_cascading',
            [
				'label' => __( 'Add Multiple Cascading Sections', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
				'description' => 'Add Cascading Sections with Positions.',
                'default' => [
                    [
                        'select_option' => 'image',                       
                    ],
                ],                
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{select_option}}}',
            ]
        );
		
		$this->end_controls_section();
		$this->start_controls_section(
			'styling_section',
			[
				'label' => __( 'Styling', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	
		$this->add_responsive_control(
			'min_height',
			[
				'label' => __( 'Minimum Height', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 400,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_animated_image.cascading-block' => 'min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slide_show',
			[
				'label'   => esc_html__( 'Slide Show', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
            'slide_change_opt', [
				'type' => Controls_Manager::SELECT,
				'label' => __('SlideShow Type', 'theplus'),
				'default' => 'onclick',
				'options' => [
                    'onclick' => __('On Click', 'theplus'),
                    'setinterval' => __('Autoplay', 'theplus'),
                ],
				'condition' => [
					'slide_show' => [ 'yes' ],
				],		
			]
        );
		$this->add_control(
            'interval_time',
            [
                'type' => Controls_Manager::TEXT,
				'label' => __('Autoplay Duration', 'theplus'),
				'default' => 4000,
				'condition' => [
					'slide_show' => [ 'yes' ],
					'slide_change_opt' => [ 'setinterval' ],
				],
            ]
        );
		$this->add_control(
			'section_overflow_desktop',
			[
				'label'   => esc_html__( 'Overflow Hidden (Desktop)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'description' => __('You can setup over flow hidden option if your section is going our and having unwanted scrollbar.','theplus'),
			]
		);
		$this->add_control(
			'section_overflow_tablet',
			[
				'label'   => esc_html__( 'Overflow Hidden (Tablet)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'section_overflow_mobile',
			[
				'label'   => esc_html__( 'Overflow Hidden (Mobile)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->end_controls_section();
	}
	 protected function render() {
		$overflow_attr='';
		$settings = $this->get_settings_for_display();	
		$uid_cascading=uniqid("cascading_");
		$uid=uniqid("slide"); $attr=$wrapperClass='';
		
		$overflow_attr .=(!empty($settings["section_overflow_desktop"]) && $settings["section_overflow_desktop"]=='yes') ? ' data-overflow-desktop="yes"' : '';
		$overflow_attr .=(!empty($settings["section_overflow_tablet"]) && $settings["section_overflow_tablet"]=='yes') ? ' data-overflow-tablet="yes"' : '';
		$overflow_attr .=(!empty($settings["section_overflow_mobile"]) && $settings["section_overflow_mobile"]=='yes') ? ' data-overflow-mobile="yes"' : '';
			if(!empty($settings["slide_show"]) && $settings["slide_show"]=='yes'){
				$wrapperClass .=' slide_show_image '.esc_attr($uid);
				$attr .=' data-play="'.esc_attr($settings["slide_change_opt"]).'"';
				$attr .=' data-uid="'.esc_attr($uid).'"';
				$attr .=' data-interval_time="'.esc_attr($settings["interval_time"]).'"';						
			}
				/*--------------cascading image ----------------------------*/
				$cascading_loop=$css_loop=$hover_tilt='';
				$ij=0;
				if(!empty($settings['image_cascading'])) {
						$position='';
						$effects='';
						$animate_speed='';
						$cascading_move_parallax=$move_parallax_attr=$parallax_move='';
						
					foreach($settings['image_cascading'] as $item) {
						
						$visiblity_hide='';
						if(!empty($item['responsive_visible_opt']) && $item['responsive_visible_opt']=='yes'){
							$visiblity_hide .= (($item['desktop_opt']!='yes' && $item['desktop_opt']=='') ? 'hide-desktop ' : '' );							
							$visiblity_hide .= (($item['tablet_opt']!='yes' && $item['tablet_opt']=='') ? 'hide-tablet ' : '' );
							$visiblity_hide .= (($item['mobile_opt']!='yes' && $item['mobile_opt']=='') ? 'hide-mobile ' : '' );
						}
						
						$mask_image='';
						if(!empty($item["mask_image_display"]) && $item["mask_image_display"]=='yes'){
							$mask_image=' creative-mask-media';
						}						
						$image_effect='';
						if(!empty($item['image_effect'])){
							$image_effect=$item['image_effect'];
						}
						$magic_class = $magic_attr = $parallax_scroll = '';
						if (!empty($item['loop_magic_scroll']) && $item['loop_magic_scroll'] == 'yes') {
							
							if($item["loop_scroll_option_popover_toggle"]==''){
								$scroll_offset=0;
								$scroll_duration=300;
							}else{
								$scroll_offset=$item['loop_scroll_option_scroll_offset'];
								$scroll_duration=$item['loop_scroll_option_scroll_duration'];
							}
							if($item["loop_scroll_from_popover_toggle"]==''){
								$scroll_x_from=0;
								$scroll_y_from=0;
								$scroll_opacity_from=1;
								$scroll_scale_from=1;
								$scroll_rotate_from=0;
							}else{
								$scroll_x_from=$item['loop_scroll_from_scroll_x_from'];
								$scroll_y_from=$item['loop_scroll_from_scroll_y_from'];
								$scroll_opacity_from=$item['loop_scroll_from_scroll_opacity_from'];
								$scroll_scale_from=$item['loop_scroll_from_scroll_scale_from'];
								$scroll_rotate_from=$item['loop_scroll_from_scroll_rotate_from'];
							}
							if($item["loop_scroll_to_popover_toggle"]==''){
								$scroll_x_to=0;
								$scroll_y_to=-50;
								$scroll_opacity_to=1;
								$scroll_scale_to=1;
								$scroll_rotate_to=0;
							}else{
								$scroll_x_to=$item['loop_scroll_to_scroll_x_to'];
								$scroll_y_to=$item['loop_scroll_to_scroll_y_to'];
								$scroll_opacity_to=$item['loop_scroll_to_scroll_opacity_to'];
								$scroll_scale_to=$item['loop_scroll_to_scroll_scale_to'];
								$scroll_rotate_to=$item['loop_scroll_to_scroll_rotate_to'];
							}
							$magic_attr .= ' data-scroll_type="position" ';
							$magic_attr .= ' data-scroll_offset="' . esc_attr($scroll_offset) . '" ';
							$magic_attr .= ' data-scroll_duration="' . esc_attr($scroll_duration) . '" ';
							
							$magic_attr .= ' data-scroll_x_from="' . esc_attr($scroll_x_from) . '" ';
							$magic_attr .= ' data-scroll_x_to="' . esc_attr($scroll_x_to) . '" ';
							$magic_attr .= ' data-scroll_y_from="' . esc_attr($scroll_y_from) . '" ';
							$magic_attr .= ' data-scroll_y_to="' . esc_attr($scroll_y_to) . '" ';
							$magic_attr .= ' data-scroll_opacity_from="' . esc_attr($scroll_opacity_from) . '" ';
							$magic_attr .= ' data-scroll_opacity_to="' . esc_attr($scroll_opacity_to) . '" ';
							$magic_attr .= ' data-scroll_scale_from="' . esc_attr($scroll_scale_from) . '" ';
							$magic_attr .= ' data-scroll_scale_to="' . esc_attr($scroll_scale_to) . '" ';
							$magic_attr .= ' data-scroll_rotate_from="' . esc_attr($scroll_rotate_from) . '" ';
							$magic_attr .= ' data-scroll_rotate_to="' . esc_attr($scroll_rotate_to) . '" ';
							
							$parallax_scroll .= ' parallax-scroll ';							
							$magic_class .= ' magic-scroll ';
						}
						$_tooltip = '_tooltip' . $ij;
						if( $item['plus_tooltip'] == 'yes' ) {
							
							$this->add_render_attribute( $_tooltip, 'data-tippy', '', true );

							if (!empty($item['plus_tooltip_content_type']) && $item['plus_tooltip_content_type']=='normal_desc') {
								$this->add_render_attribute( $_tooltip, 'title', $item['plus_tooltip_content_desc'], true );
							}else if (!empty($item['plus_tooltip_content_type']) && $item['plus_tooltip_content_type']=='content_wysiwyg') {
								$tooltip_content=$item['plus_tooltip_content_wysiwyg'];
								$this->add_render_attribute( $_tooltip, 'title', $tooltip_content, true );
							}
							
							$plus_tooltip_position=($item["tooltip_opt_plus_tooltip_position"]!='') ? $item["tooltip_opt_plus_tooltip_position"] : 'top';
							$this->add_render_attribute( $_tooltip, 'data-tippy-placement', $plus_tooltip_position, true );
							
							$tooltip_interactive =($item["tooltip_opt_plus_tooltip_interactive"]=='' || $item["tooltip_opt_plus_tooltip_interactive"]=='yes') ? 'true' : 'false';
							$this->add_render_attribute( $_tooltip, 'data-tippy-interactive', $tooltip_interactive, true );
							
							$plus_tooltip_theme=($item["tooltip_opt_plus_tooltip_theme"]!='') ? $item["tooltip_opt_plus_tooltip_theme"] : 'dark';
							$this->add_render_attribute( $_tooltip, 'data-tippy-theme', $plus_tooltip_theme, true );
							
							
							$tooltip_arrow =($item["tooltip_opt_plus_tooltip_arrow"]!='none' || $item["tooltip_opt_plus_tooltip_arrow"]=='') ? 'true' : 'false';
							$this->add_render_attribute( $_tooltip, 'data-tippy-arrow', $tooltip_arrow , true );
							
							$plus_tooltip_arrow=($item["tooltip_opt_plus_tooltip_arrow"]!='') ? $item["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
							$this->add_render_attribute( $_tooltip, 'data-tippy-arrowtype', $plus_tooltip_arrow, true );
							
							$plus_tooltip_animation=($item["tooltip_opt_plus_tooltip_animation"]!='') ? $item["tooltip_opt_plus_tooltip_animation"] : 'shift-toward';
							$this->add_render_attribute( $_tooltip, 'data-tippy-animation', $plus_tooltip_animation, true );
							
							$plus_tooltip_x_offset=($item["tooltip_opt_plus_tooltip_x_offset"]!='') ? $item["tooltip_opt_plus_tooltip_x_offset"] : 0;
							$plus_tooltip_y_offset=($item["tooltip_opt_plus_tooltip_y_offset"]!='') ? $item["tooltip_opt_plus_tooltip_y_offset"] : 0;
							$this->add_render_attribute( $_tooltip, 'data-tippy-offset', $plus_tooltip_x_offset .','. $plus_tooltip_y_offset, true );
							
							$tooltip_duration_in =($item["tooltip_opt_plus_tooltip_duration_in"]!='') ? $item["tooltip_opt_plus_tooltip_duration_in"] : 250;
							$tooltip_duration_out =($item["tooltip_opt_plus_tooltip_duration_out"]!='') ? $item["tooltip_opt_plus_tooltip_duration_out"] : 200;
							$tooltip_trigger =($item["tooltip_opt_plus_tooltip_triggger"]!='') ? $item["tooltip_opt_plus_tooltip_triggger"] : 'mouseenter';
							$tooltip_arrowtype =($item["tooltip_opt_plus_tooltip_arrow"]!='') ? $item["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
						}
						$rand_no=rand(1000000, 1500000);
						
						if(!empty($item['hover_parallax']) && $item['hover_parallax']=='yes'){
							$css_loop .='.parallax-hover-'.esc_js($rand_no).'{-webkit-transform:translateZ('.esc_js($item["parallax_translatez"]["size"].$item["parallax_translatez"]["unit"]).') !important;-ms-transform:translateZ('.esc_js($item["parallax_translatez"]["size"].$item["parallax_translatez"]["unit"]).') !important;-moz-transform:translateZ('.esc_js($item["parallax_translatez"]["size"].$item["parallax_translatez"]["unit"]).') !important;-o-transform:translateZ('.esc_js($item["parallax_translatez"]["size"].$item["parallax_translatez"]["unit"]).') !important; transform: translateZ('.esc_js($item["parallax_translatez"]["size"].$item["parallax_translatez"]["unit"]).') !important;}';		
						}
						
						$move_parallax_attr=$parallax_move='';
						if(!empty($item['cascading_move_parallax']) && $item['cascading_move_parallax']=='yes' ){
							$cascading_move_parallax='pt-plus-move-parallax';
							$parallax_move='parallax-move';
							if(!empty($item['cascading_move_speed_x']['size'])){
								$move_parallax_attr .= ' data-move_speed_x="' . esc_attr($item['cascading_move_speed_x']['size']) . '" ';
							}else{
								$move_parallax_attr .= ' data-move_speed_x="0" ';
							}
							if(!empty($item['cascading_move_speed_y']['size'])){
								$move_parallax_attr .= ' data-move_speed_y="' . esc_attr($item['cascading_move_speed_y']['size']) . '" ';
							}else{
								$move_parallax_attr .= ' data-move_speed_y="0" ';
							}
						}
						$reveal_effects=$effect_attr='';
							if(!empty($item['special_effect']) && $item['special_effect']=='yes'){
								$effect_rand_no =uniqid('reveal');
								$effect_attr .=' data-reveal-id="'.esc_attr($effect_rand_no).'" ';
								if(!empty($item['effect_color_1'])){
									$effect_attr .=' data-effect-color-1="'.esc_attr($item['effect_color_1']).'" ';
								}else{
									$effect_attr .=' data-effect-color-1="#313131" ';
								}
								if(!empty($item['effect_color_2'])){
									$effect_attr .=' data-effect-color-2="'.esc_attr($item['effect_color_2']).'" ';
								}else{
									$effect_attr .=' data-effect-color-2="#ff214f" ';
								}
								$reveal_effects=' pt-plus-reveal '.esc_attr($effect_rand_no).' ';
							}
						$target=$nofollow=$urllink='';
						$uimg_id=uniqid("img").esc_attr($ij);
						$uid_loop=uniqid("cascading");
						if($item['select_option']=='image'){
							if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
								$link_class="link-content";
							}else{
								$link_class='not-link-content';	
							}
							if(!empty($item['multiple_image']['id'])){
								$multiple_image=$item['multiple_image']['id'];
								$img = wp_get_attachment_image_src($multiple_image,$item['image_size']);
								$imgSrc = $img[0];
								$content_image ='<img class="parallax_image " src="'.esc_url($imgSrc).'" alt="pt-plus-row-image-1">';						
								
								$cascading_loop .= '<div id="'.esc_attr($uid_loop).esc_attr($ij).'" class="cascading-image elementor-repeater-item-' . $item['_id'] . ' '.esc_attr($uimg_id).' '.esc_attr($visiblity_hide).' ' . esc_attr($magic_class) . ' '.esc_attr($parallax_move).'" '.$this->get_render_attribute_string( $_tooltip ).' '.$move_parallax_attr.'>';
									$cascading_loop .= '<div class="cascading-image-inner ' . esc_attr($parallax_scroll) . '" ' . $magic_attr . '>';
										$cascading_loop .= '<div class="cascading-inner-content parallax-hover-'.esc_attr($rand_no).' '.$image_effect.' '.esc_attr($reveal_effects).' '.esc_attr($link_class).' '.esc_attr($mask_image).'" '.$effect_attr.'>';
											if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
												$data_popup='';
												if($item['link_option']=='popup_link'){
													$data_popup='data-lity=""';
												}
												if($item['popup_content']['url']!='' && $item['link_option']=='popup_link'){
													$target = $item['popup_content']['is_external'] ? '' : '';
													$nofollow = $item['popup_content']['nofollow'] ? ' rel="nofollow"' : '';
													$urllink = $item['popup_content']['url'];
												}
												
												if($item['image_link']['url']!='' && $item['link_option']=='normal_link'){
													$target = $item['image_link']['is_external'] ? ' target="_blank"' : '';
													$nofollow = $item['image_link']['nofollow'] ? ' rel="nofollow"' : '';
													$urllink = $item['image_link']['url'];
												}
												$cascading_loop .= '<a href="'.esc_url($urllink).'" '.$target.$nofollow.' '.$data_popup.'>';
											}
												$cascading_loop .=$content_image;
											if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
												$cascading_loop .= '</a>';
											}
										$cascading_loop .='</div>';
									$cascading_loop .='</div>';
								$cascading_loop .='</div>';
								
							}
							
								
						}
						if($item['select_option']=='text'){
							if(!empty($item['text_content'])){
								$text_content=$item['text_content'];
								if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
									$link_class="link-content";
								}else{
									$link_class='not-link-content';	
								}
								$cascading_loop .= '<div id="'.esc_attr($uid_loop).esc_attr($ij).'" class="cascading-text elementor-repeater-item-' . $item['_id'] . ' '.esc_attr($uimg_id).' '.esc_attr($visiblity_hide).' ' . esc_attr($magic_class) . ' '.esc_attr($parallax_move).'" '.$this->get_render_attribute_string( $_tooltip ).' '.$move_parallax_attr.'>';
									$cascading_loop .= '<div class="cascading-image-inner ' . esc_attr($parallax_scroll) . '" ' . $magic_attr . '>';
										$cascading_loop .= '<div class="cascading-inner-content parallax-hover-'.esc_attr($rand_no).' '.$image_effect.' '.esc_attr($reveal_effects).' '.esc_attr($link_class).' '.esc_attr($mask_image).'" '.$effect_attr.'>';
											if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
												$data_popup='';
												if($item['link_option']=='popup_link'){
													$data_popup='data-lity=""';
												}
												if($item['popup_content']['url']!='' && $item['link_option']=='popup_link'){
													$target = $item['popup_content']['is_external'] ? '' : '';
													$nofollow = $item['popup_content']['nofollow'] ? ' rel="nofollow"' : '';
													$urllink = $item['popup_content']['url'];
												}
												
												if($item['image_link']['url']!='' && $item['link_option']=='normal_link'){
													$target = $item['image_link']['is_external'] ? ' target="_blank"' : '';
													$nofollow = $item['image_link']['nofollow'] ? ' rel="nofollow"' : '';
													$urllink = $item['image_link']['url'];
												}
												$cascading_loop .= '<a href="'.esc_url($urllink).'" '.$target.$nofollow.' '.$data_popup.'>';
											}
												$cascading_loop .=$text_content;
											if($item['link_option']=='normal_link' || $item['link_option']=='popup_link'){
												$cascading_loop .= '</a>';
											}
										$cascading_loop .='</div>';
									$cascading_loop .='</div>';
								$cascading_loop .='</div>';
							}							
						}
							
							if($item['plus_tooltip'] == 'yes'){
								$cascading_loop .='<script>
								jQuery( document ).ready(function() {
									tippy( "#'.esc_attr($uid_loop).esc_attr($ij).'" , {
										arrowType : "'.$tooltip_arrowtype.'",
										duration : ['.esc_attr($tooltip_duration_in).','.esc_attr($tooltip_duration_out).'],
										trigger : "'.esc_attr($tooltip_trigger).'",
										appendTo: document.querySelector("#'.esc_attr($uid_loop).esc_attr($ij).'")
									});
								});
								</script>';
							}
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
								$d_max_width='';
								if($item['d_pos_width']['size']){
									$width=$item['d_pos_width']['size'].$item['d_pos_width']['unit'];
									$d_max_width='max-width:'.esc_attr( $width ).';';
								}
								if($item['select_option']=='image'){
									$css_loop.='.cascading-image.'.esc_attr($uimg_id).'{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';'.$d_max_width.'margin: 0 auto;}';
								}
								if($item['select_option']=='text'){
									$css_loop.='.cascading-text.'.esc_attr($uimg_id).'{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';'.$d_max_width.'margin: 0 auto;}';
								}
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
								$t_max_width='';
								if($item['t_pos_width']['size']){
									$width=$item['t_pos_width']['size'].$item['t_pos_width']['unit'];
									$t_max_width='max-width:'.esc_attr( $width ).';';
								}
								if($item['select_option']=='image'){
									$css_loop.='@media (min-width:601px) and (max-width:990px){.cascading-image.'.esc_attr($uimg_id).'{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';'.$t_max_width.'margin: 0 auto;}}';
								}
								if($item['select_option']=='text'){
									$css_loop.='@media (min-width:601px) and (max-width:990px){.cascading-text.'.esc_attr($uimg_id).'{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';'.$t_max_width.'margin: 0 auto;}}';
								}
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
								$m_max_width='';
								if($item['m_pos_width']['size']){
									$width=$item['m_pos_width']['size'].$item['m_pos_width']['unit'];
									$m_max_width='max-width:'.esc_attr( $width ).';';
								}
								if($item['select_option']=='image'){
									$css_loop.='@media (max-width:600px){.cascading-image.'.esc_attr($uimg_id).'{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr(	$mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';'.$m_max_width.'margin: 0 auto;}}';
								}
								if($item['select_option']=='text'){
									$css_loop.='@media (max-width:600px){.cascading-text.'.esc_attr($uimg_id).'{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr(	$mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';'.$m_max_width.'margin: 0 auto;}}';
								}
							}
							
						if(!empty($item['hover_parallax']) && $item['hover_parallax']=='yes'){
							$hover_tilt='hover-tilt';
						}
						$ij++;
					}
				}
			/*--------------cascading image ----------------------------*/
			
			
			$output = '<div class="pt_plus_animated_image cascading-block  wpb_single_image '.esc_attr($uid_cascading).' ' . $wrapperClass . ' '.esc_attr($cascading_move_parallax).' '.esc_attr($hover_tilt).'" '.$attr.' '.$overflow_attr.'>';
			$output .= '<div class="cascading-inner-loop ">';
				$output .=$cascading_loop;
				$output .='</div>';
			$output .='</div>';
			$css_loop='<style>'.$css_loop.'</style>';
		echo $output.$css_loop;
	}
    protected function content_template() {
	
    }

}
