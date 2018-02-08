<?php
/**
 * Render the sdcAdventure designer UI.
 */
namespace sdcAdventure\core;

class designerUI {
    public function gamePanel() {
        return '';
    }
    public function controlPanel() {
        $buttons = array(
            'scene'     =>array('caption'=>'Scenes',    'type'=>'desform'),
            'char'      =>array('caption'=>'Characters','type'=>'desform'),
            'item'      =>array('caption'=>'Items',     'type'=>'desform'),
            'event'     =>array('caption'=>'Events',    'type'=>'desform','spacer'=>true),
            'help'      =>array('caption'=>'Help!',     'type'=>'info'),
            'about'     =>array('caption'=>'About',     'type'=>'info','spacer'=>true),
            'setup_db'  =>array('caption'=>'Setup Demo','type'=>'desaction'),
        );
        $html=array();
        foreach($buttons as $button=>$bdata) {
            $html[] = "<button id='action_{$button}' class='actionbutton' data-action='{$button}' data-type='{$bdata['type']}'>{$bdata['caption']}</button>"
                    . (isset($bdata['spacer'])?'<br /><br />':'');
        }
        return implode('',$html);
    }
    public function infoPanel() {
        return 'sdcAdventure Designer v0.1 by Simon Champion';
    }

    /**
     * Sanitise $_GET so we can output the bits we want from it safely to the main page as our Javascript config array.
     * @return string sanitised and JSON encoded copy of $_GET.
     */
    public function dynamicJSArgs() {
        $jsargs = $_GET;
        $jsargs['module']='getArgs';
        $jsargs = paMain::call($jsargs);
        return json_encode($jsargs['results']);
    }
}
