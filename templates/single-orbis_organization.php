<?php
/**
 * Single organization
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

\get_header();

while ( \have_posts() ) :
	\the_post();

	?>
	<div id="post-<?php the_ID(); ?>" <?php \post_class(); ?>>
		<div class="row row-cols-1 row-cols-md-3 mb-3">
			<div class="col">
				<div class="card">
					<div class="card-header"><?php \esc_html_e( 'Details', 'orbis-organizations' ); ?></div>

					<div class="card-body">
						<?php include __DIR__ . '/organization-details.php'; ?>
					</div>
				</div>
			</div>

			<div class="col">
				<div class="card">
					<div class="card-header"><?php \esc_html_e( 'Persons', 'orbis-organizations' ); ?></div>

					<?php include __DIR__ . '/organization-persons.php'; ?>
				</div>
			</div>

			<div class="col">
				<div class="card">
					<div class="card-header"><?php \esc_html_e( 'Users', 'orbis-organizations' ); ?></div>

					<?php include __DIR__ . '/organization-users.php'; ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<?php \do_action( 'orbis_before_main_content' ); ?>

				<?php if ( ! empty( \get_the_content() ) ) : ?>

					<div class="card mb-3">
						<div class="card-header"><?php \esc_html_e( 'Description', 'orbis-organizations' ); ?></div>

						<div class="card-body">
							<?php \the_content(); ?>
						</div>
					</div>

				<?php endif; ?>

				<?php include __DIR__ . '/organization-sections.php'; ?>

				<?php \do_action( 'orbis_after_main_content' ); ?>

				<?php \comments_template( '', true ); ?>
			</div>

			<div class="col-md-4">
				<?php \do_action( 'orbis_before_side_content' ); ?>

				<div class="card">
					<div class="card-header"><?php \esc_html_e( 'Additional Information', 'orbis-organizations' ); ?></div>

					<div class="card-body">
						<dl>
							<dt><?php \esc_html_e( 'Posted on', 'orbis-organizations' ); ?></dt>
							<dd><?php echo \esc_html( (string) \get_the_date() ); ?></dd>

							<dt><?php \esc_html_e( 'Posted by', 'orbis-organizations' ); ?></dt>
							<dd><?php echo \esc_html( \get_the_author() ); ?></dd>

							<?php if ( null !== \get_edit_post_link() ) : ?>

								<dt><?php \esc_html_e( 'Actions', 'orbis-organizations' ); ?></dt>
								<dd><?php \edit_post_link( \__( 'Edit', 'orbis-organizations' ) ); ?></dd>

							<?php endif; ?>
						</dl>
					</div>
				</div>

				<?php \do_action( 'orbis_after_side_content' ); ?>
			</div>
		</div>
	</div>
	<?php

endwhile;

\get_footer();
