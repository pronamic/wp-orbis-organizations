<?php
/**
 * Archive organizations
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

$get_meta = static function ( string $key ): string {
	$value = \get_post_meta( (int) \get_the_ID(), $key, true );

	return \is_string( $value ) ? $value : '';
};

\get_header();

?>
<div class="card">
	<?php \get_template_part( 'templates/search_form' ); ?>

	<?php if ( \have_posts() ) : ?>

		<div class="table-responsive">
			<table class="table table-striped table-condense table-hover">
				<thead>
					<tr>
						<th><?php \esc_html_e( 'Name', 'orbis-organizations' ); ?></th>
						<th><?php \esc_html_e( 'Address', 'orbis-organizations' ); ?></th>
						<th><?php \esc_html_e( 'Online', 'orbis-organizations' ); ?></th>
						<th><?php \esc_html_e( 'Author', 'orbis-organizations' ); ?></th>
						<th><span class="visually-hidden"><?php \esc_html_e( 'Actions', 'orbis-organizations' ); ?></span></th>
					</tr>
				</thead>
				<tbody>
					<?php

					while ( \have_posts() ) :
						\the_post();

						$address  = $get_meta( '_orbis_address' );
						$postcode = $get_meta( '_orbis_postcode' );
						$city     = $get_meta( '_orbis_city' );

						$website = $get_meta( '_orbis_website' );
						$email   = $get_meta( '_orbis_email' );

						?>

						<tr id="post-<?php \the_ID(); ?>" <?php \post_class(); ?>>
							<td>
								<a href="<?php \the_permalink(); ?>"><?php \the_title(); ?></a>

								<?php \get_template_part( 'templates/table-cell-comments' ); ?>
							</td>
							<td>
								<?php

								echo \esc_html( $address ), '<br />', \esc_html( \trim( $postcode . ' ' . $city ) );

								?>
							</td>
							<td>
								<?php if ( '' !== $website ) : ?>

									<a href="<?php echo \esc_url( $website ); ?>" target="_blank"><?php echo \esc_html( $website ); ?></a>

									<?php if ( '' !== $email ) : ?>

										<br />

									<?php endif; ?>

								<?php endif; ?>

								<?php if ( '' !== $email ) : ?>

									<a href="<?php echo \esc_url( 'mailto:' . $email ); ?>"><?php echo \esc_html( $email ); ?></a>

								<?php endif; ?>
							</td>
							<td>
								<?php \the_author(); ?>
							</td>
							<td>
								<?php \get_template_part( 'templates/table-cell-actions' ); ?>
							</td>
						</tr>

					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

	<?php else : ?>

		<div class="card-body">
			<?php \get_template_part( 'templates/content-none' ); ?>
		</div>

	<?php endif; ?>
</div>

<?php

if ( \function_exists( 'orbis_content_nav' ) ) {
	\orbis_content_nav();
} else {
	\the_posts_pagination();
}

\get_footer();
