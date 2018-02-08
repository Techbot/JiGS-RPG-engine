<?php

namespace Drupal\characters\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Characters Type entity. A configuration entity used to manage
 * bundles for the Characters entity.
 *
 * @ConfigEntityType(
 *   id = "characters_type",
 *   label = @Translation("Characters Type"),
 *   bundle_of = "characters",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   config_prefix = "characters_type",
 *   config_export = {
 *     "id",
 *     "label",
 *     "description",
 *   },
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\characters\CharactersTypeListBuilder",
 *     "form" = {
 *       "default" = "Drupal\characters\Form\CharactersTypeEntityForm",
 *       "add" = "Drupal\characters\Form\CharactersTypeEntityForm",
 *       "edit" = "Drupal\characters\Form\CharactersTypeEntityForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   admin_permission = "administer characters types",
 *   links = {
 *     "canonical" = "/admin/structure/characters_type/{characters_type}",
 *     "add-form" = "/admin/structure/characters_type/add",
 *     "edit-form" = "/admin/structure/characters_type/{characters_type}/edit",
 *     "delete-form" = "/admin/structure/characters_type/{characters_type}/delete",
 *     "collection" = "/admin/structure/characters_type",
 *   }
 * )
 */
class CharactersTypeEntity extends ConfigEntityBundleBase implements CharactersTypeEntityInterface {

  /**
   * The machine name of the characters type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the characters type.
   *
   * @var string
   */
  protected $label;

  /**
   * A brief description of the characters type.
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
