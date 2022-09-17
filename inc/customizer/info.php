<?php
/**
 * Bakery Shop Theme Info
 *
 * @package bakery_shop
 */

function bakery_shop_customizer_theme_info( $wp_customize ) {
	
    $wp_customize->add_section( 'theme_info' , array(
		'title'       => __( 'Theme Information' , 'bakery-shop' ),
		'priority'    => 6,
		));

     // Theme info
    $wp_customize->add_setting(
		'setup_instruction',
		array(
			'sanitize_callback' => 'wp_kses_post'
		)
	);

	$wp_customize->add_control(
		new bakery_shop_Theme_Info( 
			$wp_customize,
			'setup_instruction',
			array(
				'settings'		=> 'setup_instruction',
				'section'		=> 'theme_info',
				'label'	=> __('Information Links','bakery-shop'),
			)
		)
	);

	$wp_customize->add_setting('theme_info_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));
    
    $theme_info = '';
    $theme_info .= '<h3 class="sticky_title">' . __( 'Need help?', 'bakery-shop' ) . '</h3>';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Documentation', 'bakery-shop' ) . ': </label><a href="' . esc_url( 'http://docs.prosysthemes.com/bakery-shop/' ) . '" target="_blank">' . __( 'here', 'bakery-shop' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Theme Demo', 'bakery-shop' ) . ': </label><a href="' . esc_url( 'http://prosysthemes.com/preview/bakery-shop/' ) . '" target="_blank">' . __( 'here', 'bakery-shop' ) . '</a></span><br />';
    $theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Support Forum', 'bakery-shop' ) . ': </label><a href="' . esc_url( 'http://prosysthemes.com/support-forum/' ) . '" target="_blank">' . __( 'here', 'bakery-shop' ) . '</a></span><br />';
	$theme_info .= '<span class="sticky_info_row"><label class="row-element">' . __( 'Rate this theme', 'bakery-shop' ) . ': </label><a href="' . esc_url( 'https://wordpress.org/support/theme/bakery-shop/reviews' ) . '" target="_blank">' . __( 'here', 'bakery-shop' ) . '</a></span><br />';


	$wp_customize->add_control( 
		new Bakery_Shop_Theme_Info( 
			$wp_customize,
			'theme_info_theme',
			array(
				'section' => 'theme_info',
				'description' => $theme_info
			)
		)
	);

	$wp_customize->add_setting('theme_info_more_theme',array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post',
		));

}
add_action( 'customize_register', 'bakery_shop_customizer_theme_info' );


if( class_exists( 'WP_Customize_control' ) ){

	class Bakery_Shop_Theme_Info extends WP_Customize_Control
	{
    	/**
       	* Render the content on the theme customizer page
       	*/
       	public function render_content()
       	{
       		?>
       		<label>
       			<strong class="customize-text_editor"><?php echo esc_html( $this->label ); ?></strong>
       			<br />
       			<span class="customize-text_editor_desc">
       				<?php echo wp_kses_post( $this->description ); ?>
       			</span>
       		</label>
       		<?php
       	}
    }//editor close
    
}//class close

if( class_exists( 'WP_Customize_Section' ) ) :
/**
 * Adding Go to Pro Section in Customizer
 * https://github.com/justintadlock/trt-customizer-pro
 */
class Bakery_Shop_Customize_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'pro-section';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

add_action( 'customize_register', 'bakery_shop_sections_pro' );
function Bakery_Shop_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'Bakery_Shop_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new Bakery_Shop_Customize_Section_Pro(
			$manager,
			'bakery_shop_view_pro',
			array(
				'title'    => esc_html__( 'Pro Available', 'bakery-shop' ),
                'priority' => 5, 
				'pro_text' => esc_html__( 'VIEW PRO THEME', 'bakery-shop' ),
				'pro_url'  => 'http://prosysthemes.com/wordpress-themes/bakery-shop-pro/'
			)
		)
	);
}