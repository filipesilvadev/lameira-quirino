<?php 
/*
Widget Name: Row Background 
Description: Most Advance Row Maker
Author: Theplus
Author URI: http://posimyththemes.com
*/
namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Row_Background extends Widget_Base {
	
	public function get_name() {
		return 'tp-row-background';
	}

    public function get_title() {
        return __('Row Background', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-paint-brush theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-creatives');
    }

    public function get_script_depends() {
        return [
            'theplus_frontend_scripts','particleground_js',
        ];
    }
	public function get_style_depends() {
		return [
			'vegas_css'
        ];
	}
	
	protected function _register_controls() {
		
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Deep Layer', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				]
		);
		$this->add_control(
            'select_anim', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Select Option', 'theplus'),
                'default' => '',
                'options' => [
                    '' => __('Select option', 'theplus'),
                    'bg_normal_color' => __('Solid Color', 'theplus'),
                    'bg_gradientcolor' => __('Gradient Color', 'theplus'),
                    'bg_color' => __('Animated Background Color', 'theplus'),
                    'bg_image' => __('Creative Background Image', 'theplus'),
                    'bg_video' => __('Creative Background Video', 'theplus'),
                    'bg_gallery' => __('Creative Background Gallery', 'theplus'),
                    'bg_Image_pieces' => __('Image Segmentation', 'theplus'),
                ],
            ]
        );
		/* solid color option*/
		
		$this->add_control(
            'normal_bg_color',
            [
                'label' => __('Background Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
				'condition'    => [
					'select_anim' => 'bg_normal_color',
				],
            ]
        );
		/* solid color option*/
		/* gradient color option*/		
		$this->add_control(
            'gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition'    => [
					'select_anim' => 'bg_gradientcolor',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition'    => [
					'select_anim' => 'bg_gradientcolor',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'gradient_color2',
            [
			'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'select_anim' => 'bg_gradientcolor',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition'    => [
					'select_anim' => 'bg_gradientcolor',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'select_anim' => 'bg_gradientcolor',
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'gradient_angle', [
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
				'condition'    => [
					'select_anim' => ['bg_gradientcolor'],
					'gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'condition' => [
					'select_anim' => [ 'bg_gradientcolor' ],
					'gradient_style' => 'radial',
			],
			'of_type' => 'gradient',
			]
        );
		/* gradient color option*/
		/*--------background image-------*/
		$this->add_control(
            'column_bg_image_new', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Background Image', 'theplus'),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
				],
			]
        );
		$this->add_control(
            'column_bg_image_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Image Position', 'theplus'),
				'default' => 'center center',
				'options' => theplus_get_image_position_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],			
			]
        );
		$this->add_control(
            'column_bg_img_attach', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Attachment', 'theplus'),
				'default' => 'scroll',
				'options' => theplus_get_image_attachment_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'column_bg_img_repeat', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Repeat', 'theplus'),
				'default' => 'repeat',
				'options' => theplus_get_image_reapeat_options(),
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'column_bg_image_size', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Size', 'theplus'),
				'default' => 'cover',
				'options' => theplus_get_image_size_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'columns_parallax_style', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Effect', 'theplus'),
				'default' => 'columns_simple_image',
				'options' => [
                    'columns_simple_image' => __('Normal Background Image', 'theplus'),
                    'columns_animated_bg' => __('Auto Moving Background Image', 'theplus'),
                ],
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'image_parallax_style', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Special Image Hover Effects', 'theplus'),
				'default' => '',
				'options' => [
                    '' => __('Select Style', 'theplus'),
                    'style_1' => __('Parallax Tilt Effect', 'theplus'),
                    'style_2' => __('Parallax Move Effect', 'theplus'),
                ],
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
			 'image_parallax_amount', [
				'label' => __( 'Intensity Parallax', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 20,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 30,
				],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'image_parallax_style' => ['style_1','style_2'],
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_control(
			 'image_parallax_perspective', [
				'label' => __( 'Perspective', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 100,
						'max' => 5000,
						'step' => 200,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1000,
				],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'image_parallax_style' => 'style_1',
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_control(
			 'image_parallax_scale', [
				'label' => __( 'Scale', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0.7,
						'max' => 1.8,
						'step' => 0.05,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1,
				],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'image_parallax_style' => ['style_1','style_2'],
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_control(
			'image_parallax_inverted',
			[
				'label'   => esc_html__( 'Inverted', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'True', 'theplus' ),
				'label_off' => __( 'False', 'theplus' ),
				'default' => 'no',
				'separator' => 'after',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'image_parallax_style' => ['style_1','style_2'],
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_control(
            'columns_animation_direction', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Effect', 'theplus'),
				'default' => '',
				'options' => [
                    '' => __('None', 'theplus'),
                    'right' => __('Left to Right', 'theplus'),
                    'left' => __('Right to Left', 'theplus'),
                    'top' => __('Top to Bottom', 'theplus'),
                    'bottom' => __('Bottom to Top', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_animated_bg',
					'column_bg_image_new[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'columns_parallax_sense',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Transition Speed', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'render_type' => 'ui',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_animated_bg',
					'column_bg_image_new[url]!' => '',
				],
            ]
        );
		$this->add_control(
			'bg_img_parallax',
			[
				'label'   => esc_html__( 'Scroll Parallax', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => '',
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'columns_parallax_style' => 'columns_simple_image',
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_control(
			'magic_scroll',
			[
				'label'        => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'column_bg_image_new[url]!' => '',
				],
			]
		);
		$this->add_group_control(
			\Theplus_Magic_Scroll_Option_Style_Group::get_type(),
			array(
				'label' => __( 'Scroll Options', 'theplus' ),
				'name'           => 'scroll_option',
				'condition'    => [
					'select_anim' => [ 'bg_image' ],
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
					'select_anim' => [ 'bg_image' ],
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
					'select_anim' => [ 'bg_image' ],
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
					'select_anim' => [ 'bg_image' ],
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
					'select_anim' => [ 'bg_image' ],
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'bg_kenburns_effect',
			[
				'label' => __( 'Ken-Burns Effect', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
				],
			]
		);
		$this->add_control(
            'kenburn_effect_direction', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Effect Direction', 'theplus'),
				'default' => 'normal',
				'options' => [
                    'normal' => __('Normal', 'theplus'),
                    'alternate' => __('Alternate', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'bg_kenburns_effect' => 'yes',
				],		
			]
        );
		$this->add_control(
			'kenburn_effect_duration',
			[
				'label' => __( 'Effect Duration(Speed)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => '',
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 15,
				],
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'bg_kenburns_effect' => 'yes',
				],
			]
		);
		$this->add_control(
			'responsive_image',
			[
				'label'        => esc_html__( 'Responsive Image', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_image' ],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_responsive_image' );
		$this->start_controls_tab(
			'tab_responsive_tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
            'tablet_bg_image', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Tablet Image', 'theplus'),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
				],
			]
        );
		$this->add_control(
            'tablet_bg_image_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Image Position', 'theplus'),
				'default' => 'center center',
				'options' => theplus_get_image_position_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'tablet_bg_image[url]!' => '',
				],			
			]
        );
		$this->add_control(
            'tablet_bg_img_attach', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Attachment', 'theplus'),
				'default' => 'scroll',
				'options' => theplus_get_image_attachment_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'tablet_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'tablet_bg_img_repeat', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Repeat', 'theplus'),
				'default' => 'repeat',
				'options' => theplus_get_image_reapeat_options(),
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'tablet_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'tablet_bg_image_size', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Size', 'theplus'),
				'default' => 'cover',
				'options' => theplus_get_image_size_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'tablet_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'tablet_overlay_color',
            [
                'label' => __('Overlay Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
				'condition'    => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'tablet_bg_image[url]!' => '',
				],
            ]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_responsive_mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
            'mobile_bg_image', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Mobile Image', 'theplus'),				
				'condition' => [
					'responsive_image' => [ 'yes' ],
					'select_anim' => [ 'bg_image' ],
				],
			]
        );
		$this->add_control(
            'mobile_bg_image_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Image Position', 'theplus'),
				'default' => 'center center',
				'options' => theplus_get_image_position_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'mobile_bg_image[url]!' => '',
				],			
			]
        );
		$this->add_control(
            'mobile_bg_img_attach', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Attachment', 'theplus'),
				'default' => 'scroll',
				'options' => theplus_get_image_attachment_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'mobile_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'mobile_bg_img_repeat', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Repeat', 'theplus'),
				'default' => 'repeat',
				'options' => theplus_get_image_reapeat_options(),
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'mobile_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'mobile_bg_image_size', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Size', 'theplus'),
				'default' => 'cover',
				'options' => theplus_get_image_size_options(),				
				'condition' => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'mobile_bg_image[url]!' => '',
				],		
			]
        );
		$this->add_control(
            'mobile_overlay_color',
            [
                'label' => __('Overlay Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
				'condition'    => [
					'select_anim' => [ 'bg_image' ],
					'responsive_image' => [ 'yes' ],
					'mobile_bg_image[url]!' => '',
				],
            ]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*--------background image-------*/
		/*--------Animated color-------*/
		$this->add_control(
            'columns_bg_colors',
            [
				'label' => __( 'Select Multiple Colors', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'column_bg_single_color' => '#212121',                       
                    ],
					[
                        'column_bg_single_color' => '#ff5b5b',                       
                    ],
					[
                        'column_bg_single_color' => '#4054b2',                       
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'column_bg_single_color',
                        'type' => Controls_Manager::COLOR,
                        'label_block' => true,
                        'label' => __('Color', 'theplus'),
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ column_bg_single_color }}}',
				'condition' => [
					'select_anim' => [ 'bg_color' ],
				],
            ]
        );
		$this->add_control(
            'column_anim_bg_duration',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Animation Duration', 'theplus'),
                'label_block' => true,
                'default' => __('3000', 'theplus'),
				'condition' => [
					'select_anim' => [ 'bg_color' ],
				],
            ]
        );
		/*--------Animated color-------*/
		/*--------background video-------*/
		$this->add_control(
            'columns_video_variant', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Video Source', 'theplus'),
                'default' => 'youtube',
                'options' => [
                    'self-hosted' => __('Self Hosted', 'theplus'),
                    'youtube' => __('YouTube', 'theplus'),
                    'vimeo' => __('Vimeo', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
            ]
        );
		$this->add_control(
            'columns_video_url_mp4',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('URL of Video (MP4)', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '',
                'condition'    => [
					'select_anim' => [ 'bg_video' ],
					'columns_video_variant' => 'self-hosted',
				],
            ]
        );
		$this->add_control(
            'columns_video_url_webm',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('URL of Video (WebM/Ogg)', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '',
                'condition'    => [
					'select_anim' => [ 'bg_video' ],
					'columns_video_variant' => 'self-hosted',
				],
            ]
        );
		$this->add_control(
            'columns_youtube_video_id',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Enter YouTube Video ID', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => 'QrI0jo5JZSs',
                'condition'    => [
					'select_anim' => [ 'bg_video' ],
					'columns_video_variant' => 'youtube',
				],
            ]
        );
		$this->add_control(
            'columns_vimeo_video_id',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Enter Vimeo Video ID', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '241417119',
                'condition'    => [
					'select_anim' => [ 'bg_video' ],
					'columns_video_variant' => 'vimeo',
				],
            ]
        );
		$this->add_control(
			'columns_video_loop',
			[
				'label'   => esc_html__( 'Loop', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',				
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
			]
		);
		$this->add_control(
			'columns_video_muted',
			[
				'label'   => esc_html__( 'Mute', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',				
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
			]
		);
		$this->add_control(
            'columns_video_poster', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Fallback Image', 'theplus'),				
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
			]
        );
		$this->add_control(
			'fixed_bg_video',
			[
				'label'   => esc_html__( 'Parallax Background Video', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'default' => 'no',
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
			]
		);
		$this->add_control(
			'responsive_bg_video',
			[
				'label'        => esc_html__( 'Responsive Bg Video', 'theplus' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'theplus' ),
				'label_off'    => esc_html__( 'No', 'theplus' ),
				'separator' => 'before',
				'condition' => [
					'select_anim' => [ 'bg_video' ],
				],
			]
		);
		$this->start_controls_tabs( 'tabs_responsive_video' );
		$this->start_controls_tab(
			'tab_responsive_video_tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
				'condition' => [
					'select_anim' => [ 'bg_video' ],
					'responsive_bg_video' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
            'tablet_video_poster', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Fallback Image', 'theplus'),
				'condition' => [
					'select_anim' => [ 'bg_video' ],
					'responsive_bg_video' => [ 'yes' ],
				],
			]
        );
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_responsive_video_mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
				'condition' => [
					'select_anim' => [ 'bg_video' ],
					'responsive_bg_video' => [ 'yes' ],
				],
			]
		);
		$this->add_control(
            'mobile_video_poster', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Fallback Image', 'theplus'),
				'condition' => [
					'select_anim' => [ 'bg_video' ],
					'responsive_bg_video' => [ 'yes' ],
				],
			]
        );
		$this->end_controls_tab();
		$this->end_controls_tabs();
		/*--------background video-------*/
		/*--------background gallery-------*/
		$this->add_control(
			'images_gallery',
			[
				'label' => __( 'Add Multiple Images', 'theplus' ),
				'type' => Controls_Manager::GALLERY,
				'default' => [],
				'condition' => [
					'select_anim' => [ 'bg_gallery' ],
				],
			]
		);
		$this->add_control(
            'gallery_slide_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Transition Effects', 'theplus'),
                'default' => 'fade2',
                'options' => [
                    'fade2' => __('Fade', 'theplus'),
                    'blur2' => __('Blur', 'theplus'),
                    'flash2' => __('Flash', 'theplus'),
                    'negative2' => __('Negative', 'theplus'),
                    'burn2' => __('Burn', 'theplus'),
                    'slideLeft2' => __('SlideLeft', 'theplus'),
                    'slideRight2' => __('SlideRight', 'theplus'),
                    'slideUp2' => __('SlideUp', 'theplus'),
                    'slideDown2' => __('SlideDown', 'theplus'),
                    'zoomIn2' => __('ZoomIn', 'theplus'),
                    'zoomOut2' => __('ZoomOut', 'theplus'),
                    'SwirlLeft2' => __('SwirlLeft', 'theplus'),
                    'swirlRight2' => __('SwirlRight', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_gallery' ],
				],
            ]
        );
		
		$this->add_control(
            'gallery_animation_duration',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Transition Duration', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '5000',
                'condition'    => [
					'select_anim' => [ 'bg_gallery' ],
				],
            ]
        );
		$this->add_control(
            'slide_delay_time',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Slide Delay Time', 'theplus'),
                'label_block' => true,
                'default' => '7000',
                'condition'    => [
					'select_anim' => [ 'bg_gallery' ],
				],
            ]
        );
		$this->add_control(
            'gallery_overlays', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Texture Overlay', 'theplus'),
                'default' => 'false',
                'options' => [
                    'false' => __('Off', 'theplus'),
                    '1' => __('Style 1', 'theplus'),
                    '2' => __('Style 2', 'theplus'),
                    '3' => __('Style 3', 'theplus'),
                    '4' => __('Style 4', 'theplus'),
                    '5' => __('Style 5', 'theplus'),
                    '6' => __('Style 6', 'theplus'),
                    '7' => __('Style 7', 'theplus'),
                    '8' => __('Style 8', 'theplus'),
                    '9' => __('Style 9', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_gallery' ],
				],
            ]
        );
		/*--------background gallery-------*/
		/*--------Image segmentation-------*/
		$this->add_control(
            'bg_options', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Background', 'theplus'),
                'default' => 'bg_image',
                'options' => [
                    'bg_image' => __('Image', 'theplus'),
                    'bg_color' => __('Solid Color', 'theplus'),
                    'bg_gradient' => __('Gradient Color', 'theplus'),
                ],
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
				],
            ]
        );
		$this->add_control(
            'bg_image', [
				'type' => Controls_Manager::MEDIA,
				'label' => __('Upload Image', 'theplus'),				
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_image' ],
				],
			]
        );
		$this->add_control(
            'bg_pieces_color',
            [
                'label' => __('Select Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff214f',
                'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_color' ],
				],
            ]
        );
		$this->add_control(
            'bg_gradient1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'bg_gradient1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'render_type' => 'ui',
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'bg_gradient2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'bg_gradient2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'render_type' => 'ui',
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'bg_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'bg_gradient_angle', [
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
					'{{SELECTOR}} .pt-plus-row-set .pt-plus-row-imageclip' => 'background-color: transparent; background-image: linear-gradient({{SIZE}}{{UNIT}}, {{bg_gradient1.VALUE}} {{bg_gradient1_control.SIZE}}{{bg_gradient1_control.UNIT}}, {{bg_gradient2.VALUE}} {{bg_gradient2_control.SIZE}}{{bg_gradient2_control.UNIT}})',
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
					'bg_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'bg_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-row-set .pt-plus-row-imageclip' => 'background-color: transparent; background-image: radial-gradient(at {{VALUE}}, {{bg_gradient1.VALUE}} {{bg_gradient1_control.SIZE}}{{bg_gradient1_control.UNIT}}, {{bg_gradient2.VALUE}} {{bg_gradient2_control.SIZE}}{{bg_gradient2_control.UNIT}})',
				],
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'bg_options' => [ 'bg_gradient' ],
					'bg_gradient_style' => 'radial',
			],
			'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'style_of_pieces', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Layout Style', 'theplus'),
				'options' => [
					'style-1' => __('Style 1', 'theplus'),
					'style-2' => __('Style 2', 'theplus'),
					'style-3' => __('Style 3', 'theplus'),
					'style-4' => __('Style 4', 'theplus'),
					'style-5' => __('Style 5', 'theplus'),
					'style-6' => __('Style 6', 'theplus'),
					'custom' => __('Custom', 'theplus'),				
				],
				'default' => 'style-1',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
				],
			]
        );
		$this->add_control(
            'image_clip_opt',
            [
				'label' => __( 'No of Segmentation On Position', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'pos_xposition' => '45',                       
                        'pos_yposition' => '20',                       
                        'pos_width' => '50',                       
                        'pos_height' => '70',                       
                        'animate_pieces' => 'scale',                       
                        'animate_speed' => '2s',                       
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'pos_xposition',
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'label' => __('Left', 'theplus'),
                        'default' => '45',
                    ],
					[
                        'name' => 'pos_yposition',
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'label' => __('Top', 'theplus'),
                        'default' => '20',
                    ],
					[
                        'name' => 'pos_width',
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'label' => __('Width', 'theplus'),
                        'default' => '50',
                    ],
					[
                        'name' => 'pos_height',
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'label' => __('Height', 'theplus'),
                        'default' => '50',
                    ],
					[
                        'name' => 'animate_pieces',
                        'type' => Controls_Manager::SELECT,
                        'label_block' => true,
						'options' => [
							'' => __('Select Animate', 'theplus'),
							'scale' => __('Scale', 'theplus'),
							'float' => __('Float', 'theplus'),
							'rotate' => __('Rotate', 'theplus'),
							'flash' => __('Flash', 'theplus'),
						],
                        'label' => __('Segment Animation', 'theplus'),
                        'default' => '',
                    ],
					[
                        'name' => 'animate_speed',
                        'type' => Controls_Manager::SELECT,
                        'label_block' => true,
						'options' => [
							'' => __('Select Animate speed', 'theplus'),
							'1s' => __('1s', 'theplus'),
							'2s' => __('2s', 'theplus'),
							'3s' => __('3s', 'theplus'),
							'4s' => __('4s', 'theplus'),
							'5s' => __('5s', 'theplus'),
							'6s' => __('6s', 'theplus'),
							'7s' => __('7s', 'theplus'),
							'8s' => __('8s', 'theplus'),
							'9s' => __('9s', 'theplus'),
							'10s' => __('10s', 'theplus'),
						],
                        'label' => __('Segment Animation', 'theplus'),
                        'default' => '',
                    ],
                ],
                'title_field' => '{{{ pos_xposition }}}',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
            ]
        );
		$this->add_control(
            'no_of_pieces', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Number of Segmentations', 'theplus'),
				'separator'=> 'before',
				'options' => [
					'1' => __('1', 'theplus'),
					'2' => __('2', 'theplus'),
					'3' => __('3', 'theplus'),
					'4' => __('4', 'theplus'),
					'5' => __('5', 'theplus'),
					'6' => __('6', 'theplus'),
					'7' => __('7', 'theplus'),			
					'8' => __('8', 'theplus'),			
					'9' => __('9', 'theplus'),			
				],
				'default' => '1',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
			'parallax_effect',
			[
				'label'   => esc_html__( 'Mouse Hover Parallax Effect', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'false',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
		);
		$this->add_control(
            'min_parallax', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Minimum Parallax Value', 'theplus'),
				'size_units' => '',
				'default' => [
					'size' => 10,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'max_parallax', [
				'type' => Controls_Manager::SLIDER,
				'label' => __('Maximum Parallax Value', 'theplus'),
				'size_units' => '',
				'default' => [
					'size' => 40,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'opacity_pieces', [
				'type' => Controls_Manager::SLIDER,
				'separator'=> 'before',
				'label' => __('Segments Opacity', 'theplus'),
				'size_units' => '',
				'default' => [
					'size' => 0,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'top_shadow', [
				'type' => Controls_Manager::SLIDER,
				'separator'=> 'before',
				'label' => __('Top Shadow', 'theplus'),
				'size_units' => '',
				'default' => [
					'size' => 10,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'left_shadow', [
				'type' => Controls_Manager::SLIDER,
				'separator'=> 'before',
				'label' => __('Left Shadow', 'theplus'),
				'size_units' => '',
				'default' => [
					'size' => 10,
				],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 100,
						'step' => 2,
					],
				],
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'anim_duration',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Animation Time Duration', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '1500',
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
            ]
        );
		$this->add_control(
            'easing_transition', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Transition Effect', 'theplus'),
				'separator'=> 'before',
				'options' => [
					'linear' => __('linear', 'theplus'),
					'swing' => __('swing', 'theplus'),
					'easeInQuad' => __('easeInQuad', 'theplus'),
					'easeOutQuad' => __('easeOutQuad', 'theplus'),
					'easeInOutQuad' => __('easeInOutQuad', 'theplus'),
					'easeInCubic' => __('easeInCubic', 'theplus'),			
					'easeOutCubic' => __('easeOutCubic', 'theplus'),			
					'easeInOutCubic' => __('easeInOutCubic', 'theplus'),			
					'easeInQuart' => __('easeInQuart', 'theplus'),			
					'easeOutQuart' => __('easeOutQuart', 'theplus'),			
					'easeInOutQuart' => __('easeInOutQuart', 'theplus'),			
					'easeInQuint' => __('easeInQuint', 'theplus'),			
					'easeOutQuint' => __('easeOutQuint', 'theplus'),			
					'easeInOutQuint' => __('easeInOutQuint', 'theplus'),			
					'easeInExpo' => __('easeInExpo', 'theplus'),			
					'easeOutExpo' => __('easeOutExpo', 'theplus'),			
					'easeInOutExpo' => __('easeInOutExpo', 'theplus'),			
					'easeInSine' => __('easeInSine', 'theplus'),			
					'easeOutSine' => __('easeOutSine', 'theplus'),			
					'easeInOutSine' => __('easeInOutSine', 'theplus'),			
					'easeInCirc' => __('easeInCirc', 'theplus'),			
					'easeOutCirc' => __('easeOutCirc', 'theplus'),			
					'easeInOutCirc' => __('easeInOutCirc', 'theplus'),			
					'easeOutElastic' => __('easeOutElastic', 'theplus'),			
					'easeOutBack' => __('easeOutBack', 'theplus'),			
					'easeOutBounce' => __('easeOutBounce', 'theplus'),			
				],
				'default' => 'linear',
				'condition' => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
			]
        );
		$this->add_control(
            'delay_transition',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Transition Delay', 'theplus'),
                'label_block' => true,
                'default' => '100',
                'description' => __("E.g. 50,100 etc..", "theplus"),
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
            ]
        );
		$this->add_control(
            'translatez_min',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Minimum TranslateZ', 'theplus'),
                'label_block' => true,
                'separator' => 'before',
                'default' => '10',
                'description' => __("E.g. 10,20 etc..", "theplus"),
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
            ]
        );
		$this->add_control(
            'translatez_max',
            [
                'type' => Controls_Manager::TEXT,
                'label' => __('Maximum TranslateZ', 'theplus'),
                'label_block' => true,
                'default' => '100',
                'description' => __("E.g. 100,200 etc..", "theplus"),
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
					'style_of_pieces' => 'custom',
				],
            ]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_pieces',
				'label' => __( 'Segment Box Shadow', 'theplus' ),
				'condition'    => [
					'select_anim' => [ 'bg_Image_pieces' ],
				],
			]
		);
		/*--------Image segmentation-------*/		
		$this->end_controls_section();
		/*---------Middle Layer-------------*/
		$this->start_controls_section(
			'middle_layer_section',
			[
				'label' => __( 'Middle Layer', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'middle_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Select Option', 'theplus'),
                'default' => '',
                'options' => [
                    '' => __('Select option', 'theplus'),
                    'canvas' => __('Canvas Effect', 'theplus'),
                    'mordern_parallax' => __('Modern Mouse Hover Parallax', 'theplus'),
                    'moving_image' => __('Auto Moving Layer', 'theplus'),
                    'mordern_image_effect' => __('Modern Image Effect', 'theplus'),
                    'multi_layered_parallax' => __('Multi Layer Parallax', 'theplus'),
                    'animated_svg' => __('Animated SVG (Coming Soon)', 'theplus'),
                ],
            ]
        );
		/* canvas */
		$this->add_control(
            'canvas_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Canvas Style', 'theplus'),
                'default' => 'style_1',
                'options' => [
                    'style_1' => __('Style 1', 'theplus'),
                    'style_2' => __('Style 2', 'theplus'),
                    'style_5' => __('Style 3', 'theplus'),
                    'style_6' => __('Style 4', 'theplus'),
                    'style_3' => __('Style 5', 'theplus'),
                    'style_4' => __('Style 6', 'theplus'),
                    'style_7' => __('Style 7', 'theplus'),
                    'style_8' => __('Style 8', 'theplus'),
                    'custom' => __('Custom', 'theplus'),
                ],
				'condition'    => [
					'middle_style' => [ 'canvas' ],
				],
            ]
        );
		$this->add_control(
			'custom_particles_js',
			[
				'label' => esc_html__( 'Particles JSON', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'middle_style' => [ 'canvas' ],
					'canvas_style' => [ 'custom' ],
				],
				'description' => __( 'Paste your particles JSON code here - Generate it from <a href="http://vincentgarreau.com/particles.js/#default" target="_blank">Here</a>.</br>Note : This canvas won\'t reflect in the backend editor. Please update and check on the frontend.', 'theplus' ),
				'default' => '',
			]
		);
		$this->add_control(
            'canvas_multi_color',
            [
				'label' => __( 'Select Multiple Colors', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'canvas_single_color' => '#212121',                       
                    ],
					[
                        'canvas_single_color' => '#ff5b5b',                       
                    ],
					[
                        'canvas_single_color' => '#4054b2',                       
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'canvas_single_color',
                        'type' => Controls_Manager::COLOR,
                        'label_block' => true,
                        'label' => __('Color', 'theplus'),
                        'default' => '#d3d3d3',
                    ],
                ],
                'title_field' => '{{{ canvas_single_color }}}',
				'condition'    => [
					'middle_style' => [ 'canvas' ],
					'canvas_style' => [ 'style_1' ],
				],
            ]
        );
		$this->add_control(
		'canvas_style6_color',
            [
                'label' => __('Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '#313131',
				'condition'    => [
					'middle_style' => [ 'canvas' ],
					'canvas_style' => [ 'style_2','style_3','style_4','style_5','style_6','style_7' ],
				],
            ]
        );
		$this->add_control(
            'canvas_type', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Canvas Shape', 'theplus'),
                'default' => 'circle',
                'options' => [
                    'circle' => __('Circle', 'theplus'),
                    'edge' => __('Edge', 'theplus'),
                    'triangle' => __('Triangle', 'theplus'),
                    'polygon' => __('Polygon', 'theplus'),
                    'star' => __('Star', 'theplus'),
                ],
				'condition'    => [
					'middle_style' => [ 'canvas' ],
					'canvas_style' => [ 'style_3','style_4','style_7' ],
				],
            ]
        );
		/* canvas */
		/*Multi layered Parallax*/		
		$repeater_multi_layered = new \Elementor\Repeater();
		$repeater_multi_layered->add_control(
			'layer_image',[
				'label' => __( 'Upload Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		$repeater_multi_layered->add_control(
            'layer_image_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Image Position', 'theplus'),
				'default' => 'bottom center',
				'options' => theplus_get_image_position_options(),				
				'condition' => [					
					'layer_image[url]!' => '',
				],			
			]
        );
		$repeater_multi_layered->add_control(
            'layer_image_attach', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Attachment', 'theplus'),
				'default' => 'scroll',
				'options' => theplus_get_image_attachment_options(),				
				'condition' => [					
					'layer_image[url]!' => '',
				],	
			]
        );
		$repeater_multi_layered->add_control(
            'layer_image_repeat', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Repeat', 'theplus'),
				'default' => 'repeat',
				'options' => theplus_get_image_reapeat_options(),
				'condition' => [					
					'layer_image[url]!' => '',
				],
			]
        );
		$repeater_multi_layered->add_control(
            'layer_image_size', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Background Size', 'theplus'),
				'default' => 'cover',
				'options' => theplus_get_image_size_options(),				
				'condition' => [					
					'layer_image[url]!' => '',
				],
			]
        );
		$repeater_multi_layered->add_control(
			'magic_scroll',[
				'label'   => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater_multi_layered->add_group_control(
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
		
		$repeater_multi_layered->start_controls_tabs( 'tabs_magic_scroll' );
		$repeater_multi_layered->start_controls_tab(
			'tab_scroll_from',
			[
				'label' => __( 'Initial', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater_multi_layered->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label' => __( 'Initial Position', 'theplus' ),
				'name'           => 'scroll_from',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		$repeater_multi_layered->end_controls_tab();
		$repeater_multi_layered->start_controls_tab(
			'tab_scroll_to',
			[
				'label' => __( 'Final', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater_multi_layered->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label' => __( 'Final Position', 'theplus' ),
				'name'           => 'scroll_to',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		
		$repeater_multi_layered->end_controls_tab();
		$repeater_multi_layered->end_controls_tabs();
		
		$repeater_multi_layered->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'separator' => 'before',
			]
		);
		$repeater_multi_layered->add_control(
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
		$repeater_multi_layered->add_control(
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
		$repeater_multi_layered->add_control(
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
		$repeater_multi_layered->add_control(
			'mordern_z_index',
			[
				'label' => __( 'Z-index', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5000,
				'step' => 1,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
            'multi_layered_images',
            [
				'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'layer_image' => '',
                    ],
				],
                'fields' => $repeater_multi_layered->get_controls(),
                'title_field' => '{{{ layer_image }}}',
				'condition'    => [
					'middle_style' => [ 'multi_layered_parallax' ],
				],
            ]
        );
		$this->add_control(
			'magic_scroll_transtion_heading',
			[
				'label' => __( 'Tablet/Mobile Parallax Smoothness Options :', 'theplus' ),
				'type' => Controls_Manager::HEADING,
				'description' => __( 'You can use this in alternate to "Smooth Scroll" Widget. If you have turn Smooth Scroll on desktop on and in Tablet/Mobile Off. This option will only work in Tablet/Mobile. Proper selection of positive/negative value make effect smooth. We suggest to try it maximum to get most out of it.', 'theplus' ),
				'separator' => 'before',
				'condition'    => [
					'middle_style' => [ 'multi_layered_parallax' ],
				],
			]
		);
		$this->add_control(
			'magic_scroll_transtion_duration',
			[
				'label' => __( 'Magic Scroll Transition Duration(s)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's' ],
				'range' => [
					's' => [
						'min' => 0,
						'max' => 5,
						'step' => 0.01,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => 1.3,
				],
				'selectors' => [
					'.theplus_multi_layered_parallax.magic-scroll .parallax-scroll,.theplus_multi_layered_parallax.magic-scroll .scale-scroll,.theplus_multi_layered_parallax.magic-scroll .both-scroll' => '-webkit-transition: -webkit-transform {{SIZE}}{{UNIT}} {{magic_scroll_transtion_timing.VALUE}} {{magic_scroll_transtion_delay.SIZE}}{{magic_scroll_transtion_delay.UNIT}};-ms-transition: -ms-transform {{SIZE}}{{UNIT}} {{magic_scroll_transtion_timing.VALUE}} {{magic_scroll_transtion_delay.SIZE}}{{magic_scroll_transtion_delay.UNIT}};-moz-transition: -moz-transform {{SIZE}}{{UNIT}} {{magic_scroll_transtion_timing.VALUE}} {{magic_scroll_transtion_delay.SIZE}}{{magic_scroll_transtion_delay.UNIT}};-o-transition: -o-transform {{SIZE}}{{UNIT}} {{magic_scroll_transtion_timing.VALUE}} {{magic_scroll_transtion_delay.SIZE}}{{magic_scroll_transtion_delay.UNIT}};transition: transform {{SIZE}}{{UNIT}} {{magic_scroll_transtion_timing.VALUE}} {{magic_scroll_transtion_delay.SIZE}}{{magic_scroll_transtion_delay.UNIT}};',
				],
				'condition'    => [
					'middle_style' => [ 'multi_layered_parallax' ],
				],
				'of_type' => 'magic_scroll',
			]
		);
		$this->add_control(
			'magic_scroll_transtion_delay',
			[
				'label' => __( 'Magic Scroll Transition Delay(s)', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 's' ],
				'range' => [
					's' => [
						'min' => -2,
						'max' => 2,
						'step' => 0.01,
					],
				],
				'default' => [
					'unit' => 's',
					'size' => 0,
				],
				'condition'    => [
					'middle_style' => [ 'multi_layered_parallax' ],
				],
				'of_type' => 'magic_scroll',
			]
		);
		$this->add_control(
			'magic_scroll_transtion_timing',
			[
				'label' => __( 'Magic Scroll Ease Effect', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease'  => __( 'Ease', 'theplus' ),
					'linear'  => __( 'Linear', 'theplus' ),
					'ease-in-out'  => __( 'Ease In-Out', 'theplus' ),
				],
				'condition'    => [
					'middle_style' => [ 'multi_layered_parallax' ],
				],
				'of_type' => 'magic_scroll',
			]
		);

		/*Multi layered Parallax*/
		/*Modern Mouse Hover Parallax*/
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'single_layer_image',[
				'label' => __( 'Upload Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
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
				'description' => __( 'Make sure you do change this as much as possible. In tablet in mobile in other options with similar options.', 'theplus' ),
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
				'description' => __( 'Make sure you do change this as much as possible. In tablet in mobile in other options with similar options.', 'theplus' ),
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
				'separator' => 'after',
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
				'separator' => 'after',
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
				'separator' => 'after',
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
				'separator' => 'after',
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
				'separator' => 'after',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		$repeater->add_control(
			'layer_image_opacity',[
				'label' => __( 'Opacity Image', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1,
				],
			]
		);
		$repeater->add_control(
			'parallax_value',[
				'label' => __( 'Effect Intensity', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [
						'min' => -100,
						'max' => 100,
						'step' => 2,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 30,
				],
			]
		);
		$repeater->add_control(
			'magic_scroll',[
				'label'   => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater->add_group_control(
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
		$repeater->start_controls_tabs( 'tabs_magic_scroll' );
		$repeater->start_controls_tab(
			'tab_scroll_from',
			[
				'label' => __( 'Initial', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label' => __( 'Initial Position', 'theplus' ),
				'name'           => 'scroll_from',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_scroll_to',
			[
				'label' => __( 'Final', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label' => __( 'Final Position', 'theplus' ),
				'name'           => 'scroll_to',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		
		$repeater->end_controls_tab();
		$repeater->end_controls_tabs();
		
		$repeater->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'separator' => 'before',
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
					'responsive_visible_opt' => 'yes',
				],
			]
		);
		$repeater->add_control(
			'mordern_z_index',
			[
				'label' => __( 'z-index', 'theplus' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5000,
				'step' => 1,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
            'mordern_images',
            [
				'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'single_layer_image' => '',
                    ],
				],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ single_layer_image }}}',
				'condition'    => [
					'middle_style' => [ 'mordern_parallax' ],
				],
            ]
        );
		/*Modern Mouse Hover Parallax*/
		/*Auto Moving Image*/
		$this->add_control(
            'moving_images',
            [
				'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'move_image_direction' => 'left',                       
                    ],
				],
                'fields' => [
                    [
                        'name' => 'single_image_move',
                        'type' => Controls_Manager::MEDIA,
                        'label_block' => true,
                        'label' => __('Upload Image', 'theplus'),
                        'default' => '',
                    ],
					[
						'name' => 'move_image_size',
						'type' => Controls_Manager::SELECT,
						'label' => __('Background Size', 'theplus'),
						'default' => 'cover',
						'options' => theplus_get_image_size_options(),
					],
					[
						'name' => 'move_image_direction',
						'type' => Controls_Manager::SELECT,
						'label' => __('Direction', 'theplus'),
						'default' => '',
						'options' => [
							'' => __('None', 'theplus'),
							'right' => __('Right', 'theplus'),
							'left' => __('Left', 'theplus'),
							'top' => __('Top', 'theplus'),
							'bottom' => __('Bottom', 'theplus'),
						],
					],
					[
						'name' => 'layer_image_opacity',
						'label' => __( 'Opacity Image', 'theplus' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '' ],
						'range' => [
							'' => [
								'min' => 0,
								'max' => 1,
								'step' => 0.1,
							],
						],
						'default' => [
							'unit' => '',
							'size' => 1,
						],
					],
					[
						'name' => 'move_image_speed',
						'label' => __( 'Transition Speed', 'theplus' ),
						'type' => Controls_Manager::SLIDER,
						'size_units' => [ '' ],
						'range' => [
							'' => [
								'min' => -100,
								'max' => 100,
								'step' => 2,
							],
						],
						'default' => [
							'unit' => '',
							'size' => 30,
						],
					],
					[
						'name' => 'responsive_visible_opt',
						'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
						'type'    =>  \Elementor\Controls_Manager::SWITCHER,
						'default' => 'no',
						'label_on' => __( 'Show', 'theplus' ),
						'label_off' => __( 'Hide', 'theplus' ),				
					],
					[
						'name' => 'desktop_opt',
						'label'   => esc_html__( 'Desktop', 'theplus' ),
						'type'    =>  \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'label_on' => __( 'Show', 'theplus' ),
						'label_off' => __( 'Hide', 'theplus' ),
						'condition'    => [
							'responsive_visible_opt' => 'yes',
						],
					],
					[
						'name' => 'tablet_opt',
						'label'   => esc_html__( 'Tablet', 'theplus' ),
						'type'    =>  \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'label_on' => __( 'Show', 'theplus' ),
						'label_off' => __( 'Hide', 'theplus' ),
						'condition'    => [
							'responsive_visible_opt' => 'yes',
						],
					],
					[
						'name' => 'mobile_opt',
						'label'   => esc_html__( 'Mobile', 'theplus' ),
						'type'    =>  \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'label_on' => __( 'Show', 'theplus' ),
						'label_off' => __( 'Hide', 'theplus' ),
						'condition'    => [
							'responsive_visible_opt' => 'yes',
						],
					],
					
                ],
                'title_field' => '{{{ move_image_direction }}}',
				'condition'    => [
					'middle_style' => [ 'moving_image' ],
				],
            ]
        );
		/*Auto Moving Image*/
		/*Modern Image Effect*/
		$repeater_effects = new \Elementor\Repeater();
		$repeater_effects->add_control(
			'single_image_effects',[
				'label' => __( 'Upload Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
			]
		);
		$repeater_effects->start_controls_tabs( 'responsive_device' );
		$repeater_effects->start_controls_tab( 'normal',
			[
				'label' => __( 'Desktop', 'theplus' ),
			]
		);
		/*desktop  start*/
		$repeater_effects->add_control(
			'd_left_auto', [
				'label'   => esc_html__( 'Left (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),				
			]
		);

		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'd_left_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
			'd_right_auto',[
				'label'   => esc_html__( 'Right (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'd_right_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
			'd_top_auto', [
				'label'   => esc_html__( 'Top (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),				
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'd_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
			'd_bottom_auto', [
				'label'   => esc_html__( 'Bottom (Auto / %)', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( '%', 'theplus' ),
				'label_off' => __( 'Auto', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'd_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
			]
		);
		$repeater_effects->end_controls_tab();
		/*desktop end*/
		/*tablet start*/
		$repeater_effects->start_controls_tab( 'tablet',
			[
				'label' => __( 'Tablet', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
			't_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'description' => __( 'Make sure you do change this as much as possible. In tablet in mobile in other options with similar options.', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_left_auto' => [ 'yes' ],
				],
			]
		);
		
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_right_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					't_responsive' => [ 'yes' ],
					't_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					't_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->end_controls_tab();
		/*tablet end*/
		/*mobile start*/
		$repeater_effects->start_controls_tab( 'mobile',
			[
				'label' => __( 'Mobile', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
			'm_responsive', [
				'label'   => esc_html__( 'Responsive Values', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Yes', 'theplus' ),
				'label_off' => __( 'No', 'theplus' ),
				'description' => __( 'Make sure you do change this as much as possible. In tablet in mobile in other options with similar options.', 'theplus' ),
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_left_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_right_auto' => [ 'yes' ],
				],
			]
		);
		
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_top_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
					'm_bottom_auto' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_control(
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
				'separator' => 'before',
				'condition'    => [
					'm_responsive' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->end_controls_tab();
		$repeater_effects->end_controls_tabs();		
		$repeater_effects->add_control(
			'layer_image_opacity',[
				'label' => __( 'Opacity Image', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 1,
				],
			]
		);
		$repeater_effects->add_control(
			'mordern_effect',[
				'type' => Controls_Manager::SELECT,
				'label' => __('Image Effects', 'theplus'),
				'default' => 'pulse',
				'options' => [
					'none' => __('None', 'theplus'),
					'pulse' => __('Pulse', 'theplus'),
					'floating' => __('Floating', 'theplus'),
					'tossing' => __('Tossing', 'theplus'),
					'rotating'  => __( 'Rotating', 'theplus' ),
				],
			]
		);
		$repeater_effects->add_control(
			'effect_animation_duration',
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
				'condition' => [
					'mordern_effect!' => 'none',
				],
			]
		);
		$repeater_effects->add_control(
			'effect_transform_origin',
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
				'condition' => [
					'mordern_effect' => 'rotating',
				],
			]
		);
		$repeater_effects->add_control(
			'magic_scroll',[
				'label'   => esc_html__( 'Magic Scroll', 'theplus' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);
		$repeater_effects->add_group_control(
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
		$repeater_effects->start_controls_tabs( 'tabs_magic_scroll' );
		$repeater_effects->start_controls_tab(
			'tab_scroll_from',
			[
				'label' => __( 'Initial', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_group_control(
			\Theplus_Magic_Scroll_From_Style_Group::get_type(),
			array(
				'label' => __( 'Initial Position', 'theplus' ),
				'name'           => 'scroll_from',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		$repeater_effects->end_controls_tab();
		$repeater_effects->start_controls_tab(
			'tab_scroll_to',
			[
				'label' => __( 'Final', 'theplus' ),
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			]
		);
		$repeater_effects->add_group_control(
			\Theplus_Magic_Scroll_To_Style_Group::get_type(),
			array(
				'label' => __( 'Final Position', 'theplus' ),
				'name'           => 'scroll_to',
				'condition'    => [
					'magic_scroll' => [ 'yes' ],
				],
			)
		);
		
		$repeater_effects->end_controls_tab();
		$repeater_effects->end_controls_tabs();
		$repeater_effects->add_control(
			'responsive_visible_opt',[
				'label'   => esc_html__( 'Responsive Visibility', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Enable', 'theplus' ),
				'label_off' => __( 'Disable', 'theplus' ),
				'separator' => 'before',
			]
		);
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
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
		$repeater_effects->add_control(
			'mordern_effect_z_index',
			[
				'label' => __( 'z-index', 'theplus' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 5000,
				'step' => 1,
				'default' => '',
				'separator' => 'before',
			]
		);
		$this->add_control(
            'mordern_effects',
            [
				'label' => '',
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'mordern_effect' => '',                       
                    ],
				],
                'fields' => $repeater_effects->get_controls(),
                'title_field' => '{{{ mordern_effect }}}',
				'condition'    => [
					'middle_style' => [ 'mordern_image_effect' ],
				],
            ]
        );
		/*Modern Image Effect*/
		$this->end_controls_section();
		/*---------Middle Layer-------------*/
		/*---------Top Layer-------------*/
		$this->start_controls_section(
			'top_layer_section',
			[
				'label' => __( 'Top Layer', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
            'overlay_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Select Option', 'theplus'),
                'default' => '',
                'options' => [
                    '' => __('Select option', 'theplus'),
                    'normal_color' => __('Solid Color', 'theplus'),
                    'gradient_color' => __('Gradient Color', 'theplus'),
                    'texture_image' => __('Texture Image', 'theplus'),
                ],
            ]
        );
		$this->add_control(
            'normal_overlay_color',
            [
                'label' => __('Overlay Color', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
				'condition'    => [
					'overlay_style' => [ 'normal_color' ],
				],
            ]
        );
		$this->add_control(
            'overlay_gradient_color1',
            [
                'label' => __('Color 1', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'orange',				
				'of_type' => 'gradient',
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
				],
            ]
        );
		$this->add_control(
            'overlay_gradient_color1_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 1 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'overlay_gradient_color2',
            [
                'label' => __('Color 2', 'theplus'),
                'type' => Controls_Manager::COLOR,
                'default' => 'cyan',
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'overlay_gradient_color2_control',
            [
                'type' => Controls_Manager::SLIDER,
				'label' => __('Color 2 Location', 'theplus'),
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'overlay_bg_gradient_style', [
                'type' => Controls_Manager::SELECT,
                'label' => __('Gradient Style', 'theplus'),
                'default' => 'linear',
                'options' => theplus_get_gradient_styles(),
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
				],
				'of_type' => 'gradient',
            ]
        );
		$this->add_control(
            'overlay_bg_gradient_angle', [
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
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
					'overlay_bg_gradient_style' => ['linear']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
            'overlay_bg_gradient_position', [
				'type' => Controls_Manager::SELECT,
				'label' => __('Position', 'theplus'),
				'options' => theplus_get_position_options(),
				'default' => 'center center',
				'condition'    => [
					'overlay_style' => [ 'gradient_color' ],
					'overlay_bg_gradient_style' => ['radial']
				],
				'of_type' => 'gradient',
			]
        );
		$this->add_control(
			'texture_image',
			[
				'label' => __( 'Texture Image', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
				'condition'    => [
					'overlay_style' => [ 'texture_image' ],
				],
			]
		);
		$this->add_control(
            'opacity_texture_image',
            [
                'type' => Controls_Manager::SLIDER,
				'size_units' => [ '' ],
				'range' => [
					'' => [
						'min' => 0,
						'max' => 1,
						'step' =>0.1,
					],
				],
				'default' => [
					'unit' => '',
					'size' => 0.8,
				],
				'condition'    => [
					'overlay_style' => [ 'texture_image' ],
				],
            ]
        );
		$this->end_controls_section();
		/*---------Top Layer-------------*/
		/*Extra options*/
		$this->start_controls_section(
			'content_extra_options_section',
			[
				'label' => __( 'Extra', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'section_overflow_hidden',
			[
				'label' => __( 'Overflow Hidden Section', 'theplus' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hidden', 'theplus' ),
				'label_off' => __( 'Visible', 'theplus' ),				
				'default' => 'no',
				'description' => __( 'All effects due to "overflow: hidden" will be visible on frontend only. Backend will show normal view.', 'theplus' ),
			]
		);
		$this->end_controls_section();
		/*Extra options*/
	}
	 protected function render() {
        $settings = $this->get_settings_for_display();		
		$select_anim = $settings['select_anim'];
		$image_parallax_style = $settings['image_parallax_style'];
		$image_parallax_amount = $settings['image_parallax_amount']["size"];
		$image_parallax_perspective = $settings['image_parallax_perspective']["size"];
		$image_parallax_scale = $settings['image_parallax_scale']["size"];
		$image_parallax_inverted = ($settings['image_parallax_inverted']=='yes') ? 'true' : 'false';
		$columns_parallax_style = $settings['columns_parallax_style'];
		$columns_animation_direction = $settings['columns_animation_direction'];
		$columns_parallax_sense = $settings['columns_parallax_sense'];
		$section_overflow_hidden = ($settings['section_overflow_hidden']=='yes') ? ' data-section-hidden="hidden"' : ' data-section-hidden="inherit"';;
		
		$parellax_class=$class1=$data_atts=$css_rules=$parellax_inner_class=$img_parallax_scroll_class=$img_parallax_scroll='';
		
		if(!empty($image_parallax_style) && $columns_parallax_style=='columns_simple_image'){
			$parellax_class = 'pt_plus_image_mouse_hover';
		}
		$responsive_bg_class='';
		if(!empty($settings["responsive_image"]) && $settings["responsive_image"]=='yes'){
			if(!empty($settings["tablet_bg_image"]["url"])){
				$responsive_bg_class .=' bg_tablet';
			}
			if(!empty($settings["mobile_bg_image"]["url"])){
				$responsive_bg_class .=' bg_mobile';
			}
		}
		if(isset($select_anim) && !empty($select_anim) && $select_anim=='bg_image') {
			if(!empty($settings['bg_img_parallax']) && $settings['bg_img_parallax']=='yes'){
				$img_parallax_scroll_class=' row-parallax-bg-img';
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
		
		$rand_no =uniqid('theplus_row');
		$uniqid1 = uniqid('theplus_bgimage');
		
		$fixed_bg_attach='';
		if(isset($settings['column_bg_img_attach']) && !empty($settings['column_bg_img_attach']) && $settings['column_bg_img_attach']=='fixed'){
			$fixed_bg_attach =' fixed-attach-bg-image';
		}
		if(isset($settings['tablet_bg_img_attach']) && !empty($settings['tablet_bg_img_attach']) && $settings['tablet_bg_img_attach']=='fixed'){
			$fixed_bg_attach .=' tablet-fixed-attach-bg-image';
		}
		if(isset($settings['mobile_bg_img_attach']) && !empty($settings['mobile_bg_img_attach']) && $settings['mobile_bg_img_attach']=='fixed'){
			$fixed_bg_attach .=' mobile-fixed-attach-bg-image';
		}
		if(isset($settings['fixed_bg_video']) && !empty($settings['fixed_bg_video']) && $settings['fixed_bg_video']=='yes'){
			$fixed_bg_attach .=' fixed-video-bg';
		}
		
		$output ='<div id="pt-plus-row-settings" class="pt-plus-row-set '.esc_attr($rand_no).' '.esc_attr($img_parallax_scroll_class).' '.esc_attr($parellax_class).' '.esc_attr($magic_class).' '.esc_attr($responsive_bg_class).' '.esc_attr($fixed_bg_attach).'" data-no="'.esc_attr($rand_no).'" '.$section_overflow_hidden.'>';
		/* bg solid color*/
		if(isset($select_anim) && !empty($select_anim) && $select_anim=='bg_normal_color') {
			$output .='<div class="pt-plus-columns-bg-wrap columns-solid-color" style="background:'.$settings["normal_bg_color"].'"></div>';
		}
		/* bg solid color*/
		/*gradient color*/
		if(isset($select_anim) && !empty($select_anim) && $select_anim=='bg_gradientcolor'){
			if(!empty($settings['gradient_color1']) && !empty($settings['gradient_color2'])){
				$color1=$settings['gradient_color1'];
				$color1_control=$settings['gradient_color1_control']["size"].$settings['gradient_color1_control']["unit"];
				$color2=$settings['gradient_color2'];
				$color2_control=$settings['gradient_color2_control']["size"].$settings['gradient_color2_control']["unit"];
				$css_rules='';
				if(!empty($settings["gradient_style"]) && $settings["gradient_style"]=='linear'){
					$gradient_angle=($settings["gradient_angle"]["size"]).($settings["gradient_angle"]["unit"]);
					$css_rules .= 'background-color: transparent; background-image: linear-gradient('.$gradient_angle.', '.$color1.' '.$color1_control.', '.$color2.' '.$color2_control.')';
				}else if(!empty($settings["gradient_style"]) && $settings["gradient_style"]=='radial'){
					$gradient_position=$settings["gradient_position"];
					$css_rules .= 'background-color: transparent; background-image: radial-gradient(at '.$gradient_position.', '.$color1.' '.$color1_control.', '.$color2.' '.$color2_control.')';
				}
			$output .='<div class="pt-plus-columns-bg-wrap columns-bg-anim-colors columns-gradient-color" style="'.$css_rules.'"></div>';

			} 
		}
		/*gradient color*/
		/*bg image*/
		if(isset($select_anim) && !empty($select_anim) && $select_anim=='bg_image') {
			$class1 .= esc_attr($columns_parallax_style);
			if($columns_parallax_style== 'columns_animated_bg') {
				$columns_animation_direction = (isset($columns_animation_direction) && !empty($columns_animation_direction)) ? $columns_animation_direction : 'left';
				$class1 .= ' columns-'.esc_attr($columns_animation_direction).'-animation';
				$data_atts .= ' data-direction="'.esc_attr($columns_animation_direction).'"';
			}

			if(isset($columns_parallax_sense) && !empty($columns_parallax_sense))
				$data_atts .= ' data-parallax_sense="'.esc_attr($columns_parallax_sense).'"';
			else 
				$data_atts .= ' data-parallax_sense="30"';

			$bg_image1=$css_rules1='';
			
			if(isset($settings['column_bg_image_new']['url']) && !empty($settings['column_bg_image_new']['url'])) {					
				$bg_image1='background:url('.esc_url($settings["column_bg_image_new"]["url"]).');';
			}
			$tablet_bg_image=$tablet_css_bg='';
			if(isset($settings['tablet_bg_image']['url']) && !empty($settings['tablet_bg_image']['url'])) {					
				$tablet_bg_image='background:url('.esc_url($settings["tablet_bg_image"]["url"]).');';
				if(isset($settings['tablet_bg_image_position']) && !empty($settings['tablet_bg_image_position'])){
					$tablet_bg_image .= 'background-position: '.esc_attr($settings['tablet_bg_image_position']).';';
				}
				if(isset($settings['tablet_bg_image_size']) && !empty($settings['tablet_bg_image_size'])){
					$tablet_bg_image .= '-webkit-background-size: '.esc_attr($settings["tablet_bg_image_size"]).';-moz-background-size: '.esc_attr($settings["tablet_bg_image_size"]).';-o-background-size: '.esc_attr($settings["tablet_bg_image_size"]).';background-size: '.esc_attr($settings["tablet_bg_image_size"]).';';
				}
				if(isset($settings['tablet_bg_img_attach']) && !empty($settings['tablet_bg_img_attach']) && $settings['tablet_bg_img_attach']!='fixed'){
					$tablet_bg_image .= 'background-attachment: '.esc_attr($settings["tablet_bg_img_attach"]).';';
				}
				if(isset($settings['tablet_bg_img_repeat']) && !empty($settings['tablet_bg_img_repeat'])){
					$tablet_bg_image .= 'background-repeat: '.esc_attr($settings["tablet_bg_img_repeat"]).';';
				}
			}
			$mobile_bg_image=$mobile_css_bg='';
			if(isset($settings['mobile_bg_image']['url']) && !empty($settings['mobile_bg_image']['url'])) {					
				$mobile_bg_image='background:url('.esc_url($settings["mobile_bg_image"]["url"]).');';
				if(isset($settings['mobile_bg_image_position']) && !empty($settings['mobile_bg_image_position'])){
					$mobile_css_bg .= 'background-position: '.esc_attr($settings['mobile_bg_image_position']).';';
				}
				if(isset($settings['mobile_bg_image_size']) && !empty($settings['mobile_bg_image_size'])){
					$mobile_css_bg .= '-webkit-background-size: '.esc_attr($settings["mobile_bg_image_size"]).';-moz-background-size: '.esc_attr($settings["mobile_bg_image_size"]).';-o-background-size: '.esc_attr($settings["mobile_bg_image_size"]).';background-size: '.esc_attr($settings["mobile_bg_image_size"]).';';
				}
				if(isset($settings['mobile_bg_img_attach']) && !empty($settings['mobile_bg_img_attach']) && $settings['tablet_bg_img_attach']!='fixed'){
					$mobile_css_bg .= 'background-attachment: '.esc_attr($settings["mobile_bg_img_attach"]).';';
				}
				if(isset($settings['mobile_bg_img_repeat']) && !empty($settings['mobile_bg_img_repeat'])){
					$mobile_css_bg .= 'background-repeat: '.esc_attr($settings["mobile_bg_img_repeat"]).';';
				}
			}
			if(isset($settings['column_bg_image_position']) && !empty($settings['column_bg_image_position']))
				$css_rules1 .= 'background-position: '.esc_attr($settings['column_bg_image_position']).';';
			
			if(isset($settings['column_bg_img_repeat']) && !empty($settings['column_bg_img_repeat']))
				$css_rules1 .= 'background-repeat: '.esc_attr($settings['column_bg_img_repeat']).';';
			
			if(isset($settings['column_bg_image_size']) && !empty($settings['column_bg_image_size']))
				$css_rules1 .= '-webkit-background-size: '.esc_attr($settings["column_bg_image_size"]).';-moz-background-size: '.esc_attr($settings["column_bg_image_size"]).';-o-background-size: '.esc_attr($settings["column_bg_image_size"]).';background-size: '.esc_attr($settings["column_bg_image_size"]).';';

			if(isset($settings['column_bg_img_attach']) && !empty($settings['column_bg_img_attach']) && $settings['column_bg_img_attach']!='fixed')
				$css_rules1 .= 'background-attachment: '.esc_attr($settings["column_bg_img_attach"]).';';
				
			$parallax_atts='';	
			if(!empty($image_parallax_style) && $columns_parallax_style=='columns_simple_image' && $image_parallax_style=='style_1'){
				$parellax_inner_class = 'pt_plus_image_parallax_inner_hover';
				$parallax_atts='data-type="tilt" data-amount="'.esc_attr($image_parallax_amount).'" data-scale="'.esc_attr($image_parallax_scale).'" data-perspective="'.esc_attr($image_parallax_perspective).'" data-inverted="'.esc_attr($image_parallax_inverted).'" data-opacity="1"';
				if(isset($settings["column_bg_img_attach"]) && !empty($settings["column_bg_img_attach"]))
					$css_rules1 .= 'background-attachment: scroll;';
				
				if(isset($settings["tablet_bg_img_attach"]) && !empty($settings["tablet_bg_img_attach"]))
					$tablet_bg_image .= 'background-attachment: scroll;';
				
				if(isset($settings["mobile_bg_img_attach"]) && !empty($settings["mobile_bg_img_attach"]))
					$mobile_css_bg .= 'background-attachment: scroll;';
			}
			if(!empty($image_parallax_style) && $columns_parallax_style=='columns_simple_image' && $image_parallax_style=='style_2'){
				$parellax_inner_class = 'pt_plus_image_parallax_inner_hover';
				$parallax_atts='data-type="move" data-amount="'.esc_attr($image_parallax_amount).'" data-scale="'.esc_attr($image_parallax_scale).'" data-inverted="'.esc_attr($image_parallax_inverted).'" data-opacity="1"';
				if(isset($settings["column_bg_img_attach"]) && !empty($settings["column_bg_img_attach"]))
					$css_rules1 .= 'background-attachment: scroll;';
				
				if(isset($settings["tablet_bg_img_attach"]) && !empty($settings["tablet_bg_img_attach"]))
					$tablet_bg_image .= 'background-attachment: scroll;';
				
				if(isset($settings["mobile_bg_img_attach"]) && !empty($settings["mobile_bg_img_attach"]))
					$mobile_css_bg .= 'background-attachment: scroll;';
			}
			if(!empty($settings['bg_img_parallax']) && $settings['bg_img_parallax']=='yes'){
				$img_parallax_scroll=' parallax-bg-img';
			}
			
			if(!empty($settings["bg_kenburns_effect"]) && $settings["bg_kenburns_effect"]=='yes'){
				$direction_effect=$kenburn_effect_duration='';
				if(!empty($settings["kenburn_effect_direction"])){
					$direction_effect = $settings["kenburn_effect_direction"];
				}
				if(!empty($settings["kenburn_effect_duration"]["size"])){
					$kenburn_effect_duration = $settings["kenburn_effect_duration"]["size"];
				}
				$css_rules1 .='-webkit-animation: bg-kenburns-effect '.esc_attr($kenburn_effect_duration).'s cubic-bezier(0.445, 0.050, 0.550, 0.950) infinite '.esc_attr($direction_effect).' both;animation: bg-kenburns-effect '.esc_attr($kenburn_effect_duration).'s cubic-bezier(0.445, 0.050, 0.550, 0.950) infinite '.esc_attr($direction_effect).' both;';
			}
			$output .= '<div class="pt-plus-columns-bg-wrap tp_bg_desktop columns-bg-anim-colors columns-bg-image  '.esc_attr($parellax_inner_class).' '.esc_attr($class1).' '.esc_attr($img_parallax_scroll).' '.esc_attr($parallax_scroll).' "  id="'.esc_attr($uniqid1).'" '.$magic_attr.' '.$parallax_atts.' '.$data_atts.'  style="'.$bg_image1.$css_rules1.'"></div>';
			
			//tablet
			if(isset($settings['tablet_bg_image']['url']) && !empty($settings['tablet_bg_image']['url'])) {	
				$output .= '<div class="pt-plus-columns-bg-wrap tp_bg_tablet columns-bg-image  '.esc_attr($parellax_inner_class).' '.esc_attr($class1).' '.esc_attr($img_parallax_scroll).' '.esc_attr($parallax_scroll).' "  id="'.esc_attr($uniqid1).'" '.$magic_attr.' '.$parallax_atts.' '.$data_atts.'  style="'.$tablet_bg_image.$css_rules1.'"></div>';
				$output.='<style>#pt-plus-row-settings.bg_tablet #'.esc_attr($uniqid1).'.tp_bg_tablet:after {background:'.$settings['tablet_overlay_color'].'}</style>';
			}
			
			//mobile
			if(isset($settings['mobile_bg_image']['url']) && !empty($settings['mobile_bg_image']['url'])) {	
				$output .= '<div class="pt-plus-columns-bg-wrap tp_bg_mobile columns-bg-image  '.esc_attr($parellax_inner_class).' '.esc_attr($class1).' '.esc_attr($img_parallax_scroll).' '.esc_attr($parallax_scroll).' "  id="'.esc_attr($uniqid1).'" '.$magic_attr.' '.$parallax_atts.' '.$data_atts.'  style="'.$mobile_bg_image.$mobile_css_bg.'"></div>';
				$output.='<style>#pt-plus-row-settings.bg_mobile #'.esc_attr($uniqid1).'.tp_bg_mobile:after {background:'.$settings['mobile_overlay_color'].'}</style>';
			}
		}
		/*----------bg image---*/
		/*-Animated color-*/
		if(isset($select_anim) && !empty($select_anim) && $select_anim=='bg_color') {
			if ( $settings['columns_bg_colors'] ) {
			$animate_id = uniqid('pt_plus_animate_color');	
			 $colors =array();	
				
					foreach($settings['columns_bg_colors'] as $item) {
						if(!empty($item['column_bg_single_color'])) {
									$colors[]=$item['column_bg_single_color'];
						}
					}		
				$column_anim_bg_duration = (!empty($settings['column_anim_bg_duration']) && $settings['column_anim_bg_duration'] != '') ? $settings['column_anim_bg_duration'] : 3000;
					
				$output .='<div class="pt-plus-columns-bg-wrap columns-bg-anim-colors row-animated-bg '.esc_attr($animate_id).'" data-id="'.esc_attr($animate_id).'" data-bg-time="'.esc_attr($column_anim_bg_duration).'" data-bg="'.htmlspecialchars(json_encode($colors)).'"></div>';
				
			}
		}
		/*-Animation color-*/
		/*----------bg video---*/
			$data_atts2 = $video_atts2 = $controller_css2 = '';
			 
			$uniqid2 = uniqid('row_video_bg_');
			if(!empty($settings['columns_video_variant']) && $select_anim=='bg_video') {
				$responsive_video_image=$video_responsive_poster='';
			
				if(isset($settings['columns_video_poster']['url']) && !empty($settings['columns_video_poster']['url'])) {					
					$poster_url=$settings["columns_video_poster"]["url"];
					$responsive_video_image .=' data-desktop-poster="'.esc_url($settings["columns_video_poster"]["url"]).'"';
				} else {
					$poster_url = THEPLUS_URL.'/assets/images/placeholder-grid.jpg';
					$responsive_video_image .=' data-desktop-poster="'.esc_url($poster_url).'"';
				}
				
				if(!empty($settings['responsive_bg_video']) && $settings['responsive_bg_video']=='yes'){
					if(!empty($settings["tablet_video_poster"]["url"])){
						$responsive_video_image .=' data-tablet-poster="'.esc_url($settings["tablet_video_poster"]["url"]).'"';
						$video_responsive_poster='plus-video-poster';
					}
					if(!empty($settings["mobile_video_poster"]["url"])){
						$responsive_video_image .=' data-mobile-poster="'.esc_url($settings["mobile_video_poster"]["url"]).'"';
						$video_responsive_poster='plus-video-poster';
					}
				}
					if($settings['columns_video_variant']== 'self-hosted' && (!empty($settings['columns_video_url_mp4']) || !empty($settings['columns_video_url_webm']))) {
					
					$video_atts2 .= 'poster="'. esc_url($poster_url) .'"';

					
					if($settings['columns_video_loop']=='yes') {
						$video_atts2 .= ' loop="true" ';
					}
					if($settings['columns_video_muted']=='yes') {
						$video_atts2 .= ' muted="true" ';	
					}

					$output .= '<div class="pt-plus-bg-video pt-plus-columns-bg-wrap columns-video-bg self-hosted-video-bg '.esc_attr($video_responsive_poster).'" id="wrapper-'.esc_attr($uniqid2).'" '.$data_atts2.' style="background-image: url('.esc_js($poster_url).');" '.esc_attr($responsive_video_image).'>';
					$output .= '<video id="'.esc_attr($uniqid2).'" class="self-hosted-videos video-js vjs-default-skin columns_vc_hidden-md columns_vc_hidden-sm columns_vc_hidden-xs"  autoplay preload="auto" width="100%" height="100%"  autoplay="true" '.$video_atts2.' data-setup="{}">';

						if (!empty($settings['columns_video_url_mp4'])):
							$output .= '<source src="'.esc_url($settings["columns_video_url_mp4"]).'" type="video/mp4">';
						endif;
						if (!empty($settings['columns_video_url_webm'])):
							$output .= '<source src="'.esc_url($settings["columns_video_url_webm"]).'" type="video/webm">';
						endif;
					$output .= '</video>';

					$output .= '</div>';
				} elseif($settings['columns_video_variant'] == 'youtube' || $settings['columns_video_variant'] == 'vimeo') {

					$loop = false;
					if($settings['columns_video_loop']=='yes') {
						$loop = true;
					}
					if($settings['columns_video_muted']=='yes') {
							$data_atts2 .= ' data-muted="1"';
					} else {
						$data_atts2 .= ' data-muted="0"';
					}
					if($settings['columns_video_variant'] == 'youtube' && !empty($settings['columns_youtube_video_id'])) {
						$extra_url_prop = '';
						if($loop) 
							$extra_url_prop .= '&amp;loop=1&amp;playlist='.$settings['columns_youtube_video_id'];
						$output .= '<div id="wrapper-'.esc_attr($uniqid2).'" class="pt-plus-columns-bg-wrap columns-video-bg columns-youtube-bg tp-loading '.esc_attr($video_responsive_poster).'" style="background-image: url('.esc_js($poster_url).');" '.esc_attr($responsive_video_image).'>
										<div class="video-js columns_vc_hidden-md columns_vc_hidden-sm columns_vc_hidden-xs"><iframe id="'.esc_attr($uniqid2).'"  '.$data_atts2.' width="100%" height="100%" src="//www.youtube.com/embed/'.esc_attr($settings["columns_youtube_video_id"]).'?wmode=opaque&amp;autoplay=1'.esc_attr($extra_url_prop).'&amp;enablejsapi=1&amp;showinfo=0&amp;controls=0&amp;rel=0" frameborder="0" class="pt-plus-bg-video columns-bg-frame" allowfullscreen></iframe></div>
									</div>';
					}

					if($settings['columns_video_variant'] == 'vimeo' && !empty($settings['columns_vimeo_video_id'])) {
						$extra_url_prop = '';
						if($loop) 
							$extra_url_prop .= '&amp;loop=1';
						$output .= '<div id="wrapper-'.esc_attr($uniqid2).'" class="pt-plus-columns-bg-wrap columns-video-bg columns-vimeo-bg tp-loading '.esc_attr($video_responsive_poster).'" style="background-image: url('.esc_js($poster_url).');" '.esc_attr($responsive_video_image).'>
										<div class="video-js columns_vc_hidden-md columns_vc_hidden-sm columns_vc_hidden-xs"><iframe id="'.esc_attr($uniqid2).'"  '.$data_atts2.' src="//player.vimeo.com/video/'.esc_attr($settings["columns_vimeo_video_id"]).'?api=1&amp;autoplay=1;portrait=0&amp;rel=0'.esc_attr($extra_url_prop).'" width="100%" height="100%" frameborder="0" class="pt-plus-bg-video columns-bg-frame"></iframe></div>
									</div>';
					}
				}
					
			}
		/*----------bg video---*/
		/*----------bg gallery---*/
			$gallery_css='';
			$gallery1 ='';
			$uniq_id_gallery = uniqid('bgGallaryslide');
			if(!empty($settings['images_gallery']) && $select_anim=='bg_gallery') {
				wp_enqueue_script( 'vegas_js');
				$output .='<div  id="'.$uniq_id_gallery.'" class="pt-plus-row-slideshow ">';
				foreach($settings['images_gallery'] as $gallery){				
					$gallery1 .='{src: "'.esc_url($gallery["url"]).'",transition: "'.esc_attr($settings["gallery_slide_style"]).'",transitionDuration: '.esc_attr($settings["gallery_animation_duration"]).'},';
				}  
				$output .='</div>';
				if(!empty($settings["gallery_overlays"]) && $settings["gallery_overlays"]!='false'){
					$overlayurl=THEPLUS_URL.'assets/css/extra/overlays/0'.esc_attr($settings["gallery_overlays"]).'.png';
				}else{
					$overlayurl=false;
				}
				$output .= '<script>
					(function($) {
						$("#'.esc_js($uniq_id_gallery).'").vegas({
								overlay: "'.$overlayurl.'",
								transitionDuration: 4e3,
								delay: '.esc_js($settings["slide_delay_time"]).',
								slides: ['.$gallery1.']
							});		
						})(jQuery);
					</script>';
			}
		/*----------bg gallery---*/
		/*----------bg imageclip--*/
		if($select_anim=='bg_Image_pieces') {			
			$imgSrc=$opacity_animate='';
		$rand_no12=rand(1000, 1500000);
		$style_of_pieces=$settings["style_of_pieces"];
		$border_width=$border_style=$border_color='';
		if($style_of_pieces=="custom"){
			$position='';
			$effects='';
			$animate_speed='';
			$no_of_pieces=$settings["no_of_pieces"];
			$anim_duration=$settings["anim_duration"];
			$easing_transition=$settings["easing_transition"];
			$delay_transition=$settings["delay_transition"];
			$translatez_min=$settings["translatez_min"];
			$translatez_max=$settings["translatez_max"];
			$opacity_pieces=$settings["opacity_pieces"]['size'];
			$left_shadow=$settings["left_shadow"]['size'];
			$top_shadow=$settings["top_shadow"]['size'];
			$parallax_effect=((!empty($settings["parallax_effect"]) && $settings["parallax_effect"]=='false') ? 'false' : 'true');
			$min_parallax=$settings["min_parallax"]['size'];
			$max_parallax=$settings["max_parallax"]['size'];
			$border_width="7px";
			$border_style="solid";
			$border_color="rgba(255,255,255,0.7)";
			if(!empty($settings["image_clip_opt"])){
			$count=sizeof($settings["image_clip_opt"]);
			$i=1;
				foreach($settings["image_clip_opt"] as $item) {
					$xpos=$item['pos_xposition'];					
					$ypos=$item['pos_yposition'];
					$width=$item['pos_width'];
					$height=$item['pos_height'];
					$animate_pieces=$item['animate_pieces'];
					$animatespeed=$item['animate_speed'];
					if($count!=$i){
						$position .='{top:'.$ypos.', left: '.$xpos.', width: '.$width.', height: '.$height.'},';
						$effects .='{"effect" : "'.$animate_pieces.'"},';
						$animate_speed .='{"duration" : "'.$animatespeed.'"},';
					}else{
						$position .='{top:'.$ypos.', left: '.$xpos.', width: '.$width.', height: '.$height.'}';
						$effects .='{"effect" : "'.$animate_pieces.'"}';
						$animate_speed .='{"duration" : "'.$animatespeed.'"}';
					}
				}
			}
		}elseif($style_of_pieces=="style-2"){
			$no_of_pieces='4';
			$anim_duration= '1100';
			$easing_transition= "easeInOutExpo";
			$delay_transition= '100';
			$translatez_min="100";
			$translatez_max="100";
			$opacity_pieces='1';
			$left_shadow='0';
			$top_shadow='0';
			$parallax_effect='true';
			$min_parallax='10';
			$max_parallax='40';
			$position='{top: 0, left: 0, width: 45, height: 45},{top: 55, left: 0, width: 45, height: 45},{top: 0, left: 55, width: 45, height: 45},{top: 55, left: 55, width: 45, height: 45}';
			$effects='{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""}';
			$animate_speed='{"duration" : ""},{"duration" : ""},{"duration" : ""},{"duration" : ""}';

		}elseif($style_of_pieces=="style-3"){
			$no_of_pieces='3';
			$anim_duration= '1300';
			$easing_transition= "easeInOutExpo";
			$delay_transition= '100';
			$translatez_min="10";
			$translatez_max="10";
			$opacity_pieces='1';
			$left_shadow='0';
			$top_shadow='0';
			$parallax_effect='false';
			$min_parallax='10';
			$max_parallax='10';
			$position='{top: 10, left: 25, width: 50, height: 25},{top: 40, left: 25, width: 50, height: 25},{top: 70, left: 25, width: 50, height: 25}';
			$effects='{"effect" : "rotate"},{"effect" : "rotate"},{"effect" : "rotate"}';
			$animate_speed='{"duration" : "3s"},{"duration" : "7s"},{"duration" : "5s"}';
		}elseif($style_of_pieces=="style-4"){
			$no_of_pieces='10';
			$anim_duration= '1300';
			$easing_transition= "easeOutQuad";
			$delay_transition= '50';
			$translatez_min="10";
			$translatez_max="65";
			$opacity_pieces='1';
			$left_shadow='20';
			$top_shadow='20';
			$parallax_effect='true';
			$min_parallax='10';
			$max_parallax='40';
			$position='{top: 0, left: 0, width: 30, height: 30},{top: 10, left: 10, width: 30, height: 30},{top: 20, left: 20, width: 30, height: 30},{top: 30, left: 30, width: 30, height: 30},{top: 40, left: 40, width: 30, height: 30},{top: 50, left: 50, width: 30, height: 30},{top: 60, left: 60, width: 30, height: 30},{top: 70, left: 70, width: 30, height: 30},{top: 80, left: 80, width: 30, height: 30},{top: 90, left: 90, width: 30, height: 30}';

			$effects='{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""}';
			$animate_speed='{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"}';

			$border_width="7px";
			$border_style="solid";
			$border_color="rgba(255,255,255,0.7)";
		}elseif($style_of_pieces=="style-5"){
			$no_of_pieces='7';
			$anim_duration= '1000';
			$easing_transition= "easeOutQuad";
			$delay_transition= '10';
			$translatez_min="10";
			$translatez_max="65";
			$opacity_pieces='1';
			$left_shadow='0';
			$top_shadow='0';
			$parallax_effect='true';
			$min_parallax='5';
			$max_parallax='10';
			$position='{top: 10, left: 20, width: 20, height: 30},{top: 8, left: 35, width: 30, height: 20},{top: 25, left: 18, width: 14, height: 25},{top: 23, left: 50, width: 20, height: 10},{top: 30, left: 65, width: 10, height: 30},{top: 48, left: 20, width: 10, height: 13},{top: 50, left: 67, width: 10, height: 20}';

			$effects='{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""}';
			$animate_speed='{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"}';
		}elseif($style_of_pieces=="style-6"){
			$no_of_pieces='8';
			$anim_duration= '1000';
			$easing_transition= "easeOutExpo";
			$delay_transition= '0';
			$translatez_min="10";
			$translatez_max="25";
			$opacity_pieces='0';
			$left_shadow='0';
			$top_shadow='0';
			$parallax_effect='true';
			$min_parallax='10';
			$max_parallax='30';
			$position='{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100},{top: 0, left: 0, width: 100, height: 100}';

			$effects='{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""},{"effect" : ""}';
			$animate_speed='{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"},{"duration" : "0s"}';

			$opacity_animate="opacity: '0.1',";
		}else{
			$no_of_pieces='9';
			$anim_duration= '1000';
			$easing_transition= "easeInOutCubic";
			$delay_transition= '0';
			$translatez_min="-20";
			$translatez_max="20";
			$opacity_pieces='1';
			$left_shadow='0';
			$top_shadow='0';
			$parallax_effect='false';
			$min_parallax='1';
			$max_parallax='65';
			$position='{top: 30, left: 5, width: 40, height: 80},{top: 50, left: 25, width: 30, height: 30},{top: 5, left: 75, width: 40, height: 20},{top: 30, left: 45, width: 40, height: 20},{top: 45, left: 15, width: 50, height: 40},{top: 10, left: 40, width: 10, height: 20},{top: 20, left: 50, width: 30, height: 70},{top: 0, left: 10, width: 50, height: 60},{top: 70, left: 40, width: 30, height: 30}';

			$effects='{"effect" : "scale"},{"effect" : "flash"},{"effect" : "scale"},{"effect" : "float"},{"effect" : "flash"},{"effect" : "scale"},{"effect" : "float"},{"effect" : ""},{"effect" : ""}';
			$animate_speed='{"duration" : "3s"},{"duration" : "10s"},{"duration" : "5s"},{"duration" : "6s"},{"duration" : "4s"},{"duration" : "4s"},{"duration" : "5s"},{"duration" : "0s"},{"duration" : "0s"}';
			$opacity_animate="opacity: '1',";
		}
		$bg_style='';
		if(!empty($settings['bg_options']) && $settings['bg_options']=='bg_image'){
			if(!empty($settings['bg_image']['url'])) {
				$bg_style .='background-image: url('.esc_url($settings["bg_image"]["url"]).');';
			}
		}else if(!empty($settings['bg_options']) && $settings['bg_options']=='bg_color'){
			if(!empty($settings['bg_pieces_color'])){
				$bg_style .='background:'.esc_attr($settings["bg_pieces_color"]).';';
			}
		}else if(!empty($settings['bg_options']) && $settings['bg_options']=='bg_gradient'){
			
		}
		$box_shadow_pieces='';
		if(!empty($settings['box_shadow_pieces'])){
			$box_shadow_pieces=$settings['box_shadow_pieces'];
		}
		$output .= '<div class="pt-plus-row-imageclip row-'.esc_attr($rand_no12).'" data-id="row-'.esc_attr($rand_no12).'" data-box-shadow="'.esc_attr($box_shadow_pieces).'" data-border-width="'.esc_attr($border_width).'" data-border-style="'.esc_attr($border_style).'" data-border-color="'.esc_attr($border_color).'" style="'.$bg_style.'"></div>';

			$output .='<script>
				(function($) {	
		setTimeout(function(){ 
						var trigger = document.querySelector(".row-'.esc_js($rand_no12).'");
		var rowparent = trigger.parentNode.parentNode;
						var segmenter = new Segmenter(document.querySelector(".row-'.esc_js($rand_no12).'"), {
						pieces: '.$no_of_pieces.',
							animation: {
								duration: '.esc_js($anim_duration).',
								easing: "'.esc_js($easing_transition).'",
								delay: '.esc_js($delay_transition).',
								'.$opacity_animate.'
								translateZ: {min: '.esc_js($translatez_min).', max: '.esc_js($translatez_max).'}
							},
							shadowsAnimation: {
								opacity:'.esc_js($opacity_pieces).',
								 translateX: '.esc_js($left_shadow).',
								 translateY: '.esc_js($top_shadow).',
							},
							parallax: '.$parallax_effect.',
							parallaxMovement: {min: '.esc_js($min_parallax).', max: '.esc_js($max_parallax).'},
							positions: ['.$position.'],
							animated_effects : {
								effects:['.$effects.'],
								animatespeed: ['.$animate_speed.']
							},
							onReady: function() {

								rowparent.addEventListener("mouseover", function() {
									segmenter.animate();
								});
							},
							
						});
		}, 2000);
				})(jQuery);
				</script>';
			
		}
		/*----------bg imageclip--*/
		/*-------------------------middle layer ----------------------*/		
		$middle_style=$settings["middle_style"];
		$canvas_style=$settings["canvas_style"];
		$canvas_style6_color=$settings["canvas_style6_color"];
		$canvas_type=$settings["canvas_type"];
		/*-canvas-*/
		if(!empty($middle_style) && $middle_style=='canvas'){
			/*-canvas style 1-*/
			$background_colors=array();
			if($canvas_style=='style_1'){
				if($settings["canvas_multi_color"]!=''){
					foreach($settings["canvas_multi_color"] as $item) {
						if(isset($item['canvas_single_color']) && $item['canvas_single_color'] != '') {			
							$background_colors[]=$item['canvas_single_color'];
						}
					}
				}else{
					$background_colors =array('#dd3333', '#dd9933', '#eeee22', '#81d742', '#1e73be');
				}
				$output .='<div class="pt-plus-bubble-wrap">';
				for($ij=1;$ij<=50;$ij++) {
					$size= rand(1,30).'px';
					$output .='<div class="bubble" style="height: '.esc_attr($size).';width: '.esc_attr($size).';animation-delay: -'.($ij*0.2).'s;-webkit-transform:translate3d( '.rand(-2000,2000).'px,  '.rand(-1000,2000).'px, '.rand(-1000,2000).'px);transform: translate3d( '.rand(-2000,2000).'px,  '.rand(-1000,2000).'px, '.rand(-1000,2000).'px);background: '.$background_colors[array_rand($background_colors)].';"></div>'; 
				}
				$output .='</div>';
			/*-canvas style 1-*/
			}else if($canvas_style=='style_2'){
				/*-canvas style 2-*/
				wp_enqueue_script( 'easepack_js');
				wp_enqueue_script( 'raf_js');
				wp_enqueue_script( 'projector_js');	
				
				$output .='<div id="pt-plus-row-canvas-2" class="pt-plus-row-canvas-style-2" data-no="'.esc_attr($rand_no).'" data-color="'.esc_attr($canvas_style6_color).'"></div>';
				/*-canvas style 2-*/
			}else if($canvas_style=='style_5'){
				/*-canvas style 5-*/
				wp_enqueue_script( 'easepack_js');
				wp_enqueue_script( 'raf_js');
				wp_enqueue_script( 'projector_js');
				
				$output .='<div id="pt-plus-row-canvas-5" class="pt-plus-row-canvas-style-5" data-no="'.esc_attr($rand_no).'" data-color="'.esc_attr($canvas_style6_color).'"></div>';
				/*-canvas style 5-*/
			}else if($canvas_style=='style_3'){
				/*-canvas style 3-*/
				wp_enqueue_script( 'easepack_js');
				wp_enqueue_script( 'raf_js');
				wp_enqueue_script( 'projector_js');
				
				$output .='<div id="pt-plus-row-canvas-3" class="canvas-style-3" data-no="'.esc_attr($rand_no).'" data-type="'.esc_attr($canvas_type).'" data-color="'.esc_attr($canvas_style6_color).'"></div>';
				/*-canvas style 3-*/
			}else if($canvas_style=='style_4'){
				/*-canvas style 4-*/
				wp_enqueue_script( 'easepack_js');
				wp_enqueue_script( 'raf_js');
				wp_enqueue_script( 'projector_js');
				
				$output .='<div id="pt-plus-row-canvas-4" class="canvas-style-4" data-no="'.esc_attr($rand_no).'" data-type="'.esc_attr($canvas_type).'" data-color="'.esc_attr($canvas_style6_color).'"></div>';
				/*-canvas style 4-*/
			}else if($canvas_style=='style_7'){
				/*-canvas style 7-*/
				wp_enqueue_script( 'easepack_js');
				wp_enqueue_script( 'raf_js');				
				wp_enqueue_script( 'projector_js');
				
				$output .='<div id="pt-plus-row-canvas-7" class="canvas-style-7" data-no="'.esc_attr($rand_no).'" data-type="'.esc_attr($canvas_type).'" data-color="'.esc_attr($canvas_style6_color).'"></div>';
				/*-canvas style 7-*/
			}else if($canvas_style=='style_6'){			
				/*-canvas style 6-*/
				wp_enqueue_script( 'particleground_js');
				
				$output .='<div id="demo-canvas-6" class="canvas-style-6" data-canvas-color="'.esc_attr($canvas_style6_color).'"></div>';
				
				/*-canvas style 6-*/
			}else if($canvas_style=='style_8'){			
				/*-canvas style 7-*/
				$output .='<div id="demo-canvas-8" class="canvas-style-8"><canvas class="snow-particles"></canvas></div>';
				
				/*-canvas style 7-*/
			}else if($canvas_style=='custom' && !empty($settings['custom_particles_js'])){
				/*-canvas custom-*/
			
				$uid_canvas=uniqid("canvas");
				$output .='<div id="'.esc_attr($uid_canvas).'" class="canvas-style-custom"></div>';
				$output .='<script>
					document.addEventListener("DOMContentLoaded", evt => {
						particlesJS("'.esc_attr($uid_canvas).'", '.$settings['custom_particles_js'].' );
					});
				</script>';
				/*-canvas custom-*/
			}
		}
		/* canvas */
		/*-------- parellax Image row-------*/
		
			if(!empty($middle_style) && $middle_style=='mordern_parallax'){
				if(!empty($settings["mordern_images"])) {
					$css_loop='';
					$ij=0;
					foreach($settings["mordern_images"] as $item) {
						$mordern_z_index=($item["mordern_z_index"]!='') ? 'style="z-index:'.esc_attr($item["mordern_z_index"]).'"' : '';
						$visiblity_hide='';
						if(!empty($item['responsive_visible_opt']) && $item['responsive_visible_opt']=='yes'){
							$visiblity_hide .= (($item['desktop_opt']!='yes' && $item['desktop_opt']=='') ? 'desktop-hide ' : '' );							
							$visiblity_hide .= (($item['tablet_opt']!='yes' && $item['tablet_opt']=='') ? 'tablet-hide ' : '' );
							$visiblity_hide .= (($item['mobile_opt']!='yes' && $item['mobile_opt']=='') ? 'mobile-hide ' : '' );
						}
						$magic_class = $magic_attr = $parallax_scroll = '';
						if (!empty($item['magic_scroll']) && $item['magic_scroll'] == 'yes') {
							
							
							if($item["scroll_option_popover_toggle"]==''){
								$scroll_offset=0;
								$scroll_duration=300;
							}else{
								$scroll_offset=$item['scroll_option_scroll_offset'];
								$scroll_duration=$item['scroll_option_scroll_duration'];
							}
							
							if($item["scroll_from_popover_toggle"]==''){
								$scroll_x_from=0;
								$scroll_y_from=0;
								$scroll_opacity_from=1;
								$scroll_scale_from=1;
								$scroll_rotate_from=0;
							}else{
								$scroll_x_from=$item['scroll_from_scroll_x_from'];
								$scroll_y_from=$item['scroll_from_scroll_y_from'];
								$scroll_opacity_from=$item['scroll_from_scroll_opacity_from'];
								$scroll_scale_from=$item['scroll_from_scroll_scale_from'];
								$scroll_rotate_from=$item['scroll_from_scroll_rotate_from'];
							}
							
							if($item["scroll_to_popover_toggle"]==''){
								$scroll_x_to=0;
								$scroll_y_to=-50;
								$scroll_opacity_to=1;
								$scroll_scale_to=1;
								$scroll_rotate_to=0;
							}else{
								$scroll_x_to=$item['scroll_to_scroll_x_to'];
								$scroll_y_to=$item['scroll_to_scroll_y_to'];
								$scroll_opacity_to=$item['scroll_to_scroll_opacity_to'];
								$scroll_scale_to=$item['scroll_to_scroll_scale_to'];
								$scroll_rotate_to=$item['scroll_to_scroll_rotate_to'];
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
						
						
						
						$uimg_id='image'.$item["_id"].$ij;
						if(isset($item['single_layer_image']['url']) && $item['single_layer_image']['url'] != '') {
							$image_src=$item['single_layer_image']['url'];
							$image_id=$item["single_layer_image"]["id"];
							$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
							if(!$image_alt){
								$image_alt = get_the_title($image_id);
							}else if(!$image_alt){
								$image_alt = 'mordern image parallax';
							}
							
								$output .= '<div class="pt_plus_mordern_image_parallax '.esc_attr($uimg_id).' '.esc_attr($visiblity_hide).' ' . esc_attr($magic_class) . '" '.$mordern_z_index.'>';
								$output .='<div class="' . esc_attr($parallax_scroll) . '" ' . $magic_attr . '>';
									$output.='<img src="'.esc_url($image_src).'" class="parallax_image" alt="'.esc_attr($image_alt).'" data-parallax="'.esc_attr($item["parallax_value"]["size"]).'" style="opacity:'.esc_attr($item["layer_image_opacity"]["size"]).';">';
								$output.='</div>';
								$output.='</div>';
						}
								$xpos='auto';$ypos='auto';$bpos='auto';$rpos='auto';
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
								$css_loop.='.pt_plus_mordern_image_parallax.'.esc_attr($uimg_id).'{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';'.$d_max_width.'margin: 0 auto;}';
							
							if(!empty($item['t_responsive']) && $item['t_responsive']=='yes'){
								$tablet_rpos='auto';$tablet_bpos='auto';$tablet_ypos='auto';$tablet_xpos='auto';
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
								$css_loop.='@media (min-width:601px) and (max-width:990px){.pt_plus_mordern_image_parallax.'.esc_attr($uimg_id).'{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';'.$t_max_width.'margin: 0 auto;}}';
							}
							if(!empty($item['m_responsive']) && $item['m_responsive']=='yes'){
								$mobile_rpos='auto';$mobile_bpos='auto';$mobile_ypos='auto';$mobile_xpos='auto';
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
								$css_loop.='@media (max-width:600px){.pt_plus_mordern_image_parallax.'.esc_attr($uimg_id).'{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr($mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';'.$m_max_width.'margin: 0 auto;}}';
							}
							$ij++;
					}
					$output .='<style>'.$css_loop.'</style>';
				}
			}
		/*-------- parellax Image row-------*/
		/*--------multi_layered_images------*/
			if(!empty($middle_style) && $middle_style=='multi_layered_parallax'){
				if(!empty($settings["multi_layered_images"])) {
					$ij=0;
					foreach($settings["multi_layered_images"] as $item) {
						$mordern_z_index=($item["mordern_z_index"]!='') ? 'z-index:'.esc_attr($item["mordern_z_index"]).';' : '';
						$visiblity_hide='';
						if(!empty($item['responsive_visible_opt']) && $item['responsive_visible_opt']=='yes'){
							$visiblity_hide .= (($item['desktop_opt']!='yes' && $item['desktop_opt']=='') ? 'desktop-hide ' : '' );							
							$visiblity_hide .= (($item['tablet_opt']!='yes' && $item['tablet_opt']=='') ? 'tablet-hide ' : '' );
							$visiblity_hide .= (($item['mobile_opt']!='yes' && $item['mobile_opt']=='') ? 'mobile-hide ' : '' );
						}
						
						$magic_class = $magic_attr = $parallax_scroll = '';
						if (!empty($item['magic_scroll']) && $item['magic_scroll'] == 'yes') {
							
							if($item["scroll_option_popover_toggle"]==''){
								$scroll_offset=0;
								$scroll_duration=300;
							}else{
								$scroll_offset=$item['scroll_option_scroll_offset'];
								$scroll_duration=$item['scroll_option_scroll_duration'];
							}
							
							if($item["scroll_from_popover_toggle"]==''){
								$scroll_x_from=0;
								$scroll_y_from=0;
								$scroll_opacity_from=1;
								$scroll_scale_from=1;
								$scroll_rotate_from=0;
							}else{
								$scroll_x_from=$item['scroll_from_scroll_x_from'];
								$scroll_y_from=$item['scroll_from_scroll_y_from'];
								$scroll_opacity_from=$item['scroll_from_scroll_opacity_from'];
								$scroll_scale_from=$item['scroll_from_scroll_scale_from'];
								$scroll_rotate_from=$item['scroll_from_scroll_rotate_from'];
							}
							
							if($item["scroll_to_popover_toggle"]==''){
								$scroll_x_to=0;
								$scroll_y_to=-50;
								$scroll_opacity_to=1;
								$scroll_scale_to=1;
								$scroll_rotate_to=0;
							}else{
								$scroll_x_to=$item['scroll_to_scroll_x_to'];
								$scroll_y_to=$item['scroll_to_scroll_y_to'];
								$scroll_opacity_to=$item['scroll_to_scroll_opacity_to'];
								$scroll_scale_to=$item['scroll_to_scroll_scale_to'];
								$scroll_rotate_to=$item['scroll_to_scroll_rotate_to'];
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
						$layer_bg_image='';
						if(isset($item['layer_image_position']) && !empty($item['layer_image_position'])){
							$layer_bg_image .= 'background-position: '.esc_attr($item['layer_image_position']).';';
						}
						if(isset($item['layer_image_size']) && !empty($item['layer_image_size'])){
							$layer_bg_image .= 'background-size: '.esc_attr($item["layer_image_size"]).';';
						}
						if(isset($item['layer_image_attach']) && !empty($item['layer_image_attach']) && $item['layer_image_attach']!='fixed'){
							$layer_bg_image .= 'background-attachment: '.esc_attr($item["layer_image_attach"]).';';
						}
						if(isset($item['layer_image_repeat']) && !empty($item['layer_image_repeat'])){
							$layer_bg_image .= 'background-repeat: '.esc_attr($item["layer_image_repeat"]).';';
						}						
						$uimg_id="layered".$item["_id"].$ij;
						if(isset($item['layer_image']['url']) && $item['layer_image']['url'] != '') {
							$image_src=$item['layer_image']['url'];
							$output .= '<div class="theplus_multi_layered_parallax '.esc_attr($uimg_id).' '.esc_attr($visiblity_hide).' ' . esc_attr($magic_class) . '" >';
								$output .='<div class="multi_layered_parallax ' . esc_attr($parallax_scroll) . '" style="background:url('.esc_url($image_src).');'.$layer_bg_image.';'.$mordern_z_index.'" ' . $magic_attr . '>';$output.='</div>';
							$output.='</div>';
						}
						$ij++;
					}
				}
			}
		/*--------multi_layered_images------*/
		/*-------- moving Image row-------*/
		if(!empty($middle_style) && $middle_style=='moving_image'){ 
			if(!empty($settings["moving_images"])) {
				$output .='<div class="pt_plus_moving_images">';				
				foreach($settings["moving_images"] as $item) {
				
					$visiblity_hide='';
					if(!empty($item['responsive_visible_opt']) && $item['responsive_visible_opt']=='yes'){
						$visiblity_hide .= (($item['desktop_opt']!='yes' && $item['desktop_opt']=='') ? 'desktop-hide ' : '' );							
						$visiblity_hide .= (($item['tablet_opt']!='yes' && $item['tablet_opt']=='') ? 'tablet-hide ' : '' );
						$visiblity_hide .= (($item['mobile_opt']!='yes' && $item['mobile_opt']=='') ? 'mobile-hide ' : '' );
					}
					if(isset($item['single_image_move']['url']) && $item['single_image_move']['url'] != '') {
						$full_image=$item['single_image_move']['url'];
						$columns_animation_direction = (isset($item['move_image_direction']) && !empty($item['move_image_direction'])) ? $item['move_image_direction'] : 'left';
						$speed=$item['move_image_speed']["size"];
						$output.='<div class="move-image-1 columns-bg-image columns_animated_bg pt-plus-loading-bg-image '.esc_attr($visiblity_hide).'" style="background-image: url('.esc_url($full_image).');opacity:'.esc_attr($item["layer_image_opacity"]["size"]).';background-size:'.$item["move_image_size"].'" data-direction="'.esc_attr($columns_animation_direction).'" data-parallax_sense="'.esc_attr($speed).'"></div>';
					
					}	
				}
				$output.='</div>';
			}
		}
		/*-------- moving Image row-------*/
		/*-------- parallax Image row-------*/
			if(!empty($middle_style) && $middle_style=='mordern_image_effect'){ 
				if(!empty($settings["mordern_effects"])) {		
					$css_loop='';
					$ij=0;
					foreach($settings["mordern_effects"] as $item) {
						
						$mordern_effect_z_index ='';
						if(!empty($item["mordern_effect_z_index"])){
							$mordern_effect_z_index = ' style="z-index:'.esc_attr($mordern_effect_z_index).'"';
						}
						
						$visiblity_hide='';
						if(!empty($item['responsive_visible_opt']) && $item['responsive_visible_opt']=='yes'){
							$visiblity_hide .= (($item['desktop_opt']!='yes' && $item['desktop_opt']=='') ? 'desktop-hide ' : '' );							
							$visiblity_hide .= (($item['tablet_opt']!='yes' && $item['tablet_opt']=='') ? 'tablet-hide ' : '' );
							$visiblity_hide .= (($item['mobile_opt']!='yes' && $item['mobile_opt']=='') ? 'mobile-hide ' : '' );
						}
						
						$magic_class = $magic_attr = $parallax_scroll = '';
						if (!empty($item['magic_scroll']) && $item['magic_scroll'] == 'yes') {
							
							if($item["scroll_option_popover_toggle"]==''){
								$scroll_offset=0;
								$scroll_duration=300;
							}else{
								$scroll_offset=$item['scroll_option_scroll_offset'];
								$scroll_duration=$item['scroll_option_scroll_duration'];
							}
							
							if($item["scroll_from_popover_toggle"]==''){
								$scroll_x_from=0;
								$scroll_y_from=0;
								$scroll_opacity_from=1;
								$scroll_scale_from=1;
								$scroll_rotate_from=0;
							}else{
								$scroll_x_from=$item['scroll_from_scroll_x_from'];
								$scroll_y_from=$item['scroll_from_scroll_y_from'];
								$scroll_opacity_from=$item['scroll_from_scroll_opacity_from'];
								$scroll_scale_from=$item['scroll_from_scroll_scale_from'];
								$scroll_rotate_from=$item['scroll_from_scroll_rotate_from'];
							}
							
							if($item["scroll_to_popover_toggle"]==''){
								$scroll_x_to=0;
								$scroll_y_to=-50;
								$scroll_opacity_to=1;
								$scroll_scale_to=1;
								$scroll_rotate_to=0;
							}else{
								$scroll_x_to=$item['scroll_to_scroll_x_to'];
								$scroll_y_to=$item['scroll_to_scroll_y_to'];
								$scroll_opacity_to=$item['scroll_to_scroll_opacity_to'];
								$scroll_scale_to=$item['scroll_to_scroll_scale_to'];
								$scroll_rotate_to=$item['scroll_to_scroll_rotate_to'];
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
						
						$uimg_id="img".$item["_id"].$ij;
						if($item['single_image_effects']["url"] != '') {
						$imgSrc = $item['single_image_effects']["url"];
						$image_id=$item["single_image_effects"]["id"];
						$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
						if(!$image_alt){
							$image_alt = get_the_title($image_id);
						}else if(!$image_alt){
							$image_alt = 'mordern image effect';
						}
						
							$effect=$animation_css='';
							if(!empty($item['mordern_effect'])){
								$effect='image-'.$item['mordern_effect'];
								if(!empty($item["effect_animation_duration"]["size"])){
									$animation_css .= 'animation-duration: '.$item["effect_animation_duration"]["size"].$item["effect_animation_duration"]["unit"].';-webkit-animation-duration: '.$item["effect_animation_duration"]["size"].$item["effect_animation_duration"]["unit"].';';
								}
								if($effect=='rotating'){
									$animation_css .= '-webkit-transform-origin: '.esc_attr($item["effect_transform_origin"]).';-moz-transform-origin:'.esc_attr($item["effect_transform_origin"]).';-ms-transform-origin:'.esc_attr($item["effect_transform_origin"]).';-o-transform-origin:'.esc_attr($item["effect_transform_origin"]).';transform-origin:'.esc_attr($item["effect_transform_origin"]).';';
								}
							}
							$output .='<div class="pt_plus_mordern_image_effects elementor-repeater-item-'.esc_attr($item['_id']).' '.esc_attr($uimg_id).' ' . esc_attr($magic_class) . ' '.esc_attr($visiblity_hide).'" '.$mordern_effect_z_index.'>';
							$output .='<div class="' . esc_attr($parallax_scroll) . '" ' . $magic_attr . '>';
								$output.='<img src="'.esc_url($imgSrc).'" class="mordern-image-effect morder_image_style  '.esc_attr($effect).'" alt="'.esc_attr($image_alt).'" style="opacity:'.esc_attr($item["layer_image_opacity"]["size"]).';'.$animation_css.'">';
							$output.='</div>';
							$output.='</div>';
						}
						$xpos='auto';$ypos='auto';$bpos='auto';$rpos='auto';
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
								$css_loop.='.pt_plus_mordern_image_effects.'.esc_attr($uimg_id).'{top:'.esc_attr($ypos).';bottom:'.esc_attr($bpos).';left:'.esc_attr($xpos).';right:'.esc_attr($rpos).';'.$d_max_width.'margin: 0 auto;}';
							
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
								$css_loop.='@media (min-width:601px) and (max-width:990px){.pt_plus_mordern_image_effects.'.esc_attr($uimg_id).'{top:'.esc_attr($tablet_ypos).';bottom:'.esc_attr($tablet_bpos).';left:'.esc_attr($tablet_xpos).';right:'.esc_attr($tablet_rpos).';'.$t_max_width.'margin: 0 auto;}}';
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
								$css_loop.='@media (max-width:600px){.pt_plus_mordern_image_effects.'.esc_attr($uimg_id).'{top:'.esc_attr($mobile_ypos).';bottom:'.esc_attr($mobile_bpos).';left:'.esc_attr($mobile_xpos).';right:'.esc_attr($mobile_rpos).';'.$m_max_width.'margin: 0 auto;}}';
							}
							$ij++;
					}
					$output .='<style>'.$css_loop.'</style>';
				}
			}
		/*-------- parellax Image row-------*/
		/*-----overlay normal color--------------*/
		
		if(!empty($settings["overlay_style"]) && $settings["overlay_style"]=='normal_color'){
		
			$output .='<div class="pt-plus-row-overlay" style="background:'.$settings["normal_overlay_color"].'"></div>';
		}
		/*----------------overlay normal color---*/
		/*----overlay gradient color---*/
		if(!empty($settings["overlay_style"]) && $settings["overlay_style"]=='gradient_color'){			
			$overlay_gradient_color1=$settings["overlay_gradient_color1"];
			$overlay_gradient_color1_control=$settings["overlay_gradient_color1_control"]["size"].$settings["overlay_gradient_color1_control"]["unit"];
			$overlay_gradient_color2=$settings["overlay_gradient_color2"];
			$overlay_gradient_color2_control=$settings["overlay_gradient_color2_control"]["size"].$settings["overlay_gradient_color2_control"]["unit"];
			$css_rules='';
			if(!empty($settings["overlay_bg_gradient_style"]) && $settings["overlay_bg_gradient_style"]=='linear'){
				$overlay_bg_gradient_angle=$settings["overlay_bg_gradient_angle"]["size"].$settings["overlay_bg_gradient_angle"]["unit"];	
				$css_rules .='background-color: transparent; background-image: linear-gradient('.$overlay_bg_gradient_angle.', '.$overlay_gradient_color1.' '.$overlay_gradient_color1_control.', '.$overlay_gradient_color2.' '.$overlay_gradient_color2_control.')';
			}else if(!empty($settings["overlay_bg_gradient_style"]) && $settings["overlay_bg_gradient_style"]=='radial'){
				
				$overlay_bg_gradient_position=$settings["overlay_bg_gradient_position"];
				$css_rules .='background-color: transparent; background-image: radial-gradient(at '.$overlay_bg_gradient_position.', '.$overlay_gradient_color1.' '.$overlay_gradient_color1_control.', '.$overlay_gradient_color2.' '.$overlay_gradient_color2_control.')';
			}
			$output .='<div class="pt-plus-row-overlay gradient-color" style="'.$css_rules.'"></div>';
		}
		/*---overlay gradient color---*/
		/*----texture image-----*/
		if(!empty($settings["overlay_style"]) && $settings["overlay_style"]=='texture_image' && !empty($settings["texture_image"]["url"])){
			$texture_css='';
			$imgSrc = $settings["texture_image"]["url"];
			$opacity_texture_image = $settings["opacity_texture_image"]["size"];
			$texture_css .= 'background: url('.esc_url($imgSrc).') repeat;opacity:'.esc_attr($opacity_texture_image).'';
			$output .='<div class="pt-plus-row-overlay texture-image" style="'.$texture_css.'"></div>';
		}
		/*---texture image-----*/		
		$output .='</div>';
		echo $output;
	 }
}