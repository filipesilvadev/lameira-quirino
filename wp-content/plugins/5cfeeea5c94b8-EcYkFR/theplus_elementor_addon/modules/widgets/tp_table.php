<?php 
/*
Widget Name: Table
Description: Content of table.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Data_Table extends Widget_Base {
		
	public function get_name() {
		return 'tp-table';
	}

    public function get_title() {
        return __('Table', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-table theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts','plus-datatable',
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'section_table_header',
			[
				'label' => __( 'Table Header', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		// Repeater object created.
		$repeater = new \Elementor\Repeater();

			// Content Type Row/Col.
		$repeater->add_control(
			'header_content_type',
			[
				'label'   => __( 'Action', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cell',
				'options' => [
					'row'  => __( 'Start New Row', 'theplus' ),
					'cell' => __( 'Cell Content', 'theplus' ),
				],
			]
		);
		// Table heading border Row/Cell Note.
		$repeater->add_control(
			'add_head_cell_row_description',
			[
				'label'     => '',
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => [
					'active' => true,
				],
				'type'      => Controls_Manager::RAW_HTML,
				'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', __( 'Your new row have been initiated. Add content of cells by selecting <b>"Cell Content"</b> in your next repeater tab.', 'theplus' ) ),
				'condition' => [
					'header_content_type' => 'row',
				],
			]
		);
		$repeater->start_controls_tabs( 'items_repeater' );

			// Start control content tab.
		$repeater->start_controls_tab(
			'tab_head_content',
			[
				'label'     => __( 'CONTENT', 'theplus' ),
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);
		$repeater->add_control(
			'heading_text',
			[
				'label'     => __( 'Text', 'theplus' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);
		$repeater->end_controls_tab();

			// Start control content tab.
			$repeater->start_controls_tab(
				'tab_head_icon',
				[
					'label'     => __( 'ICON / IMAGE', 'theplus' ),
					'condition' => [
						'header_content_type' => 'cell',
					],
				]
		);
		$repeater->add_control(
			'header_content_icon_image',
			[
				'label'   => __( 'Select', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'theplus' ),
					'icon' => __( 'Icon', 'theplus' ),
					'image' => __( 'Image', 'theplus' ),
				],
			]
		);
		$repeater->add_control(
			'icons_image',
			[
				'label' => __( 'Use Image As icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'media_type' => 'image',
				'condition' => [					
					'header_content_icon_image' => 'image',
				],
			]
		);
		$repeater->add_control(
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
					'header_content_icon_image' => 'icon',
				],
			]
		);
		$repeater->add_control(
			'icon_fontawesome',
			[
				'label' => __( 'Icon Library', 'theplus' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-bank',
				'condition' => [			
					'header_content_icon_image' => 'icon',
					'icon_font_style' => 'font_awesome',
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
					'header_content_icon_image' => 'icon',
					'icon_font_style' => 'icon_mind',
				],
			]
		);
		$repeater->end_controls_tab();
		// Start control content tab.
		$repeater->start_controls_tab(
			'tab_head_advance',
			[
				'label'     => __( 'ADVANCE', 'theplus' ),
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);
		$repeater->add_control(
			'heading_col_span',
			[
				'label'     => __( 'Column Span', 'theplus' ),
				'title'     => __( 'Number of columns for this column span.', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);

		// Cell row Span.
		$repeater->add_control(
			'heading_row_span',
			[
				'label'     => __( 'Row Span', 'theplus' ),
				'title'     => __( 'Number of rows for this column span. Note : Put Row Span first and Column Span second in list.', 'theplus' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'separator' => 'below',
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);

		// Cell row Span.
		$repeater->add_control(
			'heading_row_width',
			[
				'label'      => __( 'Column Width', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', '%' ],
				'separator'  => 'below',
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}.plus-table-col' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition'  => [
					'header_content_type' => 'cell',
				],
			]
		);

		// Single Header Text Color.
		$repeater->add_control(
			'single_heading_color',
			[
				'label'     => __( 'Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-table-row {{CURRENT_ITEM}} .plus-table__text' => 'color: {{VALUE}};',
				],
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);

		// Single Header Background Color.
		$repeater->add_control(
			'single_heading_background_color',
			[
				'label'     => __( 'Background Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} thead .plus-table-row {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'header_content_type' => 'cell',
				],
			]
		);

		$repeater->end_controls_tab();
		$repeater->end_controls_tab();
		
		$this->add_control(
			'table_headings',
			[
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{ header_content_type }}: {{{ heading_text }}}',
				'default'     => [
					[
						'header_content_type' => 'row',
					],
					[
						'header_content_type' => 'cell',
						'heading_text'        => __( 'ID', 'theplus' ),
					],
					[
						'header_content_type' => 'cell',
						'heading_text'        => __( 'Title 1', 'theplus' ),
					],
					[
						'header_content_type' => 'cell',
						'heading_text'        => __( 'Title 2', 'theplus' ),
					],
				],
			]
		);		
		$this->end_controls_section();
		/*Table Header*/
		/*Table Content*/
		// Table content.
		$this->start_controls_section(
			'section_table_content',
			[
				'label'     => __( 'Table Body', 'theplus' ),
			]
		);

		// Repeater obj for content.
		$repeater_content = new \Elementor\Repeater();

		// Content Type Row/Col.
		$repeater_content->add_control(
			'content_type',
			[
				'label'   => __( 'Action', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cell',
				'options' => [
					'row'  => __( 'Start New Row', 'theplus' ),
					'cell' => __( 'Cell Content', 'theplus' ),
				],
			]
		);

		// Table heading border Row/Cell Note.
		$repeater_content->add_control(
			'add_body_cell_row_description',
			[
				'type'      => Controls_Manager::RAW_HTML,
				'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', __( 'Your new row have been initiated. Add content of cells by selecting <b>"Cell Content"</b> in your next repeater tab.', 'theplus' ) ),
				'condition' => [
					'content_type' => 'row',
				],
			]
		);

		// Start control tab.
		$repeater_content->start_controls_tabs( 'items_repeater' );

			// Start control content tab.
			$repeater_content->start_controls_tab(
				'tab_content',
				[
					'label'     => __( 'Content', 'theplus' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

				// Single Cell text.
				$repeater_content->add_control(
					'cell_text',
					[
						'label'     => __( 'Text', 'theplus' ),
						'type'      => Controls_Manager::TEXTAREA,
						'dynamic'   => [
							'active' => true,
						],
						'condition' => [
							'content_type' => 'cell',
						],
					]
				);

				// Single Cell LINK.
				$repeater_content->add_control(
					'link',
					[
						'label'       => __( 'Link', 'theplus' ),
						'type'        => Controls_Manager::URL,
						'placeholder' => '#',
						'dynamic'     => [
							'active' => true,
						],
						'default'     => [
							'url' => '',
						],
						'condition'   => [
							'content_type' => 'cell',
						],
					]
				);
				$repeater_content->add_control(
					'cell_display_button',
					[
						'label' => __( 'Button', 'theplus' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'theplus' ),
						'label_off' => __( 'Hide', 'theplus' ),
						'default' => 'no',
						'condition'   => [
							'content_type' => 'cell',
						],
						'separator' => 'before',
					]
				);
				$repeater_content->add_control(
					'cell_button_style', [
						'type' => Controls_Manager::SELECT,
						'label' => __('Button Style', 'theplus'),
						'default' => 'style-8',
						'options' => [						
							'style-8' => __('Style 1', 'theplus'),							
						],
						'condition' => [
							'content_type' => 'cell',
							'cell_display_button' => 'yes',
						],
					]
				);
				$repeater_content->add_control(
					'cell_button_text',
					[
						'label' => __( 'Button Text', 'theplus' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Click here', 'theplus' ),
						'condition' => [
							'content_type' => 'cell',
							'cell_display_button' => 'yes',
						],
					]
				);
				$repeater_content->add_control(
					'cell_button_link',
					[
						'label' => __( 'URL/Link', 'theplus' ),
						'type' => Controls_Manager::URL,						
						'show_external' => true,
						'default' => [
							'url' => '',
							'is_external' => true,
							'nofollow' => true,
						],
						'condition' => [
							'content_type' => 'cell',
							'cell_display_button' => 'yes',
						],
					]
				);
			// End Content control tab.
			$repeater_content->end_controls_tab();

			// Start Media Tab.
			$repeater_content->start_controls_tab(
				'tab_media',
				[
					'label'     => __( 'ICON / IMAGE', 'theplus' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

				// Content Type Icon/Image.
				$repeater_content->add_control(
					'cell_content_icon_image',
					[
						'label'   => __( 'Select', 'theplus' ),
						'type'    => Controls_Manager::SELECT,
						'default' => 'none',
						'options' => [
							'none' => __( 'None', 'theplus' ),
							'icon' => __( 'Icon', 'theplus' ),
							'image' => __( 'Image', 'theplus' ),
						],
					]
				);
				//select icon font style
				$repeater_content->add_control(
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
							'content_type'            => 'cell',
							'cell_content_icon_image' => 'icon',
						],
					]
				);
				// Single Cell Icon.				
				$repeater_content->add_control(
					'cell_icon',
					[
						'label'       => __( 'Icon', 'theplus' ),
						'type'        => Controls_Manager::ICON,
						'label_block' => false,
						'default'     => '',
						'condition'   => [
							'content_type'            => 'cell',
							'icon_font_style'            => 'font_awesome',
							'cell_content_icon_image' => 'icon',
						],
					]
				);
				$repeater_content->add_control(
					'cell_icons_mind',
					[
						'label' => __( 'Icon Minds', 'theplus' ),
						'type' => Controls_Manager::SELECT2,
						'default' => '',
						'options' => theplus_icons_mind(),
						'condition' => [				
							'content_type'            => 'cell',
							'cell_content_icon_image' => 'icon',
							'icon_font_style' => 'icon_mind',
						],
					]
				);
				$repeater_content->add_control(
					'cell_icon_color',
					[
						'label' => __( 'Icon Color', 'theplus' ),
						'type' => Controls_Manager::COLOR,
						'condition' => [				
							'content_type'            => 'cell',
							'cell_content_icon_image' => 'icon',
						],
						'selectors' => [
							'{{WRAPPER}} .plus-table-row td.plus-table-col{{CURRENT_ITEM}} .plus-table__text i' => 'color: {{VALUE}};',
						],
					]
				);
				// Single Add Image.
				$repeater_content->add_control(
					'image',
					[
						'label'     => __( 'Choose Image', 'theplus' ),
						'type'      => Controls_Manager::MEDIA,
						'dynamic'   => [
							'active' => true,
						],
						'condition' => [
							'content_type'            => 'cell',
							'cell_content_icon_image' => 'image',
						],
					]
				);

			// End Media control tab.
			$repeater_content->end_controls_tab();

			// Start Media Tab.
			$repeater_content->start_controls_tab(
				'tab_advance_cells',
				[
					'label'     => __( 'Advance', 'theplus' ),
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell Column Span.
			$repeater_content->add_control(
				'cell_span',
				[
					'label'     => __( 'Column Span', 'theplus' ),
					'title'     => __( 'Number of columns for this column span.', 'theplus' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 1,
					'min'       => 1,
					'max'       => 20,
					'step'      => 1,
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell row Span.
			$repeater_content->add_control(
				'cell_row_span',
				[
					'label'     => __( 'Row Span', 'theplus' ),
					'title'     => __( 'Number of rows for this column span.', 'theplus' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => 1,
					'min'       => 1,
					'max'       => 20,
					'step'      => 1,
					'separator' => 'below',
					'condition' => [
						'content_type' => 'cell',
					],
				]
			);

			// Cell Column Span.
			$repeater_content->add_control(
				'table_th_td',
				[
					'label'       => __( 'Mark this cell as a Table Heading?', 'theplus' ),
					'type'        => Controls_Manager::SELECT,
					'options'     => [
						'td' => __( 'No', 'theplus' ),
						'th' => __( 'Yes', 'theplus' ),
					],
					'default'     => 'td',
					'condition'   => [
						'content_type' => 'cell',
					],
					'label_block' => true,
				]
			);

			// End Media control tab.
			$repeater_content->end_controls_tab();

		// End control tab.
		$repeater_content->end_controls_tabs();

		// Repeater set default values.
		$this->add_control(
			'table_content',
			[
				'type'        => Controls_Manager::REPEATER,
				'default'     => [
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Sample #1', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 1, Content 1', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 1, Content 2', 'theplus' ),
					],
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Sample #2', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 2, Content 1', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 2, Content 2', 'theplus' ),
					],
					[
						'content_type' => 'row',
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Sample #3', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 3, Content 1', 'theplus' ),
					],
					[
						'content_type' => 'cell',
						'cell_text'    => __( 'Row 3, Content 2', 'theplus' ),
					],
				],
				'fields'      => array_values( $repeater_content->get_controls() ),
				'title_field' => '{{ content_type }}: {{{ cell_text }}}',
			]
		);

		$this->end_controls_section();
		/*Table Content*/
		/*Table Extra Option*/
		$this->start_controls_section(
			'section_advance_settings',
			[
				'label' => __( 'Extra Settings', 'theplus' ),
			]
		);

			
			// Searchable Table Switcher.
			$this->add_control(
				'searchable',
				[
					'label'        => __( 'Table Searchable', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'theplus' ),
					'label_off'    => __( 'Off', 'theplus' ),					
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);
			// Sortable Table Switcher.
			$this->add_control(
				'sortable',
				[
					'label'        => __( 'Table Sortable', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'theplus' ),
					'label_off'    => __( 'Off', 'theplus' ),					
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);

			$this->add_control(
				'searchable_label',
				[
					'label' => __( 'Search Field Label', 'theplus' ),
					'type' => Controls_Manager::TEXT,
					'default' => __( 'Search', 'theplus' ),					
					'condition'   => [
						'searchable' => 'yes',
					],
				]
			);
			$this->add_control(
				'show_entries',
				[
					'label'        => __( 'Entry Filter Dropdown', 'theplus' ),
					'description'  => __( 'Controls the number of entries in a table.', 'theplus' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'On', 'theplus' ),
					'label_off'    => __( 'Off', 'theplus' ),
					'return_value' => 'yes',
					'default'      => 'no',
				]
			);
			$this->add_control(
				'mobile_responsive_table',
				[
					'label' => __( 'Mobile Responsive', 'theplus' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'default',
					'options' => [
						'default'  => __( 'Swipe Responsive', 'theplus' ),
						'one-by-one' => __( 'One by One Responsive', 'theplus' ),
					],
				]
			);

		$this->end_controls_section();
		/*Table Extra Option*/
		/*Table Header Style*/
		$this->start_controls_section(
			'section_header_style',
			[
				'label' => __( 'Table Header', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		// Header text alignment.
		$this->add_responsive_control(
			'cell_align_head',
			[
				'label'     => __( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} th .plus-table__text' => 'text-align: {{VALUE}};width: 100%;',
				],
			]
		);
		// Header typography.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'header_typography',
				'label'    => __( 'Typography', 'theplus' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} th.plus-table-col',
			]
		);

		// Header padding.
		$this->add_responsive_control(
			'cell_padding_head',
			[
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} th.plus-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		

		// Header tabs starts here.
		$this->start_controls_tabs( 'tabs_header_colors_row' );

			// Header Default tab starts.
			$this->start_controls_tab( 'tab_header_colors_row', [ 'label' => __( 'Normal', 'theplus' ) ] );

				// Header row color default.
				$this->add_control(
					'header_cell_color_row',
					[
						'label'     => __( 'Row Text Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_3,
						],
						'selectors' => [
							'{{WRAPPER}} thead .plus-table-row th .plus-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} th' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .plus-table-row th' => 'color: {{VALUE}};',							
						],
					]
				);

				// Header row background color default.
				$this->add_control(
					'header_cell_background_row',
					[
						'label'     => __( 'Row Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .plus-table-row th' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} tbody .plus-table-row th' => 'background-color: {{VALUE}};',							
						],
					]
				);

				// Advanced Setting for header Switcher.
				$this->add_control(
					'header_border_styling',
					[
						'label'        => __( 'Apply Border To', 'theplus' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => __( 'CELL', 'theplus' ),
						'label_off'    => __( 'ROW', 'theplus' ),
						'return_value' => 'yes',
						'default'      => 'yes',
						'prefix_class' => 'plus-border-',
					]
				);

				// Header row border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'row_border_head',
						'label'          => __( 'Row Border', 'theplus' ),
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'selector'       => '{{WRAPPER}} thead tr.plus-table-row, {{WRAPPER}} tbody .plus-table-row th',
						'condition'      => [
							'header_border_styling!' => 'yes',
						],
					]
				);

				// Header Cell border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'cell_border_head',
						'label'          => __( 'Cell Border', 'theplus' ),
						'selector'       => '{{WRAPPER}} th.plus-table-col',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'header_border_styling' => 'yes',
						],
					]
				);

			$this->end_controls_tab();

			// Tab header hover.
			$this->start_controls_tab( 'tab_header_hover_colors_row', [ 'label' => __( 'Hover', 'theplus' ) ] );

				// Header text row color hover.
				$this->add_control(
					'header_cell_hover_color_row',
					[
						'label'     => __( 'Row Text Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .plus-table-row:hover .plus-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .plus-table-row:hover th .plus-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} .plus-table-row:hover th' => 'color: {{VALUE}};',
						],
					]
				);

				// Header row background color hover.
				$this->add_control(
					'header_cell_hover_background_row',
					[
						'label'     => __( 'Row Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .plus-table-row:hover > th' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .plus-table tbody .plus-table-row:hover > th' => 'background-color: {{VALUE}};',
						],
					]
				);

				// Header cell hover text color.
				$this->add_control(
					'header_cell_hover_color',
					[
						'label'     => __( 'Cell Hover Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead th.plus-table-col:hover .plus-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tbody .plus-table-row th.plus-table-col:hover .plus-table__text' => 'color: {{VALUE}};',
							'{{WRAPPER}} tr.plus-table-row th.plus-table-col:hover' => 'color: {{VALUE}};',
						],
					]
				);

				// Header cell hover background color.
				$this->add_control(
					'header_cell_hover_background',
					[
						'label'     => __( 'Cell Hover Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} thead .plus-table-row th.plus-table-col:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} .plus-table tbody .plus-table-row:hover >  th.plus-table-col:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		/*Table Header Style*/
		/*Table Header Mobile Style*/
		$this->start_controls_section(
			'section_table_mobile_res_style',
			[
				'label' => __( 'Header Mobile Responsive Style', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'      => [
					'mobile_responsive_table' => 'one-by-one',
				],
			]
		);
		// Header text alignment.
		$this->add_control(
			'mob_cell_align_head',
			[
				'label'     => __( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'text-align: {{VALUE}};width: 100%;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'mob_header_typography',
				'label'    => __( 'Typography', 'theplus' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row',
			]
		);
		$this->add_responsive_control(
			'mob_cell_padding',
			[
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row,{{WRAPPER}} .plus-table-mob-res .plus-table-mob-wrap span.plus-table__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'mob_cell_head_width',
			[
				'label' => __( 'Heading Cell Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 120,
				],
				'selectors' => [
					'{{WRAPPER}} .plus-table.plus-table-mob-res .plus-table-mob-wrap span.plus-table-mob-row' => '-webkit-flex-basis: {{SIZE}}{{UNIT}};-ms-flex-preferred-size: {{SIZE}}{{UNIT}};flex-basis: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->start_controls_tabs( 'tabs_mob_head_colors_row' );

			// Header Default tab starts.
			$this->start_controls_tab( 'tab_mob_head_colors_row', [ 'label' => __( 'Normal', 'theplus' ) ] );

				// Header row color default.
				$this->add_control(
					'mob_head_cell_color_row',
					[
						'label'     => __( 'Heading Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_3,
						],
						'selectors' => [
							'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'color: {{VALUE}};',
						],
					]
				);

				// Header row background color default.
				$this->add_control(
					'mob_head_cell_background_row',
					[
						'label'     => __( 'Heading Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'background-color: {{VALUE}};',		
						],
					]
				);
				$this->add_responsive_control(
					'mob_cell_border_width',
					[
						'label' => __( 'Border Width', 'theplus' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ 'px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 20,
								'step' => 1,
							],
						],
						'mobile_default' => [
							'size' => 1,
							'unit' => 'px',
						],
						'devices' => [ 'mobile' ],
						'selectors' => [
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody tr td.plus-table-col' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
							'{{WRAPPER}} .plus-table-mob-wrap span.plus-table-mob-row' => 'border-right-width: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-width: {{SIZE}}{{UNIT}};',
						],
					]
				);
				$this->add_responsive_control(
					'mob_cell_border_color',
					[
						'label'     => __( 'Cell Border Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'devices' => [ 'mobile' ],
						'selectors' => [
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody tr td.plus-table-col' => 'border-bottom-color: {{VALUE}} !important;',				
							'{{WRAPPER}} .plus-table-mob-wrap span.plus-table-mob-row' => 'border-right-color: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'mob_row_border_color',
					[
						'label'     => __( 'Row Border Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'devices' => [ 'mobile' ],
						'selectors' => [
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-color: {{VALUE}};',
						],
					]
				);
				$this->add_responsive_control(
					'mob_row_space',
					[
						'label' => __( 'Row Space', 'theplus' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => ['px'],
						'range' => [
							'px' => [
								'min' => 0,
								'max' => 50,
								'step' => 1,
							],
						],
						'mobile_default' => [
							'size' => 8,
							'unit' => 'px',
						],
						'devices' => [ 'mobile' ],
						'selectors' => [
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'margin-bottom: {{SIZE}}{{UNIT}}',
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row:last-child' => 'margin-bottom: 0px;',
						],
					]
				);
				$this->add_responsive_control(
					'mob_row_border_radius',
					[
						'label' => __( 'Row Border Radius', 'theplus' ),
						'type' => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', 'em' ],
						'devices' => [ 'mobile' ],
						'selectors' => [
							'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);
			$this->end_controls_tab();
			
			$this->start_controls_tab( 'tab_mob_head_hover_colors_row', [ 'label' => __( 'Hover', 'theplus' ) ] );

				$this->add_control(
					'mob_head_cell_hover_color_row',
					[
						'label'     => __( 'Heading Hover Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row:hover' => 'color: {{VALUE}};',
						],
					]
				);

				// Header row background color hover.
				$this->add_control(
					'mob_head_cell_hover_background_row',
					[
						'label'     => __( 'Heading Hover Background', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row:hover' => 'background-color: {{VALUE}};',
						],
					]
				);
			$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Table Header Mobile Style*/
		/*Table Body Style*/
		$this->start_controls_section(
			'section_table_body_style',
			[
				'label' => __( 'Table Body', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		// Cell text alignment.
		$this->add_responsive_control(
			'cell_align',
			[
				'label'     => __( 'Text Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'theplus' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'theplus' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'theplus' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} td .plus-table__text' => 'text-align: {{VALUE}};    width: 100%;',
				],
			]
		);
		// Cell text alignment.
		$this->add_responsive_control(
			'cell_valign',
			[
				'label'     => __( 'Vertical Alignment', 'theplus' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'middle',
				'options'   => [
					'top'    => [
						'title' => __( 'Top', 'theplus' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'theplus' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'theplus' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .plus-table-row .plus-table-col' => 'vertical-align: {{VALUE}};',
				],
			]
		);
		// Cell Typograghy.
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'cell_typography',
				'label'    => __( 'Typography', 'theplus' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} td .plus-table__text-inner,{{WRAPPER}} td .plus-align-icon--left,{{WRAPPER}} td .plus-align-icon--right',
			]
		);

		// Cell padding.
		$this->add_responsive_control(
			'cell_padding',
			[
				'label'      => __( 'Padding', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'default'    => [
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				],
				'selectors'  => [
					'{{WRAPPER}} td.plus-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Tab control starts.
		$this->start_controls_tabs( 'tabs_cell_colors' );

			// Tab Default starts.
			$this->start_controls_tab( 'tab_cell_colors', [ 'label' => __( 'Normal', 'theplus' ) ] );

				// Cell Color Default.
				$this->add_control(
					'cell_color',
					[
						'label'     => __( 'Row Text Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'scheme'    => [
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_3,
						],
						'selectors' => [
							'{{WRAPPER}} tbody td.plus-table-col .plus-table__text' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'striped_effect_feature',
					[
						'label'        => __( 'Stripped Effect', 'theplus' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => __( 'YES', 'theplus' ),
						'label_off'    => __( 'NO', 'theplus' ),
						'return_value' => 'yes',
						'default'      => 'yes',
					]
				);

				// Stripped effect (Odd Rows).
				$this->add_control(
					'striped_effect_odd',
					[
						'label'     => __( 'Stripe Rows Color 1', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#eaeaea',
						'selectors' => [
							'{{WRAPPER}} tbody tr:nth-child(odd)' => 'background: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature' => 'yes',
						],
					]
				);

				// Stripped effect (Even Rows).
				$this->add_control(
					'striped_effect_even',
					[
						'label'     => __( 'Stripe Rows Color 2', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#FFFFFF',
						'selectors' => [
							'{{WRAPPER}} tbody tr:nth-child(even)' => 'background: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature' => 'yes',
						],
					]
				);

				// Cell background color default.
				$this->add_control(
					'cell_background',
					[
						'label'     => __( 'Row Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .plus-table-row' => 'background-color: {{VALUE}};',
						],
						'condition' => [
							'striped_effect_feature!' => 'yes',
						],
					]
				);

				// Advanced Setting for header Switcher.
				$this->add_control(
					'body_border_styling',
					[
						'label'        => __( 'Apply Border To', 'theplus' ),
						'type'         => Controls_Manager::SWITCHER,
						'label_on'     => __( 'CELL', 'theplus' ),
						'label_off'    => __( 'ROW', 'theplus' ),
						'return_value' => 'yes',
						'default'      => 'yes',
					]
				);

				// Body Row border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'row_border',
						'label'          => __( 'Border', 'theplus' ),
						'selector'       => '{{WRAPPER}} tbody .plus-table-row',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'body_border_styling!' => 'yes',
						],
					]
				);

				// Body Cell border.
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'           => 'cell_border_body',
						'label'          => __( 'Cell Border', 'theplus' ),
						'selector'       => '{{WRAPPER}} td.plus-table-col',
						'fields_options' => [
							'border' => [
								'default' => 'solid',
							],
							'width'  => [
								'default' => [
									'top'      => '1',
									'right'    => '1',
									'bottom'   => '1',
									'left'     => '1',
									'isLinked' => true,
								],
							],
							'color'  => [
								'default' => '#bbb',
							],
						],
						'condition'      => [
							'body_border_styling' => 'yes',
						],
					]
				);

			// Default tab ends here.
			$this->end_controls_tab();

			// Hover tab starts here.
			$this->start_controls_tab( 'tab_cell_hover_colors', [ 'label' => __( 'Hover', 'theplus' ) ] );

				// Row hover text color.
				$this->add_control(
					'row_hover_color',
					[
						'label'     => __( 'Row Text Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .plus-table-row:hover td.plus-table-col .plus-table__text' => 'color: {{VALUE}};',
						],
					]
				);

				// Row hover background color.
				$this->add_control(
					'row_hover_background',
					[
						'label'     => __( 'Row Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} tbody .plus-table-row:hover' => 'background-color: {{VALUE}};',
							'{{WRAPPER}} tbody .plus-table-row:hover > .plus-table-col:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

				// Cell color hover.
				$this->add_control(
					'cell_hover_color',
					[
						'label'     => __( 'Cell Hover Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .plus-table tbody td.plus-table-col:hover .plus-table__text' => 'color: {{VALUE}};',
						],
					]
				);

				// Cell background color hover.
				$this->add_control(
					'cell_hover_background',
					[
						'label'     => __( 'Cell Hover Background Color', 'theplus' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .plus-table tbody .plus-table-row:hover > td.plus-table-col:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

		// Tab control ends.
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tbody_button_heading',
			[
				'label' => __( 'Button', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __( 'Button Padding', 'theplus' ),
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
					'{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_width',
			[
				'label' => __( 'Button Width', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
						'step' => 2,
					],
				],
				'devices' => [ 'tablet', 'mobile' ],
				'tablet_default' => [
					'size' => 120,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 120,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap',
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
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',				
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
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		/*Table Body Style*/
		// Icon/Image Styling.
		$this->start_controls_section(
			'section_icon_image_style',
			[
				'label'     => __( 'Icon / Image Options', 'theplus' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		// Icon - styling heading.
		$this->add_control(
			'icon_styling_heading',
			[
				'label' => __( 'Icon', 'theplus' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		// All icon color.
		$this->add_control(
			'all_icon_color',
			[
				'label'     => __( 'Icon Color', 'theplus' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plus-align-icon--left i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-align-icon--right i' => 'color: {{VALUE}};',					
				],
			]
		);

		// All icon size.
		$this->add_responsive_control(
			'all_icon_size',
			[
				'label'     => __( 'Icon Size', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 30,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .plus-align-icon--left i' => 'font-size: {{SIZE}}px;    vertical-align: middle;',
					'{{WRAPPER}} .plus-align-icon--right i' => 'font-size: {{SIZE}}px;vertical-align: middle;',					
				],
			]
		);

		// All Icon Position.
		$this->add_control(
			'all_icon_align',
			[
				'label'   => __( 'Icon Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Before', 'theplus' ),
					'right' => __( 'After', 'theplus' ),
				],
			]
		);

		// All Icon Spacing.
		$this->add_responsive_control(
			'all_icon_indent',
			[
				'label'     => __( 'Icon Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .plus-align-icon--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .plus-align-icon--right' => 'margin-left: {{SIZE}}px;',
				],
			]
		);

		// Image - Styling heading.
		$this->add_control(
			'image_styling_heading',
			[
				'label'     => __( 'Image', 'theplus' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// All Image Size.
		$this->add_responsive_control(
			'all_image_size',
			[
				'label'      => __( 'Image Size', 'theplus' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'size' => 30,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					],
				],
				'selectors'  => [
					// Item.
					'{{WRAPPER}} .plus-col-img--left'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-col-img--right' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// All Image Position.
		$this->add_control(
			'all_image_align',
			[
				'label'   => __( 'Image Position', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Before', 'theplus' ),
					'right' => __( 'After', 'theplus' ),
				],
			]
		);

		// All Image Size.
		$this->add_responsive_control(
			'all_image_indent',
			[
				'label'     => __( 'Image Spacing', 'theplus' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					// Item.
					'{{WRAPPER}} .plus-col-img--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .plus-col-img--right' => 'margin-left: {{SIZE}}px;',
				],
			]
		);

		// All image border radius.
		$this->add_responsive_control(
			'all_image_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .plus-col-img--left'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .plus-col-img--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		/* Icon/Image Style*/
		/* Search Style*/
		// Icon / Image Styling.
		$this->start_controls_section(
			'section_search_style',
			[
				'label' => __( 'Search Bar / Show Entries', 'theplus' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			// All icon color.
			$this->add_control(
				'label_color',
				[
					'label'     => __( 'Label Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plus-advance-heading label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'input_color',
				[
					'label'     => __( 'Input Value Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'label_typography',
					'label'    => __( 'Typography', 'theplus' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
					'selector' => '{{WRAPPER}} .plus-advance-heading label, {{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input',
				]
			);
			$this->add_control(
				'label_bg_color',
				[
					'label'     => __( 'Input Background Color', 'theplus' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'background-color: {{VALUE}};',
					],
				]
			);
			// Cell padding.
			$this->add_responsive_control(
				'input_padding',
				[
					'label'      => __( 'Input Padding', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default'    => [
						'top'      => '10',
						'bottom'   => '10',
						'left'     => '10',
						'right'    => '10',
						'unit'     => 'px',
						'isLinked' => false,
					],
					'selectors'  => [
						'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'           => 'input_border',
					'label'          => __( 'Input Border', 'theplus' ),
					'fields_options' => [
						'border' => [
							'default' => 'solid',
						],
						'width'  => [
							'default' => [
								'top'      => '1',
								'right'    => '1',
								'bottom'   => '1',
								'left'     => '1',
								'isLinked' => true,
							],
						],
						'color'  => [
							'default' => '#bbb',
						],
					],
					'selector'       => '{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input',
				]
			);
			$this->add_responsive_control(
				'input_border_radius',
				[
					'label'      => __( 'Input Border Radius', 'theplus' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'default'    => [
						'top'      => '2',
						'bottom'   => '2',
						'left'     => '2',
						'right'    => '2',
						'unit'     => 'px',
						'isLinked' => true,
					],
					'selectors'  => [
						'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			
			// All icon size.
			$this->add_responsive_control(
				'search_input_size',
				[
					'label'     => __( 'Search Bar Width', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 200,
					],
					'range'     => [
						'px' => [
							'min'  => 1,
							'max'  => 400,
							'step' => 1,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .plus-advance-heading .plus-tbl-search-wrapper input' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);
			// All icon size.
			$this->add_responsive_control(
				'entry_page_input_size',
				[
					'label'     => __( 'Show Entries Width', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 200,
					],
					'range'     => [
						'px' => [
							'min'  => 1,
							'max'  => 400,
							'step' => 1,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'selectors' => [
						'{{WRAPPER}} .plus-advance-heading .plus-tbl-entry-wrapper select' => 'width: {{SIZE}}{{UNIT}}',
					],
				]
			);

			// All icon size.
			$this->add_control(
				'bottom_spacing',
				[
					'label'     => __( 'Bottom Space', 'theplus' ),
					'type'      => Controls_Manager::SLIDER,
					'default'   => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors' => [
						// Item.
						'{{WRAPPER}} .plus-advance-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
				]
			);

		$this->end_controls_section();
		/* Search Style*/
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
		$node_id   = $this->get_id();
		$is_editor = \Elementor\Plugin::instance()->editor->is_edit_mode();
		
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
			
			
			ob_start();
			
			$this->add_render_attribute( 'plus_table_wrapper', 'class', 'plus-table-wrapper' );
			$this->add_render_attribute( 'plus_table_wrapper', 'itemtype', 'http://schema.org/Table' );

			$this->add_render_attribute( 'plus_table_id', 'id', 'plus-table-id-' . $node_id );

			$this->add_render_attribute( 'plus_table_id', 'class', 'plus-text-break' );

			$this->add_render_attribute( 'plus_table_id', 'class', 'plus-column-rules' );
			$this->add_render_attribute( 'plus_table_id', 'class', 'plus-table' );
			
			if(!empty($settings["mobile_responsive_table"]) && $settings["mobile_responsive_table"]=='one-by-one'){
				$this->add_render_attribute( 'plus_table_id', 'class', 'plus-table-mob-res' );
			}
			// Tr (Row).
			$this->add_render_attribute( 'plus_table_row', 'class', 'plus-table-row' );
			// Text span.
			$this->add_render_attribute( 'plus_table__text', 'class', 'plus-table__text' );
			
			// Sortable.
			if ( !empty($settings['sortable']) && 'yes' === $settings['sortable'] ) {
				$this->add_render_attribute( 'plus_table_id', 'data-sort-table', $settings['sortable'] );
			} else {
				$this->add_render_attribute( 'plus_table_id', 'data-sort-table', 'no' );
			}
			// Show entries.
			if ( !empty($settings['show_entries']) && 'yes' === $settings['show_entries'] ) {
				$this->add_render_attribute( 'plus_table_id', 'data-show-entry', $settings['show_entries'] );
			} else {
				$this->add_render_attribute( 'plus_table_id', 'data-show-entry', 'no' );
			}
			
			if ( !empty($settings['searchable']) &&  'yes' === $settings['searchable'] ) {
				$this->add_render_attribute( 'plus_table_id', 'data-searchable', $settings['searchable'] );
				$this->add_render_attribute( 'plus_table_id', 'data-searchable-label', $settings['searchable_label'] );				
			} else {
				$this->add_render_attribute( 'plus_table_id', 'data-searchable', 'no' );
			}

			?>
			<div itemscope <?php echo $this->get_render_attribute_string( 'plus_table_wrapper' ); ?>>
				
				<table <?php echo $this->get_render_attribute_string( 'plus_table_id' ); ?>>
					<?php
					$first_row_h    = true;
					$counter_h      = 1;
					$cell_counter_h = 0;
					$inline_count   = 0;
					$row_count_h    = count( $settings['table_headings'] );
					$header_text    = array();
					$data_entry     = 0;

					if ( $row_count_h > 1 ) {
						?>
					<thead>
						<?php
						if ( $settings['table_headings'] ) {
							foreach ( $settings['table_headings'] as $index => $head ) {
								
								
								// Header text prepview editing.
								$repeater_heading_text = $this->get_repeater_setting_key( 'heading_text', 'table_headings', $inline_count );
								$this->add_render_attribute( $repeater_heading_text, 'class', 'plus-table__text-inner' );
								$this->add_inline_editing_attributes( $repeater_heading_text );
								// TH.
								if ( true === $first_row_h ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'data-sort', $cell_counter_h );
								}
								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'sort-this' );
								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'elementor-repeater-item-' . $head['_id'] );
								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'plus-table-col' );
								if ( 1 < $head['heading_col_span'] ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'colspan', $head['heading_col_span'] );
								}
								if ( 1 < $head['heading_row_span'] ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'rowspan', $head['heading_row_span'] );
								}
								// Sort Icon.
								if ( 'yes' === $settings['sortable'] && true === $first_row_h ) {
									$this->add_render_attribute( 'icon_sort_' . $head['_id'], 'class', 'plus-sort-icon' );
								}
								if ( $head['icons_image']['url'] ) {
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'src', $head['icons_image']['url'] );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'class', 'plus-col-img--' . $settings['all_image_align'] );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'title', get_the_title( $head['icons_image']['id'] ) );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'alt', get_the_title( $head['icons_image']['id'] ) );
								}
								// ICON.
								
								if('icon' === $head['header_content_icon_image'] && $head["icon_font_style"]=='font_awesome'){
									$this->add_render_attribute( 'plus_heading_icon' . $head['_id'], 'class', $head['icon_fontawesome'] );
								}else if('icon' === $head['header_content_icon_image'] && $head["icon_font_style"]=='icon_mind'){
									$this->add_render_attribute( 'plus_heading_icon' . $head['_id'], 'class', 'fa '.$head['icons_mind'] );
								}
								$this->add_render_attribute( 'plus_heading_icon_align' . $head['_id'], 'class', 'plus-align-icon--' . $settings['all_icon_align'] );

								if ( 'cell' === $head['header_content_type'] ) {
									?>
									<th <?php echo $this->get_render_attribute_string( 'current_' . $head['_id'] ); ?> scope="col">
										<span class="sort-style">
										<span <?php echo $this->get_render_attribute_string( 'plus_table__text' ); ?>>
											<?php if ( 'icon' === $head['header_content_icon_image'] ) { ?>												
													<?php if ( 'left' === $settings['all_icon_align'] ) { ?>
												<span <?php echo $this->get_render_attribute_string( 'plus_heading_icon_align' . $head['_id'] ); ?>>
													<i <?php echo $this->get_render_attribute_string( 'plus_heading_icon' . $head['_id'] ); ?>></i>
												</span>
											<?php } ?>											
											<?php } else { ?>
													<?php if ( $head['icons_image']['url'] ) { ?>
														<?php if ( 'left' == $settings['all_image_align'] ) { ?>
														<img <?php echo $this->get_render_attribute_string( 'plus_head_col_img' . $head['_id'] ); ?>>
													<?php } ?>
													<?php } ?>
											<?php } ?>
											<span <?php echo $this->get_render_attribute_string( $repeater_heading_text ); ?>><?php echo $head['heading_text']; ?></span>
											<?php if ( 'icon' === $head['header_content_icon_image'] ) { ?>												
													<?php if ( 'right' === $settings['all_icon_align'] ) { ?>
												<span <?php echo $this->get_render_attribute_string( 'plus_heading_icon_align' . $head['_id'] ); ?>>
													<i <?php echo $this->get_render_attribute_string( 'plus_heading_icon' . $head['_id'] ); ?>></i>
												</span>
											<?php } ?>											
											<?php } else { ?>
													<?php if ( $head['icons_image']['url'] ) { ?>
														<?php if ( 'right' == $settings['all_image_align'] ) { ?>
														<img <?php echo $this->get_render_attribute_string( 'plus_head_col_img' . $head['_id'] ); ?>>
													<?php } ?>
													<?php } ?>
											<?php } ?>
										</span>
										<?php if ( 'yes' === $settings['sortable'] && true === $first_row_h ) { ?>
											<span <?php echo $this->get_render_attribute_string( 'icon_sort_' . $head['_id'] ); ?>></span>
										<?php } ?>
										</span>
									</th>
									<?php
									$header_text[ $cell_counter_h ]['heading_text'] = $head['heading_text'];
									$header_text[ $cell_counter_h ]['icon_image'] = $head['header_content_icon_image'];
									$header_text[ $cell_counter_h ]['plus_heading_icon_align'] = 'plus_heading_icon_align' . $head['_id'];
									$header_text[ $cell_counter_h ]['plus_heading_icon'] = 'plus_heading_icon' . $head['_id'];
									$header_text[ $cell_counter_h ]['icons_image_url'] = $head['icons_image']['url'];
									$header_text[ $cell_counter_h ]['plus_head_col_img'] = 'plus_head_col_img' . $head['_id'];
									$cell_counter_h++;
								} else {
									if ( $counter_h > 1 && $counter_h < $row_count_h ) {
										// Break into new row.
										?>
										</tr><tr <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
										<?php
										$first_row_h = false;
									} elseif ( 1 === $counter_h && false === $this->check_first_row() ) {
										?>
										<tr <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
														<?php
									}
									$cell_counter_h = 0;
								}
								$counter_h++;
								$inline_count++;
							}
						}
						?>
					</thead>
					<?php } ?>
					<tbody>
						<!-- ROWS -->
						<?php
						$counter           = 1;
						$cell_counter      = 0;
						$cell_inline_count = 0;
						$row_count         = count( $settings['table_content'] );
						$ij=0;
						$attr_id='cell';
						if ( $settings['table_content'] ) {
							foreach ( $settings['table_content'] as $index => $row ) {
								// Cell text inline classes.
								$ij++;
								
								$repeater_cell_text = $this->get_repeater_setting_key( 'cell_text', 'table_content', $cell_inline_count );
								$this->add_render_attribute( $repeater_cell_text, 'class', 'plus-table__text-inner' );
								$this->add_inline_editing_attributes( $repeater_cell_text );
								$this->add_render_attribute( 'plus_cell_icon_align' . $row['_id'], 'class', 'plus-align-icon--' . $settings['all_icon_align'] );
								$button='';
								if(!empty($row["cell_display_button"]) && $row["cell_display_button"]=='yes'){
									$link_key = 'link_' . $ij;
									if ( ! empty( $row['cell_button_link']['url'] ) ) {
										$this->add_render_attribute( $link_key, 'href', $row['cell_button_link']['url'] );
										if ( $row['cell_button_link']['is_external'] ) {
											$this->add_render_attribute( $link_key, 'target', '_blank' );
										}
										if ( $row['cell_button_link']['nofollow'] ) {
											$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
										}
									}
									$this->add_render_attribute( $link_key, 'class', 'button-link-wrap' );
									$this->add_render_attribute( $link_key, 'role', 'button' );
									
									$button_style = $row['cell_button_style'];
									$button_text = $row['cell_button_text'];
									$btn_uid=uniqid('btn');
									$data_class= $btn_uid;
									$data_class .=' button-'.$button_style.' ';
									$button .='<div class="pt_plus_button '.$data_class.'">';										
											$button .='<a '.$this->get_render_attribute_string( $link_key ).'>';
											$button .= $button_text;
											$button .='</a>';										
									$button .='</div>';
								}
								if('icon' === $row['cell_content_icon_image'] && $row["icon_font_style"]=='font_awesome'){
									$this->add_render_attribute( 'plus_cell_icon'  . $row['_id'], 'class', $row['cell_icon'] );
								}else if('icon' === $row['cell_content_icon_image'] && $row["icon_font_style"]=='icon_mind'){
									$this->add_render_attribute( 'plus_cell_icon'  . $row['_id'], 'class', 'fa '.$row['cell_icons_mind'] );								
								}

								$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'class', 'plus-table-col' );
								$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'class', 'elementor-repeater-item-' . $row['_id'] );
								if ( 1 < $row['cell_span'] ) {
									$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'colspan', $row['cell_span'] );
								}
								if ( 1 < $row['cell_row_span'] ) {
									$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'rowspan', $row['cell_row_span'] );
								}
								if ( $row['image']['url'] ) {
									$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'src', $row['image']['url'] );
									$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'class', 'plus-col-img--' . $settings['all_image_align'] );
									$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'title', get_the_title( $row['image']['id'] ) );
									$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'alt', get_the_title( $row['image']['id']) );
								}
								if ( ! empty( $row['link']['url'] ) ) {
									$this->add_render_attribute( 'col-link-' . $row['_id'], 'href', $row['link']['url'] );
									if ( $row['link']['is_external'] ) {
										$this->add_render_attribute( 'col-link-' . $row['_id'], 'target', '_blank' );
									}
									if ( $row['link']['nofollow'] ) {
										$this->add_render_attribute( 'col-link-' . $row['_id'], 'rel', 'nofollow' );
									}
									$this->add_render_attribute( 'col-link-' . $row['_id'], 'class', 'tb-col-link' );
								}

								if ( 'cell' === $row['content_type'] ) {
									// Fetch corresponding header cell text.
									if ( isset( $header_text[ $cell_counter ]['heading_text'] ) && $header_text[ $cell_counter ]['heading_text'] ) {
										$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'data-title', $header_text[ $cell_counter ]['heading_text'] );
									}
									?>
									<<?php echo $row['table_th_td']; ?> <?php echo $this->get_render_attribute_string( 'plus_table_col' . $row['_id'] ); ?>>
										<?php if ( ! empty( $row['link']['url'] ) ) { ?>
										<a <?php echo $this->get_render_attribute_string( 'col-link-' . $row['_id'] ); ?>>
										<?php } ?>
											<?php if(!empty($settings["mobile_responsive_table"]) && $settings["mobile_responsive_table"]=='one-by-one'){ ?>
												<div class="plus-table-mob-wrap">
												<span class="plus-table-mob-row">
													<?php if ( 'icon' === $header_text[ $cell_counter ]['icon_image'] ) { ?>												
															<?php if ( 'left' === $settings['all_icon_align'] ) { ?>
														<span <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_heading_icon_align'] ); ?>>
															<i <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_heading_icon'] ); ?>></i>
														</span>
													<?php } ?>											
													<?php } else { ?>
															<?php if ( $header_text[ $cell_counter ]['icons_image_url'] ) { ?>
																<?php if ( 'left' == $settings['all_image_align'] ) { ?>
																<img <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_head_col_img'] ); ?>>
															<?php } ?>
															<?php } ?>
													<?php } ?>
													<?php if ( isset( $header_text[ $cell_counter ]['heading_text'] ) && $header_text[ $cell_counter ]['heading_text'] ) {														
														echo '<span class="mob-heading-text">'.$header_text[ $cell_counter ]['heading_text'].'</span>';
													}
													?>
													<?php if ( 'icon' === $header_text[ $cell_counter ]['icon_image'] ) { ?>												
														<?php if ( 'right' === $settings['all_icon_align'] ) { ?>
														<span <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_heading_icon_align'] ); ?>>
															<i <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_heading_icon'] ); ?>></i>
														</span>
													<?php } ?>											
													<?php } else { ?>
															<?php if ( $header_text[ $cell_counter ]['icons_image_url'] ) { ?>
																<?php if ( 'right' == $settings['all_image_align'] ) { ?>
																<img <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter ]['plus_head_col_img'] ); ?>>
															<?php } ?>
															<?php } ?>
													<?php } ?>
												</span> 
											<?php } ?>
												<span <?php echo $this->get_render_attribute_string( 'plus_table__text' ); ?>>
													<?php if ( 'icon' === $row['cell_content_icon_image'] ) { ?>
														
															<?php if ( 'left' === $settings['all_icon_align'] ) { ?>
														<span <?php echo $this->get_render_attribute_string( 'plus_cell_icon_align' . $row['_id'] ); ?>>
															<i <?php echo $this->get_render_attribute_string( 'plus_cell_icon' . $row['_id'] ); ?>></i>
														</span>
														<?php } ?>
														
													<?php } else { ?>
														<?php if ( $row['image']['url'] ) { ?>
															<?php if ( 'left' === $settings['all_image_align'] ) { ?>
															<img <?php echo $this->get_render_attribute_string( 'plus_col_img' . $row['_id'] ); ?>>
														<?php } ?>
														<?php } ?>
													<?php } ?>
													<?php if(!empty($row['cell_text'])){ ?>
														<span <?php echo $this->get_render_attribute_string( $repeater_cell_text ); ?>><?php echo $row['cell_text']; ?></span>
													<?php } ?>
													<?php if ( 'icon' === $row['cell_content_icon_image'] ) { ?>
														
															<?php if ( 'right' === $settings['all_icon_align'] ) { ?>
														<span <?php echo $this->get_render_attribute_string( 'plus_cell_icon_align' . $row['_id'] ); ?>>
															<i <?php echo $this->get_render_attribute_string( 'plus_cell_icon' . $row['_id'] ); ?>></i>
														</span>
														<?php } ?>
														
													<?php } else { ?>
														<?php if ( $row['image']['url'] ) { ?>
															<?php if ( 'right' === $settings['all_image_align'] ) { ?>
															<img <?php echo $this->get_render_attribute_string( 'plus_col_img' . $row['_id'] ); ?>>
														<?php } ?>
														<?php } ?>
													<?php } ?>
													<?php echo $button; ?>
												</span>
											<?php if(!empty($settings["mobile_responsive_table"]) && $settings["mobile_responsive_table"]=='one-by-one'){ ?>
												</div>
											<?php } ?>
										<?php if ( ! empty( $row['link']['url'] ) ) { ?>
										</a>
										<?php } ?>
									</<?php echo $row['table_th_td']; ?>>
										<?php
										// Increment to next cell.
										$cell_counter++;
								} else {
									if ( $counter > 1 && $counter < $row_count ) {
										// Break into new row.
										++$data_entry;
										?>
										</tr><tr data-entry="<?php echo $data_entry; ?>" <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
															<?php
									} elseif ( 1 === $counter && false === $this->check_first_row() ) {
										$data_entry = 1;
										?>
										<tr data-entry="<?php echo $data_entry; ?>" <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
														<?php
									}
									$cell_counter = 0;
								}
								$counter++;
								$cell_inline_count++;
							}
						}
						?>
					</tbody>
				</table>
				
			</div>
			<?php
			$html = ob_get_clean();
			echo $html;
	}
	/**
	 * Function to identify if it is a first row or not.
	 *
	 * If yes returns false no returns true.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function check_first_row() {

		$settings = $this->get_settings_for_display();

		if ( 'row' === $settings['table_content'][0]['content_type'] ) {
			return false;
		}

		return true;
	}
    protected function content_template() {
	
    }

}
