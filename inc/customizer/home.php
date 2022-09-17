<?php
/**
 * Home Page Options
 *
 * @package bakery_shop
 */
 
function bakery_shop_customize_register_home( $wp_customize ) {
    
    global $bakery_shop_options_pages;
    global $bakery_shop_options_posts;
    global $bakery_shop_option_categories;
    global $bakery_shop_default_post;
    global $bakery_shop_default_page;

    if( bakery_shop_is_woocommerce_activated() ){
        global $product;
        /* Option list of all post */ 
        $bakery_shop_options_products = array();
        $bakery_shop_options_products_obj = get_posts('posts_per_page=-1&post_type=product');
        $bakery_shop_options_products[''] = __( 'Choose Product', 'bakery-shop' );
        foreach ( $bakery_shop_options_products_obj as $posts ) {
            $bakery_shop_options_products[$posts->ID] = $posts->post_title;
        }

        /* Declare Global Default Post ID*/
        $bakery_shop_default_product = '';
        $bakery_shop_product_array = get_posts();
        if(is_array($bakery_shop_product_array)){
            $bakery_shop_default_product = $bakery_shop_product_array[0]->ID;
        }

    }

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'bakery_shop_home_page_settings',
         array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'bakery-shop' ),
            'description' => __( 'Customize Home Page Settings', 'bakery-shop' ),
        ) 
    );
    
     /** Slider Settings */
    $wp_customize->add_section(
        'bakery_shop_slider_section_settings',
        array(
            'title'     => __( 'Slider Settings', 'bakery-shop' ),
            'priority'  => 10,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );
   
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'bakery_shop_ed_slider',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'bakery_shop_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'bakery_shop_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Pager */
    $wp_customize->add_setting(
        'bakery_shop_slider_pager',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_pager',
        array(
            'label' => __( 'Enable Slider Pager', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'bakery_shop_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
        
    /** Slider Animation */
    $wp_customize->add_setting(
        'bakery_shop_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'bakery_shop_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_animation',
        array(
            'label' => __( 'Select Slider Animation', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'bakery-shop' ),
                'slide' => __( 'Slide', 'bakery-shop' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'bakery_shop_slider_speeds',
        array(
            'default' => 400,
            'sanitize_callback' => 'bakery_shop_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_speeds',
        array(
            'label' => __( 'Slider Speed', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Pause */
    $wp_customize->add_setting(
        'bakery_shop_slider_pause',
        array(
            'default' => 6000,
            'sanitize_callback' => 'bakery_shop_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_pause',
        array(
            'label' => __( 'Slider Pause', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'text',
        )
    );
    
    for( $i=1; $i<=3; $i++){  
        /** Select Slider Post */
        $wp_customize->add_setting(
            'bakery_shop_slider_post_'.$i,
            array(
                'default' => $bakery_shop_default_post,
                'sanitize_callback' => 'bakery_shop_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'bakery_shop_slider_post_'.$i,
            array(
                'label' => __( 'Select Post ', 'bakery-shop' ).$i,
                'section' => 'bakery_shop_slider_section_settings',
                'type' => 'select',
                'choices' => $bakery_shop_options_posts,
            )
        );

    }

     /** Slider Readmore */
    $wp_customize->add_setting(
        'bakery_shop_slider_readmore',
        array(
            'default' => __( 'Learn More', 'bakery-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'text',
        )
    );

    
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'bakery_shop_ed_curtain',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_curtain',
        array(
            'label' => __( 'Enable Header Curtain', 'bakery-shop' ),
            'section' => 'bakery_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Slider Settings Ends */
    
    /** Featured Section */
    $wp_customize->add_section(
        'bakery_shop_feature_section_settings',
        array(
            'title' => __( 'Featured Section', 'bakery-shop' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );
    
    /** Enable/Disable Featured Section */
    $wp_customize->add_setting(
        'bakery_shop_ed_featured_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_featured_section',
        array(
            'label' => __( 'Enable Featured Post Section', 'bakery-shop' ),
            'section' => 'bakery_shop_feature_section_settings',
            'type' => 'checkbox',
        )
    );
       
    /** Enable/Disable Featured Section Icon*/
    $wp_customize->add_setting(
        'bakery_shop_ed_featured_icon',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_featured_icon',
        array(
            'label' => __( 'Enable Featured Post Icon', 'bakery-shop' ),
            'section' => 'bakery_shop_feature_section_settings',
            'type' => 'checkbox',
        )
    );

    for( $i=1; $i<=3; $i++){  
    
        /** featured Post */
        $wp_customize->add_setting(
            'bakery_shop_feature_post_'.$i,
            array(
                'default' => $bakery_shop_default_post,
                'sanitize_callback' => 'bakery_shop_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'bakery_shop_feature_post_'.$i,
            array(
                'label'   => __( 'Select Featured Post ', 'bakery-shop' ) .$i ,
                'section' => 'bakery_shop_feature_section_settings',
                'type'    => 'select',
                'choices' => $bakery_shop_options_posts
            ));

        $wp_customize->add_setting(
            'bakery_shop_feature_icon_'.$i,
            array(
                'default'           => 'fa fa-bell',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control(
            new Bakery_Shop_Fontawesome_Icon_Chooser(
            $wp_customize,
            'bakery_shop_feature_icon_'.$i,
                array(
                    'settings' => 'bakery_shop_feature_icon_'.$i,
                    'section'  => 'bakery_shop_feature_section_settings',
                    'label'    => __( 'FontAwesome Icon ', 'bakery-shop' ) .$i,
                )
            )
        );
        
    }

    /** About Section Settings */
    $wp_customize->add_section(
        'bakery_shop_about_section_settings',
        array(
            'title' => __( 'About Section', 'bakery-shop' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );
    
    /** Enable about Section */   
    $wp_customize->add_setting(
        'bakery_shop_ed_about_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_about_section',
        array(
            'label' => __( 'Enable Welcome Section', 'bakery-shop' ),
            'section' => 'bakery_shop_about_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** welcome Section Ends */

    /* Featured Product Section*/
     $wp_customize-> add_section(
        'bakery_shop_featured_product_settings',
        array(
            'title'=> __('Featured Product Section','bakery-shop'),
            'priority'=> 30,
            'panel'=> 'bakery_shop_home_page_settings'
            )
        );

    /** Enable/Disable featured_dish Section */
    $wp_customize->add_setting(
        'bakery_shop_ed_product_section',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_product_section',
        array(
            'label' => __( 'Enable Featured Product Section', 'bakery-shop' ),
            'section' => 'bakery_shop_featured_product_settings',
            'type' => 'checkbox',
            'description' => __( 'Please Enable Woocommerce to display items in Featured Products.', 'bakery-shop'),
        )
    );
    
    /*select page for Product section*/
    $wp_customize->add_setting(
        'bakery_shop_featured_product_page',
        array(
            'default' => $bakery_shop_default_page,
            'sanitize_callback' => 'bakery_shop_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_featured_product_page',
        array(
            'label' => __( 'Select Page', 'bakery-shop' ),
            'section' => 'bakery_shop_featured_product_settings',
            'type' => 'select',
            'choices' => $bakery_shop_options_pages,
        )
    );

   if( bakery_shop_is_woocommerce_activated() ){
    
        for( $i=1; $i<=10; $i++){  
            /** Select Slider Post */
            $wp_customize->add_setting(
                'bakery_shop_product_post_'.$i,
                array(
                    'default' => '',
                    'sanitize_callback' => 'bakery_shop_sanitize_select',
                )
            );
            
            $wp_customize->add_control(
                'bakery_shop_product_post_'.$i,
                array(
                    'label' => __( 'Select Product ', 'bakery-shop' ).$i,
                    'section' => 'bakery_shop_featured_product_settings',
                    'type' => 'select',
                    'choices' => $bakery_shop_options_products,
                )
            );
        }
    
    }
  
    /** cta Section Settings */
    $wp_customize->add_section(
        'bakery_shop_cta_section_settings',
        array(
            'title' => __( 'CTA Section', 'bakery-shop' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );
    
    /** Enable cta Section */   
    $wp_customize->add_setting(
        'bakery_shop_ed_cta_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_cta_section',
        array(
            'label' => __( 'Enable cta Us Section', 'bakery-shop' ),
            'section' => 'bakery_shop_cta_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** CTA Section Title */
    $wp_customize->add_setting(
        'bakery_shop_cta_section_page',
        array(
            'default'=> $bakery_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'bakery_shop_cta_section_page',
        array(
              'label' => __('Select Page','bakery-shop'),
              'description' => __( 'Featured Image of Selected Page will be set as Background Image of this section.', 'bakery-shop' ),
              'type' => 'select',
              'choices' => $bakery_shop_options_pages,
              'section' => 'bakery_shop_cta_section_settings', 
              
        )
    );
    

    /** CTA First Button */
    $wp_customize->add_setting(
        'bakery_shop_cta_section_button_one',
        array(
            'default'=> __( 'About Us', 'bakery-shop' ),
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'bakery_shop_cta_section_button_one',
        array(
              'label' => __('CTA Button','bakery-shop'),
              'section' => 'bakery_shop_cta_section_settings', 
              'type' => 'text',
            ));

    /** CTA First Button Link */
    $wp_customize->add_setting(
        'bakery_shop_cta_button_one_url',
        array(
            'default'=> '#',
            'sanitize_callback'=> 'esc_url_raw'
            )
        );
    
    $wp_customize-> add_control(
        'bakery_shop_cta_button_one_url',
        array(
              'label' => __('CTA Button Link','bakery-shop'),
              'section' => 'bakery_shop_cta_section_settings', 
              'type' => 'text',
            ));

    /** Teams Section Settings */
    $wp_customize->add_section(
        'bakery_shop_teams_section_settings',
        array(
            'title' => __( 'Teams Section', 'bakery-shop' ),
            'priority' => 70,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );

    /** Enable Teams Section */   
    $wp_customize->add_setting(
        'bakery_shop_ed_teams_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_teams_section',
        array(
            'label' => __( 'Enable Teams Section', 'bakery-shop' ),
            'section' => 'bakery_shop_teams_section_settings',
            'type' => 'checkbox',
        ));
    
    /** Section Title */
    $wp_customize->add_setting(
        'bakery_shop_teams_section_title',
        array(
            'default'=> $bakery_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'bakery_shop_teams_section_title',
        array(
              'label' => __('Select Page','bakery-shop'),
              'type' => 'select',
              'choices' => $bakery_shop_options_pages,
              'section' => 'bakery_shop_teams_section_settings', 
         
        ));

    /** Select Teams Category */
    $wp_customize->add_setting(
        'bakery_shop_team_category',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'bakery_shop_team_category',
        array(
            'label' => __( 'Select Teams Category', 'bakery-shop' ),
            'section' => 'bakery_shop_teams_section_settings',
            'type' => 'select',
            'choices' => $bakery_shop_option_categories
        ));


    
    /** Testimonials Section Settings */
    $wp_customize->add_section(
        'bakery_shop_testimonials_section_settings',
        array(
            'title' => __( 'Testimonials Section', 'bakery-shop' ),
            'priority' => 80,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );

    /** Enable Testimonials Section */   
    $wp_customize->add_setting(
        'bakery_shop_ed_testimonials_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_testimonials_section',
        array(
            'label' => __( 'Enable Testimonials Section', 'bakery-shop' ),
            'section' => 'bakery_shop_testimonials_section_settings',
            'type' => 'checkbox',
        ));
    
    /** Section Title */
    $wp_customize->add_setting(
        'bakery_shop_testimonials_section_title',
        array(
            'default'=> $bakery_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'bakery_shop_testimonials_section_title',
        array(
              'label' => __('Select Page','bakery-shop'),
              'type' => 'select',
              'choices' => $bakery_shop_options_pages,
              'section' => 'bakery_shop_testimonials_section_settings', 
         
            ));

    /** Select Testimonials Category */
    $wp_customize->add_setting(
        'bakery_shop_testimonial_category',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'bakery_shop_testimonial_category',
        array(
            'label' => __( 'Select Testimonial Category', 'bakery-shop' ),
            'section' => 'bakery_shop_testimonials_section_settings',
            'type' => 'select',
            'choices' => $bakery_shop_option_categories
        ));


      

    /** Blog Section Settings */
    $wp_customize->add_section(
        'bakery_shop_blog_section_settings',
        array(
            'title' => __( 'Blog Section', 'bakery-shop' ),
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'panel' => 'bakery_shop_home_page_settings'
        )
    );
    
   /** Enable Blog Section */
    $wp_customize->add_setting(
        'bakery_shop_ed_blog_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_blog_section',
        array(
            'label' => __( 'Enable Blog Section', 'bakery-shop' ),
            'section' => 'bakery_shop_blog_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Blog Date */
    $wp_customize->add_setting(
        'bakery_shop_ed_blog_date',
        array(
            'default' => '1',
            'sanitize_callback' => 'bakery_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_ed_blog_date',
        array(
            'label' => __( 'Show Posts Date, Author, Comment, Category', 'bakery-shop' ),
            'section' => 'bakery_shop_blog_section_settings',
            'type' => 'checkbox',
        )
    );
     
    /** Blog Section Title */
    $wp_customize->add_setting(
        'bakery_shop_blog_section_title',
        array(
            'default'=> $bakery_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
        ));
    
    $wp_customize-> add_control(
        'bakery_shop_blog_section_title',
        array(
              'label' => __('Select Page','bakery-shop'),
              'type' => 'select',
              'choices' => $bakery_shop_options_pages,
              'section' => 'bakery_shop_blog_section_settings', 
          
        ));

    /** Select Blog Category */
    $wp_customize->add_setting(
        'bakery_shop_blog_section_category',
        array(
            'default' => '',
            'sanitize_callback' => 'bakery_shop_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'bakery_shop_blog_section_category',
        array(
            'label' => __( 'Select Blogs Category', 'bakery-shop' ),
            'section' => 'bakery_shop_blog_section_settings',
            'type' => 'select',
            'choices' => $bakery_shop_option_categories
        ));

    /** Blog Section Read More Text */
    $wp_customize->add_setting(
        'bakery_shop_blog_section_readmore',
        array(
            'default' => __( 'Read More', 'bakery-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_blog_section_readmore',
        array(
            'label' => __( 'Blog Section Read More Text', 'bakery-shop' ),
            'section' => 'bakery_shop_blog_section_settings',
            'type' => 'text',
        )
    );

    /** Blog Section Read More Url */
    $wp_customize->add_setting(
        'bakery_shop_blog_section_url',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'bakery_shop_blog_section_url',
        array(
            'label' => __( 'Blog Page url', 'bakery-shop' ),
            'section' => 'bakery_shop_blog_section_settings',
            'type' => 'text',
        )
    );
    /** Blog Section Ends */
    
}
add_action( 'customize_register', 'bakery_shop_customize_register_home' );
