<?php
namespace sdcAdventure\designer;
use \sdcAdventure\core;

class listImages extends core\paBase {
    protected function expectedArgs() {
        return array(
            'type'      => array('values'=>array('sprites','scenes'))
        );
    }

    public function call() {
        $output = array();
        $dir = new \DirectoryIterator(ADVENGAME_ROOT.'/assets/'.$this->args['paGame'].'/'.$this->args['type']);
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isFile()) {
                $output[] = $fileinfo->getFilename();
            }
        }
        return $output;
    }
}
