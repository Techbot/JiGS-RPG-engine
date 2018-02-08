<?php

require_once '../vendor/autoload.php';

// Choose a Mink driver. More about it in later chapters.
$driver = new \Behat\Mink\Driver\GoutteDriver();

$driver_sel = new \Behat\Mink\Driver\GoutteDriver();


$session = new \Behat\Mink\Session($driver);

// start the session
$session->start();

$session->visit('http://vastgoeddata.nl');

// get the current page URL:
echo $session->getCurrentUrl() . PHP_EOL;

// use history controls:
//$session->reload();
//$session->back();
//$session->forward();

$page = $session->getPage();

$registerForm = $page->find('css', '#signUpEmail');

if (null === $registerForm) {
    throw new \Exception('The element is not found');
}

// find some field INSIDE form with class="register"
$field = $registerForm->findField('Email');



$el = $page->find('css', '.page-scroll');

// get tag name:
echo $el->getTagName();

// check that element has href attribute:
$el->hasAttribute('href');

// get element's href attribute:
echo $el->getAttribute('href');

echo $el->getAttribute('id');

$plainText = $el->getText();

$html = $el->getHtml();

//echo $plainText;

//echo $html;