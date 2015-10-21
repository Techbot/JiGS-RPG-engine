<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

class loadCharacters extends core\paBase {
    protected function expectedArgs() {
        return array(
            'charID'    => array('default'=>0),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $sql = "SELECT c.id,c.name,c.startSceneID,c.talkColour, c.isPlayer, csp.id as spriteID, csp.sprite, csp.width, csp.height, csp.frames, csp.animList FROM {$this->paPrefix}_characters c LEFT JOIN {$this->paPrefix}_characterSprites csp ON csp.characterID=c.id";
        if($this->args['charID']) {$sql.=" WHERE c.id={$this->args['charID']}";}
        $rs = $pdo->query($sql);
        $output = array();
        $ints = array('id','startSceneID','isPlayer','width','height','frames');
        foreach($rs as $row) {
            foreach($ints as $int) {$row[$int]=(int)$row[$int];}    //this is necessary for sqlite which returns everything as a string.
            $output[]=$row;
        }
        return $output;
    }
}
