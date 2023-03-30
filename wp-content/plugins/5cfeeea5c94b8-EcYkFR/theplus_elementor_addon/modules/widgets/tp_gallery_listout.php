<?php 
/*
Widget Name: Gallery Listing
Description: Different style of gallery listing layouts.
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
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Gallery_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-gallery-listout';
	}

    public function get_title() {
        return __('Gallery Listing', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-grav theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-gallery-style' ];
	}
	
    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }
	
    protected function _register_controls() {
		
		$this->start_controls_section(
			'layout_content_section',
			[
				'label' => __( 'Layout', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(4),
			]
		);
		
		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => theplus_get_list_layout_style(),
			]
		);
		$this->add_control(
			'popup_style',
			[
				'label' => __( 'Popup Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,				
				'default' => 'default',
				'separator' => 'before',
				'options' => [
					'default'  => __( 'Default Light-box', 'theplus' ),
					'no'  => __( 'No', 'theplus' ),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'gallery_options',
			[
				'label' => __( 'Select Option', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					"normal" => __("Normal", 'theplus'),
					"repeater" => __("Repeater", 'theplus'),
				],
			]
		);
		$this->add_control(
			'gallery_images',
			[
				'label' => __( 'Add Images', 'theplus' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'gallery_options' => ['normal']
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'loop_image',
			[
				'label' => __( 'Choose Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
				'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'loop_title',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Image', 'theplus' ),
			]
		);
		$repeater->add_control(
			'loop_content_caption',
			[
				'label' => __( 'Caption', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'I am text block. Click edit button to change this text.', 'theplus' ),
			]
		);
		$repeater->add_control(
			'loop_category',
			[
				'label' => __( 'Category', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __('Separated by "," Comma','theplus'),
				'separator' => 'before',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'loop_image_icon',
			[
				'label' => __( 'Select Icon', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'description' => __('You can select Icon, Custom Image using this option.','theplus'),
				'default' => '',
				'separator' => 'before',
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
			'style_4_link',
			[
				'label' => __( 'Style 4 Button Link', 'theplus' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'theplus' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);
		$this->add_control(
            'loop_gallery',
            [
				'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => [
					[
                        'loop_title' => 'Image 1',
                    ],
					[
                        'loop_title' => 'Image 2',
                    ],
				],                
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{ loop_title }}}',
				'condition' => [
					'gallery_options' => 'repeater',
				],
            ]
        );
		$this->end_controls_section();
		/*columns*/
		$this->start_controls_section(
			'columns_section',
			[
				'label' => __( 'Columns Manage', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		$this->add_control(
			'desktop_column',
			[
				'label' => __( 'Desktop Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['metro','carousel']
				],
			]
		);
		$this->add_control(
			'tablet_column',
			[
				'label' => __( 'Tablet Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['metro','carousel']
				],
			]
		);
		$this->add_control(
			'mobile_column',
			[
				'label' => __( 'Mobile Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '6',
				'options' => theplus_get_columns_list(),
				'condition' => [
					'layout!' => ['metro','carousel']
				],
			]
		);
		$this->add_control(
			'metro_column',
			[
				'label' => __( 'Metro Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					"3" => __("Column 3", 'theplus'),
					"4" => __("Column 4", 'theplus'),
					"5" => __("Column 5", 'theplus'),
					"6" => __("Column 6", 'theplus'),
				],
				'condition' => [
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'metro_style_3',
			[
				'label' => __( 'Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(4),
				'condition' => [
					'metro_column' => '3',
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'metro_style_4',
			[
				'label' => __( 'Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(3),
				'condition' => [
					'metro_column' => '4',
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'metro_style_5',
			[
				'label' => __( 'Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
				'condition' => [
					'metro_column' => '5',
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'metro_style_6',
			[
				'label' => __( 'Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
				'condition' => [
					'metro_column' => '6',
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'responsive_tablet_metro',
			[
				'label' => __( 'Tablet Responsive', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'no', 'theplus' ),
				'default' => 'yes',
				'separator' => 'before',
				'condition' => [
					'layout' => ['metro']
				],
			]
		);
		$this->add_control(
			'tablet_metro_column',
			[
				'label' => __( 'Metro Column', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					"3" => __("Column 3", 'theplus'),
				],
				'condition' => [
					'responsive_tablet_metro' => 'yes',
					'layout' => ['metro'],
				],
			]
		);
		$this->add_control(
			'tablet_metro_style_3',
			[
				'label' => __( 'Tablet Metro Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(4),
				'condition' => [
					'responsive_tablet_metro' => 'yes',
					'tablet_metro_column' => '3',
					'layout' => ['metro']
				],
			]
		);
		$this->add_responsive_control(
			'columns_gap',
			[
				'label' => __( 'Columns Gap/Space Between', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' =>[
					'top' => "15",
					'right' => "15",
					'bottom' => "15",
					'left' => "15",				
				],
				'separator' => 'before',
				'condition' => [
					'layout!' => ['carousel']
				],
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		/*columns*/
		/*post Extra options*/
		$this->start_controls_section(
			'extra_option_section',
			[
				'label' => __( 'Extra Options', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'display_title',
			[
				'label' => __( 'Display Title', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_title_tag',
			[
				'label' => __( 'Title Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
				'condition' => [
					'display_title' => 'yes'
				],
			]
		);
		$this->add_control(
			'featured_image_type',
			[
				'label'   => __( 'Featured Image Type', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'full',
				'options' => [
					"full" => __("Full Image", 'theplus'),
					"grid" => __("Grid Image", 'theplus'),
				],
				'separator' => 'before',
				'condition' => [
					'layout' => ['carousel']
				],
			]
		);
		$this->add_control(
			'display_excerpt',
			[
				'label' => __( 'Display Excerpt/Content', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_button',
			[
				'label' => __( 'Display Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'style_4_button_text',
			[
				'label' => __( 'Button Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,			
				'default' => __('+ Learn more', 'theplus'),
				'condition' => [
					'display_button' => 'yes',
					'style' => 'style-4',
				],
			]
		);
		$this->add_control(
			'style_4_btn_color',
			[
				'label' => __( 'Button Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list.gallery-style-4 .gallery-btn-link' => 'color: {{VALUE}};border-bottom-color: {{VALUE}}',
				],
				'condition' => [
					'display_button' => 'yes',
					'style' => 'style-4',
				],
			]
		);
		$this->add_control(
			'filter_category',
			[
				'label' => __( 'Category Wise Filter', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'gallery_options' => 'repeater',
				],
			]
		);
		$this->add_control(
			'filter_style',
			[
				'label' => __( 'Category Filter Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(4),
				'condition'   => [
					'gallery_options' => 'repeater',
					'filter_category'    => 'yes',
				],
			]
		);
		$this->add_control(
			'filter_hover_style',
			[
				'label' => __( 'Filter Hover Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(4),
				'condition'   => [
					'gallery_options' => 'repeater',
					'filter_category'    => 'yes',
				],
			]
		);
		
		$this->add_control(
			'filter_category_align',
			[
				'label' => __( 'Filter Alignment', 'theplus' ),
				'type' => Controls_Manager::CHOOSE,
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
				'default' => 'center',
				'toggle' => true,
				'label_block' => false,
				'condition'   => [
					'gallery_options' => 'repeater',
					'filter_category'    => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*post Extra options*/		
		/*Icon Zoom*/
		$this->start_controls_section(
            'section_icon_zoom_style',
            [
                'label' => __('Popup Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'display_icon_zoom',
			[
				'label' => __( 'Display Icon', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'custom_icon_image',
			[
				'label' => __( 'Custom Icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);

		$this->add_responsive_control(
            'icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Size', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon a' => 'font-size: {{SIZE}}{{UNIT}};max-width:calc({{SIZE}}{{UNIT}} + 10px );',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
            ]
        );
		
		$this->start_controls_tabs( 'tabs_icon_style' );
		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .meta-search-icon a' => 'color: {{VALUE}}',
				],
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
            'icon_bottom_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Bottom Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .meta-search-icon' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition' => [
					'display_icon_zoom'    => 'yes',
				],
            ]
        );
		$this->end_controls_section();
		/*Icon Zoom*/
		/*Repeater Icon*/
		$this->start_controls_section(
            'section_repeat_icon_style',
            [
                'label' => __('Extra Icon', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'gallery_options' => 'repeater',
				],
            ]
        );
		$this->add_responsive_control(
            'repeat_icon_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Icon Size', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 22,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .gallery-list-icon' => 'font-size: {{SIZE}}{{UNIT}};max-width:calc({{SIZE}}{{UNIT}} + 10px );',
				],
            ]
        );
		
		$this->start_controls_tabs( 'tabs_repeat_icon_style' );
		$this->start_controls_tab(
			'tab_repeat_icon_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'repeat_icon_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .gallery-list-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_repeat_icon_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'repeat_icon_hover_color',
			[
				'label' => __( 'Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .gallery-list-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
            'repeat_icon_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Top Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .gallery-list-icon' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
            ]
        );
		$this->add_responsive_control(
            'repeat_icon_bottom_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Bottom Space', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 80,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 12,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .gallery-list-icon' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->end_controls_section();
		/*Repeater Icon*/
		/*Post Title*/
		$this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .post-title a',
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
			'title_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
				],
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
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .post-title,{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .post-title a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Title*/		
		/*Post Excerpt*/
		$this->start_controls_section(
            'section_excerpt_style',
            [
                'label' => __('Excerpt/Content', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_excerpt'    => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .entry-content',
			]
		);
		$this->start_controls_tabs( 'tabs_excerpt_style' );
		$this->start_controls_tab(
			'tab_excerpt_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'excerpt_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .entry-content,{{WRAPPER}} .gallery-list .post-inner-loop .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_excerpt_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'excerpt_hover_color',
			[
				'label' => __( 'Content Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .entry-content,{{WRAPPER}} .gallery-list .post-inner-loop .gallery-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
            'content_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Top Space', 'theplus'),
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
					'size' => 10,
				],
				'render_type' => 'ui',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .entry-content' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
            ]
        );
		$this->end_controls_section();
		/*Post Excerpt*/
		/*Content Background*/
		$this->start_controls_section(
            'section_content_bg_style',
            [
                'label' => __('Content Background', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		
		$this->start_controls_tabs( 'tabs_content_bg_style' );
		$this->start_controls_tab(
			'tab_content_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'contnet_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gallery-list.gallery-style-1 .gallery-list-content .post-content-center,{{WRAPPER}} .gallery-list.gallery-style-2 .gallery-list-content .post-content-bottom,{{WRAPPER}} .gallery-list.gallery-style-3 .gallery-list-content .post-content-center',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .gallery-list.gallery-style-1 .gallery-list-content:hover .post-content-center,{{WRAPPER}} .gallery-list.gallery-style-2 .gallery-list-content:hover .post-content-bottom,{{WRAPPER}} .gallery-list.gallery-style-3 .gallery-list-content:hover .post-content-center',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Content Background*/
		/*Post Featured Image*/
		$this->start_controls_section(
            'section_post_image_style',
            [
                'label' => __('Featured Image', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'hover_image_style',
			[
				'label' => __( 'Image Hover Effect', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(1),
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
			Group_Control_Background::get_type(),
			[
				'name'      => 'overlay_image_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content .gallery-image:before,{{WRAPPER}} .gallery-list.list-isotope-metro .gallery-list-content .gallery-bg-image-metro:before',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content .gallery-image img,{{WRAPPER}} .gallery-list .gallery-list-content  .gallery-bg-image-metro',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'style_4_effect_color',
			[
				'label' => __( 'Effect Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick.gallery-style-4 .bottom-effects:before,{{WRAPPER}} .list-carousel-slick.gallery-style-4 .bottom-effects:after' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style' => 'style-4',
					'layout' => 'carousel',
				],
			]
		);
		$this->add_responsive_control(
            'effect_adjust',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Effects Adjust', 'theplus'),
				'size_units' => [ 'px','%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
					
				],
				'default' => [
					'unit' => '%',
					'size' => 10,
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick.gallery-style-4 .bottom-effects' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style' => 'style-4',
					'layout' => 'carousel',
				],
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
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_image_hover_background',
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content:hover .gallery-image:before,{{WRAPPER}} .gallery-list.list-isotope-metro .gallery-list-content:hover .gallery-bg-image-metro:before',
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'hover_css_filters',
				'selector' => '{{WRAPPER}} .gallery-list .gallery-list-content:hover .gallery-image img,{{WRAPPER}} .gallery-list .gallery-list-content:hover  .gallery-bg-image-metro',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
				
		$this->end_controls_section();
		/*Post Featured Image*/		
		/*Filter Category style*/
		$this->start_controls_section(
            'section_filter_category_styling',
            [
                'label' => __('Filter Category', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter_category' => 'yes',
					'gallery_options' => 'repeater',
				],
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'filter_category_typography',
				'selector' => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'after',
			]
		);
		$this->add_responsive_control(
			'filter_category_padding',
			[
				'label' => __( 'Inner Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-3 li a,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'filter_category_marign',
			[
				'label' => __( 'Margin', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'filters_text_color',
			[
				'label' => __( 'Filters Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link line,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link circle,{{WRAPPER}} .pt-plus-filter-post-category .post-filter-data.style-4 .filters-toggle-link polyline' => 'stroke: {{VALUE}}',
				],
				'condition' => [
					'filter_style' => ['style-4'],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_filter_color_style' );
		$this->start_controls_tab(
			'tab_filter_category_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'filter_category_color',
			[
				'label' => __( 'Category Filter Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a' => 'color: {{VALUE}}',
				],				
			]
		);
		$this->add_control(
			'filter_category_4_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:before' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'filter_hover_style' => ['style-4'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'filter_category_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count),{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-4 li a:after',
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => ['style-2','style-4'],
				],
			]
		);
		$this->add_responsive_control(
			'filter_category_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-2',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'filter_category_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)',
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-2',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_filter_category_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'filter_category_hover_color',
			[
				'label' => __( 'Category Filter Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:hover,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a:focus,{{WRAPPER}}  .pt-plus-filter-post-category .category-filters:not(.hover-style-2) li a.active,{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'filter_category_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-2',
				],				
			]
		);
		$this->add_responsive_control(
			'filter_category_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-2',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'filter_category_hover_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-2 li a span:not(.all_post_count)::before',
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-2',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'filter_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.hover-style-1 li a::after' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'filter_hover_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'count_filter_category_options',
			[
				'label' => __( 'Count Filter Category', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'category_count_color',
			[
				'label' => __( 'Category Count Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters li a span.all_post_count' => 'color: {{VALUE}}',
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_count_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'condition' => [
					'filter_style' => ['style-1'],
				],
			]
		);
		$this->add_control(
			'category_count_bg_color',
			[
				'label' => __( 'Count Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count' => 'background: {{VALUE}}',
					'{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-3 a span.all_post_count:before' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'filter_style' => ['style-3'],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'filter_category_count_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-filter-post-category .category-filters.style-1 li a.all span.all_post_count',
				'separator' => 'before',
				'condition' => [
					'filter_style' => ['style-1'],
				],
			]
		);
		$this->end_controls_section();
		/*Filter Category style*/
		/*Box Loop style*/
		$this->start_controls_section(
            'section_box_loop_styling',
            [
                'label' => __('Box Loop Background Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
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
		
		$this->add_control(
			'border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
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
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content',
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
				'name'     => 'box_active_shadow',
				'selector' => '{{WRAPPER}} .gallery-list .post-inner-loop .grid-item .gallery-list-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Box Loop style*/
		/*carousel option*/
		$this->start_controls_section(
            'section_carousel_options_styling',
            [
                'label' => __('Carousel Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'carousel',
				],
            ]
        );
		$this->add_control(
			'carousel_unique_id',
			[
				'label' => __( 'Unique Carousel ID', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'after',
				'description' => __('Keep this blank or Setup Unique id for carousel which you can use with "Carousel Remote" widget.','theplus'),
			]
		);
		$this->add_control(
			'slider_direction',
			[
				'label'   => __( 'Slider Mode', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal'  => __( 'Horizontal', 'theplus' ),
					'vertical' => __( 'Vertical', 'theplus' ),
				],
			]
		);		
		$this->add_control(
            'slide_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Slide Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1500,
				],
            ]
        );
		$this->add_control(
            'default_active_slide',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Active Slide', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0,
				],
            ]
        );
		$this->start_controls_tabs( 'tabs_carousel_style' );
		$this->start_controls_tab(
			'tab_carousel_desktop',
			[
				'label' => __( 'Desktop', 'theplus' ),
			]
		);
		$this->add_control(
			'slider_desktop_column',
			[
				'label'   => __( 'Desktop Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '4',
				'options' => theplus_carousel_desktop_columns(),
			]
		);
		$this->add_control(
			'steps_slide',
			[
				'label'   => __( 'Next Previous', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'description' => __( 'Select option of column scroll on previous or next in carousel.','theplus' ),
				'options' => [
					'1'  => __( 'One Column', 'theplus' ),
					'2' => __( 'All Visible Columns', 'theplus' ),
				],
			]
		);
		$this->add_responsive_control(
			'slider_padding',
			[
				'label' => __( 'Slide Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'px' => [
					'top' => '',
					'right' => '10',
					'bottom' => '',
					'left' => '10',					
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-initialized .slick-slide' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'slider_draggable',
			[
				'label'   => __( 'Draggable', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
			'slider_infinite',
			[
				'label'   => __( 'Infinite Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
			'slider_pause_hover',
			[
				'label'   => __( 'Pause On Hover', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'slider_adaptive_height',
			[
				'label'   => __( 'Adaptive Height', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'slider_autoplay',
			[
				'label'   => __( 'Autoplay', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
			]
		);
		$this->add_control(
            'autoplay_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Autoplay Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 500,
						'max' => 10000,
						'step' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 3000,
				],
				'condition' => [
					'slider_autoplay' => 'yes',
				],
            ]
        );
		
		$this->add_control(
			'slider_dots',
			[
				'label'   => __( 'Show Dots', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'slider_dots_style',
			[
				'label'   => __( 'Dots Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
					'style-3' => __( 'Style 3', 'theplus' ),
					'style-4' => __( 'Style 4', 'theplus' ),
					'style-5' => __( 'Style 5', 'theplus' ),
					'style-6' => __( 'Style 6', 'theplus' ),
					'style-7' => __( 'Style 7', 'theplus' ),
				],
				'condition'    => [
					'slider_dots' => ['yes'],
				],
			]
		);
		$this->add_control(
			'dots_border_color',
			[
				'label' => __( 'Dots Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 li button' => '-webkit-box-shadow:inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li.slick-active button' => '-webkit-box-shadow:inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button' => 'border-color:{{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-3 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 8px {{VALUE}};-moz-box-shadow: inset 0 0 0 8px {{VALUE}};box-shadow: inset 0 0 0 8px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-4 li button' => '-webkit-box-shadow: inset 0 0 0 0px {{VALUE}};-moz-box-shadow: inset 0 0 0 0px {{VALUE}};box-shadow: inset 0 0 0 0px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-1 li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'slider_dots_style' => ['style-1','style-2','style-3','style-5'],
					'slider_dots' => 'yes',
				],
			]
		);
		$this->add_control(
			'dots_bg_color',
			[
				'label' => __( 'Dots Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li button,{{WRAPPER}} .list-carousel-slick ul.slick-dots.style-3 li button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 button' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_dots_style' => ['style-2','style-3','style-4','style-5','style-7'],
					'slider_dots' => 'yes',
				],
			]
		);
		$this->add_control(
			'dots_active_border_color',
			[
				'label' => __( 'Dots Active Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button' => '-webkit-box-shadow: inset 0 0 0 1px {{VALUE}};-moz-box-shadow: inset 0 0 0 1px {{VALUE}};box-shadow: inset 0 0 0 1px {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-6 .slick-active button:after' => 'color: {{VALUE}};',
				],
				'condition' => [
					'slider_dots_style' => ['style-2','style-4','style-6'],
					'slider_dots' => 'yes',
				],
			]
		);
		$this->add_control(
			'dots_active_bg_color',
			[
				'label' => __( 'Dots Active Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-dots.style-2 li::after,{{WRAPPER}} .list-carousel-slick .slick-dots.style-4 li.slick-active button:before,{{WRAPPER}} .list-carousel-slick .slick-dots.style-5 .slick-active button,{{WRAPPER}} .list-carousel-slick .slick-dots.style-7 .slick-active button' => 'background: {{VALUE}};',					
				],
				'condition' => [
					'slider_dots_style' => ['style-2','style-4','style-5','style-7'],
					'slider_dots' => 'yes',
				],
			]
		);
		
		$this->add_control(
            'dots_top_padding',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Dots Top Padding', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-slider.slick-dotted' => 'padding-bottom: {{SIZE}}{{UNIT}};',					
				],				
				'condition'    => [
					'slider_dots' => 'yes',
				],
            ]
        );
		$this->add_control(
			'hover_show_dots',
			[
				'label'   => __( 'On Hover Dots', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'slider_dots' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_arrows',
			[
				'label'   => __( 'Show Arrows', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'slider_arrows_style',
			[
				'label'   => __( 'Arrows Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1' => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
					'style-3' => __( 'Style 3', 'theplus' ),
					'style-4' => __( 'Style 4', 'theplus' ),
					'style-5' => __( 'Style 5', 'theplus' ),
					'style-6' => __( 'Style 6', 'theplus' ),
				],
				'condition'    => [
					'slider_arrows' => ['yes'],
				],
			]
		);
		$this->add_control(
			'arrows_position',
			[
				'label'   => __( 'Arrows Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-right',
				'options' => [
					'top-right' => __( 'Top-Right', 'theplus' ),
					'bottm-left' => __( 'Bottom-Left', 'theplus' ),
					'bottom-center' => __( 'Bottom-Center', 'theplus' ),
					'bottom-right' => __( 'Bottom-Right', 'theplus' ),
				],				
				'condition'    => [
					'slider_arrows' => ['yes'],
					'slider_arrows_style' => ['style-3','style-4'],
				],
			]
		);
		$this->add_control(
			'arrow_bg_color',
			[
				'label' => __( 'Arrow Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c44d48',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-6:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-6:before' => 'background: {{VALUE}};',					
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-1','style-3','style-4','style-6'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_icon_color',
			[
				'label' => __( 'Arrow Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6 .icon-wrap' => 'color: {{VALUE}};',					
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5 .icon-wrap:after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5 .icon-wrap:after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-1','style-2','style-3','style-4','style-5','style-6'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_hover_bg_color',
			[
				'label' => __( 'Arrow Hover Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-1','style-2','style-3','style-4'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'arrow_hover_icon_color',
			[
				'label' => __( 'Arrow Hover Icon Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#c44d48',
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-nav.slick-prev.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.slick-next.style-1:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-3:hover:before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-4:hover:before,{{WRAPPER}} .list-carousel-slick .slick-nav.style-6:hover .icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-2:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-prev.style-5:hover .icon-wrap::after,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::before,{{WRAPPER}} .list-carousel-slick .slick-next.style-5:hover .icon-wrap::after' => 'background: {{VALUE}};',
				],
				'condition' => [
					'slider_arrows_style' => ['style-1','style-2','style-3','style-4','style-5','style-6'],
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'outer_section_arrow',
			[
				'label'   => __( 'Outer Content Arrow', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'slider_arrows' => 'yes',
					'slider_arrows_style' => ['style-1','style-2','style-5','style-6'],
				],
			]
		);
		$this->add_control(
			'hover_show_arrow',
			[
				'label'   => __( 'On Hover Arrow', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'slider_arrows' => 'yes',
				],
			]
		);
		$this->add_control(
			'slider_center_mode',
			[
				'label'   => __( 'Center Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->add_control(
            'center_padding',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Center Padding', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0,
				],
				'condition'    => [
					'slider_center_mode' => ['yes'],
				],
            ]
        );
		$this->add_control(
			'slider_center_effects',
			[
				'label'   => __( 'Center Slide Effects', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => theplus_carousel_center_effects(),
				'condition'    => [
					'slider_center_mode' => ['yes'],
				],
			]
		);
		$this->add_control(
            'scale_center_slide',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Center Slide Scale', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.02,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});',
				],
				'condition' => [
					'slider_center_mode' => 'yes',
					'slider_center_effects' => 'scale',
				],
            ]
        );
		$this->add_control(
            'scale_normal_slide',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Normal Slide Scale', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0.3,
						'max' => 2,
						'step' => 0.02,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0.8,
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-slide' => '-webkit-transform: scale({{SIZE}});-moz-transform:    scale({{SIZE}});-ms-transform:     scale({{SIZE}});-o-transform:      scale({{SIZE}});transform:scale({{SIZE}});transition: .3s all linear;',
				],
				'condition' => [
					'slider_center_mode' => 'yes',
					'slider_center_effects' => 'scale',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'shadow_active_slide',
				'selector' => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .gallery-list-content',
				'condition' => [
					'slider_center_mode' => 'yes',
					'slider_center_effects' => 'shadow',
				],
			]
		);
		$this->add_control(
            'opacity_normal_slide',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Normal Slide Opacity', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0.1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0.7,
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick .slick-slide:not(.slick-center)' => 'opacity:{{SIZE}}',
				],
				'condition' => [
					'slider_center_mode' => 'yes',
					'slider_center_effects!' => 'none',
				],
            ]
        );
		$this->add_control(
			'slider_rows',
			[
				'label'   => __( 'Number Of Rows', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					"1" => __("1 Row", 'theplus'),
					"2" => __("2 Rows", 'theplus'),
					"3" => __("3 Rows", 'theplus'),
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
            'slide_row_top_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Row Top Space', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 15,
				],
				'selectors' => [
					'{{WRAPPER}} .list-carousel-slick[data-slider_rows="2"] .slick-slide > div:last-child,{{WRAPPER}} .list-carousel-slick[data-slider_rows="3"] .slick-slide > div:nth-last-child(-n+2)' => 'padding-top:{{SIZE}}px',
				],
				'condition'    => [
					'slider_rows' => ['2','3'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
			]
		);
		$this->add_control(
			'slider_tablet_column',
			[
				'label'   => __( 'Tablet Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => theplus_carousel_tablet_columns(),
			]
		);
		$this->add_control(
			'tablet_steps_slide',
			[
				'label'   => __( 'Next Previous', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'description' => __( 'Select option of column scroll on previous or next in carousel.','theplus' ),
				'options' => [
					'1'  => __( 'One Column', 'theplus' ),
					'2' => __( 'All Visible Columns', 'theplus' ),
				],
			]
		);
		
		$this->add_control(
			'slider_responsive_tablet',
			[
				'label'   => __( 'Responsive Tablet', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'tablet_slider_draggable',
			[
				'label'   => __( 'Draggable', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_slider_infinite',
			[
				'label'   => __( 'Infinite Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_slider_autoplay',
			[
				'label'   => __( 'Autoplay', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
            'tablet_autoplay_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Autoplay Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 500,
						'max' => 10000,
						'step' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1500,
				],
				'condition' => [
					'slider_responsive_tablet' => 'yes',
					'tablet_slider_autoplay' => 'yes',
				],
            ]
        );
		$this->add_control(
			'tablet_slider_dots',
			[
				'label'   => __( 'Show Dots', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_slider_arrows',
			[
				'label'   => __( 'Show Arrows', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_slider_rows',
			[
				'label'   => __( 'Number Of Rows', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					"1" => __("1 Row", 'theplus'),
					"2" => __("2 Rows", 'theplus'),
					"3" => __("3 Rows", 'theplus'),
				],
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_center_mode',
			[
				'label'   => __( 'Center Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
				],
			]
		);
		$this->add_control(
            'tablet_center_padding',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Center Padding', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0,
				],
				'condition'    => [
					'slider_responsive_tablet' => 'yes',
					'tablet_center_mode' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_carousel_mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
			]
		);
		$this->add_control(
			'slider_mobile_column',
			[
				'label'   => __( 'Mobile Columns', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '2',
				'options' => theplus_carousel_mobile_columns(),
			]
		);
		$this->add_control(
			'mobile_steps_slide',
			[
				'label'   => __( 'Next Previous', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'description' => __( 'Select option of column scroll on previous or next in carousel.','theplus' ),
				'options' => [
					'1'  => __( 'One Column', 'theplus' ),
					'2' => __( 'All Visible Columns', 'theplus' ),
				],
			]
		);
		
		$this->add_control(
			'slider_responsive_mobile',
			[
				'label'   => __( 'Responsive Mobile', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
			]
		);
		$this->add_control(
			'mobile_slider_draggable',
			[
				'label'   => __( 'Draggable', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_slider_infinite',
			[
				'label'   => __( 'Infinite Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_slider_autoplay',
			[
				'label'   => __( 'Autoplay', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
            'mobile_autoplay_speed',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Autoplay Speed', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 500,
						'max' => 10000,
						'step' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1500,
				],
				'condition' => [
					'slider_responsive_mobile' => 'yes',
					'mobile_slider_autoplay' => 'yes',
				],
            ]
        );
		$this->add_control(
			'mobile_slider_dots',
			[
				'label'   => __( 'Show Dots', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'yes',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_slider_arrows',
			[
				'label'   => __( 'Show Arrows', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_slider_rows',
			[
				'label'   => __( 'Number Of Rows', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					"1" => __("1 Row", 'theplus'),
					"2" => __("2 Rows", 'theplus'),
					"3" => __("3 Rows", 'theplus'),
				],
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_center_mode',
			[
				'label'   => __( 'Center Mode', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
				],
			]
		);
		$this->add_control(
            'mobile_center_padding',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Center Padding', 'theplus'),
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 500,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0,
				],
				'condition'    => [
					'slider_responsive_mobile' => 'yes',
					'mobile_center_mode' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*carousel option*/
		/*Extra options*/
		$this->start_controls_section(
            'section_extra_options_styling',
            [
                'label' => __('Extra Options', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
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
		$this->add_group_control(
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
		$this->add_control(
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
		$this->add_group_control(
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
		$this->add_control(
			'messy_column',
			[
				'label' => __( 'Messy Columns', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tabs_extra_option_style' );
		$this->start_controls_tab(
			'tab_column_1',
			[
				'label' => __( '1', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_1',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 1', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_2',
			[
				'label' => __( '2', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_2',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 2', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_3',
			[
				'label' => __( '3', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_3',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 3', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_4',
			[
				'label' => __( '4', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_4',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 4', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_5',
			[
				'label' => __( '5', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_5',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 5', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_column_6',
			[
				'label' => __( '6', 'theplus' ),
				'condition'    => [
					'messy_column' => ['yes'],
				],
			]
		);
		$this->add_responsive_control(
            'desktop_column_6',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Column 6', 'theplus'),
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -250,
						'max' => 250,
						'step' => 2,
					],
					'%' => [
						'min' => 70,
						'max' => 70,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'condition'    => [
					'messy_column' => ['yes'],
				],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->end_controls_section();
		/*Extra options*/
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
			'animated_column_list',
			[
				'label'   => __( 'List Load Animation', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					''  => __( 'Content Animation Block', 'theplus' ),
					'stagger' => __( 'Stagger Based Animation', 'theplus' ),
					'columns' => __( 'Columns Based Animation', 'theplus' ),
				],
				'condition'    => [
					'animation_effects!' => [ 'no-animation' ],
				],
			]
		);
		$this->add_control(
            'animation_stagger',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Animation Stagger', 'theplus'),
				'default' => [
					'unit' => '',
					'size' => 150,
				],
				'range' => [
					'' => [
						'min'	=> 0,
						'max'	=> 6000,
						'step' => 10,
					],
				],
				'condition' => [
					'animation_effects!' => [ 'no-animation' ],
					'animated_column_list' => 'stagger',
				],
            ]
        );
		$this->add_control(
            'animation_duration_default',
            [
				'label'   => esc_html__( 'Animation Duration', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition'    => [
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
		$style=$settings["style"];
		$layout=$settings["layout"];
		$display_title=$settings["display_title"];
		$post_title_tag=$settings["post_title_tag"];
		$popup_style=$settings["popup_style"];
		$popup_attr='';
		if($popup_style=='default'){
			$popup_attr = 'data-elementor-open-lightbox="'.$popup_style.'" data-elementor-lightbox-slideshow="'.$this->get_id().'"';
		}
			
		$display_icon_zoom=$settings["display_icon_zoom"];
		
		$featured_image_type=(!empty($settings["featured_image_type"])) ? $settings["featured_image_type"] : 'full';
		
		$display_excerpt=$settings["display_excerpt"];
		$display_button=$settings["display_button"];
		$style_4_button_text=$settings["style_4_button_text"];
		$style_4_btn_content='';
		
		//animation load
		$animation_effects=$settings["animation_effects"];
		$animation_delay=$settings["animation_delay"]["size"];
		$animation_stagger=$settings["animation_stagger"]["size"];
		$animated_columns='';
		if($animation_effects=='no-animation'){
			$animated_class='';
			$animation_attr='';
		}else{
			$animate_offset = theplus_scroll_animation();
			$animated_class = 'animate-general';
			$animation_attr = ' data-animate-type="'.esc_attr($animation_effects).'" data-animate-delay="'.esc_attr($animation_delay).'"';
			$animation_attr .= ' data-animate-offset="'.esc_attr($animate_offset).'"';
			if($settings["animated_column_list"]=='stagger'){
				$animated_columns='animated-columns';
				$animation_attr .=' data-animate-columns="stagger"';
				$animation_attr .=' data-animate-stagger="'.esc_attr($animation_stagger).'"';
			}else if($settings["animated_column_list"]=='columns'){
				$animated_columns='animated-columns';
				$animation_attr .=' data-animate-columns="columns"';
			}
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
		$tilt_parallax ='';
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
			$tilt_parallax=' js-tilt';
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
		
		//columns
		$desktop_class=$tablet_class=$mobile_class='';
		if($layout!='carousel' && $layout!='metro'){
			$desktop_class='tp-col-md-'.esc_attr($settings['desktop_column']);
			$tablet_class='tp-col-sm-'.esc_attr($settings['tablet_column']);
			$mobile_class='tp-col-'.esc_attr($settings['mobile_column']);
		}
		
		
		//layout
		$layout_attr=$data_class='';
		if($layout!=''){
			$data_class .=theplus_get_layout_list_class($layout);
			$layout_attr=theplus_get_layout_list_attr($layout);
		}else{
			$data_class .=' list-isotope';
		}
		if($layout=='metro'){
			$metro_columns=$settings['metro_column'];
			$layout_attr .=' data-columns="'.esc_attr($metro_columns).'" ';
			$layout_attr .=' data-metro-style="'.esc_attr($settings["metro_style_".$metro_columns]).'" ';
			if(!empty($settings["responsive_tablet_metro"]) && $settings["responsive_tablet_metro"]=='yes'){
				$tablet_metro_column=$settings["tablet_metro_column"];
				$layout_attr .=' data-tablet-metro-columns="'.esc_attr($tablet_metro_column).'" ';
				if(isset($settings["tablet_metro_style_".$tablet_metro_column]) && !empty($settings["tablet_metro_style_".$tablet_metro_column])){
					$layout_attr .=' data-tablet-metro-style="'.esc_attr($settings["tablet_metro_style_".$tablet_metro_column]).'" ';
				}
			}
		}
		
		$data_class .=' gallery-'.$style;
		$data_class .=' hover-image-'.$settings["hover_image_style"];
		
		
		$output=$data_attr='';
		
		//carousel
		if($layout=='carousel'){
			if(!empty($settings["hover_show_dots"]) && $settings["hover_show_dots"]=='yes'){
				$data_class .=' hover-slider-dots';
			}
			if(!empty($settings["hover_show_arrow"]) && $settings["hover_show_arrow"]=='yes'){
				$data_class .=' hover-slider-arrow';
			}
			if(!empty($settings["outer_section_arrow"]) && $settings["outer_section_arrow"]=='yes' && ($settings["slider_arrows_style"]=='style-1' || $settings["slider_arrows_style"]=='style-2' || $settings["slider_arrows_style"]=='style-5' || $settings["slider_arrows_style"]=='style-6')){
				$data_class .=' outer-slider-arrow';
			}
			$data_attr .=$this->get_carousel_options();
			if($settings["slider_arrows_style"]=='style-3' || $settings["slider_arrows_style"]=='style-4'){
				$data_class .=' '.$settings["arrows_position"];
			}
			if(($settings["slider_rows"] > 1) || ($settings["tablet_slider_rows"] > 1) || ($settings["mobile_slider_rows"] > 1)){
				$data_class .= ' multi-row';
			}
		}
		if($settings['filter_category']=='yes' && $layout!='carousel'){
			$data_class .=' pt-plus-filter-post-category ';
		}
		
		$ji=1;$ij=0;
		$uid=uniqid("post");
		if(!empty($settings["carousel_unique_id"])){
			$uid="tpca_".$settings["carousel_unique_id"];
		}
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		$tablet_metro_class=$tablet_ij='';
		if ( !empty($settings['gallery_images']) && !empty($settings['loop_gallery'])) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Please select a multiple images gallery", "theplus" ).'</h3>';
		}else{
			$output .= '<div id="pt-plus-gallery-list" class="gallery-list '.esc_attr($uid).' '.esc_attr($data_class).' '.$animated_class.'" '.$layout_attr.' '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
			
			//category filter
			if($settings['filter_category']=='yes'  && $layout!='carousel'){				
				$output .= $this->get_filter_category();
			}
			
			$output .= '<div id="'.esc_attr($uid).'" class="tp-row post-inner-loop '.esc_attr($uid).'">';
			
			//Multiple Images
			if ( !empty($settings['gallery_images']) && $settings['gallery_options']=='normal') {
				foreach ( $settings['gallery_images'] as $image ) {
					$image_id=$image['id'];
					$attachment = get_post($image_id);
					$title=$description=$caption=$image_alt='';
					if($attachment){
						$image_alt=get_post_meta($image_id, '_wp_attachment_image_alt', true);
						$caption=$attachment->post_excerpt;
						$description=$attachment->post_content;
						$title=$attachment->post_title;
					}
					
					if($layout=='metro'){
						$metro_columns=$settings['metro_column'];
						if(!empty($settings["metro_style_".$metro_columns])){
							$ij=theplus_metro_style_layout($ji,$settings['metro_column'],$settings["metro_style_".$metro_columns]);
						}
						if(!empty($settings["responsive_tablet_metro"]) && $settings["responsive_tablet_metro"]=='yes'){
							$tablet_metro_column=$settings["tablet_metro_column"];
							if(!empty($settings["tablet_metro_style_".$tablet_metro_column])){
								$tablet_ij=theplus_metro_style_layout($ji,$settings['tablet_metro_column'],$settings["tablet_metro_style_".$tablet_metro_column]);
								$tablet_metro_class ='tb-metro-item'.esc_attr($tablet_ij);
							}
						}
					}
					//grid item loop
					$output .= '<div class="grid-item metro-item'.esc_attr($ij).' '.$desktop_class.' '.$tablet_class.' '.$mobile_class.' '.$animated_columns.' '.$tilt_parallax.' '.esc_attr($move_parallax).' '.esc_attr($parallax_move).'" '.$move_parallax_attr.' '.$this->get_render_attribute_string( '_tilt_parallax' ).'>';
					if(!empty($move_parallax)){
						$output .= '<div class="'.esc_attr($parallax_move).'" '.$move_parallax_attr.'>';
					}
					if(!empty($style)){
						ob_start();
							include THEPLUS_PATH. 'includes/gallery/gallery-'.esc_attr($style).'.php'; 
							$output .= ob_get_contents();
						ob_end_clean();
					}
					if(!empty($move_parallax)){
						$output .='</div>';
					}
					$output .='</div>';
					
					$ji++;
				}
			}
			
			//Repeater			
			if ( !empty($settings['loop_gallery']) && $settings['gallery_options']=='repeater' ) {
				foreach ( $settings['loop_gallery'] as $item ) {
					$image_alt=$attachment='';
					$image_id=$item["loop_image"]['id'];					
					$caption=$item["loop_content_caption"];					
					$title=$item["loop_title"];
					$image_icon=$item['loop_image_icon'];
					$list_img='';
					if(!empty($item['loop_image_icon'])){
						if(isset($item['loop_image_icon']) && $item['loop_image_icon'] == 'image'){
							if(!empty($item["loop_select_image"]["url"])){
								$loop_imgSrc= $item["loop_select_image"]["url"];
							}else{
								$loop_imgSrc='';
							}
							
							$list_img ='<div class="ts-icon-img icon-img-b " >';
								$list_img .='<img class="" src='.esc_url($loop_imgSrc).' />';
							$list_img .='</div>';
						}else if(isset($item['loop_image_icon']) && $item['loop_image_icon'] == 'icon'){		
							if(!empty($item["loop_icon_style"]) && $item["loop_icon_style"]=='font_awesome'){
								$icons=$item["loop_icon_fontawesome"];
							}else if(!empty($item["loop_icon_style"]) && $item["loop_icon_style"]=='icon_mind'){
								$icons='fa '.$item["loop_icons_mind"];
							}else{
								$icons='';
							}
							$list_img = '<i class=" '.esc_attr($icons).' service-icon" ></i>';						
						}
					}
					if($layout=='metro'){
						$metro_columns=$settings['metro_column'];
						if(!empty($settings["metro_style_".$metro_columns])){
							$ij=theplus_metro_style_layout($ji,$settings['metro_column'],$settings["metro_style_".$metro_columns]);
						}
						if(!empty($settings["responsive_tablet_metro"]) && $settings["responsive_tablet_metro"]=='yes'){
							$tablet_metro_column=$settings["tablet_metro_column"];
							if(!empty($settings["tablet_metro_style_".$tablet_metro_column])){
								$tablet_ij=theplus_metro_style_layout($ji,$settings['tablet_metro_column'],$settings["tablet_metro_style_".$tablet_metro_column]);
								$tablet_metro_class ='tb-metro-item'.esc_attr($tablet_ij);
							}
						}
					}
					//style 4 button
					$style_4_btn_content='';
					if($display_button=='yes' && !empty($item["style_4_link"]["url"])){
						$target = $item['style_4_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $item['style_4_link']['nofollow'] ? ' rel="nofollow"' : '';
						$style_4_btn_content='<a href="'.$item["style_4_link"]["url"].'" ' . $target . $nofollow . ' class="gallery-btn-link">'.esc_html($style_4_button_text).'</a>';
					}
					
					//category filter
					$category_filter=$loop_category='';
					if($settings['filter_category']=='yes' && !empty($item['loop_category'])  && $layout!='carousel'){				
						$loop_category=explode(',', $item['loop_category']);
						foreach( $loop_category as $category ) {
							$category=theplus_createSlug($category);
							$category_filter .=' '.esc_attr($category).' ';
						}
					}
					
					//grid item loop
					$output .= '<div class="grid-item metro-item'.esc_attr($ij).' '.$desktop_class.' '.$tablet_class.' '.$mobile_class.' '.$category_filter.' '.$animated_columns.' '.$tilt_parallax.' '.esc_attr($move_parallax).'"  '.$this->get_render_attribute_string( '_tilt_parallax' ).'>';
					if(!empty($move_parallax)){
						$output .= '<div class="'.esc_attr($parallax_move).'" '.$move_parallax_attr.'>';
					}
					if(!empty($style)){
						ob_start();
							include THEPLUS_PATH. 'includes/gallery/gallery-'.esc_attr($style).'.php'; 
							$output .= ob_get_contents();
						ob_end_clean();
					}
					if(!empty($move_parallax)){
						$output .='</div>';
					}
					$output .='</div>';
					
					$ji++;
				}
			}
			
			$output .='</div>';			
			$output .='</div>';
		}
		
		$css_rule =$css_messy='';
		if($settings['messy_column']=='yes' && $layout!='metro'){
			if($layout=='grid' || $layout=='masonry'){
				$desktop_column=$settings['desktop_column'];
				$tablet_column=$settings['tablet_column'];
				$mobile_column=$settings['mobile_column'];
			}else if($layout=='carousel'){
				$desktop_column=$settings['slider_desktop_column'];
				$tablet_column=$settings['slider_tablet_column'];
				$mobile_column=$settings['slider_mobile_column'];
			}
			for($x = 1; $x <= 6; $x++){
				if(!empty($settings["desktop_column_".$x])){
					$desktop=$settings["desktop_column_".$x]["size"].$settings["desktop_column_".$x]["unit"];			
					$tablet=$settings["desktop_column_".$x."_tablet"]["size"].$settings["desktop_column_".$x."_tablet"]["unit"];			
					$mobile=$settings["desktop_column_".$x."_mobile"]["size"].$settings["desktop_column_".$x."_mobile"]["unit"];
					$css_messy .= theplus_messy_columns($x,$layout,$uid,$desktop,$tablet,$mobile,$desktop_column,$tablet_column,$mobile_column);
				}
			}
			$css_rule ='<style>'.$css_messy.'</style>';
		}
		echo $output.$css_rule;
		wp_reset_postdata();
	}
	
    protected function content_template() {
	
    }
	Protected function get_filter_category(){
		$settings = $this->get_settings_for_display();
		
		$category_filter='';
		if($settings['filter_category']=='yes' && $settings['gallery_options']=='repeater'){
		
			$filter_style=$settings["filter_style"];
			$filter_hover_style=$settings["filter_hover_style"];
			$loop_category=array();
			$count_loop=1;
			
			foreach ( $settings['loop_gallery'] as $item ) {
				if(!empty($item['loop_category'])){
					$loop_category[]=explode(',', $item['loop_category']);						
				}
				$count_loop++;
			}
			$loop_category=theplus_array_flatten($loop_category);
			$count_category = array_count_values($loop_category);
			
			
			$all_category=$category_post_count='';			
			if($filter_style=='style-1'){
				$all_category='<span class="all_post_count">'.esc_html($count_loop).'</span>';
			}
			if($filter_style=='style-2' || $filter_style=='style-3'){
				$category_post_count='<span class="all_post_count">'.esc_html($count_loop).'</span>';
			}
			
			
			$category_filter .='<div class="post-filter-data '.esc_attr($filter_style).' text-'.esc_attr($settings['filter_category_align']).'">';
				if($filter_style=='style-4'){
					$category_filter .= '<span class="filters-toggle-link">'.esc_html__('Filters','theplus').'<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><line x1="0" y1="32" x2="63" y2="32"></line></g><polyline points="50.7,44.6 63.3,32 50.7,19.4 "></polyline><circle cx="32" cy="32" r="31"></circle></svg></span>';
				}
				$category_filter .='<ul class="category-filters '.esc_attr($filter_style).' hover-'.esc_attr($filter_hover_style).'">';
					$category_filter .= '<li><a href="#" class="filter-category-list active all" data-filter="*" >'.$category_post_count.'<span data-hover="'.esc_attr__('All','theplus').'">'.esc_html__('All','theplus').'</span>'.$all_category.'</a></li>';
					
					if ( !empty($settings['loop_gallery']) && $settings['gallery_options']=='repeater' ) {
						foreach ( $count_category as $key => $value ) {
								$slug=theplus_createSlug($key);
								$category_post_count='';
								if($filter_style=='style-2' || $filter_style=='style-3'){
									$category_post_count='<span class="all_post_count">'.esc_html($value).'</span>';
								}
								if(!empty($post_category)){
								
									if(in_array($term->term_id,$post_category)){
										$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".'.esc_attr($slug).'">'.$category_post_count.'<span data-hover="'.esc_attr($key).'">'.esc_html($key).'</span></a></li>';
										unset($term);
									}
								}else{
									$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".'.esc_attr($slug).'">'.$category_post_count.'<span data-hover="'.esc_attr($key).'">'.esc_html($key).'</span></a></li>';
									unset($term);
								}
						}
					}
				$category_filter .= '</ul>';
			$category_filter .= '</div>';
		}
		return $category_filter;
	}
	 
	protected function get_carousel_options() {
		$settings = $this->get_settings_for_display();
		$data_slider ='';
			$slider_direction = ($settings['slider_direction']=='vertical') ? 'true' : 'false';
			$data_slider .=' data-slider_direction="'.esc_attr($slider_direction).'"';
			$data_slider .=' data-slide_speed="'.esc_attr($settings["slide_speed"]["size"]).'"';
			$data_slider .=' data-default_active_slide="'.esc_attr($settings["default_active_slide"]["size"]).'"';
			
			$data_slider .=' data-slider_desktop_column="'.esc_attr($settings['slider_desktop_column']).'"';
			$data_slider .=' data-steps_slide="'.esc_attr($settings['steps_slide']).'"';
			
			$slider_draggable= ($settings["slider_draggable"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_draggable="'.esc_attr($slider_draggable).'"';
			$slider_infinite= ($settings["slider_infinite"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_infinite="'.esc_attr($slider_infinite).'"';
			$slider_pause_hover= ($settings["slider_pause_hover"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_pause_hover="'.esc_attr($slider_pause_hover).'"';
			$slider_adaptive_height= ($settings["slider_adaptive_height"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_adaptive_height="'.esc_attr($slider_adaptive_height).'"';
			$slider_autoplay= ($settings["slider_autoplay"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_autoplay="'.esc_attr($slider_autoplay).'"';
			$data_slider .=' data-autoplay_speed="'.esc_attr($settings["autoplay_speed"]["size"]).'"';
			
			//tablet
			$data_slider .=' data-slider_tablet_column="'.esc_attr($settings['slider_tablet_column']).'"';
			$data_slider .=' data-tablet_steps_slide="'.esc_attr($settings['tablet_steps_slide']).'"';
			$slider_responsive_tablet=$settings['slider_responsive_tablet'];
			$data_slider .=' data-slider_responsive_tablet="'.esc_attr($slider_responsive_tablet).'"';
			if(!empty($settings['slider_responsive_tablet']) && $settings['slider_responsive_tablet']=='yes'){				
				$tablet_slider_draggable= ($settings["tablet_slider_draggable"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_slider_draggable="'.esc_attr($tablet_slider_draggable).'"';
				$tablet_slider_infinite= ($settings["tablet_slider_infinite"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_slider_infinite="'.esc_attr($tablet_slider_infinite).'"';
				$tablet_slider_autoplay= ($settings["tablet_slider_autoplay"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_slider_autoplay="'.esc_attr($tablet_slider_autoplay).'"';
				$data_slider .=' data-tablet_autoplay_speed="'.esc_attr($settings["tablet_autoplay_speed"]["size"]).'"';
				$tablet_slider_dots= ($settings["tablet_slider_dots"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_slider_dots="'.esc_attr($tablet_slider_dots).'"';
				$tablet_slider_arrows= ($settings["tablet_slider_arrows"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_slider_arrows="'.esc_attr($tablet_slider_arrows).'"';
				$data_slider .=' data-tablet_slider_rows="'.esc_attr($settings["tablet_slider_rows"]).'"';
				$tablet_center_mode= ($settings["tablet_center_mode"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-tablet_center_mode="'.esc_attr($tablet_center_mode).'" ';
				$data_slider .=' data-tablet_center_padding="'.esc_attr($settings["tablet_center_padding"]["size"]).'" ';
			}
			
			//mobile 
			$data_slider .=' data-slider_mobile_column="'.esc_attr($settings['slider_mobile_column']).'"';
			$data_slider .=' data-mobile_steps_slide="'.esc_attr($settings['mobile_steps_slide']).'"';
			$slider_responsive_mobile=$settings['slider_responsive_mobile'];			
			$data_slider .=' data-slider_responsive_mobile="'.esc_attr($slider_responsive_mobile).'"';
			if(!empty($settings['slider_responsive_mobile']) && $settings['slider_responsive_mobile']=='yes'){
				$mobile_slider_draggable= ($settings["mobile_slider_draggable"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_slider_draggable="'.esc_attr($mobile_slider_draggable).'"';
				$mobile_slider_infinite= ($settings["mobile_slider_infinite"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_slider_infinite="'.esc_attr($mobile_slider_infinite).'"';
				$mobile_slider_autoplay= ($settings["mobile_slider_autoplay"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_slider_autoplay="'.esc_attr($mobile_slider_autoplay).'"';
				$data_slider .=' data-mobile_autoplay_speed="'.esc_attr($settings["mobile_autoplay_speed"]["size"]).'"';
				$mobile_slider_dots= ($settings["mobile_slider_dots"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_slider_dots="'.esc_attr($mobile_slider_dots).'"';
				$mobile_slider_arrows= ($settings["mobile_slider_arrows"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_slider_arrows="'.esc_attr($mobile_slider_arrows).'"';
				$data_slider .=' data-mobile_slider_rows="'.esc_attr($settings["mobile_slider_rows"]).'"';
				$mobile_center_mode= ($settings["mobile_center_mode"]=='yes') ? 'true' : 'false';
				$data_slider .=' data-mobile_center_mode="'.esc_attr($mobile_center_mode).'" ';
				$data_slider .=' data-mobile_center_padding="'.esc_attr($settings["mobile_center_padding"]["size"]).'" ';
			}
			
			$slider_dots= ($settings["slider_dots"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_dots="'.esc_attr($slider_dots).'"';
			$data_slider .=' data-slider_dots_style="slick-dots '.esc_attr($settings["slider_dots_style"]).'"';
			
			
			$slider_arrows= ($settings["slider_arrows"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_arrows="'.esc_attr($slider_arrows).'"';
			$data_slider .=' data-slider_arrows_style="'.esc_attr($settings["slider_arrows_style"]).'" ';
			$data_slider .=' data-arrows_position="'.esc_attr($settings["arrows_position"]).'" ';
			$data_slider .=' data-arrow_bg_color="'.esc_attr($settings["arrow_bg_color"]).'" ';
			$data_slider .=' data-arrow_icon_color="'.esc_attr($settings["arrow_icon_color"]).'" ';
			$data_slider .=' data-arrow_hover_bg_color="'.esc_attr($settings["arrow_hover_bg_color"]).'" ';
			$data_slider .=' data-arrow_hover_icon_color="'.esc_attr($settings["arrow_hover_icon_color"]).'" ';
			
			$slider_center_mode= ($settings["slider_center_mode"]=='yes') ? 'true' : 'false';
			$data_slider .=' data-slider_center_mode="'.esc_attr($slider_center_mode).'" ';
			$data_slider .=' data-center_padding="'.esc_attr($settings["center_padding"]["size"]).'" ';
			$data_slider .=' data-scale_center_slide="'.esc_attr($settings["scale_center_slide"]["size"]).'" ';
			$data_slider .=' data-scale_normal_slide="'.esc_attr($settings["scale_normal_slide"]["size"]).'" ';
			$data_slider .=' data-opacity_normal_slide="'.esc_attr($settings["opacity_normal_slide"]["size"]).'" ';
			
			$data_slider .=' data-slider_rows="'.esc_attr($settings["slider_rows"]).'" ';
		return $data_slider;
	}
	
}
