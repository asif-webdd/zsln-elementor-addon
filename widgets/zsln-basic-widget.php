<?php
/**
 * ZSLN Basic Widget.
 *
 * @since 1.0.0
 */

use \Elementor\Widget_Base;

class Zsln_Basic_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'zsln_basic_widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'ZSLN', 'zsln-elm-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-font';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'basic' ];
	}

	//
	public function get_style_depends() {
		return [ 'zsln-widget-css' ];
	}

	//
	public function get_script_depends() {
		return [ 'zsln-widget-js' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'zsln-elm-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'zsln-_heading',
			[
				'label' => __( 'Heading', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Type Heading', 'zsln-elm-addon' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Scheme_Color::get_type(),
					'value' => \Elementor\Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'zsln_description',
			[
				'label' => __( 'Description', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type Description', 'zsln-elm-addon' ),
			]
		);

		$this->add_control(
			'zsln_url',
			[
				'label' => __( 'URL to embed', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'input_type' => 'url',
				'placeholder' => __( 'https://your-link.com', 'zsln-elm-addon' ),
			]
		);

		$this->add_control(
			'zsln_open_lightbox',
			[
				'label' => __( 'Lightbox', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'zsln-elm-addon' ),
					'yes' => __( 'Yes', 'zsln-elm-addon' ),
					'no' => __( 'No', 'zsln-elm-addon' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'zsln_alignment',
			[
				'label' => __( 'Alignment', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'zsln-elm-addon' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'zsln-elm-addon' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'zsln-elm-addon' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'zsln-elm-addonn' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'font_family',
			[
				'label' => __( 'Font Family', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} .title' => 'font-family: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'zsln_border_style',
			[
				'label' => __( 'Border Style', 'zsln-elm-addon' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'  => __( 'Solid', 'plugin-domain' ),
					'dashed' => __( 'Dashed', 'plugin-domain' ),
					'dotted' => __( 'Dotted', 'plugin-domain' ),
					'double' => __( 'Double', 'plugin-domain' ),
					'none' => __( 'None', 'plugin-domain' ),
				],
			]
		);





		$this->end_controls_section();




		$this->start_controls_section(
			'zsln_style_section',
			[
				'label' => __( 'Style', 'zsln-elm-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);



		$this->end_controls_section();


	}





	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$zsln_wid = $this->get_settings_for_display();

		// Heading
		echo '<h2>' . $zsln_wid['zsln-_heading'] . '</h2>';

		// Text Color
		echo '<h2 class="title" style="color: ' . $zsln_wid['title_color'] . '"></h2>';

		// Description
		echo $zsln_wid ['zsln_description'];

		// Get image URL
		echo '<img src="' . $zsln_wid['image']['url'] . '">';

		// Border
		echo '<div style="border-style: ' . $zsln_wid['zsln_border_style'] . '"> .. </div>';



	}






}




