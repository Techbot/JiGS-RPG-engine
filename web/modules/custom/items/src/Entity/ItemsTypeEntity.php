<?php

namespace Drupal\items\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Items Type entity. A configuration entity used to manage
 * bundles for the Items entity.
 *
 * @ConfigEntityType(
 *   id = "items_type",
 *   label = @Translation("Items Type"),
 *   bundle_of = "items",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "items_type",
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\items\ItemsTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\items\Form\ItemsTypeEntityForm",
 *       "add" = "Drupal\items\Form\ItemsTypeEntityForm",
 *       "edit" = "Drupal\items\Form\ItemsTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer items types",
 *   links = {
 *     "canonical" = "/admin/structure/items_type/{items_type}",
 *     "add-form" = "/admin/structure/items_type/add",
 *     "edit-form" = "/admin/structure/items_type/{items_type}/edit",
 *     "delete-form" = "/admin/structure/items_type/{items_type}/delete",
 *     "collection" = "/admin/structure/items_type",
 *   }
 * )
 */
class ItemsTypeEntity extends ConfigEntityBundleBase implements ItemsTypeEntityInterface {

  /**
   * The machine name of the items type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the items type.
   *
   * @var string
   */
  protected $label;

  /**
   * A brief description of the items type.
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
