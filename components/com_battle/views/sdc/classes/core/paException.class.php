<?php
namespace sdcAdventure\core;

class paException extends \Exception {
    private $errorData=array();
    public function __construct($message,array $data=array()) {
        $this->errorData = $data;
        parent::__construct($message);
    }
    public function getErrorData() {
        return $this->errorData;
    }
}
