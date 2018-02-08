<?php

namespace Drupal\levels\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Levels entity entities.
 *
 * @ingroup levels
 */
interface LevelsEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Levels entity name.
   *
   * @return string
   *   Name of the Levels entity.
   */
  public function getName();

  /**
   * Sets the Levels entity name.
   *
   * @param string $name
   *   The Levels entity name.
   *
   * @return \Drupal\levels\Entity\LevelsEntityInterface
   *   The called Levels entity entity.
   */
  public function setName($name);

  /**
   * Gets the Levels entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Levels entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Levels entity creation timestamp.
   *
   * @param int $timestamp
   *   The Levels entity creation timestamp.
   *
   * @return \Drupal\levels\Entity\LevelsEntityInterface
   *   The called Levels entity entity.
   */
  public function setCreatedTime($timestamp);
}
