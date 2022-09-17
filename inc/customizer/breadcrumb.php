<?php
/**
 * Breadcrumbs Options
 *
 * @package bakery_shop
 */
 
function bakery_shop_customize_register_breadcrumbs( $wp_customize ) {

    /** BreadCrumb Settings */
    
    $wp_customize->add_section(
        'bakery_shop_breadcrumb_settings',
        array(
            'title' => __( 'Breadcrumb Settings', 'bakery-shop' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'bakery_shop_ed_breadcrumb',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_breadcrumb',
        array(
            'label' => __( 'Enable Breadcrumb', 'bakery-shop' ),
            'section' => 'bakery_shop_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Current */
    $wp_customize->add_setting(
        'bakery_shop_ed_current',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_current',
        array(
            'label' => __( 'Show current', 'bakery-shop' ),
            'section' => 'bakery_shop_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Home Text */
    $wp_customize->add_setting(
        'bakery_shop_breadcrumb_home_text',
        array(
            'default' => __( 'Home', 'bakery-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_breadcrumb_home_text',
        array(
            'label' => __( 'Breadcrumb Home Text', 'bakery-shop' ),
            'section' => 'bakery_shop_breadcrumb_settings',
            'type' => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'bakery_shop_breadcrumb_separator',
        array(
            'default' => __( '>', 'bakery-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_breadcrumb_separator',
        array(
            'label' => __( 'Breadcrumb Separator', 'bakery-shop' ),
            'section' => 'bakery_shop_breadcrumb_settings',
            'type' => 'text',
        )
    );
    /** BreadCrumb Settings Ends */
    
    }
add_action( 'customize_register', 'bakery_shop_customize_register_breadcrumbs' );
