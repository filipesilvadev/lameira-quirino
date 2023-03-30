<?php 
/*
Widget Name: Creative Image Factory 
Description: Display image factory creative.
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Image_Factory extends Widget_Base {
		
	public function get_name() {
		return 'tp-image-factory';
	}

    public function get_title() {
        return __('Creative Image', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-file-image-o theplus_backend_icon';
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
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'animated_style',
			[
				'label'   => __( 'Image Style', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'creative-simple-image',
				'options' => [
					'creative-simple-image'   => __( 'Creative Image', 'theplus' ),
					'animate-image'  => __( 'Scroll Reveal Image', 'theplus' ),
				],
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],				
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Animated Background Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'animated_style' => 'animate-image',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'animated_direction',
			[
				'label'   => __( 'Animation Direction', 'theplus' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'   => __( 'Left', 'theplus' ),
					'right'  => __( 'Right', 'theplus' ),
					'top'  => __( 'Top', 'theplus' ),
					'bottom'  => __( 'Bottom', 'theplus' ),
				],
				'condition' => [
					'animated_style' => 'animate-image',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'separator' => 'none',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'alignment',
			[
				'label' => __( 'Image Alignment', 'theplus' ),
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
				'toggle' => true,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => __( 'Link to', 'theplus' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'img_max_width',
			[
				'label' => __( 'Max Width Image', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px','%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pt_plus_animated_image img,{{WRAPPER}} .pt_plus_animated_image .scroll-image-wrap,{{WRAPPER}} .pt_plus_animated_image figure.js-tilt' => 'max-width: {{SIZE}}{{UNIT}};width:100%;',
				],
				'condition' => [
					'animated_style' => ['creative-simple-image'],
				],
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'section_image_styling',
            [
                'label' => __('Style Image', 'theplus'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'scroll_image_effect',
			[
				'label' => __( 'Scroll Image', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,				
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'scroll_image_height',
			[
				'label' => __( 'Min Height', 'theplus' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					],
				],
				'default' => [
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap .creative-scroll-image' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'scroll_image_effect' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'transition_duration',
			[
				'label'   => __( 'Transition Duration', 'theplus' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'step' => 0.1,
						'min'  => 0.1,
						'max'  => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap .creative-scroll-image' => 'transition: background-position {{SIZE}}s ease-in-out;-webkit-transition: background-position {{SIZE}}s ease-in-out;',
				],
				'condition' => [
					'scroll_image_effect' => 'yes',
				],
			]
		);
		$this->add_control(
			'mask_image_display',
			[
				'label' => __( 'Mask Image Shape', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __('Use PNG image with the shape you want to mask around Media Image.', 'theplus' ),
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'animated_style' => ['creative-simple-image'],
				],
			]
		);
		$this->add_control(
			'mask_shape_image',
			[
				'label' => __( 'Mask Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'description' => __( 'Use PNG image with the shape you want to mask around feature image.', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .pt_plus_animated_image .vc_single_image-wrapper.creative-mask-media' => 'mask-image: url({{URL}});-webkit-mask-image: url({{URL}});',
				],
				'condition' => [
					'animated_style' => ['creative-simple-image'],
					'mask_image_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'mask_image_shadow',
			[
				'label' => __( 'Image Shadow', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'description' => __( 'Ex. 1px 1px 4px rgba(0,0,0,0.75)', 'theplus' ),
				'selectors' => [
					'{{WRAPPER}} .pt_plus_animated_image' => '-webkit-filter: drop-shadow({{VALUE}});-moz-filter: drop-shadow({{VALUE}});-ms-filter: drop-shadow({{VALUE}});-o-filter: drop-shadow({{VALUE}});filter: drop-shadow({{VALUE}});',
				],
				'render_type' => 'ui',
				'condition' => [
					'animated_style' => ['creative-simple-image'],
					'mask_image_display' => 'yes',
				],
			]
		);
		$this->add_control(
			'bg_image_parallax',
			[
				'label' => __( 'Super Parallax', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => __('This effect will be parallax on scroll effect. It will move image as you scroll your page.', 'theplus' ),
				'label_on' => __( 'On', 'theplus' ),
				'label_off' => __( 'Off', 'theplus' ),
				'default' => 'no',
				'render_type'  => 'template',
				'separator' => 'before',
				'condition' => [
					'animated_style' => ['creative-simple-image'],
				],
			]
		);
		$this->add_control(
			'super_scroll_parallax',
			[
				'label' => __( 'Move Scroll (X)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 40,
						'max' => 700,
						'step' => 4,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 120,
				],
				'condition' => [
					'animated_style' => ['creative-simple-image'],
					'bg_image_parallax' => 'yes',
				],
			]
		);
		$this->add_control(
			'plus_mouse_move_parallax',
			[
				'label'        => esc_html__( 'Mouse Move Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'description' => __('This effect will be parallax on scroll effect. It will move image as you scroll your page.', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Theplus_Mouse_Move_Parallax_Group::get_type(),
			array(
				'label' => __( 'Parallax Options', 'theplus' ),
				'name'           => 'plus_mouse_parallax',
				'condition'    => [
					'plus_mouse_move_parallax' => [ 'yes' ],
				],
			)
		);
		$this->add_control(
			'magic_scroll',
			[
				'label'        => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'description' => __('This effect will be parallax on scroll effect. It will move image as you scroll your page.', 'theplus' ),
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			array(
				'label' => __( 'Scroll Options', 'theplus' ),
				'name'           => 'scroll_option',
				'render_type'  => 'template',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		$this->start_controls_tabs( 'tabs_magic_scroll' );
		$this->start_controls_tab(
			'tab_scroll_from',
			[
				'label' => __( 'Initial', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label' => __( 'Initial Position', 'theplus' ),
				'name'           => 'scroll_from',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scroll_to',
			[
				'label' => __( 'Final', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label' => __( 'Final Position', 'theplus' ),
				'name'           => 'scroll_to',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'plus_tooltip',
			[
				'label'        => esc_html__( 'Tooltip', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'render_type'  => 'template',
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'plus_tooltip_tabs' );

		$this->start_controls_tab(
			'plus_tooltip_content_tab',
			[
				'label' => esc_html__( 'Content', 'theplus' ),
				'render_type'  => 'template',
				'condition' => [
					'plus_tooltip' => 'yes',
				],
			]
		);
		$this->add_control(
			'plus_tooltip_content_type',
			[
				'label' => __( 'Content Type', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'normal_desc',
				'options' => [
					'normal_desc'  => __( 'Content Text', 'theplus' ),
					'content_wysiwyg'  => __( 'Content WYSIWYG', 'theplus' ),
				],
				'render_type'  => 'template',
				'condition' => [
					'plus_tooltip' => 'yes',
				],
			]
		);
		$this->add_control(
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
		$this->add_control(
			'plus_tooltip_content_wysiwyg',
			[
				'label' => __( 'Tooltip Content', 'theplus' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'Luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'theplus' ),
				'render_type'  => 'template',
				'condition' => [
					'plus_tooltip_content_type' => 'content_wysiwyg',
					'plus_tooltip' => 'yes',
				],
			]				
		);
		$this->add_control(
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
					'{{WRAPPER}} .tippy-tooltip .tippy-content' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'plus_tooltip_content_type' => 'normal_desc',
					'plus_tooltip' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'plus_tooltip_content_typography',
				'selector' => '{{WRAPPER}} .tippy-tooltip .tippy-content',
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
					'plus_tooltip' => 'yes',
				],
			]
		);

		$this->add_control(
			'plus_tooltip_content_color',
			[
				'label'  => esc_html__( 'Text Color', 'theplus' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tippy-tooltip .tippy-content,{{WRAPPER}} .tippy-tooltip .tippy-content p' => 'color: {{VALUE}}',
				],
				'condition' => [
					'plus_tooltip_content_type' => ['normal_desc','content_wysiwyg'],
					'plus_tooltip' => 'yes',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'plus_tooltip_styles_tab',
			[
				'label' => esc_html__( 'Style', 'theplus' ),
				'condition' => [
					'plus_tooltip' => 'yes',
				],
			]
		);
		$this->add_group_control(
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
		$this->add_group_control(
			\Theplus_Tooltips_Option_Style_Group::get_type(),
			array(
				'label' => __( 'Style Options', 'theplus' ),
				'name'           => 'tooltip_style',
				'render_type'  => 'template',
				'condition'    => [
					'plus_tooltip' => [ 'yes' ],
				],
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'plus_tilt_parallax',
			[
				'label'        => esc_html__( 'Tilt 3D Parallax', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),					
				'description' => __('You can put option of on hover tilt effect on section using this option.', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Theplus_Tilt_Parallax_Group::get_type(),
			array(
				'label' => __( 'Tilt Options', 'theplus' ),
				'name'           => 'plus_tilt_opt',
				'condition'    => [
					'plus_tilt_parallax' => [ 'yes' ],
				],
			)
		);
		$this->add_control(
			'plus_overlay_effect',
			[
				'label'        => esc_html__( 'Overlay Special Effect', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'description' => __('This effect will create two color animation ok this when someone scroll and reach to this section.', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Theplus_Overlay_Special_Effect_Group::get_type(),
			array(
				'label' => __( 'Overlay Color', 'theplus' ),
				'name'           => 'plus_overlay_spcial',
				'condition'    => [
					'plus_overlay_effect' => [ 'yes' ],
				],
			)
		);
		
		$this->add_control(
			'plus_continuous_animation',
			[
				'label'        => esc_html__( 'Continuous Animation', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'plus_animation_effect',
			[
				'label' => __( 'Animation Effect', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'pulse',
				'options' => [
					'pulse'  => __( 'Pulse', 'theplus' ),
					'floating'  => __( 'Floating', 'theplus' ),
					'tossing'  => __( 'Tossing', 'theplus' ),
					'rotating'  => __( 'Rotating', 'theplus' ),
				],
				'render_type'  => 'template',
				'condition' => [
					'plus_continuous_animation' => 'yes',
				],
			]
		);
		$this->add_control(
			'plus_animation_hover',
			[
				'label'        => esc_html__( 'Hover animation', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),					
				'render_type'  => 'template',
				'condition' => [
					'plus_continuous_animation' => 'yes',
				],
			]
		);
		
		$this->add_control(
			'plus_transform_origin',
			[
				'label' => __( 'Transform Origin', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'center center',
				'options' => [
					'top left'  => __( 'Top Left', 'theplus' ),
					'top center"'  => __( 'Top Center', 'theplus' ),
					'top right'  => __( 'Top Right', 'theplus' ),
					'center left'  => __( 'Center Left', 'theplus' ),
					'center center'  => __( 'Center Center', 'theplus' ),
					'center right'  => __( 'Center Right', 'theplus' ),
					'bottom left'  => __( 'Bottom Left', 'theplus' ),
					'bottom center'  => __( 'Bottom Center', 'theplus' ),
					'bottom right'  => __( 'Bottom Right', 'theplus' ),
				],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper' => '-webkit-transform-origin: {{VALUE}};-moz-transform-origin: {{VALUE}};-ms-transform-origin: {{VALUE}};-o-transform-origin: {{VALUE}};transform-origin: {{VALUE}};',
				],
				'render_type'  => 'template',
				'condition' => [
					'plus_continuous_animation' => 'yes',
					'plus_animation_effect' => 'rotating',
				],
			]
		);
		$this->add_control(
			'plus_animation_duration',
			[	
				'label' => __( 'Duration Time', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => 's',
				'range' => [
					's' => [
						'min' => 0.5,
						'max' => 50,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => 2.5,
				],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper' => 'animation-duration: {{SIZE}}{{UNIT}};-webkit-animation-duration: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'plus_continuous_animation' => 'yes',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'image_border',
			[
				'label' => __( 'Border', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'image_border_style',
			[
				'label' => __( 'Border Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => theplus_get_border_style(),
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-style: {{VALUE}};',
				],
				'condition' => [
					'image_border' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'image_border_width',
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
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'image_border' => 'yes',
				],
			]
		);
		$this->start_controls_tabs( 'tabs_css_filter_style' );
		$this->start_controls_tab(
			'tab_css_filter_normal',
			[
				'label' => __( 'Normal', 'theplus' ),
			]
		);
		$this->add_control(
			'image_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-color: {{VALUE}};',
				],
				'condition' => [					
					'image_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'image_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap',				
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper img,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap',
				'separator' => 'before',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_css_filter_hover',
			[
				'label' => __( 'Hover', 'theplus' ),
			]
		);
		$this->add_control(
			'image_hover_border_color',
			[
				'label' => __( 'Border Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#252525',
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [					
					'image_border' => 'yes',
				],
			]
		);
		
		$this->add_responsive_control(
			'image_hover_border_radius',
			[
				'label'      => __( 'Border Radius', 'theplus' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);
		$this->add_control(
			'image_hover_shadow_options',
			[
				'label' => __( 'Box Shadow Options', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_hover_shadow',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper .pt_plus_animated_image img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover',				
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'hover_css_filters',
				'selector' => '{{WRAPPER}} .pt-plus-animated-image-wrapper img:hover,{{WRAPPER}} .pt-plus-animated-image-wrapper .scroll-image-wrap:hover',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
			'desktop_opt',[
				'label'   => esc_html__( 'Desktop', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->add_control(
			'tablet_opt',[
				'label'   => esc_html__( 'Tablet', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->add_control(
			'mobile_opt',[
				'label'   => esc_html__( 'Mobile', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'condition'    => [
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		
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
		$animated_style = $settings['animated_style'];
		$animated_direction = $settings['animated_direction'];
		
			$visiblity_hide='';
			if(!empty($settings['responsive_visible_opt']) && $settings['responsive_visible_opt']=='yes'){
				$visiblity_hide .= (($settings['desktop_opt']!='yes' && $settings['desktop_opt']=='') ? 'desktop-hide ' : '' );							
				$visiblity_hide .= (($settings['tablet_opt']!='yes' && $settings['tablet_opt']=='') ? 'tablet-hide ' : '' );
				$visiblity_hide .= (($settings['mobile_opt']!='yes' && $settings['mobile_opt']=='') ? 'mobile-hide ' : '' );
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
			
			$tilt_attr=$hover_tilt='';
			if(!empty($settings['plus_tilt_parallax']) && $settings['plus_tilt_parallax']=='yes'){
				$hover_tilt='js-tilt';
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
			
			$move_parallax=$move_parallax_attr=$parallax_move='';
			if(!empty($settings['plus_mouse_move_parallax']) && $settings['plus_mouse_move_parallax']=='yes'){
				$move_parallax='pt-plus-move-parallax';
				$parallax_move='parallax-move';
				$parallax_speed_x=($settings["plus_mouse_parallax_speed_x"]["size"]!='') ? $settings["plus_mouse_parallax_speed_x"]["size"] : 30;
				$parallax_speed_y=($settings["plus_mouse_parallax_speed_y"]["size"]!='') ? $settings["plus_mouse_parallax_speed_y"]["size"] : 30;
				$move_parallax_attr .= ' data-move_speed_x="' . esc_attr($parallax_speed_x) . '" ';
				$move_parallax_attr .= ' data-move_speed_y="' . esc_attr($parallax_speed_y) . '" ';
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
			
			$content_image = '';
			$img_id=$settings["image"]["id"];
			
			
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
				$this->add_render_attribute( 'image', 'class', 'hover__img info_img' );
				$content_image = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );				
			}else{ 
				$content_image .= theplus_loading_image_grid(get_the_ID());
			}
			
			$scroll_image='';
			if(!empty($settings["scroll_image_effect"]) && $settings['scroll_image_effect']=='yes'){
				$this->add_render_attribute( 'scroll-image', 'style', 'background-image: url(' . esc_url($settings['image']['url']) . ');' );
				$content_image ='<div class="creative-scroll-image" ' . $this->get_render_attribute_string( 'scroll-image' ) . '></div>';
				$scroll_image='scroll-image-wrap';
			}
			
			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( ! empty( $settings['link']['nofollow'] ) ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}
			}
			
			$mask_image='';
			if(!empty($settings["mask_image_display"]) && $settings["mask_image_display"]=='yes'){
				$mask_image=' creative-mask-media';
			}
			$wrapperClass='vc_single_image-wrapper '.esc_attr($mask_image).' '.esc_attr($scroll_image);
			if($animated_style=='creative-simple-image'){
				$wrapperClass = 'vc_single_image-wrapper '.esc_attr($mask_image).' '.esc_attr($scroll_image);
			}
			
			$data_image='';
			if ( $img_id != '' ) {
				$full_image=wp_get_attachment_image_src( $img_id, 'full' );
				$data_image='background:url('.esc_url($full_image[0]).') #f7f7f7;';
			}else{ 
				$data_image = theplus_loading_image_grid('','background');
			}
			
			if ( ! empty( $settings['link']['url'] ) ) {
				if($animated_style=='animate-image'){			
					$html = '<a ' . $this->get_render_attribute_string( 'link' ) . ' class="' . $wrapperClass . ' pt-plus-bg-image-animated '.esc_attr($animated_direction).'" style="'.$data_image.'" >' .$content_image. '</a>';
				}else{
					$html = '<a ' . $this->get_render_attribute_string( 'link' ) . ' class="' . esc_attr($wrapperClass) . ' '.esc_attr($reveal_effects).' " '.$effect_attr.'>' .$content_image. '</a>';
				}
			} else {
				if($animated_style=='animate-image'){			
					$html = '<div class="' . $wrapperClass . ' pt-plus-bg-image-animated '.esc_attr($animated_direction).'" style="'.$data_image.'" >' .$content_image. '</div>';
				}else{
					$html = '<div class="' . esc_attr($wrapperClass) . ' '.esc_attr($reveal_effects).'" '.$effect_attr.'>' .$content_image. '</div>';
				}
			}
			
			$uid=uniqid('bg-image');
			$css_rule=$css_data='';
			
			if($animated_style=='animate-image'){
				$bg_animated=' background-image-animated ';
				$bg_anim=' bg-img-animated ';
				$animated_class='animate-general';
				$css_data ='.'.esc_js($uid).' .pt-plus-bg-image-animated:after{background:'.esc_js($settings["bg_color"]).';}';
			}else{
				$bg_animated=$bg_anim='';
			}
			
			$css_class='';
			$css_class = ' text-' . $settings["alignment"] . ' '.esc_attr($animated_class);
			
			$parallax_image_scroll='';
			if(!empty($settings['bg_image_parallax']) && $settings['bg_image_parallax']=='yes' && $animated_style=='creative-simple-image'){
				$parallax_image_scroll='section-parallax-img';
				
				$html .='<figure class="creative-simple-img-parallax" data-scroll-parallax="'.$settings["super_scroll_parallax"]["size"].'"><figure class="pt-plus-parallax-img-parent"><div class="parallax-img-container">';
					$image=wp_get_attachment_image_src( $img_id, 'full' );
				$html .='<img class="simple-parallax-img" src="'.esc_url($image[0]).'"  title="">';
				$html .='</div></figure></figure>';
			}
			
			
			$uid_widget=uniqid("plus");
			if($animated_style=='creative-simple-image' || $animated_style=='animate-image'){
				$output = '<div id="'.esc_attr($uid_widget).'" class="pt-plus-animated-image-wrapper   ' . esc_attr($magic_class) . ' '.esc_attr($visiblity_hide).'  '.esc_attr($continuous_animation).'" '.$this->get_render_attribute_string( '_tooltip' ).'>';
					$output .= '<div class="animated-image-parallax  '.esc_attr($move_parallax).' ' . esc_attr($parallax_scroll) . '" ' . $magic_attr . '>';
						$output .= '<div class="pt_plus_animated_image '.esc_attr($uid).' ' .  trim( $css_class ) . ' '.esc_attr($bg_anim).' " '.$animation_attr.' >
							<figure class="'.esc_attr($parallax_image_scroll).' '.esc_attr($bg_animated).' '.esc_attr($parallax_move).'  '.esc_attr($hover_tilt).' " '.$this->get_render_attribute_string( '_tilt_parallax' ).' '.$move_parallax_attr.'>
								' . $html . '								
							</figure>
						</div>';
					$output .= '</div>';
				$output .= '</div>';
			}
			if($settings['plus_tooltip'] == 'yes'){
				$output .='<script>
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
			$css_rule='';
			if(!empty($css_data)){
				$css_rule='<style >';
					$css_rule .=$css_data;
				$css_rule .='</style>';
			}
		echo $css_rule.$output;
	}
    protected function content_template() {
	
    }

}