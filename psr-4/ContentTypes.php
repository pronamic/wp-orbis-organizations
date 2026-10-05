<?php
/**
 * Content types
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

declare(strict_types=1);

namespace Pronamic\Orbis\Organizations;

/**
 * Content types class
 */
final class ContentTypes {
	/**
	 * Construct.
	 */
	public function __construct() {
		\add_action( 'init', $this->init( ... ) );
	}

	/**
	 * Initialize.
	 *
	 * @return void
	 */
	private function init(): void {
		\register_post_type(
			'orbis_organization',
			[
				'label'         => \__( 'Organizations', 'orbis-organizations' ),
				'labels'        => [
					'name'               => \__( 'Organizations', 'orbis-organizations' ),
					'singular_name'      => \__( 'Organization', 'orbis-organizations' ),
					'add_new'            => \_x( 'Add New', 'orbis_organization', 'orbis-organizations' ),
					'add_new_item'       => \__( 'Add New Organization', 'orbis-organizations' ),
					'edit_item'          => \__( 'Edit Organization', 'orbis-organizations' ),
					'new_item'           => \__( 'New Organization', 'orbis-organizations' ),
					'all_items'          => \__( 'All Organizations', 'orbis-organizations' ),
					'view_item'          => \__( 'View Organization', 'orbis-organizations' ),
					'search_items'       => \__( 'Search Organizations', 'orbis-organizations' ),
					'not_found'          => \__( 'No organizations found.', 'orbis-organizations' ),
					'not_found_in_trash' => \__( 'No organizations found in Trash.', 'orbis-organizations' ),
					'parent_item_colon'  => \__( 'Parent Organization:', 'orbis-organizations' ),
					'menu_name'          => \__( 'Organizations', 'orbis-organizations' ),
				],
				'public'        => true,
				'menu_position' => 30,
				'menu_icon'     => 'dashicons-building',
				'supports'      => [
					'title',
					'editor',
					'author',
					'comments',
					'thumbnail',
					'custom-fields',
					'revisions',
					'orbis-contact',
				],
				'has_archive'   => true,
				'show_in_rest'  => true,
				'rest_base'     => 'orbis/organizations',
				'rewrite'       => [
					'slug' => \_x( 'organizations', 'slug', 'orbis-organizations' ),
				],
			]
		);
	}
}
