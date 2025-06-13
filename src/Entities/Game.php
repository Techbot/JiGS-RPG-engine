<?php

namespace Drupal\jigs\Entities;

class Game
{
  public $gameNode;

  function __construct()
  {
    $node_storage = \Drupal::entityTypeManager()->getStorage('node');
    // Load the first node of type "game".
    $nids = $node_storage->getQuery()
      ->condition('type', 'game')
      ->range(0, 1)
      ->accessCheck(FALSE)
      ->execute();

    if (!empty($nids)) {
      $this->gameNode = $node_storage->load(reset($nids));
    } else {
      $this->gameNode = NULL;
      \Drupal::logger('jigs')->error('No node of type "game" was found.');
    }
  }

  function create()
  {
    $gameConfig['Debug']    = $this->gameNode->field_debug->getValue()[0]['value'];
    //$GameConfig['Body']   = $GameNode->field_body->getValue()[0]['value'];
    $gameConfig['Body']     = $this->gameNode->get('body')->value;
    //$GameConfig['Summary']= $GameNode->field_body->getValue()[0]['value'];
    $gameConfig['Summary']  = $this->gameNode->get('body')->summary;
    return $gameConfig;
  }
}
