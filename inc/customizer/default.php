<?php
/**
 * Default Theme Option.
 *
 * @package bakery_shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 
function bakery_shop_customize_register_default( $wp_customize ) {

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
   

    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'bakery-shop' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'bakery-shop' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';


    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'bakery_shop_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'bakery_shop_customize_partial_blogdescription',
        ) );
    }

    }
add_action( 'customize_register', 'bakery_shop_customize_register_default' );