<?php 
/*
Widget Name: Switcher
Description: Content of toggle switcher.
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
use Elementor\Group_Control_Box_Shadow;

use TheplusAddons\Theplus_Element_Load;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Switcher extends Widget_Base {
		
	public function get_name() {
		return 'tp-switcher';
	}

    public function get_title() {
        return __('Switcher', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-toggle-on theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-tabbed');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_one_section',
			[
				'label' => __( 'Content 1', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'switch_a_title',
			[
				'label'   => __( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Switch A' , 'theplus' ),
			]
		);
		$this->add_control(
			'content_a_source',
			[
				'label' => __( 'Select Source', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'  => __( 'Custom Content', 'theplus' ),
					'template' => __( 'Template', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'content_a_desc',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text.', 'theplus' ),
				'placeholder' => __( 'Type your description here', 'theplus' ),
				'condition'    => [
					'content_a_source' => [ 'content' ],
				],
			]
		);
		$this->add_control(
			'content_a_template',
			[
				'label'       => __( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => ['content_a_source' => "template"],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_b_section',
			[
				'label' => __( 'Content 2', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'switch_b_title',
			[
				'label'   => __( 'Title', 'theplus' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Switch B' , 'theplus' ),
			]
		);
		$this->add_control(
			'content_b_source',
			[
				'label' => __( 'Select Source', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'content'  => __( 'Custom Content', 'theplus' ),
					'template' => __( 'Template', 'theplus' ),
				],
			]
		);
		
		$this->add_control(
			'content_b_desc',
			[
				'label' => __( 'Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'theplus' ),
				'placeholder' => __( 'Type your description here', 'theplus' ),
				'condition'    => [
					'content_b_source' => [ 'content' ],
				],
			]
		);
		$this->add_control(
			'content_b_template',
			[
				'label'       => __( 'Elementor Templates', 'theplus' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => '0',
				'options'     => theplus_get_templates(),
				'label_block' => 'true',
				'condition'   => ['content_b_source' => "template"],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_switcher_section',
			[
				'label' => __( 'Switch/Toggle', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'switcher_unique_id',
			[
				'label' => __( 'Unique Switcher ID', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'after',
				'description' => __('Keep this blank or Setup Unique id for switcher which you can use with "Carousel Remote" widget.','theplus'),
			]
		);
		$this->add_control(
			'show_switcher_button',
			[
				'label' => __( 'Display Switcher Button', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'switcher_style',
			[
				'label' => __( 'Switcher Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style 1', 'theplus' ),
					'style-2' => __( 'Style 2', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'switch-align',
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
				'default' => 'center',
				'toggle' => true,
			]
		);
		$this->add_control(
            'switch_label_space',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Label Spacing', 'theplus'),
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min'	=> 0,
						'max'	=> 100,
						'step' => 2,
					],
					'%' => [
						'min'	=> 0,
						'max'	=> 30,
						'step' => 1,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .theplus-switcher .switch-1' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .theplus-switcher  .switch-2' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->add_control(
            'switch_toggle_size',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Switch/Toggle Size', 'theplus'),
				'size_units' => [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'range' => [
					'px' => [
						'min'	=> 0,
						'max'	=> 50,
						'step' => 2,
					],
				],
				'render_type' => 'ui',
				'selectors' => [
					'{{WRAPPER}} .theplus-switcher .switcher-button' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_switcher_styling',
            [
                'label' => __('Switcher Cosmetics', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
            'switch_color',
            [
                'label' => __('Switch Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .switch-slider.style-1:before,{{WRAPPER}} .switch-slider.style-2:before' => 'background:{{VALUE}};',
                ],
            ]
        );
		$this->start_controls_tabs( 'tabs_switcher_style' );
		$this->start_controls_tab(
			'tab_normal_switcher',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
            'normal_bg_color',
            [
                'label' => __('Background Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#3351a6',
                'selectors' => [
                    '{{WRAPPER}} .switch-toggle + .switch-slider' => 'background:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'normal_label_color',
            [
                'label' => __('Label Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
				'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .switch-toggle + .switch-slider' => 'color:{{VALUE}};',
                    '{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-2,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-1' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_active_switcher',
			[
				'label' => __( 'Active', 'theplus' ),
			]
		);
		$this->add_control(
            'active_bg_color',
            [
                'label' => __('Background Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f0112b',
                'selectors' => [
                    '{{WRAPPER}} .switch-toggle:checked + .switch-slider' => 'background:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'active_label_color',
            [
                'label' => __('Label Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
				'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .switch-toggle + .switch-slider' => 'color:{{VALUE}};',
					'{{WRAPPER}} .theplus-switcher .switcher-toggle.inactive .switch-label-1,{{WRAPPER}} .theplus-switcher .switcher-toggle.active .switch-label-2' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'switch_box_shadow',
				'selector' => '{{WRAPPER}} .theplus-switcher .switch-slider.style-1:before,{{WRAPPER}} .theplus-switcher .switch-slider.style-2:before',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'section_switcher_typography_styling',
            [
                'label' => __('Switcher Typography', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typho_a_label',
                'label' => __('Label 1 Typography', 'theplus'),
				'separator' => 'before',
                'selector' => '{{WRAPPER}} .theplus-switcher .switch-label-text.switch-label-1',
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typho_b_label',
                'label' => __('Label 2 Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .theplus-switcher .switch-label-text.switch-label-2',
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_content_1_styling',
            [
                'label' => __('WYSIWYG Content 1', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'content_a_source' => 'content',
				],
            ]
        );
		$this->add_control(
            'content_section_a_color',
            [
                'label' => __('Content 1 Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
                'selectors' => [
					'{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1,{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1 p' => 'color:{{VALUE}};',
                ],
				'condition' => [
					'content_a_source' => 'content',
				],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_section_a',
                'label' => __('Content Section 1 Typography', 'theplus'),
				'separator' => 'before',
                'selectors' => '{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-1',
				'condition' => [
					'content_a_source' => 'content',
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_content_2_styling',
            [
                'label' => __('WYSIWYG Content 2', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'content_b_source' => 'content',
				],
            ]
        );
		$this->add_control(
            'content_section_b_color',
            [
                'label' => __('Content 2 Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
                 'selectors' => [
					'{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2,{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2 p' => 'color:{{VALUE}};',
                ],
				'condition' => [
					'content_b_source' => 'content',
				],
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_section_b',
                'label' => __('Content Section 2 Typography', 'theplus'),
                'selectors' => '{{WRAPPER}} .theplus-switcher .switcher-toggle-sections .content-2',
				'condition' => [
					'content_b_source' => 'content',
				],
            ]
        );
		$this->end_controls_section();
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
		$switch_a_title = $settings['switch_a_title'];
		$switch_b_title = $settings['switch_b_title'];
		$switcher_style = $settings['switcher_style'];
		$switch_align = $settings['switch-align'];
		
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
				$before_content .='<div id="'.esc_attr($uid_widget).'" class="plus-widget-wrapper '.esc_attr($magic_class).' '.esc_attr($move_parallax).' '.esc_attr($reveal_effects).' '.esc_attr($continuous_animation).'" '.$effect_attr.' '.$this->get_render_attribute_string( '_tooltip' ).'>';
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
			$uid=uniqid("switch");
			
			if(!empty($settings["switcher_unique_id"])){
				$uid="tpca_".$settings["switcher_unique_id"];
			}
			
			$switcher ='<div id="'.esc_attr($uid).'" class="theplus-switcher switch-1 '.$animated_class.'" '.$animation_attr.' data-id="'.esc_attr($uid).'" >';
					$switcher .='<div class="switcher-toggle inactive '.$switch_align.' '.esc_attr($switcher_style).'">';
						if($switcher_style=='style-1' || $switcher_style=='style-2'){					
							$switcher .='<div class="switch-1">
								<h5 class="switch-label-text switch-label-1">'.esc_html($switch_a_title).'</h5>
							</div>';
							$switcher .='<div class="switcher-button" data-type="'.esc_attr($switcher_style).'">
								<label class="switch-label-btn"><input class="switch-toggle round-'.esc_attr($switcher_style).'" type="checkbox"><span class="switch-slider '.esc_attr($switcher_style).' switch-round"></span></label>
							</div>';
							$switcher .='<div class="switch-2">
								<h5 class="switch-label-text switch-label-2">'.esc_html($switch_b_title).'</h5>
							</div>';
						}
					$switcher .='</div>';
				$switcher .='<div class="switcher-toggle-sections">';
					$switcher .='<div class="switcher-section-1" style="display: block;">';
						if($settings["content_a_source"]=='content' && !empty($settings["content_a_desc"])){
							$switcher .='<div class="content-1">';
								$switcher .= $settings["content_a_desc"];
							$switcher .= '</div>';	
						}
						if($settings["content_a_source"]=='template' && !empty($settings["content_a_template"])){
							$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['content_a_template'] );
						}
						
					$switcher .='</div>';
					$switcher .='<div class="switcher-section-2" style="display: none;">';
						if($settings["content_b_source"]=='content' && !empty($settings["content_b_desc"])){
							$switcher .='<div class="content-2">';
								$switcher .= $settings["content_b_desc"];
							$switcher .= '</div>';							
						}
						if($settings["content_b_source"]=='template'){
							$switcher .= Theplus_Element_Load::elementor()->frontend->get_builder_content_for_display( $settings['content_b_template'] );
						}
						
					$switcher .='</div>';
				$switcher .='</div>';
			$switcher .='</div>';				
			$css_rule ='';
			if($settings["show_switcher_button"]!='yes'){
				$css_rule .='<style>#'.esc_attr($uid).' .switcher-toggle{display:none;}</style>';
			}
		echo $css_rule.$before_content.$switcher.$after_content;
	}
    protected function content_template() {
	
    }

}
