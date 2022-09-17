<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Bakery_Shop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'bakery-shop' ); ?></a>

	<?php
		/**
		 * @hooked bakery_shop_header_start  - 20 
		 * @hooked bakery_shop_header_bottom - 40 
		 * @hooked bakery_shop_header_menu 	 - 50 
		 * @hooked bakery_shop_header_end 	 - 60 
		 * @hooked bakery_shop_slider_cb
		 */

		do_action( 'bakery_shop_header' );
		do_action( 'bakery_shop_slider' ); 

		/**
		 * bakery_shop Content
		 * 
		 * @see bakery_shop_content_start
		*/
		do_action( 'bakery_shop_before_content' );