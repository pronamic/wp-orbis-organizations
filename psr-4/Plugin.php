<?php
/**
 * Plugin
 *
 * @author    Pronamic
 * @copyright 2005-2026 Pronamic
 * @license   GPL-2.0-or-later
 * @package   Pronamic\Orbis\Organizations
 */

declare(strict_types=1);

namespace Pronamic\Orbis\Organizations;

/**
 * Plugin class
 */
final class Plugin {
	/**
	 * Instance.
	 *
	 * @var self|null
	 */
	private static $instance = null;

	/**
	 * Return instance of this class.
	 *
	 * @return self A single instance of this class.
	 */
	public static function instance(): self {
		self::$instance ??= new self();

		return self::$instance;
	}

	/**
	 * Construct.
	 */
	private function __construct() {
		\add_action( 'init', $this->init( ... ), 0 );
		\add_action( 'p2p_init', $this->p2p_init( ... ) );
		\add_action( 'wp_ajax_organization_id_suggest', $this->ajax_suggest_organization_id( ... ) );

		new ContentTypes();

		if ( \is_admin() ) {
			new AdminOrganizationPostType();
		}
	}

	/**
	 * Initialize.
	 *
	 * @return void
	 */
	private function init(): void {
		$version = '1.1.0';

		if ( \get_option( 'orbis_organizations_db_version' ) !== $version ) {
			$this->install();

			\update_option( 'orbis_organizations_db_version', $version );
		}
	}

	/**
	 * Install.
	 *
	 * @return void
	 */
	private function install(): void {
		global $wpdb;

		/**
		 * WordPress database abstraction object.
		 *
		 * @var \wpdb $wpdb
		 */

		$table = $wpdb->prefix . 'orbis_organizations';

		$charset_collate = $wpdb->get_charset_collate();

		$sql = <<<SQL
			CREATE TABLE $table (
				id BIGINT(16) UNSIGNED NOT NULL AUTO_INCREMENT,
				post_id BIGINT(20) UNSIGNED DEFAULT NULL,
				name VARCHAR(128) NOT NULL,
				e_mail VARCHAR(128) DEFAULT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;
			SQL;

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		\dbDelta( $sql );

		\maybe_convert_table_to_utf8mb4( $table );
	}

	/**
	 * Posts 2 Posts initialize.
	 *
	 * @link https://github.com/scribu/wp-posts-to-posts/wiki/Posts-2-Users
	 * @return void
	 */
	private function p2p_init(): void {
		if ( \post_type_exists( 'orbis_person' ) ) {
			$this->register_persons_to_organizations_connection();
		}

		\p2p_register_connection_type(
			[
				'name'        => 'orbis_users_to_organizations',
				'from'        => 'user',
				'to'          => 'orbis_organization',
				'title'       => [
					'from' => \__( 'Organizations', 'orbis-organizations' ),
					'to'   => \__( 'Users', 'orbis-organizations' ),
				],
				'from_labels' => [
					'singular_name' => \__( 'User', 'orbis-organizations' ),
					'search_items'  => \__( 'Search user', 'orbis-organizations' ),
					'not_found'     => \__( 'No users found.', 'orbis-organizations' ),
					'create'        => \__( 'Add User', 'orbis-organizations' ),
					'new_item'      => \__( 'New User', 'orbis-organizations' ),
					'add_new_item'  => \__( 'Add New User', 'orbis-organizations' ),
				],
				'to_labels'   => [
					'singular_name' => \__( 'Organization', 'orbis-organizations' ),
					'search_items'  => \__( 'Search organization', 'orbis-organizations' ),
					'not_found'     => \__( 'No organizations found.', 'orbis-organizations' ),
					'create'        => \__( 'Add Organization', 'orbis-organizations' ),
					'new_item'      => \__( 'New Organization', 'orbis-organizations' ),
					'add_new_item'  => \__( 'Add New Organization', 'orbis-organizations' ),
				],
			]
		);
	}

	/**
	 * Register the persons to organizations connection.
	 *
	 * @return void
	 */
	private function register_persons_to_organizations_connection(): void {
		\p2p_register_connection_type(
			[
				'name'        => 'orbis_persons_to_organizations',
				'from'        => 'orbis_person',
				'to'          => 'orbis_organization',
				'title'       => [
					'from' => \__( 'Organizations', 'orbis-organizations' ),
					'to'   => \__( 'Contacts', 'orbis-organizations' ),
				],
				'fields'      => [
					'note' => [
						'title' => \__( 'Note', 'orbis-organizations' ),
						'type'  => 'text',
					],
				],
				'from_labels' => [
					'singular_name' => \__( 'Contact', 'orbis-organizations' ),
					'search_items'  => \__( 'Search contact', 'orbis-organizations' ),
					'not_found'     => \__( 'No contacts found.', 'orbis-organizations' ),
					'create'        => \__( 'Add Contact', 'orbis-organizations' ),
					'new_item'      => \__( 'New Contact', 'orbis-organizations' ),
					'add_new_item'  => \__( 'Add New Contact', 'orbis-organizations' ),
					'help'          => \__( 'Please note: these are contacts who do not necessarily work at this organization. Handle the removal of connected contacts with great care. In many cases, deleting connected contacts is not desirable.', 'orbis-organizations' ),
				],
				'to_labels'   => [
					'singular_name' => \__( 'Organization', 'orbis-organizations' ),
					'search_items'  => \__( 'Search organization', 'orbis-organizations' ),
					'not_found'     => \__( 'No organizations found.', 'orbis-organizations' ),
					'create'        => \__( 'Add Organization', 'orbis-organizations' ),
					'new_item'      => \__( 'New Organization', 'orbis-organizations' ),
					'add_new_item'  => \__( 'Add New Organization', 'orbis-organizations' ),
					'help'          => \__( 'Please note: this contact does not necessarily work at these organizations. Handle the removal of connected organizations with great care. In many cases, deleting connected organizations is not desirable.', 'orbis-organizations' ),
				],
			]
		);
	}

	/**
	 * AJAX suggest organization ID.
	 *
	 * @return never
	 */
	private function ajax_suggest_organization_id(): never {
		global $wpdb;

		/**
		 * WordPress database abstraction object.
		 *
		 * @var \wpdb $wpdb
		 */

		$term = \array_key_exists( 'term', $_GET ) && \is_string( $_GET['term'] ) ? \sanitize_text_field( \wp_unslash( $_GET['term'] ) ) : '';

		$data = $wpdb->get_results(
			$wpdb->prepare(
				'
				SELECT
					organization.id AS id,
					organization.name AS text
				FROM
					%i AS organization
				WHERE
					organization.name LIKE %s
				;
				',
				$wpdb->prefix . 'orbis_organizations',
				'%' . $wpdb->esc_like( $term ) . '%'
			)
		);

		\wp_send_json( $data );
	}
}
