<?php
namespace sdcAdventure\designer;
use \sdcAdventure\core;

class saveScene extends core\paBase {
    protected function expectedArgs() {
        return array(
            'id'        => array('type'=>'integer','required'=>true),
            'title'     => array('type'=>'string','required'=>true),
            'backdrop'  => array('type'=>'string','required'=>true),
            'walkable'  => array('type'=>'string','required'=>true),
            'exits'     => array('default'=>array()),
        );
    }

    public function call() {
        $output = array();
        $pdo = core\paDB::conn();

        $queries = array();
        if($this->args['id']) {
            $old = core\paMain::call(array('module'=>'loadScenes','sceneID'=>$this->args['id']));
            if($old['success']) {
                $old = $old['results'][0];
            } else {
                throw new core\paException('Failed to load existing scene #'.$this->args['id']);
            }
            $scquery = $this->sceneUpdate($pdo);
            $pdo->query($scquery);
            $output['id']=$this->args['id'];
            foreach($this->args['exits'] as $exit) {
                if($this->hasExitId($exit, $old['exits'])) {            //exit being saved matches an existing one?
                    $queries[] = $this->exitUpdate($pdo, $exit, $output['id']);     //then update it
                } else {                                                //otherwise insert it.
                    $queries[] = $this->exitInsert($pdo, $exit, $this->args['id']);
                }
            }
            foreach($old['exits'] as $oexit) {
                if(!$this->hasExitId($oexit, $this->args['exits'])) {   //existing exit isn't in the exit list being saved?
                    $queries[] = $this->exitDelete($pdo, $oexit, $output['id']);    //then delete it.
                }
            }
        } else {
            $scquery = $this->sceneInsert($pdo);
            $pdo->query($scquery);
            $output['id']=$pdo->lastInsertId();
            foreach($this->args['exits'] as $exit) {
                $queries[] = $this->exitInsert($pdo, $exit, $output['id']);
            }
        }
        foreach($queries as $query) {
            try {
                if($query) {$pdo->query($query);}
            } catch(\Exception $e) {
                print "Error with query"; die;
            }
        }

        return $output;
    }
    private function hasExitId($exitWithId, $exits) {
        if(!isset($exitWithId['id'])) {return false;}
        foreach($exits as $exit) {
            if($exit['id']==$exitWithId['id']) {return true;}
        }
        return false;
    }
    private function sceneInsert($pdo) {
        $qTitle = $pdo->quote($this->args['title']);
        $qBackdrop = $pdo->quote($this->args['backdrop']);
        $qWalkable = $pdo->quote($this->args['walkable']);
        return "insert into `{$this->paPrefix}_scenes` (`title`,`backdrop`, `walkable`) values ({$qTitle},{$qBackdrop}, {$qWalkable})";        
    }
    private function sceneUpdate($pdo) {
        $qTitle = $pdo->quote($this->args['title']);
        $qBackdrop = $pdo->quote($this->args['backdrop']);
        $qWalkable = $pdo->quote($this->args['walkable']);
        return "update `{$this->paPrefix}_scenes` set `title`={$qTitle}, `backdrop`={$qBackdrop}, `walkable`= {$qWalkable} WHERE id={$this->args['id']}";
    }
    private function exitInsert($pdo, $exit, $sceneID) {
        if(!isset($exit['shape']) || !isset($exit['destID'])) {return '';}
        $qShape = $pdo->quote($exit['shape']);
        $qDestID = $pdo->quote($exit['destID']);
        $qDestX = $pdo->quote($exit['destX']);
        $qDestY = $pdo->quote($exit['destY']);
        $qDestX2 = $pdo->quote($exit['destX2']);
        $qDestY2 = $pdo->quote($exit['destY2']);
        $qSceneID = $pdo->quote($sceneID);
        return "insert into `{$this->paPrefix}_sceneExits` (sceneID, destID, destX, destY, destX2, destY2, shape) values ({$qSceneID}, {$qDestID}, {$qDestX}, {$qDestY}, {$qDestX2}, {$qDestY2}, {$qShape})";
    }
    private function exitUpdate($pdo, $exit, $sceneID) {
        if(!isset($exit['shape']) || !isset($exit['destID'])) {return $this->exitDelete($pdo, $exit, $sceneID);}
        $qExitID = $pdo->quote($exit['id']);
        $qShape = $pdo->quote($exit['shape']);
        $qDestID = $pdo->quote($exit['destID']);
        $qDestX = $pdo->quote($exit['destX']);
        $qDestY = $pdo->quote($exit['destY']);
        $qDestX2 = $pdo->quote($exit['destX2']);
        $qDestY2 = $pdo->quote($exit['destY2']);
        $qSceneID = $pdo->quote($sceneID);
        return "update `{$this->paPrefix}_sceneExits` SET sceneID={$this->args['id']}, destID={$qDestID}, destX={$qDestX}, destY={$qDestY}, destX2={$qDestX2}, destY2={$qDestY2}, shape={$qShape} WHERE id={$qExitID} AND sceneID={$qSceneID}";
    }
    private function exitDelete($pdo, $exit, $sceneID) {
        $qExitID = $pdo->quote($exit['id']);
        $qSceneID = $pdo->quote($sceneID);
        return "delete from `{$this->paPrefix}_sceneExits` WHERE id={$qExitID} and sceneID={$qSceneID}";
    }
}
