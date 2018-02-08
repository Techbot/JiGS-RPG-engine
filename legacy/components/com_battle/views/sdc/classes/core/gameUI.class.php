<?php
/**
 * Render the sdcAdventure game UI.
 */
namespace sdcAdventure\core;

class gameUI {
    public function gamePanel() {
        return '<div id="gs_loading">Please wait...</div><div id="gs_background"></div><div id="clickmap"></div><div id="talking"></div>';
    }
    public function controlPanel() {
        $buttons = array(
            'moveto'=>array('caption'=>'Walk to', 'type'=>'gameaction'),
            'talkto'=>array('caption'=>'Talk to', 'type'=>'gameaction'),
            'take'  =>array('caption'=>'Take item', 'type'=>'gameaction'),
            'use'   =>array('caption'=>'Use item', 'type'=>'gameaction'),
            'help'  =>array('caption'=>'Help!', 'type'=>'info'),
            'about' =>array('caption'=>'About', 'type'=>'info'),
        );
        $html=array();
        foreach($buttons as $button=>$bdata) {
            $html[] = "<button id='action_{$button}' class='actionbutton' data-action='{$button}' data-type='{$bdata['type']}'>{$bdata['caption']}</button>";
        }
        $overlays = '<div id="gs_talkopts" style="display:none;"></div>';
        return $overlays.implode('',$html);
    }
    public function infoPanel() {
        return 'sdcAdventure v0.1 by Simon Champion';
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
