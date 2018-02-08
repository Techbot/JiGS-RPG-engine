<?php

namespace Drupal\levels\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Levels Type entity. A configuration entity used to manage
 * bundles for the Levels entity.
 *
 * @ConfigEntityType(
 *   id = "levels_type",
 *   label = @Translation("Levels Type"),
 *   bundle_of = "levels",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "levels_type",
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\levels\LevelsTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\levels\Form\LevelsTypeEntityForm",
 *       "add" = "Drupal\levels\Form\LevelsTypeEntityForm",
 *       "edit" = "Drupal\levels\Form\LevelsTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer levels types",
 *   links = {
 *     "canonical" = "/admin/structure/levels_type/{levels_type}",
 *     "add-form" = "/admin/structure/levels_type/add",
 *     "edit-form" = "/admin/structure/levels_type/{levels_type}/edit",
 *     "delete-form" = "/admin/structure/levels_type/{levels_type}/delete",
 *     "collection" = "/admin/structure/levels_type",
 *   }
 * )
 */
class LevelsTypeEntity extends ConfigEntityBundleBase implements LevelsTypeEntityInterface {

  /**
   * The machine name of the levels type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the levels type.
   *
   * @var string
   */
  protected $label;

  /**
   * A brief description of the levels type.
   *
   * @var string
   */
  protected $description;
  
  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

}
