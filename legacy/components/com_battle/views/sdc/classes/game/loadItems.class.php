<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

class loadItems extends core\paBase {
    protected function expectedArgs() {
        return array(
            'itemID'    => array('default'=>0),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $sql = "SELECT * FROM {$this->paPrefix}_items";
        if($this->args['itemID']) {$sql.=" WHERE id={$this->args['itemID']}";}
        $rs = $pdo->query($sql);
        $output = array();
        foreach($rs as $row) {
            $output[]=$row;
        }
        return $output;
    }
}
