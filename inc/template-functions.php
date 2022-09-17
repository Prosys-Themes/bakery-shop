<?php
/**
 * Custom template function for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bakery_shop
 */

if( ! function_exists( 'bakery_shop_doctype_cb' ) ) :
/**
 * Doctype Declaration
 * 
 * @since 1.0.1
*/
function bakery_shop_doctype_cb(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;


if( ! function_exists( 'bakery_shop_head' ) ) :
/**
 * Before wp_head
 * 
 * @since 1.0.1
*/
function bakery_shop_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
}
endif;

if( ! function_exists( 'bakery_shop_header_start' ) ) :
/**
 * Header Start
 * 
 * @since 1.0.1
*/
function bakery_shop_header_start(){
    ?>
    <header id="masthead" class="site-header" role="banner">
    <?php 
}
endif;


if( ! function_exists( 'bakery_shop_header_top' ) ) :
/**
 * Header Site Branding
 * 
 * @since 1.0.1
*/
function bakery_shop_header_top(){
    ?>
    <div class="header-top">
        <div class="container">
            <div class="site-branding">
                <?php 
                    if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                              the_custom_logo();
                          } 
                ?>
                <div class="text-logo">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                  <?php
                        $description = get_bloginfo( 'description', 'display' );
                        if ( esc_html( $description ) || is_customize_preview() ) { ?>
                          <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
                  <?php } ?>
                </div>  
            </div><!-- .site-branding -->
        </div>
    </div>
    <?php 
}
endif;
if( ! function_exists( 'bakery_shop_header_bottom' ) ) :
/**
 * Header Site Branding
 * 
 * @since 1.0.1
*/
function bakery_shop_header_bottom(){

    $ed_curtain = get_theme_mod( 'bakery_shop_ed_curtain' );
    ?>
    <div class="header-bottom">    
        <div class="container">
            <div id="mobile-header">
                <a id="responsive-menu-button" href="#sidr-main"><i class="fa fa-bars"></i></a>
            </div>
            <nav id="site-navigation" class="main-navigation">
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
            </nav><!-- #site-navigation -->
        </div>
        <?php if( $ed_curtain ){
            echo '<div class="curtain"><div class="curtain-holder"></div></div>';
        } ?>
    </div>
    <?php 
}
endif;

if( ! function_exists( 'bakery_shop_header_end' ) ) :
/**
 * Header End
 * 
 * @since 1.0.1
*/
function bakery_shop_header_end(){
    ?>
    </header><!-- #masthead -->
    <?php 
}
endif;


/* Home page */

if( ! function_exists( 'bakery_shop_template_header' ) ) :
/**
 * Template Section Header
 * 
 * @since 1.0.1
*/
function bakery_shop_template_header( $section_title ){
    $header_query = new WP_Query( array( 
        'p'         => absint( $section_title ),
        'post_type' => 'page'
    ));

        if( absint( $section_title ) && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post();
    ?>
                <header class="main-header">
                    <?php 
                        echo '<h1 class="section-title">';
                         the_title();
                         echo '</h1>';
                        echo the_excerpt(); 
                    ?>
                </header>
    <?php   }
        wp_reset_postdata();
        }   

}
endif;

if( ! function_exists( 'bakery_shop_slider_cb' ) ) :
/**
 * Home Page Slider Section
 * 
 * @since 1.0.1
*/
function bakery_shop_slider_cb(){
    global $bakery_shop_default_post;
    
    $slider_enable      = get_theme_mod( 'bakery_shop_ed_slider','1' );
    $slider_caption     = get_theme_mod( 'bakery_shop_slider_caption', '1' );
    $slider_readmore    = get_theme_mod( 'bakery_shop_slider_readmore', __( 'Learn More', 'bakery-shop' ) );
   
    if( $slider_enable && is_front_page() && !is_home() ){
        echo '<section id="banner" class="banner">';
            echo '<div class="fadeout owl-carousel owl-theme clearfix">';
            for( $i=1; $i<=3; $i++){  
                $bakery_shop_slider_post_id = get_theme_mod( 'bakery_shop_slider_post_'.$i, $bakery_shop_default_post ); 
                if( $bakery_shop_slider_post_id ){
                    $qry = new WP_Query ( array( 'p' => absint( $bakery_shop_slider_post_id ) ) );            
                    if( $qry->have_posts() ){ 
                        while( $qry->have_posts() ){
                        $qry->the_post();
                            ?>
                            <div class="item">
                                <?php 
                                if( has_post_thumbnail() ){ 
                                    the_post_thumbnail( 'bakery-shop-slider' );
                                }else{
                                    echo '<img src="'. esc_url( get_template_directory_uri() ).'/images/banner.png">';
                                } 
                                        if( $slider_caption ){ ?>
                                        <div class="container">
                                            <div class="banner-text">
                                                <div class="banner-text-item">
                                                    <strong class="title"><h1><?php the_title(); ?></h1></strong>
                                                    <?php the_excerpt(); ?>
                                                    <div class="button-holder">
                                                        <?php if( $slider_readmore ){ ?> 
                                                            <a class="btn blank" href="<?php the_permalink(); ?>">
                                                            <?php echo esc_html( $slider_readmore );?></a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                        <?php 
                        }
                    }
                }
            }
            wp_reset_postdata();  
            echo '</div>';
        echo '</section>';
    }    
}
endif;

if( ! function_exists( 'bakery_shop_featured' ) ) :
/**
 * Home Page featured Section
 * 
 * @since 1.0.1
*/
function bakery_shop_featured(){
global $bakery_shop_default_post;
    
    $featured_enable     = get_theme_mod( 'bakery_shop_ed_featured_section', '1' );
    $featured_post_icon   = get_theme_mod( 'bakery_shop_ed_featured_icon' );

             
    if( $featured_enable ){
        echo '<section id="featured" class="featured-section">';
            echo '<div class="container">';
                echo '<div class="row">';
                for( $i = 1; $i <= 3; $i++ ){
                    $bakery_shop_featured_post_id = get_theme_mod( 'bakery_shop_feature_post_'.$i, $bakery_shop_default_post ); 
                    $bakery_shop_featured_page_icon = get_theme_mod( 'bakery_shop_feature_icon_'.$i, 'fa-bell');

                    if( $bakery_shop_featured_post_id ){
                    $qry = new WP_Query ( array( 'p' => absint( $bakery_shop_featured_post_id ) ) );
                        if( $qry->have_posts() ){
                            while( $qry->have_posts() ){
                                $qry->the_post();
                            ?>
                                <div class="col-4">
                                    <div class="featured-item">
                                        <?php
                                            if( has_post_thumbnail() &&  ! $featured_post_icon ){ 
                                                echo '<a href="' . esc_url( get_the_permalink() ) .'">';
                                                    the_post_thumbnail( 'bakery-shop-recent-post' ); 
                                                echo '</a>';
                                            }else{
                                            echo '<a href="' . esc_url( get_the_permalink() ) .'">';
                                                echo '<i class="fa ' . esc_attr( $bakery_shop_featured_page_icon ) .'"></i>';
                                            echo '</a>';
                                        } 
                                        ?>
                                        <div class="featured-text">
                                            <a href="<?php the_permalink(); ?>"><?php the_title('<h3>','</h3>'); ?></a>
                                            <?php echo esc_html(wp_trim_words(get_the_content(),11,'&hellip;')); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                        wp_reset_postdata();  
                    }
                } 
                echo '</div>'; 
            echo '</div>'; 
        echo '</section>';  
    }   

}

endif;


if( ! function_exists( 'bakery_shop_welcome' ) ) :
/**
 * Home Page welcome Section
 * 
 * @since 1.0.1
*/
function bakery_shop_welcome(){
    global $bakery_shop_default_page;
    
    $welcome_enable     = get_theme_mod( 'bakery_shop_ed_welcome_section','1' );
    if( $welcome_enable ){
        echo '<section id="about" class="about-section">';
            echo '<div class="container">';
                if( have_posts() ){
                    while( have_posts() ){
                        the_post();
                    ?>
                    
                    <div class="about-item">
                        <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'bakery-shop-welcome' ); } ?>
                        <div class="about-text">
                            <?php
                                the_title('<h1 class="section-title">', '</h1>');
                                the_content(); 
                            ?>
                        </div>
                    </div>
                    <?php
                    }
                }
                wp_reset_postdata();  
            echo '</div>'; 
        echo '</section>';     
    }    
    
}

endif;

if( ! function_exists( 'bakery_shop_products' ) ) :
/**
 * Home Page welcome Section
 * 
 * @since 1.0.1
*/
function bakery_shop_products(){
global $bakery_shop_default_page;

$products_enable     = get_theme_mod( 'bakery_shop_ed_product_section' );

$featured_product_page  = get_theme_mod('bakery_shop_featured_product_page', $bakery_shop_default_page);  

if( $products_enable ){

echo '<div id="featured-products-section" class="featured-products-section">';
    echo '<div class="container">';
        if($featured_product_page ){
            
            $page_qry = new WP_Query(array(
                'post_type' => 'page',
                'p' => $featured_product_page,
                  ));

                if($page_qry->have_posts()){
                    while($page_qry->have_posts()){ $page_qry->the_post(); 
                        echo '<header class="main-header">';
                          echo '<h1 class="section-title">';
                            the_title();
                          echo '</h1>';
                            the_excerpt();
                        echo '</header>';
                    }
                }
            wp_reset_postdata();
            }

            /** Woocommerce Product*/
            if( bakery_shop_is_woocommerce_activated() ){
                global $product;
                global $bakery_shop_options_products;
                
                echo '<div class="featured-slider owl-carousel owl-theme clearfix">';
                
                for( $i = 1; $i <= 10; $i++ ){
                    $bakery_shop_product_post_id = get_theme_mod( 'bakery_shop_product_post_'.$i, $bakery_shop_options_products ); 

                        if( $bakery_shop_product_post_id ) {                           
                           
                            $qry = new WP_Query( array( 'post_type' => 'product', 'p' => $bakery_shop_product_post_id ) );


                                if( $qry->have_posts() ){ 
                                 $price = get_post_meta( $bakery_shop_product_post_id, '_regular_price', true);
                                   
                                    while( $qry->have_posts() ){
                                        $qry->the_post();
                                    ?>  <div class="item">
                                            <div class="product-holder">
                                                
                                                <a href="<?php the_permalink(); ?>">
                                                     <?php the_post_thumbnail('medium'); ?>
                                                </a>

                                                <div class="products-text">
                                                    <a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>

                                                    <div class="price">
                                                        <div class="arrow-holder">
                                                            <div class="arrow"></div>
                                                        </div>
                                                        
                                                        <div class="price-tag">

                                                        <?php $string = wc_price( $price, array() );
                                                              echo wp_kses_post( $string ); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                    
                                        </div>
                                        
                                    <?php
                                    }
                                }
                            
                            wp_reset_postdata();  
                        }
                    }
                echo '</div>';
            }
            echo '</div>';
        echo '</div>';
    }
} 
endif;

if( ! function_exists( 'bakery_shop_blog' ) ) :
/**
 * Home Page Latest Post Section
 * 
 * @since 1.0.1
*/
function bakery_shop_blog(){
    global $bakery_shop_default_page;
    
    $blog_enable    = get_theme_mod( 'bakery_shop_ed_blog_section','1' );
    $blog_meta      = get_theme_mod( 'bakery_shop_ed_blog_date','1' );
    $blog_title     = get_theme_mod( 'bakery_shop_blog_section_title', $bakery_shop_default_page ); 
    $blog_category  = get_theme_mod( 'bakery_shop_blog_section_category' ); 
   
    if( $blog_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'posts_per_page'     => 3,        
            'ignore_sticky_post' => true  
        );

        if( $blog_category ){
            $args[ 'cat' ] = absint( $blog_category );
        }
        
        $qry = new WP_Query( $args );

        echo '<section id="latest-activity"  class="latest-activity-section">';
            echo '<div class="container">';

            if( $blog_title ) {  bakery_shop_template_header( $blog_title ); }
           
                echo '<div class="row latest-activities">';

                    if( $qry->have_posts() ){ ?>
                        <?php
                        while( $qry->have_posts() ){
                            $qry->the_post();
                        ?>
                            <div class="col-4"> 
                                <div class="activity-items">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'bakery-shop-three-col' ); 
                                        }else{
                                            echo '<img src="'. esc_url( get_template_directory_uri() ).'/images/default-thumb-3col.png">';
                                        } ?>
                                    </a>
                                    <div class="activity-text">
                                        <header class="entry-header">
                                            <?php if( isset( $blog_meta ) ){ ?>
                                            <div class="entry-meta">
                                                <?php 
                                                    bakery_shop_posted_on();
                                                ?>
                                            </div>
                                            <?php } ?>
                                            <a href="<?php the_permalink(); ?>"><?php the_title('<h3 class="entry-title">','</h3>'); ?></a>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    wp_reset_postdata();  
                echo '</div>';
            echo '</div>'; 
        echo '</section>';     
    }    
 
}
endif;

if( ! function_exists( 'bakery_shop_cta' ) ) :
/**
 * Home Page cta Section
 * 
 * @since 1.0.1
*/
function bakery_shop_cta(){
    global $bakery_shop_default_page;
    $cta_enable  = get_theme_mod( 'bakery_shop_ed_cta_section', '1' );
    $cta_page    = get_theme_mod( 'bakery_shop_cta_section_page', $bakery_shop_default_page ); 
    $cta_one     = get_theme_mod( 'bakery_shop_cta_section_button_one', __( 'About Us', 'bakery-shop' ) ); 
    $cta_one_url = get_theme_mod( 'bakery_shop_cta_button_one_url', '#' ); 
    $cta_two     = get_theme_mod( 'bakery_shop_cta_section_button_two', __( 'Contact Us', 'bakery-shop' )); 
    $cta_two_url = get_theme_mod( 'bakery_shop_cta_button_two_url', '#' ); 

    if( $cta_page && $cta_enable ){
        $qry = new WP_Query ( array( 
            'post_type'     => 'page', 
            'p'             => absint( $cta_page ) 
        ) );

            if( $qry->have_posts() ){
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
               <section id="cta" class="cta-section" <?php if( has_post_thumbnail() ) echo 'style="background: url(' . esc_url( get_the_post_thumbnail_url() ) . ')no-repeat; background-size: cover; background-position: center; background-attachment: fixed;"';?> >
                    <div class="container">
                        <div class="row">
                            <?php
                                the_title('<h1 class="section-title">', '</h1>');
                                echo '<div class="cta-content">';
                                the_content(); 
                                echo '</div>';
                            ?>
                            <div class="cta-btn">
                                <?php 
                                    if( $cta_one && $cta_one_url ) { 
                                        echo '<a class="btn pink" href="' . esc_url( $cta_one_url ) . '">';
                                            echo esc_html( $cta_one ); 
                                        echo '</a>';
                                    } 
                                ?>
                            </div>
                        </div>
                    </div> 
                </section>          
                <?php
                }
            }
        wp_reset_postdata();  
    }    
}

endif;


if( ! function_exists( 'bakery_shop_team' ) ) :
/**
 * Home Page Teams Section
 * 
 * @since 1.0.1
*/
function bakery_shop_team(){
    global $bakery_shop_default_page;

    $team_enable    = get_theme_mod( 'bakery_shop_ed_teams_section', '1' );
    $team_title     = get_theme_mod( 'bakery_shop_teams_section_title', $bakery_shop_default_page); 
    $team_category  = get_theme_mod( 'bakery_shop_team_category' ); 
   
    if( $team_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'cat'                => absint( $team_category ),
            'posts_per_page'     => 4,       
            'orderby'            => 'post_in', 
            'ignore_sticky_post' => true  
        );

        if( $team_category ){
            $args[ 'cat' ] = absint( $team_category );
        }
        $qry = new WP_Query( $args );

        echo '<section id="teams" class="team-section">';
            echo '<div class="container">';

            if( $team_title ) {  bakery_shop_template_header( $team_title ); }
           
                echo '<div class="row latest-activities">';

                    if( $qry->have_posts() ){ ?>
                        <?php
                        while( $qry->have_posts() ){
                            $qry->the_post();
                        ?>
                        <div class="col-3">
                            <div class="team-item">
                                <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'bakery-shop-teams' ); }
                                    else{
                                        echo '<img src="' . esc_url( get_template_directory_uri() ).'/images/team-one.png">';
                                    } ?>
                                <div class="team-mask">
                                    <a href="<?php the_permalink(); ?>"><?php the_title( '<h3>', '</h3>'); ?></a>
                                    <span class="team-designation"><?php if( has_excerpt() ){ the_excerpt(); } ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    }
                    wp_reset_postdata();  
                echo '</div>'; 
            echo '</div>'; 
        echo '</section>';     
    }    
 
}
endif;


if( ! function_exists( 'bakery_shop_testimonial' ) ) :
/**
 * Home Page testimonials Section
 * 
 * @since 1.0.1
*/
function bakery_shop_testimonial(){
    global $bakery_shop_default_page;
    
    $testimonial_enable    = get_theme_mod( 'bakery_shop_ed_testimonials_section', '1' );
    $testimonial_title     = get_theme_mod( 'bakery_shop_testimonials_section_title', $bakery_shop_default_page );  
    $testimonial_category  = get_theme_mod( 'bakery_shop_testimonial_category' ); 
   
    if( $testimonial_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'posts_per_page'     => 6,        
            'ignore_sticky_post' => true  
        );

        if( $testimonial_category ){
            $args[ 'cat' ] = absint( $testimonial_category );
        }
        $qry = new WP_Query( $args );

        echo '<section id="testimonial" class="testimonial-section">';
            echo '<div class="container">';

            if( $testimonial_title ) {  bakery_shop_template_header( $testimonial_title ); }
           
                echo '<div class="row">';
                    echo '<div class="testimonial-slider owl-carousel owl-theme clearfix">';
                    if( $qry->have_posts() ){ 
                        while( $qry->have_posts() ){
                            $qry->the_post(); 
                        ?>
                        
                        <div class="item">
                                <div class="testimonial-text">
                                    <blockquote>
                                       <?php the_content(); ?>
                                    </blockquote>
                                </div>
                                <div class="testimonial-thumbnail">
                                    <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'thumbnail' ); }
                                    else{
                                        echo '<img src="' . esc_url( get_template_directory_uri() ).'/images/team-profile-non.jpg">';
                                    } ?>
                                    <div class="testimonial-info">
                                        <h3><?php the_title(); ?></h3>
                                        <span class="testimonial-designation"><?php if( has_excerpt() ){ the_excerpt(); } ?></span>
                                    </div>
                                </div>
                        </div>

                        <?php
                        }
                    }
                    wp_reset_postdata();  
                    echo '</div>'; 
                echo '</div>'; 
            echo '</div>'; 
        echo '</section>';     
    }    
 
}
endif;

if( ! function_exists( 'bakery_shop_content_start' ) ) :
/**
 * Content Start
 * 
 * @since 1.0.1
*/
function bakery_shop_content_start(){ 
    $ed_slider = get_theme_mod( 'bakery_shop_ed_slider','1' );
    $class = is_404() ? 'error-holder' : 'row' ;
    
    if( !( $ed_slider && is_front_page() && !is_home()) ){
    ?>
    <div id="content" class="site-content">
        <div class="container">
             <div class="<?php echo esc_attr( $class ); ?>">
    <?php
    }
}
endif;

if( ! function_exists( 'bakery_shop_page_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.1
*/
function bakery_shop_page_content_image(){
    $sidebar_layout = bakery_shop_sidebar_layout();
    if( has_post_thumbnail() ){
        echo '<div class="post-thumbnail">';
            if( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) {
                the_post_thumbnail( 'bakery-shop-without-sidebar' );    
            }
        echo '</div>';
    }
}
endif;


if( ! function_exists( 'bakery_shop_post_content_image' ) ) :
/**
 * Post Featured Image
 * 
 * @since 1.0.1
*/
function bakery_shop_post_content_image(){
    if( has_post_thumbnail() ){
    echo ( !is_single() ) ? '<a href="' . esc_url( get_the_permalink() ) . '" class="post-thumbnail">' : '<div class="post-thumbnail">'; 
         ( is_active_sidebar( 'right-sidebar' ) ) ? the_post_thumbnail( 'bakery-shop-with-sidebar' ) : the_post_thumbnail( 'bakery-shop-without-sidebar' ) ; 
    echo ( !is_single() ) ? '</a>' : '</div>' ;    
    }
}
endif;

if( ! function_exists( 'bakery_shop_post_entry_header' ) ) :
/**
 * Post Entry Header
 * 
 * @since 1.0.1
*/
function bakery_shop_post_entry_header(){
    ?>
    
    <header class="entry-header">
        <?php
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } else {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }

        if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php  
                bakery_shop_posted_on(); 
                bakery_shop_categories();
                bakery_shop_comments();
            ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
    </header>

    <?php
}
endif;

if( ! function_exists( 'bakery_shop_archive_entry_header_before' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function bakery_shop_archive_entry_header_before(){
    echo '<div class = "text-holder" >';
}    
endif;   
    
if( ! function_exists( 'bakery_shop_archive_entry_header' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function bakery_shop_archive_entry_header(){
    ?>
    <header class="entry-header">
        <div class="entry-meta">
            <?php bakery_shop_posted_on_date(); ?>
        </div><!-- .entry-meta -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
    </header>   
    <?php
}
endif;

if( ! function_exists( 'bakery_shop_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.1
*/
function bakery_shop_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author-section">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php the_author_meta( 'display_name', $post->post_author ); ?></strong>
                <?php the_author_meta( 'description' ); ?>
            </div>
    </section>
    <?php  
    }  
}
endif;

if( ! function_exists( 'bakery_shop_get_comment_section' ) ) :
/**
 * Comment template
 * 
 * @since 1.0.1
*/
function bakery_shop_get_comment_section(){
    // If comments are open or we have at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif;
}
endif;

if( ! function_exists( 'bakery_shop_content_end' ) ) :
/**
 * Content End
 * 
 * @since 1.0.1
*/
function bakery_shop_content_end(){

    $ed_slider = get_theme_mod( 'bakery_shop_ed_slider','1' );
    
    if( !( $ed_slider && is_front_page() && ! is_home() ) ){
        echo '</div></div></div>';// .row /#content /.container
    }
}
endif;

if( ! function_exists( 'bakery_shop_footer_start' ) ) :
/**
 * Footer Start
 * 
 * @since 1.0.1
*/
function bakery_shop_footer_start(){
    echo '<footer id="colophon" class="site-footer" role="contentinfo">';

}
endif;


if( ! function_exists( 'bakery_shop_footer_widgets' ) ) :
/**
 * Footer Widgets
 * 
 * @since 1.0.1 
*/
function bakery_shop_footer_widgets(){
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){?>
        <div class="widget-area">
            <div class="container">
                <div class="row">
                    
                    <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-one' ); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-two' ); ?>
                    </div>
                    <?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-three' ); ?>
                    </div>
                    <?php } ?>
                    
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .widget-area -->
<?php } 
}
endif;

if( ! function_exists( 'bakery_shop_footer_credit' ) ) :
/**
 * Footer Credits 
 */
function bakery_shop_footer_credit(){
    echo '<div class="footer-b">';
        echo '<div class="container">'; 
            echo '<div class="site-info">';
                echo esc_html( '&copy;&nbsp;'. date_i18n( 'Y' ), 'bakery-shop' );
                echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';

                printf( '&nbsp;%s', '<a href="'. esc_url( __( 'http://prosysthemes.com/wordpress-themes/bakery-shop/', 'bakery-shop' ) ) .'" target="_blank">'. esc_html__( 'Bakery Shop By Prosys Theme. ', 'bakery-shop' ) .'</a>' );
                printf( esc_html__( 'Powered by %s', 'bakery-shop' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'bakery-shop' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'bakery-shop' ) . '</a>' );
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
endif;

if( ! function_exists( 'bakery_shop_footer_end' ) ) :
/**
 * Footer End
 * 
 * @since 1.0.1 
*/
function bakery_shop_footer_end(){
    echo '</footer>'; // #colophon 
}
endif;

if( ! function_exists( 'bakery_shop_page_end' ) ) :
/**
 * Page End
 * 
 * @since 1.0.1
*/
function bakery_shop_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;
