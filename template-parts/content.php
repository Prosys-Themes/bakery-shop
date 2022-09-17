<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bakery_Shop
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		/**
		 * Before Post entry content
		 * 
		 * @see bakery_shop_post_content_image - 10
		 * @see bakery_shop_post_entry_header  - 20
		*/
		do_action( 'bakery_shop_before_post_entry_content' ); 
	?>

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php bakery_shop_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->