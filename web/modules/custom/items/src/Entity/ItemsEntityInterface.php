<?php

namespace Drupal\items\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Items entity entities.
 *
 * @ingroup items
 */
interface ItemsEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Items entity name.
   *
   * @return string
   *   Name of the Items entity.
   */
  public function getName();

  /**
   * Sets the Items entity name.
   *
   * @param string $name
   *   The Items entity name.
   *
   * @return \Drupal\items\Entity\ItemsEntityInterface
   *   The called Items entity entity.
   */
  public function setName($name);

  /**
   * Gets the Items entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Items entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Items entity creation timestamp.
   *
   * @param int $timestamp
   *   The Items entity creation timestamp.
   *
   * @return \Drupal\items\Entity\ItemsEntityInterface
   *   The called Items entity entity.
   */
  public function setCreatedTime($timestamp);
}
