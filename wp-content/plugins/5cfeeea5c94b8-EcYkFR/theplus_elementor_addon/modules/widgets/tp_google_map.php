<?php 
/*
Widget Name: Advanced Google Map
Description: Style Of Google Map Location
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
use Elementor\Scheme_Typography;

use TheplusAddons\Theplus_Element_Load;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class ThePlus_Google_Map extends Widget_Base {
		
	public function get_name() {
		return 'tp-google-map';
	}

    public function get_title() {
        return __('Google Map', 'theplus');
    }

    public function get_icon() {
        return 'fa fa-map-o theplus_backend_icon';
    }

    public function get_categories() {
        return array('plus-adapted');
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
				'label' => __( 'Content', 'theplus' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'map_content_heading',
			[
				'label' => __( 'Map Locations', 'theplus' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'latitude',
			[
				'label' => __( 'Latitude Value', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '40.730271',				
				'placeholder' => __( 'Enter Latitude Location', 'theplus' ),
				'description' => __( 'Enter Latitude value of your location of Google map. You can find that using. <a target="_blank" class="tootip-link" href="http://www.latlong.net/">Check link</a>', 'theplus' ),
			]
		);
		$repeater->add_control(
			'longitude',
			[
				'label' => __( 'Longitude Value', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' => '-73.989089',				
				'placeholder' => __( 'Enter Latitude Location', 'theplus' ),
				'description' => __( 'Enter Longitude value of your location of Google map. You can find that using. <a target="_blank" class="tootip-link" href="http://www.latlong.net/">Check link</a>', 'theplus' ),
			]
		);
		$repeater->add_control(
			'address',
			[
				'label' => __( 'Address text for Tooltip', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'New York City', 'theplus' ),
				'rows' => 3,
				'description' => __( 'Add text you want to show on Pin Icon as a Tooltip for this Location using this option.', 'theplus' ),
			]
		);
		$repeater->add_control(
			'pin_icon',
			[
				'label' => __( 'Pin Icon', 'theplus' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => '',
				],
			]
		);
		$this->add_control(
            'map_locations',
            [
				'label' => __( 'Add Multiple Location Point', 'theplus' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'address' => '',                       
                    ],
                ],                
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{ address}}}',
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
					'{{WRAPPER}} .pt-plus-adv-map' => 'min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();
		/*map style creative*/
		$this->start_controls_section(
            'section_map_style_content',
            [
                'label' => __('Map Style', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'zoom',
			[
				'label' => __( 'Map Zoom', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 25,
					],
				],
				'description' => __('Enter values from 1 to 25 to zoom google map as per requirement..','theplus'),
			]
		);
		$this->add_control(
			'gmap_option',
			[
				'label' => __( 'Map Options', 'theplus' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'scroll_wheel'  => __( 'Scroll Wheel', 'theplus' ),
					'pan_control' => __( 'Pan Control', 'theplus' ),
					'draggable' => __( 'Draggable', 'theplus' ),
					'zoom_control' => __( 'Zoom Control', 'theplus' ),
					'map_type_control' => __( 'Map Type Control', 'theplus' ),
					'scale_control' => __( 'Scale Control', 'theplus' ),
					'fullscreen_control' => __( 'Full-screen Control', 'theplus' ),
					'streetview_control' => __( 'Street View Control', 'theplus' ),
				],
				'default' => [ 'pan_control','draggable','zoom_control','map_type_control','scale_control','scroll_wheel','fullscreen_control','streetview_control'],
			]
		);
		$this->add_control(
			'map_type',
			[
				'label' => __( 'Google Map Variations', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ROADMAP',
				'options' => [
					'ROADMAP'  => __( 'ROADMAP (Displays a normal, default 2D map)', 'theplus' ),
					'HYBRID' => __( 'HYBRID (Displays a photographic map + roads and city names)', 'theplus' ),
					'SATELLITE' => __( 'SATELLITE (Displays a photographic map)', 'theplus' ),
					'TERRAIN' => __( 'TERRAIN (Displays a map with mountains, rivers, etc.)', 'theplus' ),
				],
			]
		);
		
		$this->add_control(
			'adv_modify_json',[
				'label'   => esc_html__( 'Custom Style Maps', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'description' => __( 'You can choose our creative google map styles using this option.', 'theplus' ),
			]
		);
		$this->add_control(
			'map_style',
			[
				'label' => __( 'Creative Map Style', 'theplus' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => theplus_get_style_list(7),
				'condition' => [
					'adv_modify_json' => 'yes',
				],
			]
		);
		$this->add_control(
			'modify_coloring',[
				'label'   => esc_html__( 'Modify Google Maps Hue, Saturation, Lightness', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'description' => __( 'Choose one from these Modify Google Maps Hue, Saturation styles.', 'theplus' ),
				'condition' => [
					'adv_modify_json' => 'yes',
				],
			]
		);
		$this->add_control(
			'hue',
			[
				'label' => __( 'Hue', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ccc',
				'condition' => [
					'adv_modify_json' => 'yes',
					'modify_coloring' => 'yes',
				],
			]
		);
		$this->add_control(
			'saturation',
			[
				'label' => __( 'Saturation', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'description' => __('Shifts the saturation of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].','theplus'),
				'condition' => [
					'adv_modify_json' => 'yes',
					'modify_coloring' => 'yes',
				],
			]
		);
		$this->add_control(
			'lightness',
			[
				'label' => __( 'Lightness', 'theplus' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					],
				],
				'description' => __('Shifts lightness of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].','theplus'),
				'condition' => [
					'adv_modify_json' => 'yes',
					'modify_coloring' => 'yes',
				],
			]
		);
		
		$this->end_controls_section();
		/*map style creative*/
		/*map overlay*/
		$this->start_controls_section(
            'section_map_overlay_content',
            [
                'label' => __('Map Overlay', 'theplus'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'overlay_toggle',[
				'label'   => esc_html__( 'Content Over the Map', 'theplus' ),
				'type'    =>  Controls_Manager::SWITCHER,
				'default' => 'no',
				'label_on' => __( 'Show', 'theplus' ),
				'label_off' => __( 'Hide', 'theplus' ),
				'description' => __( 'You can Put toggle on off button with content over the map using this option.', 'theplus' ),
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'theplus' ),
				'type' => Controls_Manager::TEXT,
				'default' =>  __( 'Location Here', 'theplus' ),
				'description' => __( 'You can add title of map using this option.', 'theplus' ),
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_control(
			'overlay_content',
			[
				'label' => __( 'Description', 'theplus' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' =>  __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.', 'theplus' ),
				'description' => __( 'You can add description of map using this option.', 'theplus' ),
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .pt-plus-overlay-map-content',
				'separator' => 'after',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt-plus-overlay-map-content .gmap-title',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-overlay-map-content .gmap-title' => 'color: {{VALUE}}',
				],
				'separator' => 'after',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => __( 'Description Typography', 'theplus' ),
				'selector' => '{{WRAPPER}} .pt-plus-overlay-map-content .gmap-desc',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .pt-plus-overlay-map-content .gmap-desc' => 'color: {{VALUE}}',
				],
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_control(
			'toggle_btn_color',
			[
				'label' => __( 'Toggle Button Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(0, 0, 0, 0.4)',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->add_control(
			'toggle_ative_color',
			[
				'label' => __( 'Toggle Active Color', 'theplus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#81d742',
				'condition' => [
					'overlay_toggle' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		/*map overlay*/
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
		$map_style=$settings["map_style"];
		$adv_modify_json=$settings["adv_modify_json"];
		$modify_coloring=$settings["modify_coloring"];
		$map_type=$settings["map_type"];
		$hue=$settings["hue"];
		
		
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
			
			$json = array();
			$json1 = array();
			$json['places']  = array();
			$json['options'] = array();
			$json['style']   = array();
			$pin_icon='';
			
			foreach($settings['map_locations'] as $index => $item ) {
				if(!empty($item['longitude'])){
					$longitude = $item['longitude'];
				}else{
					$longitude ='';
				}
				if(!empty($item['latitude'])){
					$latitude = $item['latitude'];
				}else{
						$latitude ='';
				}
				if(!empty($item['address'])){
					$address = $item['address'];
				}else{
						$address ='';
				}
				   
				if(!empty($item['pin_icon']["url"])){
					$pin_icon=$item['pin_icon']["url"];
				}else{
					$pin_icon='';
				}
				if(!empty($longitude) || !empty($latitude)){
					$json['places'][] = array(
						"address"   => htmlentities($address),
						"latitude"  => $latitude,
						"longitude" => $longitude,		
						"pin_icon" => $pin_icon
					);
				}
			}
			$gmap_option=array();
			foreach ( $settings['gmap_option'] as $value ) {
				$gmap_option[]=$value;
			}
			$draggable='false';
			$pan_control='false';
			$zoom_control ='false';
			$scale_control ='false';
			$map_type_control ='false';
			$scrollwheel='false';
			$fullscreen_control='false';
			$streetview_control='false';
			
			foreach($gmap_option as $key => $val) {
				if($val=='draggable'){
					$draggable='true';
				}
				if($val=='scroll_wheel'){
					$scrollwheel='true';
				}
				if($val=='pan_control'){
					$pan_control ='true';
				}
				if($val=='zoom_control'){
					$zoom_control='true';
				}
				if($val=='scale_control'){
					$scale_control ='true';
				}
				if($val=='map_type_control'){
					$map_type_control='true';
				}	
				if($val=='fullscreen_control'){
					$fullscreen_control='true';
				}
				if($val=='streetview_control'){
					$streetview_control='true';
				}	
			}
			
			$json['options'] = array(
				"zoom"      		=> intval($settings['zoom']["size"]),
				"scrollwheel"		=> $scrollwheel == 'true' ? true : false,
				"draggable"		=> $draggable == 'true' ? true : false,
				"panControl"		=> $pan_control == 'true' ? true : false,
				"zoomControl"		=> $zoom_control == 'true' ? true : false,
				"scaleControl"		=> $scale_control == 'true' ? true : false,
				"mapTypeControl"	=> $map_type_control == 'true' ? true : false,
				"fullscreenControl"	=> $fullscreen_control == 'true' ? true : false,
				"streetViewControl"	=> $streetview_control == 'true' ? true : false,
					"mapTypeId"		=> $map_type
			);
			
			$maps_style='';
			if( $modify_coloring == 'yes' ) {
				$json['style'][] = array(
					"stylers" => array(
						array(  "hue" => $hue ),
					array(  "saturation" 	 => $settings['saturation']["size"] ),
						array(  "lightness"   	=> $settings['lightness']["size"] ),
					array(  "featureType" 	=> "landscape.man_made",
						"stylers" 		=> array(
							array( "visibility" => "on" )
							)
					)
					)
				);
				$maps_style='';
			}elseif( $adv_modify_json == 'yes' ) {
				$maps_style=$map_style;
			}
			
			$uid=uniqid("plus-gmap");
			
			$json = str_replace("'", "&apos;", json_encode( $json ) );
			$gmap_content ='<div class="pt-plus-adv-gmap">';
				$gmap_content .='<div id="'.esc_attr($uid).'" class="pt-plus-adv-map js-el '.esc_attr($animated_class).'" data-id="'.esc_attr($uid).'" data-adv-maps="'.htmlentities($json, ENT_QUOTES, "UTF-8").'" data-map-style="'.$maps_style.'"  '.$animation_attr.'></div>';
			
				if(!empty($settings["overlay_toggle"]) && $settings["overlay_toggle"]=='yes'){
				
					$toggle_btn_color=$settings["toggle_btn_color"];
					$toggle_ative_color=$settings["toggle_ative_color"];
					$title_text=$settings["title_text"];
					$overlay_content=$settings["overlay_content"];
					
					$gmap_content .='<div class="pt-plus-overlay-map-content '.esc_attr($uid).'"  data-uid="'.esc_attr($uid).'" data-toggle-btn-color="'.esc_attr($toggle_btn_color).'" data-toggle-active-color="'.esc_attr($toggle_ative_color).'">';
						$gmap_content .='<div class="gmap-title">'.esc_html($title_text).'</div>';
						$gmap_content .='<div class="gmap-desc">'.$overlay_content.'</div>';
							$gmap_content .='<div class="overlay-list-item">
									<input id="toggle_overlay_'.esc_attr($uid).'" type="checkbox" class="pt-plus-overlay-gmap pt-plus-overlay-gmap-tgl checked-'.esc_attr($uid).'"/>
								<label for="toggle_overlay_'.esc_attr($uid).'" class="pt-plus-overlay-gmap-btn check-label-'.esc_attr($uid).'"></label>
								</div>';
					$gmap_content .='</div>';
				}
			$gmap_content .='</div>';
			
		echo $gmap_content;
	}
	
    protected function content_template() {
	
    }

}
