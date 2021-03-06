<?php

add_action( 'customize_register', 'mono_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 * 
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function mono_customizer_register() {

	/**
	 * Customize Background Image Control Class
	 *
	 * @package WordPress
	 * @subpackage Customize
	 * @since 3.4.0
	 */
	class Child_Mono_Image_Control extends WP_Customize_Image_Control {

		/**
		 * Constructor.
		 *
		 * If $args['settings'] is not defined, use the $id as the setting ID.
		 *
		 * @since 3.4.0
		 * @uses WP_Customize_Upload_Control::__construct()
		 *
		 * @param WP_Customize_Manager $manager
		 * @param string $id
		 * @param array $args
		 */
		public function __construct( $manager, $id, $args ) {
			$this->statuses = array( '' => __( 'No Image', 'mono' ) );

			parent::__construct( $manager, $id, $args );

			$this->add_tab( 'upload-new', __( 'Upload New', 'mono' ), array( $this, 'tab_upload_new' ) );
			$this->add_tab( 'uploaded',   __( 'Uploaded', 'mono' ),   array( $this, 'tab_uploaded' ) );

			if ( $this->setting->default )
				$this->add_tab( 'default',  __( 'Default', 'mono' ),  array( $this, 'tab_default_background' ) );

			// Early priority to occur before $this->manager->prepare_controls();
			add_action( 'customize_controls_init', array( $this, 'prepare_control' ), 5 );
		}

		/**
		 * @since 3.4.0
		 * @uses WP_Customize_Image_Control::print_tab_image()
		 */
		public function tab_default_background() {
			$this->print_tab_image( $this->setting->default );
		}

	}

	global $wp_customize;

	$images = apply_filters( 'mono_images', array( '1', '2', '3', '4', '5', '6' ) );

	$wp_customize->add_section( 'mono-settings', array(
		'description' => __( 'Use the included default images or personalize your site by uploading your own images.<br /><br />The default images are <strong>1600 pixels wide and 1050 pixels tall</strong>.', 'mono' ),
		'title'    => __( 'Front Page Background Images', 'mono' ),
		'priority' => 35,
	) );

	foreach( $images as $image ){

		$wp_customize->add_setting( $image .'-mono-image', array(
			'default'  => sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $image ),
			'type'     => 'option',
		) );

		$wp_customize->add_control( new Child_Mono_Image_Control( $wp_customize, $image .'-mono-image', array(
			'label'    => sprintf( __( 'Featured Section %s Image:', 'mono' ), $image ),
			'section'  => 'mono-settings',
			'settings' => $image .'-mono-image',
			'priority' => $image+1,
		) ) );

	}

}
