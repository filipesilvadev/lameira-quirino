<?php 
/*
Widget Name: Pricing Table
Description: unique design of pricing table.
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

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Pricing_Table extends Widget_Base {
		
	public function get_name() {
		return 'tp-pricing-table';
	}

    public function get_title() {
        return __('Pricing Table', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-money theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }
	public function get_style_depends() {
		return [ 'theplus-pricing-table' ];
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
				'label' => __( 'Layout', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'pricing_table_style',
			[
				'label' => __( 'Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
					'style-3'  => __( 'Style 3', 'theplus' ),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'title_content_section',
			[
				'label' => __( 'Title Section', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title_heading',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'pricing_title',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Professional', 'theplus' ),
			]
		);
		$this->add_control(
			'pricing_subtitle',
			[
				'label' => __( 'Sub Title', 'theplus' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'icons_heading',
			[
				'label' => __( 'Icon Options', 'theplus' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image or SVG using this option.','theplus'),
				'default' => '',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
					'svg' => __( 'Svg', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'svg_icon',
			[
				'label' => __( 'Svg Select Option', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'img',
				'options' => [
					'img'  => __( 'Custom Upload', 'theplus' ),
					'svg' => __( 'Pre Built SVG Icon', 'theplus' ),
				],
				'condition' => [
					'image_icon' => 'svg',
				],
			]
		);
		$this->add_control(
			'svg_image',
			[
				'label' => __( 'Only Svg', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'description' => __('Select Only .svg File from media library.','theplus'),
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [
					'image_icon' => 'svg',
					'svg_icon' => 'img',
				],
			]
		);
		$this->add_control(
			'svg_d_icon',
			[
				'label' => __( 'Select Svg Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'app.svg',
				'options' => theplus_svg_icons_list(),
				'condition' => [
					'image_icon' => 'svg',
					'svg_icon' => 'svg',
				],
			]
		);
		
		$this->add_control(
			'select_image',
			[
				'label' => __( 'Use Image As icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [
					'image_icon' => 'image',
				],
			]
		);
		$this->add_control(
			'icon_font_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'image_icon' => 'icon',
				],
			]
		);
		$this->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bank',
				'condition' => [
					'image_icon' => 'icon',
					'icon_font_style' => 'font_awesome',
				],
			]
		);
		$this->add_control(
			'icons_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'options' => theplus_icons_mind(),
				'condition' => [
					'image_icon' => 'icon',
					'icon_font_style' => 'icon_mind',
				],
			]
		);
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'price_content_section',
			[
				'label' => __( 'Price', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'price_style',
			[
				'label' => __( 'Price Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
					'style-3'  => __( 'Style 3', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => __( 'Prefix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'theplus' ),
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Value Of Price', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '59.99', 'theplus' ),
				'placeholder' => __( 'Enter value of Price.. Ex. 49,69...', 'theplus' ),
			]
		);
		$this->add_control(
			'price_postfix',
			[
				'label' => __( 'Postfix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Per Month', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Postfix.. Ex. Per Month...', 'theplus' ),
			]
		);
		$this->end_controls_section();
		/*Previous Price*/
		$this->start_controls_section(
			'previous_price_content_section',
			[
				'label' => __( 'Previous Price', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_previous_price',
			[
				'label'        => esc_html__( 'Display Previous Price', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
			]
		);
		$this->add_control(
			'previous_price_prefix',
			[
				'label' => __( 'Prefix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$', 'theplus' ),
				'placeholder' => __( 'Enter text of Price Prefix.. Ex. $,Rs,...', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'previous_price',
			[
				'label' => __( 'Value Of Price', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '59.99', 'theplus' ),
				'placeholder' => __( 'Enter value of Price.. Ex. 49,69...', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->add_control(
			'previous_price_postfix',
			[
				'label' => __( 'Postfix Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter text of Price Postfix.. Ex. Rs,%..', 'theplus' ),
				'condition' => [
					'show_previous_price' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Previous Price*/
		$this->start_controls_section(
			'content_description_section',
			[
				'label' => __( 'Content Description', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'content_style',
			[
				'label' => __( 'Content Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'stylist_list',
				'options' => [
					'stylist_list'  => __( 'Stylish List', 'theplus' ),
					'wysiwyg_content'  => __( 'WYSIWYG', 'theplus' ),
				],
			]
		);
		
		$this->add_control(
			'content_list_style',
			[
				'label' => __( 'Content List Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_description',
			[
				'label' => __( 'List Description', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block.', 'theplus' ),
				'placeholder' => __( 'Type your description here', 'theplus' ),
			]
		);
		$repeater->add_control(
			'list_icon_style',
			[
				'label' => __( 'Icon Font', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'font_awesome',
				'options' => [
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'list_icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-plus',
				'separator' => 'before',
				'condition' => [
					'list_icon_style' => 'font_awesome',
				],
			]
		);
		$repeater->add_control(
			'list_icons_mind',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'default' => 'iconsmind-Add',
				'options' => theplus_icons_mind(),
				'condition' => [
					'list_icon_style' => 'icon_mind',
				],
			]
		);
		$repeater->add_control(
			'show_tooltips',
			[
				'label'        => esc_html__( 'Tooltip options', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'content_type',
			[
				'label' => __( 'Content Type', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal_desc',
				'options' => [
					'normal_desc'  => __( 'Content Text', 'theplus' ),
					'content_wysiwyg'  => __( 'Content WYSIWYG', 'theplus' ),
				],
				'condition' => [
					'show_tooltips' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'tooltip_content_desc',
			[
				'label' => __( 'Description', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
				'default' => __( 'Luctus nec ullamcorper mattis', 'theplus' ),
				'condition' => [
					'content_type' => 'normal_desc',
					'show_tooltips' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'tooltip_content_wysiwyg',
			[
				'label' => __( 'Tooltip Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'condition' => [
					'content_type' => 'content_wysiwyg',
					'show_tooltips' => 'yes',
				],
			]				
		);
		$repeater->add_control(
			'tooltip_content_align',
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
					'{{WRAPPER}} {{CURRENT_ITEM}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'content_type' => 'normal_desc',
					'show_tooltips' => 'yes',
				],
			]
		);
		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tooltip_content_typography',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .tippy-tooltip .tippy-content',
				'condition' => [
					'content_type' => ['normal_desc','content_wysiwyg'],
					'show_tooltips' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'tooltip_content_color',
			[
				'label'  => esc_html__( 'Text Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .tippy-tooltip .tippy-content,{{WRAPPER}} {{CURRENT_ITEM}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'content_type' => ['normal_desc','content_wysiwyg'],
					'show_tooltips' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_list',
			[
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'list_description' => __( 'List Item 1', 'theplus' ),
						'list_icon_fontawesome' => 'fa fa-check-circle',
					],
					[
						'list_description' => __( 'List Item 2', 'theplus' ),
						'list_icon_fontawesome' => 'fa fa-check-circle',
					],
					[
						'list_description' => __( 'List Item 3', 'theplus' ),
						'list_icon_fontawesome' => 'fa fa-check-circle',
					],
				],
				'title_field' => '{{{ list_description }}}',
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'load_show_list_toggle',
			[
				'label' => __( 'List Open Default', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'list_style_show_option',
			[
				'label' => __( 'Expand Section Title', 'theplus' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '+ Show all options', 'theplus' ),
				'description' => __( 'Expand and Shrink Options will be available only for more than 3 list items.', 'theplus' ),
				'separator' => 'before',
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'list_style_less_option',
			[
				'label' => __( 'Shrink Section Title', 'theplus' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '- Less options', 'theplus' ),
				'description' => __( 'Expand and Shrink Options will be available only for more than 3 list items.', 'theplus' ),
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'content_wysiwyg_style',
			[
				'label' => __( 'Content Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_wysiwyg',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'button_section',
            [
                'label' => __('Button', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'display_button',
			[
				'label' => __( 'Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
            'button_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Button Style', 'theplus'),
                'default' => 'style-8',
                'options' => [
                    'style-7' => __('Style 1', 'theplus'),
                    'style-8' => __('Style 2', 'theplus'),
                    'style-9' => __('Style 3', 'theplus'),                    
                ],
				'condition' => [
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Free Trial', 'theplus' ),
				'condition' => [
					'display_button' => 'yes',
				],
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://www.demo-link.com', 'theplus' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'display_button' => 'yes',
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
					''  => __( 'None', 'theplus' ),
					'font_awesome'  => __( 'Font Awesome', 'theplus' ),
					'icon_mind' => __( 'Icons Mind', 'theplus' ),
				],
				'condition' => [
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => __( 'Icon', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => 'fa fa-chevron-right',
				'condition' => [
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
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
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_style' => 'icon_mind',
				],
			]
		);
		$this->add_control(
			'before_after',
			[
				'label' => __( 'Icon Position', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'after' => __( 'After', 'theplus' ),
					'before' => __( 'Before', 'theplus' ),
				],
				'condition' => [
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_style!' => '',
				],
			]
		);
		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Icon Spacing', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'condition' => [
					'display_button' => 'yes',
					'button_style!' => ['style-7','style-9'],
					'button_icon_style!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .button-link-wrap i.button-after' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .button-link-wrap i.button-before' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]			
		);
		$this->end_controls_section();
		/* button content*/
		/*Call to Action*/
		$this->start_controls_section(
            'call_to_action_section',
            [
                'label' => __('Call to Action', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'call_to_action_text',
			[
				'label' => __( 'Call To Action(CTA) Text', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		/*Call to Action*/
		/*Ribbon/pin */
		$this->start_controls_section(
            'ribbon_pin_section',
            [
                'label' => __('Ribbon', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'display_ribbon_pin',
			[
				'label' => __( 'Display Ribbon', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'ribbon_pin_style',
			[
				'label' => __( 'Ribbon Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2'  => __( 'Style 2', 'theplus' ),
					'style-3'  => __( 'Style 3', 'theplus' ),
				],
				'condition' => [
					'display_ribbon_pin' => 'yes',
				],
			]
		);
		$this->add_control(
			'ribbon_pin_text',
			[
				'label' => __( 'Ribbon/Pin Text', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Recommended', 'theplus' ),
				'condition' => [
					'display_ribbon_pin' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*Ribbon/pin */
		/*svg style*/
		$this->start_controls_section(
            'section_svg_styling',
            [
                'label' => __('Svg Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_icon' => 'svg',
				],
            ]
        );
		$this->add_control(
			'svg_type',
			[
				'label' => __( 'Select Style Image', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'delayed',
				'options' => theplus_svg_type(),
				'condition' => [
					'image_icon' => 'svg',
				],
			]
		);
		$this->add_control(
            'duration',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Duration', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'render_type' => 'ui',
				'condition' => [
					'image_icon' => 'svg',
				],
            ]
        );
		$this->add_control(
            'max_width',
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
					'image_icon' => 'svg',
					'svg_icon' => ['svg','img'],
				],
            ]
        );
		$this->add_control(
			'border_stroke_color',
			[
				'label' => __( 'Border/Stoke Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff0000',
				'condition' => [
					'image_icon' => 'svg',
				],
			]
		);
		$this->end_controls_section();
		/*svg style*/
		/* icons style */
		$this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Icon Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'image_icon' => 'icon',
				],
            ]
        );
		$this->add_control(
			'icon_style',
			[
				'label' => __( 'Icon Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'square',
				'options' => [
					''  => __( 'None', 'theplus' ),
					'square' => __( 'Square', 'theplus' ),
					'rounded' => __( 'Rounded', 'theplus' ),
					'hexagon' => __( 'Hexagon', 'theplus' ),
					'pentagon' => __( 'Pentagon', 'theplus' ),
					'square-rotate' => __( 'Square Rotate', 'theplus' ),
				],
			]
		);
		$this->add_control(
            'icon_size',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'font-size: {{SIZE}}{{UNIT}} !important;',
				],
            ]
        );
		$this->add_control(
            'icon_width',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Width', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'width: {{SIZE}}{{UNIT}} !important;height: {{SIZE}}{{UNIT}} !important;line-height: {{SIZE}}{{UNIT}} !important;text-align: center;',
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
			'icon_color_option',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'default' => 'solid',
				
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
            'icon_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'icon_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'icon_color_option' => 'gradient',
					'icon_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_control(
            'icon_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_gradient_color1.VALUE}} {{icon_gradient_color1_control.SIZE}}{{icon_gradient_color1_control.UNIT}}, {{icon_gradient_color2.VALUE}} {{icon_gradient_color2_control.SIZE}}{{icon_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'icon_color_option' => 'gradient',
					'icon_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
				'separator' => 'after',
				
			]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-icon',
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
			'icon_hover_color_option',
			[
				'label' => __( 'Icon Hover Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'default' => 'solid',
			]
		);
		
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'icon_hover_color_option' => 'solid',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
            'icon_hover_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'icon_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'icon_hover_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'icon_hover_color_option' => 'gradient',
					'icon_hover_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_control(
            'icon_hover_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{icon_hover_gradient_color1.VALUE}} {{icon_hover_gradient_color1_control.SIZE}}{{icon_hover_gradient_color1_control.UNIT}}, {{icon_hover_gradient_color2.VALUE}} {{icon_hover_gradient_color2_control.SIZE}}{{icon_hover_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'icon_hover_color_option' => 'gradient',
					'icon_hover_gradient_style' => 'radial',
				],
				'of_type' => 'gradient',
				'separator' => 'after',
			]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon__hover_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_hover_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();		
		$this->end_controls_section();		
		/*icon style*/
		
		/*title style*/
		$this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Title Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pricing_title!' => '',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-title',
			]
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'title_color_option',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'label_block' => false,
				'default' => 'solid',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
            'title_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'title_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'title_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'title_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'title_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'title_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'title_color_option' => 'gradient',
					'title_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'title_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_gradient_color1.VALUE}} {{title_gradient_color1_control.SIZE}}{{title_gradient_color1_control.UNIT}}, {{title_gradient_color2.VALUE}} {{title_gradient_color2_control.SIZE}}{{title_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'title_color_option' => 'gradient',
					'title_gradient_style' => 'radial',
			],
			'of_type' => 'gradient',
			]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'title_hover_color_option',
			[
				'label' => __( 'Title Hover Color', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'solid' => [
						'title' => __( 'Classic', 'theplus' ),
						'icon' => 'fa fa-paint-brush',
					],
					'gradient' => [
						'title' => __( 'Gradient', 'theplus' ),
						'icon' => 'fa fa-barcode',
					],
				],
				'label_block' => false,
				'default' => 'solid',
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'color: {{VALUE}}',
				],
				'condition' => [
					'title_hover_color_option' => 'solid',
				],
			]
		);
		$this->add_control(
            'title_hover_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
					],
				'render_type' => 'ui',
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition' => [
					'title_hover_color_option' => 'gradient',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'title_hover_gradient_angle', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Gradient Angle', 'theplus'),
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 180,
				],
				'range' => [
					'deg' => [
						'step' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				],
				'condition'    => [
					'title_hover_color_option' => 'gradient',
					'title_hover_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'title_hover_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-title' => 'background-color: transparent;-webkit-background-clip: text;-webkit-text-fill-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{title_hover_gradient_color1.VALUE}} {{title_hover_gradient_color1_control.SIZE}}{{title_hover_gradient_color1_control.UNIT}}, {{title_hover_gradient_color2.VALUE}} {{title_hover_gradient_color2_control.SIZE}}{{title_hover_gradient_color2_control.UNIT}})',
				],
				'condition' => [
					'title_hover_color_option' => 'gradient',
					'title_hover_gradient_style' => 'radial',
				],
			'of_type' => 'gradient',
			]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*title style*/
		/*subtitle style*/
		$this->start_controls_section(
            'section_subtitle_styling',
            [
                'label' => __('SubTitle Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'pricing_subtitle!' => '',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'subtitle_Hover_color',
			[
				'label' => __( 'Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-subtitle' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		/*subtitle style*/
		/*Previous Price Style*/
		$this->start_controls_section(
            'section_previous_price_styling',
            [
                'label' => __('Previous Price Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_previous_price' => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'previous_price_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap',
			]
		);
		$this->add_control(
			'previous_price_align',
			[
				'label' => __( 'Price Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'theplus' ),
						'icon' => 'fa fa-level-up',
					],
					'middle' => [
						'title' => __( 'Middle', 'theplus' ),
						'icon' => 'fa fa-align-center',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'theplus' ),
						'icon' => 'fa fa-level-down',
					],
				],
				'default' => 'top',
				'toggle' => true,
				'label_block' => false,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'vertical-align: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs( 'previous_price_style_tab' );
		$this->start_controls_tab(
			'previous_price_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'previous_price_color',
			[
				'label' => __( 'Price Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'previous_price_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'previous_price_hover_color',
			[
				'label' => __( 'Price Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-previous-price-wrap' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Previous Price Style*/		
		/*Price Style */
		$this->start_controls_section(
            'section_price_styling',
            [
                'label' => __('Price Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'prefix_price_style_heading',
			[
				'label' => __( 'Prefix', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'price_style' => ['style-2','style-3']
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'prefix_price_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap span.price-prefix-text',
				'condition' => [
					'price_style' => ['style-2','style-3']
				],
			]
		);
		$this->add_control(
			'prefix_price_color',
			[
				'label' => __( 'Prefix Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap span.price-prefix-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'price_style' => ['style-2','style-3']
				],
			]
		);
		$this->add_control(
			'prefix_price_hover_color',
			[
				'label' => __( 'Prefix Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap span.price-prefix-text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'price_style' => ['style-2','style-3']
				],
			]
		);
		$this->add_control(
			'price_style_heading',
			[
				'label' => __( 'Price Main', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-2 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-3 .pricing-price',
			]
		);
		$this->start_controls_tabs( 'price_style_tab' );
		$this->start_controls_tab(
			'price_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-2 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-3 .pricing-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'price_hover_color',
			[
				'label' => __( 'Price Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 span.price-prefix-text,{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-1 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-2 .pricing-price,{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap.style-3 .pricing-price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'price_postfix_style_heading',
			[
				'label' => __( 'Postfix', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_postfix_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-1 span.price-postfix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-2 span.price-postfix-text,{{WRAPPER}} .plus-pricing-table .pricing-price-wrap.style-3 span.price-postfix-text',
			]
		);
		$this->start_controls_tabs( 'price_postfix_style_tab' );
		$this->start_controls_tab(
			'price_postfix_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		
		$this->add_control(
			'price_postfix_color',
			[
				'label' => __( 'Postfix Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'price_postfix_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'price_postfix_hover_color',
			[
				'label' => __( 'Postfix Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner:hover .pricing-price-wrap span.price-postfix-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Price Style */
		/*Content style*/
		$this->start_controls_section(
            'section_content_styling',
            [
                'label' => __('Content Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content',
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_text_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc .pricing-content p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
				],
			]
		);
		$this->add_control(
			'content_border_width_color',
			[
				 'type' => Controls_Manager::SLIDER,
				'label' => __('Border Width', 'theplus'),
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 2,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'margin: 30px {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'content_border_top_color',
			[
				'label' => __( 'Border Top Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.content-desc.style-1 hr.border-line' => 'border-top:1px solid;border-top-color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'wysiwyg_content',
					'content_wysiwyg_style' => 'style-1'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'list_content_typography',
				'label' => __( 'Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text',
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
            'list_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('List Icon Size', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content li span.plus-icon-list-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
            ]
        );
		$this->start_controls_tabs( 'list_content_style_tab' );
		$this->start_controls_tab(
			'list_content_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'list_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text,{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-text p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table ul.plus-icon-list-items span.plus-icon-list-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'list_content_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'list_text_hover_color',
			[
				'label' => __( 'Hover Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-text,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-text p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->add_control(
			'list_icon_hover_color',
			[
				'label' => __( 'Hover Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content ul.plus-icon-list-items li:hover span.plus-icon-list-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		
		$this->add_control(
            'list_between_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('List Between Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 li' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-2 li' => 'padding: {{SIZE}}{{UNIT}} 0',
				],
				'condition' => [
					'content_style' => 'stylist_list',
				],
            ]
        );
		
		$this->add_control(
			'toggle_expand_options',
			[
				'label' => __( 'Toggle Read More', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'toggle_expand_typography',
				'label' => __( 'Expand/Toggle Text Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 a.read-more-options',
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'toggle_expand_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'toggle_expand_border_top',
			[
				'label' => __( 'Border Top Style', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'condition' => [
					'toggle_expand_border_top' => 'yes',
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'toggle_expand_border_top_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'border-top:1px solid;border-top-color: {{VALUE}};',
				],
				'condition' => [
					'toggle_expand_border_top' => 'yes',
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
			]
		);
		$this->add_control(
			'list_style_2_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-2 li' => 'border-bottom-color: {{VALUE}};',
				],
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-2'
				],
			]
		);
		$this->end_controls_section();
		/*Content style*/
		
		/*Content background style*/
		$this->start_controls_section(
            'section_content_bg_styling',
            [
                'label' => __('Content Background Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'content_style' => 'stylist_list',
					'content_list_style' => 'style-1'
				],
            ]
        );
		$this->add_control(
			'content_box_border',
			[
				'label' => __( 'Content Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'separator' => 'before',
				'default' => 'no',
			]
		);
		$this->start_controls_tabs( 'content_border_style' );
		$this->start_controls_tab(
			'content_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'content_box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#eee',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'content_box_border_width',
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
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1 a.read-more-options,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'content_box_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1:hover a.read-more-options' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'content_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover ul.plus-icon-list-items,{{WRAPPER}} .pricing-content-wrap.listing-content.style-1:hover a.read-more-options,{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'content_box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_background_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'content_background_style' );
		$this->start_controls_tab(
			'content_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color',
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_background_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_box_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'content_shadow_style' );
		$this->start_controls_tab(
			'content_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1 .content-overlay-bg-color',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_box_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-content-wrap.listing-content.style-1:hover .content-overlay-bg-color',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Content background style*/
		$this->start_controls_section(
            'section_tooltip_option_styling',
            [
                'label' => __('Tooltip Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			\Theplus_Tooltips_Option_Group::get_type(),
			[
				'label' => __( 'Tooltip Options', 'theplus' ),
				'name'           => 'tooltip_common_option',
				'condition' => [
					'content_style' => 'stylist_list',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Theplus_Tooltips_Option_Style_Group::get_type(),
			[
				'label' => __( 'Tooltip Style', 'theplus' ),
				'name'           => 'tooltip_common_style',
				'condition' => [
					'content_style' => 'stylist_list',
				],
			]
		);
		$this->end_controls_section();
		/*button style*/
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Button Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_control(
            'button_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Button Above Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-button-wrapper' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em'],
				'default' => [
							'top' => '8',
							'right' => '35',
							'bottom' => '8',
							'left' => '35',
							'isLinked' => false 
				],
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .pt_plus_button .button-link-wrap',
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
			'btn_text_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .pt_plus_button.button-style-7 .button-link-wrap:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'separator' => 'after',
				'condition' => [
					'button_style!' => ['style-7','style-9'],
				],
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
				],
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
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
					'button_border_style!' => 'none',
				]
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label'     => __( 'Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
					'button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);

		$this->add_responsive_control(
			'button_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '
							   {{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => [
					'button_style' => ['style-8'],
				],
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
			'btn_text_hover_color',
			[
				'label' => __( 'Text Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'separator' => 'after',
				'condition' => [
					'button_style!' => ['style-7','style-9'],
				],
			]
		);
		$this->add_control(
			'button_border_hover_color',
			[
				'label'     => __( 'Hover Border Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
					'button_border_style!' => 'none'
				],
				'separator' => 'after',
			]
		);
		

		$this->add_responsive_control(
			'button_hover_radius',
			[
				'label'      => __( 'Hover Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => [
					'button_style' => ['style-8'],
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
            'section_call_to_action_styling',
            [
                'label' => __('Call To Action(CTA)', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cta_typography',
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-cta-text',				
			]
		);
		$this->add_control(
			'cta_text_color',
			[
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-cta-text,{{WRAPPER}} .plus-pricing-table .pricing-table-inner .pricing-cta-text p' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_section();
		/*button style*/
		/*Ribbon Style*/
		$this->start_controls_section(
            'section_ribbon_pin_styling',
            [
                'label' => __('Ribbon/Pin', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_ribbon_pin' => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_pin_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner',
			]
		);
		$this->add_control(
			'ribbon_text_color',
			[
				'label'     => __( 'Text Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin .ribbon-pin-inner p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'ribbon_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'ribbon_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-1 .ribbon-pin-inner,{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2',
				'separator' => 'before',
				'condition' => [
					'ribbon_pin_style' => ['style-1','style-2'],
				],
			]
		);
		$this->add_control(
			'ribbon_bg_style_3',
			[
				'label'     => __( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#212121',
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3' => 'background: {{VALUE}};',
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-3:after' => 'border-top-color: {{VALUE}};border-left-color: {{VALUE}};',
				],
				'condition' => [
					'ribbon_pin_style' => ['style-3'],
				],
			]
		);
		$this->add_responsive_control(
			'ribbon_pin_width',
			[
				'label' => __( 'Max-Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ribbon_pin_style' => 'style-2',
				],
			]
		);
		$this->add_responsive_control(
			'ribbon_pin_adjust',
			[
				'label' => __( 'Adjust Pin Text', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table .pricing-ribbon-pin.style-2 .ribbon-pin-inner' => 'margin-top: -{{SIZE}}{{UNIT}};margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ribbon_pin_style' => 'style-2',
				],
			]
		);
		$this->end_controls_section();
		/*Ribbon Style*/
		/*background option*/
		$this->start_controls_section(
            'section_bg_option_styling',
            [
                'label' => __('Background Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_responsive_control(
			'bg_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_border',
			[
				'label' => __( 'Box Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
			]
		);
		$this->start_controls_tabs( 'tabs_border_style' );
		$this->start_controls_tab(
			'tab_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'box_border_width',
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
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'box_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'background_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'bg_hover_animation',
			[
				'label' => __( 'Background Hover Animation', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'hover_normal',
				'options' => [
					'hover_normal'  => __( 'Select Hover Bg Animation', 'theplus' ),
					'hover_fadein'  => __( 'FadeIn', 'theplus' ),
					'hover_slide_left' => __( 'SlideInLeft', 'theplus' ),
					'hover_slide_right' => __( 'SlideInRight', 'theplus' ),
					'hover_slide_top' => __( 'SlideInTop', 'theplus' ),
					'hover_slide_bottom' => __( 'SlideInBotton', 'theplus' ),
				],
			]
		);
		$this->start_controls_tabs( 'tabs_background_style' );
		$this->start_controls_tab(
			'tab_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part',
				
			]
		);
		$this->add_control(
			'box_overlay_bg_color',
			[
				'label' => __( 'Overlay Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-overlay-color,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-overlay-color,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-overlay-color' => 'background: {{VALUE}};',
				],
				'condition' => [
					'bg_hover_animation' => 'hover_normal',
				],
				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .plus-pricing-table.hover_normal.pricing-style-1:hover .pricing-table-inner,
								{{WRAPPER}} .plus-pricing-table.hover_fadein .pricing-overlay-color,
								{{WRAPPER}} .plus-pricing-table.hover_slide_left .pricing-overlay-color,
								{{WRAPPER}} .plus-pricing-table.hover_slide_right .pricing-overlay-color,
								{{WRAPPER}} .plus-pricing-table.hover_slide_top .pricing-overlay-color,
								{{WRAPPER}} .plus-pricing-table.hover_slide_bottom .pricing-overlay-color,
								{{WRAPPER}} .plus-pricing-table.hover_normal.pricing-style-2:hover .pricing-table-inner,
								{{WRAPPER}} .plus-pricing-table.hover_normal.pricing-style-3:hover .pricing-top-part',
			]
		);
		$this->add_control(
			'box_hover_overlay_bg_color',
			[
				'label' => __( 'Overlay Hover Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'default' => '',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-overlay-color,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-overlay-color,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-overlay-color' => 'background: {{VALUE}};',
				],
				'condition' => [
					'bg_hover_animation' => 'hover_normal',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_shadow_style' );
		$this->start_controls_tab(
			'tab_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .plus-pricing-table.pricing-style-1:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2:hover .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3:hover .pricing-top-part',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*background option*/
		/*Extra option*/
		$this->start_controls_section(
            'section_extra_options_styling',
            [
                'label' => __('Extra Effects', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'transform_scale',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Scale Zoom', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 1,
				],
				'range' => [
					'' => [
						'min'	=> 0.6,
						'max'	=> 1.8,
						'step' => 0.05,
					],
				],
				'render_type' => 'ui',
				'selectors'  => [
					'{{WRAPPER}} .plus-pricing-table.pricing-style-1 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-2 .pricing-table-inner,{{WRAPPER}} .plus-pricing-table.pricing-style-3 .pricing-top-part' => 'transform: scale({{SIZE}});',
				],
            ]
        );
		$this->end_controls_section();
		/*Extra option*/
		/*Adv tab*/
		$this->start_controls_section(
            'section_plus_extra_adv',
            [
                'label' => __('Plus Extras', 'theplus'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );
		$this->end_controls_section();
		/*Adv tab*/
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
		$pricing_style = $settings["pricing_table_style"];
		$title_style = $settings["title_style"];
		
		
		/*title */
		$pricing_title = $settings["pricing_title"];
		$title='';
		if(!empty($pricing_title)){
			$title .='<div class="pricing-title-wrap">';
				$title .='<div class="pricing-title">'.esc_attr($pricing_title).'</div>';
			$title .='</div>';
		}
		/*title */
		
		/*subtitle */
		$pricing_subtitle = $settings["pricing_subtitle"];
		$subtitle='';
		if(!empty($pricing_subtitle)){
			$subtitle .='<div class="pricing-subtitle-wrap">';
				$subtitle .='<div class="pricing-subtitle">'.esc_attr($pricing_subtitle).'</div>';
			$subtitle .='</div>';
		}
		/*subtitle */
		
		/* Icon content */
		$icons_content='';
		$image_icon=$settings["image_icon"];
		if($image_icon == 'image'){
			if($settings["select_image"]["url"]!=''){
				$imgSrc = $settings["select_image"]["url"];
			}else{
				$imgSrc = '';
			}
			$icons_content='<div class="pricing-icon"><img src="'.esc_url($imgSrc).'"   class="pricing-icon-img" alt="'.esc_attr__("icon","theplus").'" /></div>';
		}
		
		$icon_style=$settings["icon_style"];
			if($icon_style == 'square'){
				$service_icon_style = 'icon-squre';
			} 
			if($icon_style == 'rounded'){
				$service_icon_style = 'icon-rounded';
			} 	
			if($icon_style == 'hexagon'){
				$service_icon_style = 'icon-hexagon';
			} 	
			if($icon_style == 'pentagon'){
				$service_icon_style = 'icon-pentagon';
			}  	
			if($icon_style == 'square-rotate'){
				$service_icon_style = 'icon-square-rotate';
			}
		if($image_icon == 'icon'){
			if($settings["icon_font_style"]=='font_awesome'){
				$icons = $settings["icon_fontawesome"];
			}else if($settings["icon_font_style"]=='icon_mind'){
				$icons = 'fa '.$settings["icons_mind"];
			}else{
				$icons = '';
			}
			if(!empty($icons)){
				$icons_content = '<div class="pricing-icon '.esc_attr($service_icon_style).'"><i class=" '.esc_attr($icons).' "></i></div>';
			}
		}
		$border_stroke_color='none';
		if($image_icon == 'svg'){
			if($settings['svg_icon'] == 'img'){
				$svg_url = $settings['svg_image']['url'];
			}else{
				$svg_url = THEPLUS_URL.'assets/images/svg/'.esc_attr($settings["svg_d_icon"]); 
			}
			$uid=uniqid("svg-");
						
			if($settings['border_stroke_color'] !=''){
				$border_stroke_color=$settings['border_stroke_color'];
			}else{
				$border_stroke_color='none';
			}
			$icons_content ='<div class="pricing-icon pt_plus_animated_svg  '.esc_attr($uid).'" data-id="'.esc_attr($uid).'" data-type="'.esc_attr($settings["svg_type"]).'" data-duration="'.esc_attr($settings["duration"]["size"]).'" data-stroke="'.esc_attr($border_stroke_color).'" data-fill_color="none">';
				$icons_content .='<div class="svg_inner_block" style="max-width:'.$settings["max_width"]["size"].$settings["max_width"]["unit"].';max-height:'.$settings["max_width"]["size"].$settings["max_width"]["unit"].';">';
					$icons_content .='<object id="'.esc_attr($uid).'" type="image/svg+xml" data="'.esc_url($svg_url).'" ></object>';
				$icons_content .='</div>';
			$icons_content .='</div>';
		}
		/* Icon content */
		
		/*content description*/
		$content_style = $settings['content_style'];
		$pricing_content ='';
		$i=0;
		if($content_style =='wysiwyg_content' && !empty($settings["content_wysiwyg"])){
			$pricing_content .='<div class="pricing-content-wrap content-desc '.$settings["content_wysiwyg_style"].'">';
				if($settings["content_wysiwyg_style"]=='style-1'){
					$pricing_content .='<hr class="border-line" />';
				}
				$pricing_content .='<div class="pricing-content">';
					$pricing_content .=$settings["content_wysiwyg"];
				$pricing_content .='</div>';
				$pricing_content .= '<div class="content-overlay-bg-color"></div>';
			$pricing_content .='</div>';
		}else if($content_style =='stylist_list'){
			$pricing_content .='<div class="pricing-content-wrap listing-content '.$settings["content_list_style"].'">';
				$pricing_content .='<ul class="plus-icon-list-items">';
					
					foreach ( $settings['icon_list'] as $index => $item ) :
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'icon_list', $index );

						$this->add_render_attribute( $repeater_setting_key, 'class', 'plus-icon-list-text' );

						$this->add_inline_editing_attributes( $repeater_setting_key );
						$_tooltip='_tooltip_'.$i;
						if( $item['show_tooltips'] == 'yes' ) {
							
							$this->add_render_attribute( $_tooltip, 'data-tippy', '', true );

							if (!empty($item['content_type']) && $item['content_type']=='normal_desc') {
								$this->add_render_attribute( $_tooltip, 'title', $item['tooltip_content_desc'], true );
							}else if (!empty($item['content_type']) && $item['content_type']=='content_wysiwyg') {
								$tooltip_content=$item['tooltip_content_wysiwyg'];
								$this->add_render_attribute( $_tooltip, 'title', $tooltip_content, true );
							}else if($item["content_type"]=='template' && !empty($item['tooltip_content_template'])){
								$tooltip_content=Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $item['tooltip_content_template'] );
								$this->add_render_attribute( $_tooltip, 'title', $tooltip_content, true );
							}
							
							$plus_tooltip_position=($settings["tooltip_common_option_plus_tooltip_position"]!='') ? $settings["tooltip_common_option_plus_tooltip_position"] : 'top';
							$this->add_render_attribute( $_tooltip, 'data-tippy-placement', $plus_tooltip_position, true );
							
							$tooltip_interactive =($settings["tooltip_common_option_plus_tooltip_interactive"]=='' || $settings["tooltip_common_option_plus_tooltip_interactive"]=='yes') ? 'true' : 'false';
							$this->add_render_attribute( $_tooltip, 'data-tippy-interactive', $tooltip_interactive, true );
							
							$plus_tooltip_theme=($settings["tooltip_common_option_plus_tooltip_theme"]!='') ? $settings["tooltip_common_option_plus_tooltip_theme"] : 'dark';
							$this->add_render_attribute( $_tooltip, 'data-tippy-theme', $plus_tooltip_theme, true );
							
							
							$tooltip_arrow =($settings["tooltip_common_option_plus_tooltip_arrow"]!='none' || $settings["tooltip_common_option_plus_tooltip_arrow"]=='') ? 'true' : 'false';
							$this->add_render_attribute( $_tooltip, 'data-tippy-arrow', $tooltip_arrow , true );
							
							$plus_tooltip_arrow=($settings["tooltip_common_option_plus_tooltip_arrow"]!='') ? $settings["tooltip_common_option_plus_tooltip_arrow"] : 'sharp';
							$this->add_render_attribute( $_tooltip, 'data-tippy-arrowtype', $plus_tooltip_arrow, true );
							
							$plus_tooltip_animation=($settings["tooltip_common_option_plus_tooltip_animation"]!='') ? $settings["tooltip_common_option_plus_tooltip_animation"] : 'shift-toward';
							$this->add_render_attribute( $_tooltip, 'data-tippy-animation', $plus_tooltip_animation, true );
							
							$plus_tooltip_x_offset=($settings["tooltip_common_option_plus_tooltip_x_offset"]!='') ? $settings["tooltip_common_option_plus_tooltip_x_offset"] : 0;
							$plus_tooltip_y_offset=($settings["tooltip_common_option_plus_tooltip_y_offset"]!='') ? $settings["tooltip_common_option_plus_tooltip_y_offset"] : 0;
							$this->add_render_attribute( $_tooltip, 'data-tippy-offset', $plus_tooltip_x_offset .','. $plus_tooltip_y_offset, true );
							
							$tooltip_duration_in =($settings["tooltip_common_option_plus_tooltip_duration_in"]!='') ? $settings["tooltip_common_option_plus_tooltip_duration_in"] : 250;
							$tooltip_duration_out =($settings["tooltip_common_option_plus_tooltip_duration_out"]!='') ? $settings["tooltip_common_option_plus_tooltip_duration_out"] : 200;
							$tooltip_trigger =($settings["tooltip_common_option_plus_tooltip_triggger"]!='') ? $settings["tooltip_common_option_plus_tooltip_triggger"] : 'mouseenter';
							$tooltip_arrowtype =($settings["tooltip_common_option_plus_tooltip_arrow"]!='') ? $settings["tooltip_common_option_plus_tooltip_arrow"] : 'sharp';
						}
						
						$uniqid=uniqid("tooltip");
						
						$pricing_content .='<li id="'.esc_attr($uniqid).'" class="plus-icon-list-item elementor-repeater-item-'.esc_attr($item['_id']).'" data-local="true" '.$this->get_render_attribute_string( $_tooltip ).'>';
						if($item['list_icon_style']=='font_awesome'){
							$icons=$item['list_icon_fontawesome'];									
						}else if($item['list_icon_style']=='icon_mind'){
							$icons=$item['list_icons_mind'];									
						}else{
							$icons='';
						}
						if ( ! empty( $icons ) ) :
							$pricing_content .='<span class="plus-icon-list-icon">';
								$pricing_content .='<i class="'.esc_attr( $icons ).'" aria-hidden="true"></i>';
							$pricing_content .='</span>';
						endif;
						$pricing_content .='<span '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$item["list_description"].'</span>';
						if($item['show_tooltips'] == 'yes'){
						$pricing_content .= '<script>
							jQuery( document ).ready(function() {
								tippy( "#'.esc_attr($uniqid).'" , {
									arrowType : "'.$tooltip_arrowtype.'",
									duration : ['.esc_attr($tooltip_duration_in).','.esc_attr($tooltip_duration_out).'],
									trigger : "'.esc_attr($tooltip_trigger).'",
									appendTo: document.querySelector("#'.esc_attr($uniqid).'")
								});
							});
							</script>';
						}
						$pricing_content .='</li>';
						$i++;
					endforeach;						
				$pricing_content .='</ul>';
				
				if(!empty($settings['load_show_list_toggle'])){
					$default_load=$settings['load_show_list_toggle'];
				}else{
					$default_load=3;
				}
				if($settings["content_list_style"]=='style-1' && $i> $default_load){
					$default_load=$default_load-1;
					$pricing_content .='<a href="#" class="read-more-options more" data-default-load="'.esc_attr($default_load).'" data-more-text="'.esc_attr($settings["list_style_show_option"]).'" data-less-text="'.esc_attr($settings["list_style_less_option"]).'">'.esc_html($settings["list_style_show_option"]).'</a>';
				}
				if($settings["content_list_style"]=='style-1'){
					$pricing_content .= '<div class="content-overlay-bg-color"></div>';
				}
			$pricing_content .='</div>';
		}
		/*content description*/
		
		/*Previous Price*/
		$previous_price_content='';
		if(!empty($settings['show_previous_price']) && $settings['show_previous_price']=='yes'){
			$previous_price_prefix = $settings["previous_price_prefix"];
			$previous_price = $settings["previous_price"];
			$previous_price_postfix = $settings["previous_price_postfix"];
			$previous_price_content .='<span class="pricing-previous-price-wrap">'.$previous_price_prefix.$previous_price.$previous_price_postfix.'</span>';			
		}
		/*Previous Price*/
		
		/*Price content*/
		$price_style=$settings["price_style"];
		$price_prefix = $settings["price_prefix"];
		$price = $settings["price"];
		$price_postfix = $settings["price_postfix"];
		
		$price_content ='<div class="pricing-price-wrap '.$price_style.'">';
			$price_content .= $previous_price_content;
			if(!empty($price_prefix)){
				$price_content .='<span class="price-prefix-text">'.$price_prefix.'</span>';
			}
			if(!empty($price)){
				$price_content .='<span class="pricing-price">'.$price.'</span>';
			}
			if(!empty($price_postfix)){
				$price_content .='<span class="price-postfix-text">'.$price_postfix.'</span>';
			}
		$price_content .='</div>';
		/*Price content*/
		
		/* button */
		$the_button='';
		if($settings['display_button'] == 'yes'){
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['button_link']['url'] );
			if ( $settings['button_link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}
			if ( $settings['button_link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}
		$this->add_render_attribute( 'button', 'class', 'button-link-wrap' );
		$this->add_render_attribute( 'button', 'role', 'button' );
		
		$button_style = $settings['button_style'];
		$button_text = $settings['button_text'];
		$btn_uid=uniqid('btn');
		$data_class= $btn_uid;
		$data_class .=' button-'.$button_style.' ';
		
		$the_button ='<div class="pt-plus-button-wrapper">';
			$the_button .='<div class="button_parallax">';
				$the_button .='<div class="ts-button">';
					$the_button .='<div class="pt_plus_button '.$data_class.'">';
						$the_button .= '<div class="animted-content-inner">';
							$the_button .='<a '.$this->get_render_attribute_string( "button" ).'>';
							$the_button .= $this->render_text();
							$the_button .='</a>';
						$the_button .='</div>';
					$the_button .='</div>';
				$the_button .='</div>';
			$the_button .='</div>';
		$the_button .='</div>';
		}
		if(!empty($settings["call_to_action_text"])){
			$the_button .='<div class="pricing-cta-text">'.$settings["call_to_action_text"].'</div>';
		}
		/* button */
		
		$title_style_content='';
		if($settings["title_style"]=='style-1'){
				$title_style_content .='<div class="pricing-title-content style-1">';
					$title_style_content .=$icons_content;
					$title_style_content .=$title;
					$title_style_content .=$subtitle;
				$title_style_content .='</div>';
		}
		
		/*Ribbon Pin*/
		$ribbon_content='';
		if(!empty($settings["display_ribbon_pin"]) && $settings["display_ribbon_pin"]=='yes'){
			$ribbon_style=$settings["ribbon_pin_style"];
			$ribbon_content .='<div class="pricing-ribbon-pin '.esc_attr($ribbon_style).'">';
				$ribbon_content .='<div class="ribbon-pin-inner">';
				$ribbon_content .= $settings["ribbon_pin_text"];
				$ribbon_content .='</div>';
			$ribbon_content .='</div>';
		}
		/*Ribbon Pin*/
		
		/*--Plus Extra ---*/
		$magic_class = $magic_attr = $parallax_scroll = '';
		if (!empty($settings['magic_scroll']) && $settings['magic_scroll'] == 'yes') {
			
				if($settings["scroll_option_popover_toggle"]==''){
					$scroll_offset=0;
					$scroll_duration=300;
				}else{
					$scroll_offset=$settings['scroll_option_scroll_offset'];
					$scroll_duration=$settings['scroll_option_scroll_duration'];
				}
				
				if($settings["scroll_from_popover_toggle"]==''){
					$scroll_x_from=0;
					$scroll_y_from=0;
					$scroll_opacity_from=1;
					$scroll_scale_from=1;
					$scroll_rotate_from=0;
				}else{
					$scroll_x_from=$settings['scroll_from_scroll_x_from'];
					$scroll_y_from=$settings['scroll_from_scroll_y_from'];
					$scroll_opacity_from=$settings['scroll_from_scroll_opacity_from'];
					$scroll_scale_from=$settings['scroll_from_scroll_scale_from'];
					$scroll_rotate_from=$settings['scroll_from_scroll_rotate_from'];
				}
				
				if($settings["scroll_to_popover_toggle"]==''){
					$scroll_x_to=0;
					$scroll_y_to=-50;
					$scroll_opacity_to=1;
					$scroll_scale_to=1;
					$scroll_rotate_to=0;
				}else{
					$scroll_x_to=$settings['scroll_to_scroll_x_to'];
					$scroll_y_to=$settings['scroll_to_scroll_y_to'];
					$scroll_opacity_to=$settings['scroll_to_scroll_opacity_to'];
					$scroll_scale_to=$settings['scroll_to_scroll_scale_to'];
					$scroll_rotate_to=$settings['scroll_to_scroll_rotate_to'];
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
		if( $settings['plus_tooltip'] == 'yes' ) {
			
			$this->add_render_attribute( '_tooltip', 'data-tippy', '', true );

			if (!empty($settings['plus_tooltip_content_type']) && $settings['plus_tooltip_content_type']=='normal_desc') {
				$this->add_render_attribute( '_tooltip', 'title', $settings['plus_tooltip_content_desc'], true );
			}else if (!empty($settings['plus_tooltip_content_type']) && $settings['plus_tooltip_content_type']=='content_wysiwyg') {
				$tooltip_content=$settings['plus_tooltip_content_wysiwyg'];
				$this->add_render_attribute( '_tooltip', 'title', $tooltip_content, true );
			}
			$plus_tooltip_position=($settings["tooltip_opt_plus_tooltip_position"]!='') ? $settings["tooltip_opt_plus_tooltip_position"] : 'top';
			$this->add_render_attribute( '_tooltip', 'data-tippy-placement', $plus_tooltip_position, true );
			
			$tooltip_interactive =($settings["tooltip_opt_plus_tooltip_interactive"]=='' || $settings["tooltip_opt_plus_tooltip_interactive"]=='yes') ? 'true' : 'false';
			$this->add_render_attribute( '_tooltip', 'data-tippy-interactive', $tooltip_interactive, true );
			
			$plus_tooltip_theme=($settings["tooltip_opt_plus_tooltip_theme"]!='') ? $settings["tooltip_opt_plus_tooltip_theme"] : 'dark';
			$this->add_render_attribute( '_tooltip', 'data-tippy-theme', $plus_tooltip_theme, true );
			
			
			$tooltip_arrow =($settings["tooltip_opt_plus_tooltip_arrow"]!='none' || $settings["tooltip_opt_plus_tooltip_arrow"]=='') ? 'true' : 'false';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrow', $tooltip_arrow , true );
			
			$plus_tooltip_arrow=($settings["tooltip_opt_plus_tooltip_arrow"]!='') ? $settings["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
			$this->add_render_attribute( '_tooltip', 'data-tippy-arrowtype', $plus_tooltip_arrow, true );
			
			$plus_tooltip_animation=($settings["tooltip_opt_plus_tooltip_animation"]!='') ? $settings["tooltip_opt_plus_tooltip_animation"] : 'shift-toward';
			$this->add_render_attribute( '_tooltip', 'data-tippy-animation', $plus_tooltip_animation, true );
			
			$plus_tooltip_x_offset=($settings["tooltip_opt_plus_tooltip_x_offset"]!='') ? $settings["tooltip_opt_plus_tooltip_x_offset"] : 0;
			$plus_tooltip_y_offset=($settings["tooltip_opt_plus_tooltip_y_offset"]!='') ? $settings["tooltip_opt_plus_tooltip_y_offset"] : 0;
			$this->add_render_attribute( '_tooltip', 'data-tippy-offset', $plus_tooltip_x_offset .','. $plus_tooltip_y_offset, true );
			
			$tooltip_duration_in =($settings["tooltip_opt_plus_tooltip_duration_in"]!='') ? $settings["tooltip_opt_plus_tooltip_duration_in"] : 250;
			$tooltip_duration_out =($settings["tooltip_opt_plus_tooltip_duration_out"]!='') ? $settings["tooltip_opt_plus_tooltip_duration_out"] : 200;
			$tooltip_trigger =($settings["tooltip_opt_plus_tooltip_triggger"]!='') ? $settings["tooltip_opt_plus_tooltip_triggger"] : 'mouseenter';
			$tooltip_arrowtype =($settings["tooltip_opt_plus_tooltip_arrow"]!='') ? $settings["tooltip_opt_plus_tooltip_arrow"] : 'sharp';
		}
		
		$move_parallax=$move_parallax_attr=$parallax_move='';
		if(!empty($settings['plus_mouse_move_parallax']) && $settings['plus_mouse_move_parallax']=='yes'){
			$move_parallax='pt-plus-move-parallax';
			$parallax_move='parallax-move';
			$parallax_speed_x=($settings["plus_mouse_parallax_speed_x"]["size"]!='') ? $settings["plus_mouse_parallax_speed_x"]["size"] : 30;
				$parallax_speed_y=($settings["plus_mouse_parallax_speed_y"]["size"]!='') ? $settings["plus_mouse_parallax_speed_y"]["size"] : 30;
				$move_parallax_attr .= ' data-move_speed_x="' . esc_attr($parallax_speed_x) . '" ';
				$move_parallax_attr .= ' data-move_speed_y="' . esc_attr($parallax_speed_y) . '" ';
		}
		$tilt_attr='';
		if(!empty($settings['plus_tilt_parallax']) && $settings['plus_tilt_parallax']=='yes'){
			$tilt_scale=($settings["plus_tilt_opt_tilt_scale"]["size"]!='') ? $settings["plus_tilt_opt_tilt_scale"]["size"] : 1.1;
			$tilt_max=($settings["plus_tilt_opt_tilt_max"]["size"]!='') ? $settings["plus_tilt_opt_tilt_max"]["size"] : 20;
			$tilt_perspective=($settings["plus_tilt_opt_tilt_perspective"]["size"]!='') ? $settings["plus_tilt_opt_tilt_perspective"]["size"] : 400;
			$tilt_speed=($settings["plus_tilt_opt_tilt_speed"]["size"]!='') ? $settings["plus_tilt_opt_tilt_speed"]["size"] : 400;
			
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt', '' , true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-scale', $tilt_scale , true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-max', $tilt_max , true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-perspective', $tilt_perspective , true );
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-speed', $tilt_speed , true );
			
			if($settings["plus_tilt_opt_tilt_easing"] !='custom'){
				$easing_tilt=$settings["plus_tilt_opt_tilt_easing"];					
			}else if($settings["plus_tilt_opt_tilt_easing"] =='custom'){
				$easing_tilt=$settings["plus_tilt_opt_tilt_easing_custom"];
			}else{
				$easing_tilt='cubic-bezier(.03,.98,.52,.99)';
			}
			$this->add_render_attribute( '_tilt_parallax', 'data-tilt-easing', $easing_tilt , true );
			
		}
		$reveal_effects=$effect_attr='';
		if(!empty($settings["plus_overlay_effect"]) && $settings["plus_overlay_effect"]=='yes'){
			$effect_rand_no =uniqid('reveal');
			$color_1=($settings["plus_overlay_spcial_effect_color_1"]!='') ? $settings["plus_overlay_spcial_effect_color_1"] : '#313131';
			$color_2=($settings["plus_overlay_spcial_effect_color_2"]!='') ? $settings["plus_overlay_spcial_effect_color_2"] : '#ff214f';
			$effect_attr .=' data-reveal-id="'.esc_attr($effect_rand_no).'" ';
			$effect_attr .=' data-effect-color-1="'.esc_attr($color_1).'" ';
			$effect_attr .=' data-effect-color-2="'.esc_attr($color_2).'" ';
			$reveal_effects=' pt-plus-reveal '.esc_attr($effect_rand_no).' ';
		}
		$continuous_animation='';
		if(!empty($settings["plus_continuous_animation"]) && $settings["plus_continuous_animation"]=='yes'){
			if($settings["plus_animation_hover"]=='yes'){
				$animation_class='hover_';
			}else{
				$animation_class='image-';
			}
			$continuous_animation=$animation_class.$settings["plus_animation_effect"];
		}
		
		$before_content =$after_content ='';
		$uid_widget=uniqid("plus");
		if($settings['magic_scroll'] == 'yes' || $settings['plus_tooltip'] == 'yes' || $settings['plus_mouse_move_parallax']=='yes' || $settings['plus_tilt_parallax']=='yes' || $settings["plus_overlay_effect"]=='yes' || $settings["plus_continuous_animation"]=='yes'){
			$before_content .='<div id="'.esc_attr($uid_widget).'" class="plus-pricing-table-widget plus-widget-wrapper '.esc_attr($magic_class).' '.esc_attr($move_parallax).' '.esc_attr($reveal_effects).' '.esc_attr($continuous_animation).'" '.$effect_attr.' '.$this->get_render_attribute_string( '_tooltip' ).'>';
			$before_content .='<div class="plus-widget-inner-wrap '.esc_attr($parallax_scroll).' " '.$magic_attr.'>';
			if($settings['plus_mouse_move_parallax']=='yes'){
				$before_content .='<div class="plus-widget-inner-parallax '.esc_attr($parallax_move).'" '.$move_parallax_attr.'>';
			}
			if($settings['plus_tilt_parallax']=='yes'){
				$before_content .='<div class="plus-widget-inner-tilt js-tilt" '.$this->get_render_attribute_string( '_tilt_parallax' ).'>';
			}
		}
		if($settings['magic_scroll'] == 'yes' || $settings['plus_tooltip'] == 'yes' || $settings['plus_mouse_move_parallax']=='yes' || $settings['plus_tilt_parallax']=='yes' || $settings["plus_overlay_effect"]=='yes' || $settings["plus_continuous_animation"]=='yes'){
			$after_content .='</div>';
			$after_content .='</div>';
			if($settings['plus_mouse_move_parallax']=='yes'){
				$after_content .='</div>';
			}
			if($settings['plus_tilt_parallax']=='yes'){
				$after_content .='</div>';
			}
			if($settings['plus_tooltip'] == 'yes'){
				$after_content .='<script>
				jQuery( document ).ready(function() {
					tippy( "#'.esc_attr($uid_widget).'" , {
						arrowType : "'.$tooltip_arrowtype.'",
						duration : ['.esc_attr($tooltip_duration_in).','.esc_attr($tooltip_duration_out).'],
						trigger : "'.esc_attr($tooltip_trigger).'",
						appendTo: document.querySelector("#'.esc_attr($uid_widget).'")
					});
				});
				</script>';
			}
		}
		/*--Plus Extra ---*/
		
		$pricing_output='';
		if($pricing_style=='style-1' || $pricing_style=='style-2'){
			$pricing_output .= $ribbon_content;
			$pricing_output .= $title_style_content;
			$pricing_output .= $price_content;
			$pricing_output .= $the_button;
			$pricing_output .= $pricing_content;
			$pricing_output .= '<div class="pricing-overlay-color"></div>';			
		}else if($pricing_style=='style-3'){
			$pricing_output .='<div class="pricing-top-part">';
				$pricing_output .= $ribbon_content;
				$pricing_output .= $title_style_content;
				$pricing_output .= $price_content;
				$pricing_output .= $the_button;
				$pricing_output .= '<div class="pricing-overlay-color"></div>';			
			$pricing_output .='</div>';
			$pricing_output .= $pricing_content;
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
			
			
			$output = '<div id="plus-pricing-table" class="plus-pricing-table pricing-'.esc_attr($pricing_style).' '.$settings["bg_hover_animation"].' '.esc_attr($animated_class).'" '.$animation_attr.'>';
				$output .= '<div class="pricing-table-inner">';
					$output .= $pricing_output;
				$output .='</div>';
				
			$output .='</div>';
		echo $before_content.$output.$after_content;
	}
	
    protected function content_template() {
	
    }
	protected function render_text() {	
		$icons_after=$icons_before='';
		$settings = $this->get_settings_for_display();
		
		$button_style = $settings['button_style'];
		$before_after = $settings['before_after'];
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
		
		if($button_style=='style-8'){
			$button_text =$icons_before . $button_text . $icons_after;
		}
		
		if($button_style=='style-7'){
			$button_text =$button_text.'<span class="btn-arrow"></span>';
		}
		if($button_style=='style-9'){
			$button_text =$button_text.'<span class="btn-arrow"><i class="fa-show fa fa-chevron-right" aria-hidden="true"></i><i class="fa-hide fa fa-chevron-right" aria-hidden="true"></i></span>';
		}
		return $button_text;
	}
}
