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
				'label'           => \__( 'Organizations', 'orbis-organizations' ),
				'labels'          => [
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
				'public'          => true,
				'menu_position'   => 30,
				'menu_icon'       => 'dashicons-building',
				'capability_type' => [ 'orbis_organization', 'orbis_organizations' ],
				'supports'        => [
					'title',
					'editor',
					'author',
					'comments',
					'thumbnail',
					'custom-fields',
					'revisions',
				],
				'has_archive'     => true,
				'show_in_rest'    => true,
				'rest_base'       => 'orbis/organizations',
				'rewrite'         => [
					'slug' => \_x( 'organizations', 'slug', 'orbis-organizations' ),
				],
			]
		);

		\register_taxonomy(
			'orbis_organization_category',
			[ 'orbis_organization' ],
			[
				'hierarchical' => true,
				'labels'       => [
					'name'              => \_x( 'Categories', 'taxonomy general name', 'orbis-organizations' ),
					'singular_name'     => \_x( 'Category', 'taxonomy singular name', 'orbis-organizations' ),
					'search_items'      => \__( 'Search Categories', 'orbis-organizations' ),
					'all_items'         => \__( 'All Categories', 'orbis-organizations' ),
					'parent_item'       => \__( 'Parent Category', 'orbis-organizations' ),
					'parent_item_colon' => \__( 'Parent Category:', 'orbis-organizations' ),
					'edit_item'         => \__( 'Edit Category', 'orbis-organizations' ),
					'update_item'       => \__( 'Update Category', 'orbis-organizations' ),
					'add_new_item'      => \__( 'Add New Category', 'orbis-organizations' ),
					'new_item_name'     => \__( 'New Category Name', 'orbis-organizations' ),
					'menu_name'         => \__( 'Categories', 'orbis-organizations' ),
				],
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => [
					'slug' => \_x( 'organization-category', 'slug', 'orbis-organizations' ),
				],
			]
		);

		\register_taxonomy(
			'orbis_payment_method',
			[ 'orbis_organization' ],
			[
				'hierarchical' => true,
				'labels'       => [
					'name'              => \_x( 'Payment Methods', 'taxonomy general name', 'orbis-organizations' ),
					'singular_name'     => \_x( 'Payment Method', 'taxonomy singular name', 'orbis-organizations' ),
					'search_items'      => \__( 'Search Payment Methods', 'orbis-organizations' ),
					'all_items'         => \__( 'All Payment Methods', 'orbis-organizations' ),
					'parent_item'       => \__( 'Parent Payment Method', 'orbis-organizations' ),
					'parent_item_colon' => \__( 'Parent Payment Method:', 'orbis-organizations' ),
					'edit_item'         => \__( 'Edit Payment Method', 'orbis-organizations' ),
					'update_item'       => \__( 'Update Payment Method', 'orbis-organizations' ),
					'add_new_item'      => \__( 'Add New Payment Method', 'orbis-organizations' ),
					'new_item_name'     => \__( 'New Payment Method Name', 'orbis-organizations' ),
					'menu_name'         => \__( 'Payment Methods', 'orbis-organizations' ),
				],
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => [
					'slug' => \_x( 'payment-methods', 'slug', 'orbis-organizations' ),
				],
				'meta_box_cb'  => false,
			]
		);

		\register_taxonomy(
			'orbis_invoice_shipping_method',
			[ 'orbis_organization' ],
			[
				'hierarchical' => true,
				'labels'       => [
					'name'              => \_x( 'Invoice Shipping Methods', 'taxonomy general name', 'orbis-organizations' ),
					'singular_name'     => \_x( 'Invoice Shipping Method', 'taxonomy singular name', 'orbis-organizations' ),
					'search_items'      => \__( 'Search Invoice Shipping Methods', 'orbis-organizations' ),
					'all_items'         => \__( 'All Invoice Shipping Methods', 'orbis-organizations' ),
					'parent_item'       => \__( 'Parent Invoice Shipping Method', 'orbis-organizations' ),
					'parent_item_colon' => \__( 'Parent Invoice Shipping Method:', 'orbis-organizations' ),
					'edit_item'         => \__( 'Edit Invoice Shipping Method', 'orbis-organizations' ),
					'update_item'       => \__( 'Update Invoice Shipping Method', 'orbis-organizations' ),
					'add_new_item'      => \__( 'Add New Invoice Shipping Method', 'orbis-organizations' ),
					'new_item_name'     => \__( 'New Invoice Shipping Method Name', 'orbis-organizations' ),
					'menu_name'         => \__( 'Invoice Shipping Methods', 'orbis-organizations' ),
				],
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => [
					'slug' => \_x( 'invoice-shipping-methods', 'slug', 'orbis-organizations' ),
				],
				'meta_box_cb'  => false,
			]
		);
	}
}
