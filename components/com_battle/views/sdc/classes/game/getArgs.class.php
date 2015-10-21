<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;
/**
 * 
 */
class getArgs extends core\paBase {
    protected function expectedArgs() {
        return array();
    }

    public function call() {
        $staticArgs = array(
            'game_root' => ADVENGAME_URL,
            'currentScene' => 1,    //default starting point.
        );
        return array_merge($this->args,$staticArgs);
    }
}
