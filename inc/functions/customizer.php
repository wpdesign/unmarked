<?php
/**
 * Unmarked Theme Customizer
 * Add postMessage support for site title and description for the Theme Customizer.
**/
function unmarked_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Footer Copyright Text
	class Unmarked_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public function render_content() {
	?>

	 <label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	 </label>

	<?php
	  }
	}
	$wp_customize->add_setting('footer_setting', array(
		'default' => 'Enter footer copyright text here', 
		'sanitize_callback' => 'unmarked_sanitize_text',
	));
	$wp_customize->add_control(new Unmarked_Customize_Textarea_Control($wp_customize, 'footer_setting', array(
		'label' => 'Footer Text',
		'section' => 'footer',
		'settings' => 'footer_setting',
	)));
	$wp_customize->add_section('footer' , array(
	  'title' => __('Footer Text','unmarked'),
	));
	
	//Add retina support for logo
	$wp_customize->add_setting( 'unamrked_logo_width', array(
        'default'	=> 'width e.g. 300',
		'sanitize_callback'	=> 'unmarked_sanitize_text'
    ) );
	$wp_customize->add_control( 'unamrked_logo_width', array(
        'label'   => 'To support retina display upload double sized logo and enter the width of actual logo here',
        'section' => 'title_tagline',
		'type'    => 'number',
		'priority' => 8
    ) );
		
}
add_action( 'customize_register', 'unmarked_customize_register' );

function unmarked_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
 



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function unmarked_customize_preview_js() {
	wp_enqueue_script( 'unmarked_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'unmarked_customize_preview_js' );
