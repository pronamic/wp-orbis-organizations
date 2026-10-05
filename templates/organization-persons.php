<?php
/**
 * Organization persons
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

namespace Pronamic\Orbis\Organizations;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! \function_exists( 'p2p_connection_exists' ) || ! \p2p_connection_exists( 'orbis_persons_to_organizations' ) ) {
	return;
}

$query = new WP_Query(
	[
		'connected_type'  => 'orbis_persons_to_organizations',
		'connected_items' => \get_queried_object(),
		'nopaging'        => true, // phpcs:ignore WordPressVIPMinimum.Performance.NoPaging.nopaging_nopaging
	]
);

if ( $query->have_posts() ) : ?>

	<ul class="list-group list-group-flush" style="max-height: 600px; overflow: auto;">
		<?php while ( $query->have_posts() ) : ?>

			<?php $query->the_post(); ?>

			<li class="list-group-item">
				<div class="d-flex">
					<div class="flex-shrink-0">
						<a href="<?php the_permalink(); ?>">
							<?php

							if ( \has_post_thumbnail() ) {
								\the_post_thumbnail( 'avatar' );
							} else {
								echo \get_avatar( (string) \get_post_meta( (int) \get_the_ID(), '_orbis_email', true ), 60 );
							}

							?>
						</a>
					</div>

					<div class="flex-grow-1 ms-3">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br />

						<?php

						$note = \p2p_get_meta( \get_post()->p2p_id, 'note', true );

						if ( ! empty( $note ) ) {
							\printf(
								'<span class="text-info" style="font-size: .8em"><i class="fas fa-info-circle"></i> %s</span><br />',
								\esc_html( $note )
							);
						}

						$email = \get_post_meta( (int) \get_the_ID(), '_orbis_email', true );

						if ( ! empty( $email ) ) {
							\printf(
								'<a class="text-secondary" style="font-size: .8em" href="%s">%s</a><br />',
								\esc_url( 'mailto:' . $email ),
								\esc_html( $email )
							);
						}

						$phone_numbers = \array_filter(
							[
								\get_post_meta( (int) \get_the_ID(), '_orbis_phone_number', true ),
								\get_post_meta( (int) \get_the_ID(), '_orbis_mobile_number', true ),
							]
						);

						$phone_number = \reset( $phone_numbers );

						if ( ! empty( $phone_number ) ) {
							\printf(
								'<a class="text-secondary" style="font-size: .8em" href="%s">%s</a><br />',
								\esc_url( 'tel:' . $phone_number ),
								\esc_html( $phone_number )
							);
						}

						?>
					</div>
				</div>
			</li>

		<?php endwhile; ?>
	</ul>

	<?php \wp_reset_postdata(); ?>

<?php else : ?>

	<div class="card-body">
		<p class="text-muted m-0">
			<?php \esc_html_e( 'No persons connected.', 'orbis-organizations' ); ?>
		</p>
	</div>

<?php endif; ?>
