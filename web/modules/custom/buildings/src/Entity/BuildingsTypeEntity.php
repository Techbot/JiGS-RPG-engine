<?php

namespace Drupal\buildings\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Buildings Type entity. A configuration entity used to manage
 * bundles for the Buildings entity.
 *
 * @ConfigEntityType(
 *   id = "buildings_type",
 *   label = @Translation("Buildings Type"),
 *   bundle_of = "buildings",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "buildings_type",
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\buildings\BuildingsTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\buildings\Form\BuildingsTypeEntityForm",
 *       "add" = "Drupal\buildings\Form\BuildingsTypeEntityForm",
 *       "edit" = "Drupal\buildings\Form\BuildingsTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer buildings types",
 *   links = {
 *     "canonical" = "/admin/structure/buildings_type/{buildings_type}",
 *     "add-form" = "/admin/structure/buildings_type/add",
 *     "edit-form" = "/admin/structure/buildings_type/{buildings_type}/edit",
 *     "delete-form" = "/admin/structure/buildings_type/{buildings_type}/delete",
 *     "collection" = "/admin/structure/buildings_type",
 *   }
 * )
 */
class BuildingsTypeEntity extends ConfigEntityBundleBase implements BuildingsTypeEntityInterface {

  /**
   * The machine name of the buildings type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the buildings type.
   *
   * @var string
   */
  protected $label;

  /**
   * A brief description of the buildings type.
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
