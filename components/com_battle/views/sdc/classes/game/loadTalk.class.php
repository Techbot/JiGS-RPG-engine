<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

/**
 * Loads all speech options for the player talking to a given character.
 * Used by the designer, even if the class is in the game folder. (this is to make it fit in with the other load classes)
 */
class loadTalk extends core\paBase {
    protected function expectedArgs() {
        return array(
            'charID'    => array('default'=>0),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $sql = "SELECT * FROM {$this->paPrefix}_conversations WHERE saidTo={$this->args['charID']} AND saidBy=1";
        $rs = $pdo->query($sql);
        $output = array();
        foreach($rs as $row) {
            $output[]=$row;
        }
        return $output;
    }
}
