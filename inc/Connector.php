<?php
/**
 * Mongodb Db Collection Settings.
 *
 * @package acjpd-mongodb-sync
 * @subpackage WordPress
 */

namespace Acjpd\Mongodb;

use MongoDB\Collection;
use function Acjpd\Mongodb\acjpd_mongodb_get_client as mongoDbClient;

/**
 * Class.
 */
class Connector {
	/**
	 * Is multisite enabled?.
	 *
	 * @var bool
	 */
	public bool $is_multi_blog = false;

	/**
	 * Exclude meta keys to sync.
	 *
	 * @var array|mixed|string[]|null
	 */
	public array $exclude_meta_keys = array(
		'acjpd_mongodb_sync_inserted_id',
	);

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->is_multi_blog     = is_multisite();
		$this->exclude_meta_keys = apply_filters( 'acjpd_mongodb_sync_excluded_meta_keys', $this->exclude_meta_keys );
	}

	/**
	 * Post db collection.
	 *
	 * @return Collection
	 */
	protected function get_post_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->posts );
	}

	/**
	 * Post meta db collection.
	 *
	 * @return Collection
	 */
	protected function get_post_meta_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->postmeta );
	}

	/**
	 * Term db collection.
	 *
	 * @return Collection
	 */
	protected function get_term_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->terms );
	}

	/**
	 * Term meta db collection.
	 *
	 * @return Collection
	 */
	protected function get_term_meta_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->termmeta );
	}

	/**
	 * Options db collection.
	 *
	 * @return Collection
	 */
	protected function get_option_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->options );
	}

	/**
	 * User db collection.
	 *
	 * @return Collection
	 */
	protected function get_user_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->users ); //phpcs:ignore
	}

	/**
	 * User meta db collection.
	 *
	 * @return Collection
	 */
	protected function get_user_meta_collection(): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $wpdb->usermeta );
	}

	/**
	 * Options db collection.
	 *
	 * @param string $table_name Table Name.
	 *
	 * @return Collection
	 */
	public function get_custom_table_collection( string $table_name ): Collection {
		global $wpdb;

		$db_name = apply_filters( 'acjpd_mongodb_sync_db_name', $wpdb->dbname );
		$mongodb = mongoDbClient( $db_name );

		return $mongodb->selectCollection( $table_name );
	}
}
