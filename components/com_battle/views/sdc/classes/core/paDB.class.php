<?php
namespace sdcAdventure\core;

/**
 * Yes, it's a singleton. I know the purists will shoot me.
 */
class paDB {
    private static $obj=null;

    private $pdo = null;

    private function __construct() {
        $this->pdo = new \PDO($this->dsn());
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }
    /**
     * @return paDB The singleton database object.
     */
    public static function obj() {
        if(self::$obj) { return self::$obj; }
        self::$obj = new self();
        return self::$obj;
    }
    /**
     * @return \PDO The main database object for the system.
     */
    public static function conn() {
        return self::obj()->pdo;
    }
    /**
     * Currently sqlite; Change this to use mySQL (or whatever).
     * @return string The PDO DSN string for the database.
     */
    private function dsn() {
        $dsn = paConfig::load('dsn');
        $dsn = str_replace('@gamedir',ADVENGAME_ROOT.'/assets/'.paConfig::getGame(), $dsn); 
        return $dsn;
    }
}
