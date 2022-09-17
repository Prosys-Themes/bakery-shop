<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Bakery_Shop
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<h1><?php _e( '404!', 'bakery-shop' ); ?></h1>
				<h2><?php _e( 'The requested page cannot be found', 'bakery-shop' ); ?></h2>
				<p><?php _e( 'Sorry but the page you are looking for cannot be found. Take a moment and do a search below or start from our', 'bakery-shop' ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage.', 'bakery-shop' ); ?></a></p>
				<?php
					get_search_form();
				?>
			</section><!-- .error-404 -->
		</main><!-- #main -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
