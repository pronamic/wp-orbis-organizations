<?php
/**
 * Admin organization post type
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

declare(strict_types=1);

namespace Pronamic\Orbis\Organizations;

use WP_Post;

/**
 * Admin organization post type class
 */
final class AdminOrganizationPostType {
	/**
	 * Construct.
	 */
	public function __construct() {
		\add_filter( 'manage_edit-orbis_organization_columns', $this->edit_columns( ... ) );

		\add_action( 'manage_orbis_organization_posts_custom_column', $this->custom_columns( ... ), 10, 2 );

		\add_action( 'add_meta_boxes', $this->add_meta_boxes( ... ) );

		\add_action( 'save_post_orbis_organization', $this->save_organization( ... ) );
		\add_action( 'save_post_orbis_organization', $this->save_organization_sync( ... ), 500, 2 );
	}

	/**
	 * Edit columns.
	 *
	 * @return array<string, string>
	 */
	private function edit_columns(): array {
		return [
			'cb'                            => '<input type="checkbox" />',
			'title'                         => \__( 'Title', 'orbis-organizations' ),
			'orbis_organization_address'    => \__( 'Address', 'orbis-organizations' ),
			'orbis_organization_online'     => \__( 'Online', 'orbis-organizations' ),
			'orbis_organization_kvk_number' => \__( 'Registration Number', 'orbis-organizations' ),
			'author'                        => \__( 'Author', 'orbis-organizations' ),
			'comments'                      => \__( 'Comments', 'orbis-organizations' ),
			'date'                          => \__( 'Date', 'orbis-organizations' ),
		];
	}

	/**
	 * Custom columns.
	 *
	 * @param string $column  Column name.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	private function custom_columns( string $column, int $post_id ): void {
		switch ( $column ) {
			case 'orbis_organization_online':
				$links = [];

				$website = $this->get_meta( $post_id, '_orbis_website' );

				if ( '' !== $website ) {
					$links[] = \sprintf(
						'<a href="%s" target="_blank">%s</a>',
						\esc_url( $website ),
						\esc_html( $website )
					);
				}

				$email = $this->get_meta( $post_id, '_orbis_email' );

				if ( '' !== $email ) {
					$links[] = \sprintf(
						'<a href="%s" target="_blank">%s</a>',
						\esc_url( 'mailto:' . $email ),
						\esc_html( $email )
					);
				}

				echo \wp_kses_post( \implode( '<br />', $links ) );

				break;
			case 'orbis_organization_address':
				\printf(
					'%s<br />%s %s',
					\esc_html( $this->get_meta( $post_id, '_orbis_address' ) ),
					\esc_html( $this->get_meta( $post_id, '_orbis_postcode' ) ),
					\esc_html( $this->get_meta( $post_id, '_orbis_city' ) )
				);

				break;
			case 'orbis_organization_kvk_number':
				$kvk_number = $this->get_meta( $post_id, '_orbis_kvk_number' );

				if ( '' !== $kvk_number ) {
					\printf(
						'<a href="%s" target="_blank">%s</a>',
						\esc_url( \sprintf( 'https://openkvk.nl/kvk/%s/', $kvk_number ) ),
						\esc_html( $kvk_number )
					);
				}

				break;
		}
	}

	/**
	 * Get post meta value as string.
	 *
	 * @param int    $post_id Post ID.
	 * @param string $key     Meta key.
	 * @return string
	 */
	private function get_meta( int $post_id, string $key ): string {
		$value = \get_post_meta( $post_id, $key, true );

		return \is_string( $value ) ? $value : '';
	}

	/**
	 * Add meta boxes.
	 *
	 * @return void
	 */
	private function add_meta_boxes(): void {
		\add_meta_box(
			'orbis_organization_details',
			\__( 'Organization Details', 'orbis-organizations' ),
			$this->meta_box( ... ),
			'orbis_organization',
			'normal',
			'high'
		);
	}

	/**
	 * Meta box.
	 *
	 * @param WP_Post $post Post.
	 * @return void
	 */
	private function meta_box( WP_Post $post ): void {
		include __DIR__ . '/../admin/meta-box-organization-details.php';
	}

	/**
	 * Save organization.
	 *
	 * @param int $post_id Post ID.
	 * @return void
	 */
	private function save_organization( int $post_id ): void {
		if ( \defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		$nonce = \array_key_exists( 'orbis_organization_details_meta_box_nonce', $_POST ) && \is_string( $_POST['orbis_organization_details_meta_box_nonce'] ) ? \sanitize_text_field( \wp_unslash( $_POST['orbis_organization_details_meta_box_nonce'] ) ) : '';

		if ( ! \wp_verify_nonce( $nonce, 'orbis_save_organization_details' ) ) {
			return;
		}

		if ( ! \current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$fields = [
			'_orbis_kvk_number'        => \sanitize_text_field( ... ),
			'_orbis_vat_number'        => \sanitize_text_field( ... ),
			'_orbis_email'             => \sanitize_email( ... ),
			'_orbis_accounting_email'  => \sanitize_email( ... ),
			'_orbis_invoice_email'     => \sanitize_email( ... ),
			'_orbis_invoice_reference' => \sanitize_textarea_field( ... ),
			'_orbis_website'           => \sanitize_url( ... ),
			'_orbis_address'           => \sanitize_text_field( ... ),
			'_orbis_postcode'          => \sanitize_text_field( ... ),
			'_orbis_city'              => \sanitize_text_field( ... ),
			'_orbis_country'           => \sanitize_text_field( ... ),
			'_orbis_iban'              => \sanitize_text_field( ... ),
			'_orbis_twitter'           => \sanitize_text_field( ... ),
			'_orbis_facebook'          => \sanitize_text_field( ... ),
			'_orbis_linkedin'          => \sanitize_text_field( ... ),
		];

		foreach ( $fields as $key => $sanitize ) {
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Sanitized by the field specific callback.
			$value = \array_key_exists( $key, $_POST ) && \is_string( $_POST[ $key ] ) ? $sanitize( \wp_unslash( $_POST[ $key ] ) ) : '';

			if ( '' === $value ) {
				\delete_post_meta( $post_id, $key );
			} else {
				\update_post_meta( $post_id, $key, $value );
			}
		}
	}

	/**
	 * Sync organization with Orbis tables.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post.
	 * @return void
	 */
	private function save_organization_sync( int $post_id, WP_Post $post ): void {
		global $wpdb;

		/**
		 * WordPress database abstraction object.
		 *
		 * @var \wpdb $wpdb
		 */

		if ( \defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( \wp_is_post_revision( $post_id ) ) {
			return;
		}

		if ( 'publish' !== $post->post_status ) {
			return;
		}

		$orbis_id = \get_post_meta( $post_id, '_orbis_organization_id', true );

		$now = \current_time( 'mysql', true );

		if ( ! empty( $orbis_id ) ) {
			$wpdb->update(
				$wpdb->prefix . 'orbis_organizations',
				[
					'name'       => $post->post_title,
					'updated_at' => $now,
				],
				[ 'id' => $orbis_id ],
				[ '%s', '%s' ],
				[ '%d' ]
			);

			return;
		}

		$result = $wpdb->insert(
			$wpdb->prefix . 'orbis_organizations',
			[
				'post_id'    => $post_id,
				'name'       => $post->post_title,
				'created_at' => $now,
				'updated_at' => $now,
			],
			[
				'%d',
				'%s',
				'%s',
				'%s',
			]
		);

		if ( false !== $result ) {
			\update_post_meta( $post_id, '_orbis_organization_id', $wpdb->insert_id );
		}
	}
}
