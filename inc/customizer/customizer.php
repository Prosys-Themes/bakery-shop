<?php
/**
 * Bakery Shop Theme Customizer.
 *
 * @package bakery_shop
 */

    $bakery_shop_settings = array( 'info', 'default', 'home', 'breadcrumb'  );

    /* Option list of all post */	
    $bakery_shop_options_posts = array();
    $bakery_shop_options_posts_obj = get_posts('posts_per_page=-1');
    $bakery_shop_options_posts[''] = __( 'Choose Post', 'bakery-shop' );
    foreach ( $bakery_shop_options_posts_obj as $bakery_shop_posts ) {
    	$bakery_shop_options_posts[$bakery_shop_posts->ID] = $bakery_shop_posts->post_title;
    }
    
 	/* Option list of all page */   
    $bakery_shop_options_pages = array();
    $bakery_shop_options_pages_obj = get_pages('posts_per_page=-1');
    $bakery_shop_options_pages[''] = __( 'Choose Page', 'bakery-shop' );
    foreach ( $bakery_shop_options_pages_obj as $bakery_shop_pages ) {
        $bakery_shop_options_pages[$bakery_shop_pages->ID] = $bakery_shop_pages->post_title;
    }

    /* Option list of all categories */
    $bakery_shop_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $bakery_shop_option_categories = array();
    $bakery_shop_category_lists = get_categories( $bakery_shop_args );
    $bakery_shop_option_categories[''] = __( 'Choose Category', 'bakery-shop' );
    foreach( $bakery_shop_category_lists as $bakery_shop_category ){
        $bakery_shop_option_categories[$bakery_shop_category->term_id] = $bakery_shop_category->name;
    }

	foreach( $bakery_shop_settings as $setting ){
		require get_template_directory() . '/inc/customizer/' . $setting . '.php';
	}

/**
 * Font Awesome List
 */
require get_template_directory() . '/inc/fontawesome-list.php';

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bakery_shop_customize_preview_js() {
    wp_enqueue_script( 'bakery_shop_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'bakery_shop_customize_preview_js' );

/**
 * Enqueue Scripts for customize controls
*/
function bakery_shop_customize_scripts() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');   
    wp_enqueue_style( 'bakery-shop-admin-style',get_template_directory_uri().'/inc/css/admin.css', '1.0', 'screen' );    
    //wp_enqueue_script( 'bakery-shop-admin-js', get_template_directory_uri().'/inc/js/admin.js', array( 'jquery' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'bakery_shop_customize_scripts' );