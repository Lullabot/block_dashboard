<?php

namespace Drupal\block_dashboard;

use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Drupal\Core\Database\Connection;

/**
 * Provides a 'LayoutService' helper service.
 */
class LayoutService extends ServiceProviderBase {

  /**
   * The Drupal 8 database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Constructs a LayoutService instance.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The Connection object.
   */
  public function __construct(Connection $connection) {
    $this->connection = $connection;
  }

  /**
   * Identify usage of a block uuid.
   *
   * @param string $uuid
   *   The uuid of the block whose usage is being determined.
   *
   * @return array
   *   An array of entity ids where the block is used in layout builder.
   */
  public function layoutUuidUsage($uuid) {
    $results = $this->connection->select('node__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%' . db_like($uuid) . '%', 'LIKE')
      ->execute()->fetchCol();
    $results2 = $this->connection->select('node_revision__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%' . db_like($uuid) . '%', 'LIKE')
      ->execute()->fetchCol();
    return array_unique(array_merge($results, $results2));
  }

  /**
   * Identify usage of a block id.
   *
   * @param string $id
   *   The id of the block whose usage is being determined.
   *
   * @return array
   *   An array of entity ids where the block is used in layout builder.
   */
  public function layoutIdUsage($id) {
    $results = $this->connection->select('node__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%block_content:' . db_like($id) . '%', 'LIKE')
      ->execute()->fetchCol();
    $results2 = $this->connection->select('node_revision__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%block_content:' . db_like($id) . '%', 'LIKE')
      ->execute()->fetchCol();
    return array_unique(array_merge($results, $results2));
  }

  /**
   * Identify usage of a block revision id.
   *
   * @param string $id
   *   The revision id of the block whose usage is being determined.
   *
   * @return array
   *   An array of entity ids where the block is used in layout builder.
   */
  public function layoutRevisionIdUsage($id) {
    $size = strlen($id);
    $results = $this->connection->select('node__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%block_revision_id";s:' . $size . ':"' . db_like($id) . '"%', 'LIKE')
      ->execute()->fetchCol();
    $results2 = $this->connection->select('node_revision__layout_builder__layout', 'n')
      ->fields('n', ['entity_id'])
      ->condition('layout_builder__layout_section', '%block_revision_id";s:' . $size . ':"' . db_like($id) . '"%', 'LIKE')
      ->execute()->fetchCol();
    return array_unique(array_merge($results, $results2));
  }

}
