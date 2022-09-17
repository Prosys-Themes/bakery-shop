<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Bakery_Shop
 * @since 1.0.1
 * @version 1.0.3
 */

$slider_enable       = get_theme_mod( 'bakery_shop_ed_slider','1' );
$featured_enable     = get_theme_mod( 'bakery_shop_ed_featured_section', '1' );
$welcome_enable      = get_theme_mod( 'bakery_shop_ed_welcome_section','1' );
$blog_enable         = get_theme_mod( 'bakery_shop_ed_blog_section','1' );
$products_enable     = get_theme_mod( 'bakery_shop_ed_product_section', '1' );
$cta_enable          = get_theme_mod( 'bakery_shop_ed_cta_section', '1' );
$teams_enable        = get_theme_mod( 'bakery_shop_ed_teams_section', '1' );
$testimonials_enable = get_theme_mod( 'bakery_shop_ed_testimonials_section', '1' );

get_header(); 
           
    if ( 'posts' == get_option( 'show_on_front' ) ) {
        include( get_home_template() );
    }elseif( $slider_enable || $featured_enable || $welcome_enable || $products_enable || $blog_enable || $cta_enable || $teams_enable || $testimonials_enable ){ ?>
        
        <?php
        /**
         * Home Page Contents
         * 
         * @hooked bakery_shop_featured    - 20
         * @hooked bakery_shop_welcome     - 30
         * @hooked bakery_shop_products    - 40 
         * @hooked bakery_shop_cta         - 60
         * @hooked bakery_shop_team        - 80
         * @hooked bakery_shop_testimonial - 90
         * @hooked bakery_shop_blog        - 95 
        */
        do_action( 'bakery_shop_home_page' );
        ?>
   
    <?php        
    }else {
        include( get_page_template() );
    }


get_footer();