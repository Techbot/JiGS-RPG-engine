<?php

namespace Drupal\jigs\Entities;

class City
{
  public $City;

  function __construct($userCity)
  {
    $this->City = \Drupal::entityTypeManager()->getStorage('node')->load($userCity);
  }

  function create()
  {
    return $this->City->getTitle();
  }
}
