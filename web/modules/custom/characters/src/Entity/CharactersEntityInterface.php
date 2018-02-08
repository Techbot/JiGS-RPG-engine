<?php

namespace Drupal\characters\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Characters entity entities.
 *
 * @ingroup characters
 */
interface CharactersEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Characters entity name.
   *
   * @return string
   *   Name of the Characters entity.
   */
  public function getName();

  /**
   * Sets the Characters entity name.
   *
   * @param string $name
   *   The Characters entity name.
   *
   * @return \Drupal\characters\Entity\CharactersEntityInterface
   *   The called Characters entity entity.
   */
  public function setName($name);

  /**
   * Gets the Characters entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Characters entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Characters entity creation timestamp.
   *
   * @param int $timestamp
   *   The Characters entity creation timestamp.
   *
   * @return \Drupal\characters\Entity\CharactersEntityInterface
   *   The called Characters entity entity.
   */
  public function setCreatedTime($timestamp);
}
