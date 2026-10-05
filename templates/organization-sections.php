<?php
/**
 * Organization sections
 *
 * Other Orbis plugins can add tabs to the organization page with the
 * `orbis_organization_sections` filter.
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

$sections = \apply_filters( 'orbis_organization_sections', [] );

if ( empty( $sections ) || ! \is_array( $sections ) ) {
	return;
}

?>
<div class="card mb-3 with-cols clearfix">
	<div class="card-header">
		<ul class="nav nav-tabs card-header-tabs" id="organization-tabs" role="tablist">
			<?php foreach ( \array_values( $sections ) as $index => $section ) : ?>

				<li class="nav-item" role="presentation">
					<?php

					\printf(
						'<button class="%s" id="%s" data-bs-toggle="tab" data-bs-target="%s" type="button" role="tab" aria-controls="%s" aria-selected="%s">%s</button>',
						\esc_attr( 0 === $index ? 'nav-link active' : 'nav-link' ),
						\esc_attr( $section['id'] . '-tab' ),
						\esc_attr( '#' . $section['id'] ),
						\esc_attr( $section['id'] ),
						\esc_attr( 0 === $index ? 'true' : 'false' ),
						\esc_html( $section['name'] )
					);

					?>
				</li>

			<?php endforeach; ?>
		</ul>
	</div>

	<div class="tab-content">
		<?php foreach ( \array_values( $sections ) as $index => $section ) : ?>

			<div id="<?php echo \esc_attr( $section['id'] ); ?>" class="<?php echo \esc_attr( 0 === $index ? 'tab-pane fade show active' : 'tab-pane fade' ); ?>" role="tabpanel" aria-labelledby="<?php echo \esc_attr( $section['id'] . '-tab' ); ?>">
				<?php

				if ( isset( $section['action'] ) ) {
					\do_action( $section['action'] );
				}

				if ( isset( $section['callback'] ) ) {
					\call_user_func( $section['callback'] );
				}

				if ( isset( $section['template_part'] ) ) {
					\get_template_part( $section['template_part'] );
				}

				?>
			</div>

		<?php endforeach; ?>
	</div>
</div>
