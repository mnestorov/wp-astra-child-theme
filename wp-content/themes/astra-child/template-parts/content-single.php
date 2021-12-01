<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

global $post;

$location = get_field( 'location' );
$friends  = get_field( 'friends' );

?>

<?php astra_entry_before(); ?>

<article itemtype="https://schema.org/CreativeWork" itemscope="itemscope" id="post-<?php the_ID(); ?>" <?php esc_attr( post_class() ); ?>>

	<?php astra_entry_top(); ?>

	<?php astra_entry_content_single(); ?>

	<?php if ( get_field( 'location' ) ) : ?>

		<h4 class="meta">
			<span>Location:</span> <?php echo esc_html( $location ); ?>
		</h4>

	<?php endif; ?><!--/ end location field from ACF -->

	<?php if ( get_field( 'profile_description' ) ) : ?>

		<?php the_field( 'profile_description' ); ?>

	<?php endif; ?><!--/ end profile_description field from ACF -->

	<?php // `have_rows` is a function provided by acf. ?>
	<?php if ( have_rows( 'resume' ) ) : ?>

		<section class="resume">

			<?php $resume_format = '<div class="resume-section"><h4><span class="date">%1$s</span><span class="title">%2$s</span></h4><div class="simple-description">%3$s</div>%4$s</div>'; ?>

			<?php while ( have_rows( 'resume' ) ) : ?>
				<?php
				// `the_row` is similar function with the_post() function by wp.
				the_row();

				/**
				 * Set and format variables.
				 */
				$position_name      = get_sub_field( 'title' );
				$simple_description = get_sub_field( 'simple_description' );
				$full_description   = get_sub_field( 'full_description' );
				$start_date         = get_sub_field( 'start_date' );
				$end_date           = get_sub_field( 'end_date' );
				$dates              = ( $end_date ) ? $start_date . ' - ' . $end_date : $start_date;

				printf( $resume_format, $dates, esc_html( $position_name ), esc_html( $simple_description ), $full_description );
				?>

			<?php endwhile; ?>

		</section>

	<?php endif; ?>

	<?php if ( $friends ) : ?>
		<h4 class="meta">
			<span>Friends:</span> <?php echo count( $friends ); ?>
		</h4>

		<ul class="profile-friends">
			<?php foreach ( $friends as $post ) : ?>

				<?php
				/**
				 * Set up global post data for using loop functions on our post objects.
				 */
				setup_postdata( $post );
				?>

				<li class="friends-frame">
					<a href="<?php echo esc_attr( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
						<?php echo get_the_post_thumbnail( get_the_ID(), 'medium' ); ?>
					</a>
					<?php echo esc_attr( get_the_title() ); ?>
				</li>

			<?php endforeach; ?>

			<?php wp_reset_postdata(); ?>
		</ul>
	<?php endif; ?>

	<?php astra_entry_bottom(); ?>

</article><!-- #post-## -->

<?php astra_entry_after(); ?>
