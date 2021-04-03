<?php
/**
 * Elementor custom Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class video_carousel_widget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'video_carousel_widget';
	}

	
	public function get_title() {
		return __( 'Custom Video Carousel', 'plugin-name' );
	}

	
	public function get_icon() {
		return 'fa fa-outdent';
	}

	
	public function get_categories() {
		return [ 'customWidget' ];
	}

	
	protected function _register_controls() {






	$this->start_controls_section(
			'carousel_options',
			[
				'label' => esc_html__( 'Carousel Area', 'Profits11' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

	  $repeater = new \Elementor\Repeater();

       $repeater->add_control(
			'video',
			[
				'label' => __( 'Put The Video Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'lists',
			[
				'label' => __( 'Carousel List', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);


      
       
     $this->end_controls_section();


     //Slide Settings Controls
		$this->start_controls_section(
			'setting_section',
			[
				'label' => __( 'Slider Settings', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'video_height',
			[
				'label' => __( 'Video Height', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .bg-video-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'nav',
			[
				'label' => __( 'Arrows?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'dots',
			[
				'label' => __( 'Dots?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'pauseOnHover',
			[
				'label' => __( 'Pause On Hover?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => __( 'Speed', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '300' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'autoplaySpeed',
			[
				'label' => __( 'AutoPlay Speed', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '3000' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'fade',
			[
				'label' => __( 'Fade Carousel?', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'your-plugin' ),
				'label_off' => __( 'No', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		

		$this->end_controls_section();

     


	}




	
	protected function render() {

		$settings = $this->get_settings_for_display();

		         $dynamicid = rand(5667575,777887);

		         if($settings['autoplay'] == 'yes'){
		         	$autoplay ='true';
		         }else{
		         	$autoplay = 'false';
		         }

		          if($settings['nav'] == 'yes'){
		         	$nav ='true';
			         }else{
			         	$nav = 'false';
			        }
			      if($settings['dots'] == 'yes'){
		         	$dots ='true';
			         }else{
			         	$dots = 'false';
			        } 
			        if($settings['pauseOnHover'] == 'yes'){
		         	$pauseOnHover ='true';
			         }else{
			         	$pauseOnHover = 'false';
			        }

			        if($settings['fade'] == 'yes'){
		         	   $fade ='true';
			         }else{
			         	$fade = 'false';
			        }

		         echo'<script>
                     jQuery(window).load(function(){
                         jQuery("#slideid-'.$dynamicid.'").slick({
							  autoplay:'.$autoplay.',
							  arrows:'.$nav.',
							  dots:'.$dots.',
							  pauseOnHover:'.$pauseOnHover.',
							  speed: '.$settings['speed'].',
							  autoplaySpeed: '.$settings['autoplaySpeed'].',
							  fade:'.$fade.',
							  slidesToShow: 1,
							  nextArrow: "<i class=\"fa fa-angle-right\"></i>",
                              prevArrow: "<i class=\"fa fa-angle-left\"></i>",
							});
						});
                 </script>';

                 echo'<script>
                      elementorFrontend.hooks.addAction( "frontend/element_ready/widget", function( $scope ) {
 
					     jQuery("#slideid-'.$dynamicid.'").slick({
							  autoplay:'.$autoplay.',
							  arrows:'.$nav.',
							  dots:'.$dots.',
							  pauseOnHover:'.$pauseOnHover.',
							  speed: '.$settings['speed'].',
							  autoplaySpeed: '.$settings['autoplaySpeed'].',
							 fade:'.$fade.',
							  slidesToShow: 1,
							  nextArrow: "<i class=\"fa fa-arrow-right\"></i>",
                              prevArrow: "<i class=\"fa fa-arrow-left\"></i>",
							});
					    
					  } );
                 </script>';


                  $html='<div class="custom_v_c_area" id="slideid-'.$dynamicid.'">';
                      foreach($settings['lists'] as $list){
                      	$html.='<div class="bg-video-wrap">
						  <video src="'.$list['video'].'" loop muted autoplay>
						  </video>
					   </div>';
                      }
                  $html.='</div>';

                  


		         echo $html;

		     }



       }





	
