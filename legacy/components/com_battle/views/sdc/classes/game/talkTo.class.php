<?php
namespace sdcAdventure\game;
use \sdcAdventure\core;

class talkTo extends core\paBase {
    protected function expectedArgs() {
        return array(
            'charID'        => array('default'=>0),
            'talkTo'        => array('default'=>0),
            'speechOptsID'  => array('default'=>0),
        );
    }

    public function call() {
        //load the NPC's speech (if any), plus the player's response(s) (if any).
        //@todo: make it more flexible so that multiple NPCs can be involved; it just has to keep loading until it hits a set of options for the player.
        $output = array();

        if($this->args['charID']===1) {
            $output[] = $this->loadSpeech($this->args['charID'], $this->args['talkTo'], $this->args['speechOptsID']);
            $output[] = null;
        } else {
            $output[] = $this->loadSpeech($this->args['charID'], $this->args['talkTo'], $this->args['speechOptsID']);
            $opt = (count($output) ? $output[0][0]['leadsToOpts'] : $this->args['speechOptsID']);
            $output[] = ($opt ? $this->loadSpeech($this->args['talkTo'], $this->args['charID'], $opt) : null);
        }


        if(count($output)===0) {
            throw new paException("Unknown conversation #{$this->args['speechOptsID']}.");
        }
        return $output;
    }

    //returns a filtered array of speech options.
    private function loadSpeech($charID, $talkTo, $optsID) {
        $speech = $this->speech();
        foreach($speech as $k=>$rec) {
            if($rec['saidBy']!=$charID) {unset($speech[$k]);}
            if($optsID) {
                if($rec['optsID']!==$optsID) {unset($speech[$k]);}
            } else {
                if($rec['optsID']) {unset($speech[$k]);}
            }
            if($talkTo && $rec['saidTo']!=$talkTo) {unset($speech[$k]);}
        }
        if($charID!==1 || $charID===$talkTo) {$speech = array($speech[array_rand($speech)]);} //non player chars only get to say one thing, so if multiple options, pick a random one.
        return $speech;
    }

    private function speech() {
        return array(
            array('id'=>1, 'optsID'=>null, 'saidBy'=>1,'saidTo'=>1,'leadsToOpts'=>null, 'text'=>'Well, here I am, just hanging around.|Nothing to do, nothing to see.', 'canRepeat'=>1),
            array('id'=>2, 'optsID'=>null, 'saidBy'=>1,'saidTo'=>1,'leadsToOpts'=>null, 'text'=>'No-one here but us Chickens.', 'canRepeat'=>1),

            array('id'=>3, 'optsID'=>null, 'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>1,    'text'=>'Hello. Who are you?', 'canRepeat'=>0),
            array('id'=>4, 'optsID'=>1,    'saidBy'=>2,'saidTo'=>1,'leadsToOpts'=>2,    'text'=>"Hello. I'm Bob.|I sell Bibles to the robots.|Who are you?", 'canRepeat'=>1),
            array('id'=>5, 'optsID'=>2,    'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>3,    'text'=>"I'm Sam. I'm a Starship captain.", 'canRepeat'=>0),
            array('id'=>6, 'optsID'=>2,    'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>4,    'text'=>"I'm Sam. I'm a lovable rogue.", 'canRepeat'=>0),
            array('id'=>7, 'optsID'=>2,    'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>3,    'text'=>"I'm Sam. I'm an alien squid thing.", 'canRepeat'=>0),

            array('id'=>8, 'optsID'=>3,    'saidBy'=>2,'saidTo'=>1,'leadsToOpts'=>null, 'text'=>"That's nice for you.", 'canRepeat'=>0),
            array('id'=>9, 'optsID'=>4,    'saidBy'=>2,'saidTo'=>1,'leadsToOpts'=>null, 'text'=>"A rogue, eh? Perhaps we can work together some time.", 'canRepeat'=>0),
            array('id'=>10,'optsID'=>5,    'saidBy'=>2,'saidTo'=>1,'leadsToOpts'=>null, 'text'=>"", 'canRepeat'=>0),

            array('id'=>11,'optsID'=>null, 'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>6,    'text'=>'Hello. Do you know where I can find a good coffee around here?', 'canRepeat'=>0),
            array('id'=>4, 'optsID'=>6,    'saidBy'=>2,'saidTo'=>1,'leadsToOpts'=>7,    'text'=>"Try 'The Golden Trough'. The coffee there can really put hair on your chest.", 'canRepeat'=>1),
            array('id'=>7, 'optsID'=>7,    'saidBy'=>1,'saidTo'=>2,'leadsToOpts'=>null, 'text'=>"Really? I always wondered why you mammals like coffee so much.", 'canRepeat'=>0),
        );
    }
}
