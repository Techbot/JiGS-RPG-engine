<?php
namespace sdcAdventure\designer;
use \sdcAdventure\core;

/**
 * Setup class - Create the tables for the game.
 * @todo: security! (upload file type, name, size, called from, etc)
 */
class uploadBgImage extends core\paBase {
    protected function expectedArgs() {
        return array(
            'use_existing'=> array('type'=>'string'),
        );
    }

    public function call() {
        $imgPath = ADVENGAME_ROOT.'/assets/'.$this->args['paGame'].'/scenes/';
        if(isset($_FILES['gd_uploadbg'])) {
            $name  = $_FILES['gd_uploadbg']['name'];
            $tfile = $_FILES['gd_uploadbg']['tmp_name'];
            if(!move_uploaded_file($tfile, $imgPath.$name)) {
                throw new core\paException("Error saving image.");
            }
        } else {
            if(isset($this->args['use_existing'])) {
                if(!file_exists($imgPath.$this->args['use_existing'])) {
                    throw new core\paException("Image upload not found.");
                }
                $name = $this->args['use_existing'];
            } else {
                throw new core\paException("Image upload not found.");
            }
        }
        
        return array('name'=>$name);
    }
}
