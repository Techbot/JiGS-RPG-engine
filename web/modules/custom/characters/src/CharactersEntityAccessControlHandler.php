<?php

namespace Drupal\characters;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

class CharactersEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    /** @var \Drupal\characters\Entity\CharactersEntityInterface $entity */
    $entity_type_id = $entity->getEntityTypeId();
    $bundle = $entity->bundle();
    $is_owner = $entity->getOwnerId() === $account->id();

    switch ($operation) {
      case 'view':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, "view own $entity_type_id $bundle");
        }
        return AccessResult::allowedIfHasPermission($account, "view any $entity_type_id $bundle");

      case 'update':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, "edit own $entity_type_id $bundle");
        }
        return AccessResult::allowedIfHasPermission($account, "edit any $entity_type_id $bundle");

      case 'delete':
        if ($is_owner) {
          return AccessResult::allowedIfHasPermission($account, "delete own $entity_type_id $bundle");
        }
        return AccessResult::allowedIfHasPermission($account, "delete any $entity_type_id $bundle");
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, "create {$context['entity_type_id']} $entity_bundle");
  }
}
