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
				'labels'        => [
					'name'                     => \__( 'Organizations', 'orbis-organizations' ),
					'singular_name'            => \__( 'Organization', 'orbis-organizations' ),
					'add_new'                  => \__( 'Add Organization', 'orbis-organizations' ),
					'add_new_item'             => \__( 'Add Organization', 'orbis-organizations' ),
					'edit_item'                => \__( 'Edit Organization', 'orbis-organizations' ),
					'new_item'                 => \__( 'New Organization', 'orbis-organizations' ),
					'view_item'                => \__( 'View Organization', 'orbis-organizations' ),
					'view_items'               => \__( 'View Organizations', 'orbis-organizations' ),
					'search_items'             => \__( 'Search Organizations', 'orbis-organizations' ),
					'not_found'                => \__( 'No organizations found.', 'orbis-organizations' ),
					'not_found_in_trash'       => \__( 'No organizations found in Trash.', 'orbis-organizations' ),
					'all_items'                => \__( 'All Organizations', 'orbis-organizations' ),
					'archives'                 => \__( 'Organization Archives', 'orbis-organizations' ),
					'attributes'               => \__( 'Organization Attributes', 'orbis-organizations' ),
					'insert_into_item'         => \__( 'Insert into organization', 'orbis-organizations' ),
					'uploaded_to_this_item'    => \__( 'Uploaded to this organization', 'orbis-organizations' ),
					'featured_image'           => \__( 'Logo', 'orbis-organizations' ),
					'set_featured_image'       => \__( 'Set logo', 'orbis-organizations' ),
					'remove_featured_image'    => \__( 'Remove logo', 'orbis-organizations' ),
					'use_featured_image'       => \__( 'Use as logo', 'orbis-organizations' ),
					'menu_name'                => \__( 'Organizations', 'orbis-organizations' ),
					'filter_items_list'        => \__( 'Filter organizations list', 'orbis-organizations' ),
					'filter_by_date'           => \__( 'Filter by date', 'orbis-organizations' ),
					'items_list_navigation'    => \__( 'Organizations list navigation', 'orbis-organizations' ),
					'items_list'               => \__( 'Organizations list', 'orbis-organizations' ),
					'item_published'           => \__( 'Organization published.', 'orbis-organizations' ),
					'item_published_privately' => \__( 'Organization published privately.', 'orbis-organizations' ),
					'item_reverted_to_draft'   => \__( 'Organization reverted to draft.', 'orbis-organizations' ),
					'item_trashed'             => \__( 'Organization trashed.', 'orbis-organizations' ),
					'item_scheduled'           => \__( 'Organization scheduled.', 'orbis-organizations' ),
					'item_updated'             => \__( 'Organization updated.', 'orbis-organizations' ),
					'item_link'                => \__( 'Organization Link', 'orbis-organizations' ),
					'item_link_description'    => \__( 'A link to an organization.', 'orbis-organizations' ),
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
