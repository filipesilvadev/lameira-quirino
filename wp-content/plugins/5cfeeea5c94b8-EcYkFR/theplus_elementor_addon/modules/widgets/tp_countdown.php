<?php 
/*
Widget Name: Countdown 
Description: Display countdown.
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Countdown extends Widget_Base {
		
	public function get_name() {
		return 'tp-countdown';
	}

    public function get_title() {
        return __('Countdown', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-clock-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-essential');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts',
			'downCount-js'
        ];
    }

    protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Countdown Date', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'counting_timer',
			[
				'label' => __( 'Launch Date', 'theplus' ),
				'type' => Controls_Manager::DATE_TIME,
				'default'     => date( 'd-m-Y H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'theplus' ), Utils::get_timezone_string() ),
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_downcount',
            [
                'label' => __('Label', 'theplus'),
            ]
        );
		$this->add_control(
			'show_labels',
			[
				'label'   => esc_html__( 'Show Labels', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
            'text_days',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Days Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Days', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_hours',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Hours Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Hours', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_minutes',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Minutes Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Minutes', 'theplus'),
                'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->add_control(
            'text_seconds',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Seconds Section Text', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => __('Seconds', 'theplus'),
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
            'section_styling',
            [
                'label' => __('Counter Styling', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,				
            ]
        );
		$this->add_control(
            'number_text_color',
            [
                'label' => __('Counter Font Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li > span' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'numbers_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}}  .pt_plus_countdown li > span',
				'separator' => 'after',
			)
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Label Typography', 'theplus'),
                'selector' => '{{WRAPPER}} .pt_plus_countdown li > h6',
				'separator' => 'after',
				'condition'    => [
					'show_labels!' => '',
				],
            ]
        );
		$this->start_controls_tabs( 'tabs_days_style' );

		$this->start_controls_tab(
			'tab_day_style',
			[
				'label' => __( 'Days', 'theplus' ),
			]
		);
		$this->add_control(
            'days_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_1 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'days_border_color',
            [
                'label' => __('Border Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_1' => 'border-color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'days_background',
				'label'     => __("Days Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_1',
				
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hour_style',
			[
				'label' => __( 'Hours', 'theplus' ),
			]
		);
		$this->add_control(
            'hours_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_2 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'hours_border_color',
            [
                'label' => __('Border Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_2' => 'border-color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'hours_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_2',				
			]
		);
		$this->end_controls_tab();
		
		$this->start_controls_tab(
			'tab_minute_style',
			[
				'label' => __( 'Minutes', 'theplus' ),
			]
		);
		$this->add_control(
            'minutes_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_3 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'minutes_border_color',
            [
                'label' => __('Border Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_3' => 'border-color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'minutes_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_3',				
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_second_style',
			[
				'label' => __( 'Seconds', 'theplus' ),
			]
		);
		$this->add_control(
            'seconds_text_color',
            [
                'label' => __('Text Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_4 h6' => 'color:{{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'seconds_border_color',
            [
                'label' => __('Border Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .pt_plus_countdown li.count_4' => 'border-color:{{VALUE}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'seconds_background',
				'label'     => __("Background",'theplus'),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt_plus_countdown li.count_4',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'counter_padding',
			[
				'label' => __( 'Padding', 'theplus' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],				
			]
		);
		
		$this->add_control(
			'count_border_style',
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
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'count_border_width',
			[
				'label' => __( 'Border Width', 'theplus' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'top'    => 3,
					'right'  => 3,
					'bottom' => 3,
					'left'   => 3,
				],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'count_border_style!' => 'none',
				]
			]
		);
		$this->add_control(
			'count_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_countdown li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'count_hover_shadow',
				'selector' => '{{WRAPPER}} .pt_plus_countdown li',
				'separator' => 'before',
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
		
		$data_attr='';
		
		
		$uid=uniqid('count_down');
			if (empty($settings['show_labels'])){
				$show_labels=$settings['show_labels'];
			}else{
				$show_labels='yes';
			}
			if (empty($settings['text_days'])){
				$text_days='Days';
			}else{
				$text_days=$settings['text_days'];
			}
			
			if (empty($settings['text_hours'])){
				$text_hours='Hours';
			}else{
				$text_hours=$settings['text_hours'];
			}
			
			if (empty($settings['text_minutes'])){
				$text_minutes='Minutes';
			}else{
				$text_minutes=$settings['text_minutes'];
			}
			
			if (empty($settings['text_seconds'])){
				$text_seconds='Seconds';
			}else{
				$text_seconds=$settings['text_seconds'];
			}
			
			if(!empty($settings['counting_timer'])){
				$counting_timer=$settings['counting_timer'];
				$counting_timer= date('d-m-Y', strtotime($counting_timer));
			}else{
				$counting_timer='31-08-2018';
			}
			
			$data_attr .=' data-days="'.esc_attr($text_days).'"';
			$data_attr .=' data-hours="'.esc_attr($text_hours).'"';
			$data_attr .=' data-minutes="'.esc_attr($text_minutes).'"';
			$data_attr .=' data-seconds="'.esc_attr($text_seconds).'"';
			
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
			echo $before_content;
			
			?>
			<ul class="pt_plus_countdown <?php echo esc_attr($uid); ?> <?php echo $animated_class; ?>" <?php echo $data_attr; ?> data-timer="<?php echo esc_attr($counting_timer); ?>" <?php echo $animation_attr; ?>>
					<li class="count_1">
						<span class="days">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
							<h6 class="days_ref"><?php echo esc_html($text_days); ?></h6>
						<?php } ?>
					</li>
					<li class="count_2">
						<span class="hours">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
							<h6 class="hours_ref"><?php echo esc_html($text_hours); ?></h6>
						<?php } ?>
					</li>
					<li class="count_3">
						<span class="minutes">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
						<h6 class="minutes_ref"><?php echo esc_html($text_minutes); ?></h6>
						<?php } ?>
					</li>
					<li class="count_4">
						<span class="seconds last">00</span>
						<?php if(!empty($show_labels) && $show_labels=='yes'){ ?>
						<h6 class="seconds_ref"><?php echo esc_html($text_seconds); ?></h6>
						<?php } ?>
					</li>
				</ul>
			<?php 	
			echo $after_content;
	}
    protected function content_template() {
	
    }

}