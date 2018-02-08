<?php

namespace Drupal\buildings\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\user\UserInterface;

/**
 * Defines the Buildings entity.
 *
 * @ContentEntityType(
 *   id = "buildings",
 *   label = @Translation("Buildings"),
 *   base_table = "buildings",
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "bundle",
 *     "uid" = "uid",
 *     "label" = "name",
 *     "map" = "map",
 *     "grid" = "grid",
 *     "posx" = "posx",
 *     "posy" = "posy",
 *     "attack" = "attack",
 *     "defense" = "defense",
 *     "health" = "health",
 *     "energy" = "energy",
 *     "image" = "image",
 *     "created" = "created",
 *     "changed" = "changed"
 *   },
 *   fieldable = TRUE,
 *   admin_permission = "administer buildings types",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\buildings\BuildingsListBuilder",
 *     "access" = "Drupal\buildings\BuildingsEntityAccessControlHandler",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "default" = "Drupal\buildings\Form\BuildingsEntityForm",
 *       "add" = "Drupal\buildings\Form\BuildingsEntityForm",
 *       "edit" = "Drupal\buildings\Form\BuildingsEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   links = {
 *     "canonical" = "/buildings/{buildings}",
 *     "add-page" = "/buildings/add",
 *     "add-form" = "/buildings/add/{buildings_type}",
 *     "edit-form" = "/buildings/{buildings}/edit",
 *     "delete-form" = "/buildings/{buildings}/delete",
 *     "collection" = "/admin/content/buildingss",
 *   },
 *   bundle_entity_type = "buildings_type",
 *   field_ui_base_route = "entity.buildings_type.edit_form",
 * )
 */
class BuildingsEntity extends ContentEntityBase implements BuildingsEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

    /**
     * {@inheritdoc}
     */
    public function getPosX() {
        return $this->get('posx')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosX($posx) {
        $this->set('posx', $posx);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosY() {
        return $this->get('posy')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosY($posy) {
        $this->set('posy', $posy);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMap() {
        return $this->get('map')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setMap($map) {
        $this->set('map', $map);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getGrid() {
        return $this->get('map')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setGrid($grid) {
        $this->set('grid', $grid);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHealth() {
        return $this->get('health')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setHealth($health) {
        $this->set('health', $health);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnergy() {
        return $this->get('energy')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnergy($energy) {
        $this->set('energy', $energy);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttack() {
        return $this->get('attack')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setAttack($attack) {
        $this->set('attack', $attack);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefence() {
        return $this->get('defence')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setDefence($defence) {
        $this->set('defence', $defence);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImage() {
        return $this->get('image')->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image) {
        $this->set('image', $image);
        return $this;
    }

    /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('uid', $account->id());
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('uid', $uid);
    return $this;
  }
  
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['uid'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Buildings entity.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
       ->setLabel(t('Name'))
       ->setDescription(t('The name of the Buildings entity.'))
       ->setSettings([
         'max_length' => 50,
         'text_processing' => 0,
       ])
       ->setDefaultValue('')
       ->setDisplayOptions('view', [
         'label' => 'hidden',
         'type' => 'string',
         'weight' => -4,
       ])
       ->setDisplayOptions('form', [
         'type' => 'string_textfield',
         'weight' => -4,
       ])
       ->setDisplayConfigurable('form', TRUE)
       ->setDisplayConfigurable('view', TRUE);


      $fields['map'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Map'))
          ->setDescription(t('The map where the  Buildings is located.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['grid'] = BaseFieldDefinition::create('string')
          ->setLabel(t('GridMap'))
          ->setDescription(t('The grid where the  Buildings is located.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['posx'] = BaseFieldDefinition::create('string')
          ->setLabel(t('PosX'))
          ->setDescription(t('The X Position  where the  Buildings is located.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);


      $fields['posy'] = BaseFieldDefinition::create('string')
          ->setLabel(t('PosY'))
          ->setDescription(t('The Y Position  where the  Buildings is located.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['attack'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Attack'))
          ->setDescription(t('The attack properties of this building against invaders.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);


      $fields['defence'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Defence'))
          ->setDescription(t('The Total defence of this building against attacking invaders.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['energy'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Energy'))
          ->setDescription(t('The energy stored in the buildings batteries'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);

      $fields['health'] = BaseFieldDefinition::create('string')
          ->setLabel(t('Health'))
          ->setDescription(t('The structural health of the building.'))
          ->setSettings([
              'max_length' => 50,
              'text_processing' => 0,
          ])
          ->setDefaultValue('001')
          ->setDisplayOptions('view', [
              'label' => 'hidden',
              'type' => 'string',
              'weight' => -4,
          ])
          ->setDisplayOptions('form', [
              'type' => 'string_textfield',
              'weight' => -4,
          ])
          ->setDisplayConfigurable('form', TRUE)
          ->setDisplayConfigurable('view', TRUE);


      $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'uid' => \Drupal::currentUser()->id(),
    ];
  }

}
