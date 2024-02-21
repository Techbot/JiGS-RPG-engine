<?php

namespace Drupal\jigs\Entities;

class Game
{
  public $gameNode;

  function __construct()
  {
    $this->gameNode  =  \Drupal::entityTypeManager()->getStorage('node')->load(2);
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
