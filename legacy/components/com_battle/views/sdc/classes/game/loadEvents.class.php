<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

class loadEvents extends core\paBase {
    protected function expectedArgs() {
        return array(
            'eventID'    => array('default'=>0),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $sql = "SELECT * FROM {$this->paPrefix}_items"; //@todo: change to _events
        if($this->args['eventID']) {$sql.=" WHERE id={$this->args['eventID']}";}
        $rs = $pdo->query($sql);
        $output = array();
        foreach($rs as $row) {
            $output[]=$row;
        }
        return $output;
    }
}
