<?php
/**
 * Person organizations
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 *
 * @var \WP_Query $query Query for the organizations connected to the person.
 */

namespace Pronamic\Orbis\Organizations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="card mb-3">
	<div class="card-header"><?php \esc_html_e( 'Organizations', 'orbis-organizations' ); ?></div>

	<?php if ( $query->have_posts() ) : ?>

		<ul class="list-group list-group-flush">
			<?php while ( $query->have_posts() ) : ?>

				<?php $query->the_post(); ?>

				<li class="list-group-item">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

					<?php

					$note = \p2p_get_meta( \get_post()->p2p_id, 'note', true );

					if ( ! empty( $note ) ) {
						\printf(
							'<br /><span class="text-info" style="font-size: .8em"><i class="fas fa-info-circle"></i> %s</span>',
							\esc_html( $note )
						);
					}

					?>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php else : ?>

		<div class="card-body">
			<p class="text-muted m-0">
				<?php \esc_html_e( 'No organizations connected.', 'orbis-organizations' ); ?>
			</p>
		</div>

	<?php endif; ?>
</div>
