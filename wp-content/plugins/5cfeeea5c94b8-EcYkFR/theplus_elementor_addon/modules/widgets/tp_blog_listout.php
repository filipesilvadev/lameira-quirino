<?php 
/*
Widget Name: Blog Post Listing
Description: Different style of Blog Post listing layouts.
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


class ThePlus_Blog_ListOut extends Widget_Base {
		
	public function get_name() {
		return 'tp-blog-listout';
	}

    public function get_title() {
        return __('Blog/Post Listing', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-newspaper-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-listing');
    }
	
	public function get_style_depends() {
		return [ 'tp-columns-bootstrap','plus-blog-style' ];
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
				'label' => __( 'Content Layout', 'theplus' ),
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
			'content_alignment',
			[
				'label' => __( 'Content Alignment', 'theplus' ),
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
				],
				'default' => 'center',
				'condition' => [
					'style' => 'style-2',
					'layout!' => 'metro',
				],
				'label_block' => false,
				'toggle' => true,
			]
		);
		$this->add_control(
			'content_alignment_3',
			[
				'label' => __( 'Content Alignment', 'theplus' ),
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
					'left-right' => [
						'title' => __( 'Left/Right', 'theplus' ),
						'icon' => 'fa fa-exchange',
					],
				],
				'default' => 'left',
				'condition' => [
					'style' => 'style-3',
					'layout!' => 'metro',
				],
				'label_block' => false,
				'toggle' => true,
			]
		);
		$this->add_control(
			'style_layout',
			[
				'label' => __( 'Style Layout', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(2),
				'condition' => [
					'style' => ['style-2','style-3'],
				],
			]
		);
		$this->add_responsive_control(
            'column_min_height',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Minimum Height', 'theplus'),
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 1000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'separator' => 'after',
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .blog-list.blog-style-4:not(.list-isotope-metro) .post-content-bottom ' => 'min-height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style' => 'style-4',
					'layout!' => 'metro',
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
			'content_source_section',
			[
				'label' => __( 'Content Source', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_category',
			[
				'type' => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Select Category', 'theplus' ),
				'default'    => '',
				'multiple'   => true,
				'options' => theplus_get_categories(),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_tags',
			[
				'type' => Controls_Manager::SELECT2,
				'label'      => esc_html__( 'Select Tags', 'theplus' ),
				'default'    => '',
				'multiple'   => true,
				'options' => theplus_get_tags(),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'display_posts',
			[
				'label' => __( 'Maximum Posts Display', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 200,
				'step' => 1,
				'default' => 8,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'post_offset',
			[
				'label' => __( 'Offset Posts', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => '',
				'description' => __('Hide posts from the beginning of listing.','theplus'),
			]
		);
		$this->add_control(
			'post_order_by',
			[
				'label' => __( 'Order By', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => theplus_orderby_arr(),
			]
		);
		$this->add_control(
			'post_order',
			[
				'label' => __( 'Order', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => theplus_order_arr(),
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'post_title_tag',
			[
				'label' => __( 'Title Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => theplus_get_tags_options(),
				'separator' => 'after',
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
				'separator' => 'after',
				'condition' => [
					'layout' => ['carousel']
				],
			]
		);
		$this->add_control(
			'display_post_category',
			[
				'label' => __( 'Display Category Post', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
				'condition' => [
					'style!' => ['style-1']
				],
			]
		);
		$this->add_control(
			'post_category_style',
			[
				'label' => __( 'Post Category Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(2),
				'separator' => 'after',
				'condition'   => [
					'style!' => ['style-1'],
					'display_post_category' => 'yes',
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
			]
		);		
		$this->add_control(
			'post_excerpt_count',
			[
				'label' => __( 'Excerpt/Content Count', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 500,
				'step' => 2,
				'default' => 30,
				'separator' => 'after',
				'condition'   => [
					'display_excerpt'    => 'yes',
				],
			]
		);
		$this->add_control(
			'display_post_meta',
			[
				'label' => __( 'Display Post Meta', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'yes',
			]
		);
		$this->add_control(
			'post_meta_tag_style',
			[
				'label' => __( 'Post Meta Tag', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(3),
				'separator' => 'after',
				'condition'   => [
					'display_post_meta'    => 'yes',
				],
			]
		);
		$this->add_control(
			'display_button',
			[
				'label' => __( 'Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'default' => 'no',
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->add_control(
            'button_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Button Style', 'theplus'),
                'default' => 'style-7',
                'options' => [
                    'style-7' => __('Style 1', 'theplus'),
                    'style-8' => __('Style 2', 'theplus'),
                    'style-9' => __('Style 3', 'theplus'),                    
                ],
				'condition' => [
					'style' => 'style-3',
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_control(
			'button_text',
			[
				'label' => __( 'Text', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Read More', 'theplus' ),
				'placeholder' => __( 'Read More', 'theplus' ),
				'condition' => [
					'style' => 'style-3',
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
					'style' => 'style-3',
					'button_style!' => ['style-7','style-9'],
					'display_button' => 'yes',
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
					'style' => 'style-3',
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
					'style' => 'style-3',
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
					'style' => 'style-3',
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
					'style' => 'style-3',
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
					'layout!' => 'carousel'
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
					'filter_category'    => 'yes',
					'layout!' => 'carousel',
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
					'filter_category'    => 'yes',
					'layout!' => 'carousel',
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
					'filter_category'    => 'yes',
					'layout!' => 'carousel',
				],
			]
		);
		$this->add_control(
			'post_extra_option',
			[
				'label' => __( 'More Post Loading Options', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => theplus_post_loading_option(),
				'separator' => 'before',
				'condition' => [
					'layout!' => ['carousel']
				],
			]
		);
		//pagination style
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'label' => __( 'Pagination Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .theplus-pagination a,{{WRAPPER}} .theplus-pagination span',
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'pagination',
				],
			]
		);
		$this->add_control(
			'pagination_color',
			[
				'label' => __( 'Pagination Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .theplus-pagination a,{{WRAPPER}} .theplus-pagination span' => 'color: {{VALUE}}',
				],
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'pagination',
				],
			]
		);
		$this->add_control(
			'pagination_hover_color',
			[
				'label' => __( 'Pagination Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .theplus-pagination > a:hover,{{WRAPPER}} .theplus-pagination > a:focus,{{WRAPPER}} .theplus-pagination span.current' => 'color: {{VALUE}};border-bottom-color: {{VALUE}}',
				],
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'pagination',
				],
			]
		);
		//load more style
		$this->add_control(
			'load_more_btn_text',
			[
				'label' => __( 'Button Text', 'theplus' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Load More', 'theplus' ),
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_post',
			[
				'label' => __( 'More posts on click/scroll', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 30,
				'step' => 1,
				'default' => 4,
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => ['load_more','lazy_load']
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'load_more_typography',
				'label' => __( 'Load More Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_border',
			[
				'label' => __( 'Load More Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition'   => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		
		$this->add_control(
			'load_more_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'load_more_border_width',
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
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_load_more_border_style' );
		$this->start_controls_tab(
			'tab_load_more_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'load_more_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'load_more_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->add_control(
			'load_more_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'load_more_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
					'load_more_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->start_controls_tabs( 'tabs_load_more_style' );
		$this->start_controls_tab(
			'tab_load_more_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_color',
			[
				'label' => __( 'Text Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ajax_load_more .post-load-more' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'load_more_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);		
		$this->add_control(
			'load_more_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'load_more_shadow',
				'selector' => '{{WRAPPER}} .ajax_load_more .post-load-more',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_load_more_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_color_hover',
			[
				'label' => __( 'Text Hover Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ajax_load_more .post-load-more:hover' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'load_more_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'separator' => 'after',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_control(
			'load_more_shadow_hover_options',
			[
				'label' => __( 'Hover Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'load_more_hover_shadow',
				'selector' => '{{WRAPPER}} .ajax_load_more .post-load-more:hover',
				'condition' => [
					'layout!' => ['carousel'],
					'post_extra_option'    => 'load_more',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*post Extra options*/
		/*post meta tag*/
		$this->start_controls_section(
            'section_meta_tag_style',
            [
                'label' => __('Post Meta Tag', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_post_meta'    => 'yes',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_tag_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span',
			]
		);
		$this->start_controls_tabs( 'tabs_post_meta_style' );
		$this->start_controls_tab(
			'tab_post_meta_normal',
			[
				'label' => __( 'Normal', 'theplus' ),				
			]
		);
		$this->add_control(
			'post_meta_color',
			[
				'label' => __( 'Post Meta Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span,{{WRAPPER}} .blog-list .post-inner-loop .post-meta-info span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_post_meta_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'post_meta_color_hover',
			[
				'label' => __( 'Post Meta Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-meta-info span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'post_meta_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .blog-list.blog-style-2 .post-meta-info' => 'border-top-color: {{VALUE}}',
				],
				'condition' => [
					'style' => 'style-2'
				],
			]
		);
		$this->end_controls_section();
		/*post meta tag*/
		/*Post category*/
		$this->start_controls_section(
            'section_post_category_style',
            [
                'label' => __('Category Post', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition'   => [
					'display_post_category'    => 'yes',
					'style!' => 'style-1',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => __( 'Typography', 'theplus' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-list .post-category-list span a',
				'condition'   => [
					'display_post_category' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_category_style' );
		$this->start_controls_tab(
			'tab_category_normal',
			[
				'label' => __( 'Normal', 'theplus' ),					
			]
		);
		$this->add_control(
			'category_color',
			[
				'label' => __( 'Category Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-category-list span a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'category_hover_color',
			[
				'label' => __( 'Category Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-category-list span:hover a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'category_2_border_hover_color',
			[
				'label' => __( 'Hover Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ff214f',
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a:before' => 'background: {{VALUE}};',
				],
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-2',
				],
			]
		);
		$this->add_control(
			'category_border',
			[
				'label' => __( 'Category Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition'   => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		
		$this->add_control(
			'category_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_responsive_control(
			'box_category_border_width',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_category_border_style' );
		$this->start_controls_tab(
			'tab_category_border_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'category_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		
		$this->add_responsive_control(
			'category_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_border_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_control(
			'category_border_hover_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span:hover a' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_responsive_control(
			'category_border_hover_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span:hover a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'category_border' => 'yes',
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'category_bg_options',
			[
				'label' => __( 'Background Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_category_background_style');
		$this->start_controls_tab(
			'tab_category_background_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_background_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'category_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span:hover a',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'category_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_category_shadow_style' );
		$this->start_controls_tab(
			'tab_category_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_shadow',
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span a',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_category_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition'   => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'category_hover_shadow',
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-category-list span:hover a',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'category_inner_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-category-list.style-1 span a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
				'condition' => [
					'display_post_category' => 'yes',
					'post_category_style' => 'style-1',
				],
			]
		);
		$this->end_controls_section();
		/*Post category*/
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .post-title,{{WRAPPER}} .blog-list .post-inner-loop .post-title a',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .post-title,{{WRAPPER}} .blog-list .post-inner-loop .post-title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .post-title a' => 'color: {{VALUE}}',
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
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .entry-content',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .entry-content,{{WRAPPER}} .blog-list .post-inner-loop .entry-content p' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content,{{WRAPPER}} .blog-list .post-inner-loop .blog-list-content:hover .entry-content p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
		$this->add_responsive_control(
            'content_between_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Content Space', 'theplus'),
				'size_units' => [ 'px' , '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'separator' => 'after',
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .blog-list.blog-style-3:not(.list-isotope-metro) .content-left .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-3:not(.list-isotope-metro) .content-left-right .grid-item:nth-child(odd) .post-content-bottom' => 'padding-left: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .blog-list.blog-style-3:not(.list-isotope-metro) .content-right .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-3:not(.list-isotope-metro) .content-left-right .grid-item:nth-child(even) .post-content-bottom' => 'padding-right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'style' => 'style-3',
					'layout!' => 'metro',
				],
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
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-2 .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content',
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
				'selector' => '{{WRAPPER}} .blog-list.blog-style-1 .blog-list-content:hover .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-2 .blog-list-content:hover .post-content-bottom,{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'content_box_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_content_shadow_style' );
		$this->start_controls_tab(
			'tab_content_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition'   => [
					'style' => 'style-3',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content',
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_content_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition'   => [
					'style' => 'style-3',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_hover_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content:hover',
				'condition' => [					
					'style' => 'style-3',
				],
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
				'options' => theplus_get_style_list(1,'yes'),
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
				'selector' => '{{WRAPPER}} .blog-list .blog-list-content .blog-featured-image:before,{{WRAPPER}} .blog-list.list-isotope-metro .blog-list-content .blog-bg-image-metro:before',
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
				'selector' => '{{WRAPPER}} .blog-list .blog-list-content:hover .blog-featured-image:before,{{WRAPPER}} .blog-list.list-isotope-metro .blog-list-content:hover .blog-bg-image-metro:before',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'featured_image_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content,{{WRAPPER}} .blog-list.blog-style-3 .blog-featured-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_image_shadow_style' );
		$this->start_controls_tab(
			'tab_image_shadow_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content .blog-featured-image',
				'condition' => [
					'style' => 'style-3',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_image_shadow_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
				'condition'   => [
					'style' => 'style-3',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_hover_shadow',
				'selector' => '{{WRAPPER}} .blog-list.blog-style-3 .blog-list-content:hover .blog-featured-image',
				'condition' => [					
					'style' => 'style-3',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Post Featured Image*/
		/*button style*/
		$this->start_controls_section(
            'section_button_styling',
            [
                'label' => __('Button Style', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style-3',
					'display_button' => 'yes',
				],
            ]
        );
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [
							'top' => '15',
							'right' => '30',
							'bottom' => '15',
							'left' => '30',
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
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
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
		/*button style*/
		/*Filter Category style*/
		$this->start_controls_section(
            'section_filter_category_styling',
            [
                'label' => __('Filter Category', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'filter_category' => 'yes',
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
		$this->add_responsive_control(
			'content_inner_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
		$this->add_control(
			'border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'border-style: {{VALUE}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'box_border' => 'yes',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content',
				
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
				'name'      => 'box_active_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover',
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content',
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
				'selector' => '{{WRAPPER}} .blog-list .post-inner-loop .grid-item .blog-list-content:hover',
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
				'render_type' => 'ui',
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
				'render_type' => 'ui',
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
				'selector' => '{{WRAPPER}} .list-carousel-slick .slick-slide.slick-current.slick-active.slick-center .blog-list-content',
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
				'render_type' => 'ui',
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
			'messy_column',
			[
				'label' => __( 'Messy Columns', 'theplus' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),				
				'default' => 'no',
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
		$query = $this->get_query_args();
		$style=$settings["style"];
		$layout=$settings["layout"];
		$post_title_tag=$settings["post_title_tag"];
		$post_category=$settings['post_category'];
		$post_tags=$settings['post_tags'];
		
		$featured_image_type=(!empty($settings["featured_image_type"])) ? $settings["featured_image_type"] : 'full';
		
		$display_post_meta=$settings["display_post_meta"];
		$post_meta_tag_style=$settings["post_meta_tag_style"];
		
		$display_excerpt=$settings["display_excerpt"];
		$post_excerpt_count=$settings["post_excerpt_count"];
		
		$display_post_category=$settings["display_post_category"];
		$post_category_style=$settings["post_category_style"];
		
		$content_alignment_3=($settings["content_alignment_3"]!='') ? 'content-'.$settings["content_alignment_3"] : '';
		
		$content_alignment=($settings["content_alignment"]!='') ? 'text-'.$settings["content_alignment"] : '';
		$style_layout=($settings["style_layout"]!='') ? 'layout-'.$settings["style_layout"] : '';
		
		
		$button_style = $settings['button_style'];
		$before_after = $settings['before_after'];
		$button_text = $settings['button_text'];
		$button_icon_style = $settings['button_icon_style'];
		$button_icon = $settings['button_icon'];
		$button_icons_mind = $settings['button_icons_mind'];
		
		
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
			if(isset($settings["metro_style_".$metro_columns]) && !empty($settings["metro_style_".$metro_columns])){
				$layout_attr .=' data-metro-style="'.esc_attr($settings["metro_style_".$metro_columns]).'" ';
			}
			if(!empty($settings["responsive_tablet_metro"]) && $settings["responsive_tablet_metro"]=='yes'){
				$tablet_metro_column=$settings["tablet_metro_column"];
				$layout_attr .=' data-tablet-metro-columns="'.esc_attr($tablet_metro_column).'" ';
				if(isset($settings["tablet_metro_style_".$tablet_metro_column]) && !empty($settings["tablet_metro_style_".$tablet_metro_column])){
					$layout_attr .=' data-tablet-metro-style="'.esc_attr($settings["tablet_metro_style_".$tablet_metro_column]).'" ';
				}
			}
		}
		
		$data_class .=' blog-'.$style;
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
		if($settings['filter_category']=='yes'){
			$data_class .=' pt-plus-filter-post-category ';
		}
		
		$ji=1;$ij='';
		$uid=uniqid("post");
		if(!empty($settings["carousel_unique_id"])){
			$uid="tpca_".$settings["carousel_unique_id"];
		}
		$data_attr .=' data-id="'.esc_attr($uid).'"';
		$data_attr .=' data-style="'.esc_attr($style).'"';
		$tablet_metro_class=$tablet_ij='';
		
		
		
		if ( ! $query->have_posts() ) {
			$output .='<h3 class="theplus-posts-not-found">'.esc_html__( "Posts not found", "theplus" ).'</h3>';
		}else{
			$output .= '<div id="pt-plus-blog-post-list" class="blog-list '.esc_attr($uid).' '.esc_attr($data_class).' '.esc_attr($style_layout).' '.$animated_class.'" '.$layout_attr.' '.$data_attr.' '.$animation_attr.' data-enable-isotope="1">';
			
			//category filter
			if($settings['filter_category']=='yes'){
				$output .= $this->get_filter_category();
			}
			
			$output .= '<div id="'.esc_attr($uid).'" class="tp-row post-inner-loop '.esc_attr($uid).' '.esc_attr($content_alignment).' '.esc_attr($content_alignment_3).'">';
			while ( $query->have_posts() ) {
			
				$query->the_post();
				$post = $query->post;
				
				//read more button
				$the_button=$button_attr='';
				if($settings['display_button'] == 'yes'){
					$button_attr='button'.$ji;
					if ( ! empty( get_the_permalink() ) ) {
						$this->add_render_attribute( $button_attr, 'href', get_the_permalink() );
						$this->add_render_attribute( $button_attr, 'rel', 'nofollow' );						
					}
					
					$this->add_render_attribute( $button_attr, 'class', 'button-link-wrap' );
					$this->add_render_attribute( $button_attr, 'role', 'button' );
					
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
										$the_button .='<a '.$this->get_render_attribute_string( $button_attr ).'>';
										$the_button .= include THEPLUS_PATH. 'includes/blog/post-button.php'; 
										$the_button .='</a>';
									$the_button .='</div>';
								$the_button .='</div>';
							$the_button .='</div>';
						$the_button .='</div>';
					$the_button .='</div>';	
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
				//category filter
				$category_filter='';
				if($settings['filter_category']=='yes'){				
					 $terms = get_the_terms( $query->ID,'category');
					if ( $terms != null ){
						foreach( $terms as $term ) {
							$category_filter .=' '.esc_attr($term->slug).' ';
							unset($term);
						}
					}
				}
				//grid item loop
				$output .= '<div class="grid-item metro-item'.esc_attr($ij).' '.esc_attr($tablet_metro_class).' '.$desktop_class.' '.$tablet_class.' '.$mobile_class.' '.$category_filter.' '.$animated_columns.'">';				
				if(!empty($style)){
					ob_start();
					include THEPLUS_PATH. 'includes/blog/blog-'.esc_attr($style).'.php'; 
					$output .= ob_get_contents();
					ob_end_clean();
				}
				$output .='</div>';
				
				$ji++;
			}
			$output .='</div>';
			
			//Extra Options pagination/load more/lazy load
			$metro_style=$tablet_metro_style=$tablet_metro_column=$responsive_tablet_metro='no';
			if($layout=='metro'){
				$metro_columns=$settings['metro_column'];
				if(!empty($settings["metro_style_".$metro_columns])){
					$metro_style=$settings["metro_style_".$metro_columns];
				}
				$responsive_tablet_metro=(!empty($settings["responsive_tablet_metro"])) ? $settings["responsive_tablet_metro"] : 'no';
				$tablet_metro_column=$settings["tablet_metro_column"];
				if(!empty($settings["tablet_metro_style_".$tablet_metro_column])){
					$tablet_metro_style=$settings["tablet_metro_style_".$tablet_metro_column];
				}
			}
			$button_attr='';
			if($settings['display_button'] == 'yes'){
				$button_attr .= ' data-display_button="'.$settings['display_button'].'"';
				$button_attr .= ' data-button_style="'.$settings['button_style'].'"';
				$button_attr .= ' data-before_after="'.$settings['before_after'].'"';
				$button_attr .= ' data-button_text="'.$settings['button_text'].'"';
				$button_attr .= ' data-button_icon_style="'.$settings['button_icon_style'].'"';
				$button_attr .= ' data-button_icon="'.$settings['button_icon'].'"';
				$button_attr .= ' data-button_icons_mind="'.$settings['button_icons_mind'].'"';
			}
			if(!empty($post_category)){
				$post_category=implode(',', $post_category);
			}
			if(!empty($post_tags)){
				$post_tags=implode(',', $post_tags);
			}
			if($settings['post_extra_option']=='pagination' && $layout!='carousel'){
				$output .= theplus_pagination($query->max_num_pages,'2');
			}else if($settings['post_extra_option']=='load_more' && $layout!='carousel'){
				
					$output .= '<div class="ajax_load_more">';
						$output .= '<a class="post-load-more" data-load="blogs" data-post_type="post" data-texonomy_category="cat" data-load-class="'.esc_attr($uid).'" data-layout="'.$layout.'" data-style="'.esc_attr($style).'" data-style_layout="'.esc_attr($style_layout).'" data-desktop-column="'.esc_attr($settings['desktop_column']).'" data-tablet-column="'.esc_attr($settings['tablet_column']).'" data-mobile-column="'.esc_attr($settings['mobile_column']).'" data-metro_column="'.esc_attr($settings['metro_column']).'" data-metro_style="'.esc_attr($metro_style).'" data-responsive_tablet_metro="'.esc_attr($responsive_tablet_metro).'" data-tablet_metro_column="'.esc_attr($tablet_metro_column).'" data-tablet_metro_style="'.esc_attr($tablet_metro_style).'"  data-offset-posts="'.($settings['post_offset']).'" data-category="'.esc_attr($post_category).'"  data-post_tags="'.esc_attr($post_tags).'" data-order_by="'.esc_attr($settings['post_order_by']).'" data-post_order="'.esc_attr($settings['post_order']).'" data-filter_category="'.esc_attr($settings['filter_category']).'" data-display_post="'.esc_attr($settings['display_posts']).'" data-animated_columns="'.esc_attr($animated_columns).'" data-post_load_more="'.esc_attr($settings['load_more_post']).'" data-page="1" data-total_page="'.esc_attr($query->max_num_pages).'" data-display_post_meta="'.$display_post_meta.'" data-post_meta_tag_style="'.$post_meta_tag_style.'" data-display_excerpt="'.$display_excerpt.'" data-post_excerpt_count="'.$post_excerpt_count.'" data-display_post_category="'.$display_post_category.'" data-post_category_style="'.$post_category_style.'" data-featured_image_type="'.$featured_image_type.'" '.$button_attr.'>'.esc_html($settings['load_more_btn_text']).'</a>';					
					$output .= '</div>';					
			}else if($settings['post_extra_option']=='lazy_load' && $layout!='carousel'){
				
					$output .= '<div class="ajax_lazy_load">';
						$output .= '<a class="post-lazy-load" data-load="blogs" data-post_type="post" data-texonomy_category="cat" data-load-class="'.esc_attr($uid).'" data-layout="'.$layout.'" data-style="'.esc_attr($style).'" data-style_layout="'.esc_attr($style_layout).'" data-desktop-column="'.esc_attr($settings['desktop_column']).'" data-tablet-column="'.esc_attr($settings['tablet_column']).'" data-mobile-column="'.esc_attr($settings['mobile_column']).'" data-metro_column="'.esc_attr($settings['metro_column']).'" data-metro_style="'.esc_attr($metro_style).'" data-responsive_tablet_metro="'.esc_attr($responsive_tablet_metro).'" data-tablet_metro_column="'.esc_attr($tablet_metro_column).'" data-tablet_metro_style="'.esc_attr($tablet_metro_style).'"  data-offset-posts="'.($settings['post_offset']).'"  data-category="'.esc_attr($post_category).'"  data-post_tags="'.esc_attr($post_tags).'" data-order_by="'.esc_attr($settings['post_order_by']).'" data-post_order="'.esc_attr($settings['post_order']).'" data-filter_category="'.esc_attr($settings['filter_category']).'" data-display_post="'.esc_attr($settings['display_posts']).'" data-animated_columns="'.esc_attr($animated_columns).'" data-post_load_more="'.esc_attr($settings['load_more_post']).'" data-page="1" data-total_page="'.esc_attr($query->max_num_pages).'"  data-display_post_meta="'.$display_post_meta.'" data-post_meta_tag_style="'.$post_meta_tag_style.'" data-display_excerpt="'.$display_excerpt.'" data-post_excerpt_count="'.$post_excerpt_count.'" data-display_post_category="'.$display_post_category.'" data-post_category_style="'.$post_category_style.'" data-featured_image_type="'.$featured_image_type.'" '.$button_attr.'><img src="'.THEPLUS_ASSETS_URL. 'images/lazy_load.gif" /></a>';
						$output .= '</div>';
				}
			$output .='</div>';
		}
		
		$css_rule =$css_messy='';
		if($settings['messy_column']=='yes'){
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
		$query = $this->get_query_args();
		$post_category=$settings['post_category'];
		
		$category_filter='';
		if($settings['filter_category']=='yes'){
		
			$filter_style=$settings["filter_style"];
			$filter_hover_style=$settings["filter_hover_style"];
			
			$terms = get_terms( array('taxonomy' => 'category', 'hide_empty' => true) );
			$all_category=$category_post_count='';
			
			if($filter_style=='style-1'){
				$count=$query->post_count;
				$all_category='<span class="all_post_count">'.esc_html($count).'</span>';
			}
			if($filter_style=='style-2' || $filter_style=='style-3'){
				$count=$query->post_count;
				$category_post_count='<span class="all_post_count">'.esc_attr($count).'</span>';
			}
			
			$category_filter .='<div class="post-filter-data '.esc_attr($filter_style).' text-'.esc_attr($settings['filter_category_align']).'">';
				if($filter_style=='style-4'){
					$category_filter .= '<span class="filters-toggle-link">'.esc_html__('Filters','theplus').'<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve"><g><line x1="0" y1="32" x2="63" y2="32"></line></g><polyline points="50.7,44.6 63.3,32 50.7,19.4 "></polyline><circle cx="32" cy="32" r="31"></circle></svg></span>';
				}
				$category_filter .='<ul class="category-filters '.esc_attr($filter_style).' hover-'.esc_attr($filter_hover_style).'">';
					$category_filter .= '<li><a href="#" class="filter-category-list active all" data-filter="*" >'.$category_post_count.'<span data-hover="'.esc_attr__('All','theplus').'">'.esc_html__('All','theplus').'</span>'.$all_category.'</a></li>';
					
					if ( $terms != null ){
						foreach( $terms as $term ) {
							$category_post_count='';
							if($filter_style=='style-2' || $filter_style=='style-3'){
								$category_post_count='<span class="all_post_count">'.esc_html($term->count).'</span>';
							}
							if(!empty($post_category)){
							
								if(in_array($term->term_id,$post_category)){
									$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".'.esc_attr($term->slug).'">'.$category_post_count.'<span data-hover="'.esc_attr($term->name).'">'.esc_html($term->name).'</span></a></li>';
									unset($term);
								}
							}else{
								$category_filter .= '<li><a href="#" class="filter-category-list"  data-filter=".'.esc_attr($term->slug).'">'.$category_post_count.'<span data-hover="'.esc_attr($term->name).'">'.esc_html($term->name).'</span></a></li>';
								unset($term);
							}
						}
					}
				$category_filter .= '</ul>';
			$category_filter .= '</div>';
		}
		return $category_filter;
	}
	protected function get_query_args() {
		$settings = $this->get_settings_for_display();
		$query_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => intval( $settings['display_posts'] ),
			'orderby'      =>  $settings['post_order_by'],
			'order'      => $settings['post_order'],
		);

		$offset = $settings['post_offset'];
		$offset = ! empty( $offset ) ? absint( $offset ) : 0;

		if ( $offset  && $settings['post_extra_option']!='pagination') {
			$query_args['offset'] = $offset;
		}
		if ( '' !== $settings['post_category'] ) {
			
			$query_args['category__in'] = $settings['post_category'];
		}
		if ( '' !== $settings['post_tags'] ) {
			$query_args['tag__in'] = $settings['post_tags'];
		}
		global $paged;
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		}
		elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		}
		else {
			$paged = 1;
		}
		$query_args['paged'] = $paged;
		
		$query = new \WP_Query( $query_args );
		
		return $query;
	}
	
	protected function get_carousel_options() {
		$settings = $this->get_settings_for_display();
		$data_slider ='';
			$slider_direction = ($settings['slider_direction']=='vertical') ? 'true' : 'false';
			$data_slider .=' data-slider_direction="'.esc_attr($slider_direction).'"';
			$data_slider .=' data-slide_speed="'.esc_attr($settings["slide_speed"]["size"]).'"';
			
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
