<?php
/**
 * Template controller
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

declare(strict_types=1);

namespace Pronamic\Orbis\Organizations;

use WP_Query;

/**
 * Template controller class
 */
final class TemplateController {
	/**
	 * Construct.
	 */
	public function __construct() {
		\add_filter( 'template_include', $this->template_include( ... ) );
		\add_action( 'orbis_after_side_content', $this->maybe_include_person_organizations( ... ) );
	}

	/**
	 * Template include.
	 *
	 * Uses the single and archive organization templates of this plugin, unless the theme has one.
	 *
	 * @param string $template Template.
	 * @return string
	 */
	private function template_include( $template ) {
		if ( \is_singular( 'orbis_organization' ) && '' === \locate_template( 'single-orbis_organization.php' ) ) {
			return __DIR__ . '/../templates/single-orbis_organization.php';
		}

		if ( \is_post_type_archive( 'orbis_organization' ) && '' === \locate_template( 'archive-orbis_organization.php' ) ) {
			return __DIR__ . '/../templates/archive-orbis_organization.php';
		}

		return $template;
	}

	/**
	 * Maybe include the organizations connected to a person.
	 *
	 * @return void
	 */
	private function maybe_include_person_organizations(): void {
		if ( ! \is_singular( 'orbis_person' ) ) {
			return;
		}

		if ( ! \function_exists( 'p2p_connection_exists' ) ) {
			return;
		}

		if ( ! \p2p_connection_exists( 'orbis_persons_to_organizations' ) ) {
			return;
		}

		$query = new WP_Query(
			[
				'connected_type'  => 'orbis_persons_to_organizations',
				'connected_items' => \get_queried_object(),
				'nopaging'        => true, // phpcs:ignore WordPressVIPMinimum.Performance.NoPaging.nopaging_nopaging
			]
		);

		include __DIR__ . '/../templates/person-organizations.php';

		\wp_reset_postdata();
	}
}
