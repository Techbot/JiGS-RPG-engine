<?php
namespace sdcAdventure\core;

abstract class paBase {
    protected $args=array();
    public $errorData=array();
    protected $paPrefix='';

    protected static $types=array('boolean','integer','float','string');

    public function __construct() {
        $this->paPrefix = paConfig::load('prefix');
    }

    /**
     * Basic sanitisation of request input data.
     * Ensures that all expected arguments are present and of the correct data type.
     * Removes any arguments from the array that were not expected.
     * @param $args array Would normally be $_REQUEST, $_POST or similar.
     */
    public function populateArgs($args) {
        unset($args['module']);     //once we're here we know what module & lib we're in, so can drop those args.
        unset($args['lib']);

        $expected = $this->expectedArgs();
        $expected['paGame']=array('default'=>paConfig::getGame());

        $this->args = $args;

        //compare args we've been given with the ones we expect.
        //drop any args we weren't expecting.
        foreach(array_keys($this->args) as $key) {
            if(!isset($expected[$key])) {unset($this->args[$key]);}
        }
        //and for the ones we are expecting, make sure they meet expectations.
        foreach($expected as $key=>$props) {
            $defvalue = $this->defaultValue($props);
            $deftype = $this->defaultType($props);
            
            if(!isset($this->args[$key])) {$this->args[$key]=$defvalue;}
            if($deftype && isset($this->args[$key])) {
                settype($this->args[$key],$deftype);
            }
            $this->validateArg($key,$props);
        }
        if(count($this->errorData)) {
            throw new paException('Invalid arguments', $this->errorData);
        }
    }

    private function defaultValue($props) {
        $defvalue = (isset($props['default']) ? $props['default'] : null);
        return $defvalue;
    }
    private function defaultType($props) {
        $deftype = null;
        if(isset($props['values'][0]))  {$deftype = $props['values'][0];}
        if(isset($props['default']))    {$deftype = $props['default'];}
        if(isset($props['type']) && in_array($props['type'],self::$types)) {
            return $props['type'];
        }
        return ($deftype!==null) ? gettype($deftype) : null;
    }
    private function validateArg($key, $props) {
        if(isset($this->args[$key])) {
            if(isset($props['values']) && !in_array($this->args[$key], $props['values'])) {
                $this->errorData[$key]='Not a permitted value';
                return;
            }
            if(isset($props['validator'])) {
                if(!method_exists($this,$props['validator'])) {
                    $this->errorData[$key]='Warning: Validator method not found';
                }
                $invalid = $this->$props['validator']($this->args[$key]);
                if(is_string($invalid) && strlen($invalid)) {
                    $this->errorData[$key]=$invalid;
                    return;
                }
            }
        } else {
            if(isset($props['required'])) {
                $this->errorData[$key]='Required';
                return;
            }
        }
    }

    /**
     * Define the expected arguments for this class/method.
     * This will be used by populateArgs() to ensure that expected args are populated and unexpected ones are removed.
     * @param string the method that will be called, so you know which set of defaults to return. (if you are only using the default call method, or if all methods take the same args, then this can be ignored)
     * @returns array of arguments in the following format:
     *     'argname'=>array(
     *          'default'=>...,         //the default if the arg isn't specified.
     *          'values'=>array(...),   //a fixed list of known permitted values: param must be one of these.
     *          'required'=>true|false, //argument is required (or not).
     *          'type'=>'...'           //datatype for arg (one of 'boolean','integer','float','string','array').
     *          'validator'=>'...'      //name of a method in this class for your own validation of this argument.
     * All of the above are optional; only specify the ones you need.
     * Note: 'type' is rarely needed; if it isn't specified, type is derived from type supplied in default or other args.
     */
    abstract protected function expectedArgs();

    /**
     * The main entry point method for all core classes.
     * This method must exist in all child classes, even if an override method name is also being used.
     * @returns array This is the return data that will be JSON encoded and passed back to the browser.
     */
    abstract public function call();
}
