<?php
namespace sdcAdventure\designer;
use \sdcAdventure\core;

class saveChar extends core\paBase {
    protected function expectedArgs() {
        return array(
            'id'          => array('type'=>'integer','required'=>true),
            'name'        => array('type'=>'string','required'=>true),
            'startSceneID'=> array('type'=>'integer','required'=>true),
            'spriteID'    => array('type'=>'integer','required'=>true),
            'sprite'      => array('type'=>'string','required'=>true),
            'width'       => array('type'=>'integer','required'=>true),
            'height'      => array('type'=>'integer','required'=>true),
            'frames'      => array('type'=>'integer','required'=>true),
            'animList'    => array('type'=>'string','required'=>true),
            //@todo: sprite size, config etc, and other fields.
        );
    }

    public function call() {
        $output = array();
        $pdo = core\paDB::conn();

        if($this->args['id']) {
            $old = core\paMain::call(array('module'=>'loadCharacters','charID'=>$this->args['id']));
            if($old['success']) {
                $old = $old['results'][0];
            } else {
                throw new core\paException('Failed to load existing character #'.$this->args['id']);
            }
            $chquery = $this->charUpdate($pdo);
            $pdo->query($chquery);
            $output['id']=$this->args['id'];
            $spquery = $this->spriteUpdate($pdo);
            $pdo->query($spquery);
            $output['spriteID']=$this->args['spriteID'];
        } else {
            $chquery = $this->charInsert($pdo);
            $pdo->query($chquery);
            $output['id']=$pdo->lastInsertId();
            $spquery = $this->spriteInsert($pdo);
            $pdo->query($spquery);
            $output['spriteID']=$pdo->lastInsertId();
        }

        return $output;
    }
    private function charInsert($pdo) {
        $qName = $pdo->quote($this->args['name']);
        $qScene = $pdo->quote($this->args['startSceneID']);
        return "insert into `{$this->paPrefix}_characters` (`name`,`startSceneID`) values ({$qName},{$qScene})";        
    }
    private function charUpdate($pdo) {
        $qName = $pdo->quote($this->args['name']);
        $qScene = $pdo->quote($this->args['startSceneID']);
        return "update `{$this->paPrefix}_characters` set `name`={$qName}, `startSceneID`={$qScene} WHERE id={$this->args['id']}";
    }
    private function spriteInsert($pdo) {
        $qSprite = $pdo->quote($this->args['sprite']);
        $qWidth = $pdo->quote($this->args['width']);
        $qHeight = $pdo->quote($this->args['height']);
        $qFrames = $pdo->quote($this->args['frames']);
        $qAnimList = $pdo->quote($this->args['animList']);
        return "insert into `{$this->paPrefix}_characterSprites` (`sprite`,`width`, `height`, `frames`, `animList`) values ({$qSprite},{$qWidth},{$qHeight},{$qFrames},{$qAnimList})";        
    }
    private function spriteUpdate($pdo) {
        $qSprite = $pdo->quote($this->args['sprite']);
        $qWidth = $pdo->quote($this->args['width']);
        $qHeight = $pdo->quote($this->args['height']);
        $qFrames = $pdo->quote($this->args['frames']);
        $qAnimList = $pdo->quote($this->args['animList']);
        return "update `{$this->paPrefix}_characterSprites` set `sprite`={$qSprite}, `width`={$qWidth}, `height`={$qHeight}, `frames`={$qFrames}, `animList`={$qAnimList} WHERE id={$this->args['spriteID']}";
    }
}
