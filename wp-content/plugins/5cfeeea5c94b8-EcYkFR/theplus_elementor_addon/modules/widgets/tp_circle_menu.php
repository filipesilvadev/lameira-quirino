<?php 
/*
Widget Name: Circle Menu
Description: Circle Menu
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


class ThePlus_Circle_Menu extends Widget_Base {
		
	public function get_name() {
		return 'tp-circle-menu';
	}

    public function get_title() {
        return __('Circle Menu', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-file-text theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts','circle-menu'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Circle Menu', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_layout_open',
			[
				'label' => __( 'Icon Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'circle',
				'options' => [
					'circle' => __( 'Circle', 'theplus' ),
					'straight'  => __( 'Straight', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'icon_layout_straight_style',
			[
				'label' => __( 'Menu Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
				],
			]
		);
		
		$this->add_control(
			'icon_direction',
			[
				'label' => __( 'Icon Direction', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom-right',
				'options' => [
					'top'  => __( 'Top', 'theplus' ),					
					'right'  => __( 'Right', 'theplus' ),					
					'bottom'  => __( 'Bottom', 'theplus' ),					
					'left'  => __( 'Left', 'theplus' ),					
					'top-right'  => __( 'Top Right', 'theplus' ),					
					'top-left'  => __( 'Top Left', 'theplus' ),					
					'bottom-right'  => __( 'Bottom Right', 'theplus' ),					
					'bottom-left'  => __( 'Bottom Left', 'theplus' ),					
					'top-half'  => __( 'Top Half', 'theplus' ),					
					'right-half'  => __( 'Right Half', 'theplus' ),					
					'bottom-half'  => __( 'Bottom Half', 'theplus' ),					
					'left-half'  => __( 'Left Half', 'theplus' ),					
					'full'  => __( 'Full', 'theplus' ),		
					'none' => __( 'None', 'theplus' ),
				],
				'condition'    => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->add_control(
			'layout_straight_menu_direction',
			[
				'label' => __( 'Menu Direction', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'top'  => __( 'Top', 'theplus' ),					
					'right'  => __( 'Right', 'theplus' ),					
					'bottom'  => __( 'Bottom', 'theplus' ),					
					'left'  => __( 'Left', 'theplus' ),
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'tooltip_menu_title',
			[
				'label' => __( 'Tooltip Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$repeater->add_control(
			'loop_image_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image using this option.','theplus'),
				'default' => 'icon',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),					
				],
			]
		);
		
		$repeater->add_control(
			'loop_select_image',
			[
				'label' => __( 'Use Image As icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [
					'loop_image_icon' => 'image',
				],
			]
		);
		$repeater->add_control(
			'loop_icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'loop_image_icon' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'loop_icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bank',
				'condition' => [
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'font_awesome',
				],	
			]
		);
		$repeater->add_control(
			'loop_icons_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'options' => theplus_icons_mind(),
				'condition' => [
					'loop_image_icon' => 'icon',
					'loop_icon_style' => 'icon_mind',
				],
			]
		);
		$repeater->add_control(
			'icons_url',
			[
				'label' => __( 'Url', 'theplus' ),
				'type' => Controls_Manager::URL,				
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$repeater->start_controls_tabs( 'tabs_title_style' );
		$repeater->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$repeater->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => __( 'Background', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'render_type' => 'ui',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title',
			]
		);
		$repeater->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}} .menu-tooltip-title' => 'border-color: {{VALUE}}',
				],
			]
		);
		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$repeater->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title' => 'color: {{VALUE}}',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_hover_background',
				'label' => __( 'Background', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'render_type' => 'ui',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon:hover,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title',
			]
		);
		$repeater->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu.menu-style-2 .plus-circle-menu-list{{CURRENT_ITEM}}:hover .menu-tooltip-title' => 'border-color: {{VALUE}}',
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'tooltip_default_hover',
			[
				'label' => __( 'Tooltip Visibility', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Default', 'theplus' ),
				'label_off' => __( 'Hover', 'theplus' ),				
				'default' => 'no',
			]
		);
		$repeater->add_control(
            'tooltip_text_rotate',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Tooltip Text Rotate', 'theplus'),
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 360,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'transform: translateY(-50%) rotate({{SIZE}}{{UNIT}})',
				],
            ]
        );
		$repeater->add_control(
            'tooltip_text_top',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Tooltip Text Top', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'top:{{SIZE}}{{UNIT}}',
				],
            ]
        );
		$repeater->add_control(
            'tooltip_text_left',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Tooltip Text Left', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -300,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list{{CURRENT_ITEM}} .menu_icon .menu-tooltip-title' => 'left:{{SIZE}}{{UNIT}}',
				],
            ]
        );
		$repeater->add_control(
			'tooltip_text_arrow',
			[
				'label' => __( 'Arrow Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'arrow-left',
				'options' => [
					'arrow-left'  => __( 'Left', 'theplus' ),
					'arrow-right' => __( 'Right', 'theplus' ),
					'arrow-top' => __( 'Top', 'theplus' ),
					'arrow-bottom' => __( 'Bottom', 'theplus' ),
					'arrow-none' => __( 'None', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'circle_menu_list',
			[
				'label' => __( 'Menu List', 'theplus' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),			
				'default' => [
					[
						'tooltip_menu_title' => __( 'Facebook', 'theplus' ),
						'loop_image_icon' => 'icon',
						'loop_icon_style' => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-facebook',
					],
					[
						'tooltip_menu_title' => __( 'Twitter', 'theplus' ),
						'loop_image_icon' => 'icon',
						'loop_icon_style' => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-twitter',
					],
					[
						'tooltip_menu_title' => __( 'Instagram', 'theplus' ),
						'loop_image_icon' => 'icon',
						'loop_icon_style' => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-instagram',
					],
					[
						'tooltip_menu_title' => __( 'Linkedin', 'theplus' ),
						'loop_image_icon' => 'icon',
						'loop_icon_style' => 'font_awesome',
						'loop_icon_fontawesome' => 'fa fa-linkedin',
					],
				],
				'title_field' => '{{{ loop_image_icon }}}',
			]
		);
		
		$this->end_controls_section();
		/* Circle Menu List*/
		/* Toggle Icon */
		$this->start_controls_section(
			'icon_toggle',
			[
				'label' => __( 'Toggle Icon', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'loop_image_main_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image using this option.','theplus'),
				'default' => 'icon',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),					
				],
			]
		);
		$this->add_control(
            'loop_max_main_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Max Width Svg', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition' => [
					'loop_image_main_icon' => 'svg',
					'loop_svg_main_icon' => ['img'],
				],
            ]
        );
		$this->add_control(
			'loop_select_main_image',
			[
				'label' => __( 'Use Image As icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [
					'loop_image_main_icon' => 'image',
				],
			]
		);
		$this->add_control(
			'loop_icon_main_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'loop_image_main_icon' => 'icon',
				],
			]
		);
		$this->add_control(
			'loop_icon_main_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-home',
				'condition' => [
					'loop_image_main_icon' => 'icon',
					'loop_icon_main_style' => 'font_awesome',
				],	
			]
		);
		$this->add_control(
			'loop_icons_main_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'options' => theplus_icons_mind(),
				'condition' => [
					'loop_image_main_icon' => 'icon',
					'loop_icon_main_style' => 'icon_mind',
				],
			]
		);
		
		$this->add_control(
			'toggle_open_icon_style',
			[
				'label' => __( 'Menu Open Icon Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,				
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
					'style-3' => __( 'style 3', 'theplus' ),					
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/* Toggle Icon */
		
		/* Icon Position*/
		$this->start_controls_section(
			'icon_position_section',
			[
				'label' => __( 'Icon Position', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'main_icon_position',
			[
				'label' => __( 'Position', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'absolute',
				'options' => [
					'absolute'  => __( 'Absolute', 'theplus' ),					
					'fixed'  => __( 'Fixed', 'theplus' ),
				],
			]
		);		
		$this->start_controls_tabs( 'circle_icon_position' );
		/*desktop  start*/
		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Desktop', 'theplus' ),
			]
		);		
		$this->add_control(
			'd_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),				
			]
		);

		$this->add_control(
			'd_pos_xposition', [
				'label' => __( 'Left', 'theplus' ),
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
			]
		);
		$this->add_control(
			'd_pos_rightposition',[
				'label' => __( 'Right', 'theplus' ),
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
			]
		);
		$this->add_control(
			'd_pos_yposition', [
				'label' => __( 'Top', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
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
			]
		);
		$this->add_control(
			'd_pos_bottomposition', [
				'label' => __( 'Bottom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
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
				],
				'separator' => 'after',
				'condition'    => [
					'd_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$this->end_controls_tab();
		/*desktop end*/
		/*tablet start*/
		$this->start_controls_tab( 'tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
			]
		);
		$this->add_control(
			't_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
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
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
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
		
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->end_controls_tab();
		/*tablet end*/
		/*mobile start*/
		$this->start_controls_tab( 'mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
			]
		);
		$this->add_control(
			'm_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
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
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->add_control(
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
		$this->end_controls_tab();
		/*mobile end*/
		$this->end_controls_tabs();
		$this->end_controls_section();
		/* Icon Position*/
		
		/* Extra Options*/
		$this->start_controls_section(
			'extra_option_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'angle_start',
			[
				'label' => __( 'Angle Start', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 360,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'icon_direction' => [ 'none' ],
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'angle_end',
			[
				'label' => __( 'Angle End', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 360,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 90,
				],
				'condition'    => [
					'icon_direction' => [ 'none' ],
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_responsive_control(
			'circle_radius',
			[
				'label' => __( 'Circle Radius', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 360,
						'step' => 5,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		
		$this->add_control(
			'icon_delay',
			[
				'label' => __( 'Icon Delay', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 7000,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1000,
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->add_control(
			'icon_speed',
			[
				'label' => __( 'Menu Open Speed', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'icon_step_in',
			[
				'label' => __( 'Icon Step In', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => -20,
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'icon_step_out',
			[
				'label' => __( 'Icon Step Out', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -500,
						'max' => 500,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'layout_straight_menu_gap', [
				'label' => __( 'Menu Between Gap', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
				],
			]
		);
		$this->add_control(
			'layout_straight_menu_transition_duration',
			[
				'label' => __( 'Menu Open Speed', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'ms' ],
				'range' => [
					'ms' => [
						'min' => 0,
						'max' => 10000,
						'step' => 50,
					],
				],
				'default' => [
					'unit' => 'ms',
					'size' => 1000,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'transition-duration:{{SIZE}}{{UNIT}}',
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
				],
			]
		);
		$this->add_control(
			'icon_transition',
			[
				'label' => __( 'Icon Transition', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease'  => __( 'Ease', 'theplus' ),					
					'linear'  => __( 'Linear', 'theplus' ),											
					'ease-in'  => __( 'Ease In', 'theplus' ),											
					'ease-out'  => __( 'Ease Out', 'theplus' ),											
					'ease-in-out'  => __( 'Ease In Out', 'theplus' ),											
					'cubic-bezier(n,n,n,n)'  => __( 'Cubic Bezier', 'theplus' ),
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper.layout-straight .plus-circle-menu .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'transition-timing-function:{{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_trigger',
			[
				'label' => __( 'Icon Trigger', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [
					'hover'  => __( 'Hover', 'theplus' ),					
					'click'  => __( 'Click', 'theplus' ),											
				],
				'condition'    => [					
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->end_controls_section();
		/* extra options*/
		/*Style tag*/
		
		/* Icon Style*/
		$this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Icon Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
            ]
        );
		$this->add_responsive_control(
			'repeater_icon_size',
			[
				'label' => __( 'Icon Size', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->add_responsive_control(
			'repeater_circle_width',
			[
				'label' => __( 'Icon Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:not(.plus-circle-main-menu-list)' => 'width: calc({{SIZE}}{{UNIT}} - 5px ) !important;height: calc({{SIZE}}{{UNIT}} - 5px) !important;line-height: calc({{SIZE}}{{UNIT}} - 5px) !important;',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);

		$this->add_responsive_control(
			'repeater_icon_image_width',
			[
				'label' => __( 'Image Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 90,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon img' => 'width: {{SIZE}}{{UNIT}};, height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'repeater_icon_border',
			[
				'label' => __( 'Icon Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_control(
			'icon_border_radius_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'condition' => [
					'repeater_icon_border' => 'yes',					
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		
		$this->add_responsive_control(
			'repeater_icon_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],				
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
					'repeater_icon_border' => 'yes',					
				],
			]
		);
		
		$this->start_controls_tabs( 'tabs_icon_border_style' );
		$this->start_controls_tab(
			'tab_icon_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
					'repeater_icon_border' => 'yes',					
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,				
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
					'repeater_icon_border' => 'yes',					
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu_icon',
				'condition' => [
					'icon_layout_open' => [ 'circle' ],				
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
					'repeater_icon_border' => 'yes',					
				],
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Border Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'circle' ],
					'repeater_icon_border' => 'yes',					
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu_icon',
				'condition'    => [
					'icon_layout_open' => [ 'circle' ],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Icon Style*/
		$this->start_controls_section(
            'section_toggle_styling',
            [
                'label' => __('Toggle Icon Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'toggle_size',
			[
				'label' => __( 'Icon Size', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'toggle_icon_width',
			[
				'label' => __( 'Toggle Icon Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 40,
				],
				
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'toggle_image_width',
			[
				'label' => __( 'Image Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'circle_menu_border_option', [
				'label'   => esc_html__( 'Circle Menu Border', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
			]
		);
		$this->add_control(
			'toggle_icon_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'condition' => [
					'repeater_icon_border' => 'yes',					
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'border-style: {{VALUE}};',
				],
				'condition'    => [
					'circle_menu_border_option' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'toggle_icon_border_width',
			[
				'label' => __( 'Icon Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'circle_menu_border_option' => [ 'yes' ],
				],
			]
		);
		$this->start_controls_tabs( 'toggle_icon_main_style' );
		$this->start_controls_tab(
			'toggle_icon_main_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3 a.main_menu_icon .close-toggle-icon,{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3 a.main_menu_icon .close-toggle-icon:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => __( 'Background', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon',
			]
		);
		
		$this->add_control(
			'toggle_icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list a.main_menu_icon' => 'border-color: {{VALUE}}',
				],
				'condition'    => [
					'circle_menu_border_option' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'toggle_icon_border_radius_normal',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'toggle_icon_box_shadow_normal',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .main_menu_icon',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'toggle_icon_main_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3:hover a.main_menu_icon .close-toggle-icon,{{WRAPPER}} .plus-circle-menu-wrapper .plus-circle-main-menu-list.style-3:hover a.main_menu_icon .close-toggle-icon:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_hover_background',
				'label' => __( 'Background', 'theplus' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon',
			]
		);
		$this->add_control(
			'icon_hover_border',
			[
				'label' => __( 'Icon Hover Border', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon' => 'border-color: {{VALUE}}',
				],
				'condition'    => [
					'circle_menu_border_option' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'toggle_icon_border_radius_hover',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon img,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'toggle_icon_box_shadow_hover',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .main_menu_icon,{{WRAPPER}} .plus-circle-menu-inner-wrapper .circleMenu-open .plus-circle-menu-list a.main_menu_icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Toggle Icon Style*/
		$this->start_controls_section(
			'icon_tooltip_text_style',
			[
				'label' => __( 'Tooltip Text', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tooltip_text_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title',
			]
		);
		$this->add_control(
			'straight_text_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'straight_text_border_option', [
				'label'   => esc_html__( 'Circle Menu Border', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'straight_text_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'condition' => [
					'repeater_icon_border' => 'yes',					
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-style: {{VALUE}};',
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
					'straight_text_border_option' => [ 'yes' ],
				],
			]
		);
		$this->add_responsive_control(
			'straight_text_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
					'straight_text_border_option' => [ 'yes' ],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_straight_text_style' );
		$this->start_controls_tab(
			'tab_straight_text_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'tooltip_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'straight_text_border',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list .menu-tooltip-title' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'tooltip_text_normal_bgcolor',
			[
				'label' => __( 'Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-bottom .menu-tooltip-title:before' => 'border-top-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-top .menu-tooltip-title:before' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-left .menu-tooltip-title:before' => 'border-right-color: {{VALUE}}',
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list.arrow-right .menu-tooltip-title:before' => 'border-left-color: {{VALUE}}',
				],				
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'tooltip_text_shadow',
				'selector' => '{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list .menu-tooltip-title',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'straight_text_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'straight_text_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list:hover .menu-tooltip-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'straight_text_hover_border',
			[
				'label' => __( 'Hover Border', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_responsive_control(
			'straight_text_border_radius_hover',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'straight_text_hover_bgcolor',
			[
				'label' => __( 'Background Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .plus-circle-menu-wrapper li.plus-circle-menu-list:hover .menu-tooltip-title' => 'background-color: {{VALUE}}',					
				],
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'straight_text_shadow_hover',
				'selector' => '{{WRAPPER}} .plus-circle-menu-inner-wrapper .plus-circle-menu-list:hover .menu-tooltip-title',
				'condition' => [
					'icon_layout_open' => [ 'straight' ],
					'icon_layout_straight_style' => 'style-2',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tooltip_display_desktop',
			[
				'label' => __( 'Visibility Desktop', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'theplus' ),
				'label_off' => __( 'Show', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'tooltip_display_tablet',
			[
				'label' => __( 'Visibility Tablet', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'theplus' ),
				'label_off' => __( 'Show', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'tooltip_display_mobile',
			[
				'label' => __( 'Visibility Mobile', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'theplus' ),
				'label_off' => __( 'Show', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->end_controls_section();
		/*Tooltip Text*/
		/*Extra Option Style*/
		$this->start_controls_section(
			'extra_option_style_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
					'show_scroll_window_offset' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Extra Option Style*/
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

		$icon_direction = $settings['icon_direction'];
		$icon_layout_open = $settings['icon_layout_open'];
		$show_scroll_window_offset = ($settings['show_scroll_window_offset']=='yes') ? 'scroll-view' : '';
		$scroll_top_offset_value = ($settings['show_scroll_window_offset']=='yes') ? 'data-scroll-view="'.$settings['scroll_top_offset_value']["size"].'"' : '';
		$icon_layout_straight_style = ($settings['icon_layout_open']=='straight') ? 'menu-'.esc_attr($settings['icon_layout_straight_style']) : '';
		$layout_straight_menu_direction = ($settings['icon_layout_open']=='straight') ? 'menu-direction-'.esc_attr($settings['layout_straight_menu_direction']) : '';
		
		$tooltip_display_desktop = ($settings["tooltip_display_desktop"]=='yes') ? 'tooltip_desktop_hide' : '';
		$tooltip_display_tablet = ($settings["tooltip_display_tablet"]=='yes') ? 'tooltip_tablet_hide' : '';
		$tooltip_display_mobile = ($settings["tooltip_display_mobile"]=='yes') ? 'tooltip_mobile_hide' : '';
		
		if($icon_layout_open=='circle'){
			$circle_radius = ($settings['circle_radius']['size']!='') ? $settings['circle_radius']['size'] : '150';
			$circle_radius_tablet = ($settings['circle_radius_tablet']['size']!='') ? $settings['circle_radius_tablet']['size'] : $settings['circle_radius']['size'];
			$circle_radius_mobile = ($settings['circle_radius_mobile']['size']!='') ? $settings['circle_radius_mobile']['size'] : $settings['circle_radius']['size'];
			
			$icon_delay = $settings['icon_delay']['size'];
			$icon_speed = $settings['icon_speed']['size'];
			$icon_step_in = $settings['icon_step_in']['size'];
			$icon_step_out = $settings['icon_step_out']['size'];
		}
		$icon_transition = $settings['icon_transition'];
		$icon_trigger = $settings['icon_trigger'];
		$loop_image_main_icon = $settings['loop_image_main_icon'];
		$loop_icon_main_style = $settings['loop_icon_main_style'];
		$loop_icon_main_fontawesome = $settings['loop_icon_main_fontawesome'];
		$loop_icons_main_mind = $settings['loop_icons_main_mind'];
		$main_icon_position = $settings['main_icon_position'];
		
		$toggle_open_icon_style = $settings['toggle_open_icon_style'];
		
		if($icon_layout_open=='circle'){
			if($icon_direction =='none'){
				$angle_start = $settings['angle_start']['size'];
				$angle_end = $settings['angle_end']['size'];
			}else{
				$angle_start = 0;
				$angle_end = 0;
			}
		}
		if($main_icon_position == 'absolute'){
			$position_class = 'circle_menu_position_abs';
		}else if($main_icon_position == 'fixed'){
			$position_class = 'circle_menu_position_fix';
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
		
		$main_toggle_click='';
		$uid=uniqid("circle_menu");
		$circle_menu ='<div class="plus-circle-menu-wrapper '.esc_attr($uid).' layout-'.esc_attr($icon_layout_open).' '.esc_attr($show_scroll_window_offset).' '.$animated_class.'" '.$animation_attr.' data-uid='.esc_attr($uid).' '.$scroll_top_offset_value.'>';
		$circle_menu .='<div class="plus-circle-menu-inner-wrapper ">';
			$circle_menu .='<ul class="plus-circle-menu circleMenu-closed '.$position_class.' '.esc_attr($layout_straight_menu_direction).' '.esc_attr($icon_layout_straight_style).' '.esc_attr($tooltip_display_desktop).' '.esc_attr($tooltip_display_tablet).' '.esc_attr($tooltip_display_mobile).'">';
			
				
				$main_toggle_click .= '<li class="plus-circle-main-menu-list plus-circle-menu-list '.esc_attr($toggle_open_icon_style).'">';
					if(!empty($loop_icon_main_style) && $loop_image_main_icon == 'icon' && $loop_icon_main_style=='font_awesome'){
						$icons_main='<i class="fa '.$loop_icon_main_fontawesome.'  toggle-icon-wrap" ></i>';
					}else if(!empty($loop_icon_main_style) && $loop_image_main_icon == 'icon' && $loop_icon_main_style=='icon_mind'){
						$icons_main='<i class="fa '.$loop_icons_main_mind.' toggle-icon-wrap" ></i>';
					}else if(!empty($settings["loop_select_main_image"]["url"]) && $loop_image_main_icon == 'image'){
						$icons_main= '<img src="'.$settings["loop_select_main_image"]["url"].'" class="toggle-icon-wrap" />';
					}else{
						$icons_main='';
					}
					$close_toggle='';
					if($toggle_open_icon_style=='style-3'){
						$close_toggle='<span class="close-toggle-icon"></span>';
					}
					$main_toggle_click .= '<a href="#" class="main_menu_icon">'.$icons_main.$close_toggle.'</a>';
				$main_toggle_click .= '</li>';
				
				$circle_menu .=$main_toggle_click;
				
				$ij=2;
				
					if ( $settings['circle_menu_list'] ) {
						foreach (  $settings['circle_menu_list'] as $item ) {
							$arrow_text=$item['tooltip_text_arrow'];
							$tooltip_default_hover = ($item["tooltip_default_hover"]=='yes') ? 'tooltip-default-show' : '';
							if(!empty($settings['icons_url']['url'])){
								$target = $settings['icons_url']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $settings['icons_url']['nofollow'] ? ' rel="nofollow"' : '';
								$icon_url=$settings['icons_url']['url'];
							}else{
							$target = ' target="_blank"';
								$nofollow = ' rel="nofollow"';
								$icon_url='#';
							}
							$circle_menu .= '<li class="plus-circle-menu-list elementor-repeater-item-' . $item['_id'] . ' '.esc_attr($arrow_text).' '.esc_attr($tooltip_default_hover).'">';
							
							if(!empty($item['loop_image_icon'])){								
									$tooltip_title='';
									if(!empty($item["tooltip_menu_title"])){
										$tooltip_title = '<span class="menu-tooltip-title">'.$item["tooltip_menu_title"].'</span>';
									}
									if(isset($item['loop_image_icon']) && $item['loop_image_icon'] == 'image'){
										
										if(!empty($item["loop_select_image"]["url"])){
											$loop_imgSrc= $item["loop_select_image"]["url"];
										}else{
											$loop_imgSrc='';
										}
										
										if($icon_layout_open=='straight' && $icon_layout_straight_style=='menu-style-2'){
											$circle_menu .='<a href="'.esc_url($icon_url).'" class="menu_icon" '.$target.' '.$nofollow.'>'.$tooltip_title.'</a>';
										}else{
											$circle_menu .='<a href="'.esc_url($icon_url).'" class="menu_icon" '.$target.' '.$nofollow.'><img class="img" src='.esc_url($loop_imgSrc).' />'.$tooltip_title.'</a>';
										}
										
									}else if(isset($item['loop_image_icon']) && $item['loop_image_icon'] == 'icon'){		
										
										if(!empty($item["loop_icon_style"]) && $item["loop_icon_style"]=='font_awesome'){
											$icons=$item["loop_icon_fontawesome"];
										}else if(!empty($item["loop_icon_style"]) && $item["loop_icon_style"]=='icon_mind'){
											$icons='fa '.$item["loop_icons_mind"];
										}else{
											$icons='';
										}
										
										if($icon_layout_open=='straight' && $icon_layout_straight_style=='menu-style-2'){
											$circle_menu .='<a href="'.esc_url($icon_url).'" class="menu_icon" '.$target.' '.$nofollow.'>'.$tooltip_title.'</a>';
										}else{
											$circle_menu .= '<a href="'.esc_url($icon_url).'" class="menu_icon" '.$target.' '.$nofollow.'><i class=" '.esc_attr($icons).' " ></i>'.$tooltip_title.'</a>';
										}
									}
							}

							$circle_menu .= '</li>';
							$ij++;
						}
					}
				
			$circle_menu .='</ul>';
		$circle_menu .='</div>';
		$circle_menu .='</div>';
		if($icon_layout_open=='circle'){
			$circle_menu .='<script>';
				$circle_menu .='jQuery(document).ready(function(i){		
					jQuery(".'.esc_attr($uid).' .plus-circle-menu").circleMenu({			
						direction: "'.$icon_direction.'",
						angle:{start:'.$angle_start.', end:'.$angle_end.'},
						circle_radius: '.$circle_radius.',
						circle_radius_tablet: '.$circle_radius_tablet.',
						circle_radius_mobile: '.$circle_radius_mobile.',
						delay:'.$icon_delay.',			
						item_diameter:0,
						speed: '.$icon_speed.',
						step_in: '.$icon_step_in.',
						step_out: '.$icon_step_out.',
						transition_function: "'.$icon_transition.'",
						trigger: "'.$icon_trigger.'"
					});
				});';
			$circle_menu .='</script>';
		}
		$circle_menu .='<style>';
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
								
								$circle_menu.='.'.esc_attr($uid).' .plus-circle-menu{margin: 0 auto !important;margin-top:'.esc_attr($ypos).' !important;bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';}';
								if(!empty($rpos) && $rpos=='0%' && !empty($xpos) && $xpos=='0%'){
									$circle_menu.='.'.esc_attr($uid).'.layout-circle .plus-circle-menu{left: calc('.$xpos.' - '.intval($settings["toggle_icon_width"]["size"]).$settings["toggle_icon_width"]["unit"].' );}';
								}
								if(!empty($ypos) && $ypos=='auto'){
									$circle_menu.='.'.esc_attr($uid).' .plus-circle-menu{top: auto;}';
								}
							
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
								
								$circle_menu.='@media (min-width:601px) and (max-width:990px){.'.esc_attr($uid).' .plus-circle-menu{margin: 0 auto !important;margin-top:'.esc_attr($tablet_ypos).' !important;bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';}';
								if(!empty($tablet_rpos) && $tablet_rpos=='0%' && !empty($tablet_xpos) && $tablet_xpos=='0%'){
									$circle_menu.='.'.esc_attr($uid).'.layout-circle .plus-circle-menu{left: calc('.$tablet_xpos.' - '.intval($settings["toggle_icon_width"]["size"]).$settings["toggle_icon_width"]["unit"].' );}';
								}
								if(!empty($tablet_ypos) && $tablet_ypos=='auto'){
									$circle_menu.='.'.esc_attr($uid).' .plus-circle-menu{top: auto;}';
								}
								$circle_menu.='}';
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
								$circle_menu.='@media (max-width:600px){.'.esc_attr($uid).' .plus-circle-menu{margin: 0 auto !important; margin-top:'.esc_attr($mobile_ypos).' !important;bottom:'.esc_attr($mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';}';
								if(!empty($mobile_rpos) && $mobile_rpos=='0%' && !empty($mobile_xpos) && $mobile_xpos=='0%'){
									$circle_menu.='.'.esc_attr($uid).'.layout-circle .plus-circle-menu{left: calc('.$mobile_xpos.' - '.intval($settings["toggle_icon_width"]["size"]).$settings["toggle_icon_width"]["unit"].' );}';
								}
								if(!empty($mobile_ypos) && $mobile_ypos=='auto'){
									$circle_menu.='.'.esc_attr($uid).' .plus-circle-menu{top: auto;}';
								}
								$circle_menu.='}';
							}
							if($icon_layout_open=='straight'){
								$value=0;
								$i=2;
								if($ij>1){
									while($i < $ij){
										
										if( $settings['layout_straight_menu_direction'] == 'right'){
											$value = $settings["layout_straight_menu_gap"]["size"] + $value + $settings["toggle_icon_width"]["size"];
											$circle_menu .= '.'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-right .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'), .'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-right .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'){
												left: '.$value.'px;
											}';
										}
										if( $settings['layout_straight_menu_direction'] == 'bottom'){
											$value = $settings["layout_straight_menu_gap"]["size"] + $value;
											$circle_menu .= '.'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-bottom .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'), .'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-bottom .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'){
												top: '.$value.'px;
											}';
										}
										if( $settings['layout_straight_menu_direction'] == 'left'){
											$value = $settings["layout_straight_menu_gap"]["size"] + $value;
											$circle_menu .= '.'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-left .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'), .'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-left .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'){
												right: '.$value.'px;
											}';
										}
										if( $settings['layout_straight_menu_direction'] == 'top'){
											$value = $settings["layout_straight_menu_gap"]["size"] + $value;
											$circle_menu .= '.'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-top .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'), .'.esc_attr($uid).'.plus-circle-menu-wrapper.layout-straight .plus-circle-menu.circleMenu-open.menu-direction-top .plus-circle-menu-list:not(.plus-circle-main-menu-list):nth-child('.$i.'){
												bottom: '.$value.'px;
											}';
										}
									$i++;
									}
								}
							}
							$circle_menu .='</style>';							
		
		echo $circle_menu;

		
	}
	
    protected function content_template() {
		
    }

}
