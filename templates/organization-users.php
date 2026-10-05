<?php
/**
 * Organization users
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

namespace Pronamic\Orbis\Organizations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! \function_exists( 'p2p_connection_exists' ) || ! \p2p_connection_exists( 'orbis_users_to_organizations' ) ) {
	return;
}

$users = \get_users(
	[
		'connected_type'  => 'orbis_users_to_organizations',
		'connected_items' => \get_queried_object(),
	]
);

if ( empty( $users ) ) : ?>

	<div class="card-body">
		<p class="text-muted m-0">
			<?php \esc_html_e( 'No users connected.', 'orbis-organizations' ); ?>
		</p>
	</div>

<?php else : ?>

	<ul class="list-group list-group-flush" style="max-height: 600px; overflow: auto;">
		<?php foreach ( $users as $user ) : ?>

			<li class="list-group-item">
				<div class="d-flex">
					<div class="flex-shrink-0">
						<?php echo \get_avatar( $user, 60 ); ?>
					</div>

					<div class="flex-grow-1 ms-3">
						<?php echo \esc_html( $user->display_name ); ?><br />

						<?php

						\printf(
							'<a class="text-secondary" style="font-size: .8em" href="%s">%s</a><br />',
							\esc_url( 'mailto:' . $user->user_email ),
							\esc_html( $user->user_email )
						);

						?>
					</div>
				</div>
			</li>

		<?php endforeach; ?>
	</ul>

<?php endif; ?>
