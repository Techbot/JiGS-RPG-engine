<?php
namespace sdcAdventure\designer;
use \sdcAdventure\core;
echo "hi";
exit():
/**
 * Setup class - Create the tables for the game.
 */
class createTables extends core\paBase {
    protected function expectedArgs() {
        return array(
            'prefix' => array('default'=>'pa'),
        );
    }

    public function call() {
        $pdo = core\paDB::conn();
        $this->doCreates($pdo);
        return $this->doInserts($pdo);
    }

    private function doCreates($pdo) {
        $tables = $this->tables();
        foreach($tables as $table=>$fields) {
            $sql = strtr($this->template(),array(
                '[tablename]'=>$this->args['prefix'].'_'.$table,
                '[fields]'=>implode(', ',$fields)
                ));
            $pdo->query($sql);
        }
        return array('tables'=>count($tables));
    }

    private function template() {
        return <<<eof
CREATE TABLE IF NOT EXISTS [tablename] (
    id          INTEGER NOT NULL PRIMARY KEY autoincrement,
    [fields]
);
eof;
    }
    private function tables() {
        return array(
            'scenes' => array(
                'title VARCHAR(50)',
                'backdrop VARCHAR(50)',
                'walkable VARCHAR(100)',
            ),
            'sceneExits' => array(
                'sceneID INT',
                'destID INT',
                'destX INT',
                'destY INT',
                'destX2 INT',
                'destY2 INT',
                'shape VARCHAR(100)',
            ),
            'characters' => array(
                'name VARCHAR(50)',
                'startSceneID INT',
                'talkColour VARCHAR(6)',
                'isPlayer INT',
            ),
            'characterSprites' => array(
                'characterID INT',
                'sprite VARCHAR(50)',
                'width INT',
                'height INT',
                'frames INT',
                'animList VARCHAR(30)',                
            ),
            'characterScenes' => array(
                'characterID INT',
                'sceneID INT',
                'fromSceneID INT',
                'startX INT',
                'startY INT',
                'startFrame VARCHAR(2)',
                'startX2 INT',
                'startY2 INT',
                'startFrame2 VARCHAR(2)',
                'dir VARCHAR(1)',
            ),
            'items' => array(
                'title VARCHAR(50)',
                'startSceneID INT',
                'sceneImageX INT',
                'sceneImageY INT',
                'sceneImage VARCHAR(50)',
                'inventoryIcon VARCHAR(50)',
            ),
            'conversations' => array(
                'choiceID INT',
                'leadsToChoiceID INT',
                'saidBy INT',
                'saidTo INT',
                'text VARCHAR(250)',
                'canRepeat INT',
            ),
        );
    }

    private function doInserts($pdo) {
        //these are the inserts for the basic demo game.
        $queries = array(
            "insert into `{$this->args['prefix']}_scenes` (`title`,`backdrop`, `walkable`) values ('Outside the Savage Chicken','outside_chicken.png',  '0,256, 78,256, 183,288, 640,279, 640,480, 0,480')",
            "insert into `{$this->args['prefix']}_scenes` (`title`,`backdrop`, `walkable`) values ('Outside the spaceport',     'outside_spaceport.png','0,340, 347,313, 528,204, 569,211, 508,352, 640,435, 640,480, 0,480')",
            "insert into `{$this->args['prefix']}_sceneExits` (sceneID, destID, destX, destY, destX2, destY2, shape) values (1, 5, 630,400,590,420, '0,205, 78,198, 78,256, 0,256')",
            "insert into `{$this->args['prefix']}_sceneExits` (sceneID, destID, destX, destY, destX2, destY2, shape) values (1, 2, 20,420, 100,400, '590,300, 640,300, 640,480, 590,480')",
            "insert into `{$this->args['prefix']}_characters` (`name`, `startSceneID`,`talkColour`, `isPlayer`) values ('Sam',1,'ffffff',1)",
            "insert into `{$this->args['prefix']}_characters` (`name`, `startSceneID`,`talkColour`, `isPlayer`) values ('Bob',2,'ffff00',0)",
            "insert into `{$this->args['prefix']}_characterScenes` (`characterID`,`sceneID`,`fromSceneID`, `startX`, `startY`, `startFrame`, `startX2`, `startY2`, `startFrame2`,`dir`) values (1,1,0,430,400,'wr',390,420,'','l')",
            "insert into `{$this->args['prefix']}_characterScenes` (`characterID`,`sceneID`,`fromSceneID`, `startX`, `startY`, `startFrame`, `startX2`, `startY2`, `startFrame2`,`dir`) values (2,2,2,410,420,'tl',0,0,'','r')",
            "insert into `{$this->args['prefix']}_characterSprites` (characterID, sprite, width, height, frames, animList) values (1, 'SamSprite.png',50,100,5,'wl,wb,wf,wr,tl,tr')",
            "insert into `{$this->args['prefix']}_characterSprites` (characterID, sprite, width, height, frames, animList) values (2, 'BobSprite.png',38,100,2,'tl,tr')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (null, null, 1,1, 'Well, here I am, just hanging around.|Nothing to do, nothing to see.')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (null, null, 1,1, 'No-one here but us Chickens.')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (null, 1,    1,2, 'Hello. Who are you?')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (1,    2,    2,1, ".$pdo->quote("Hello. I'm Bob.|I sell Bibles to the robots.|Who are you?").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (2,    3,    1,2, ".$pdo->quote("I'm Sam. I'm a Starship captain.").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (2,    4,    1,2, ".$pdo->quote("I'm Sam. I'm a lovable rogue.").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (2,    3,    1,2, ".$pdo->quote("I'm Sam. I'm an alien squid thing.").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (3,    null, 2,1, ".$pdo->quote("That's nice for you.").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (4,    null, 2,1, 'A rogue, eh? Perhaps we can work together some time.')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (5,    null, 2,1, '')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (null, 6,    1,2, 'Hello. Do you know where I can find a good coffee around here?')",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text) values (6,    7,    2,1, ".$pdo->quote("Try 'The Golden Trough'. The coffee there can really put hair on your chest.").")",
            "insert into `{$this->args['prefix']}_conversations` (choiceID, leadstoChoiceID, saidBy, saidTo, text ) values (7,    null, 1,2, 'Really? I always wondered why you mammals like coffee so much.')",
        );
        foreach($queries as $sql) {
            print "$sql\n";
            $pdo->query($sql.';');
        }
    }
}
