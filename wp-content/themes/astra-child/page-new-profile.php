<?php 
/**
 * Template Name: New Profile
 */

acf_form_head(); // Include everything we need from ACF to submit form on a front end.
get_header();

?>

<?php if ( astra_page_layout() === 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="entry-content clear" itemprop="text">

				<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

				<?php the_content(); ?>

				<?php
				/**
				 * Creating an ACF form
				 *
				 * @see https://www.advancedcustomfields.com/resources/acf_form/
				 */
				acf_form(
					array(
						'post_id'         => 'new_post',
						// From here starts information about new post.
						'post_title'      => true,  // Display post title.
						'post_content'    => true, // Display post content.
						'submit_value'    => __( 'Submit Profile' ),
						'updated_message' => __( 'Profile added!' ),
						'new_post'        =>
						/**
						 * This array contains information about new post.
						 *
						 * @see https://developer.wordpress.org/reference/functions/wp_insert_post/
						 */
						array(
							'post_type'     => 'post',
							'post_status'   => 'draft',
							'post_category' => array( 2 ), // Profile category ID.
						),
					)
				);
				?>

			</div><!-- .entry-content .clear -->

		</article>

	</div><!-- #primary -->

<?php if ( astra_page_layout() === 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
