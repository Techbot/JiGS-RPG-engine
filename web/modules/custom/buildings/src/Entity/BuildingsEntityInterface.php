<?php

namespace Drupal\buildings\Entity;

use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Buildings entity entities.
 *
 * @ingroup buildings
 */
interface BuildingsEntityInterface extends EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Buildings entity name.
   *
   * @return string
   *   Name of the Buildings entity.
   */
  public function getName();

  /**
   * Sets the Buildings entity name.
   *
   * @param string $name
   *   The Buildings entity name.
   *
   * @return \Drupal\buildings\Entity\BuildingsEntityInterface
   *   The called Buildings entity entity.
   */
  public function setName($name);

  /**
   * Gets the Buildings entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Buildings entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Buildings entity creation timestamp.
   *
   * @param int $timestamp
   *   The Buildings entity creation timestamp.
   *
   * @return \Drupal\buildings\Entity\BuildingsEntityInterface
   *   The called Buildings entity entity.
   */
  public function setCreatedTime($timestamp);
}
