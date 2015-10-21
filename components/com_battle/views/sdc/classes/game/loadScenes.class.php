<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

class loadScenes extends core\paBase {
    protected function expectedArgs() {
        return array(
            'sceneID'    => array('default'=>0),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $sql = "SELECT * FROM {$this->paPrefix}_scenes";
        if($this->args['sceneID']) {$sql.=" WHERE id={$this->args['sceneID']}";}
        $rs = $pdo->query($sql);
        $output = array();
        $scints = array('id');
        $exints = array("id","sceneID","destID");
        $chints = array("id","isPlayer","startX","startY","startX2","startY2","startFrame2");
        foreach($rs as $row) {
            $rsx=$pdo->query("SELECT * FROM {$this->paPrefix}_sceneExits WHERE sceneID={$row['id']}");
            $row['exits']=$rsx->fetchAll();
            $rch=$pdo->query("SELECT c.id,c.isPlayer,cs.startX,cs.startY,cs.startFrame,cs.startX2,cs.startY2,cs.startFrame2 FROM {$this->paPrefix}_characterScenes cs JOIN {$this->paPrefix}_characters c on c.id=cs.characterID WHERE cs.sceneID={$row['id']}");
            $row['chars']=$rch->fetchAll();
            foreach($scints as $int) {$row[$int]=(int)$row[$int];}  //required for sqlite as it returns strings for all variables.
            foreach($row['exits'] as &$ex) {foreach($exints as $int) {$ex[$int]=(int)$ex[$int];}}
            foreach($row['chars'] as &$ch) {foreach($chints as $int) {$ch[$int]=(int)$ch[$int];}}
            $output[]=$row;
        }
        return $output;
    }
}
