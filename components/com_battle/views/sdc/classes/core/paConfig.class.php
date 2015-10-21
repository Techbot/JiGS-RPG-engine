<?php
namespace sdcAdventure\core;
/*
 * Loads the game config file from assets/{gamename}/advengame.ini
 */
class paConfig {
    private $data = array();
    private static $obj = null;

    private function __construct() {
        $game = preg_replace('/[\/.\\*"\']/','',self::getGame());
        $assets = dirname(dirname(__DIR__)).'/assets';
        $this->data = parse_ini_file("{$assets}/{$game}/advengame.ini");
    }

    public static function load($field) {
        if(self::$obj) { return self::$obj->data[$field]; }
        self::$obj = new self();
        return self::$obj->data[$field];
    }

    public static function getGame() {
        if(isset($_SESSION['paGame'])) { return $_SESSION['paGame']; }
        if(isset($_POST['paGame'])) { return $_POST['paGame']; }
        if(isset($_GET['paGame'])) { return $_GET['paGame']; }
        return 'gamename';
    }
}
